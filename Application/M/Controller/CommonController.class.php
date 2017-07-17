<?php

/*
 * 本通用控制器实现
 * 
 * 
 * 1. 微信的授权
 * 2. 新用户注册
 * 
 * 
 */

namespace M\Controller;

use Think\Controller;

class CommonController extends Controller
{
    /*
     * 全局的一些通用信息
     * $memberinfo 用户资料
     * $wx_share_info 微信分享的通用资料
     */

    public $memberinfo;
    public $wx_share_info;
    public $site_url;
    public $current_url;
    public $accessToken;
    public $more_memberinfo;
    public $data_param;

    /*
     * 初始化获取访问的用户的数据
     */

    public function _initialize()
    {
        header("Content-Type:text/html; charset=utf-8");
        $this->site_url = "http://" . I('server.HTTP_HOST') . "/";
        $this->current_url = $this->get_url();

        $this->request_param();

        $this->assign('site_url', $this->site_url);

        $site_title = "珍宝斋书画租赁交易平台";
        $this->assign('site_title', $site_title);

        //资源的路径
        $resource_basic = C("resource_path");
        $this->assign('resource_path', $resource_basic);
        /*
         * 获取用户资料
         */
        if (session("?openid")) {
//            echo "1";
            /*
             * session 获取用户资料
             * 
             */
            $this->get_member_by_mid(session("mid"));
        } else {
            /*
             * 判断是否在排除的方法里边,在里边就不需要授权
             */
//            $exclude = array("common_logout","work_promotion","shoppingcart_wxpayment_notify","wxapi_index");
//            if(in_array(strtolower(CONTROLLER_NAME).'_'.strtolower(ACTION_NAME), $exclude))
//            {
//            }
//            else
//            {
//                $this->wx_oauth_response($this->current_url);
//
//                $this->get_member_by_mid(session("mid"));
//
//
//            }
        }

        //        加载微信JSSDK资料，如分享好友，分享朋友圈需要用上
        $this->get_weixin_jssdk_config();

        //获取基本的分享资料
        $this->get_basic_share_info("珍宝斋书画租赁交易平台", "珍宝斋书画租赁交易平台", "http://www.zbzart.com/index.php/M", "http://www.zbzart.com/logo.png", "珍宝斋书画租赁交易平台", "珍宝斋书画租赁交易平台", "http://www.zbzart.com/index.php/M", "http://www.zbzart.com/logo.png");
    }

    /*
     * 测试使用
     */

    public function set_mid()
    {
        $mid = I("get.mid");

        session("mid", $mid);
        session("openid", "fdfdfdfd");
    }

    /*
     * 微信授权认证
     * 获取用户资料
     */

    public function wx_oauth_response($jurl)
    {
        $wx_login_token = session('?member_access_token');
        if (empty($wx_login_token)) {
            $code = I('get.code');
            if (empty($code)) {
                //获取微信认证的code

                $wechat = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'));
                $code = $this->random_code();
                $getRequestCodeURL = $wechat->getRequestCodeURL($jurl, "$code", 'snsapi_userinfo');
                redirect($getRequestCodeURL);
            } else {
//                exit($jurl);
                //以code去换access_token
                $wechat = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'));
                $token = $wechat->getAccessToken('code', $code);

                $userinfo = $wechat->getUserInfo($token);

//                写入到表中


                $DB_member_more = M("members");

                if (!empty($token['unionid'])) {
                    $map1['unionid'] = $token['unionid'];
                    $unionid = $token['unionid'];
                } else {
                    $map1['wxopenid'] = $token['openid'];
                    $unionid = "";
                }

                $result1 = $DB_member_more->where($map1)->find();

                if (!empty($result1)) {
//                    老用户,有数据，直接复制到 session 即可
                    $mid = $result1['mid'];
                } else {
                    $member_code = $this->_get_new_member_code();
//                    新建用户
                    $data['member_code'] = $member_code;
                    $data['unionid'] = $unionid;
                    $data['wxopenid'] = $token['openid'];
                    $data['nickname'] = $userinfo['nickname'];
                    $data['password'] = "";
                    $data['avatar'] = $userinfo['headimgurl']; //头像
                    $data['mobile'] = "";
                    $data['device_token'] = "";
                    $data['ctime'] = NOW_TIME;
                    $data['utime'] = NOW_TIME;
                    $data['fromtype'] = 0; //0微信 1 iOS 2android
                    $data['gender'] = $userinfo['sex'];
                    $data['active'] = 1;


                    $DB = M("members");
                    $mid = $DB->add($data);


                    /*
                     * 新注册的用户都送代金券
                     */
                    if ($mid) {
                        $this->add_coupon_to_member("erbaiyuan", $mid);
                        
                        $this->create_member_poster($mid);// 生成自己的推广海报;
                    }
                }

                session('member_access_token', $token['access_token']);
                session('openid', $token['openid']);
                session("unionid", $token['unionid']);
                session("mid", $mid);
            }
        } else {

        }
    }

    /*
     * 通过 mid 获取用户信息
     */

    public function get_member_by_mid($mid)
    {
        $DB = M("members");
        $result = $DB->find($mid);
//        echo $mid;

        $this->memberinfo = $result;
    }

    /**
     * 生成随机验证码
     * @return  string
     */
    protected function random_code()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        return str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    /*
     * 生成订单号 16位
     */

    protected function creat_order_sn()
    {
        $codes = $this->create_4_random_code();
        return date("YmdHi") . $codes;
    }

    /**
     * 获取当前页面完整URL地址
     */
    private function get_url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }

    /*
     * 获取微信接口JSSDK信息
     */

    protected function get_weixin_jssdk_config()
    {
        $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage', $signPackage);
    }

    /*
     * 定义基本的分享资料
     */

    protected function get_basic_share_info($title, $desc, $link, $thumb, $title_all, $desc_all, $link_all, $thumb_all)
    {
        /*
         * 分享到朋友圈
         */
        $share_all['title'] = $title_all;
        $share_all['desc'] = $desc_all;
        $share_all['link'] = $link_all;
        $share_all['thumb'] = $thumb_all;


        /*
         * 分享给朋友
         */

        $share['title'] = $title;
        $share['desc'] = $desc;
        $share['link'] = $link;
        $share['thumb'] = $thumb;

        $data['share_all'] = $share_all;
        $data['share'] = $share;

        $this->assign('sharedata', $data);
    }

    /*
     * 新会员获取会员号
     * 
     */

    public function _get_new_member_code()
    {
        $map['isused'] = 0;
        $DB = M("member_code_rep");
        $res = M("member_code_rep")->where($map)->order("id ASC")->find();

        $member_code = $res['member_code'];

        $DB->id = $res['id'];
        $DB->isused = 1;
        $DB->save();

        return $member_code;
    }

    /*
     * 增加测试的注销页面
     */

    public function logout()
    {
        session(null);

        echo '重新授权登录<a href="http://'.$_SERVER['HTTP_HOST'].'/index.php/M/">'.'首页</a>';
//        redirect(U("M/Plant/index"));
    }

    /*
     * 新增浏览的记录
     */

    public function add_page_view_log($mid = 0, $ptype = 0, $fromtype = 0, $view_id = 0)
    {
        if (!empty($mid) && !empty($ptype) && !empty($fromtype) && !empty($view_id)) {
            $data['ptype'] = $ptype;
            $data['fromtype'] = $fromtype;
            $data['mid'] = $mid;
            $data['view_id'] = $view_id;
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);

            $id = M("page_view_log")->add($data);
        } else {
            $id = 0;
        }

        return $id;
    }

    /*
     * 判断一个手机号码是否已经是被注册了
     */

    public function chk_moible_isvalid($mobile)
    {
        $db = M("members");

        $map['mobile'] = $mobile;
        $res = $db->where($map)->find();

        if (!empty($res)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * 获取一个号码当天请求了多少次下发短信
     */

    public function get_mobile_request_times($mobile)
    {
        $db = M("member_mobile_code_record");
        $map['mobile'] = $mobile;
        $times = $db->where($map)->count();

        return $times;
    }

    /*
     * 计算 4 位 手机验证码
     */

    public function create_4_random_code()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        return str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    /*
     * 
     * 下发短信
     * 
     * type = 0 是绑定手机
     * type = 1 是用手机单独注册
     * type = 2 是手机找回密码
     * 
     */

    public function send_mobile_bonding_sms($mid, $mobile, $codes)
    {
        //记录短信的发送记录到手机去
        $this->_add_sms_send_log($mid, $mobile, 0, $codes);
        //调用阿里的接口下发
        $this->_send_mobile_bonding_sms($mobile, $codes); 
    }

    public function _send_mobile_bonding_sms($mobile, $codes)
    {
        //阿里云短信通道配置
        import("Org.Util.Alisms.Alisms");
        $regionId = C('alisms_regionId');
        $accessKeyId = C('alisms_accessKeyId');
        $accessSecret = C('alisms_accessSecret');

        //注册短信参数
        $signName = C('alisms_signname1');
        $templateCode = C('alisms_templateCode1');


        $alisms = new \Alisms($regionId, $accessKeyId, $accessSecret, $signName, $templateCode);

//        $mobile = "18938688660";
//        $code = "4321";

        $alisms->send_sms_reg($mobile, $codes);
    }

    /*
     * 记录短信的发送记录到手机去
     */

    private function _add_sms_send_log($mid = 0, $mobile, $type = 0, $codes = 0)
    {
        $db = M("member_mobile_code_record");
        $data = array(
            'mid' => $mid,
            'mobile' => $mobile,
            'type' => $type,
            'code' => $codes,
            'ctime' => NOW_TIME,
            'ctime_date' => date("Ymd", NOW_TIME)
        );

        $db->add($data);
    }

    /*
     * 获取作品分类
     */

    public function get_work_cat($cid)
    {
        $db = M("work_categories");

        $res = $db->find($cid);

        return $res['name'];
    }

    /*
     * 获取作品题材
     */

    public function get_work_topic($topic_id)
    {

        $db = M("work_topic");
        $res = $db->find($topic_id);

        return $res['name'];
    }

    /*
     * 解析提交的参数
     */

    protected function request_param()
    {
        $str = $this->get_url();
        $data = (parse_url($str));
        if (empty($data['query'])) {
            $this->data_param = $_POST;
        } else {
            $this->data_param = $_GET;
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    # code...
                    $this->data_param[$key] = $value;
                }
            }
        }
    }

    /*
     * 给指定用户增加代金券记录
     */

    public function add_coupon_to_member($coupon_name, $mid)
    {
        $map['coupon_name'] = $coupon_name;
        $coupon = M("member_coupons")->where($map)->find();

        if (!empty($coupon)) {
            //写入记录
            $data['mid'] = $mid;
            $data['coupon_id'] = $coupon['coupon_id'];
            $data['coupon_name'] = $coupon['coupon_name'];
            $data['coupon_name_cn'] = $coupon['coupon_name_cn'];
            $data['coupon_value'] = $coupon['coupon_value'];
            $data['coupon_limit'] = $coupon['coupon_limit'];
            $data['coupon_type'] = $coupon['coupon_type'];
            $data['coupon_credit'] = $coupon['coupon_credit'];
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd");
            $data['etime'] = NOW_TIME+3600*24*$coupon['coupon_limit'];
            $data['etime_date'] = date("Ymd",$data['etime']);

            $id = M("member_coupons_record")->add($data);

            return $id;
        } else {
            return 0;
        }
    }


    /*
     * 给指定的用户增加积分
     */
    public function add_credit_to_member($taskname, $mid)
    {
        $map1['taskname'] = $taskname;
        $res1 = M("member_credit_task")->where($map1)->find();

        //插入积分变更记录
        if($res1['task_credit']>0)
        {
            $data2['mid'] = $mid;
            $data2['taskid'] = $res1['id'];
            $data2['task_description'] = "任务：".$res1['task_description']." 完成";
            $data2['task_credit'] = $res1['task_credit'];
            $data2['ctime'] = NOW_TIME;


            M("member_credit_task_record")->add($data2);
        }
        

        return $res1['task_credit'];

    }
    
    /*
     * 判断用户是否每天第一次登录,是的话,送积分
     */
    public function chk_if_login_daily($mid) {
//        $credit_value = $this->add_credit_to_member("wechat_focus", $mid);
        $db = M("member_login_record");
        $map['mid'] = $mid;
        $map['ctime_date'] = date("Ymd");
        
        $res = $db->where($map)->find();
        if(empty($res))
        {
            //空记录增加积分
            $credit_value = $this->add_credit_to_member("daily_login", $mid);
            if($credit_value>0)
            {
                M("members")->where("mid=" . $mid)->setInc("credit", $credit_value);
            }
            
            $data['mid'] = $mid;
            $data['ctime_date'] = date("Ymd");
            $data['ctime'] = NOW_TIME;
            
            $db->add($data);
            
        }
        else
        {
            
        }
        
    }
    
    /*
     * 生成注册用户的 30天有效的推广海报
     */
    public function create_member_poster($mid) {
        $map['mid'] = $mid;
        $ress = M("member_promotion_poster")->where($map)->find();
        
        if(!empty($ress))
        {
            //检测是否过期
            if($ress['etime'] < NOW_TIME )
            {
                //新生成海报
                $res = $this->_get_member_poster_res($mid);
                $data['ticket'] = $res['ticket'];
                $data['expire_seconds'] = $res['expire_seconds'];
                $data['url'] = $res['url'];
                $data['ctime'] = NOW_TIME;
                $data['etime'] = NOW_TIME + $res['expire_seconds'];
                $data['imgurl'] = $res['imgurl'];
                $data['scene_id'] = $mid;
                $data['thumb']  =$res['thumb'];
                $data['media_id'] = $res['media_id'];
                $data['created_at'] = $res['created_at'];

               $id = M("member_promotion_poster")->where("id=".$ress['id'])->save($data);

               return $res['thumb'];
            }
            else
            {
                return $ress['thumb'];
            }
            
        }
        else
        {
            //新生成海报
            $res = $this->_get_member_poster_res($mid);
            
            $data['ticket'] = $res['ticket'];
            $data['expire_seconds'] = $res['expire_seconds'];
            $data['mid']  =$mid;
            $data['url'] = $res['url'];
            $data['ctime'] = NOW_TIME;
            $data['etime'] = NOW_TIME + $res['expire_seconds'];
            $data['thumb']  =$res['thumb'];
            $data['imgurl'] = $res['imgurl'];
            $data['scene_id'] = $mid;
            $data['media_id'] = $res['media_id'];
            $data['created_at'] = $res['created_at'];

            $id = M("member_promotion_poster")->add($data);
            
            return $res['thumb'];
            
        }
        
        
        
        
    }
    
    /*
     * 海报生成
     */
    public function _get_member_poster_res($mid) {
        $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
        $accessToken = $jssdk->returnAccessToken();
        //初始化 对象
        $wxsdk = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'), $accessToken);
        $mid = "88888".$mid;
        $res = $wxsdk->qrcodeCreate($mid, "", 2592000);
        
        $imgurl = $wxsdk->showqrcode($res['ticket']);
        $res['imgurl'] = $imgurl;
        
        $thumb = file_get_contents($imgurl); 
        $thumb_local  = "/Uploads/qrcode/".date("Ymd").$this->random_code().".jpg";
        file_put_contents($_SERVER['DOCUMENT_ROOT']  ."$thumb_local",$thumb);
        
        $res['thumb'] = $thumb_local;

        //再合成图片
        $image = new \Think\Image();

        $image->open($_SERVER['DOCUMENT_ROOT'].'/Public/M/demo.jpg')->water($_SERVER['DOCUMENT_ROOT'].$thumb_local,\Think\Image::IMAGE_WATER_CENTER,99)->save($_SERVER['DOCUMENT_ROOT']."$thumb_local");

        $today_date = date("Ymd", time());
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs/" . $today_date . "_wechat_media_upload.json", "a+");
        fwrite($fp, $_SERVER['DOCUMENT_ROOT'].$thumb_local . "\n");
        fclose($fp);

//        $ret = $wxsdk->mediaUpload($_SERVER['DOCUMENT_ROOT'].$thumb_local,"image");

        $filepath =  $_SERVER['DOCUMENT_ROOT'].$thumb_local;
        if (class_exists ( '\CURLFile' )) {//关键是判断curlfile,官网推荐php5.5或更高的版本使用curlfile来实例文件
            $filedata = array (
                'fieldname' => new \CURLFile ( realpath ( $filepath ), 'image/jpeg' )
            );
        } else {
            $filedata = array (
                'fieldname' => '@' . realpath ( $filepath )
            );
        }
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$accessToken&type=image";
        $result_json = $this->media_upload ( $url, $filedata );//调用upload函数

        $upload_arr = json_decode($result_json,true);

        $res['media_id'] =$upload_arr['media_id'];
        $res['created_at'] = $upload_arr['created_at'];

        return $res;
 
    }


    /*
     * 测试上报
     */
    /**
     * @return mixed
     */
//    public function testupload()
//    {
//        $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
//        $accessToken = $jssdk->returnAccessToken();
//        //初始化 对象
////        $wxsdk = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'), $accessToken);
////        $ret = $wxsdk->mediaUpload("/usr/local/nginx/html/app_sanliangbaby_com/Uploads/qrcode/2017041300868.jpg","image");
//
//
//        $filepath =  "/usr/local/nginx/html/app_sanliangbaby_com/Uploads/qrcode/2017041300868.jpg";
//        if (class_exists ( '\CURLFile' )) {//关键是判断curlfile,官网推荐php5.5或更高的版本使用curlfile来实例文件
//            $filedata = array (
//                'fieldname' => new \CURLFile ( realpath ( $filepath ), 'image/jpeg' )
//            );
//        } else {
//            $filedata = array (
//                'fieldname' => '@' . realpath ( $filepath )
//            );
//        }
//        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$accessToken&type=image";
//        $result = $this->testuploads ( $url, $filedata );//调用upload函数
//
//
//
//
//
//
//        print_r($result);
//    }

    /**
     * @return mixed
     */
    public function media_upload($url, $filedata)
    {
        $curl = curl_init ();
        if (class_exists ( '/CURLFile' )) {//php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同
            curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, true );
        } else {
            if (defined ( 'CURLOPT_SAFE_UPLOAD' )) {
                curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false );
            }
        }
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        if (! empty ( $filedata )) {
            curl_setopt ( $curl, CURLOPT_POST, 1 );
            curl_setopt ( $curl, CURLOPT_POSTFIELDS, $filedata );
        }
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec ( $curl );
        curl_close ( $curl );
        return $output;
    }

}

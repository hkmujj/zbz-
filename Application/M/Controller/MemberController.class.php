<?php

namespace M\Controller;

use Think\Controller;

class MemberController extends CommonController {

    public function index() {
        $this->assign("memberinfo", $this->memberinfo);
        $this->chk_if_login_daily($this->memberinfo['mid']);
//        echo "会员中心首页";
        $this->display();
    }

    /*
     * 积分
     */

    public function credit() {
        $this->assign("memberinfo", $this->memberinfo);

        //获取可以兑换的代金券列表
        $db = M("member_coupons");
        $map['coupon_type'] = 1;
        $res = $db->where($map)->select();

        $this->assign("lists", $res);

        $this->display();
    }

    /*
     * 积分兑换
     * 分别判断是否足够分数然后写入
     */

    public function credit_exchange() {
        $mid = $this->memberinfo['mid'];
        $coupon_id = I("post.coupon_id");

        $coupon = M("member_coupons")->find($coupon_id);

        if ($this->memberinfo['credit'] > $coupon['coupon_credit']) {
//            $new_credit = $this->memberinfo['credit'] - $coupon['coupon_credit'];
            //写入记录
            $data['mid'] = $mid;
            $data['coupon_id'] = $coupon_id;
            $data['coupon_name'] = $coupon['coupon_name'];
            $data['coupon_name_cn'] = $coupon['coupon_name_cn'];
            $data['coupon_value'] = $coupon['coupon_value'];
            $data['coupon_limit'] = $coupon['coupon_limit'];
            $data['coupon_type'] = $coupon['coupon_type'];
            $data['coupon_credit'] = $coupon['coupon_credit'];
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd");

            $id = M("member_coupons_record")->add($data);

            if ($id) {
                M("members")->where("mid = $mid")->setDec("credit", $coupon['coupon_credit']);


                //插入积分变更记录
                $data2['mid'] = $mid;
                $data2['taskid'] = 0;
                $data2['task_description'] = $coupon['coupon_credit'] . "积分兑换" . $coupon['coupon_value'] . "元代金券";
                $data2['task_credit'] = $coupon['coupon_credit'] * (-1);
                $data2['ctime'] = NOW_TIME;


                M("member_credit_task_record")->add($data2);


                $res['err'] = 0;
                $res['msg'] = "兑换成功";
            } else {
                $res['err'] = 2;
                $res['msg'] = "积分兑换错误";
            }
        } else {
            $res['err'] = 1;
            $res['msg'] = "积分不足";
        }

        echo json_encode($res);
    }

    /*
     * 积分列表
     */

    public function credit_record() {
        $mid = $this->memberinfo['mid'];
        $map['mid'] = $mid;
        $res = M("member_credit_task_record")->order("ctime desc")->where($map)->select();

        $this->assign("lists", $res);
//        print_r($res);
        $this->display();
    }

    /*
     * 代金券
     */

    public function coupons() {
        if (IS_AJAX) {


//            echo json_encode($res);
        } else {
            $mid = $this->memberinfo['mid'];
            $map['zbz_member_coupons_record.mid'] = $mid;
            $map['zbz_member_coupons_record.isused'] = 0;
//            $map['zbz_member_coupons_record.etime'] = array("gt",NOW_TIME);
            $res = M("member_coupons_record")->where($map)
                            ->field("zbz_member_coupons_record.*,zbz_member_coupons.thumb")
                            ->join("left join zbz_member_coupons on zbz_member_coupons.coupon_id = zbz_member_coupons_record.coupon_id")
                            ->order("zbz_member_coupons_record.ctime desc")->select();
//            echo M("member_coupons_record")->getLastSql();

            foreach ($res as $key => $value) {
                if($value['etime']<NOW_TIME)
                {
                    $res[$key]['isvalid'] = 0;
                }
                else{
                    $res[$key]['isvalid'] = 1;
                }

            }

            $this->assign("coupons", $res);
            $this->display();
        }
    }

    /*
     * 收藏夹
     */

    public function collection() {
        $dbModel = M("member_collection_record");
        $map['zbz_member_collection_record.mid'] = $this->memberinfo['mid'];
        $map['zbz_member_collection_record.status'] = 1;
        $res = $dbModel->where($map)->join("left join zbz_works on zbz_works.work_id = zbz_member_collection_record.work_id")
                        ->join("left join zbz_artists on zbz_artists.artist_id = zbz_works.artist_id")
                        ->field("zbz_works.*,zbz_artists.artist_name")->select();

//print_r($dbModel->getLastSql());
        $this->assign("collections", $res);

        $this->display();
    }

    /*
     * 关注
     */

    public function fellow() {
        $dbModel = M("member_focus_record");
        $map['zbz_member_focus_record.mid'] = $this->memberinfo['mid'];
        $map['zbz_member_focus_record.status'] = 1;
        $res = $dbModel->field("zbz_artists.*")
                        ->join("left join zbz_artists on zbz_artists.artist_id = zbz_member_focus_record.artist_id")
                        ->where($map)->order("zbz_member_focus_record.ctime DESC")->select();

        $this->assign("fellows", $res);

        $this->display();
    }

    /*
     * 收货地址
     */

    public function address() {
        $map['mid'] = $this->memberinfo['mid'];
        $address_res = M("member_address")->where($map)->order("ctime DESC")->select();

        $this->assign("address_res", $address_res);

        $this->display();
    }

    //删除地址

    public function address_del() {
        $id = I("post.id");
        $map['mid'] = $this->memberinfo['mid'];
        $map['id'] = $id;
        $address_res = M("member_address")->where($map)->find();
        if (!empty($address_res)) {
            M("member_address")->delete($id);
            
            $ret['err'] = 0;
            $ret['msg'] = "删除成功";
        } else {
            $ret['err'] = 1;
            $ret['msg'] = "删除失败".M("member_address")->getLastSql();
        }
        echo json_encode($ret);
    }

    public function address_add() {
        if (IS_POST) {
            $oid = I("post.oid");
            
            $data['mid'] = $this->memberinfo['mid'];
            $data['contact'] = I("post.contact");
            $data['contact_mobile'] = I("post.contact_mobile");
            $address1 = I("post.address1");
            $address2 = I("post.address2");
            $data['address'] = str_replace(" ", "", $address1 . $address2);
           
            $data['ctime'] = NOW_TIME;

            $id = M("member_address")->add($data);
            if ($id) {
                
               
                $res['err'] = 0;
                $res['oid'] = $oid;
                $res['msg'] = "添加成功";
                
                
                
            } else {
                $res['err'] = 1;
                $res['msg'] = "添加失败";
            }


            echo json_encode($res);
        } else {
            $oid = I("get.oid");
            if(empty($oid))
            {
                $oid = 0;
            }
            $this->assign("oid", $oid);
                
            $this->display();
        }
    }

    /*
     * 绑定手机
     */

    public function mobile_bonding() {
        $this->display();
    }

    public function mobile() {
        if (IS_POST) {
            $codes = I("post.codes");
            $mobile = I("post.mobile");

            $map['mid'] = $this->memberinfo['mid'];
            $map['mobile'] = $mobile;
            $map['code'] = $codes;
            $map['isused'] = 0;
            $db = M("member_mobile_code_record");

            $res = $db->where($map)->find();

            if (!empty($res)) {
                //修改状态
                $data_new['isused'] = 1;
                $db->where("id =" . $res['id'])->save($data_new);

                //绑定手机到members表
                $data_member['mobile'] = $mobile;
                M("members")->where("mid=" . $this->memberinfo['mid'])->save($data_member);


                $output['err'] = 0;
                $output['msg'] = "绑定成功";
            } else {
                $output['err'] = 1;
                $output['msg'] = "验证码有误";
            }

            echo json_encode($output);
        } else {
            $this->assign("memberinfo", $this->memberinfo);
//           print_r($this->memberinfo);
            $this->display();
        }
    }

    /*
     * 获取验证码
     */

    public function mobile_send_code() {
        $mobile = I("get.mobile");
        $chk_moible = $this->_chk_mobile_isvalid($mobile);
        if ($chk_moible) {
            $chk_times = $this->_chk_mobile_request_times($mobile);

            if ($chk_times) {
                $send_code = $this->create_4_random_code();

                $res['err'] = 0;
                $res['msg'] = "验证码已下发,请留意手机短信";
//                $res['codes'] = $send_code;
                //调用下发短信程序下发
                $this->send_mobile_bonding_sms($this->memberinfo['mid'], $mobile, $send_code);
            } else {
                $res['err'] = 2;
                $res['msg'] = "当天请求次数超额";
            }
        } else {
            $res['err'] = 1;
            $res['msg'] = "手机号码已注册";
        }

        echo json_encode($res);
    }

    /*
     * 判断手机号是否重复请求
     * 
     * 1. 先判断是否手机号码有效
     * 2. 在判断手机号码当天请求的次数是否超过了阀值
     * 
     */

    public function _chk_mobile_isvalid($mobile) {
        $chk_result = $this->chk_moible_isvalid($mobile);
        if ($chk_result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function _chk_mobile_request_times($mobile) {
        $chk_times = $this->get_mobile_request_times($mobile);
        if ($chk_times <= C('mobile_daily_request_amount')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * 设置密码
     * 
     * post 后
     * 检查 原密码是否正确,然后判断新密码重复输出是否正确,再修改密码
     * 
     */

    public function passwd_reset() {
        if (IS_POST) {
            $oldpasswd = I("post.oldpasswd");
            $newpasswd = I("post.newpasswd");
            $newpasswd2 = I("post.newpasswd2");

            if ($this->memberinfo['password'] == md5($oldpasswd)) {
                $ret['err'] = 1;
                $ret['msg'] = "旧密码错误";
            } else {
                if ($newpasswd != $newpasswd2) {
                    $ret['err'] = 2;
                    $ret['msg'] = "新密码两次输入不一致";
                } else {

                    $data['password'] = md5($newpasswd);
                    M("members")->where("mid = " . $this->memberinfo['mid'])->save($data);
                    $ret['err'] = 0;
                    $ret['msg'] = "修改成功";
                }
            }

            echo json_encode($ret);
        } else {
            $this->display();
        }
    }

    /*
     * 我的消息
     * 
     * 获取会员的消息
     * 
     * 
     */

    public function msg() {
        $map['mid'] = $this->memberinfo['mid'];
        $msg_member = M("msg_members")->where($map)->order("ctime desc")->select();

        $map1['zbz_msg_system_member_relationship.mid'] = $this->memberinfo['mid'];
        $map1['zbz_msg_system.ishidden'] = 0;
        $msg_system = M("msg_system")->where($map1)
                        ->field("zbz_msg_system.title as title,zbz_msg_system.content as content,zbz_msg_system.ctime as ctime,zbz_msg_system.ctime_date as ctime_date,zbz_msg_system_member_relationship.isread as isread,zbz_msg_system_member_relationship.mid as mid")
                        ->join("left join zbz_msg_system_member_relationship on zbz_msg_system_member_relationship.sys_msg_id = zbz_msg_system.id")
                        ->order("zbz_msg_system.ctime desc")->select();

        $this->assign('msg_member', $msg_member);
        $this->assign('msg_system', $msg_system);
//        print_r($msg_system);

        $this->display();
    }

    public function msg_detail() {
        $id = I("get.id");
        $this->display();
    }

    /*
     * 推广的链接
     * 
     * 通过openid 判断是否有被推荐过
     * 没有则新添加记录
     * 
     */

    public function mypromotion() {
        $mid = I("get.mid");

        if (!empty($mid)) {

            $mymid = session("mid");

            if ($mymid != $mid) {
//                print_r($this->memberinfo);
                $db = M("member_promotion_record");


                $openid = session("openid");
                $unionid = session("unionid");

//            print_r(session());

                $map['unionid'] = $unionid;

                $res = $db->where($map)->find();

                if (empty($res)) {
                    $data['mid'] = session("mid");
                    $data['pmid'] = $mid;
                    $data['unionid'] = $unionid;
                    $data['openid'] = $openid;
                    $data['ctime'] = NOW_TIME;
                    $data['ctime_date'] = date("Ymd");

                    $id = $db->add($data);
//                echo $db->getLastSql();
                }


//            echo $new_url;
            } else {
                $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';

                $new_url = $sys_protocal . $_SERVER['HTTP_HOST'] . U('M/Member/mypromotion', array('id' => $mymid));
                Vendor('phpqrcode.phpqrcode');
                $errorCorrectionLevel = intval(3); //容错级别 
                $matrixPointSize = intval(8); //生成图片大小 
                //生成二维码图片 
                //echo $_SERVER['REQUEST_URI'];
                $object = new \QRcode();
                $object->png($new_url, false, $errorCorrectionLevel, $matrixPointSize, 2);
            }

//          
//            $this->display();
        } else {
            echo "参数错误";
        }
    }
    
    /*
     * promotion
     */
    public function getmypromotion() {
        $mid = session("mid");
        $imgurl = $this->create_member_poster($mid);
        
        echo $imgurl;
        
    }


    /*
     * 下发推送图片海报
     */
    public function sendimage()
    {
        $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
        $accessToken = $jssdk->returnAccessToken();
        //初始化 对象
        $wxsdk = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'), $accessToken);

        $wxsdk->sendImage("o-hJTuOcNtBcPdBepqjIpeSlu1lA","jq_r7GJVeqrh9e2brkSLQVrvoqfRNLrWTYNokz2q_jiiComesFNetiwNELZz6shc");
    }

}

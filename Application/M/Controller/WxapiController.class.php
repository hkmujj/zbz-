<?php
/**
 * Created by PhpStorm.
 * User: lukeyan
 * Date: 12/04/2017
 * Time: 11:39 AM
 */

namespace M\Controller;

use Think\Controller;
use Com\Wechat;

class WxapiController extends CommonController
{
    public $site_url;

    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     */
    public function index()
    {

        $token = I('get.token'); //微信后台填写的TOKEN
        $this->site_url = "http://" . I('server.HTTP_HOST') . "/";

        $today_date = date("Ymd", time());
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs/" . $today_date . "_wechat_log.json", "a+");
        fwrite($fp, json_encode($_GET) . file_get_contents("php://input") . "\n");
        fclose($fp);
        /*
         * 可以在这里判断$token 是否合法
         */

        /* 加载微信SDK */
        $wechat = new Wechat($token);


        /* 获取请求信息 */
        $data = $wechat->request();

        if ($data && is_array($data)) {

            /**
             * 你可以在这里分析数据，决定要返回给用户什么样的信息
             * 接受到的信息类型有9种，分别使用下面九个常量标识
             * Wechat::MSG_TYPE_TEXT       //文本消息
             * Wechat::MSG_TYPE_IMAGE      //图片消息
             * Wechat::MSG_TYPE_VOICE      //音频消息
             * Wechat::MSG_TYPE_VIDEO      //视频消息
             * Wechat::MSG_TYPE_MUSIC      //音乐消息
             * Wechat::MSG_TYPE_NEWS       //图文消息（推送过来的应该不存在这种类型，但是可以给用户回复该类型消息）
             * Wechat::MSG_TYPE_LOCATION   //位置消息
             * Wechat::MSG_TYPE_LINK       //连接消息
             * Wechat::MSG_TYPE_EVENT      //事件消息
             *
             * 事件消息又分为下面五种
             * Wechat::MSG_EVENT_SUBSCRIBE          //订阅
             * Wechat::MSG_EVENT_SCAN               //二维码扫描
             * Wechat::MSG_EVENT_LOCATION           //报告位置
             * Wechat::MSG_EVENT_CLICK              //菜单点击
             * Wechat::MSG_EVENT_MASSSENDJOBFINISH  //群发消息成功
             */

            switch ($data['MsgType']) {
                case Wechat::MSG_TYPE_TEXT:
                    switch ($data['Content']) {

                        case "首页":
                            $content = "http://" . $_SERVER['HTTP_HOST'] . "/index.php/M/";
                            $wechat->response($content, Wechat::MSG_TYPE_TEXT);

                            break;

                        case "poster":

                            $memberinfo = M("members")->where(array("wxopenid" => $data['FromUserName']))->find();
                            if (!empty($memberinfo)) {
                                $poster_res = M("member_promotion_poster")->where(array("mid" => $memberinfo['mid']))->find();

                                if (!empty($poster_res)) {
                                    $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
                                    $accessToken = $jssdk->returnAccessToken();
                                    //初始化 对象
                                    $wxsdk = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'), $accessToken);

                                    $wxsdk->sendImage($data['FromUserName'], $poster_res['media_id']);
                                }
                            }

                            break;

                            $wechat->response('谢谢留言，客服稍后将会处理你的留言', Wechat::MSG_TYPE_TEXT);

                            break;
                    }

                    break;

                case Wechat::MSG_TYPE_EVENT:
                    if ($data['Event'] == Wechat::MSG_EVENT_SUBSCRIBE) {
                        //关注事件处理

                        $jssdk = new \Com\JSSDK(C('WECHAT.appid'), C('WECHAT.appsecret'));
                        $accessToken = $jssdk->returnAccessToken();
                        //初始化 对象
                        $wxsdk = new \Com\WechatAuth(C('WECHAT.appid'), C('WECHAT.appsecret'), $accessToken);


                        $userinfo = $wxsdk->userInfo($data['FromUserName']);
                        $today_date = date("Ymd", time());
                        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs/" . $today_date . "_wechat_userinfo.json", "a+");
                        fwrite($fp, json_encode($userinfo) . "\n");
                        fclose($fp);


                        /*
                         * 检测用户资料，不存在就新增
                         */

                        $credit_value = $this->insert_focus_fan($userinfo);

                        if (empty($data['EventKey'])) {
                            //没有识别内容的回复
                            if ($credit_value > 0) {
//                                $content = "嗨，欢迎加入！获得" . $credit_value . "积分奖励";
                                $content = "您好，欢迎关注珍宝斋书画租赁交易平台";
                            } else {
                                $content = "您好，欢迎关注珍宝斋书画租赁交易平台";
                            }

                            $wechat->response($content, Wechat::MSG_TYPE_TEXT);
                        } else {

                            /*
                             * 扫描带参数二维码事件处理
                             *
                             * 1. 先判断参数值的类型，做出不一样的处理
                             *
                             *
                             */
                            $eventKey = substr($data['EventKey'], 8);
                            $wechat->response($eventKey, Wechat::MSG_TYPE_TEXT);

//                            $wxsdk->sendImage($data['FromUserName'],"jq_r7GJVeqrh9e2brkSLQVrvoqfRNLrWTYNokz2q_jiiComesFNetiwNELZz6shc");
//                            $wxsdk->sendText($data['FromUserName'], $eventKey."dddd");
//                            $eventKey_result = $this->check_qrcode_value($eventKey, "vid");
//
//                            if($eventKey_result)
//                            {
//
////                                关注的推送
//
//
//                            }
//                            else
//                            {
//
//
//                            }
                        }


                    } else if ($data['Event'] == Wechat::MSG_EVENT_UNSUBSCRIBE) {
                        //取消关注事件处理
                    } else if ($data['Event'] == Wechat::MSG_EVENT_CLICK) {
//                        点击菜单事件处理
                        switch ($data['EventKey']) {


                            case "mycode":
                                $content = " 您的编号为:" . $this->_get_member_number_code($data['FromUserName']) . "\n" . '<a href="' . $this->site_url . U('M/Index/index') . '">进入首页</a>';
                                $wechat->response($content, Wechat::MSG_TYPE_TEXT);

                                break;

                            case "poster":

                                $memberinfo = M("members")->where(array("wxopenid" => $data['FromUserName']))->find();
                                if (!empty($memberinfo)) {
                                    $poster_res = M("member_promotion_poster")->where(array("mid" => $memberinfo['mid']))->find();

                                    if (!empty($poster_res)) {
                                        $wxsdk->sendImage($data['FromUserName'], $poster_res['media_id']);
                                    }
                                }

                                break;


                            default:
                                $content = "";
                                $wechat->response($content, Wechat::MSG_TYPE_TEXT);
                                break;
                        }
                    } else if ($data['Event'] == Wechat::MSG_EVENT_SCAN) {
                        // 扫描二维码事件处理
                        /*
                         * 扫描带参数二维码事件处理
                         *
                         * 1. 先判断参数值的类型，做出不一样的处理
                         *
                         *
                         */
                        $eventKey = $data['EventKey'];
                        $wechat->response($eventKey, Wechat::MSG_TYPE_TEXT);
//                            $eventKey_result = $this->check_qrcode_value($eventKey, "vid");


                    } else {

                    }

                    break;

                default:
                    $content = '你好，请留言';
                    $wechat->response($content, Wechat::MSG_TYPE_TEXT);
                    break;
            }


            /**
             * 响应当前请求还有以下方法可以只使用
             * 具体参数格式说明请参考文档
             *
             * $wechat->replyText($text); //回复文本消息
             * $wechat->replyImage($media_id); //回复图片消息
             * $wechat->replyVoice($media_id); //回复音频消息
             * $wechat->replyVideo($media_id, $title, $discription); //回复视频消息
             * $wechat->replyMusic($title, $discription, $musicurl, $hqmusicurl, $thumb_media_id); //回复音乐消息
             * $wechat->replyNews($news, $news1, $news2, $news3); //回复多条图文消息
             * $wechat->replyNewsOnce($title, $discription, $url, $picurl); //回复单条图文消息
             *
             */
        }
    }


    /*
     * 新增用户
     * 通过unionid判断是否存在
     *
     */
    public function insert_focus_fan($datas)
    {
        if (isset($datas['unionid'])) {
            $map['unionid'] = $datas['unionid'];
            $res = M("members")->where($map)->find();

            if (empty($res)) {
//                插入新用户
                $member_code = $this->_get_new_member_code();
                $data['member_code'] = $member_code;
                $data['unionid'] = $datas['unionid'];
                $data['wxopenid'] = $datas['openid'];
                $data['nickname'] = $datas['nickname'];
                $data['password'] = "";
                $data['avatar'] = $datas['headimgurl']; //头像
                $data['mobile'] = "";
                $data['device_token'] = "";
                $data['ctime'] = NOW_TIME;
                $data['utime'] = NOW_TIME;
                $data['fromtype'] = 0; //0微信 1 iOS 2android
                $data['gender'] = $datas['sex'];
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
            } else {
                //app注册来的用户，wxopenid 为空，需要补充

                $mid = $res['mid'];
                if (empty($res['wxopenid'])) {
                    $data_save['wxopenid'] = $datas['openid'];
                    M("members")->where("mid=" . $mid)->save($data_save);
                }

            }

            //检测是否有领过积分，没有的赠送积分
            $map_chk['mid'] = $mid;
            $credit_chk = M("member_credit_task_record")->where($map_chk)->find();

            if (empty($credit_chk)) {
                $credit_value = $this->add_credit_to_member("wechat_focus", $mid);

                M("members")->where("mid=" . $mid)->setInc("credit", $credit_value);
            } else {
                $credit_value = 0;
            }

            return $credit_value;
        } else {
            return 0;
        }

    }

    /*
     * 检测 qrcode 的参数是不是 在推广链接里边,如果是的,关联双方的推广关系
     */
    public function check_qrcode_value($eventKey)
    {
        $eventKey = substr($eventKey, 5);
    }


    /*
     * 判断海报有没有生成，过期了就重新生成
     */
    public function _chk_poster_valid($mid)
    {

    }

}
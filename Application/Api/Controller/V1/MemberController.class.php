<?php

namespace Api\Controller\V1;
use Think\Controller;
class MemberController extends Controller {
    public function index(){
        echo "yes";
    }
    
    /*
     * 下发短信的demo
     * 
     */
    public function send_sms_demo() {
        //阿里云短信通道配置
        import("Org.Util.Alisms.Alisms");
        $regionId = C('alisms_regionId');
        $accessKeyId = C('alisms_accessKeyId');
        $accessSecret = C('alisms_accessSecret');
        
        //注册短信参数
        $signName = C('alisms_signname1');
        $templateCode = C('alisms_templateCode1');
        
        
        $alisms = new \Alisms($regionId,$accessKeyId,$accessSecret,$signName,$templateCode);
        
        $mobile = "18938688660";
        $code = "4321";
        
//        $alisms->send_sms_reg($mobile, $code);
        
    }
}


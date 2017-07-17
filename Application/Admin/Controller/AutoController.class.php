<?php

namespace Admin\Controller;

use Think\Controller;

class AutoController extends CommonController {
    
    /*
     * 自动找出来 6~7 天到期的订单
     */
    public function rent_order_chk() {
       $map['order_type'] = 1;
       $map['order_status'] = 1;
       
       $date_six = NOW_TIME+3600*6*24;
       $date_seven = NOW_TIME+3600*7*24;
       $map['etime'] = array(array("gt",$date_six),array("lt",$date_seven));
       
       $db = M("orders");
       $res = $db->where($map)->select();
       
       //contact_mobile, contact,order_sn 
       foreach ($res as $key => $value) {
           $this->send_rent_order_will_expired_sms($value['mid'], $value['contact_mobile'], 123123);
       }
       
    }
    
    
    /*
     * 下发租赁到期短信
     */
    
    public function send_rent_order_will_expired_sms($mid,$mobile,$codes)
    {
        //记录短信的发送记录到手机去
//        $this->_add_sms_send_log($mid, $mobile, 0, $codes);
        //调用阿里的接口下发
//        $this->_send_rent_order_will_expired_sms($mobile, $codes); 
    }
    
    public function _send_rent_order_will_expired_sms($mobile,$codes) {
        //阿里云短信通道配置
        import("Org.Util.Alisms.Alisms");
        $regionId = C('alisms_regionId');
        $accessKeyId = C('alisms_accessKeyId');
        $accessSecret = C('alisms_accessSecret');
        
        //注册短信参数
        $signName = C('alisms_signname1');
        $templateCode = C('alisms_templateCode1');
        
        
        $alisms = new \Alisms($regionId,$accessKeyId,$accessSecret,$signName,$templateCode);
        
//        $mobile = "18938688660";
//        $code = "4321";
        
        $alisms->send_sms_notify($mobile, $codes);
    }
 

}

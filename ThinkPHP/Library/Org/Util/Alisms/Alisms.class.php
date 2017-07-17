<?php

include_once 'aliyun-php-sdk-core/Config.php';

use Sms\Request\V20160927 as Sms;

class Alisms {
    
    public $regionId;
    public $accessKeyId;
    public $accessSecret;
    
    public $signName;
    public $templateCode;

    public function __construct($regionId,$accessKeyId,$accessSecret,$signName,$templateCode) {
        $this->regionId = $regionId;
        $this->accessKeyId = $accessKeyId;
        $this->accessSecret = $accessSecret;
        
        $this->signName = $signName;
        $this->templateCode = $templateCode;
    }
    
    
    /*
     * 下发注册短信
     */
    public function send_sms_reg($mobile,$code) {
        $iClientProfile = DefaultProfile::getProfile($this->regionId, $this->accessKeyId, $this->accessSecret);
        $client = new DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName($this->signName); /* 签名名称 */
        $request->setTemplateCode($this->templateCode); /* 模板code */
        $request->setRecNum($mobile); /* 目标手机号 */
        $request->setParamString("{\"code\":\"$code\",\"product\":\"$this->signName\"}"); /* 模板变量，数字一定要转换为字符串 */
        try {
            $response = $client->getAcsResponse($request);
            return TRUE;
//            print_r($response);
        } catch (ClientException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        } catch (ServerException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }
    
    
    /*
     * 下发修改密码短信
     */
    public function send_sms_passwd_modify($mobile,$code) {
        
    }
    
    /*
     * 下发租赁到期提醒短信
     */
    public function send_sms_notify($mobile,$code) {
        $iClientProfile = DefaultProfile::getProfile($this->regionId, $this->accessKeyId, $this->accessSecret);
        $client = new DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName($this->signName); /* 签名名称 */
        $request->setTemplateCode($this->templateCode); /* 模板code */
        $request->setRecNum($mobile); /* 目标手机号 */
        $request->setParamString("{\"code\":\"$code\",\"product\":\"$this->signName\"}"); /* 模板变量，数字一定要转换为字符串 */
        try {
            $response = $client->getAcsResponse($request);
            return TRUE;
//            print_r($response);
        } catch (ClientException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        } catch (ServerException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }
    
    
    
    

    public function send_sms_test() {
        
//        print_r($this->regionId);
//        exit();
        $iClientProfile = DefaultProfile::getProfile($this->regionId, $this->accessKeyId, $this->accessSecret);
        $client = new DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName("三良科技"); /* 签名名称 */
        $request->setTemplateCode("SMS_48420025"); /* 模板code */
        $request->setRecNum("18938688660"); /* 目标手机号 */
        $request->setParamString("{\"customer\":\"lukeyan\"}"); /* 模板变量，数字一定要转换为字符串 */
        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
        } catch (ClientException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        } catch (ServerException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }

}

?>
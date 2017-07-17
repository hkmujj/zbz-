<?php
namespace Com;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WechatCrypt {
    /*
     * 第三方平台的component_verify_ticket
     */
    private $component_verify_ticket = '';
    
    /*
     * 获取第三方平台的 component_access_token
     */
    private $component_access_token = '';

    /*
     * 获取pre_auth_code
     */
    private $pre_auth_code = '';
    
    /*
     * 时间戳
     */
    private $timeStamp;
    
    private $nonce;
    
    private $msg_signature;
    
    private $xml;

    private $data;
    private $data2;

    /*
     * 创建对象
     */
    public $pc;


    /**
     * 微信component api根路径
     * @var string
     */
    private $apiURL    = 'https://api.weixin.qq.com/cgi-bin/component';
    
    public function __construct() {
        
        $this->pc = new \Org\Util\Wxcrypt\WXBizMsgCrypt(C('component_token'), C('component_encodingAesKey'), C('component_appId'));
        
               
       
    }
    
    /*
     * 响应微信服务器发送过来的 component_verify_ticket
     */
    public function setComponent_verify_ticket($timeStamp,$nonce,$msg_signature,$xmldata) {
        
        $this->timeStamp = $timeStamp;
        $this->nonce = $nonce;
        $this->msg_signature = $msg_signature; 
        
//        print_r($xmldata);
        $xml = new \SimpleXMLElement($xmldata);
        $xml || exit;

        foreach ($xml as $key => $value) {
            $this->data[$key] = strval($value);
        }
        $encrypt = $this->data['Encrypt'];
        
        $format = "<xml><AppId><![CDATA[".C('component_appId')."]]></AppId><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        
//        print_r($encrypt.'---'.$this->msg_signature.'---'.$this->timeStamp.'---'.$this->nonce.'---');
//        echo "<br/>";

        // 第三方收到公众号平台发送的消息
        $msg = '';
        $errCode = $this->pc->decryptMsg($this->msg_signature, $this->timeStamp, $this->nonce, $from_xml, $msg);
        if ($errCode == 0) {
                echo "success";
                
                $xml = new \SimpleXMLElement($msg);
                $xml || exit;

                foreach ($xml as $key => $value) {
                    $this->data2[$key] = strval($value);
                }
                
                
                $fp = fopen("component_verify_ticket.json", "w");
                fwrite($fp, json_encode($this->data2));
                fclose($fp);
        } else {
                print($errCode . "\n");
        }
    }
    
    /*
     * 获取本地存储的 component_verify_ticket
     */
    public function getComponent_verify_ticket() {
        $data = json_decode(file_get_contents("component_verify_ticket.json"));
        
        
        return $data->ComponentVerifyTicket;
    }
    
    /*
     * 获取 component_access_token
     */
    public function getComponent_access_token() {
        $data = json_decode(file_get_contents("component_access_token.json"));
        if ($data->expire_time < time()) {
            $param = array();
            $postdata = array(
                'component_appid'=>C('component_appId'),
                'component_appsecret'=>C('component_appsecret'),
                'component_verify_ticket'=>'ticket@@@frCP7u70M_KFIXjmUnZqFxh8G0jAo79mLhQAb7FfxlGpv6vLL8VWr4N4AXMqC_FKP9o43X5FsYbBcuRk1UxfWw'
                );

            $postdata = json_encode($postdata);
    //            echo $postdata;
            $url = "{$this->apiURL}/api_component_token";
    //            $res = json_decode($this->httpGet($url));
            $res = self::http($url, $param, $postdata, 'POST');
            $data = json_decode($res);
            $component_access_token = $data->component_access_token;
            if ($component_access_token) {
                $data->expire_time = time() + 7000;
                $data->component_access_token = $component_access_token;


                $fp = fopen("component_access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
          }
      } else {
        $component_access_token = $data->component_access_token;
      }
      return $component_access_token;
  }
  
  
  /*
   * 获取pre_auth_code
   */
  public function getPre_auth_code() {
        $data = json_decode(file_get_contents("pre_auth_code.json"));
        if ($data->expire_time < time()) {
            
            $component_access_token = $this->getComponent_access_token();
            $param = array(
                'component_access_token'=>$component_access_token
            );
            
            $postdata = array(
                'component_appid'=>C('component_appId')
            );

            $postdata = json_encode($postdata);
    //            echo $postdata;
            $url = "{$this->apiURL}/api_create_preauthcode";
    //            $res = json_decode($this->httpGet($url));
            $res = self::http($url, $param, $postdata, 'POST');
            $data = json_decode($res);
            $pre_auth_code = $data->pre_auth_code;
            if ($pre_auth_code) {
                $data->expire_time = time() + 1600;
                $data->pre_auth_code = $pre_auth_code;
                
                $fp = fopen("pre_auth_code.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
          }
      } else {
        $pre_auth_code = $data->pre_auth_code;
      }
      return $pre_auth_code;
  }
  
  public function getAuthorizer_access_token($auth_code) {
      $component_access_token = $this->getComponent_access_token();
      $param = array(
            'component_access_token'=>$component_access_token
        );

        $postdata = array(
            'component_appid'=>C('component_appId'),
            'authorization_code'=>$auth_code
        );

        $postdata = json_encode($postdata);
    //            echo $postdata;
        $url = "{$this->apiURL}/api_query_auth";
    //            $res = json_decode($this->httpGet($url));
        $res = self::http($url, $param, $postdata, 'POST');
        $data = json_decode($res);
        $authorizer_appid = $data->authorization_info->authorizer_appid;
        $authorizer_access_token = $data->authorization_info->authorizer_access_token;
        $authorizer_refresh_token = $data->authorization_info->authorizer_refresh_token;
        $func_info = $data->authorization_info->func_info;
        if ($authorizer_appid) {
            //
            //需要存入本地
            //
            //
//                $data->expire_time = time() + 1600;
//                $data->authorizer_appid = $authorizer_appid;
                
                $fp = fopen("$authorizer_appid.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
          }
       return $authorizer_appid; 
  }
  
  
  
    
    
    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
      }
      
      /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url    请求URL
     * @param  array  $param  GET参数数组
     * @param  array  $data   POST的数据，GET请求时该参数无效
     * @param  string $method 请求方法GET/POST
     * @return array          响应数据
     */
    protected static function http($url, $param, $data = '', $method = 'GET'){
        
//        print_r($data);
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        /* 根据请求类型设置特定参数 */
        $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);
        
//        echo $opts[CURLOPT_URL];

        if(strtoupper($method) == 'POST'){
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $data;
            
            if(is_string($data)){ //发送JSON数据
                $opts[CURLOPT_HTTPHEADER] = array(
                    'Content-Type: application/json; charset=utf-8',  
                    'Content-Length: ' . strlen($data),
                );
            }
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        //发生错误，抛出异常
        if($error) throw new \Exception('请求发生错误：' . $error);
        return  $data;
    }
    
    
    
}
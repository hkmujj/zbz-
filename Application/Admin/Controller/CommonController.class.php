<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    public $data_param;
    
    /*
     * 初始化的功能
     */
    
    public function _initialize() {
        $site_config['title'] =  "珍宝斋书画租赁平台";
        $site_config['menu_position'] = CONTROLLER_NAME."_".ACTION_NAME;
        $site_config['first_nav'] = C(CONTROLLER_NAME);
        $site_config['second_nav'] =C(CONTROLLER_NAME."_".ACTION_NAME);
        
        $this->assign("site_config", $site_config); //公共的网站配置
        
        $this->assign("resource_path", C("resource_path"));  //静态资源路径
        
        $this->request_param();
        
        
    }
    
    
    /*
     * 系统注销
     */
    public function logout() {
        session(null);
        
        redirect(U('Users/login'));
        
    }
    
    
    /*
     * 空白页测试
     */
    public function blank() {
        $this->display();
    }
    
    
    /*
     * 判断是否登录
     */
    public function chk_if_login() {
        if(!session("?admin"))
        {
            redirect(U('Users/login'));
        }
    }
    
    /**
     将base64信息转化为图片并返回图片地址
     */
    public function _conversion_base64($base64_url){
        $base64_url = str_replace(' ', '+', $base64_url);//post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_url, $result)){
            //匹配成功
            $frommat = ($result[2] == 'jpeg')? 'jpg' : $result[2];//获取图片后缀
            $imageName = $this->_create_random_code(20).date('Ymd',I('server.REQUEST_TIME')).'.'.$frommat;
            $patch = 'Uploads/'.date('Y-m-d',time()).'/';
            if(!is_dir($patch)){
                mkdir($patch,0777);
            }
            $image_patch = $patch.$imageName;
            if (file_put_contents($image_patch, base64_decode(str_replace($result[1], '', $base64_url)))){
                return $image_patch;
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }
    
    /*
     * 生成随机码
    */
    public function _create_random_code($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
         $str .= $strPol[rand(0,$max)];
         //rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
    
    /*
     * 解析提交的参数
     */
    protected function request_param() {
        $str = $this->get_url();
        $data = (parse_url($str));
        if(empty($data['query'])){
            $this->data_param = $_POST;
        }else{
            $this->data_param = $_GET;
            if(!empty($_POST)){
                foreach ($_POST as $key => $value) {
                    # code...
                    $this->data_param[$key] = $value;
                }
            }   
        }
    }
    
    
    /**
    * 获取当前页面完整URL地址
    */
    protected function get_url() {
       $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
       $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
       $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
       $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
       return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }
    
    /*
     * 上传图片
     */

    public function upload_img() {
        if (isset($_FILES['fileList'])) {
            $rebackImgurl = '/Uploads/' . $this->upload($_FILES['fileList']);
        } else {

            $rebackImgurl = '/Uploads/' . $this->upload($_FILES['fileselect']);
        }
        
        //存入数据库
        $data['thumb'] = $rebackImgurl;
        $data['img_url'] = $rebackImgurl;
        $data['ctime'] = NOW_TIME;
        $imageid = M("images")->add($data);
        
        
        //开启图片的剪切
//        $this->image_size_reducer('.' . $rebackImgurl);

        echo $imageid;
    }
    
    /**
      图片上传
     */
    private function upload($files) {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 524288000000; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', "*", "PNG", "JPG", "JPEG"); // 设置附件上传类型
        $upload->savePath = ''; // 设置附件上传目录
        // 上传文件 
        $info = $upload->uploadOne($files);
        if (!$info) {
            // 上传错误提示错误信息    
            $this->error($upload->getError());
        } else {
            // 上传成功 获取上传文件信息    
            return $info['savepath'] . $info['savename'];
        }
    }

    /**
     * 图片等比例压缩方法
     */
    private function image_size_reducer($imgUrl) {

        $image = new \Think\Image();

        $image->open($imgUrl);
        //获取字符串的后缀
        $houzhui = substr(strrchr($imgUrl, '.'), 1);
        //获取图片名
        $fileName = basename($imgUrl, "." . $houzhui) . "." . $houzhui;
        //获取图片的保存路径
        $savePath = dirname($imgUrl) . "/" . $fileName;
        // echo $savePath; die;
        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
        $image->thumb(800, 800)->save($savePath);
    }
    
}
<?php

namespace Admin\Controller;

use Think\Controller;

class UsersController extends CommonController {

    /*
     * 登录页面
     */
    public function login() {
        if(IS_POST)
        {
            $username = I("post.username");
            $password = I("post.password");
            
            if(($username=="admin") && $password=="zbzysg2017")
            {
                session("admin","admin");
                $this->success("登录成功",(U('Setting/dashboard')));
//                redirect(U('Setting/dashboard'));
            }
            else
            {
                $this->error("帐号密码不匹配",(U('Users/login')));
            }
        }
        else
        {
            $this->display();
        }
        
    }
    
    
    

}

<?php

return array(
    //'配置项'=>'配置值'
    //数据库配置
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
    'DB_NAME' => 'zbz',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PREFIX' => 'zbz_',
    'debug' => 0,
    'LOAD_EXT_CONFIG' => array(
        'WECHAT' => 'wechat',
    ),
    //短信通道
    'alisms_regionId' => 'cn-hangzhou',
    'alisms_accessKeyId' => 'LTAIIX357wUQcuKu',
    'alisms_accessSecret' => 'jAOtN4T6NvMcj6q48R944eQE3QVl8t',
    /*
     * 短信的模板
     * 
     * 注册短信
     * 验证码${code}，您正在注册成为${product}用户，感谢您的支持！
     */
    'alisms_signname1' => '珍宝斋',
    'alisms_templateCode1' => 'SMS_58750075',
    /*
     * 短信的模板
     * 
     * 找回密码短信
     * 验证码${code}，您正在尝试修改${product}登录密码，请妥善保管账户信息。
     */
    'alisms_signname2' => '珍宝斋',
    'alisms_templateCode2' => 'SMS_58750073',
    /*
     * 短信的模板
     * 
     * 租期到期提醒
     */
    'alisms_signname3' => '珍宝斋',
    'alisms_templateCode3' => 'SMS_61010311',
);

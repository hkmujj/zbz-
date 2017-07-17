<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function index() {
//        echo "官网的首页";
//        $db = M("members");
        $db = M("pc_banners");
        $res = $db->order("ctime desc")->select();
        $this->assign('banners', $res);

        //获取首页的推广缩略图
        $res1 = M("pc_index_img_lists")->where(array("keywords" => "left_img"))->find();
        $this->assign("img1", $res1);

        $res2 = M("pc_index_img_lists")->where(array("keywords" => "middle_img"))->find();
        $this->assign("img2", $res2);

        $res3 = M("pc_index_img_lists")->where(array("keywords" => "right_img"))->find();
        $this->assign("img3", $res3);

        $this->display();
    }

    /*
     * 关于我们页面
     */

    public function aboutus() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */

        $db = M("pc_pages");
        $map['type'] = 1; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    /*
     * 公司简介页面
     */

    public function profile() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */


        $db = M("pc_pages");
        $map['type'] = 2; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    /*
     * 荣誉资质页面
     */

    public function honor() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */



        $db = M("pc_pages");
        $map['type'] = 3; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    /*
     * 专家及艺术家团队页面
     */

    public function team() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */


        $db = M("pc_pages");
        $map['type'] = 4; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    /*
     * 专利证书页面
     */

    public function patent() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */


        $db = M("pc_pages");
        $map['type'] = 5; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    /*
     * 发展历程页面
     */

    public function history() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */


        $db = M("pc_pages");
        $map['type'] = 6; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        print_r($res);
//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    public function about_us() {
        /*
         * 1. 链接数据库,获取指定的内容 不如type=1 为关于我们的内容
         * 
         * 
         * 
         */

        $db = M("pc_pages");
        $map['type'] = 1; //定义查询条件
        //获取结果
        $res = $db->where($map)->find();


//        html_entity_decode($result['content']);
        //赋值
        $this->assign("result", $res);

        $this->display(); // 加载视图页面,默认 aboutus.html  如果要加载其他页面则是 $this->display("the_other_page");
    }

    public function artist() {

        $this->display();
    }
    
    /*
     * 艺术家详情
     * 根据艺术家的id来关联作品
     * 
     */

    public function artist_detail() {
        $artist_id = I("get.artist_id");
        
        if(!empty($artist_id))
        {
            $map['artist_id'] = $artist_id;
            $res = M("works")->where($map)->select();

            $this->assign("works", $res);
            $this->display();
        }
        
    }

    public function news() {
        $db = M("pc_news");
        $res = $db->limit(10)->order("ctime desc")->select();
        $this->assign("reimg", $res);


        $this->display();
    }

    public function news_detail() {

        $id = I("get.id");

        $res = M("pc_news")->find($id);

        $this->assign("result", $res);

        $this->display();
    }

}

<?php

namespace M\Controller;

use Think\Controller;

class SearchController extends CommonController {

    public function index() {

        $db = M("setting_keywords");
        $map['type'] = 0;
        $res_promotion_keywords = $db->order("ctime desc")->where($map)->select();
        $this->assign("promotions", $res_promotion_keywords);

        $map['type'] = 1;
        $res_hot_keywords = $db->order("ctime desc")->where($map)->select();
        $this->assign("hots", $res_hot_keywords);


        $this->display();
    }

    /*
     * 搜索结果呈现
     * 
     */

    public function result() {
        $keywords = I("get.keywords");

        if (!empty($keywords)) {
            /*
             * 线下画廊
             * 
             */
            $map1['gallery_name'] = array("like","%$keywords%");
            $result1 = M("galleries")->where($map1)->select();
            
            
            $this->assign("result1", $result1);
            
            
            /*
             * 艺术家
             */
            
            $map2['artist_name'] = array("like","%$keywords%");
            $result2 = M("artists")->where($map2)->select();
            
            
            $this->assign("result2", $result2);
            
            
            /*
             * 作品
             */
            
            
            $map3['name'] = array("like","%$keywords%");
            $result3 = M("works")->where($map3)->select();
            
            
            $this->assign("result3", $result3);

            $this->display();
        } else {
            redirect(U('index'));
        }
    }

}

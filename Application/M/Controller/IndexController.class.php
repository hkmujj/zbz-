<?php

namespace M\Controller;

use Think\Controller;

class IndexController extends CommonController {

    //public function index(){
//        echo "用户信息:";
    //  print_r($this->memberinfo);
//        echo "<br/><br/><br/><br/><br/><br/><br/>";
//        var_dump(session());
//        $this->display();
//        $id =$this->add_page_view_log(1, 1, 1, 1);
    //}





    /* 首页 */
    public function index() {
        
        $this->chk_if_login_daily($this->memberinfo['mid']);

        if(isset($_GET['cityid'])) {
            $data['cityid'] = I("get.cityid");
            M("members")->where("mid=" . $this->memberinfo['mid'])->save($data);

            //加载城市
            $cityname = M("cities")->where("id=".I("get.cityid"))->find();
            $this->assign("cityname",$cityname['city']);
        }
        else{
            //加载城市
            $cityname = M("cities")->where("id=".$this->memberinfo['cityid'])->find();
            $this->assign("cityname",$cityname['city']);
        }
        //获取banner
        $bannersModel = new \Admin\Model\BannersModel();
        $res_banner = $bannersModel->get_all('ctime', 1);

        $this->assign("banners", $res_banner);

        //首页的其他展示
        $data['rent'] = M("setting_mobile_index")->find(1);
        $data['buy'] = M("setting_mobile_index")->find(2);
        $data['show'] = M("setting_mobile_index")->find(3);

        $this->assign("index_setting", $data);
        
        //获取中国画和西洋画的分类
        $dbModel = M("work_categories");
        $res_cat1 = $dbModel->where(array('pid'=>0))->order("ctime desc")->select();
        
        $res_cat2 = $dbModel->where(array('pid'=>1))->order("ctime desc")->select();
        
        $this->assign("cat1", $res_cat1);
        $this->assign("cat2", $res_cat2);
        
        //加载装饰风格
        $db = M("setting_mobile_index_showtype");
        $showtype_res = $db->order("rank DESC")->select();
        
        $this->assign("show_types", $showtype_res);
        
        
        /*
         * 获取艺术家数据
         */
        $artists = M("artists")->where()->order("view_count desc")->select();
        $this->assign("artists", $artists);

        
        $this->display();
    }

    /*
     * 更新用户的地理位置信息
     */

    public function update_mid_location() {
        $lng = I("post.lng");
        $lat = I("post.lat");
        $mid = $this->memberinfo['mid'];

        $data['lng'] = $lng;
        $data['lat'] = $lat;

        M("members")->where("mid=" . $mid)->save($data);

        $res['err'] = 0;
        $res['msg'] = "ok";

        echo json_encode($res);
    }

    /*
     * 
     *  ############################## 扫一扫  ##############################
     */

    public function scan() {

        $this->display();
    }

    /*
     * 
     *  ############################## 扫一扫 end  ##############################
     */


    /*
     * 
     *  ############################## 定位  ##############################
     */

    public function city_pick() {
        
        $cities = M("cities")->select();
        
        $this->assign("cities", $cities);
        
        $this->display();
    }

    /*
     * 
     *  ############################## 定位 end  ##############################
     */


    /*
     * 
     *  ############################## 新闻资讯  ##############################
     */

    public function news_lists() {
        $dbModel = new \M\Model\NewsModel();
        $res = $dbModel->get_all('news_id', 1);
        $this->assign("results", $res);

        $this->display();
    }

    public function news_detail() {
        $id = I("get.id");
        $dbModel = new \M\Model\NewsModel();
        $res = $dbModel->get_one($id);
        $this->assign("news", $res);

        $this->add_page_view_log($this->memberinfo['mid'], 0, 0, $id);


        $title = $res['title'];
        $desc = $res['brief'];
        $link = "http://" . $_SERVER['HTTP_HOST'] . U('M/Index/news_detail', array('id' => $id));
        $thumb = "http://" . $_SERVER['HTTP_HOST'] . "/logo.jpg";

        $title_all = $res['title'];
        $desc_all = $res['brief'];
        $link_all = "http://" . $_SERVER['HTTP_HOST'] . U('M/Index/news_detail', array('id' => $id));
        $thumb_all = "http://" . $_SERVER['HTTP_HOST'] . "/logo.jpg";


        $this->get_basic_share_info($title, $desc, $link, $thumb, $title_all, $desc_all, $link_all, $thumb_all);

//        print_r($res);
        $this->display();
    }

    /*
     * 
     *  ############################## 新闻资讯 end  ##############################
     */

    public function show_me() {
        var_dump($this->memberinfo);
    }

}

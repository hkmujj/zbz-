<?php

namespace M\Controller;

use Think\Controller;

class WorkController extends CommonController {

    public function index() {
        echo "用户信息:";
        print_r($this->memberinfo);
        echo "<br/><br/><br/><br/><br/><br/><br/>";
        var_dump(session());
    }
    
    
    
    
    /*
     * 买画
     */
    public function buy() {
        
        if(isset($_GET['cat_choose']))
        {
            
            $dbModel = new \M\Model\WorksModel();
            
            $res = $dbModel->work_filter_manual_buy($_GET);
            $this->assign("works", $res);
//            echo json_encode($res);
            
            $rank_type = isset($this->data_param['rank_type'])?$this->data_param['rank_type']:0;
            $this->assign("rank_type", $rank_type);
            $this->get_work_param();
            $this->display("buy_filter");
            
        }
        else
        {
           /*
            * 获取前20个作品
            */


           $dbModel = new \M\Model\WorksModel();
           $res = $dbModel->get_top_20($this->data_param);

           $this->assign("works", $res);
   //        print_r($this->data_param);
           $rank_type = isset($this->data_param['rank_type'])?$this->data_param['rank_type']:0;
           $this->assign("rank_type", $rank_type);

           $this->get_work_param();
           $cat_id = I("get.cat_id");
           $this->assign("cat_id", $cat_id);

           $this->display(); 
        }
        
        
    }
    
    
    /*
     * 租画
     */
    public function rent() {
        
        if(isset($_GET['cat_choose']))
        {
            
            $dbModel = new \M\Model\WorksModel();
            
            $res = $dbModel->work_filter_manual_rent($_GET);
            $this->assign("works", $res);
//            echo json_encode($res);
            
            $rank_type = isset($this->data_param['rank_type'])?$this->data_param['rank_type']:0;
            $this->assign("rank_type", $rank_type);
            $this->get_work_param();
            $this->display("rent_filter");
            
        }
        else
        {
           $dbModel = new \M\Model\WorksModel();
            $res = $dbModel->get_top_rent_20($this->data_param);

            $this->assign("works", $res);
    //        print_r($this->data_param);
            $rank_type = isset($this->data_param['rank_type'])?$this->data_param['rank_type']:0;
            $this->assign("rank_type", $rank_type);

            $this->get_work_param();
            $cat_id = I("get.cat_id");
           $this->assign("cat_id", $cat_id);
            $this->display(); 
        }
        
    }
    
    
    public function show_type() {
        
        $sid = I("get.id");
        $this->assign("sid", $sid);
        
        $db = M("setting_mobile_index_showtype");
        $showtype_res = $db->order("rank DESC")->select();
        
        $this->assign("show_types", $showtype_res);
        
        $this->display();
    }
    
    /*
     * 获取画的列表信息
     */
    public function get_works() {
        $pagecount = I("get.pagecount");
        $cat_id = I("get.cat_id");
        if(empty($cat_id))
        {
            $cat_id=0;
        }
        
        $newsModel = new \M\Model\WorksModel();
        $res = $newsModel->get_lists_by_page($pagecount,$cat_id);
        
        if(!empty($res))
        {
            $data['err']=0;
            $data['content'] = $res;
        }
        else
        {
            $data['err']=1;
            $data['msg']  = "没有更多数据";
        }

        echo json_encode($data);
        
    }
    
    public function get_works_show_type() {
        $sid= I("get.sid");
        $pagecount = I("get.pagecount");
        $newsModel = new \M\Model\WorksModel();
        $res = $newsModel->get_showtype_lists_by_page($pagecount,$sid);
        
        if(!empty($res))
        {
            $data['err']=0;
            $data['content'] = $res;
        }
        else
        {
            $data['err']=1;
            $data['msg']  = "没有更多数据";
        }

        echo json_encode($data);
        
    }

    

    /**
     * 生成随机验证码
     * @return  string
     */
    protected function random_order_sn() {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        return date("Ymd", NOW_TIME) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }
    
    
    /*
     * 推广链接显示
     */
    public function promotion() {
        $id = I("get.id");
        $newsModel = new \M\Model\WorksModel();
        $res = $newsModel->get_one($id);
        
        /*
         * 增加看的人气
         */
        M("works")->where("work_id = $id")->setInc("view_count");
        
        //获取题材和分类
        $res['work_cat_name'] = $this->get_work_cat($res['cat_id']);
        
        $res['work_topic_name'] = $this->get_work_topic($res['topic_id']);
        
        $this->assign("work", $res);
        
        //获取艺术家信息
        
        $dbModel = new \M\Model\ArtistsModel();
        $res_artist = $dbModel->find($res['artist_id']);
        
        $this->assign("artist", $res_artist);
        
        //判断收藏关系
        $mid = $this->memberinfo['mid'];
        $chk_focus = $this->chk_if_collected($mid, $id);
        
        $chk_focus_result = ($chk_focus>0)?"1":"0";

        $this->assign("ifcollection",$chk_focus_result);
        
        
        
        
        $this->display();
//        echo $work_id;
    }
    // 详情页面
    public function detail() {
        $type = I("get.type");
        
        if($type=="rent")
        {
            $this->assign('order_type', 1);
        }
        else
        {
            $this->assign('order_type', 0);
        }
        $id = I("get.id");
        $newsModel = new \M\Model\WorksModel();
        $res = $newsModel->get_one($id);
        
        /*
         * 增加看的人气
         */
        M("works")->where("work_id = $id")->setInc("view_count");
        
        //获取题材和分类
        $res['work_cat_name'] = $this->get_work_cat($res['cat_id']);
        
        $res['work_topic_name'] = $this->get_work_topic($res['topic_id']);
        
        $this->assign("work", $res);
        
        //获取艺术家信息
        
        $dbModel = new \M\Model\ArtistsModel();
        $res_artist = $dbModel->find($res['artist_id']);
        
        $this->assign("artist", $res_artist);
        
        //判断收藏关系
        $mid = $this->memberinfo['mid'];
        $chk_focus = $this->chk_if_collected($mid, $id);
        
        $chk_focus_result = ($chk_focus>0)?"1":"0";

        $this->assign("ifcollection",$chk_focus_result);
        
        
        //获取公用的 保养指南
        $res_maintain = M("setting_mobile_pages")->where(array('keywords'=>"maintain"))->find();
        $this->assign("maintain", $res_maintain);
        
        
        $this->display();
    }
    
    /*
     * 收藏作品
     * 
     * 1.未关注变成已关注
     * 2. 已关注不变
     * 3. 已关注变成未关注
     * 
     * 
     */

    public function collection() {
        $work_id = I("post.id");
        $status = I("post.status");
        $db = M("member_collection_record");

        $mid = $this->memberinfo['mid'];

        $chk_focus = $this->chk_if_collected($mid, $work_id);

        if ($status == 1) {
            //关注某人


            if ($chk_focus) {
                $res['err'] = 0;
                $res['msg'] = "成功关注";
            } else {
                $data['status'] = 1;
                $data['mid'] = $mid;
                $data['work_id'] = $work_id;
                $data['ctime'] = NOW_TIME;
                $data['ctime_date'] = date("Ymd", NOW_TIME);

                $id = $db->add($data);
                if ($id) {
                    $this->modify_work_collection_count($work_id, $status);
                }

                $res['err'] = 0;
                $res['msg'] = "成功收藏";
            }
        } else {
            //取消关注
            if ($chk_focus) {
                $data_new['status'] = 0;
                $db->where("id = $chk_focus")->save($data_new);


                $this->modify_work_collection_count($work_id, $status);



                $res['err'] = 0;
                $res['msg'] = "已取消收藏";
            } else {
                //do nothing
                $res['err'] = 0;
                $res['msg'] = "已取消收藏";
            }
        }
        
        echo json_encode($res);
    }

    /*
     * 判断是否已经关注
     */

    public function chk_if_collected($mid, $work_id) {
        $db = M("member_collection_record");
        $map['mid'] = $mid;
        $map['work_id'] = $work_id;
        $res = $db->where($map)->order("ctime DESC")->find();

        if (!empty($res) && $res['status'] == 1) {
            return $res['id'];
        } else {
            return 0;
        }
    }
    
    /*
     * 对应作品的关注人数加减
     */

    public function modify_work_collection_count($work_id, $status) {
        if ($status == 1) {
            $db = M("works");
            $db->where("work_id = $work_id")->setInc("collection_count");
        } else {
            $db = M("works");
            $db->where("work_id = $work_id")->setDec("collection_count");
        }
    }
    
    /*
     * 作品的参数
     * 分类
     * 题材
     * 价格区间
     * 销售状态
     * 发货时间
     * 
     */
    public function get_work_param() {
        //加载分类 和 主题

        $categories = M("work_categories")->order("ctime desc")->select();

        $topics = M("work_topic")->order("ctime desc")->select();


        $this->assign("categories", $categories);
        $this->assign("topics", $topics);
        
    }
    
    
    /*
     * 显示装饰风格的内容
     * 
     * 进入某个分类后,得到该分类下面的所有图片的列表
     * 
     */
    public function paint_styles() {
        if(IS_AJAX)
        {
            
        }
        else
        {
            //加载装饰风格
            $db = M("setting_mobile_index_showtype");
            $showtype_res = $db->order("rank DESC")->select();

            $this->assign("show_types", $showtype_res);

            $id = I("get.id");
            $map['sid'] = $id;
            $res =M("setting_mobile_index_showtype_images")->where($map)->select();
            $this->assign("results", $res);
            
            $this->display();
        }
    }
    

}

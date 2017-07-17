<?php

namespace Admin\Controller;

use Think\Controller;

class WorksController extends CommonController {

    public function _initialize() {
        parent::_initialize();
        $this->chk_if_login();
    }

    /*
     * 列表
     * 
     */

    public function lists() {
        if (IS_AJAX) {
            
        } else {
            //加载分类 和 主题

            $categories = M("work_categories")->order("ctime desc")->select();

            $topics = M("work_topic")->order("ctime desc")->select();


            $this->assign("categories", $categories);
            $this->assign("topics", $topics);


            //加载艺术家
            $artists = M("artists")->select();
            $this->assign("artists", $artists);


            $galleries = M("galleries")->select();
            $this->assign("galleries", $galleries);

            $this->display();
        }
    }

    /*
     * 获取列表
     */

    public function get_lists() {
        $isearch = I("get.isearch");
        if ($isearch == 1) {
//            $this->data_param; // 获取的参数和值
            //搜索提交,判断提交过来的参数
            $newsModel = new \Admin\Model\WorksModel();
            $res = $newsModel->get_all_with_filter('ctime', 1, $this->data_param);
        } else {
            $newsModel = new \Admin\Model\WorksModel();
            $res = $newsModel->get_all('ctime', 1);
        }


        echo json_encode($res);
    }

    /*
     * 添加
     */

    public function add() {
        if (IS_POST) {
            $data['rank'] = I("post.rank");
            $data['cat_id'] = I("post.cat_id");
            $data['topic_id'] = I("post.topic_id");
            $data['name'] = trim(I('post.name'));
            $data['work_number'] = I('post.work_number');
            $data['buy_price'] = I('post.buy_price');
            $data['rent_price'] = I('post.rent_price');
            $data['shipping_time'] = I('post.shipping_time');
            $data['create_year'] = I('post.create_year');
            $data['wremarks'] = I('post.wremarks');
            $data['wwidth'] = I('post.wwidth');
            $data['wheight'] = I('post.wheight');
            $data['package_status'] = I('post.package_status');
            $data['artist_id'] = I('post.artist_id');
            $data['gallery_id'] = I('post.gallery_id');
            $data['description'] = I('post.description');
            $data['instruction'] = I('post.instruction');
            $data['wstatus'] = I('post.wstatus');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $data['utime'] = NOW_TIME;
            $data['utime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $dbModel = new \Admin\Model\WorksModel();
            $id = $dbModel->add_one($data);

            if ($id) {
                $dbModel2 = new \Admin\Model\ArtistsModel();
                $dbModel2->my_works_count_modify(I('post.artist_id'), 1);
            }

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {

            //加载分类 和 主题

            $categories = M("work_categories")->order("ctime desc")->select();

            $topics = M("work_topic")->order("ctime desc")->select();


            $this->assign("categories", $categories);
            $this->assign("topics", $topics);

            //加载艺术家
            $artists = M("artists")->select();
            $this->assign("artists", $artists);


            $galleries = M("galleries")->select();
            $this->assign("galleries", $galleries);



            $this->display();
        }
    }
    
    public function edit() {
        if (IS_POST) {
            $work_id = I("post.work_id");
            
            $data['rank'] = I("post.rank");
            $data['cat_id'] = I("post.cat_id");
            $data['topic_id'] = I("post.topic_id");
            $data['name'] = trim(I('post.name'));
            $data['work_number'] = I('post.work_number');
            $data['buy_price'] = I('post.buy_price');
            $data['rent_price'] = I('post.rent_price');
            $data['shipping_time'] = I('post.shipping_time');
            $data['create_year'] = I('post.create_year');
            $data['wremarks'] = I('post.wremarks');
            $data['wwidth'] = I('post.wwidth');
            $data['wheight'] = I('post.wheight');
            $data['package_status'] = I('post.package_status');
            $data['artist_id'] = I('post.artist_id');
            $data['gallery_id'] = I('post.gallery_id');
            $data['description'] = I('post.description');
            $data['instruction'] = I('post.instruction');
            $data['wstatus'] = I('post.wstatus');
//            $data['ctime'] = NOW_TIME;
//            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $data['utime'] = NOW_TIME;
            $data['utime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $dbModel = M("works");
            $id = $dbModel->where('work_id='.$work_id)->save($data);

//            if ($id) {
//                $dbModel2 = new \Admin\Model\ArtistsModel();
//                $dbModel2->my_works_count_modify(I('post.artist_id'), 1);
//            }

            json_out($id, '保存成功');
//            var_dump($_POST);
        } else {

            //加载分类 和 主题

            $categories = M("work_categories")->order("ctime desc")->select();

            $topics = M("work_topic")->order("ctime desc")->select();


            $this->assign("categories", $categories);
            $this->assign("topics", $topics);

            //加载艺术家
            $artists = M("artists")->select();
            $this->assign("artists", $artists);


            $galleries = M("galleries")->select();
            $this->assign("galleries", $galleries);
            
            //加载作品信息
            $work_id = I("get.work_id");
            $res = M("works")->find($work_id);
            $this->assign("work",$res);



            $this->display();
        }
    }

    /*
     * 查看详情
     */

    public function detail() {

        if (IS_POST) {
            
        } else {
            $id = I("get.work_id");
            $dbModel = new \Admin\Model\WorksModel();
            $res = $dbModel->get_one($id);

//            print_r($res);
            $this->assign('result', $res);
            $this->display();
        }
    }

    /*
     * 删除
     */

    public function del() {
        $id = I("post.id");

        $newsModel = new \Admin\Model\WorksModel();

        $res_old = $newsModel->get_one($id);

        $res = $newsModel->del_one($id);

        if ($res) {

            $dbModel2 = new \Admin\Model\ArtistsModel();
            $dbModel2->my_works_count_modify($res_old['artist_id'], 0);


            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    /*
     * 多图上传
     */

    public function images_upload() {
        if (IS_POST) {
            $work_id = I("post.work_id");
            $images_ids = I("post.imageid_ids");

            $images_ids = substr($images_ids, 1);

            $images_ids_arr = explode(",", $images_ids);
            $data['work_id'] = $work_id;
            foreach ($images_ids_arr as $key => $value) {

                M("images")->where("id=" . $value)->save($data);
            }

            json_out(1, "成功");
        } else {
            $work_id = I("get.work_id");
            $this->assign("work_id", $work_id);


//           获取当前图片
            $map['work_id'] = $work_id;
            $res = M("images")->where($map)->select();
            $this->assign("imgs", $res);

            $this->display();
        }
    }

    public function del_image() {
        $id = I("post.id");
        if($id)
        {
           M("images")->delete($id); 
        }
        json_out(1,"删除成功");
    }

    /*
     *  ########################################  作品的分类维护 #####################################################
     */

    public function cat_lists() {
        $this->display();
    }

    public function get_cat_lists() {
        $dbModel = M("work_categories");
        $res = $dbModel->order("ctime desc")->select();

        echo json_encode($res);
    }

    public function add_cat() {
        if (IS_POST) {
            $data['name'] = I('post.name');
            $data['ctime'] = NOW_TIME;
            $data['pid'] = I("post.pid");
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $dbModel = M("work_categories");
            $id = $dbModel->add($data);

            json_out($id, '添加成功');
        } else {
            $this->display();
        }
    }

    public function del_cat() {
        $id = I("post.cat_id");

        $dbModel = M("work_categories");

        $res = $dbModel->delete($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    public function topic_lists() {
        $this->display();
    }

    public function get_topic_lists() {
        $dbModel = M("work_topic");
        $res = $dbModel->order("ctime desc")->select();

        echo json_encode($res);
    }

    public function add_topic() {
        if (IS_POST) {
            $data['name'] = I('post.name');
            $data['ctime'] = NOW_TIME;

            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $dbModel = M("work_topic");
            $id = $dbModel->add($data);

            json_out($id, '添加成功');
        } else {
            $this->display();
        }
    }

    public function del_topic() {
        $id = I("post.topic_id");

        $dbModel = M("work_topic");

        $res = $dbModel->delete($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    /*
     *  ########################################  作品的分类维护 END #####################################################
     */


    /*
     * 作品的二维码地址
     */

    public function qrcode($url = 'http://zbzart.cn', $level = 3, $size = 8) {
        $work_id = I("get.work_id");

        if (!empty($work_id)) {
            $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';

            $new_url = $sys_protocal . $_SERVER['HTTP_HOST'] . U('M/Work/promotion', array('id' => $work_id));
            Vendor('phpqrcode.phpqrcode');
            $errorCorrectionLevel = intval($level); //容错级别 
            $matrixPointSize = intval($size); //生成图片大小 
            //生成二维码图片 
            //echo $_SERVER['REQUEST_URI'];
            $object = new \QRcode();
            $object->png($new_url, false, $errorCorrectionLevel, $matrixPointSize, 2);
//            echo $new_url;
        } else {
            Vendor('phpqrcode.phpqrcode');
            $errorCorrectionLevel = intval($level); //容错级别 
            $matrixPointSize = intval($size); //生成图片大小 
            //生成二维码图片 
            //echo $_SERVER['REQUEST_URI'];
            $object = new \QRcode();
            $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
        }
    }

    /*
     * 管理空间展示和产品的关系
     */

    public function work_with_showtype() {
        if (IS_AJAX) {
            $sid = I("sid");
            $db = M("setting_mobile_index_showtype_images");

            $map['sid'] = $sid;
            $res = $db->order("ctime desc")->where($map)->select();

            echo json_encode($res);
        } else {
            $sid = I("sid");
            $this->assign("sid", $sid);
            $this->display();
        }
    }

    public function del_work_with_showtype() {
        $id = I("post.id");

        $dbModel = M("setting_mobile_index_showtype_images");

        $res = $dbModel->delete($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    public function add_work_with_showtype() {
        if (IS_POST) {
            $sid = I("post.sid");
            
            
            $data['title'] = trim(I("post.title"));
            $data['rank'] = trim(I("post.rank"));
            $data['ctime'] = trim(I("post.rank"));
            $data['sid'] = trim(I("post.sid"));
            
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }

            $res = M("setting_mobile_index_showtype_images")->add($data);

            if ($res) {
                json_out($res, "添加成功");
            } else {
                json_out(0, "失败");
            }
        } else {
            $sid = I("sid");
            $this->assign("sid", $sid);
            $this->display();
        }
    }
    
    public function edit_work_with_showtype() {
        if (IS_POST) {
            $sid = I("post.sid");
            
            
            $data['title'] = trim(I("post.title"));
            $data['rank'] = trim(I("post.rank"));
            $data['ctime'] = trim(I("post.rank"));
            $data['sid'] = trim(I("post.sid"));
            
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }

            $res = M("setting_mobile_index_showtype_images")->where("id=")->save($data);

            if ($res) {
                json_out($res, "成功");
            } else {
                json_out(0, "失败");
            }
        } else {
            $id = I("get.id");
            $res = M("setting_mobile_index_showtype_images")->find($id);
            
            $this->assign("res", $res);
            $this->display();
        }
    }
    
    /*
     * 检查编号是否有重复
     */
    public function chk_work_number() {
        $work_number = trim(I("post.work_number"));
        $db = M("works");
        
        $map['work_number']  =$work_number;
        $res = $db->where($map)->find();
        
        if(!empty($res))
        {
            $ret['err'] = 1;
            $ret['msg'] = "请注意,该编号作品已经存在";
        }
        else
        {
            $ret['err'] = 0;
            $ret['msg'] = "";
        }
        
        echo json_encode($ret);
        
    }
    
    
    

}

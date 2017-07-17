<?php

namespace Admin\Controller;

use Think\Controller;

class GalleriesController extends CommonController {
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
            $this->display();
        }
    }

    /*
     * 获取列表
     */

    public function get_lists() {
        $isearch = I("get.isearch");
        if ($isearch == 1) {
            $newsModel = new \Admin\Model\GalleriesModel();
            $res = $newsModel->get_all_with_filter('ctime', 1, $this->data_param);
        } else {
            $newsModel = new \Admin\Model\GalleriesModel();
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
            $data['gallery_name'] = I('post.gallery_name');
            $data['brief'] = I('post.brief');
            $data['address'] = I('post.address');
            $data['lng'] = I('post.lng');
            $data['lat'] = I('post.lat');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $thumb2 = I('post.thumb2');
            if (!empty($thumb2)) {
                $new_img_url = $this->_conversion_base64($thumb2);
                if ( $new_img_url != false) {
                    $data['backgroudimg'] = '/' . $new_img_url;
                }
            }
            
            $newsModel = new \Admin\Model\GalleriesModel();
            $id = $newsModel->add_one($data);

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * 删除
     */

    public function del() {
        $id = I("post.gallery_id");

        $newsModel = new \Admin\Model\GalleriesModel();

        $res = $newsModel->del_one($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

}

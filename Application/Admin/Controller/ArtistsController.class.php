<?php

namespace Admin\Controller;

use Think\Controller;

class ArtistsController extends CommonController {
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
            $newsModel = new \Admin\Model\ArtistsModel();
            $res = $newsModel->get_all_with_filter('ctime', 1, $this->data_param);
        } else {
            $newsModel = new \Admin\Model\ArtistsModel();
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
            $data['artist_name'] = I('post.artist_name');
            $data['school'] = I('post.school');
            $data['view_count'] = I('post.view_count');
            $data['fellowed_count'] = I('post.fellowed_count');
            $data['video'] = I('post.video');
            $data['brief'] = I('post.brief');
            $data['one_word'] = I('post.one_word');
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
            if (!empty($thumb)) {
                $new_img_url2 = $this->_conversion_base64($thumb2);
                if ($new_img_url2 != false) {
                    $data['backgroudimg'] = '/' . $new_img_url2;
                }
            }
            $newsModel = new \Admin\Model\ArtistsModel();
            $artist_id = $newsModel->add_one($data);

            json_out($artist_id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * 删除
     */

    public function del() {
        $artist_id = I("post.artist_id");

        $newsModel = new \Admin\Model\ArtistsModel();

        $res = $newsModel->del_one($artist_id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }
    
    /*
     * 修改
     * 
     */
    public function edit() {
        if(IS_POST)
        {
            $data['artist_id'] = I('post.artist_id');
            $data['artist_name'] = I('post.artist_name');
            $data['school'] = I('post.school');
            $data['view_count'] = I('post.view_count');
            $data['fellowed_count'] = I('post.fellowed_count');
            $data['video'] = I('post.video');
            $data['brief'] = I('post.brief');
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
            if (!empty($thumb)) {
                $new_img_url2 = $this->_conversion_base64($thumb2);
                if ($new_img_url2 != false) {
                    $data['backgroudimg'] = '/' . $new_img_url2;
                }
            }
            $newsModel = new \Admin\Model\ArtistsModel();
            $artist_id = $newsModel->save_one($data);

            json_out($artist_id, '保存成功');
        }
        else
        {
            $artist_id = I("get.artist_id");
            $newsModel = new \Admin\Model\ArtistsModel();
            $res = $newsModel->get_one($artist_id);
            
            $this->assign("artist", $res);
            $this->display();
        }
    }
    
    
    
    

}

<?php

namespace Admin\Controller;

use Think\Controller;

class CouponsController extends CommonController {
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
     * 获取会员积分记录列表
     */

    public function get_record_lists() {
        $dbModel = M("member_coupons_record");

        $res = $dbModel->order("ctime DESC")
                ->field("zbz_members.nickname,zbz_member_coupons_record.*")
                ->join("LEFT JOIN __MEMBERS__ ON __MEMBERS__.mid=__MEMBER_COUPONS_RECORD__.mid")
                ->select();

        echo json_encode($res);
    }

    /*
     * 获取列表
     */

    public function get_lists() {
        $dbModel = new \Admin\Model\CouponsModel();
        $res = $dbModel->get_all('ctime', 1);

        echo json_encode($res);
    }
    
    /*
     * 添加
     */

    public function add() {
        if (IS_POST) {

            $data['coupon_name'] = I('post.coupon_name');
            $data['coupon_name_cn'] = I('post.coupon_name_cn');
            $data['view_count'] = I('post.view_count');
            $data['coupon_value'] = I('post.coupon_value');
            $data['coupon_limit'] = I('post.coupon_limit');
            $data['coupon_type'] = 1;
            $data['coupon_credit'] = I('post.coupon_credit');
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
                $new_img_url2 = $this->_conversion_base64($thumb2);
                if ($new_img_url2 != false) {
                    $data['thumb_jifen'] = '/' . $new_img_url2;
                }
            }
            
            $newsModel = new \Admin\Model\CouponsModel();
            $id = $newsModel->add_one($data);

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * edit
     * 修改任务的积分奖励
     * 
     */

    public function edit() {
        if(IS_POST) {
            $coupon_id = I("post.coupon_id");

            $coupon_credit = I("post.coupon_credit");

            $data['coupon_id'] = $coupon_id;
            $data['coupon_credit'] = $coupon_credit;

            $dbModel = new \Admin\Model\CouponsModel();
            $id = $dbModel->save_one($data);

            $output['err'] = 0;
            $output['msg'] = "成功";

            echo json_encode($output);
        } else {
            $id = I("get.id");
            $dbModel = new \Admin\Model\CouponsModel();
            $res = $dbModel->get_one($id);

            $this->assign("result", $res);

            $this->display();
        }
    }

    /*
     * 配置
     */

    public function setting() {
        $this->display();
    }
    
     /*
     * 删除
     */

    public function del() {
        $id = I("post.coupon_id");

        $newsModel = new \Admin\Model\CouponsModel();

        $res = $newsModel->del_one($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

}

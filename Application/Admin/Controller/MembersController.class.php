<?php

namespace Admin\Controller;

use Think\Controller;

class MembersController extends CommonController {

    public function _initialize() {
        parent::_initialize();
        $this->chk_if_login();
    }

    /*
     * 会员列表
     */

    public function lists() {


        $this->display();
    }

    public function get_members_list() {


        $isearch = I("get.isearch");
        if ($isearch == 1) {
//            $this->data_param; // 获取的参数和值
            //搜索提交,判断提交过来的参数
            $newsModel = new \Admin\Model\MembersModel();
            $members = $newsModel->get_all_with_filter('ctime', 1, $this->data_param);
        } else {
            $memberModel = new \Admin\Model\MembersModel();
            $members = $memberModel->get_all('ctime', 1);
        }

        echo json_encode($members);
    }

    /*
     * 查看详情
     */

    public function detail() {

        if (IS_POST) {
            
        } else {
            $mid = I("get.mid");
            $memberModel = new \Admin\Model\MembersModel();
            $res = $memberModel->get_one($mid);

//            print_r($res);
            $this->assign('member', $res);
            $this->display();
        }
    }

    /*
     * 积分详情
     */

    public function record_credit() {
        $map['mid'] = I("get.mid");
        $res = M("member_credit_task_record")->order("ctime desc")->where($map)->select();

        $this->assign("lists", $res);
        $this->display();
    }

    /*
     * 代金券详情
     */

    public function record_coupons() {
        $map['mid'] = I("get.mid");
        $res = M("member_coupons_record")->order("ctime desc")->where($map)->select();

        $this->assign("lists", $res);
        $this->display();
    }

    /*
     * 用户收藏行为
     * 显示用户的
     */

    public function collection() {
        if (IS_AJAX) {
            $db = M("member_collection_record");
            
//            $map['zbz_member_collection_record']
            $res = $db->field("zbz_members.nickname,zbz_members.mobile,zbz_works.thumb,zbz_works.name,zbz_artists.artist_name,zbz_member_collection_record.ctime_date,zbz_member_collection_record.id")
                    ->join("left join zbz_works on  zbz_works.work_id = zbz_member_collection_record.work_id")
                    ->join("left join zbz_artists on  zbz_artists.artist_id = zbz_works.artist_id")
                    ->join("left join zbz_members on  zbz_members.mid = zbz_member_collection_record.mid")
                    ->order("ctime_date desc")->select();

        echo json_encode($res);
        } else {
            $this->display();
        }
    }

    /*
     * 用户关注行为
     */
    public function focus() {
        if (IS_AJAX) {
            $db = M("member_focus_record");
            
//            $map['zbz_member_collection_record']
            $res = $db->field("zbz_members.nickname,zbz_members.mobile,zbz_artists.artist_name,zbz_member_focus_record.ctime_date,zbz_member_focus_record.id")
                    ->join("left join zbz_artists on  zbz_artists.artist_id = zbz_member_focus_record.artist_id")
                    ->join("left join zbz_members on  zbz_members.mid = zbz_member_focus_record.mid")
                    ->order("ctime_date desc")->select();

        echo json_encode($res);
        } else {
            $this->display();
        }
    }
}

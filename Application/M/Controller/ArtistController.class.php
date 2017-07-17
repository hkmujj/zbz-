<?php

namespace M\Controller;

use Think\Controller;

class ArtistController extends CommonController
{

    public function index()
    {
        echo "艺术家页面";
    }

    /*
     * 列表
     */

    public function lists()
    {
        $newsModel = new \M\Model\ArtistsModel();
        $res = $newsModel->get_all('artist_id', 1);

        $this->assign("artists", $res);
        $this->display();
    }

    /*
     * 详情
     */

    public function detail()
    {
        $id = I("get.id");
        if (empty($id)) {
            echo "参数错误";
            exit();
        }
        
        $from_src = I("get.from_src");
        
        if(!empty($from_src))
        {
            $this->assign("from_src",1);
            
        }
        else
        {
            $this->assign("from_src", 0);
        }
        $newsModel = new \M\Model\ArtistsModel();

        $res = $newsModel->get_one($id);
        $this->assign("artist", $res);
        
       
        


        //获取作品列表
        $dbModel = new \M\Model\WorksModel();
        $res_works = $dbModel->get_all_by_artist_id('work_id', 1, $id);
        $this->assign("works", $res_works);

        //判断关注关系
        $mid = $this->memberinfo['mid'];
        $chk_focus = $this->chk_if_focused($mid, $id);

        $chk_focus_result = ($chk_focus > 0) ? "1" : "0";

        $this->assign("iffocus", $chk_focus_result);


        $this->display();
    }

    /*
     * 关注作家
     * 
     * 1.未关注变成已关注
     * 2. 已关注不变
     * 3. 已关注变成未关注
     * 
     * 
     */

    public function focus()
    {
        $artist_id = I("post.id");
        $status = I("post.status");
        $db = M("member_focus_record");

        $mid = $this->memberinfo['mid'];

        $chk_focus = $this->chk_if_focused($mid, $artist_id);

        if ($status == 1) {
            //关注某人


            if ($chk_focus) {
                $res['err'] = 0;
                $res['msg'] = "成功关注";
            } else {
                $data['status'] = 1;
                $data['mid'] = $mid;
                $data['artist_id'] = $artist_id;
                $data['ctime'] = NOW_TIME;
                $data['ctime_date'] = date("Ymd", NOW_TIME);

                $id = $db->add($data);
                if ($id) {
                    $this->modify_artist_focus_count($artist_id, $status);
                }

                $res['err'] = 0;
                $res['msg'] = "成功关注";
            }
        } else {
            //取消关注
            if ($chk_focus) {
                $data_new['status'] = 0;
                $db->where("id = $chk_focus")->save($data_new);


                $this->modify_artist_focus_count($artist_id, $status);


                $res['err'] = 0;
                $res['msg'] = "已取消关注";
            } else {
                //do nothing
                $res['err'] = 0;
                $res['msg'] = "已取消关注";
            }
        }

        echo json_encode($res);
    }

    /*
     * 判断是否已经关注
     */

    public function chk_if_focused($mid, $artist_id)
    {
        $db = M("member_focus_record");
        $map['mid'] = $mid;
        $map['artist_id'] = $artist_id;
        $res = $db->where($map)->order("ctime DESC")->find();

        if (!empty($res) && $res['status'] == 1) {
            return $res['id'];
        } else {
            return 0;
        }
    }

    /*
     * 对应的艺术家的关注人数加减
     */

    public function modify_artist_focus_count($artist_id, $status)
    {
        if ($status == 1) {
            $db = M("artists");
            $db->where("artist_id = $artist_id")->setInc("fellowed_count");
        } else {
            $db = M("artists");
            $db->where("artist_id = $artist_id")->setDec("fellowed_count");
        }
    }

}

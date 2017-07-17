<?php

namespace M\Controller;

use Think\Controller;

class GalleryController extends CommonController
{
    public function index()
    {
        echo "线下画廊页面";
    }

    /*
     * 线下画廊列表
     */
    public function lists()
    {
        $newsModel = new \M\Model\GalleriesModel();
        $res = $newsModel->get_all('rank', 1);

        $this->assign("galleries", $res);
        $this->display();
    }

    /*
     * 线下画廊详情
     */
    public function detail()
    {
        $id = I("get.id");
        if (empty($id)) {
            echo "参数错误";
            exit();
        }
        $newsModel = new \M\Model\GalleriesModel();

        $res = $newsModel->get_one($id);
        $this->assign("gallery", $res);


        //获取作品的列表
        $dbModel = M("works");
        $map['gallery_id'] = $id;
        $ress = $dbModel->where($map)->order("ctime desc")->select();

        $this->assign("works", $ress);

        $this->display();
    }

    /*
     * 线下画廊地图
     */
    public function map()
    {
        $id = I("get.id");
        if (empty($id)) {
            echo "参数错误";
            exit();
        }
        $newsModel = new \M\Model\GalleriesModel();

        $res = $newsModel->get_one($id);

        $this->assign("gallery", $res);

        $this->display();
    }


}
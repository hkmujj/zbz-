<?php

/*
 * 在 Model 里边组合数据,然后 Controller 再调用
 * 
 * 常见的功能有
 * 1. 获取所有记录（排序条件）
 * 2. 获取单条记录
 * 
 * 
 */

namespace M\Model;

use Think\Model;

class WorksModel extends Model {
    /*
     * 获取所有记录
     */

    public function get_all($order_by = "work_id", $order = 0) {
        if ($order == 0) {
            //ASC
            $order_str = "$order_by ASC";
        } else {
            //DESC
            $order_str = "$order_by DESC";
        }
        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->order($order_str)->select();

        return $res;
    }

    /*
     * 获取指定艺术家的所有作品记录
     */

    public function get_all_by_artist_id($order_by = "work_id", $order = 0, $artist_id) {
        if ($order == 0) {
            //ASC
            $order_str = "$order_by ASC";
        } else {
            //DESC
            $order_str = "$order_by DESC";
        }
        $map['zbz_works.artist_id'] = $artist_id;
        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->where($map)
                        ->order($order_str)->select();

        return $res;
    }

    /*
     * 获取前20个产品
     * 
     */

    public function get_top_20($data_filter) {


        /*
         * 排序的判断
         */
        if (!empty($data_filter['rank_type'])) {
            switch ($data_filter['rank_type']) {
                case 1:

                    $order_str = "buy_price DESC,rank DESC,ctime DESC";

                    break;
                case 2:

                    $order_str = "buy_price ASC,rank DESC,ctime DESC";

                    break;
                case 3:

                    $order_str = "view_count DESC,rank DESC,ctime DESC";

                    break;

                default:
                    $order_str = "rank DESC,ctime DESC";
                    break;
            }
        } else {
//            默认是安装后台设定的rank来排序
            $order_str = "rank DESC,ctime DESC";
        }

        if (!empty($data_filter['cat_id'])) {
            $map['zbz_works.cat_id'] = $data_filter['cat_id'];
        }


        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->join("left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                        ->where($map)->limit(20)
                        ->order($order_str)->select();

        return $res;
    }

    public function get_top_rent_20($data_filter) {


        /*
         * 排序的判断
         */
        if (!empty($data_filter['rank_type'])) {
            switch ($data_filter['rank_type']) {
                case 1:

                    $order_str = "rent_price DESC,rank DESC,ctime DESC";

                    break;
                case 2:

                    $order_str = "rent_price ASC,rank DESC,ctime DESC";

                    break;
                case 3:

                    $order_str = "view_count DESC,rank DESC,ctime DESC";

                    break;

                default:
                    $order_str = "rank DESC,ctime DESC";
                    break;
            }
        } else {
//            默认是安装后台设定的rank来排序
            $order_str = "rank DESC,ctime DESC";
        }

        if (!empty($data_filter['cat_id'])) {
            $map['zbz_works.cat_id'] = $data_filter['cat_id'];
        }

        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->join("left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                        ->where($map)->limit(20)
                        ->order($order_str)->select();

        return $res;
    }

    /*
     * 过滤作品
     * 
     */

    public function work_filter_manual_rent($data) {
        $cat_choose = $data['cat_choose'];
        $topic_choose = $data['topic_choose'];
        $price_choose = $data['price_choose'];
        $bprice = $data['bprice'];
        $eprice = $data['eprice'];
        $bwidth = $data['bwidth'];
        $ewidth = $data['ewidth'];
        $bheight = $data['bheight'];
        $eheight = $data['eheight'];
        $status_choose = $data['status_choose'];
        $shipping_choose = $data['shipping_choose'];

        if ($cat_choose > 0) {
            $map['zbz_works.cat_id'] = $cat_choose;
        }

        if ($topic_choose > 0) {
            $map['zbz_works.topic_id'] = $topic_choose;
        }

        if (!empty($bprice) && !empty($eprice)) {
            $map['zbz_works.rent_price'] = array(array('elt', $eprice), array('egt', $bprice));
        } else {
            switch ($price_choose) {
                case 1:
                    $map['zbz_works.rent_price'] = array(array('elt', 1000), array('egt', 0));

                    break;
                case 2:
                    $map['zbz_works.rent_price'] = array(array('elt', 2000), array('egt', 1000));

                    break;
                case 3:
                    $map['zbz_works.rent_price'] = array(array('elt', 5000), array('egt', 2000));

                    break;
                case 4:
                    $map['zbz_works.rent_price'] = array('egt', 5000);
                    break;

                default:
                    break;
            }
        }

        switch ($status_choose) {
            case 1:
                $map['zbz_works.wstatus'] = 0;

                break;
            case 2:
                $map['zbz_works.wstatus'] = 1;

                break;
            case 3:
                $map['zbz_works.wstatus'] = 3;

                break;
            case 4:
                $map['zbz_works.wstatus'] = 4;

                break;

            default:
                break;
        }
        
        
        //增加宽度和高度的判断
        if ( !empty($ewidth)) {
            $map['zbz_works.wwidth'] = array(array('elt', $ewidth), array('egt', $bwidth));
        }
        
        if (!empty($eheight)) {
            $map['zbz_works.wheight'] = array(array('elt', $eheight), array('egt', $bheight));
        }

        if ($shipping_choose > 0) {
            $map['zbz_works.shipping_time'] = $shipping_choose;
        }

//        $res = M("works")->where($map)->select();

        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->join("left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                        ->where($map)
                        ->order('ctime desc')->limit(30)->select();
        return $res;
//        return M("works")->getLastSql();
    }

    public function work_filter_manual_buy($data) {
        $cat_choose = $data['cat_choose'];
        $topic_choose = $data['topic_choose'];
        $price_choose = $data['price_choose'];
        $bprice = $data['bprice'];
        $eprice = $data['eprice'];
        $bwidth = $data['bwidth'];
        $ewidth = $data['ewidth'];
        $bheight = $data['bheight'];
        $eheight = $data['eheight'];
        $status_choose = $data['status_choose'];
        $shipping_choose = $data['shipping_choose'];

        if ($cat_choose > 0) {
            $map['zbz_works.cat_id'] = $cat_choose;
        }

        if ($topic_choose > 0) {
            $map['zbz_works.topic_id'] = $topic_choose;
        }

        if (!empty($bprice) && !empty($eprice)) {
            $map['zbz_works.buy_price'] = array(array('elt', $eprice), array('egt', $bprice));
        } else {
            switch ($price_choose) {
                case 1:
                    $map['zbz_works.buy_price'] = array(array('elt', 1000), array('egt', 0));

                    break;
                case 2:
                    $map['zbz_works.buy_price'] = array(array('elt', 2000), array('egt', 1000));

                    break;
                case 3:
                    $map['zbz_works.buy_price'] = array(array('elt', 5000), array('egt', 2000));

                    break;
                case 4:
                    $map['zbz_works.buy_price'] = array('egt', 5000);
                    break;

                default:
                    break;
            }
        }

        switch ($status_choose) {
            case 1:
                $map['zbz_works.wstatus'] = 0;

                break;
            case 2:
                $map['zbz_works.wstatus'] = 1;

                break;
            case 3:
                $map['zbz_works.wstatus'] = 3;

                break;
            case 4:
                $map['zbz_works.wstatus'] = 4;

                break;

            default:
                break;
        }

        if ($shipping_choose > 0) {
            $map['zbz_works.shipping_time'] = $shipping_choose;
        }
        
         //增加宽度和高度的判断
        if ( !empty($ewidth)) {
            $map['zbz_works.wwidth'] = array(array('elt', $ewidth), array('egt', $bwidth));
        }
        
        if ( !empty($eheight)) {
            $map['zbz_works.wheight'] = array(array('elt', $eheight), array('egt', $bheight));
        }

//        $res = M("works")->where($map)->select();

        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->join("left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                        ->where($map)
                        ->order('ctime desc')->limit(30)->select();
        return $res;
//        return M("works")->getLastSql();
    }

    public function get_lists_by_page($pagecount = 0, $cat_id = 0) {

        $startcount = ($pagecount+2) * 10;
        if ($cat_id > 0) {
            $map['zbz_works.cat_id'] = $cat_id;
        }


        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category")
                        ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                        ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                        ->where($map)
                        ->order("rank DESC,work_id DESC")->limit($startcount, 10)->select();

        return $res;
    }

    public function get_showtype_lists_by_page($pagecount = 0, $sid) {

        $startcount = $pagecount * 10;
        $map['zbz_work_showtype_relationship.sid'] = $sid;
        $res = $this->where($map)->field("zbz_work_showtype_relationship.id,zbz_works.work_id,zbz_works.name,zbz_works.thumb,zbz_works.rank,zbz_works.buy_price,zbz_works.rent_price")
                ->join("left join zbz_work_showtype_relationship on zbz_works.work_id = zbz_work_showtype_relationship.work_id")
                ->order("rank DESC,work_id DESC")->limit($startcount, 10)
                ->select();

        return $res;
    }

    /*
     * 获取单个记录
     */

    public function get_one($id = 0) {
        $res = $this->find($id);
        return $res;
    }

    /*
     * 删除指定数据
     */

    public function del_one($id) {
        if ($this->delete($id)) {
            return True;
        } else {
            return FALSE;
        }
    }

    /*
     * 新增数据
     */

    public function add_one($data) {
        $id = $this->add($data);

        return $id;
    }

    /*
     * 检查是否产品被卖掉了（租赁掉了）
     */

    public function get_one_status($id) {
        $work = $this->find($id);
        if ($work['wstatus'] == 0) {
            return $work;
        } else {
            return FALSE;
        }
    }

    /*
     * 判断是否已经在购物车里边
     */
}

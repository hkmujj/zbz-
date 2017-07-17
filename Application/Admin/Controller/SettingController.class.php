<?php

namespace Admin\Controller;

use Think\Controller;

class SettingController extends CommonController {

    public function _initialize() {
        parent::_initialize();

        $this->chk_if_login();
    }

    /*
     * 首页
     */

    public function dashboard() {


        /*
         * 获取订单量和其他的统计数据
         */
        $today_date = date("Ymd", NOW_TIME);
        $map1['ctime_date'] = $today_date;
        $map1['order_type'] = 1;
        $data['rent_order_count'] = M("orders")->where($map1)->count();


        $map2['ctime_date'] = $today_date;
        $map2['order_type'] = 0;
        $data['buy_order_count'] = M("orders")->where($map2)->count();

        $map3['ctime_date'] = $today_date;
        $map3['order_type'] = 0;
        $data['diy_order_count'] = M("orders")->where($map3)->count();

        $map4['ctime_date'] = $today_date;
        $data['member_count'] = M("members")->where($map4)->count();

        $map5['ctime_date'] = $today_date;
        $data['view_count'] = M("page_view_log")->where($map5)->count();
        
        
        //用户收藏量
        $map6['ctime_date'] = $today_date;
        $map6['status'] = 1;
        $data['collection_count'] = M("member_collection_record")->where($map6)->count();
        
        //用户关注量
        $map7['ctime_date'] = $today_date;
        $map7['status'] = 1;
        $data['focus_count'] = M("member_focus_record")->where($map7)->count();

        $this->assign("data", $data);

        $this->display();
    }

    /*
     * 首页
     */

    public function mobile_index_config() {
        if (IS_AJAX) {
            $db = M("setting_mobile_index");
            $res = $db->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function mobile_index_config_edit() {
        if (IS_POST) {
            $id = I("post.id");
            $position = I("post.position");

            $data['id'] = $id;
            $data['position'] = $position;
            $data['ctime'] = NOW_TIME;
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }

            $db = M("setting_mobile_index");
            $ids = $db->where("id=$id")->save($data);

            $output['err'] = 0;
            $output['msg'] = "成功";

            echo json_encode($output);
        } else {
            $id = I("get.id");
            $db = M("setting_mobile_index");
            $res = $db->find($id);

            $this->assign("result", $res);

            $this->display();
        }
    }

    /*
     * 空间展示配置
     */

    public function mobile_index_showtype_config() {
        if (IS_AJAX) {
            $db = M("setting_mobile_index_showtype");
            $res = $db->order("rank DESC")->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function mobile_index_showtype_config_edit() {
        if (IS_POST) {
            $id = I("post.id");
            $keywords = I("post.keywords");

            $data['id'] = $id;
            $data['keywords'] = $keywords;
            $data['rank'] = I("post.rank");
            $data['ctime'] = NOW_TIME;
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $db = M("setting_mobile_index_showtype");
            $id = $db->where("id=$id")->save($data);

            $output['err'] = 0;
            $output['msg'] = "成功";

            echo json_encode($output);
        } else {
            $id = I("get.id");
            $db = M("setting_mobile_index_showtype");
            $res = $db->find($id);

            $this->assign("result", $res);

            $this->display();
        }
    }

    /*
     * 新增
     */

    public function add_mobile_index_showtype_keywords() {

        if (IS_POST) {
            $keywords = I("post.keywords");

            $data['keywords'] = $keywords;
            $data['rank'] = I("post.rank");
            $data['ctime'] = NOW_TIME;
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $db = M("setting_mobile_index_showtype");
            $id = $db->add($data);

            if ($id) {
                $output['err'] = 0;
                $output['msg'] = "成功";

                echo json_encode($output);
            }
        } else {
            $this->display("mobile_index_showtype_config_add");
        }
    }

    /*
     * 删除
     */

    public function del_mobile_index_showtype_keywords() {
        $id = I("post.id");
        $db = M("setting_mobile_index_showtype");
        $db->delete($id);

        $output['err'] = 0;
        $output['msg'] = "成功";

        echo json_encode($output);
    }

    /*
     * 短信配置
     */

    public function sms_config() {
        if (IS_POST) {
//            var_dump($_POST);
            $DB = M("setting_sms_config");
            $res = $DB->where(array('tag' => 'sms'))->find();

            $data = array(
                'appid' => I("post.appid"),
                'appsecret' => I("post.appsecret"),
                'regionid' => I("post.regionid"),
                'tpl_reg' => I("post.tpl_reg"),
                'tpl_passwd' => I("post.tpl_passwd"),
                'tpl_notify' => I("post.tpl_notify"),
                'utime' => NOW_TIME
            );
            if ($DB->where("id=" . $res['id'])->save($data)) {
                $this->success("更新成功");
            }
        } else {
            $DB = M("setting_sms_config");
            $res = $DB->where(array('tag' => 'sms'))->find();
            $this->assign("result", $res);
            $this->display();
        }
    }

    /*
     * 微信支付
     */

    public function payment_config_wx() {
        if (IS_POST) {
//            var_dump($_POST);
            $DB = M("setting_payment_config_wx");
            $res = $DB->where(array('tag' => 'wechat'))->find();

            $data = array(
                'appid' => I("post.appid"),
                'appsecret' => I("post.appsecret"),
                'utime' => NOW_TIME
            );
            if ($DB->where("id=" . $res['id'])->save($data)) {
                $this->success("更新成功");
            }
        } else {
            $DB = M("setting_payment_config_wx");
            $res = $DB->where(array('tag' => 'wechat'))->find();
            $this->assign("result", $res);
            $this->display();
        }
    }

    /*
     * 支付宝支付
     */

    public function payment_config_alipay() {
        if (IS_POST) {
//            var_dump($_POST);
            $DB = M("setting_payment_config_alipay");
            $res = $DB->where(array('tag' => 'alipay'))->find();

            $data = array(
                'appid' => I("post.appid"),
                'appsecret' => I("post.appsecret"),
                'utime' => NOW_TIME
            );
            if ($DB->where("id=" . $res['id'])->save($data)) {
                $this->success("更新成功");
            }
        } else {
            $DB = M("setting_payment_config_alipay");
            $res = $DB->where(array('tag' => 'alipay'))->find();
            $this->assign("result", $res);
            $this->display();
        }
    }

    /*
     * 批量生成会员号
     */

    public function create_multi_membercode() {
        $DB = M("member_code_rep");
        $startNum = 80070001;
        for ($i = 0; $i < 30000; $i++) {
            $data[] = array(
                'member_code' => $startNum + $i,
                'ctime' => NOW_TIME
            );
            echo $i . "<br/>";
        }

    }

    /*
     * 页面的固定内容配置
     */

    public function pages_setting_lists() {
        if (IS_AJAX) {
            $newsModel = M("setting_mobile_pages");
            $res = $newsModel->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function edit_pages_setting() {
        if (IS_POST) {
            $id = I("post.id");
            $content = I("post.content");

            $data['content'] = $content;

            $id = M("setting_mobile_pages")->where("id=$id")->save($data);

            if ($id) {
                json_out(1, "成功");
            } else {
                json_out(0, "失败");
            }
        } else {
            $id = I("get.id");
            $res = M("setting_mobile_pages")->find($id);

            $this->assign("result", $res);
            $this->display();
        }
    }
    
    
    
    /*
     * 
     * 
     * 
     */
    /*
     * 页面的固定内容配置
     */

    public function pc_pages() {
        if (IS_AJAX) {
            $newsModel = M("pc_pages");
            $res = $newsModel->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function edit_pc_pages() {
        if (IS_POST) {
            $id = I("post.id");
            $content = I("post.content");

            $data['content'] = $content;
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $thumb_url = $this->_conversion_base64($thumb);
                if ($thumb_url != false) {
                    $data['thumb'] = '/' . $thumb_url;
                }
            }
            $ids = M("pc_pages")->where("id=$id")->save($data);

            if ($ids) {
                json_out(1, "成功");
            } else {
                json_out(0, "失败");
            }
        } else {
            $id = I("get.id");
            $res = M("pc_pages")->find($id);

            $this->assign("result", $res);
            $this->display();
        }
    }

}

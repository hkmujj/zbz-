<?php

namespace Admin\Controller;

use Think\Controller;

class NewsController extends CommonController
{

    public function _initialize()
    {
        parent::_initialize();
        $this->chk_if_login();
    }

    /*
     * 新闻列表
     * 
     */

    public function lists()
    {
        if (IS_AJAX) {

        } else {
            //微信访问地址的前缀
            $url_pre = "http://" . $_SERVER['HTTP_HOST'];
            $this->assign("url_pre", $url_pre);
            $this->display();
        }
    }

    /*
     * 获取新闻列表
     */

    public function get_news_lists()
    {
        $newsModel = new \Admin\Model\NewsModel();
        $res = $newsModel->get_all('ctime', 1);

        echo json_encode($res);
    }

    /*
     * 资讯添加
     */

    public function add()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['brief'] = I('post.brief');
            $data['content'] = I('post.content');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $newsModel = new \Admin\Model\NewsModel();
            $news_id = $newsModel->add_one($data);

            json_out($news_id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }
    /*
     * 资讯修改
     */

    public function edit()
    {
        if (IS_POST) {

            $id = I("post.news_id");
            $data['title'] = I('post.title');
            $data['brief'] = I('post.brief');
            $data['content'] = I('post.content');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $thumb_url = $this->_conversion_base64($thumb);
                if ($thumb_url != false) {
                    $data['thumb'] = '/' . $thumb_url;
                }
            }
            $newsModel = M("news");
            $news_id = $newsModel->where("news_id =".$id)->save($data);

            json_out($news_id, '添加成功');
//            var_dump($_POST);
        } else {
            $news_id = I("get.news_id");
            
            $res = M("news")->find($news_id);
            $this->assign("news", $res);
            
            $this->display();
        }
    }

    /*
     * 资讯删除
     */

    public function del()
    {
        $news_id = I("post.news_id");

        $newsModel = new \Admin\Model\NewsModel();

        $res = $newsModel->del_one($news_id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    /*
     * ############# banner页面 #############################################################################
     */

    public function banner_lists()
    {
        $this->display();
    }

    //添加banner

    public function add_banner()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['type'] = I('post.type');
            $data['app_show'] = I('post.app_show');
            $data['wechat_show'] = I('post.wechat_show');
            $data['url'] = I('post.url');
            $data['work_id'] = I('post.work_id');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $bannersModel = new \Admin\Model\BannersModel();
            $id = $bannersModel->add_one($data);

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * 获取banner
     */

    public function get_banner_lists()
    {
        $bannersModel = new \Admin\Model\BannersModel();
        $res = $bannersModel->get_all('ctime', 1);

        echo json_encode($res);
    }

    /*
     * 删除banner
     */

    public function del_banner()
    {
        $id = I("post.banner_id");

        $bannersModel = new \Admin\Model\BannersModel();

        $res = $bannersModel->del_one($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    /*
     * 
     *  ########### 启动页面#############################################################################
     */

    public function start_lists()
    {
        $this->display();
    }

    /*
     * 获取启动图片
     */

    public function get_startup_banner_lists()
    {
        $bannersModel = new \Admin\Model\StartupBannersModel();
        $res = $bannersModel->get_all('ctime', 1);

        echo json_encode($res);
    }

    /*
     * 删除banner
     */

    public function del_startup_banner()
    {
        $id = I("post.banner_id");

        $bannersModel = new \Admin\Model\StartupBannersModel();

        $res = $bannersModel->del_one($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    //添加APP启动图
    public function add_startup()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $bannersModel = new \Admin\Model\StartupBannersModel();
            $id = $bannersModel->add_one($data);

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * 消息通知
     */

    public function msg_lists()
    {
        $this->display();
    }

    /*
     * 获取新闻列表
     */

    public function get_system_msg_lists()
    {
        $db = M("msg_system");
        $map['ishidden'] = 0;
        $res = $db->order("ctime desc")->where($map)->select();


        echo json_encode($res);
    }

    /*
     * 系统消息添加
     */

    public function add_msg()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['content'] = I('post.content');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);

            $db = M("msg_system");
            $msg_id = $db->add($data);


            /*
             * 插入给所有会员
             */
            $members = M("members")->field("mid")->select();

            foreach ($members as $key => $value) {
                $datas[] = array(
                    'mid' => $value['mid'],
                    'sys_msg_id' => $msg_id,
                    'ctime' => NOW_TIME
                );
            }

            M("msg_system_member_relationship")->addAll($datas);

            json_out($msg_id, '添加成功');
        } else {
            $this->display();
        }
    }

    /*
     * 删除系统消息
     */

    public function del_msg()
    {
        $id = I("post.id");

        $db = M("msg_system");
        $data['ishidden'] = 1;

        $res = $db->where("id = $id")->save($data);
        if ($res) {
            /*
             * 清理所有的会员可以看到的内容
             */


            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }

    /*
     * 关键字配置
     */

    public function promotion_keyword_lists()
    {
        if (IS_AJAX) {
            $db = M("setting_keywords");
            $map['type'] = 0;
            $res = $db->order("ctime desc")->where($map)->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function hot_keyword_lists()
    {
        if (IS_AJAX) {
            $db = M("setting_keywords");
            $map['type'] = 1;
            $res = $db->order("ctime desc")->where($map)->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function add_keywords()
    {
        if (IS_POST) {
            $type = I("post.type");
            $keywords = I("post.keywords");

            $data['type'] = $type;
            $data['keywords'] = $keywords;
            $data['ctime'] = NOW_TIME;

            $id = M("setting_keywords")->add($data);
            if ($id) {
                json_out($id, "添加成功");
            } else {
                json_out("", "添加失败");
            }
        } else {
            $this->display();
        }
    }

    public function del_keywords()
    {
        $id = I("post.id");
        $db = M("setting_keywords");

        $res = $db->delete($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }


    /*
     * ####################################### PC资讯的列表 ##########################
     */
    /*
     * 新闻列表
     * 
     */

    public function pc_lists()
    {
        if (IS_AJAX) {

        } else {
            //微信访问地址的前缀
            $url_pre = "http://" . $_SERVER['HTTP_HOST'];
            $this->assign("url_pre", $url_pre);
            $this->display();
        }
    }

    /*
     * 获取新闻列表
     */

    public function get_pc_news_lists()
    {
        $newsModel = M("pc_news");
        $res = $newsModel->order("ctime desc")->select();

        echo json_encode($res);
    }

    /*
     * 资讯添加
     */

    public function add_pc()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['brief'] = I('post.brief');
            $data['content'] = I('post.content');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $thumb_url = $this->_conversion_base64($thumb);
                if ($thumb_url != false) {
                    $data['thumb'] = '/' . $thumb_url;
                }
            }
            $newsModel = M("pc_news");
            $news_id = $newsModel->add($data);

            json_out($news_id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }
    
     /*
     * pc资讯修改
     */

    public function edit_pc()
    {
        if (IS_POST) {
            $id = I("post.id");
            
            $data['title'] = I('post.title');
            $data['brief'] = I('post.brief');
            $data['content'] = I('post.content');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $thumb_url = $this->_conversion_base64($thumb);
                if ($thumb_url != false) {
                    $data['thumb'] = '/' . $thumb_url;
                }
            }
            $newsModel = M("pc_news");
            $news_id = $newsModel->where("id=$id")->save($data);

            json_out($news_id, '成功');
//            var_dump($_POST);
        } else {
            
            $id = I("get.id");
            $res = M("pc_news")->find($id);
            $this->assign("news", $res);
            $this->display();
        }
    }

    /*
     * 资讯删除
     */

    public function del_pc()
    {
        $news_id = I("post.news_id");

        $newsModel = M("pc_news");

        $res = $newsModel->delete($news_id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }


    /*
     * ############# banner页面 #############################################################################
     */

    public function pc_banner_lists()
    {
        $this->display();
    }

    //添加banner

    public function add_pc_banner()
    {
        if (IS_POST) {

            $data['title'] = I('post.title');
            $data['type'] = I('post.type');
            $data['app_show'] = I('post.app_show');
            $data['wechat_show'] = I('post.wechat_show');
            $data['url'] = I('post.url');
            $data['work_id'] = I('post.work_id');
            $data['ctime'] = NOW_TIME;
            $data['ctime_date'] = date("Ymd", NOW_TIME);
            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $new_img_url = $this->_conversion_base64($thumb);
                if ( $new_img_url != false) {
                    $data['thumb'] = '/' . $new_img_url;
                }
            }
            $bannersModel = M("pc_banners");
            $id = $bannersModel->add($data);

            json_out($id, '添加成功');
//            var_dump($_POST);
        } else {
            $this->display();
        }
    }

    /*
     * 获取banner
     */

    public function get_pc_banner_lists()
    {
        $bannersModel = M("pc_banners");
        $res = $bannersModel->order('ctime desc')->select();

        echo json_encode($res);
    }

    /*
     * 删除banner
     */

    public function del_pc_banner()
    {
        $id = I("post.banner_id");

        $bannersModel = M("pc_banners");

        $res = $bannersModel->delete($id);

        if ($res) {
            json_out(1, "删除成功");
        } else {
            json_out(0, "删除失败");
        }
    }


    /*
     * 首页 banner下面的三张小图配置
     * pc_index_img_lists
     */
    public function pc_index_img_lists()
    {

        if (IS_AJAX) {
            $newsModel = M("pc_index_img_lists");
            $res = $newsModel->select();

            echo json_encode($res);
        } else {
            $this->display();
        }
    }

    public function edit_pc_index_img_lists() {
        if (IS_POST) {
            $id = I("post.id");

            $thumb = I('post.thumb');
            if (!empty($thumb)) {
                $thumb_url = $this->_conversion_base64($thumb);
                if ($thumb_url != false) {
                    $data['thumb'] = '/' . $thumb_url;
                }
            }
            $ids = M("pc_index_img_lists")->where("id=$id")->save($data);

            if ($ids) {
                json_out(1, "成功");
            } else {
                json_out(0, "失败");
            }
        } else {
            $id = I("get.id");
            $res = M("pc_index_img_lists")->find($id);

            $this->assign("result", $res);
            $this->display();
        }
    }


}

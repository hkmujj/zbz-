<?php

namespace Admin\Controller;

use Think\Controller;

class OrdersController extends CommonController {

    public function _initialize() {
        parent::_initialize();
        $this->chk_if_login();
    }
    
    
    /*
     * 买艺术订单列表
     */
    public function buy_orders() {
        if(IS_AJAX)
        {
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all('oid', 1,0);
            echo json_encode($res);
        }
        else
        {
            $this->display();
        }
    }
    
    public function get_buy_orders_lists() {
        $isearch = I("get.isearch");
        if($isearch==1)
        {
//            $this->data_param; // 获取的参数和值
            //搜索提交,判断提交过来的参数
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all_with_filter('oid', 1,0, $this->data_param);
            
            
        }
        else
        {
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all('oid', 1,0);
        }
        

        echo json_encode($res);
    }
    
    /*
     * 买艺术订单详情
     */
    
    public function buy_orders_detail() {
        if(IS_POST)
        {
            
        }
        else
        {
            $oid = I("get.oid");
            
            $res = M("orders")->find($oid);
            
            //获取订单下的作品
            $res['works'] = $this->get_works_by_oid($res['oid']);
            
            
            if($res['order_status']==0)
            {
                if($res['pay_status']==0)
                {
                    $res['order_status_text'] = "未支付";
                }
                else
                {
                    if($res['shipping_status']==0)
                    {
                        $res['order_status_text'] = "已支付,未派送";
                    }
                    else
                    {
                        $res['order_status_text'] = "已支付,已派送";
                    }
                }
                
            }
            elseif($res['order_status']==1)
            {
               $res['order_status_text'] = "已完成"; 
            }
            else
            {
                $res['order_status_text'] = "已取消";
            }
            
            
            $this->assign("order", $res);
            $this->display();
        }
    }
    
    public function buy_orders_detail_print() {
        if(IS_POST)
        {
            
        }
        else
        {
            $oid = I("get.oid");
            
            $res = M("orders")->find($oid);
            
            //获取订单下的作品
            $res['works'] = $this->get_works_by_oid($res['oid']);
            
            
            if($res['order_status']==0)
            {
                if($res['pay_status']==0)
                {
                    $res['order_status_text'] = "未支付";
                }
                else
                {
                    if($res['shipping_status']==0)
                    {
                        $res['order_status_text'] = "已支付,未派送";
                    }
                    else
                    {
                        $res['order_status_text'] = "已支付,已派送";
                    }
                }
                
            }
            elseif($res['order_status']==1)
            {
               $res['order_status_text'] = "已完成"; 
            }
            else
            {
                $res['order_status_text'] = "已取消";
            }
            
            
            $this->assign("order", $res);
            $this->display();
        }
    }
    
    /*
     * 买艺术订单修改
     */
    
    public function buy_orders_modify() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 买艺术订单删除
     */
    
    public function buy_orders_del() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    
    
    /*
     * #######################  租赁艺术 #######################
     * 
     */
    
    /*
     * 租艺术订单列表
     */
    public function rent_orders() {
        if(IS_AJAX)
        {
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all('oid', 1,1);
            echo json_encode($res);
        }
        else
        {
            $this->display();
        }
    }
    
    public function get_rent_orders_lists() {
        $isearch = I("get.isearch");
        if($isearch==1)
        {
//            $this->data_param; // 获取的参数和值
            //搜索提交,判断提交过来的参数
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all_with_filter('oid', 1,1, $this->data_param);
            
            
        }
        else
        {
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all('oid', 1,0);
        }
        

        echo json_encode($res);
    }
    
    /*
     * 租艺术订单详情
     */
    
    public function rent_orders_detail() {
        if(IS_POST)
        {
            
        }
        else
        {
            $oid = I("get.oid");
            
            $res = M("orders")->find($oid);
            
            //获取订单下的作品
            $res['works'] = $this->get_works_by_oid($res['oid']);
            
            
            if($res['order_status']==0)
            {
                if($res['pay_status']==0)
                {
                    $res['order_status_text'] = "未支付";
                }
                else
                {
                    if($res['shipping_status']==0)
                    {
                        $res['order_status_text'] = "已支付,未派送";
                    }
                    else
                    {
                        $res['order_status_text'] = "已支付,已派送";
                    }
                }
                
            }
            elseif($res['order_status']==1)
            {
               $res['order_status_text'] = "已完成"; 
            }
            else
            {
                $res['order_status_text'] = "已取消";
            }
            
            
            $this->assign("order", $res);
            $this->display();
        }
    }
    
    public function rent_orders_detail_print() {
        if(IS_POST)
        {
            
        }
        else
        {
            $oid = I("get.oid");
            
            $res = M("orders")->find($oid);
            
            //获取订单下的作品
            $res['works'] = $this->get_works_by_oid($res['oid']);
            
            
            if($res['order_status']==0)
            {
                if($res['pay_status']==0)
                {
                    $res['order_status_text'] = "未支付";
                }
                else
                {
                    if($res['shipping_status']==0)
                    {
                        $res['order_status_text'] = "已支付,未派送";
                    }
                    else
                    {
                        $res['order_status_text'] = "已支付,已派送";
                    }
                }
                
            }
            elseif($res['order_status']==1)
            {
               $res['order_status_text'] = "已完成"; 
            }
            else
            {
                $res['order_status_text'] = "已取消";
            }
            
            
            $this->assign("order", $res);
            $this->display();
        }
    }
    
    /*
     * 租艺术订单修改
     */
    
    public function rent_orders_modify() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 租艺术订单删除
     */
    
    public function rent_orders_del() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    
    /*
     * #######################  定制艺术订单 #######################
     * 
     */
    
    /*
     * 租艺术订单列表
     */
    public function diy_orders() {
        if(IS_AJAX)
        {
            $dbModel = new \Admin\Model\OrdersModel();
            $res = $dbModel->get_all('oid', 1,2);
            echo json_encode($res);
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 租艺术订单详情
     */
    
    public function diy_orders_detail() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 租艺术订单修改
     */
    
    public function diy_orders_modify() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 租艺术订单删除
     */
    
    public function diy_orders_del() {
        if(IS_POST)
        {
            
        }
        else
        {
            $this->display();
        }
    }
    
    /*
     * 订单的状态修改
     * 未完成  0
     * 
     * 已支付,未派送 10
     * 已支付,已派送 11
     * 
     * 已经完成  1
     * 
     * 已取消  2
     * 
     * 
     */
    public function manual_chg_order_status() {
        $order_status_key = I("post.order_status_key");
        
        $oid = I("post.oid");
        switch ($order_status_key) {
            case 0:
                $data['order_status'] = 0;
                $data['shipping_status'] =0;
                $data['pay_status'] = 0;

                break;
            case 1:
                
                $data['order_status'] = 1;
                $data['shipping_status'] =1;
                $data['pay_status'] = 1;


                break;
            case 2:
                $data['order_status'] = 2;
                $data['shipping_status'] =0;
                $data['pay_status'] = 0;

                break;
            case 10:
                $data['order_status'] = 0;
                $data['shipping_status'] =0;
                $data['pay_status'] = 1;

                break;
            case 11:
                $data['order_status'] = 0;
                $data['shipping_status'] =1;
                $data['pay_status'] = 1;

                break;

            default:
                break;
        }
        
        $id = M("orders")->where("oid=$oid")->save($data);

        if ($id) {
            json_out(1, "成功");
        } else {
            json_out(0, "失败");
        }
    }
    
    
    /*
     * 获取指定的订单下面的作品
     */
    public function get_works_by_oid($oid) {
        $db  =M("orders_works");
        $map['zbz_orders_works.order_id'] = $oid;
        
        $res = $db->where($map)->field("zbz_orders_works.order_id,zbz_works.*,zbz_work_topic.name as topic_name,zbz_work_categories.name as cat_name")
                ->join("left join zbz_works on zbz_works.work_id = zbz_orders_works.work_id")
                ->join("left join zbz_work_categories on zbz_work_categories.cat_id = zbz_works.cat_id")
                ->join("left join zbz_work_topic on zbz_work_topic.topic_id = zbz_works.topic_id")
                ->select();
        
        return $res;
        
    }

}

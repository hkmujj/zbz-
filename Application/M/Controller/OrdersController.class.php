<?php
namespace M\Controller;
use Think\Controller;
class OrdersController extends CommonController {
    public function index(){
        $this->display();
    }
    
   /*
    * 购买订单
    */
   public function buylist() {
       $mid = $this->memberinfo['mid'];
       $dbModel  = new \M\Model\OrdersModel();
       $res = $dbModel->get_all($mid, 0);
       
       foreach ($res as $key => $value) {
           if($value['order_status']==0)
           {
               if($value['pay_status']==0)
               {
                   $res[$key]['order_status_cn'] = "未支付";
               }
               else
               {
                   if($value['shipping_status']==0)
                   {
                       $res[$key]['order_status_cn'] = "已支付,未派送";
                   }
                   else
                   {
                       $res[$key]['order_status_cn'] = "已支付,已派送";
                   }
               }
           }
           elseif($value['order_status']==1)
           {
               $res[$key]['order_status_cn'] = "已完成";
           }
            else
           {
               $res[$key]['order_status_cn'] = "已取消";
           }
           
           $res[$key]['thumbs'] = $this->get_oid_work_thumbs($value['oid']);
           $res[$key]['thumbs_count'] = count($res[$key]['thumbs']);
       }
       
       
       $this->assign("orders", $res);
       $this->display();
   }
    
   
   /*
    * 租赁订单
    */
   public function rentlist() {
       $mid = $this->memberinfo['mid'];
       $dbModel  = new \M\Model\OrdersModel();
       $res = $dbModel->get_all($mid, 1);
       
       foreach ($res as $key => $value) {
           if($value['order_status']==0)
           {
               if($value['pay_status']==0)
               {
                   $res[$key]['order_status_cn'] = "未支付";
               }
               else
               {
                   if($value['shipping_status']==0)
                   {
                       $res[$key]['order_status_cn'] = "已支付,未派送";
                   }
                   else
                   {
                       $res[$key]['order_status_cn'] = "已支付,已派送";
                   }
               }
           }
           elseif($value['order_status']==1)
           {
               $res[$key]['order_status_cn'] = "已完成";
           }
            else
           {
               $res[$key]['order_status_cn'] = "已取消";
           }
           
           $res[$key]['thumbs'] = $this->get_oid_work_thumbs($value['oid']);
           $res[$key]['thumbs_count'] = count($res[$key]['thumbs']);
       }
       
       
       $this->assign("orders", $res);
       $this->display();
   }
   
   
   /*
    * 订单详情
    */
   public function detail() {
       $data['mid'] = $this->memberinfo['mid'];
        $data['oid'] = I("get.oid");
        
        $payment = I("get.from_src");
        if(!empty($payment))
        {
            $this->assign("from_payment", 1);
        }
        else
        {
            $this->assign("from_payment", 0);
        }
        
        $res  = M("orders")->where($data)->find();
        if(!empty($res))
        {
            //获取订单的具体产品信息
            $map['zbz_orders_works.order_id'] = I("get.oid");
            $order_details  = M("orders_works")->where($map)->field("zbz_orders_works.*,zbz_works.thumb")
                    ->join("LEFT JOIN zbz_works ON zbz_works.work_id = zbz_orders_works.work_id")
                    ->select();
            
            $order_details_count = count($order_details);
            
            $this->assign("order_details", $order_details);
            $this->assign('order_details_count', $order_details_count);
            
            //获取优惠券的信息
            
            if(!empty($res['coupon_id']))
            {
                $coupon_res = M("member_coupons")->find($res['coupon_id']);
                
                $new_order_amount = $res['order_amount'] - $coupon_res['coupon_value'];
                
                $res['order_amount_to_pay']=$new_order_amount;
                
            }  
            else
            {
                $res['order_amount_to_pay']=$res['order_amount'];
            }
            
            if($res['order_status']==0)
            {
                if($res['pay_status']==0)
                {
                    $res['order_status_tag'] = 0;
                    $res['order_status_cn'] = "未支付";
                }
                else
                {
                    if($res['shipping_status']==0)
                    {
                        $res['order_status_tag'] = 10;
                        $res['order_status_cn'] = "已支付,未派送";
                    }
                    else
                    {
                        $res['order_status_tag'] = 11;
                        $res['order_status_cn'] = "已支付,已派送";
                    }
                }
            }
            elseif($res['order_status']==1)
            {
                $res['order_status_tag'] = 1;
                $res['order_status_cn'] = "已完成";
            }
             else
            {
               $res['order_status_tag'] = 2;
               $res['order_status_cn'] = "已取消";
            }
            
            $this->assign("order", $res);
   

            $this->display();

//            $this->display();
        }
        else
        {
            echo "订单不合法";
        }
   }
   
   
   /*
    * 修改订单的状态
    * 已经支付的订单不能修改
    */
   public function modify() {
       $oid = I("oid");
       $mid = $this->memberinfo['mid'];
       
       $dbModel = M("orders");
       $order = $dbModel->find($oid);
       
       if($order['order_status']==2)
       {
           $res['msg'] = "订单已经取消";
                $res['err']=3;
       }
       else
       {
           if($mid==$order['mid'])
            {
                if($order['pay_status']==0)
                {
                    $data['order_status'] =2;

                    $dbModel->where("oid=$oid")->save($data);

                    $res['msg'] = "订单已取消";
                    $res['err']=0;

                }
                else
                {
                    $res['msg'] = "订单已经支付,不能取消";
                    $res['err']=2;
                }
            }
            else
            {
                $res['msg'] = "订单信息有误";
                $res['err']=1;

            }
       }
       
       
       echo json_encode($res);
   }
   
   
   /*
    * 通过oid 获取
    */
   public function get_oid_work_thumbs($oid) {
       $map['zbz_orders_works.order_id'] = $oid;
       $res = M("orders_works")->where($map)
               ->join("left join zbz_works on zbz_works.work_id =zbz_orders_works.work_id")
               ->field("zbz_works.thumb as thumb")->select();
       $thumbs = array();
        foreach ($res as $key => $value) {
            $thumbs[] = $value['thumb'];
        }
        
        return $thumbs;
   }
   
   /*
    * diylist
    */
   public function diylist() {
       $this->display();
   }
   
   
   
   
 
  
}
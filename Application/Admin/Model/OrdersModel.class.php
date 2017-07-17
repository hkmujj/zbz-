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
namespace Admin\Model;
use Think\Model;

class OrdersModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="oid",$order=0,$order_type=0) {
        if($order==0)
        {
            //ASC
            $order_str = "$order_by ASC";
        }
        else
        {
            //DESC
            $order_str = "$order_by DESC";
        }
        $map['order_type'] = $order_type;
        
        $res = $this->where($map)->order($order_str)->select();
        
        return $res;
    }
    
    public function get_all_with_filter($order_by="oid",$order=0,$order_type=0,$data) {
        if($order==0)
        {
            //ASC
            $order_str = "$order_by ASC";
        }
        else
        {
            //DESC
            $order_str = "$order_by DESC";
        }
        $map['order_type'] = $order_type;
        
        //订单日期
        
        if(!empty($data['ctime1'])&&!empty($data['ctime2']))
        {
            $map['ctime_date'] = array(array("egt",$data['ctime1']),array("elt",$data['ctime2']));
        }
        
        
        if(!empty($data['contact']))
        {
            $map['contact'] = array("like","%".trim($data['contact'])."%");
        }
        
        if(!empty($data['order_amount1'])&&!empty($data['order_amount2']))
        {
            $map['order_amount'] = array(array("egt",$data['order_amount1']),array("elt",$data['order_amount2']));
        }
        
        if(!empty($data['order_status']))
        {
            switch ($data['order_status']) {
                
                /*
                 * <option value="0">全部</option> 
                    <option value="1">已完成</option> 
                    <option value="2">已支付、已派送</option> 
                    <option value="3">已支付、未派送</option> 
                    <option value="4">未支付</option> 
                    <option value="5">已取消</option> 
                 */
                case 1:
                    //
                    $map['order_status'] = 1;

                    break;
                case 2:
                    $map['order_status'] = 0;
                    $map['shipping_status'] = 1;
                    $map['pay_status']=1;
                    break;
                case 3:
                    $map['order_status'] = 0;
                    $map['shipping_status'] = 0;
                    $map['pay_status']=1;

                    break;
                case 4:
                    $map['order_status'] = 0;
                    $map['shipping_status'] = 0;
                    $map['pay_status']=0;

                    break;
                case 5:
                    $map['order_status'] = 2;

                    break;

                default:
                    break;
            }
        }
        
        
        $res = $this->where($map)->order($order_str)->select();
        
        return $res;
    }
    
    
    /*
     * 获取单个记录
     */
    public function get_one($mid=0) {
        $res = $this->find($mid);
        return $res;
    }
    
}

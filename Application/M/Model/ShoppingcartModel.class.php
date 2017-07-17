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

class ShoppingcartModel extends Model {
    protected $tableName = 'orders_shopping_cart'; 
    
    /*
     * 获取指定用户的购物车清单
     */
    public function get_all_in_cart($mid=0,$type=0) {
        $map['zbz_orders_shopping_cart.mid'] = $mid;
        $map['zbz_orders_shopping_cart.type'] = $type;
        
        $order_str = "ctime DESC";
        
        $res = $this->field("zbz_orders_shopping_cart.*,zbz_works.name as work_name,zbz_works.thumb as work_thumb,zbz_works.buy_price as buyprice,zbz_works.rent_price as rentprice,zbz_works.wwidth,zbz_works.wheight")
                ->join("Left JOIN zbz_works ON zbz_works.work_id = zbz_orders_shopping_cart.work_id")
                ->where($map)
                ->order($order_str)->select();
//        echo $this->getLastSql();
//        echo "<br/>";
        return $res;
        
        
        
    }
    /*
     * 判断是否已经在购物车里边
     */
    

    public function chk_in_cart($mid, $work_id) {
        $map['mid'] = $mid;
        $map['work_id'] = $work_id;

        $res = $this->where($map)->count();

        if ($res > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /*
     * 判断购物车里边的产品数量
     * 租赁和购买的分开计算
     * 
     */
    public function get_cart_num($mid,$type) {
       $map['mid'] = $mid;
       $map['type'] = $type;
       
       $count = $this->where($map)->count();
       
       return $count;
    }

}

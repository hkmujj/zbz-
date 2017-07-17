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

class OrdersModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($mid,$type) {

        $map['mid'] = $mid;
        $map['order_type']  =$type;
        $order_str = "ctime DESC";
        $res = $this->where($map)->order($order_str)->select();
        
        return $res;
    }
    
    
    /*
     * 获取单个记录
     */
    public function get_one($id=0) {
        $res = $this->find($id);
        return $res;
    }
    
    /*
     * 删除指定数据
     */
    public function del_one($id) {
        if($this->delete($id))
        {
            return True;
        }
        else
        {
            return FALSE;
        }
    }

    
}

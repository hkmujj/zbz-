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

class MembersModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="mid",$order=0) {
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
        $res = $this->order($order_str)->select();
        
        return $res;
    }
    
    public function get_all_with_filter($order_by="mid",$order=0,$data) {
        
        if(!empty($data['nickname']))
        {
            $map['nickname'] = array("like","%".$data['nickname']."%");
        }
        
        if(!empty($data['mobile']))
        {
            $map['mobile'] = array("like","%".$data['mobile']."%");
        }
        
        
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

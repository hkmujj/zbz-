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

class NewsModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="news_id",$order=0) {
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
    
    
    /*
     * 获取单个记录
     */
    public function get_one($id=0) {
        //增加浏览记录
        $this->where("news_id = $id")->setInc("view_num");
        
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
    
    /*
     * 新增数据
     */
    public function add_one($data) {
        $id = $this->add($data);
        
        return $id;
    }
    
    
}

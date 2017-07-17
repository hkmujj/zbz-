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

class GalleriesModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="gallery_id",$order=0) {
        if($order==0)
        {
            //ASC
            $order_str = "rank DESC,$order_by ASC";
        }
        else
        {
            //DESC
            $order_str = "rank DESC,$order_by DESC";
        }
        $res = $this->order($order_str)->select();
        
        return $res;
    }
    
    public function get_all_with_filter($order_by="gallery_id",$order=0,$data) {
        if($order==0)
        {
            //ASC
            $order_str = "rank DESC,$order_by ASC";
        }
        else
        {
            //DESC
            $order_str = "rank DESC,$order_by DESC";
        }
        
        if(!empty($data['name']))
        {
            $map['gallery_name'] = array("like","%".trim($data['name'])."%");
        }
        
        $res = $this->order($order_str)->where($map)->select();
        
//        $res['sql'] = $this->getLastSql();
        
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
    
    /*
     * 新增数据
     */
    public function add_one($data) {
        $id = $this->add($data);
        
        return $id;
    }
    
}

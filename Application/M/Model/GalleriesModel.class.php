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

class GalleriesModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="gallery_id",$order=0) {
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
    
    public function get_all_with_filter($order_by="gallery_id",$order=0,$data) {
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
    


}

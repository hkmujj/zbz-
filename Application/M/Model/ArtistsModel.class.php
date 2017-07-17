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

class ArtistsModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="artist_id",$order=0) {
        if($order==0)
        {
            //ASC
            $order_str = "rank desc,$order_by ASC";
        }
        else
        {
            //DESC
            $order_str = "rank desc,$order_by DESC";
        }
        $res = $this->order($order_str)->select();
        
        return $res;
    }
    
    public function get_all_with_filter($order_by="artist_id",$order=0,$data) {
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
            $map['artist_name'] = array("like","%".trim($data['name'])."%");
        }
        
        
        $res = $this->where($map)->order($order_str)->select();
        
        return $res;
    }
    
    
    /*
     * 获取单个记录
     */
    public function get_one($id=0) {
        $res = $this->find($id);
         /*
         * 浏览加1
         */
        $this->where("artist_id=".$id)->setInc("view_count");
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
    
    
     /*
     * 保存新数据
     */
    public function save_one($data) {
        $id = $data['artist_id'];
        $this->where("artist_id=".$id)->save($data);
        return $id;
    }
    
    
    /*
     * 艺术家名下的作品加减
     */
    public function my_works_count_modify($artist_id,$count=0) {
        if($count>0)
        {
            $this->where("artist_id=$artist_id")->setInc("work_count");
        }
        else
        {
            $this->where("artist_id=$artist_id")->setDec("work_count");
        }
        
    }
    
}

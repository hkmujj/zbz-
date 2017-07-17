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

class WorksModel extends Model{
    
    
    /*
     * 获取所有记录
     */
    public function get_all($order_by="work_id",$order=0) {
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
        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name as artist_name ")
                ->join("Left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                ->order($order_str)->select();
        
        return $res;
    }
    
    
    //根据提交的参数来区分搜索结果
    public function get_all_with_filter($order_by="work_id",$order=0,$data) {
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
        
        if(!empty($data['cat_id']))
        {
            $map['zbz_works.cat_id'] = $data['cat_id'];
        }
        
        if(!empty($data['topic_id']))
        {
            $map['zbz_works.topic_id'] = $data['topic_id'];
        }
        
        if(!empty($data['name']))
        {
            $map['zbz_works.name'] = array("like","%".trim($data['name'])."%");
        }
        
        if(!empty($data['artist_id']))
        {
            $map['zbz_works.artist_id'] = $data['artist_id'];
        }
        
        if(!empty($data['creat_year']))
        {
            $map['zbz_works.creat_year'] = $data['creat_year'];
        }
        
        if(!empty($data['buy_price1'])&&!empty($data['buy_price2']))
        {
            $map['zbz_works.buy_price'] = array(array("egt",$data['buy_price1']),array("elt",$data['buy_price2']));
//            $map['zbz_works.buy_price'] = ;
        }
        
        if(!empty($data['rent_price1'])&&!empty($data['rent_price2']))
        {
            $map['zbz_works.rent_price'] = array(array("egt",$data['rent_price1']),array("elt",$data['rent_price2']));
//            $map['zbz_works.rent_price'] = ;
        }
        
        if(!empty($data['wwidth1'])&&!empty($data['wwidth2']))
        {
            $map['zbz_works.wwidth'] = array(array("egt",$data['wwidth1']),array("elt",$data['wwidth2']));
//            $map['zbz_works.wwidth'] = ;
        }
        
        if(!empty($data['wheight1'])&&!empty($data['wheight2']))
        {
            $map['zbz_works.wheight'] = array(array("egt",$data['wheight1']),array("elt",$data['wheight2']));
//            $map['zbz_works.wheight'] = ;
        }
        
        
        
        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category,zbz_artists.artist_name as artist_name ")
                ->join("Left JOIN zbz_artists ON zbz_artists.artist_id = zbz_works.artist_id")
                ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                ->order($order_str)
                ->where($map)->select();
        
//        $sql = $this->getLastSql();
        
//        $res['sql'] = $sql;
        return $res;
    }
    
    
    public function get_lists_by_page($pagecount=0) {
       
        $startcount= $pagecount*10;
        
        $res = $this->field("zbz_works.*,zbz_work_topic.name as topic,zbz_work_categories.name as category")
                ->join("Left JOIN zbz_work_topic ON zbz_work_topic.topic_id = zbz_works.topic_id")
                ->join("Left JOIN zbz_work_categories ON zbz_work_categories.cat_id = zbz_works.cat_id")
                ->order("rank DESC,work_id DESC")->limit($startcount,10)->select();
        
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

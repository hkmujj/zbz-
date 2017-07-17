<?php

namespace Admin\Controller;

use Think\Controller;

class CreditController extends CommonController {
    public function _initialize() {
        parent::_initialize();
        $this->chk_if_login();
    }
    /*
     * 列表
     * 
     */

    public function lists() {
        if (IS_AJAX) {
            
        } else {
            $this->display();
        }
    }
    
    /*
     * 获取会员积分记录列表
     */

    public function get_record_lists() {
        $dbModel = M("member_credit_task_record");
        
        $res = $dbModel->order("ctime DESC")
                ->field("zbz_members.nickname,zbz_member_credit_task_record.*")
                ->join("LEFT JOIN __MEMBERS__ ON __MEMBERS__.mid=__MEMBER_CREDIT_TASK_RECORD__.mid")
                ->select();

        echo json_encode($res);
    }
    

    /*
     * 获取列表
     */

    public function get_lists() {
        $dbModel = new \Admin\Model\CreditModel();
        $res = $dbModel->get_all('ctime', 1);

        echo json_encode($res);
    }
    
    /*
     * edit
     * 修改任务的积分奖励
     * 
     */
    public function edit() {
        if(IS_POST)
        {
            $id = I("post.id");
            
            $task_credit = I("post.task_credit");
            
            $data['id'] = $id;
            $data['task_credit'] = $task_credit;
            
            $dbModel = new \Admin\Model\CreditModel();
            $id = $dbModel->save_one($data);
            
            $output['err'] = 0;
            $output['msg'] = "成功";
            
            echo json_encode($output);
        }
        else{
            $id = I("get.id");
            $dbModel = new \Admin\Model\CreditModel();
            $res = $dbModel->get_one($id);
            
            $this->assign("result", $res);
            
            $this->display();
        }
    }
    
    
    /*
     * 配置
     */
    public function setting() {
        $this->display();
    }

}

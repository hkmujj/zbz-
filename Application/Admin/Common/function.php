<?php

function json_out($data,$msg=""){
    
    if(!empty($data))
    {
        $output['err']= 0 ;
        $output['content'] = $data;
    }
    else
    {
        $output['err']=1;
        $output['content'] = new stdClass();
    }
    
    $output['msg'] = $msg;
    
    
    echo json_encode($output);
}
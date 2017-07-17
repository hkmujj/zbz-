<?php

namespace M\Controller;

use Think\Controller;

class SettingController extends CommonController {

    public function index() {
        $this->display();
    }

    /*
     * 关于我们
     */

    public function aboutus() {
        $map['keywords'] = "aboutus";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);

        $this->display();
    }

    /*
     * 客服中心
     */

    public function service() {
        $map['keywords'] = "service";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);

        $this->display();
    }

    /*
     * 购买协议
     */
    public function buy() {
       $map['keywords'] = "buy";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);

        $this->display(); 
    }

    /*
     * 租赁协议查看
     */
    public function rent() {
        $oid = I("get.oid");
        
        $order = M("orders")->find($oid);
        $map['zbz_orders_works.order_id'] = $oid;
        $order_works = M("orders_works")->where($map)
                                        ->field("zbz_works.work_number,zbz_works.name,zbz_works.buy_price as price,zbz_orders_works.*")
                                        ->join("left join zbz_works on zbz_works.work_id = zbz_orders_works.work_id")
                                        ->select();
        $order['new_etime'] = strtotime('+6 month', $order['btime']);
        $order['new_etime2'] = strtotime('+18 month', $order['btime']);
//        $this->assign("order", $order);
//        $this->assign("order_works", $order_works);
//        $this->assign("order_count", count($order_works));
        $order_count = count($order_works);
        $order_works_value = 0;
        foreach ($order_works as $key => $value) {
            $order_works_value +=$value['price'];
        }
//        $this->assign("order_works_value", $order_works_value);
        
        $img_url = $this->order_contract_create($oid, $order_count, $order_works_value, $order_count, $order['order_amount'], date("Y",$order['btime']), date("m",$order['btime']), date("d",$order['btime']), date("Y",$order['new_etime2']), date("m",$order['new_etime2']), date("d",$order['new_etime2']), 1, 6,  date("Y",$order['btime']), date("m",$order['btime']), date("d",$order['btime']), date("Y",$order['new_etime']), date("m",$order['new_etime']), date("d",$order['new_etime']));
//        echo M("orders_works")->getLastSql();
//        print_r($order_works);
        $this->assign("contract_img", $img_url);
        $this->display();
    }
    
    
    /*
     * 合成图片
     * 
     * 需要输出的数据有:
     * 数量
     * 总价值
     * 数量
     * 租赁费用
     * 开始租赁的年、月、日
     * 到期的年、月、日
     * 租赁时长 年 月
     * 免费租赁期 年月日
     * 到期年月日
     * 
     */
    public function order_contract_create($oid,$text1,$text2,$text3,$text4,$text5,$text6,$text7,$text8,$text9,$text10,$text11,$text12,$text13,$text14,$text15,$text16,$text17,$text18) {
        $image = new \Think\Image();
            
//            $text1 = "1"; //多少件
            $pos1[] = 161;
            $pos1[] = 713;

            //艺术品价值
//            $text2 = "100"; 
            $pos2[] = 464;
            $pos2[] = 713;
            
            
//            $text3 = "1"; //多少件
            $pos3[] = 1330;
            $pos3[] = 1831;
            
            
//            $text4 = "1"; 
            $pos4[] = 319;
            $pos4[] = 1896;
            
            
//            租赁开始年月日
//            $text5 = "2017"; 
            $pos5[] = 171;
            $pos5[] = 2180;
            
            
//            $text6 = "1"; 
            $pos6[] = 340;
            $pos6[] = 2180;
            
            
//            $text7 = "1"; 
            $pos7[] = 462;
            $pos7[] = 2180;
            
            
//            $text8 = "2017"; 
            $pos8[] = 664;
            $pos8[] = 2180;
            
            
//            $text9 = "1"; 
            $pos9[] = 820;
            $pos9[] = 2180;
            
            
//            $text10 = "1"; 
            $pos10[] = 940;
            $pos10[] = 2180;
            
            
//            $text11 = "1"; 
            $pos11[] = 1260;
            $pos11[] = 2180;
            
            
//            $text12 = "6"; 
            $pos12[] = 1360;
            $pos12[] = 2180;
            
            
//            $text13 = "2017"; 
            $pos13[] = 232;
            $pos13[] = 2240;
            
            
//            $text14 = "1"; 
            $pos14[] = 388;
            $pos14[] = 2240;
            
            
//            $text15 = "1"; 
            $pos15[] = 500;
            $pos15[] = 2240;
            
            
//            $text16 = "2017"; 
            $pos16[] = 660;
            $pos16[] = 2240;
            
            
//            $text17 = "1"; 
            $pos17[] = 820;
            $pos17[] = 2240;
            
            
//            $text18 = "1"; 
            $pos18[] = 940;
            $pos18[] = 2240;
            
            

            $image->open('./Uploads/contract/demo_contract.jpeg')
                        ->text("$text1",'./Uploads/contract/font.ttf',24,'#333',$pos1)
                        ->text("$text2",'./Uploads/contract/font.ttf',24,'#333',$pos2)
                        ->text("$text3",'./Uploads/contract/font.ttf',24,'#333',$pos3)
                        ->text("$text4",'./Uploads/contract/font.ttf',24,'#333',$pos4)
                        ->text("$text5",'./Uploads/contract/font.ttf',24,'#333',$pos5)
                        ->text("$text6",'./Uploads/contract/font.ttf',24,'#333',$pos6)
                        ->text("$text7",'./Uploads/contract/font.ttf',24,'#333',$pos7)
                        ->text("$text8",'./Uploads/contract/font.ttf',24,'#333',$pos8)
                        ->text("$text9",'./Uploads/contract/font.ttf',24,'#333',$pos9)
                        ->text("$text10",'./Uploads/contract/font.ttf',24,'#333',$pos10)
                        ->text("$text11",'./Uploads/contract/font.ttf',24,'#333',$pos11)
                        ->text("$text12",'./Uploads/contract/font.ttf',24,'#333',$pos12)
                        ->text("$text13",'./Uploads/contract/font.ttf',24,'#333',$pos13)
                        ->text("$text14",'./Uploads/contract/font.ttf',24,'#333',$pos14)
                        ->text("$text15",'./Uploads/contract/font.ttf',24,'#333',$pos15)
                        ->text("$text16",'./Uploads/contract/font.ttf',24,'#333',$pos16)
                        ->text("$text17",'./Uploads/contract/font.ttf',24,'#333',$pos17)
                        ->text("$text18",'./Uploads/contract/font.ttf',24,'#333',$pos18)
                        ->save("./Uploads/contract/$oid.jpg");
            
            
        return "/Uploads/contract/$oid.jpg";    
            
    }
    

    /*
     * 配送货说明
     */

    public function shipping() {
        $map['keywords'] = "shipping";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);
        

        $this->display();
    }

    /*
     * 珍宝斋租赁流程
     */

    public function rent_flow() {
        $map['keywords'] = "rent";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);

        $this->display();
    }
    
    /*
     * 珍宝斋鉴证备案
     */

    public function beian() {
        $map['keywords'] = "beian";
        $res = M("setting_mobile_pages")->where($map)->find();

        $this->assign("result", $res);

        $this->display();
    }

}

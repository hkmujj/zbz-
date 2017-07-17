<?php

namespace M\Controller;

use Think\Controller;

class ShoppingcartController extends CommonController {

    //支付回调地址
    protected $Wxcallbackcurl;

    public function _initialize() {
        $this->Wxcallbackcurl = "http://".$_SERVER['HTTP_HOST']."/index.php/M/Shoppingcart/wxpayment_notify";
        parent::_initialize();
    }

    public function index() {
        $mid = $this->memberinfo['mid'];
        $cartModel = new \M\Model\ShoppingcartModel();
        $buy_lists = $cartModel->get_all_in_cart($mid, 0);
        $rent_lists = $cartModel->get_all_in_cart($mid, 1);
        $this->assign("buy_lists", $buy_lists);
        $this->assign("rent_lists", $rent_lists);

//        print_r($rent_lists);

        $this->display();
    }

    /*
     * 增加到购物车
     */

    public function add() {
        $mid = $this->memberinfo['mid'];
        $type = I("post.type");
        $id = I("post.id");

        /*
         * 判断购物车的产品数量,超过5个就不可以在添加了
         */
        $cartModel = new \M\Model\ShoppingcartModel();
        $count = $cartModel->get_cart_num($mid, $type);

        if ($count >= 5) {
            $res['err'] = 4;
            $res['msg'] = "购物车数量已经到达上限";

            echo json_encode($res);
            exit();
        }

        $workModel = new \M\Model\WorksModel();
        $work_res = $workModel->get_one_status($id);


        $chk_in_cart = $cartModel->chk_in_cart($mid, $id);

        if ($type == 0) {
            //购买


            if ($work_res && $chk_in_cart) {
                $data['mid'] = $mid;
                $data['work_id'] = $work_res['work_id'];
                $data['work_name'] = $work_res['name'];
                $data['work_buy_price'] = $work_res['buy_price'];
                $data['work_rent_price'] = $work_res['rent_price'];
                $data['type'] = $type;
                $data['ctime'] = NOW_TIME;

                $db = M("orders_shopping_cart");
                $id = $db->add($data);

                if ($id) {
                    $res['err'] = 0;
                    $res['msg'] = "添加成功";
                }
            } else {
                $res['err'] = 1;
                $res['msg'] = "产品已添加";
            }
        } else {
            //租赁
            if ($work_res && $chk_in_cart) {
                $data['mid'] = $this->memberinfo['mid'];
                $data['work_id'] = $work_res['work_id'];
                $data['work_name'] = $work_res['name'];
                $data['work_buy_price'] = $work_res['buy_price'];
                $data['work_rent_price'] = $work_res['rent_price'];
                $data['type'] = $type;
                $data['ctime'] = NOW_TIME;

                $db = M("orders_shopping_cart");
                $id = $db->add($data);

                if ($id) {
                    $res['err'] = 0;
                    $res['msg'] = "添加成功";
                }
            } else {
                $res['err'] = 1;
                $res['msg'] = "产品已添加";
            }
        }

        echo json_encode($res);
    }

    /*
     * 提交选中商品准备生成订单
     * 
     * 1. 先order表新建
     * 2. 再在 order_works 建
     * 
     * 
     */

    public function creat_order_buy() {
        $cart_id_arr = $_POST['buyitems'];
        if (!empty($cart_id_arr)) {
            $mid = $this->memberinfo['mid'];
            $order_sn = $this->creat_order_sn();

            $data_order['mid'] = $mid;
            $data_order['order_sn'] = $order_sn;
            $data_order['order_type'] = 0;
            $data_order['ctime'] = NOW_TIME;
            $data_order['ctime_date'] = date("Ymd");


            $order_id = M("orders")->add($data_order);
            if ($order_id) {

                $order_works_arr = array();
                $order_amount = 0;
                foreach ($cart_id_arr as $key => $value) {

                    $res_cart = M("orders_shopping_cart")->find($value);
                    $work_item = M("works")->find($res_cart['work_id']);
                    $order_amount +=$work_item['buy_price'];

                    $order_works_arr[] = array(
                        'order_id' => $order_id,
                        'order_sn' => $order_sn,
                        'work_id' => $res_cart['work_id'],
                        'order_type' => 0,
                        'buy_price' => $work_item['buy_price']
                    );
                }


                M("orders_works")->addAll($order_works_arr);


                //清理掉购物车记录
                foreach ($cart_id_arr as $key => $value) {
                    M("orders_shopping_cart")->delete($value);
                }


                //修改订单的价格
                $new_order_data['order_amount'] = $order_amount;
                M("orders")->where("oid=$order_id")->save($new_order_data);

                $output['err'] = 0;
                $output['msg'] = "添加成功";
                $output['order_id'] = $order_id;
            } else {
                $output['err'] = 1;
                $output['msg'] = "创建出错,请稍候再提交";
            }
        } else {
            $output['err'] = 2;
            $output['msg'] = "创建出错,请稍候再提交";
        }


        echo json_encode($output);
    }
    
    /*
     * 快速购买单张
     * 
     * 通过一个 workid 来快速生成订单
     * 
     */
    public function creat_order_buy_quickly()
    {
        $work_id = I("get.work_id");
        //判断是否有效
        $res = M("works")->find($work_id);
        
        if($res['wstatus']==0)
        {
            $mid = $this->memberinfo['mid'];
            
            $order_sn = $this->creat_order_sn();
            $data_order['mid'] = $mid;
            $data_order['order_sn'] = $order_sn;
            $data_order['order_type'] = 0;
            $data_order['ctime'] = NOW_TIME;
            $data_order['ctime_date'] = date("Ymd");

            $data_order['order_amount'] = $res['buy_price'];
            
            $order_id = M("orders")->add($data_order);
            
            if($order_id)
            {
                $order_works = array(
                        'order_id' => $order_id,
                        'order_sn' => $order_sn,
                        'work_id' => $work_id,
                        'order_type' => 0,
                        'buy_price' =>  $res['buy_price']
                    );
                
                M("orders_works")->add($order_works);
                
                $ret['err'] = 0;
                $ret['msg'] = "添加成功";
                $ret['order_id'] = $order_id;
            }
            
        }
        else
        {
            $ret['err'] = 99;
            $ret['msg'] = "该作品已经被出售或非卖品";
        }
        echo json_encode($ret);
        
    }

    public function creat_order_rent() {
        $cart_id_arr = $_POST['rentitems'];

        if (!empty($cart_id_arr)) {
            $mid = $this->memberinfo['mid'];
            $order_sn = $this->creat_order_sn();

            $data_order['mid'] = $mid;
            $data_order['order_sn'] = $order_sn;
            $data_order['order_type'] = 1;
            $data_order['ctime'] = NOW_TIME;
            $data_order['ctime_date'] = date("Ymd");
            $data_order['rent_limit'] = 1;

            $data_order['btime'] = NOW_TIME;
            
            //一年后的时间
            $timenow = time(); //当前时间戳
            $date_next = date('Y',$timenow) + 1 . '-' . date('m-d H:i:s');//一年后日期
            $time_nextyear = strtotime($date_next);
            
            $data_order['etime'] = $time_nextyear;

            $order_id = M("orders")->add($data_order);
            if ($order_id) {

                $order_works_arr = array();
                $order_amount = 0;
                foreach ($cart_id_arr as $key => $value) {

                    $res_cart = M("orders_shopping_cart")->find($value);
                    $work_item = M("works")->find($res_cart['work_id']);
                    $order_amount += $work_item['rent_price'];


                    $order_works_arr[] = array(
                        'order_id' => $order_id,
                        'order_sn' => $order_sn,
                        'work_id' => $res_cart['work_id'],
                        'order_type' => 1,
                        'rent_price' => $work_item['rent_price']
                    );
                }


                M("orders_works")->addAll($order_works_arr);


                //清理掉购物车记录
                foreach ($cart_id_arr as $key => $value) {
                    M("orders_shopping_cart")->delete($value);
                }

                //修改订单的价格
                $new_order_data['order_amount'] = $order_amount;
                M("orders")->where("oid=$order_id")->save($new_order_data);


                $output['err'] = 0;
                $output['msg'] = "添加成功";
                $output['order_id'] = $order_id;
            } else {
                $output['err'] = 1;
                $output['msg'] = "创建出错,请稍候再提交";
            }
        } else {
            $output['err'] = 2;
            $output['msg'] = "创建出错,请稍候再提交";
        }


        echo json_encode($output);
    }
    
    /*
     * 快速租赁单张
     * 
     * 通过一个 workid 来快速生成订单
     * 
     */
    public function creat_order_rent_quickly()
    {
        $work_id = I("get.work_id");
        //判断是否有效
        $res = M("works")->find($work_id);
        
        if($res['wstatus']==0)
        {
            $mid = $this->memberinfo['mid'];
            
            $order_sn = $this->creat_order_sn();
            $data_order['mid'] = $mid;
            $data_order['order_sn'] = $order_sn;
            $data_order['order_type'] = 1;
            $data_order['ctime'] = NOW_TIME;
            $data_order['ctime_date'] = date("Ymd");

            $data_order['order_amount'] = $res['rent_price'];
            $data_order['btime'] = NOW_TIME;
            
            //一年后的时间
            $timenow = time(); //当前时间戳
            $date_next = date('Y',$timenow) + 1 . '-' . date('m-d H:i:s');//一年后日期
            $time_nextyear = strtotime($date_next);
            
            $data_order['etime'] = $time_nextyear;
            
            $order_id = M("orders")->add($data_order);
            
            if($order_id)
            {
                $order_works = array(
                        'order_id' => $order_id,
                        'order_sn' => $order_sn,
                        'work_id' => $work_id,
                        'order_type' => 1,
                        'rent_price' =>  $res['rent_price']
                    );
                
                M("orders_works")->add($order_works);
                
                $ret['err'] = 0;
                $ret['msg'] = "添加成功";
                $ret['order_id'] = $order_id;
            }
            
        }
        else
        {
            $ret['err'] = 99;
            $ret['msg'] = "该作品已经被出售或非卖品";
        }
        echo json_encode($ret);
        
    }

    /*
     * 删除购物车数据
     */

    public function del_shoppingcart_buy() {
        $cart_id_arr = $_POST['buyitems'];
        if (!empty($cart_id_arr)) {
//            $mid = $this->memberinfo['mid'];
            foreach ($cart_id_arr as $key => $value) {

                M("orders_shopping_cart")->delete($value);
            }

            $output['err'] = 0;
            $output['msg'] = "成功";
        }

        echo json_encode($output);
    }

    public function del_shoppingcart_rent() {
        $cart_id_arr = $_POST['rentitems'];
        if (!empty($cart_id_arr)) {
//            $mid = $this->memberinfo['mid'];
            foreach ($cart_id_arr as $key => $value) {

                M("orders_shopping_cart")->delete($value);
            }

            $output['err'] = 0;
            $output['msg'] = "成功";
        }

        echo json_encode($output);
    }
    
    
    

    /*
     * 购物车结算
     * 
     * 1. 需要先判断权限
     * 
     */

    public function submit_order() {
        $data['mid'] = $this->memberinfo['mid'];
        $data['oid'] = I("get.oid");
        
        $from_src = I("get.from_src");

        if($from_src)
        {
            $this->assign("from_src", 1);
        }
        else
        {
            $this->assign("from_src", 0);
        }
        $res = M("orders")->where($data)->find();
        if (!empty($res)) {
            //获取订单的具体产品信息
            $map['zbz_orders_works.order_id'] = I("get.oid");
            $order_details = M("orders_works")->where($map)->field("zbz_orders_works.*,zbz_works.thumb")
                    ->join("LEFT JOIN zbz_works ON zbz_works.work_id = zbz_orders_works.work_id")
                    ->select();

            $order_details_count = count($order_details);

            $this->assign("order_details", $order_details);
            $this->assign('order_details_count', $order_details_count);

            //获取优惠券的信息

            if (!empty($res['coupon_id'])) {
                
                $res1 = M("member_coupons_record")->find($res['coupon_id']);
                
                $coupon_res = M("member_coupons")->find($res1['coupon_id']);

                $new_order_amount = $res['order_amount'] - $coupon_res['coupon_value'];

                $res['order_amount_to_pay'] = $new_order_amount;
            } else {
                $res['order_amount_to_pay'] = $res['order_amount'];
            }
            $this->assign("order", $res);

            $this->display();

//            $this->display();
        } else {
            echo "订单不合法";
        }
    }

    /*
     * 取消订单
     */

    public function cancel_order() {
        $oid = I("post.oid");
        $mid = $this->memberinfo['mid'];

        $data['mid'] = $mid;
        $data['oid'] = $oid;

        $res = M("orders")->where($data)->find();

        if (!empty($res)) {
            if ($res['order_status'] == 0) {
                $data_save['order_status'] = 2;
                M("orders")->where("oid=$oid")->save($data_save);

                $ret['err'] = 0;
                $ret['msg'] = "订单已经取消";
            } else {
                $ret['err'] = 10;
                $ret['msg'] = "订单不合法";
            }
        } else {
            $ret['err'] = 1;
            $ret['msg'] = "订单不合法";
        }

        echo json_encode($ret);
    }

    /*
     * 选择收货地址
     */

    public function address_pick() {

        if (IS_POST) {
            $oid = I("post.oid");
            $address_id = I("post.id");
            $address_res = M("member_address")->find($address_id);

            $data_update['contact'] = $address_res['contact'];
            $data_update['contact_mobile'] = $address_res['contact_mobile'];
            $data_update['contact_address'] = $address_res['address'];

            M("orders")->where("oid = $oid")->save($data_update);

            $res['err'] = 0;
            $res['msg'] = "选择成功";

            echo json_encode($res);
        } else {
            $oid = I("get.oid");
            $this->assign("oid", $oid);

            $map['mid'] = $this->memberinfo['mid'];
            $address_res = M("member_address")->order("ctime desc")->where($map)->select();

            $this->assign("address_res", $address_res);

            $this->display();
        }
    }

    /*
     * 配送方式
     */

    public function shipping_way() {
        if (IS_POST) {
            $oid = I("post.oid");
            $shipping_way_id = I("post.id");

            $data_update['service_type'] = $shipping_way_id;

            M("orders")->where("oid = $oid")->save($data_update);

            $res['err'] = 0;
            $res['msg'] = "选择成功";

            echo json_encode($res);
        } else {
            $oid = I("get.oid");
            $this->assign("oid", $oid);
            $this->display();
        }
    }

    /*
     * 发票信息
     */

    public function invoice_pick() {
        if (IS_POST) {
            $oid = I("post.oid");
            $ifinvoice = I("post.ifinvoice");
            if ($ifinvoice) {
                $invoice_title = I("post.invoice_title");

                $data_update['invoice_title'] = $invoice_title;

                M("orders")->where("oid = $oid")->save($data_update);

                $res['err'] = 0;
                $res['msg'] = "选择成功";

                echo json_encode($res);
            } else {
                $res['err'] = 0;
                $res['msg'] = "选择成功";

                echo json_encode($res);
            }
        } else {
            $oid = I("get.oid");
            $this->assign("oid", $oid);
            $this->display();
        }
    }

    /*
     * 代金券选择
     */

    public function coupons_pick() {
        if (IS_POST) {
            $oid = I("post.oid");
            $coupon_flow_id = I("post.coupon_flow_id");
            if (!empty($coupon_flow_id)) {
                
                $res_coupon_flow = M("member_coupons_record")->find($coupon_flow_id);
                
                
                $coupon_res = M("member_coupons")->find($res_coupon_flow['coupon_id']);

                $data_update['coupon_id'] = $coupon_flow_id;
                $data_update['discount'] = $coupon_res['coupon_value'];


                M("orders")->where("oid = $oid")->save($data_update);
            }


            $res['err'] = 0;
            $res['msg'] = "选择成功";

            echo json_encode($res);
        } else {
            $oid = I("get.oid");
            $this->assign("oid", $oid);
            
            //判断是否超过 2000 元的订单
            
            $order_res = M("orders")->find($oid);
            
            if($order_res['order_amount']>=2000)
            {
                $order_res = M("orders")->find($oid);
            
                //获取所有的代金券
                $map['zbz_member_coupons_record.coupon_value'] = array("elt",$order_res['order_amount']); //代金券需要是小于订单总金额
                $map['zbz_member_coupons_record.mid'] = $this->memberinfo['mid'];
                $map['zbz_member_coupons_record.isused'] = 0;
                $map['zbz_member_coupons_record.etime']  = array("gt",NOW_TIME);
                $coupons = M("member_coupons_record")->where($map)
                        ->field("zbz_member_coupons_record.*,zbz_member_coupons.thumb")
                        ->join("LEFT JOIN zbz_member_coupons ON zbz_member_coupons.coupon_id =zbz_member_coupons_record.coupon_id")
                        ->select();

                
            }
            
            else
            {
               $coupons = array(); 
            }
            $this->assign("coupons", $coupons);
            
            

            $this->display();
        }
    }

    public function payment() {
        vendor('Wxpay.WxPay#Api');
        vendor('Wxpay.WxPay#JsApiPay');

        $oid = I("get.oid");
        $res = M("orders")->find($oid);
        if (empty($res)) {
            echo "订单出错";
            exit();
        }

        //判断订单的状态
        if ($res['order_status'] == 0) {
            if ($res['pay_status'] == 0) {
//                $res['order_status_tag'] = 0;
//                $res['order_status_cn'] = "未支付";
            } else {
                if ($res['shipping_status'] == 0) {
//                    $res['order_status_tag'] = 10;
//                    $res['order_status_cn'] = "已支付,未派送";

                    redirect(U('Orders/detail', array('oid' => $oid)));
                } else {
//                    $res['order_status_tag'] = 11;
//                    $res['order_status_cn'] = "已支付,已派送";

                    redirect(U('Orders/detail', array('oid' => $oid)));
                }
            }
        } elseif ($res['order_status'] == 1) {
//            $res['order_status_tag'] = 1;
//            $res['order_status_cn'] = "已完成";

            redirect(U('Orders/detail', array('oid' => $oid)));
        } else {
//           $res['order_status_tag'] = 2;
//           $res['order_status_cn'] = "已取消";

            redirect(U('Orders/detail', array('oid' => $oid)));
        }


        //①、获取用户openid
        $tools = new \JsApiPay();
        $openId = $tools->GetOpenid(); //官方无参数
        //
        //$openId = $tools->GetOpenid("?id=".$id."&Id=".$_REQUEST["Id"]."&title=".urlencode($title));//官方无参数，需要的时候加上
        $title = "珍宝斋交易订单支付";
        //$title=iconv('gbk', 'utf-8',$title);
        //$trade_no=WxPayConfig::MCHID.date("YmdHis");
        $trade_no = $res['order_sn'] . $this->random_code();
        //vendor('Wxpay.WxPay#Data');
        //②、统一下单
        $Body = "珍宝斋交易订单支付";
        $Total_fee = 1;

//        $Total_fee = ($res['order_amount']- $res['discount'])*100;


        $input = new \WxPayUnifiedOrder();
        $input->SetBody($Body);
        $input->SetAttach($title);
        $input->SetOut_trade_no($trade_no);
        $input->SetTotal_fee($Total_fee); //单位分
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("payment");
        $input->SetNotify_url($this->Wxcallbackcurl);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        /* echo "<pre>";
          print_r($input);die; */
        $order = \WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $this->assign("jsApiParameters", $jsApiParameters);

        $this->assign("order", $res);

        $this->display();
    }

    /*
     * 支付通知
     */

    public function wxpayment_notify() {
        Vendor('Wxpay.WxPay#Api');
        $raw_xml = file_get_contents("php://input");
        $notify = new \WxPayNotifyCallBack();
        $notify->Handle(false);
        $res = $notify->GetValues();
        if ($res['return_code'] === "SUCCESS" && $res['return_msg'] === "OK") {
            libxml_disable_entity_loader(true);
            $ret = json_decode(json_encode(simplexml_load_string($raw_xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            \Think\Log::write('微信APP支付成功订单号' . $ret['out_trade_no'], \Think\Log::DEBUG);
            //在此处处理业务逻辑部分

            /*
             * 支付成功的订单。要修改
             * 
             * 1. 订单的状态
             * 2. 对应产品的状态
             * 3. 使用的代金券的状态
             * 
             * 
             */

            $order_sn_raw = $ret['out_trade_no'];
            $order_sn = substr($order_sn_raw, 0, -5);
            $dbModel = M("orders");

//            $map['order_sn'] = $order_sn;
            $data['pay_status'] = 1;
            if($dbModel->where("order_sn = $order_sn")->save($data))
            {
                $order = $dbModel->where("order_sn = $order_sn")->find();

                $map1['order_sn'] = $order_sn;
                $order_works = M("orders_works")->where($map1)->select();
                
                $wstatus = ($order['order_type']==0) ?"1":"2";
                foreach ($order_works as $key => $value) {
                    $data1['wstatus'] = $wstatus;
                    M("works")->where("work_id = " . $value['work_id'])->save($data1);
                }

                if ($order['coupon_id'] > 0) {
                    $data2['isused'] = 1;
                    M("zbz_member_coupons_record")->where("id=" . $order['coupon_id'])->save($data2);
                }

                //根据订单的类型来赠送积分
                
                if($order['order_type']==0)
                {
                    //购买的
                    $credit_value = $this->add_credit_to_member("buy_work", $order['mid']);
                    if($credit_value>0)
                    {
                        M("members")->where("mid=" . $order['mid'])->setInc("credit", $credit_value);
                    }
                }
                else
                {
                    $credit_value = $this->add_credit_to_member("rent_work", $order['mid']);
                    if($credit_value>0)
                    {
                        M("members")->where("mid=" . $order['mid'])->setInc("credit", $credit_value);
                    }
                }
                
            }

            
            
            
        }
    }

}

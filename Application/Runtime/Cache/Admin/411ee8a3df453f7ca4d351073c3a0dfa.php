<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo ($site_config['title']); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo ($resource_path); ?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ($resource_path); ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo ($resource_path); ?>/dist/css/skins/_all-skins.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sidebar-mini skin-blue-light">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">九一</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>管理后台</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo ($resource_path); ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">管理员</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo ($resource_path); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  管理员
                  
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
<!--                  <a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                  <a href="<?php echo U('Common/logout');?>" class="btn btn-default btn-flat">退出系统</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="Setting_dashboard"><a href="<?php echo U('Setting/dashboard');?>"><i class="fa fa-dashboard"></i> <span>首页</span></a></li>
        <li class="header">订单模块</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bookmark"></i> <span>租赁订单</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Orders_rent_orders"><a href="<?php echo U('Orders/rent_orders');?>"><i class="fa fa-circle-o"></i> 订单列表</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-book"></i> <span>购买订单</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Orders_buy_orders"><a href="<?php echo U('Orders/buy_orders');?>"><i class="fa fa-circle-o"></i> 订单列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bookmark-o"></i> <span>定制订单</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Orders_diy_orders"><a href="<?php echo U('Orders/diy_orders');?>"><i class="fa fa-circle-o"></i> 订单列表</a></li>
          </ul>
        </li>
        
        
        
        
        <li class="header">作品相关</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-picture-o"></i> <span>作品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Works_lists"><a href="<?php echo U('Works/lists');?>"><i class="fa fa-circle-o"></i>作品列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>艺术家管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Artists_lists"><a href="<?php echo U('Artists/lists');?>"><i class="fa fa-circle-o"></i>艺术家列表</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-chrome"></i> <span>装饰风格管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_mobile_index_showtype_config"><a href="<?php echo U('Setting/mobile_index_showtype_config');?>"><i class="fa fa-circle-o"></i>装饰风格列表</a></li>
          </ul>
        </li>        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i> <span>线下画廊管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Galleries_lists"><a href="<?php echo U('Galleries/lists');?>"><i class="fa fa-circle-o"></i>画廊列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bars"></i> <span>基础信息配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Works_cat_lists"><a href="<?php echo U('Works/cat_lists');?>"><i class="fa fa-circle-o"></i>艺术画分类</a></li>
            <li id="Works_topic_lists"><a href="<?php echo U('Works/topic_lists');?>"><i class="fa fa-circle-o"></i>艺术画题材</a></li>
          </ul>
        </li>
        
        <li class="header">会员模块</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Members_lists"><a href="<?php echo U('Members/lists');?>"><i class="fa fa-circle-o"></i>会员列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo U('Members/collection');?>"><i class="fa fa-star"></i>收藏列表</a>
        </li>
        <li class="treeview">
          <a href="<?php echo U('Members/focus');?>"><i class="fa fa-circle-o"></i>关注列表</a>
        </li>
        <li class="header">网络营销</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-credit-card"></i> <span>积分管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Credit_lists"><a href="<?php echo U('Credit/lists');?>"><i class="fa fa-circle-o"></i>积分获得记录</a></li>
            <li id="Credit_setting"><a href="<?php echo U('Credit/setting');?>"><i class="fa fa-circle-o"></i>积分配置</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clone"></i> <span>卡券管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Coupons_lists"><a href="<?php echo U('Coupons/lists');?>"><i class="fa fa-circle-o"></i>卡券兑换列表</a></li>
            <li id="Coupons_setting"><a href="<?php echo U('Coupons/setting');?>"><i class="fa fa-circle-o"></i>卡券配置</a></li>
          </ul>
        </li>
        <li class="header">资讯内容</li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-search"></i> <span>搜索配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_promotion_keyword_lists"><a href="<?php echo U('News/promotion_keyword_lists');?>"><i class="fa fa-search"></i>推荐搜索关键字</a></li>
            <li id="News_hot_keyword_lists"><a href="<?php echo U('News/hot_keyword_lists');?>"><i class="fa  fa-search-plus"></i>热门搜索关键字</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-desktop"></i> <span>Banner管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_startup_lists"><a href="<?php echo U('News/startup_lists');?>"><i class="fa fa-circle-o"></i>APP启动页图片</a></li>
            <li id="News_banner_lists"><a href="<?php echo U('News/banner_lists');?>"><i class="fa fa-circle-o"></i>首页banner</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-newspaper-o"></i> <span>资讯管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_lists"><a href="<?php echo U('News/lists');?>"><i class="fa fa-circle-o"></i>资讯列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-commenting-o"></i> <span>信息通知</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_msg_lists"><a href="<?php echo U('News/msg_lists');?>"><i class="fa fa-circle-o"></i>信息通知列表</a></li>
          </ul>
        </li>
        
        <li class="header">系统配置</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span>首页配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_mobile_index_config"><a href="<?php echo U('Setting/mobile_index_config');?>"><i class="fa fa-circle-o"></i>微商城首页</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-mobile"></i> <span>短信配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_sms_config"><a href="<?php echo U('Setting/sms_config');?>"><i class="fa fa-circle-o"></i>配置页面</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cc-visa"></i> <span>支付配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_payment_config_wx"><a href="<?php echo U('Setting/payment_config_wx');?>"><i class="fa fa-circle-o"></i>微信支付</a></li>
            <li id="Setting_payment_config_alipay"><a href="<?php echo U('Setting/payment_config_alipay');?>"><i class="fa fa-circle-o"></i>支付宝支付</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>其他配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_pages_setting_lists"><a href="<?php echo U('Setting/pages_setting_lists');?>"><i class="fa fa-circle-o"></i>固定页面内容</a></li>
          </ul>
        </li>
        <li class="header">官网配置</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tv"></i> <span>首页配置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_pc_banner_lists"><a href="<?php echo U('News/pc_banner_lists');?>"><i class="fa fa-circle-o"></i>首页banner</a></li>
            <li id="News_pc_index_img_lists"><a href="<?php echo U('News/pc_index_img_lists');?>"><i class="fa fa-circle-o"></i>首页缩略图</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>PC新闻资讯</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="News_pc_lists"><a href="<?php echo U('News/pc_lists');?>"><i class="fa fa-circle-o"></i>新闻列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar-minus-o"></i> <span>宣传页面</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Setting_pc_pages"><a href="<?php echo U('Setting/pc_pages');?>"><i class="fa fa-circle-o"></i>固定页面</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
      <h1>
        <?php echo ($site_config['first_nav']); ?>
        <small><?php echo ($site_config['second_nav']); ?></small>
      </h1>
<!--      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>-->
    </section>

            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-file-text-o"></i> 订单详情
                            <small class="pull-right">生成时间:　<?php echo (date("Y-m-d H:i:s",$order["ctime"])); ?></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <strong>买家信息</strong>
                        <address>
                            <?php echo ($order["contact"]); ?><br>
                            <?php echo ($order["contact_address"]); ?><br>
                            Phone: <?php echo ($order["contact_mobile"]); ?><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <strong>发票信息</strong>
                        <address>
                            <?php if(empty($order['invoice_title'])): ?>无
                                <?php else: ?>
                               <?php echo ($order["invoice_title"]); ?> <br><?php endif; ?>
                            
                            
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <strong>订单信息</strong>
                        <address>
                            订单号:　<?php echo ($order["order_sn"]); ?><br>
                            订单日期:　<?php echo ($order["ctime_date"]); ?><br>
                            <font color="red">订单状态:　<?php echo ($order["order_status_text"]); ?></font><br>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>艺术画名称</th>
                                    <th>主题</th>
                                    <th>分类</th>
                                    <th>价格(元)</th>
                                    <th>租赁期(年)</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php if(is_array($order["works"])): $i = 0; $__LIST__ = $order["works"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($i); ?></td>
                                    <td><?php echo ($vo["name"]); ?></td>
                                    <td><?php echo ($vo["topic_name"]); ?></td>
                                    <td><?php echo ($vo["cat_name"]); ?></td>
                                    <td><?php echo ($vo["buy_price"]); ?></td>
                                    <td>1</td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>   
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-10">
                        <p class="lead">客户留言:</p>
                        <?php echo ($order["remarks"]); ?>

                        
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">支付方式:</p>
                        
                        <?php if($order["pay_status"] == '1'): switch($order["payment_type"]): case "0": ?>微信支付<?php break;?>
                            <?php case "1": ?>支付宝<?php break;?>
                            <?php case "2": ?>银联<?php break;?>
                            <?php default: ?>未支付<?php endswitch;?>
                        <?php else: ?>
                        未支付<?php endif; ?>

                        
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">费用信息</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody><tr>
                                        <th style="width:50%">商品汇价（元）:</th>
                                        <td><?php echo ($order["order_amount"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>折扣（元）:</th>
                                        <td><?php echo ($order["discount"]); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th>支付总价（元）:</th>
                                        <td><?php echo ($order['order_amount']-$order['discount']) ?></td>
                                    </tr>
                                </tbody></table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <a type="button" target="_blank" href="<?php echo U('rent_orders_detail_print');?>?oid=<?php echo ($order['oid']); ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> 打印订单
                        </a>
                        
                        <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info">订单操作</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#" class="chg_order_status" data-id="0">未支付</a></li>
                          <li class="divider"></li>
                          <li><a href="#" class="chg_order_status" data-id="10">已支付,未派送</a></li>
                          <li><a href="#" class="chg_order_status" data-id="11">已支付,已派送</a></li>
                          <li><a href="#" class="chg_order_status" data-id="1">已完成</a></li>
                          <li class="divider"></li>
                          <li><a href="#" class="chg_order_status" data-id="2">取消订单</a></li>
                        </ul>
                      </div>
                        
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016-2017 </strong> All rights
    reserved.
  </footer>


        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo ($resource_path); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo ($resource_path); ?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo ($resource_path); ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo ($resource_path); ?>/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo ($resource_path); ?>/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo ($resource_path); ?>/dist/js/demo.js"></script>

    <script src="<?php echo ($resource_path); ?>/layer/layer.js"></script>
    <script type="text/javascript">


        $(document).ready(function ($) {
            sessionStorage.thumb = null;
            //被iframe引用
            if (top.location != location) {
                $(document).find('.main-header').remove();
                $(document).find('.content-header').remove();
                $(document).find('.main-sidebar').remove();
                $(document).find('.main-footer').remove();
                $(document).find('.content-wrapper .box-header').remove();
                $(document).find('.content-wrapper').css('margin-left', '0');
                //top.location.href= location.href;  
            }
        });



        $(function () {
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
//            $(document).on('click', '.btn-save', function (event) {
//                event.preventDefault();
//                /* Act on the event */
//                if ($("input[type=file]").val() == null || $("input[type=file]").val() == '') {
//                    parent.layer.msg('请选择图片', {
//                        icon: 5
//                    });
//                    return false;
//                }
//                $.post("<?php echo U('add');?>", $('#myForm').serialize() + "&thumb=" + sessionStorage.thumb, function (data) {
//                    if (data.err == 0) {
//
//
//                        //给父页面传值
//                        if (top.location != location) {
//                            parent.$("#bootstrapTable").bootstrapTable('refresh');
//                            console.log("bootstrapTable");
//
//                            parent.layer.msg(data.msg, {
//                                icon: 6
//                            });
//                            parent.layer.close(index);
//                        }
//                        setTimeout(function () {
//                            window.location.reload();
//                        }, 2000); //2秒后刷新当前页面         
//                    } else {
//                        parent.layer.msg(data.msg, {
//                            icon: 5
//                        });
//                    }
//                }, "json");
//            });

            $(document).on('click', '.btn-close', function (event) {
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            });
            
            $(document).on("click",".chg_order_status",function(){
                var order_status_key = $(this).attr("data-id");
                var oid = <?php echo ($order["oid"]); ?>;
                layer.confirm('请慎重操作，确认要修改本订单？', {
                    title:'修改订单',
                    //title: false, //不显示标题
                    area: '400px',
                    btn: ['确认','取消'] //按钮
                  }, function(){
                    $.post("<?php echo U('manual_chg_order_status');?>",{'oid':oid,'order_status_key':order_status_key},function(data){
                      console.log(data);
                      if(!data.err){
                        layer.msg(data.msg, {icon: 6});
                        //局部刷新
                        location.reload();
                      }else{
                        layer.msg(data.msg, {icon: 5});
                      }
                    },"json");
                  }, function(){

                  });
                
            });
        });
    </script>

</body>
<script>
    $(function(){
        $("#<?php echo ($site_config['menu_position']); ?>").addClass("active");
        $("#<?php echo ($site_config['menu_position']); ?>").parent().parent().addClass("active");
    });
</script>
</html>
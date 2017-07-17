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
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">订单信息</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3><?php echo ($data['rent_order_count']); ?></h3>

                                        <p>租赁订单</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="<?php echo U('Orders/rent_orders');?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><?php echo ($data['buy_order_count']); ?></h3>

                                        <p>购买订单</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="<?php echo U('Orders/buy_orders');?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3><?php echo ($data['diy_order_count']); ?></h3>

                                        <p>定制订单</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="<?php echo U('Orders/diy_orders');?>" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                        </div>
                        
                        
                        

                    </div>

                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">用户信息</h3>
                    </div>
                    <div class="box-body">
                            
                        <div class="row">
                            
                            <!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><?php echo ($data['view_count']); ?></h3>

                                        <p>浏览量</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3><?php echo ($data['member_count']); ?></h3>

                                        <p>新增用户</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="<?php echo U('Members/lists');?>" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            
                            <!-- ./col -->

                        </div>
                        
                        

                    </div>

                    <!-- /.box-footer-->
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">用户行为信息</h3>
                    </div>
                    <div class="box-body">
                        
                        
                        
                        <div class="row">
                           <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3><?php echo ($data['collection_count']); ?></h3>

                                        <p>当天被收藏量</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="<?php echo U('Members/collection');?>" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div> 
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3><?php echo ($data['focus_count']); ?></h3>

                                        <p>当天被关注量</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-eye"></i>
                                    </div>
                                    <a href="<?php echo U('Members/focus');?>" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div> 
                            
                            <!-- ./col -->

                        </div>

                    </div>

                    <!-- /.box-footer-->
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
</body>
<script>
    $(function(){
        $("#<?php echo ($site_config['menu_position']); ?>").addClass("active");
        $("#<?php echo ($site_config['menu_position']); ?>").parent().parent().addClass("active");
    });
</script>
</html>
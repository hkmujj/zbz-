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

        <!-- boostrap table -->
        <link rel="stylesheet" href="<?php echo ($resource_path); ?>/plugins/bootstrap-table/bootstrap-table.min.css">
    <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="<?php echo ($resource_path); ?>/plugins/datepicker/datepicker3.css">
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
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <form role="form" method="post" action="/index.php/Admin/Orders/rent_orders.html" id="myForm">
                            <input type="hidden" name="isearch" value="1" />
                            <div class="box-body">
                        <!-- form start -->
                            <div class="box-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="" class="col-sm-2 control-label">订单日期</label>

                                      <div class="col-sm-4">
                                          <input type="text" class="form-control datepicker"  name="ctime1" placeholder=""> 
                                       </div>
                                       <div class="col-sm-1">至
                                       </div>
                                       <div class="col-sm-4">
                                           <input type="text" class="form-control datepicker" name="ctime2" placeholder="">
                                       </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="" class="col-sm-2 control-label">收货人</label>

                                      <div class="col-sm-10">
                                        <input type="contact" name="contact" class="form-control" id="" placeholder="">
                                      </div>
                                    </div>
                                </div>
                            </div>
                          <div class="box-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="" class="col-sm-2 control-label">总金额</label>

                                      <div class="col-sm-4">
                                          <input type="number" class="form-control" name="order_amount1" placeholder=""> 
                                       </div>
                                       <div class="col-sm-1">至
                                       </div>
                                       <div class="col-sm-4">
                                           <input type="number" class="form-control" name="order_amount2" placeholder="">
                                       </div>
                                </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="" class="col-sm-2 control-label">订单状态</label>

                                      <div class="col-sm-10">
                                        <select class="form-control select2" style="width:100%;" name="order_status">
                                              <option value="0">全部</option> 
                                              <option value="1">已完成</option> 
                                              <option value="2">已支付、已派送</option> 
                                              <option value="3">已支付、未派送</option> 
                                              <option value="4">未支付</option> 
                                              <option value="5">已取消</option> 

                                          </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                              <button type="button" class="btn btn-info pull-right btn_search">搜索</button>
                            </div>
              <!-- /.box-footer -->
                                <table id="bootstrapTable" class="table bootstrapTable" data-toolbar="#toolbar" data-cookie="true" data-cookie-id-table="saveCookie"></table>
                            </div>
                            <!-- /.box-body -->

                           
                        </form>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->

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
        <!--<script src="<?php echo ($resource_path); ?>/dist/js/demo.js"></script>-->
<!-- bootstrap datepicker -->
<script src="<?php echo ($resource_path); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- bootstrap table -->
        <script src="<?php echo ($resource_path); ?>/plugins/bootstrap-table/bootstrap-table.min.js"></script>
        <!--<script src="<?php echo ($resource_path); ?>/plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.min.js"></script>-->
        <script src="<?php echo ($resource_path); ?>/plugins/bootstrap-table/extensions/export/tableExport.min.js"></script>
        <script src="<?php echo ($resource_path); ?>/plugins/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="<?php echo ($resource_path); ?>/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
        <script type="text/javascript">
  // DO NOT REMOVE : GLOBAL FUNCTIONS!
  $(function() {
      
      $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyymmdd'
      });
    
    /*get cookie*/
    function getCookie(cookieid, name) {
      var cookieArray = document.cookie.split(';');
      var getvalue;
      for (var i = 0; i < cookieArray.length; i++) {
        var temp = cookieArray[i].split("=");
        if (temp[0].indexOf(cookieid) >= 0 && temp[0].indexOf(name) >= 0) {
          getvalue = temp[1];
          break;
        }
      }
      if (getvalue != null)
        return getvalue;
      else
        return null;
    }

    //表格数据  文档参考 http://bootstrap-table.wenzhixin.net.cn/documentation/
    $('#bootstrapTable').bootstrapTable({
      //data: data,
      url:'<?php echo U('rent_orders');?>',
      pagination: true,
      pageList: [10, 20, 50, 100],
      pageSize: 10,
      pageNumber: 1,
      search: true,
      method:'ajax',
      //showRefresh: true,
      showExport: true,
      showColumns: true,
      clickToSelect: true,
      columns: [{
        field: 'oid',
        title: '序号',
        sortable: true
      },{
        field: 'order_sn',
        title: '订单号'
      },{
        field: 'ctime',
        title: '下单时间',
        formatter:function(value, row, index){
            var ctime_text;
            ctime_text = getYMDhms(row.ctime);
            return ctime_text;
        }
      },{
        field: 'contact,contact_mobile',
        title: '收货人',
        formatter:function(value, row, index){
            return row.contact+"<br/>"+row.contact_mobile;
        }
      },{
        field: 'order_amount',
        title: '总金额',
        sortable: true
      }, {
        title: '订单状态',
        formatter:function(value,row,index){
            if(row.order_status =="0")
            {
                if(row.pay_status=="0")
                {
                    return "未支付";
                }
                else
                {
                    if(row.shipping_status=="0")
                    {
                        return "已支付,未派送";
                    }
                    else
                    {
                        return "已支付,已派送";
                    }
                }
            }
            else if(row.order_status =="1")
            {
                return "已完成";
            }
            else
            {
                return "已取消";
            }
        }
      },{
        title: '操作',
        formatter: function(value, row, index) {
          var html = '<a class="btn btn-xs btn-default open-layer" data-title="" data-type="2" data-maxmin="1" data-area="1200px,680px" data-content="<?php echo U('rent_orders_detail');?>?oid='+row.oid+'" title="编辑"><i class="fa fa-file-text-o"></i></a> ';
          // html += '<a class="btn btn-xs btn-default btn-del" data-id='+row.sid+' data-count='+row.newsCount+' title="删除，慎重操作"><i class="fa fa-trash text-danger"></i> </a>';
          return html;
        }
      }],
      onLoadSuccess: function(data) {
        // console.log($('#bootstrapTable').bootstrapTable("getOptions").searchText);
        // console.log($('#bootstrapTable').bootstrapTable("getOptions").pageNumber);
        // console.log($('#bootstrapTable').data("bootstrap.table"));
        // console.log($('#bootstrapTable').data('cookie-id-table'));
        var cookieid = $('#bootstrapTable').data('cookie-id-table');
        //console.log(getCookie(cookie,'pageNumber'));
        if (getCookie(cookieid, 'pageNumber') != null && parseInt(getCookie(cookieid, 'pageNumber')) > 0) {
          $('#bootstrapTable').bootstrapTable('selectPage', parseInt(getCookie(cookieid, 'pageNumber')));
        }
        return false;
      }
    });

    
    
  });
  
    function getYMDhms(time){
          var date = new Date(parseInt(time) * 1000); //获取一个时间对象  注意：如果是uinx时间戳记得乘于1000。比如php函数time()获得的时间戳就要乘于1000

  //		console.log(date.getFullYear());

          /*----------下面是获取时间日期的方法，需要什么样的格式自己拼接起来就好了----------*/
  //		date.getFullYear();//获取完整的年份(4位,1970)
  //		date.getMonth();//获取月份(0-11,0代表1月,用的时候记得加上1)
  //		date.getDate();//获取日(1-31)
  //		date.getTime();//获取时间(从1970.1.1开始的毫秒数)
  //		date.getHours();//获取小时数(0-23)
  //		date.getMinutes();//获取分钟数(0-59)
  //		date.getSeconds();//获取秒数(0-59)var date = new Date(时间戳); //获取一个时间对象  注意：如果是uinx时间戳记得乘于1000。比如php函数time()获得的时间戳就要乘于1000

          Y = date.getFullYear() + '-';
          M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
          D = date.getDate() + ' ';
          h = (date.getHours()< 10 ? '0'+date.getHours() : date.getHours()) + ':';
          m = (date.getMinutes()< 10 ? '0'+date.getMinutes() : date.getMinutes()) + ':';
          s = (date.getSeconds()< 10 ? '0'+date.getSeconds() : date.getSeconds()); 
          return Y+M+D+h+m+s;
  }

  </script>
</body>
<script>
    $(function(){
        $("#<?php echo ($site_config['menu_position']); ?>").addClass("active");
        $("#<?php echo ($site_config['menu_position']); ?>").parent().parent().addClass("active");
    });
</script>
<script src="<?php echo ($resource_path); ?>/layer/layer.js"></script>
<script>
        $(document).on('click', '.btn-del', function (event) {
            event.preventDefault();
            /* Act on the event */
            var work_id = $(this).attr('data-id');
            //询问框
            layer.confirm('请慎重操作，确认要删除吗？', {
                title: '删除',
                //title: false, //不显示标题
                area: '400px',
                btn: ['确认', '取消'] //按钮
            }, function () {
                $.post("<?php echo U('del');?>", {'work_id': work_id}, function (data) {
                    console.log(data);
                    if (!data.err) {
                        layer.msg(data.msg, {icon: 6});
                        //局部刷新
                        $("#bootstrapTable").bootstrapTable('refresh', {url: '<?php echo U('get_lists');?>'});
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                }, "json");
            }, function () {

            });
        });

        //layer
        $(document).on('click', '.open-layer', function (event) {
            event.preventDefault();
            console.log($(this).attr('data-area').split(","));
            //iframe层-父子操作
            layer.open({
                title: $(this).attr('data-title'),
                type: parseInt($(this).attr('data-type')),
                area: $(this).attr('data-area').split(","),
                fix: false, //不固定
                maxmin: parseInt($(this).attr('data-maxmin')),
                content: $(this).attr('data-content'),
                cancel: function(index, layero){ 
                    layer.close(index);
                    $("#bootstrapTable").bootstrapTable('refresh');   
                }
                  
            });
        });


        //弹层显示图片
        $(document).on('click', '.popup-img', function (event) {
            event.preventDefault();
            layer.closeAll();
            //捕获页
            layer.open({
                type: 1,
                shade: false,
                //area: '500px',
                title: false, //不显示标题
                skin: 'text-center', //加上边框
                maxmin: true,
                content: "<div class='pad'><img src='" + $(this).attr('src') + "' style='max-width:100%;height:auto'></div>", //捕获的元素
            });
        });
        
        $(document).on('click', '.btn_search', function (event) {
            $("#bootstrapTable").bootstrapTable('refresh', {url: '<?php echo U("get_rent_orders_lists");?>'+'?'+$('#myForm').serialize()});
        });

</script>
</html>
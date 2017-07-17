<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>珍宝斋</title>
    <link rel="stylesheet" href="/Public/Home/css/header.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            list-style: none;
        }
        a{
            text-decoration: none;
            color: #000;
        }
        .wrap{
            width: 1280px;
            overflow: hidden;
            margin: 0 auto;
        }
        header{
            width: 100%;
            height: 88px;
            border-bottom:3px solid #c72b2c ;
        }
        header ul li{
            font-size: 18px;
            float: left;
            height: 44px;
            width: 90px;
            text-align: center;
            line-height: 44px;
            padding: 22px 0;
            margin: 0 20px;
        }
        header ul li:last-child{
            width: 220px;
            line-height: normal;
            text-align: left;
            float: right;
        }
        header ul li:first-child{
            height: 100%;
            margin-right: 25%;
            padding: 22px 0;
        }
        .active{
            color: red;
        }
        /*footer*/
        footer{
            margin-top: 50px;
            width: 100%;
            background: #c72b2c;
        }
        footer h4{
            font-size: 1.2rem;
            color: #fff;
            margin-top: 30px;
            text-align: center;
        }
        footer p{
            font-size: 1rem;
            color: #fff;
            margin: 20px 0 30px 0;
            text-align: center;
        }

        /*list_item*/
        .list_item ul li{
            overflow: hidden;
            margin-bottom: 60px;
        }
        .div_content{
            width: 650px;
            height: 360px;
            padding: 10px 50px;
            padding-bottom: 0px;
            box-sizing: border-box;
            /*border: 1px solid red;*/
        }
        .div_content h4{
            color: #c72b2c;
            margin-bottom: 14px;
        }
        .div_contentdiv{
            display: block;
            font-size: 1rem;
            color: #b2b2b2;
        }
        .div_content span{
            display: block;
            font-size: 18px;
            color: #b2b2b2;
            margin-bottom: 26px;
        }

        .list_item ul li div{
            display: inline-block;
            float: left;
            /*border: 1px solid red;*/
        }
         .wrap_img{
            width: 100%;
        }

    </style>
</head>
<body>
<div class="header">
    <div class="wrap">
        <div class="title_item">
            <span onclick="location.href='<?php echo U(index);?>'" style="padding-top: 0;"><img src="/Public/Home/image/logo2.png" style="height: 100%" alt=""></span>
            <span><a href="<?php echo U(index);?>" >首页</a></span>
            <span><a href="<?php echo U(artist);?>">艺术家介绍</a></span>
            <span><a href="<?php echo U(news);?>"  >新闻动态</a></span>
            <span><a href="<?php echo U(profile);?>" >关于我们</a></span>
            <span>
                <span>24小时咨询热线</span><br>
                <span style="color: red;">4000-93-0004</span>
            </span>
        </div>
    </div>
</div>

<section>
    <div class="wrap">
        <div style="width: 100%;height: 390px;background: #fff;margin: 0 0 70px 0 ">
            <img class="wrap_img" src="/Public/Home/image/pc3.png" />
        </div>
        <div class="list_item">
            <ul>
                <?php if(is_array($reimg)): $i = 0; $__LIST__ = $reimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <div><a href="<?php echo U('news_detail');?>?id=<?php echo ($vo["id"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="" width="500" height="300"></a></div>
                        <div class="div_content">
                            <h4><a href="<?php echo U('news_detail');?>?id=<?php echo ($vo["id"]); ?>" style='color:red;'><?php echo ($vo["title"]); ?></a></h4>
                            <div><?php echo ($vo["brief"]); ?></div>
                            <br>
                            <br>
                            <br>
                            <i><a href="<?php echo U('news_detail');?>?id=<?php echo ($vo["id"]); ?>">MORE+</a></i>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?> 
            </ul>
        </div>

    </div>
</section>
<div class="footer">
    <div class="wrap">
        <h4>深圳市珍宝斋艺术馆有限公司</h4>
        <p>copyright@2016 zbzart.com AllRights Reserved 粤ICP备17035367号-1</p>
        <p><script id='ebsgovicon' src='http://szcert.ebs.org.cn/govicon.js?id=e69c95ed-051d-4cba-a791-f00ddeabde6a&width=100&height=137&;type=1' type='text/javascript' charset='utf-8'></script></p>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(function () {
        $('.title_item span').click(function () {
            $(this).children().addClass('active');
//            $(this).siblings().children().removeClass('active');
        });
    })
</script>

<!--<script src="/Public/Home/js/jquery.js"></script>-->

</body>
</html>
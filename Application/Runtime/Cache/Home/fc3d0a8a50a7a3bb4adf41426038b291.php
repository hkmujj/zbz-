<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>珍宝斋</title>
    <link rel="stylesheet" href="/Public/Home/css/header.css" />
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
        /*.nav*/
        .nav{
            /*border: 1px solid red;*/
            width: 186px;
            float: left;
        }
        .nav li a{
            font-size: 18px;
            color: #8a8a8a;
        }
        .active_i{
            color: #e31a2c!important;
        }
        .nav li{
            text-align: center;
            width: 186px;
            height: 50px;
            line-height: 50px;
            background: url("/Public/Home/image/001.png") no-repeat;
            background-position: center bottom ;
        }
        .nav li span{
            float: right;
            display: inline-block;
            width: 10px;
            height: 100%;
            background: url("/Public/Home/image/003.png") no-repeat;
            background-position: center center;

        }
        .nav li:first-child span{
            float: right;
            display: inline-block;
            width: 10px;
            height: 100%;
            background: url("/Public/Home/image/002.png") no-repeat;!important;
            background-position: center center;
        }

        /*nav_content*/
        .nav_content{
            box-sizing: border-box;
            padding: 50px;
            padding-top: 15px;
            float: right;
            width: 1050px;
            overflow: hidden;
            /*border: 1px solid red;*/
        }
        .nav_content h3{
            text-align: center;
            margin-bottom: 35px;
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
        <div style="width: 100%;height: 390px;background: #ffffff;margin: 0 0 70px 0 "><img class="wrap_img"  src="<?php echo ($result['thumb']); ?>" /></div>
        <div class="about_we">
            <div class="nav">
                <ul>
                    <!--<li><a href="<?php echo U('about_us');?>" >关于我们</a><span></span></li>-->
                    <li><a href="<?php echo U('profile');?>">公司简介</a><span></span></li>
                    <li><a href="<?php echo U('honor');?>">荣誉资质</a><span ></span></li>
                    <li><a href="<?php echo U('team');?>">专家及艺术家团队</a><span></span></li>
                    <li><a href="<?php echo U('patent');?>">专利证书</a><span></span></li>
                    <li><a href="javascript:(0)" class="active_i">发展历程</a><span class="active_im"></span></li>
                </ul>
            </div>
            <div class="nav_content">
               <div class="content" style="display: none">
                        <h3><?php echo ($result["title"]); ?></h3>
                        <p><?php echo (html_entity_decode($result["content"])); ?></p>
                    </div>


            </div>
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
<script>
    $(function () {
        // 第一个content内容显示
        $('.nav_content').children().eq(0).css({
            display: 'block'        
        });



        $('.nav li').on('click',function () {
            var index = $(this).index();
            $(this).children('a').addClass('active_i');
            $(this).siblings().children('a').removeClass('active_i');
            $(this).children('span').css({
                background:'url("/Public/Home/image/002.png") no-repeat',
                float: 'right',
                display: 'inline-block',
                width: '10px',
                height: '100%',
                backgroundPosition: 'center center'
            });
            $(this).siblings().children('span').css({
                background:'url("/Public/Home/image/003.png") no-repeat',
                float: 'right',
                display: 'inline-block',
                width: '10px',
                height: '100%',
                backgroundPosition: 'center center'
            });

            $('.nav_content .content').eq(index).show().siblings().css('display','none');

        })


    });
</script>
</body>
</html>
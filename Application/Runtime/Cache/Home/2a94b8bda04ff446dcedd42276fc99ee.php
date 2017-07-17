<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>珍宝斋</title>
    <link rel="stylesheet" href="/Public/Home/css/focusStyle.css">
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

        /*section*/
        .banner{
            position: relative;
            width: 100%;
            height: 580px;
        }
        .banner_bg {
            overflow: hidden;
            width: 100%;
            background: #fff;
        }
        .banner .img{
            display: block;
            width: 100%;
            height: 100%;
        }
        .PN-btn{
            position: absolute;
            top:43%;
            width: 100%;
            height: 70px;
        }
        .PN-btn a{
            position: absolute;
            background: #000;
            display: inline-block;
            width: 70px;
            height: 70px;
        }
        .PN-btn a:first-child{
            left: 0;
            background: url("/Public/Home/image/02.png") no-repeat;
            background-position: center center;
        }
        .PN-btn a:last-child{
            right: 0;
            background: url("/Public/Home/image/03.png") no-repeat;
            background-position: center center;
        }
        .paint_img{
            text-align: center;
            margin: 28px 0 16px 0;
        }
        .paint_title{
            margin-bottom: 30px;
        }
        .paint_title span{
            display: block;
            text-align: center;
        }
        .paint_title span:first-child{
            font-size: 24px;
            color: #c72b2c;
        }
        .paint_title span:last-child{
            font-size: 18px;
            color: #000;
        }
        .paint_code span{
            display: inline-block;
            width: 32%;
            text-align: center;
        }
        .paint_code span:first-child{
            margin-right: 1.5%;
        }
        .paint_code span:last-child{
            float:right;
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

<section class="banner_bg">
    <div class="wrap">
        <div class="banner">
            <div id="focus-banner">
                <ul id="focus-banner-list">
                    <?php if(is_array($banners)): $i = 0; $__LIST__ = $banners;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo ($vo["url"]); ?>" class="focus-banner-img">
                            <img src="<?php echo ($vo['thumb']); ?>" alt="">
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <a href="javascript:;" id="prev-img" class="focus-handle"></a>
                <a href="javascript:;" id="next-img" class="focus-handle"></a>
                <ul id="focus-bubble"></ul>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="wrap">
        <div class="painting">
            <div class="paint_img"><img src="/Public/Home/image/004.png" alt=""></div>
            <div class="paint_title">
                <span>中国当代名家书画租赁交易平台</span>
                <span>Painting and Calligraphy leasing transaction platform</span>
            </div>
            <div class="paint_code" style="user-select: text;">
                <span style="user-select: text;"><img src="<?php echo ($img1['thumb']); ?>"  style="user-select: text; width:100%;height:100%;"></span>
                <span style="user-select: text;"><img src="<?php echo ($img2['thumb']); ?>"   style="user-select: text; width:100%;height:100%;"></span>
                <span style="user-select: text;"><img src="<?php echo ($img3['thumb']); ?>"   style="user-select: text; width:100%;height:100%;"></span>

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
    $(function(){
        (function(){
            var $focusBanner=$("#focus-banner"),
                    $bannerList=$("#focus-banner-list li"),
                    $focusHandle=$(".focus-handle"),
                    $bannerImg=$(".focus-banner-img"),
                    $nextBnt=$("#next-img"),
                    $prevBnt=$("#prev-img"),
                    $focusBubble=$("#focus-bubble"),
                    bannerLength=$bannerList.length,
                    _index=0,
                    _timer="";

            var _height=$(".focus-banner-img").find("img").height();
            $focusBanner.height(_height);
            $bannerImg.height(_height);

            $(window).resize(function(){
                window.location.reload()
            });

            for(var i=0; i<bannerLength; i++){
                $bannerList.eq(i).css("zIndex",bannerLength-i);
                $focusBubble.append("<li></li>");
            }
            $focusBubble.find("li").eq(0).addClass("current");
            var bubbleLength=$focusBubble.find("li").length;
            $focusBubble.css({
                "width":bubbleLength*22,
                "marginLeft":-bubbleLength*11
            });//初始化

            $focusBubble.on("click","li",function(){
                $(this).addClass("current").siblings().removeClass("current");
                _index=$(this).index();
                changeImg(_index);
            });//点击轮换

            $nextBnt.on("click",function(){
                _index++;
                if(_index>bannerLength-1){
                    _index=0;
                }
                changeImg(_index);
            });//下一张

            $prevBnt.on("click",function(){
                _index--;
                if(_index<0){
                    _index=bannerLength-1;
                }
                changeImg(_index);
            });//上一张

            function changeImg(_index){
                $bannerList.eq(_index).fadeIn(250);
                $bannerList.eq(_index).siblings().fadeOut(200);
                $focusBubble.find("li").removeClass("current");
                $focusBubble.find("li").eq(_index).addClass("current");
                clearInterval(_timer);
                _timer=setInterval(function(){$("#prev-img").click()},3000)
            }//切换主函数
            _timer=setInterval(function(){$("#prev-img").click()},3000)
        })();
    })
</script>

</body>
</html>
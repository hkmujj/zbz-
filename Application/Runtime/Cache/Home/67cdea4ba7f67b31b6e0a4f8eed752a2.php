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


        .active{
            color: red;
        }


        /*artist_item*/
        .artist_item{
            overflow: hidden;
            margin-bottom: 25px;
        }
        .artist_item .artist_text{
            position: relative;
            padding: 30px;
            box-sizing: border-box;
            width: 50%;
            float: left;
        }
        .artist_item .artist_text span{
            position: absolute;
            bottom: 10px;
        }
        .artist_item .artist_text h4{
            color: #c72b2c;
            font-size: 24px;
            margin-bottom: 35px;
        }
        .artist_item .artist_text p{

            color: #8a8a8a;
            margin-bottom: 20px;
        }
        .artist_item .artist_img{
            width: 50%;
            text-align: center;
            float: left;
        }


        .artist_photo{
            margin-top: 65px;
        }
        .artist_photo span{
            display: inline-block;
            width: 32%;
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
        <div style="width: 100%;height: 390px;background: #ffffff;margin: 0 0 70px 0 ">
            <img class="wrap_img" src="/Public/Home/image/pc2.png" />
        </div>
        <div class="artist_item">
            <div class="artist_text">
                <h4>艾秀琪</h4>
                <p>笔名牧石  1947年生于北京，民族汉，天津美术学院进修，师承王颂余、白庚延等名师。现为国家二级美术师、中国民间文艺家协会会员、河北非物质文化遗产传承人，河北民间工艺美术大师。中国烙画艺术研究中心执行主任。出版有《中国烙画技法》等多部美术专著，填补中国美术史的空白。
                </p>
                
            </div>
            <div class="artist_img"><img src="/Public/Home/image/artists/1.jpg" alt="" style="width: 85%"></div>
        </div>
        <div class="artist_item">

            <div class="artist_img"><img src="/Public/Home/image/artists/2.jpg" alt="" style="width: 85%"></div>
            <div class="artist_text">
                <h4>魏怀亮</h4>
                <p>1960年9月出生于河北平山。中国美术家协会会员，中国美术家协会河山画会会员，湖南省美术家协会副主席，湖南省花鸟画家协会主席，湖南省画院副院长，国家一级美术师。
                </p>
                
            </div>
        </div>
        <div class="artist_item">
            <div class="artist_text">
                <h4>马波生</h4>
                <p>字朔江，号迷翁。1942年出生于陕西。1985年师从中央美院卢沉教授，1986年拜李可染先生为师。山水作品《陕北瑞雪》、书法作品《米芾西园雅集图记》先后被中国美术馆收藏。现为中国美术家协会会员，中国书法家协会会员，深圳大学教授、书法研究员，安徽师范大学兼职教授，山东理工大学美术学院兼职教授，中国矿业大学艺术与设计学院客座教授，李可染画院研究员
                </p>
                
            </div>
            <div class="artist_img"><img src="/Public/Home/image/artists/3.jpg" alt="" style="width: 85%"></div>
        </div>

        <div class="artist_photo">
            <span><img src="/Public/Home/image/artists/4.jpg" alt="" style="width: 90%"></span>
            <span><img src="/Public/Home/image/artists/5.jpg" alt="" style="width: 90%"></span>
            <span><img src="/Public/Home/image/artists/6.jpg" alt="" style="width: 90%"></span>
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
        var H = $('.artist_img').height() + 'px';
        $('.artist_text').css("height",H);
    });
</script>
</body>
</html>
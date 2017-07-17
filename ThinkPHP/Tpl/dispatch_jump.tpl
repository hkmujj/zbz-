<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>WeUI</title>
        <link rel="stylesheet" href="/Public/weui.min.css"/>
    </head>
    <body>
        <?php if(isset($message)) {?>
        <div class="page msg_success js_show">
            <div class="weui-msg">
                <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">操作成功,<?php echo($message); ?></h2>
                    <p class="weui-msg__desc jump">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
                </div>
                
               
            </div>
        </div>
        <?php }else{?>
        <div class="page msg_warn js_show">
            <div class="weui-msg">
                <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">操作失败,<?php echo($error); ?></h2>
                    <p class="weui-msg__desc jump">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
                </div>
            </div>
        </div>
<?php }?>
      




<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>



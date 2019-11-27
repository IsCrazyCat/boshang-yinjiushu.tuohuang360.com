<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./template/mobile/new2/user\mobile.html";i:1524476386;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>手机号--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__STATIC__/js/layer.js"  type="text/javascript" ></script>
    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="" >

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="<?php echo U('Mobile/User/userinfo'); ?>"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>手机号</span>
        </div>
        <div class="ds-in-bl menu">
            <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>
        </div>
    </div>
</div>
<div class="flool tpnavf">
    <div class="footer">
        <ul>
            <li  style="width:33.3%">
                <a class="yello" href="<?php echo U('Index/index'); ?>">
                    <div class="icon">
                        <i class="icon-shouye iconfont"></i>
                        <p>首页</p>
                    </div>
                </a>
            </li>
            <!--<li>
                <a href="<?php echo U('Goods/categoryList'); ?>">
                    <div class="icon">
                        <i class="icon-fenlei iconfont"></i>
                        <p>分类</p>
                    </div>
                </a>
            </li>-->
            <li  style="width:33.3%">
                <!--<a href="shopcar.html">-->
                <a href="<?php echo U('Cart/cart'); ?>">
                    <div class="icon">
                        <i class="icon-gouwuche iconfont"></i>
                        <p>购物车</p>
                    </div>
                </a>
            </li>
            <li style="width:33.3%">
                <a href="<?php echo U('User/index'); ?>">
                    <div class="icon">
                        <i class="icon-wode iconfont"></i>
                        <p>我的</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .fetchcode{
        background-color: #ec5151;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
    #fetchcode{
        background:#898995;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
</style>
		<div class="loginsingup-input singupphone findpassword">
            <form action="<?php echo U('Mobile/User/userinfo'); ?>" method="post" onsubmit="return submitverify(this)">
				<div class="content30">
					<div class="lsu bk">
						<span>手机号</span>
						<input type="text" name="mobile" id="tel" value="<?php echo $user['mobile']; ?>" placeholder="请输入您的手机号" onBlur="checkMobilePhone(this.value);"/>
					</div>
                    <div class="lsu boo zc_se">
                        <input type="text" name="mobile_code" id="mobile_code" value="" placeholder="请输入验证码">
                        <a href="javascript:void(0);" rel="mobile" id="fcode" onclick="sendcode(this)">获取短信验证码</a>
                    </div>
					<div class="lsu submit">
						<input type="submit" name="" id="" value="确认修改" />
					</div>
				</div>
			</form>
		</div>
<script>
    //手机验证
    function checkMobilePhone(mobile){
        if(mobile == ''){
            showErrorMsg('请输入您的手机号');
            return false;
        }else  if(checkMobile(mobile)) {
            $.ajax({
                type: "GET",
                url: "/index.php?m=Home&c=Api&a=issetMobile",//+tab,
//			url:"<?php echo U('Mobile/User/comment',array('status'=>$_GET['status']),''); ?>/is_ajax/1/p/"+page,//+tab,
                data: {mobile: mobile},// 你的formid 搜索表单 序列化提交
                success: function (data) {
                    if (data == '0') {
                        return true;
                    } else {
                        $('#fcode').attr('id','fetchcode');
                        showErrorMsg('手机号已存在！');
                        return false;
                    }
                }
            });
        }else{
            showErrorMsg('手机号码格式不正确！');
            return false;
        }
    }


    //发送短信验证码
    function sendcode(obj){
        var tel = $.trim($('#tel').val());
        var obj = $(obj);
        if(tel == ''){
            showErrorMsg('请输入您的号码！');
            return false;
        }
        var s = 60;
        //改变按钮状态
        obj.unbind('click');
        //添加样式
        obj.attr('id','fetchcode');
        callback();
        //循环定时器
        var T = window.setInterval(callback,1000);
        function callback()
        {
            if(s <= 0){
                //移除定时器
                window.clearInterval(T);
                obj.bind('click',sendcode)
                obj.removeAttr('id','fetchcode');
                obj.text('获取短信验证码');
            }else{
                obj.text(--s + '秒后再获取');
            }
        }
        $.ajax({
//            url:'/index.php?m=Mobile&c=User&a=send_validate_code&t='+Math.random(), //原获取短信验证码方法
            url : "/index.php?m=Home&c=Api&a=send_validate_code&scene=6&type=mobile&send="+tel,
            type:'post',
            dataType:'json',
            data:{type:obj.attr('rel'),send:tel},
            success:function(res){
                if(res.status==1){
                    //成功
                    showErrorMsg(res.msg);
                }else{
                    //失败
                    showErrorMsg(res.msg);
                    //移除定时器
                    window.clearInterval(T);
                    obj.removeAttr('id','fetchcode');
                    obj.text('获取短信验证码');
                }
            }
        })
    }

    //提交前验证表单
    function submitverify(obj){
        var tel = $.trim($('#tel').val());
        if(tel == ''){
            showErrorMsg('请输入您的手机号！');
            return false;
        }
        if($('#mobile_code').val() == ''){
            showErrorMsg('验证码不能空！');
            return false;
        }
        $(obj).onsubmit();
    }
</script>
</body>
</html>

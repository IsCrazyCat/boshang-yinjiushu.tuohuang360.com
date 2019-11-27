<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:38:"./template/mobile/new2/cart\cart4.html";i:1572422950;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;s:45:"./template/mobile/new2/public\footer_nav.html";i:1542180611;s:43:"./template/mobile/new2/public\wx_share.html";i:1571744578;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>支付,提交订单--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>支付,提交订单</span>
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

<form action="<?php echo U('Mobile/Payment/getCode'); ?>" method="post" name="cart4_form" id="cart4_form">
    <div class="ddmoney">
        <div class="maleri30">
            <span class="fl">订单号</span>
            <span class="fr"><?php echo $order[order_sn]; ?></span>
        </div>
    </div>
    <div class="ddmoney">
        <div class="maleri30">
            <span class="fl">订单金额</span>
            <span class="fr"><?php echo $order[order_amount]; ?>元</span>
        </div>
    </div>
    <!--其他支付方式-s-->
    <div class="paylist">
        <div class="myorder debit otherpay p">
            <div class="content30">
                <a href="javascript:void(0);">
                    <div class="order">
                        <div class="fl">
                            <span>支付方式</span>
                        </div>
                        <div class="fr">
                            <!--<i class="Mright xjt"></i>-->
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="pay-list-4 p">
        <div class="maleri30">
            <ul>
                <?php if(is_array($paymentList) || $paymentList instanceof \think\Collection || $paymentList instanceof \think\Paginator): if( count($paymentList)==0 ) : echo "" ;else: foreach($paymentList as $k=>$v): ?>
                    <li  onClick="changepay(this);">
                        <label>
                        <div class="radio fl">
							<span class="che <?php echo $k; ?>">
								<i>
                                    <input type="radio"   value="pay_code=<?php echo $v['code']; ?>" class="c_checkbox_t" name="pay_radio" style="display:none;"/>
                                </i>
							</span>
                        </div>
                            <div class="pay-list-img fl">
                                <img src="/plugins/<?php echo $v['type']; ?>/<?php echo $v['code']; ?>/<?php echo $v['icon']; ?>"/>
                            </div>
                            <div class="pay-list-font fl">
                                <?php echo $v[name]; ?>
                            </div>
                        </label>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!--其他支付方式-s-->

    <div class="paiton">
        <div class="maleri30">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>" />
            <p><span style="color:#F00">注：</span>支付成功 后一定点击 <span style="color:#F00">完成</span> 进入 订单详情 页后，才能关闭页面！</p>
            <a class="soon" href="javascript:void(0);" onClick="pay()"><span>立即支付</span></a>
            <!--<p class="fr"><a href="javascript:void(0);" class="lossbq">支付失败？</a></p>-->
        </div>
    </div>

<!--    <div class="quickpayment">
        <div class="maleri30">
            <div class="quicks fl"><img src="__STATIC__/images/quick.png"/></div>
            <div class="paym fl">
                <p class="titp">快捷支付</p>
                <p class="spi">银行卡快捷支付服务</p>
            </div>
        </div>
    </div>
    <div class="myorder debit usedeb p">
        <div class="content30">
            <a href="javascript:void(0)">
                <div class="order">
                    <div class="fl">
                        <span>使用银行卡</span>
                    </div>
                    <div class="fr">
                        <i class="Mright xjt"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
&lt;!&ndash;选择银行卡弹窗-s&ndash;&gt;
		<div class="chooseebitcard">
			<div class="maleri30">
				<div class="choose-titr">
					<span>选择银行卡</span>
					<i class="gb-close"></i>
				</div>

				<div class="card">
					<div class="card-list">
						<div class="radio fl">
							<span class="che">
								<i>
                                    <input type="radio"   value="pay_code=<?php echo $v['code']; ?>" class="c_checkbox_t" name="pay_radio" style="display:none;"/>
                                </i>
							</span>
						</div>
						<p class="fl">&nbsp;&nbsp;<span>工商银行储蓄卡</span>&nbsp;&nbsp;<span>(3689)</span></p>
					</div>
				</div>

				<p class="teuse"><span class="red">+</span><span>使用新银行卡</span></p>
			</div>
		</div>
&lt;!&ndash;选择银行卡弹窗-e&ndash;&gt;

&lt;!&ndash;支付失败-s&ndash;&gt;
		<div class="losepay">
			<div class="maleri30">
				<p class="red">支付失败</p>
				<p class="lo-tit">以下两种情况需要您重新绑卡：</p>
				<p class="con-lo">1.信用卡有效期过期或更换了卡片</p>
				<p class="con-lo">2.修改了银行卡预留手机号码</p>
				<div class="qx-rebd">
					<a class="ax">取消</a>
					<a class="are">重新绑定</a>
				</div>
			</div>
		</div>
&lt;!&ndash;支付失败-e&ndash;&gt;-->

<div class="mask-filter-div" style="display: none;"></div>
</form>
<script type="text/javascript">
    $(function(){
        //默认选中第一个
        $('.pay-list-4 div ul li:first').find('.che').addClass('check_t')
                .end().find(':radio').attr('checked',true);
    })
    //切换支付方式
    function changepay(obj){
        $(obj).find('.che').addClass('check_t').parents('li').siblings('li').find('.che').removeClass('check_t');
        //改变中状态
        if($(obj).find('.che').hasClass('check_t')){
            //选中
            $(obj).find(':radio').attr('checked',true);
            $(obj).siblings('li').find(':radio').removeAttr('checked');
        }else{
            //取消选中
            $(obj).find(':radio').removeAttr('checked');
        }

    }

    function pay(){
        $('#cart4_form').submit();
        return;
        //微信JS支付
    }

    $(function(){
        //使用银行卡
        $('.usedeb').click(function(){
            cover();
            $('.chooseebitcard').show();
        })
        $('.gb-close').click(function(){
            undercover();
            $('.chooseebitcard').hide();
        })

//        // 其他支付方式
//        $('.pay-list-4 ul li').click(function(){
//            $(this).find('.che').toggleClass('check_t').parents('li').siblings('li').find('.che').removeClass('check_t');
//        })

        //选择银行卡
        $('.card').click(function(){
            $(this).find('.che').toggleClass('check_t').parents('.card').siblings().find('.che').removeClass('check_t');
        })
//        $('.che').click(function(){
//            $(this).toggleClass('check_t')
//        })

        //支付失败弹窗
        $('.lossbq').click(function(){
            cover();
            $('.losepay').show();
        })
        $('.qx-rebd .ax').click(function(){
            undercover();
            $('.losepay').hide();
        })
        $('.are').click(function(){
            $('.losepay').hide();
            $('.chooseebitcard').show();
        })
    })
</script>



	</body>
</html>
<!--底部导航-start--> 
<div class="foohi">
    <div class="footer">
        <ul>
            <li style="width:33.33%">
                <a <?php if(CONTROLLER_NAME == 'Index'): ?>class="yello" <?php endif; ?>  href="<?php echo U('Index/index'); ?>">
                    <div class="icon">
                        <i class="icon-shouye iconfont"></i>
                        <p>商城</p>
                    </div>
                </a>
            </li>
            <li  style="width:33.33%">
                <a href="<?php echo U('Distribut/index'); ?>">
                    <div class="icon">
                        <i class="icon-fenlei iconfont"></i>
                        <p>分销</p>
                    </div>
                </a>
            </li>
            <!--<li style="width:33.33%">
                <a href="<?php echo U('Cart/cart'); ?>">
                    <div class="icon">
                        <i class="icon-gouwuche iconfont"></i>
                        <p>购物车</p>
                    </div>
                </a>
            </li>-->
            <li style="width:33.33%">
                <a <?php if(CONTROLLER_NAME == 'User'): ?>class="yello" <?php endif; ?> href="<?php echo U('User/index'); ?>">
                    <div class="icon">
                        <i class="icon-wode iconfont"></i>
                        <p>我的</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  if(cart_cn == ''){
		$.ajax({
			type : "GET",
			url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function(data){								 
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);						
			}
		});	
	  }
	  $('#cart_quantity').html(cart_cn);
});
</script>
<!-- 微信浏览器 调用微信 分享js-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
<?php if(ACTION_NAME == 'goodsInfo'): ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
   
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   //var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
   var ShareImgUrl = "http://yinjiushu.tuohuang360.com/public/upload/temp/2019/10-05/fca1abde72d3b91576296bad1bd85806.jpg"; //分享图标
   
<?php endif; $tpshop_config['shop_info_store_desc'] = '养肝护肝，保肝强肝 - 解酒毒。';  ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}

$(function() {
	if(isWeiXin() && parseInt(user_id)>0){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   <?php if(CONTROLLER_NAME == 'User'): ?> 
				wx.hideOptionMenu();  // 用户中心 隐藏微信菜单
		   <?php endif; ?>	
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->
<?php if(\think\Session::get('subscribe') == 0): endif; ?>
<button class="guide" style="display:none;color:#F00;" onclick="follow_wx()" >点击关注公众号</button>

<style type="text/css">
.guide{width:1rem;height:4rem;text-align: center;border-radius: 0.2rem ;font-size:0.5rem;padding:0.4rem 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;left: 0.1rem;top: 6.1rem;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:0.1rem;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 0.2rem;}
</style>
<script type="text/javascript">
  //关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '<span style="color:#F00">长按识别二维码</span>',
		content: '<img src="<?php echo $wx_qr; ?>" width="100%">',
		style: ''
	});
}
  
$(function(){
    $('.guide').show();
    return false;
	if(isWeiXin()){
		var subscribe = getCookie('subscribe'); // 是否已经关注了微信公众号
		if(subscribe == 0)
			$('.guide').show();
	}else{
		$('.guide').hide();
	}
})
 
</script> 

<!--微信关注提醒  end-->
<!-- 微信浏览器 调用微信 分享js  end--> 
<!--底部导航-end--> 


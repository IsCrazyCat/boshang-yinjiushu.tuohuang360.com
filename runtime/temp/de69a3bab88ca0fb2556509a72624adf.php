<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:45:"./template/mobile/new2/user\order_detail.html";i:1570353114;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;s:45:"./template/mobile/new2/public\footer_nav.html";i:1542180611;s:43:"./template/mobile/new2/public\wx_share.html";i:1574825649;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>订单详情--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__STATIC__/js/layer.js"  type="text/javascript" ></script>
    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="g4" >

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>订单详情</span>
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

<div class="edit_gtfix">
        <div class="namephone fl">
            <div class="top">
                <div class="le fl"><?php echo $order_info['consignee']; ?></div>
                <div class="lr fl"><?php echo $order_info['mobile']; ?></div>
            </div>
            <div class="bot">
                <i class="dwgp"></i>
                <span><?php echo $region_list[$order_info['province']]; ?>,<?php echo $region_list[$order_info['city']]; ?>,<?php echo $region_list[$order_info['district']]; ?>,<?php echo $order_info['address']; ?></span>
            </div>
        </div>
        <div class="fr youjter">
        </div>
        <div class="ttrebu">
            <img src="__STATIC__/images/tt.png"/>
        </div>
</div>
<div class="packeg p">
    <div class="maleri30">
        <div class="fl">
            <?php if($order_info['order_prom_type'] == 4): ?>
                <h1><span >订单类型：</span><span class="bgnum"></span><span>预售订单</span></h1>
            <?php endif; ?>
            <h1></h1>
        </div>
        <div class="fr">
            <span><?php echo $order_info['order_status_desc']; ?></span>
        </div>
    </div>
</div>
<!--订单商品列表-s-->
<div class="ord_list p">
    <div class="maleri30">
        <?php if(is_array($order_info['goods_list']) || $order_info['goods_list'] instanceof \think\Collection || $order_info['goods_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $order_info['goods_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$good[goods_id])); ?>">
                <div class="shopprice">
                    <div class="img_or fl">
                        <img src="<?php echo goods_thum_images($good[goods_id],100,100); ?>"/>
                    </div>
                    <div class="fon_or fl">
                        <h2 class="similar-product-text"><?php echo $good[goods_name]; ?> ID:<?php echo $good[goods_id]; ?> </h2>
                        <div><span class="bac"><?php echo $good['spec_key_name']; ?></span></div>
                    </div>
                    <div class="price_or fr">
                        <p><span>￥</span><span><?php echo $good['member_goods_price']; ?></span></p>
                        <p>x<?php echo $good['goods_num']; ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--订单商品列表-e-->
<div class="qqz">
    <div class="maleri30">
        <a href="tel:<?php echo $tpshop_config['shop_info_phone']; ?>">联系客服</a>
        <?php if($order_info['cancel_btn'] == 1): ?>
            <a class="closeorder_butt" >取消订单</a>
        <?php endif; ?>
    </div>
</div>
<div class="information_dr ma-to-20">
    <div class="maleri30">
        <div class="tit">
            <h2>基本信息</h2>
        </div>
        <div class="xx-list">
            <p class="p">
                <span class="fl">订单编号</span>
                <span class="fr"><?php echo $order_info['order_sn']; ?></span>
            </p>
            <p class="p">
                <span class="fl">下单时间</span>
                <span class="fr"><span><?php echo date('Y-m-d  H:i:s', $order_info['add_time']); ?></span></span>
            </p>
            <p class="p">
                <span class="fl">收货地址</span>
                <span class="fr"><?php echo $region_list[$order_info[province]]; ?>&nbsp;<?php echo $region_list[$order_info[city]]; ?>&nbsp;<?php echo $region_list[$order_info[district]]; ?>&nbsp;<?php echo $order_info[address]; ?></span>
            </p>
            <p class="p">
                <span class="fl">收货人</span>
                <span class="fr"><span><?php echo $order_info['consignee']; ?></span><span><?php echo $order_info['mobile']; ?></span></span>
            </p>
            <p class="p">
                <span class="fl">支付方式</span>
                <span class="fr"><?php echo $order_info['pay_name']; ?></span>
            </p>
           <!-- <p class="p">
                <span class="fl">配送方式</span>
                <span class="fr"><?php echo $order_info['shipping_name']; ?></span>
            </p>-->
            <p class="p">
                <span class="fl">买家留言</span>
                <span class="fr"><?php echo $order_info['user_note']; ?></span>
            </p>
        </div>
    </div>
</div>
<div class="information_dr ma-to-20">
    <div class="maleri30">
        <div class="tit">
            <h2>价格信息</h2>
        </div>
        <div class="xx-list">
            <p class="p">
                <span class="fl">商品总价</span>
                <span class="fr"><span>￥</span><span><?php echo $order_info['goods_price']; ?></span>元</span>
            </p>
            <!--<p class="p">
                <span class="fl">运费</span>
                <span class="fr"><span>￥</span><span><?php echo $order_info['shipping_price']; ?></span>元</span>
            </p>-->
            <!--<p class="p">
                <span class="fl">优惠券</span>
                <span class="fr"><span>-￥</span><span><?php echo $order_info['coupon_price']; ?></span>元</span>
            </p>
            <p class="p">
                <span class="fl">积分</span>
                <span class="fr"><span>-￥</span><span><?php echo $order_info['integral_money']; ?></span>元</span>
            </p>-->
            <p class="p">
                <span class="fl">余额</span>
                <span class="fr"><span>-￥</span><span><?php echo $order_info['user_money']; ?></span>元</span>
            </p>
            <!--<p class="p">
                <span class="fl">活动优惠</span>
                <span class="fr"><span>-￥</span><span><?php echo $order_info['order_prom_amount']; ?></span>元</span>
            </p>-->
            <p class="p">
                <span class="fl">实付金额</span>
                <span class="fr red"><span>￥</span><span><?php echo $order_info['order_amount']; ?></span>元</span>
            </p>
        </div>
    </div>
</div>

<!--取消订单-s-->
<div class="losepay closeorder" style="display: none;">
    <div class="maleri30">
        <p class="con-lo">取消订单后,存在促销关系的子订单及优惠可能会一并取消。是否继续？</p>
        <div class="qx-rebd">
            <a class="ax">取消</a>
            <a class="are" onclick="cancel_order(<?php echo $order_info['order_id']; ?>)">确定</a>
        </div>
    </div>
</div>
<!--取消订单-e-->

<div class="mask-filter-div" style="display: none;"></div>

<!--底部支付栏-s-->
<div class="payit ma-to-20">
    <!--<div class="fl">-->
            <!--<p><span class="pmo">实付金额：</span>-->
                <!--<span>￥</span><span><?php echo $order_info['order_amount']+$order_info['shipping_price']; ?></span>-->
            <!--</p>-->
            <!--<p class="lastime"><span>付款剩余时间：</span><span id="lasttime"></span></p>-->
            <!--&lt;!&ndash;<p class="deel"><a href="<?php echo U('Mobile/User/order_del',array('order_id'=>$order_info['order_id'])); ?>">删除订单</a></p>&ndash;&gt;-->
    <!--</div>-->
    <div class="fr s">
        <?php if($order_info['pay_btn'] == 1): ?>
            <a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$order_info['order_id'])); ?>">立即付款</a>
            <?php else: ?>
            <a><?php echo $order_info['order_status_desc']; ?></a>
        <?php endif; if($order_info['receive_btn'] == 1): ?>
            <a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$order_info['order_id'])); ?>">收货确认</a>
        <?php endif; if($order_info['shipping_btn'] == 1): ?>
            <a href="<?php echo U('Mobile/User/express',array('order_id'=>$order_info['order_id'])); ?>" >查看物流</a>
        <?php endif; if($order_info['order_prom_type'] == 4 AND $order_info['pay_status'] == 2 AND $order_info['pre_sell_is_finished'] == 1 AND (time() >= $order_info['pre_sell_retainage_start'] AND time() <= $order_info['pre_sell_retainage_end'])): ?>
            <a class="ddn3" style="margin-top:20px;" href="<?php echo U('/Home/Cart/cart4',array('order_id'=>$order_info[order_id])); ?>'">支付尾款</a>
        <?php endif; ?>
    </div>
</div>


<!--底部支付栏-d-->

<script type="text/javascript">
    //取消订单按钮
    $('.closeorder_butt').click(function(){
        $('.mask-filter-div').show();
        $('.losepay').show();
    })
    //取消取消订单
    $('.qx-rebd .ax').click(function(){
        $('.mask-filter-div').hide();
        $('.losepay').hide();
    })

    //确认取消订单
    function cancel_order(id){
        $.ajax({
            type: 'GET',
            dataType:'JSON',
            url:"/index.php?m=Mobile&c=User&a=cancel_order&id="+id,
            success:function(data){
                if(data.code == 1){
                    layer.open({content:data.msg,time:2});
                    location.href = "/index.php?m=Mobile&c=User&a=order_detail&id="+id;
                }else{
                    layer.open({content:data.msg,time:2});
                    location.href = "/index.php?m=Mobile&c=User&a=order_detail&id="+id;
                    return false;
                }
            },
            error:function(){
                layer.open({content:'网络失败，请刷新页面后重试',time:3});
            },
        });
        $('.mask-filter-div').hide();
        $('.losepay').hide();
    }


    //        $('.loginsingup-input .lsu i').click(function(){
    //            $(this).toggleClass('eye');
    //            if ($(this).hasClass('eye')) {
    //                $(this).siblings('input').attr('type','text')
    //            } else{
    //                $(this).siblings('input').attr('type','password')
    //            }
    //        });
</script>

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
   var ShareImgUrl = "http://www.yinjiushu.com/public/upload/temp/2019/10-05/fca1abde72d3b91576296bad1bd85806.jpg"; //分享图标
   
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
</body>
</html>

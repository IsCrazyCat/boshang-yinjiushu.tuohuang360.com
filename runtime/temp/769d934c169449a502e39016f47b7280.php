<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:37:"./template/mobile/new2/cart\cart.html";i:1572692769;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;s:45:"./template/mobile/new2/public\footer_nav.html";i:1542180611;s:43:"./template/mobile/new2/public\wx_share.html";i:1571744578;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>购物车--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>购物车</span>
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
<?php if(empty($user['user_id'])): ?>
<!--###用户未登录###-->
    <div class="loginlater">
        <img src="__STATIC__/images/small_car.png"/>
        <span>登录后可同步电脑和手机购物车</span>
        <a href="<?php echo U('Mobile/User/loagin'); ?>">登录</a>
    </div>
    <!--购物车有商品-s-->
    <div class="cart_list">
        <form id="cart_form" name="formCart" action="<?php echo U('Mobile/Cart/ajaxCartList'); ?>" method="post">
            <?php echo token(); ?>
        </form>
    </div>
    <!--购物车有商品-e-->

    <!--看看热卖-start-->
    <div class="hotshop seehotsho">
        <div class="thirdlogin">
            <h4>看看热卖</h4>
        </div>
    </div>
    <div class="floor guesslike">
        <div class="likeshop">
            <ul>
                <?php if(is_array($hot_goods) || $hot_goods instanceof \think\Collection || $hot_goods instanceof \think\Paginator): if( count($hot_goods)==0 ) : echo "" ;else: foreach($hot_goods as $key=>$good): ?>
                    <li>
                        <a href="<?php echo U('Mobile/goods/goodsInfo',array('id'=>$good[goods_id])); ?>">
                            <div class="similer-product">
                                <img src="<?php echo goods_thum_images($good[goods_id],200,200); ?>"/>
                                <span class="similar-product-text"><?php echo getsubstr($good[goods_name],0,20); ?></span>
                                <span class="similar-product-price">
                                    ¥<span class="big-price"><?php echo $good[shop_price]; ?></span>
                                    <!--<span class="small-price">.00</span>-->
                                </span>
                            </div>
                        </a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="add">热卖商品实时更新，常回来看看哟~</div>
    </div>
    <!--看看热卖-end-->

<?php else: ?>
<!--###用户已登录###-->
    <!--购物车有商品-s-->
    <div class="cart_list">
        <form id="cart_form" name="formCart" action="<?php echo U('Mobile/Cart/ajaxCartList'); ?>" method="post">
            <?php echo token(); ?>
        </form>
    </div>
    <!--购物车有商品-e-->
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function(){
        ajax_cart_list(); // ajax 请求获取购物车列表
    });

    /**加载购物车商品列表*/
    var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
    function ajax_cart_list(){
        if(before_request == 0) // 上一次请求没回来 不进行下一次请求
            return false;
        before_request = 0;
        $.ajax({
            type : "POST",
            url:"<?php echo U('Mobile/Cart/ajaxCartList'); ?>",//+tab,
            data : $('#cart_form').serialize(),// 你的formid
            success: function(data){
                $("#cart_form").html('');
                $("#cart_form").append(data);
                before_request = 1;
            }
        });
    }

    /**
     * 购买商品数量加加减减
     * 购买数量 , 购物车id , 库存数量
     */
    function switch_num(num,cart_id,store_count){
        var num2 = parseInt($("input[name='goods_num["+cart_id+"]']").val());
        //加减数量
        num2 += num;
        if(num2 < 1) num2 = 1;  // 保证购买数量不能少于 1
        if(num2 > store_count) { //保证 不超过库存
            layer.open({content:"库存只有 "+store_count+" 件, 你只能买 "+store_count+" 件",time:2})
            num2 = store_count; // 保证购买数量不能多余库存数量
        }
        $("input[name='goods_num["+cart_id+"]']").val(num2);
        ajax_cart_list();
    }
	
	
	/**
     * 购买商品数量加加减减
     * 购买数量 , 购物车id , 库存数量
     */
    function my_switch_num(num,cart_id,store_count){
        num2 = num;
        if(num2 < 1) num2 = 1;  // 保证购买数量不能少于 1
        if(num2 > store_count) { //保证 不超过库存
            layer.open({content:"库存只有 "+store_count+" 件, 你只能买 "+store_count+" 件",time:2})
            num2 = store_count; // 保证购买数量不能多余库存数量
        }
        $("input[name='goods_num["+cart_id+"]']").val(num);
        ajax_cart_list();
    }

    //删除商品
    function del_cart_goods(goods_id)
    {
        if(!confirm('确定要删除吗?'))
            return false;
        var chk_value = [];
        chk_value.push(goods_id);
        // ajax调用删除
        if(chk_value.length > 0)
            ajax_del_cart(chk_value.join(','));
    }

    // ajax 删除购物车的商品
    function ajax_del_cart(ids)
    {
        $.ajax({
            type : "POST",
            url:"<?php echo U('Mobile/Cart/ajaxDelCart'); ?>",
            data:{ids:ids},
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    ajax_cart_list(); //ajax 请求获取购物车列表
                }
            }
        });
    }

    // 批量删除购物车的商品
//    function del_cart_more()
//    {
//        if(!confirm('确定要删除吗?'))
//            return false;
//        // 循环获取复选框选中的值
//        var chk_value = [];
//        $('input[name^="cart_select"]:checked').each(function(){
//            var s_name = $(this).attr('name');
//            var id = s_name.replace('cart_select[','').replace(']','');
//            chk_value.push(id);
//        });
//        // ajax调用删除
//        if(chk_value.length > 0)
//            ajax_del_cart(chk_value.join(','));
//    }
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





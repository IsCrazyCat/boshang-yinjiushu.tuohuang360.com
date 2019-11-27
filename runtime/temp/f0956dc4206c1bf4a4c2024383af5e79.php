<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./template/mobile/new2/distribut\index.html";i:1571023891;s:45:"./template/mobile/new2/public\footer_nav.html";i:1542180611;s:43:"./template/mobile/new2/public\wx_share.html";i:1571744578;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>分销中心</title>
            <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__STATIC__/js/layer.js"  type="text/javascript" ></script>
    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>

        <link rel="stylesheet" type="text/css" href="__STATIC__/distribut/css/main.css"/>
	</head>
	<body class="bag_gray">
		<div class="retails_head">
			<div class="my_head">
				<div class="head">
                    <img src="<?php echo (isset($user[head_pic]) && ($user[head_pic] !== '')?$user[head_pic]:"__STATIC__/images/user68.jpg"); ?>"/>
                </div>
				<div class="my_name_in fl" style="width:10rem;height:auto;">
					<p class="my_name" style="height:auto;"><span style="float:left; font-size:0.8rem;">ID:<?php echo $user['user_id']; ?></span><span style="float:left; font-size:0.8rem;"  >〖<?php if($user[level] == 2): ?>公司会员<?php elseif($user[level] == 3): ?>公司经销商<?php elseif($user[level] == 4): ?>合伙创始人<?php else: ?>注册会员<?php endif; ?>〗</span></p>
					<p class="my_name" style="height:auto;"><span style="float:left; font-size:0.8rem;"><?php echo $user['nickname']; ?></span></p>

					<p class="my_in"><?php echo $store['store_name']; ?></p>
				</div>
			</div>
			<div class="my_share">
                <a href="<?php echo U('Distribut/set_store'); ?>"><i class="icon-setting"></i></a>
            </div>
			<p class="open_time">注册时间：<?php echo date('Y-m-d',$user['reg_time']); ?></p>
		</div>
        
        
        <div class="choose_retails_shop ma-to-8 p">
			<div class="tit_withdrawals">
				<a href="">
					<i class="icon-Commission"></i>
					<span class="mi_cutout">可提现金额 (元)</span>
					<i class="icon-arrow_r"></i>
				</a>
			</div>
			<div class="content_cash">
				<div class="cashleri p">
					<div class="sum_money_le">
						<span><?php echo (isset($user['user_money']) && ($user['user_money'] !== '')?$user['user_money']:"0.00"); ?></span>
					</div>
					<div class="detail_money_ri">
						<p><span class="tit">今日收入(元)</span><span class="cont"><?php echo (isset($money['today_money']) && ($money['today_money'] !== '')?$money['today_money']:"0.00"); ?></span></p>
						<p><span class="tit">总销售额(元)</span><span class="cont">￥<?php echo $sales_volume; ?></span></p>
					</div>
				</div>
				<p class="all_comm">
					<span class="tit">累计获得佣金(元)</span><span class="cont">￥<?php echo (isset($money['achieve_money']) && ($money['achieve_money'] !== '')?$money['achieve_money']:"0.00"); ?></span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="tit">冻结佣金(元)</span><span class="cont">￥<?php echo (isset($money['prepare_money']) && ($money['prepare_money'] !== '')?$money['prepare_money']:"0.00"); ?></span>
				</p>

			</div>
			<!--<div class="w670 ma-to-50">
				<a class="submit_set" href="<?php echo U('Distribut/goods_list'); ?>">选择分销商品</a>
			</div>-->
		</div>
        
		<div class="mynav_link_list ma-to-8 p">
			<ul>
				<!--<li>
					<a href="<?php echo U('Distribut/order_list'); ?>">
						<i class="fx-f1"></i>
						<span>分销订单</span>
					</a>
				</li>-->
				<li >
					<a href="<?php echo U('Distribut/lower_list_20181126'); ?>"><!-- add by lishibo -->
						<i class="fx-f2"></i>
						<span>我的团队</span>
					</a>
				</li>
				<li >
					<a href="<?php echo U('Distribut/qr_code', ['user_id'=>$user_id]); ?>">
						<i class="fx-f3"></i>
						<span>我的名片</span>
					</a>
				</li>
				<li >
					<a href="<?php echo U('Distribut/myrankings',array('order'=>'underling_number')); ?>">
						<i class="fx-f4"></i>
						<span>分销排行</span>
					</a>
				</li>
				
			</ul>
		</div>
		
		<div class="mynav_link_list ma-to-8 p">
			<ul>
				
				
				<!--<li >
					<a href="<?php echo U('Distribut/must_see'); ?>">
						<i class="fx-f5"></i>
						<span>新手必看</span>
					</a>
				</li>-->
				<!--<li>
					<a href="<?php echo U('Distribut/my_store'); ?>">
						<i class="fx-f6"></i>
						<span>查看网店</span>
					</a>
				</li>-->
				<li >
					<!--更改佣金明细查询 lishibo 2018/12/11 -->
					<a href="<?php echo U('Distribut/rebate_log_20181211'); ?>">
						<i class="fx-f7"></i>
						<span>佣金明细</span>
					</a>
				</li>
				<li >
					<a href="<?php echo U('User/index'); ?>">
						<i class="fx-f8"></i>
						<span>会员中心</span>
					</a>
				</li>
			</ul>
		</div>
        
                <div class="myorder p">
                        <link rel="stylesheet" type="text/css" href="__STATIC__/distribut/css/main.css"/>
                    
					<div class="w670 ma-to-50">
				         <a class="submit_set" href="<?php echo U('User/logout'); ?>">安全退出</a>
			        </div>
					
					
                </div>        
        
        
    <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
		
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

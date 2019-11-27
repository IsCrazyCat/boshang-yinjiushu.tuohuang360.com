<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:38:"./template/mobile/new2/cart\cart2.html";i:1571887794;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;s:45:"./template/mobile/new2/public\footer_nav.html";i:1542180611;s:43:"./template/mobile/new2/public\wx_share.html";i:1574825649;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>填写订单--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <span>填写订单</span>
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
<form name="cart2_form" id="cart2_form" method="post">
    <div class="edit_gtfix">
        <a href="<?php echo U('Mobile/User/address_list',array('source'=>'cart2')); ?>">
            <div class="namephone fl">
                <div class="top">
                    <div class="le fl"><?php echo $address['consignee']; ?></div>
                    <div class="lr fl"><?php echo $address['mobile']; ?></div>
                </div>
                <div class="bot">
                    <i class="dwgp"></i>
                    <span>
                        <?php 
                            $ppname = M('region')->where(array('id' => $address['province']))->value('name');
                            $ccname = M('region')->where(array('id' => $address['city']))->value('name');
                            $ddname = M('region')->where(array('id' => $address['district']))->value('name');
                            echo $ppname . ' ' .$ccname . ' ' .$ddname;
                         ?>
                    </span>
                </div>
                <div class="bot">
                    <span><?php echo $address['address']; ?></span>
                </div>
                <input type="hidden" value="<?php echo $address['address_id']; ?>" name="address_id" /> <!--收货地址id-->
            </div>
            <div class="fr youjter">
                <i class="Mright"></i>
            </div>
            <div class="ttrebu">
                <img src="__STATIC__/images/tt.png"/>
            </div>
        </a>
    </div>

    <!--商品信息-s-->
        <div class="ord_list fill-orderlist p">
            <div class="maleri30">
                <?php if(is_array($cartList) || $cartList instanceof \think\Collection || $cartList instanceof \think\Paginator): if( count($cartList)==0 ) : echo "" ;else: foreach($cartList as $key=>$good): if($good[selected] == '1'): ?>
                    <div class="shopprice">
                        <div class="img_or fl"><img src="<?php echo goods_thum_images($good[goods_id],100,100); ?>"/></div>
                        <div class="fon_or fl">
                            <h2 class="similar-product-text"><?php echo $good[goods_name]; ?></h2>
                            <div><?php echo $good[spec_key_name]; ?></div>
                        </div>
                        <div class="price_or fr">
                            <p class="red"><span>￥</span><span><?php echo $good[member_goods_price]; ?></span></p>
                            <p class="ligfill">x<?php echo $good[goods_num]; ?></p>
                        </div>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    <!--商品信息-e-->

    <!--支持配送,发票信息-s-->
    <div class="information_dr">
        <div class="maleri30">
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a class="takeoutps" href="javascript:void(0)">
                            <div class="order">
                                <div class="fl">
                                    <span>支持配送</span>
                                </div>
                                <div class="fr">
                                    <span id="postname" style="line-height: 1.2rem;">不选择，则按默认配送方式</span>
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="invoice list7" style="display:none">
                <div class="myorder p">
                    <div class="content30">
                        <a class="invoiceclickin" href="javascript:void(0)">
                            <div class="order">
                                <div class="fl">
                                    <span>发票信息</span>
                                </div>
                                <div class="fr">
                                    <span>纸质发票-个人<br>非图书商品-不开发票</span>
                                    <input class="txt1" style='display:none;' type="text" name="invoice_title" />
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="invoice" class="invoice list7" style="display: none;">
                <div class="myorder p">
                    <div class="content30">
                        <div class="incorise">
                            <span>发票抬头：</span>
                            <input type="text" name="" id="" value="" placeholder="xx单位或xx个人" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice list7" style="display:none">
                <div class="myorder p">
                    <div class="content30">
                        <a class="remain" href="javascript:void(0);">
                            <div class="order">
                                <div class="fl">
                                    <span>使用余额/积分</span>
                                </div>
                                <div class="fr">
                                    <!--<i class="Mright"></i>-->
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <!--使用余额、积分-s-->
            <div id="balance-li" class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>使用余额：</span>
                                <input id="user_money" name="user_money"   type="text"  onblur="func()"  placeholder="可用余额为:<?php echo $user['user_money']; ?>" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''"  onclick="this.focus();" <?php if($user['user_money'] >= $total_price['total_fee']): ?>value='<?php echo $total_price['total_fee']; ?>'<?php else: ?>value='0.00'<?php endif; ?> />
                                
                                <input name="validate_bonus" type="button" value="使用" onClick="wield(this);" class="usejfye" />
                            </div>
                        </label>
                    </div>
                </div>
                <div class="myorder p" style="display:none">
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>使用积分：</span>
                                <input id="pay_points" name="pay_points" type="text"    placeholder="可用积分为:<?php echo $user['pay_points']; ?>"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')"  readonly="readonly" />
                                <input name="validate_bonus" type="button" value="使用" onClick="wield(this);" class="usejfye"/>
                            </div>
                        </label>
                    </div>
                </div>
                <?php if(empty($checkconpon)): ?>
                    <div class="myorder p"  style="display:none">
                        <div class="content30">
                            <label>
                                <div class="incorise">
                                    <span>使用券码：</span>
                                    <input id="couponCode" name="couponCode" type="text"   placeholder="填写优惠券券码" readonly="readonly" />
                                    <input name="validate_bonus" type="button" value="使用" onClick="wield(this);$('#coupon_div').hide();" class="usejfye"/>
                                </div>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="myorder p" id="paypwd_view" style="display:none" >
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>支付密码：</span>
                                <input type="password" id="paypwd" name="paypwd" placeholder="请输入支付密码"/>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        <!--使用余额、积分-e-->
        </div>
    </div>
<!--支持配送,发票信息-s-->

<!--优惠券-s-->
    <div class="information_dr ma-to-20" id="coupon_div" style="display:none">
        <div class="maleri30">
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a href="<?php echo U('mobile/User/checkcoupon',array('lid'=>$checkconpon['lid'])); ?>">
                            <div class="order">
                                <div class="fl">
                                    <span>优惠券</span>
                                    <span class="couponssl"><em><?php echo count($couponList); ?></em>张可用</span>
                                </div>
                                <div class="fr">
                                    <?php if(!empty($checkconpon)): ?>
                                        <span class="setalit"><?php echo $checkconpon['name']; ?></span>
                                        <input type="hidden" name="coupon_id"  value="<?php echo $checkconpon['lid']; ?>" />
                                    <?php else: ?>
                                        <span class="setalit">未使用</span>
                                   <?php endif; ?>
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--优惠券-e-->

<!--卖家留言-s-->
    <div class="customer-messa">
        <div class="maleri30">
            <p>用户备注（50字）</p>
            <textarea class="tapassa" onkeyup="checkfilltextarea('.tapassa','50')" name="user_note" rows="" cols="" placeholder="选填"></textarea>
            <span class="xianzd"><em id="zero">50</em>/50</span>
        </div>
    </div>
<!--卖家留言-e-->

<!--订单金额-s-->
    <div class="information_dr ma-to-20">
        <div class="maleri30">
            <div class="xx-list">
                <p class="p">
                    <span class="fl">商品金额：</span>
                    <span class="fr red"><span>￥</span><span><?php echo $total_price['total_fee']; ?></span>元</span>
                </p>
                <p class="p">
                    <span class="fl">配送费用：</span>
                    <span class="fr red" ><span>￥</span><span id="postFee">0</span>元</span>
                </p>
               <!-- <p class="p">
                    <span class="fl">使用优惠券：</span>
                    <span class="fr red" ><span>-￥</span><span id="couponFee">0</span>元</span>
                </p>
                <p class="p">
                    <span class="fl">使用积分：</span>
                    <span class="fr red" ><span>-￥</span><span id="pointsFee">0</span>元</span>
                </p>-->
                <p class="p">
                    <span class="fl">使用余额：</span>
                    <span class="fr red" ><span>-￥</span><span id="balance">0</span>元</span>
                </p>
               <!-- <p class="p">
                    <span class="fl">优惠活动：</span>
                    <span class="fr red" ><span>-￥</span><span id="order_prom_amount">0</span>元</span>
                </p>-->
            </div>
        </div>
    </div>
<!--订单金额-e-->

<!--提交订单-s-->
    
    <div class="payit fillpay "  >
        <div class="fr">
            <a href="javascript:void(0)" onclick="submit_order()">提交订单</a>
        </div>
        <div class="fl">
            <p><span class="pmo">应付金额：</span>￥<span id="payables"></span><span></span></p>
        </div>
    </div>
    <div class="mask-filter-div" style="display: none;"></div>
<!--提交订单-e-->

<!--配送弹窗-s-->
    <div class="losepay closeorder" style="display: ;">
        <div class="maleri30">
            <div class="l_top">
                <span>配送方式</span>
                <em class="turenoff"></em>
            </div>
            <div class="resonco">
                <?php if(is_array($shippingList) || $shippingList instanceof \think\Collection || $shippingList instanceof \think\Paginator): if( count($shippingList)==0 ) : echo "" ;else: foreach($shippingList as $k=>$v): ?>
                    <label >
                        <div class="radio">
                            <span class='che <?php if($k == 0): ?>check_t<?php endif; ?>' postname='<?php echo $v['name']; ?>'>
                                <i></i>
                                <input type="radio" id="<?php echo $v['code']; ?>" name="shipping_code" id="<?php echo $v['code']; ?>" value="<?php echo $v['code']; ?>" style="display: none;" <?php if($k == 0): ?> checked="checked" <?php endif; ?> onclick="ajax_order_price()" class="c_checkbox_t" />
                                <span><?php echo $v['name']; ?></span>
                                <span>￥<?php echo $v['freight']; ?></span>
                            </span>
                        </div>
                    </label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="submits_de bagrr" >确认</div>
    </div>
<!--配送弹窗-e-->
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#pay_points,#user_money', function() {
            if ($('#user_money').val() !== '' || $('#pay_points').val() !== '') {
                //$('#paypwd_view').show();
				$('#paypwd_view').hide();
            } else {
                $('#paypwd_view').hide();
            }
        });
        $('.radio .che').bind('click',function(){
            //选择配送方式
            $(this).addClass('check_t')
                    .parent().parent().siblings('label').find('.che').removeClass('check_t');
            //选择配送方式显示到支持配送栏
            $('#postname').text($(this).attr('postname'));
        });

        ajax_order_price(); // 计算订单价钱
    });
    
            showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
    
	var usermoney = document.getElementById('user_money');
	usermoney.onblur= function() {
		 if($.trim(usermoney.value) !=''){
			showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
		 }else{
			$('#user_money').val(0); 
			showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
		 }
	}
	
  function func(){
	  var usermoney = document.getElementById('user_money');
          if($.trim(usermoney.value) !=''){
			showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
		 }else{
			$('#user_money').val(0); 
			showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
		 }
  }

    function wield(obj){
        if($.trim($(obj).prev().val()) !=''){
            showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
        }
    }
    // 获取订单价格
    function ajax_order_price()
    {
        $.ajax({
            type : "POST",
            url:'/index.php?m=Mobile&c=Cart&a=cart3&act=order_price&t='+Math.random(),
            data : $('#cart2_form').serialize(),
            dataType: "json",
            success: function(data){
                if(data.status != 1)
                { //执行有误
                    $('#coupon_div').show();
                    showErrorMsg(data.msg);
                    // 登录超时
                    if(data.status == -100)
                        location.href ="<?php echo U('Mobile/User/login'); ?>";
                    return false;
                }
              $("#balance").text(data.result.balance);// 余额
              $("#pointsFee").text(data.result.pointsFee);// 积分支付
                $("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动
                $("#postFee").text(data.result.postFee); // 物流费
                if(data.result.couponFee == null){
                    $("#couponFee").text(0);// 优惠券
                }else{
                    $("#couponFee").text(data.result.couponFee);// 优惠券
                }
                $("#payables").text(data.result.payables);// 应付
            }
        });
    }

    // 提交订单
    ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
    function submit_order() {
        if (ajax_return_status == 0)
            return false;
        ajax_return_status = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo U('Mobile/Cart/cart3'); ?>",//+tab,
            data: $('#cart2_form').serialize() + "&act=submit_order",// 你的formid
            dataType: "json",
            success: function (data) {
                if (data.status != '1') {
                    showErrorMsg(data.msg);  //执行有误
                    // 登录超时
                    if (data.status == -100)
                        location.href = "<?php echo U('Mobile/User/login'); ?>";

                    ajax_return_status = 1; // 上一次ajax 已经返回, 可以进行下一次 ajax请求

                    return false;
                }
                $("#postFee").text(data.result.postFee); // 物流费
                if(data.result.couponFee == null){
                    $("#couponFee").text(0);// 优惠券
                }else{
                    $("#couponFee").text(data.result.couponFee);// 优惠券
                }
                $("#balance").text(data.result.balance);// 余额
                $("#pointsFee").text(data.result.pointsFee);// 积分支付
                $("#payables").text(data.result.payables);// 应付
                $("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动
                showErrorMsg('订单提交成功，跳转支付页面!');
                location.href = "/index.php?m=Mobile&c=Cart&a=cart4&order_id=" + data.result;
            }
        });
    }

    $(function(){
        //显示配送弹窗
        $('.takeoutps').click(function(){
            $('.mask-filter-div').show();
            $('.losepay').show();
        })
        //关闭选择物流
        $('.turenoff').click(function(){
            $('.mask-filter-div').hide();
            $('.losepay').hide();
        })

        $('.submits_de').click(function(){
            $('.mask-filter-div').hide();
            $('.losepay').hide();
        })

        //显示隐藏使用发票信息
        $('.invoiceclickin').click(function(){
            $('#invoice').toggle(300);
        })
//        //显示隐藏使用余额/积分
//        $('.remain').click(function(){
//            $('#balance-li').toggle(300);
//        })
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


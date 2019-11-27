<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"./template/mobile/new2/distribut\rebate_log_20181211.html";i:1570615674;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>分成明细--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <a href="JavaScript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>分成明细</span>
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
<link rel="stylesheet" type="text/css" href="__STATIC__/distribut/css/main.css"/>
<style>
    .fll_acc ul li{
        font-size: .4rem;
        line-height: 2em;
    }
</style>
<div class="allaccounted">
    <div class="maleri30">
        <!--排序按钮-s-->
        <nav class="storenav p search_list_dump" id="head_search_box product_sort">
            <ul>
                <li>
                    <span class="lb <?php if(\think\Request::instance()->param('status') != ''): ?>on red<?php endif; ?>"></span>
                    <i></i>
                </li>
                <!--<li class="<?php if(\think\Request::instance()->param('status') == 'sales_sum'): ?>red<?php endif; ?>">-->
                    <!--<a href="<?php echo U('Mobile/Distribut/rebate_log',array('id'=>$vo[goods_id])); ?>" >-->
                        <!--<span class="dq" >销量</span>-->
                    <!--</a>-->
                <!--</li>-->
                <li class="<?php if(\think\Request::instance()->param('sort') == 'money'): ?>red<?php endif; ?>">
                <?php if(\think\Request::instance()->param('sort_asc') == 'asc'): ?>
                    <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('sort'=>'money','sort_asc'=>'desc')); ?>">
                <?php else: ?>
                    <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('sort'=>'money','sort_asc'=>'asc')); ?>">
                <?php endif; ?>
                        <span class="jg dq">佣金</span>
                    </a>
                    <i  class="pr <?php if(\think\Request::instance()->param('sort_asc') == 'asc'): ?>bpr2<?php endif; if(\think\Request::instance()->param('sort_asc') == 'desc'): ?> bpr1 <?php endif; ?>"></i>
                </li>
            </ul>
        </nav>
        <!--排序按钮-e-->
        <!--综合排序-s-->
        <div class="fil_all_comm">
            <div class="maleri30">
                <ul>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>'')); ?>" class="<?php if(\think\Request::instance()->param('status') == ''): ?>on red <?php endif; ?>"  >综合</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>0)); ?>" class="<?php if(\think\Request::instance()->param('status') == '0'): ?>on red <?php endif; ?>"  >未付款</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>1)); ?>" class="<?php if(\think\Request::instance()->param('status') == '1'): ?>on red<?php endif; ?>">已付款</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>2)); ?>" class="<?php if(\think\Request::instance()->param('status') == '2'): ?>on red<?php endif; ?>">等待成</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>3)); ?>" class="<?php if(\think\Request::instance()->param('status') == '3'): ?>on red<?php endif; ?>">已分成</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Distribut/rebate_log_20181211',array('status'=>4)); ?>" class="<?php if(\think\Request::instance()->param('status') == '4'): ?>on red<?php endif; ?>">已取消</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--综合排序-e-->

        <?php if(!empty($lists)): ?>

            <div  id="allpion">
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$v): ?>
                    <div class="fll_acc">
                        <ul>
                            <li style="width: 46%;">
                                <p><?php echo $v[jxmc]; ?><br />
订单:<?php echo $v[order_sn]; ?></p>
                                <p>购买人：<?php echo getsubStr($v[nickname],0,10); ?></p>
                            </li>
                            <li style="width: 24%;">
                                <p><span>订单金额: </span><span class="red"><?php echo $v[goods_price]; ?></span></p>
                                <p><span>分成金额: </span><span class="red"><?php echo $v[money]; ?></span></p>
                            </li>
                            <li style="width: 30%;">
                                <p><span>支付状态: </span>
                                    <span class="red">
                                        <?php if($v[status] == 0): ?>未付款<?php endif; if($v[status] == 1): ?>已付款<?php endif; if($v[status] == 2): ?>等待分成<?php endif; if($v[status] == 3): ?>已分成<?php endif; if($v[status] == 4): ?>已取消<?php endif; ?>
                                    </span>
                                </p>
                                <p class="coligh"><span><?php echo date('Y-m-d H:i:s',$v[create_time]); ?></span></p>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <p class="nextpage" id="getNext"  style="background-color: #f94f50;" onclick="ajax_next(1)">下一页</p>
            <?php else: ?>
                <!--没有内容时-s-->
                <div class="comment_con p">
                    <div style="padding:1rem;text-align: center;font-size: .59733rem;color: #777777;"><img src="__STATIC__/images/none.png"/><br /><br />亲，没找到你要的数据！</div>
                </div>
                <!--没有内容时-e-->
            <?php endif; ?>
    </div>
</div>

<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

    $(function(){
        //显示综合筛选弹窗
        $('.search_list_dump .lb').click(function(){
            $('.fil_all_comm').show();
            cover();
            $('.classreturn,.search_list_dump').addClass('pore');
        });
        $('.lb').text($('.on').text());
    })

    var  page = 1;
    var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求 by lishibo
    function ajax_next(p)
    {
        if(before_request == 0)// 上一次请求没回来 不进行下一次请求
            return false;
        before_request = 0;
        page += p;
        page = page<=0 ? 0 : page;
        $.ajax({
            type : "GET",
            async:false,
            url:"/index.php?m=Mobile&c=Distribut&a=rebate_log_20181211&status=<?php echo $status; ?>&is_ajax=1&p="+page,
            success: function(data)
            {
                if($.trim(data) == ''){
                    $('#getNext').css("background-color","lightgrey");
                    $('#getNext').text("没有更多数据");
                    $('#getNext').attr("disabled",true);
                }else{
                    $("#allpion").append(data);
                    $('#getNext').show();
                    before_request = 1;
                }
            }
        });
    }
</script>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./template/mobile/new2/user\points.html";i:1524293412;s:41:"./template/mobile/new2/public\header.html";i:1542371282;s:45:"./template/mobile/new2/public\header_nav.html";i:1533297512;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>账户明细--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <a href="<?php echo U('Mobile/User/account'); ?>"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>账户明细</span>
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
<div class="allaccounted">
    <div class="maleri30">
        <div class="head_acc ma-to-20">
            <ul>
                <li <?php if($type == 'all'): ?>class="red"<?php endif; ?>">
                    <a href="<?php echo U('User/points',array('type'=>'all')); ?>"  data-list="1">全部</a>
                </li>
                <li <?php if($type == 'recharge'): ?>class="red"<?php endif; ?>>
                    <a href="<?php echo U('User/points',array('type'=>'recharge')); ?>"   data-list="2">充值记录</a>
                </li>
                <li  <?php if($type == 'points'): ?>class="red"<?php endif; ?>>
                    <a href="<?php echo U('User/points',array('type'=>'points')); ?>"  data-list="3">积分</a>
                </li>
                <input type="hidden" class="record" value="<?php echo $type; ?>"/>
            </ul>
        </div>

        <?php if($type == 'recharge'): ?>
            <div class="allpion">
                <?php if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$recharge): ?>
                    <div class="fll_acc">
                        <ul>
                            <li><?php echo $recharge[pay_name]; ?></li>
                            <li><span>充值金额: </span><span class="red"><?php echo $recharge[account]; ?></span></li>
                            <li>
                                <p><span>支付状态: </span>
                                    <span class="red">
                                        <?php if($recharge[pay_status] == 0): ?>
                                            待支付&nbsp;&nbsp;<a href="<?php echo U('User/recharge',array('order_id'=>$recharge[order_id])); ?>" class="">详情</a>
                                    <?php else: ?>
                                            已支付
                                        <?php endif; ?>
                                    </span>
                                </p>
                                <p class="coligh"><span><?php echo date('Y-m-d H:i:s',$recharge[ctime]); ?></span></p>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php else: ?>
            <div class="allpion">
                <?php if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$v): ?>
                    <div class="fll_acc">
                        <ul>
                            <li><?php echo $v[desc]; ?></li>
                            <li>
                                <span>余额：</span><span class="red"><?php echo $v[user_money]; ?></span></li>
                            <li>
                                <p>
                                    <span>积分：</span><span class="red"><?php echo $v[pay_points]; ?></span>
                                </p>
                                <p class="coligh">
                                    <span><?php echo date('Y-m-d H:i:s',$v[change_time]); ?></span>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; if(empty($account_log) || (($account_log instanceof \think\Collection || $account_log instanceof \think\Paginator ) && $account_log->isEmpty())): ?>
            <div style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
                <span>暂无数据</span>
            </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
<script type="text/javascript">
//    var record=$('.record').val();   //获取记录类型
    //加载更多记录
    var page = 1;
    function ajax_sourch_submit()
    {
        ++page;
        $.ajax({
            type : "GET",
            url:"/index.php?m=Mobile&c=User&a=points&is_ajax=1&type=<?php echo $type; ?>&p="+page,//+tab,
    //			url:"<?php echo U('Mobile/User/points',null,''); ?>/is_ajax/1/p/"+page,//+tab,
    //			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
            success: function(data)
            {
                if($.trim(data) == '') {
                    $('#getmore').hide();
                }else{
                    $(".allpion").append(data);
                }
            }
        });
    }
</script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:48:"./template/mobile/new2/user\ajax_order_list.html";i:1572922391;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
    <div class="mypackeg ma-to-20 getmore">
        <div class="packeg p">
            <div class="maleri30">
                <div class="fl">
                    <h1><span></span><span class="bgnum"></span></h1>
                    <p class="bgnum"><span>订单编号:</span><span><?php echo $list['order_sn']; ?></span></p>
                </div>
                <div class="fr">
                    <span><?php echo $list['order_status_desc']; ?></span>
                </div>
            </div>
        </div>
        <div class="shop-mfive p">
            <div class="maleri30">
                    <?php if(is_array($list['goods_list']) || $list['goods_list'] instanceof \think\Collection || $list['goods_list'] instanceof \think\Paginator): if( count($list['goods_list'])==0 ) : echo "" ;else: foreach($list['goods_list'] as $key=>$good): ?>
                        <div class="sc_list se_sclist paycloseto">
                            <a <?php if($list['receive_btn'] == 1): ?>href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'],'waitreceive'=>1)); ?>" <?php else: ?> href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'])); ?>"<?php endif; ?>>
                            <div class="shopimg fl">
                                <img src="<?php echo goods_thum_images($good[goods_id],200,200); ?>">
                            </div>
                            <div class="deleshow fr">
                                <div class="deletes">
                                    <span class="similar-product-text"><?php echo getSubstr($good[goods_name],0,20); ?></span>
                                </div>
                                <div class="prices  wiconfine">
                                    <p class="sc_pri"><span>￥</span><span><?php echo $good[member_goods_price]; ?></span></p>
                                </div>
                                <div class="qxatten  wiconfine">
                                    <p class="weight"><span>数量</span>&nbsp;<span><?php echo $good[goods_num]; ?></span></p>
                                </div>
                                <div class="buttondde">
                                    <?php if(($list[return_btn] == 1) and ($list[shipping_status] == 0)): ?>
                                        <!--<a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$good['rec_id'])); ?>" style="color:#000">退款退货</a>-->
                                    <?php endif; if($good[is_send] > 1): ?>
                                        <a class="applyafts" style="color:#000">已退款退货</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="shop-rebuy-price p">
            <div class="maleri30">
                <span class="price-alln">
                    <!--<span class="red">￥<?php echo $list['order_amount']; ?></span><span class="threel">共<?php echo count($list['goods_list']); ?>件</span>-->
                    <span class="red"><!--￥<?php echo $list['order_amount']; ?>--></span><span class="threel" id="goodsnum">共<?php echo $list['count_goods_num']; ?>件</span>
                </span>
                <?php if($list['pay_btn'] == 1): ?>
                    <a class="shop-rebuy paysoon" href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$list['order_id'])); ?>">立即付款</a>
                <?php endif; if($list['cancel_btn'] == 1): ?>
                    <!--<a class="shop-rebuy " onClick="cancel_order(<?php echo $list['order_id']; ?>)">取消订单</a>-->
                <?php endif; if($list['receive_btn'] == 1): ?>
                    <a class="shop-rebuy paysoon" onclick="orderConfirm(<?php echo $list['order_id']; ?>)">确认收货</a>
                <?php endif; if($list['comment_btn'] == 1): ?>
                    <a class="shop-rebuy" href="<?php echo U('/Mobile/User/comment'); ?>">评价</a>
                <?php endif; if($list['shipping_btn'] == 1): ?>
                    <a class="shop-rebuy" class="shop-rebuy" href="<?php echo U('Mobile/User/express',array('order_id'=>$list['order_id'])); ?>">查看物流</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>

<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"./template/mobile/new2/distribut\rankings.html";i:1570438140;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>分销排行榜</title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/distribut/css/main.css"/>
		<script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
        <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body class="bag_gray3">
		<div class="ranking_tit">
			<img class="ran1" src="__STATIC__/images/liba.jpg"/>
			<img class="ran2" src="__STATIC__/images/topb.png"/>
			<i class="fla-f1"></i>
			<i class="fla-f2"></i>
			<i class="fla-f3"></i>
			<i class="flab"></i>
		</div>
		<div class="ranking_main">
			<div class="list2_rank">
				<a href="<?php echo U('mobile/Distribut/rankings',array('sort'=>'distribut_money')); ?>" <?php if(\think\Request::instance()->param('sort') == 'distribut_money'): ?>class="current" <?php endif; ?>>佣金排行</a>
				<a href="<?php echo U('mobile/Distribut/rankings',array('sort'=>'underling_number')); ?>" <?php if(\think\Request::instance()->param('sort') == 'underling_number'): ?>class="current" <?php endif; ?> >代理排行</a>
			</div>
			<div class="form_list">
				<div class="board_yellow_dark">
					<div class="board_yellow_light">
                        <div class="rank_alone p"  style="margin-top: 0.5rem;">
                            <div class="flo rank_data1">
                                <?php if($user['is_distribut'] ==  1): ?>
                                 <span><?php echo $place; ?></span>
                                <?php else: ?>
                                    <span>--</span>
                                <?php endif; ?>
                            </div>
                            <div class="flo rank_data2">
                                <div class="my_team_alon p">
                                    <div class="team_head">
                                        <img src="<?php echo (isset($user[head_pic]) && ($user[head_pic] !== '')?$user[head_pic]:"__STATIC__/distribut/images/user68.jpg"); ?>"/>
                                    </div>
                                    <div class="team_name_time">
                                        <span class="t_n"><?php echo $user[nickname]; ?></span>
                                        <?php if(\think\Request::instance()->param('sort') ==  'distribut_money'): ?>
                                            <span class="t_t">获得佣金：<em>￥<?php echo $user[distribut_money]; ?></em></span>
                                        <?php else: ?>
                                            <span class="t_t" style=" padding-top:3px;">推荐人数：<em><?php echo $user[underling_number]; ?></em>人</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="flo rank_data3"><a href="<?php echo U('Distribut/my_store'); ?>"><i class="icon-big_arrow_r"></i></a></div>-->
                        </div>
						<div class="board_green" id="rankings">
                            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $k=>$v): ?>
                                <div class="rank_alone p">
                                    <div class="flo rank_data1">
                                        <?php if($k < 3 and $firsRrow == 0): ?>
                                            <i class="fla-top<?php echo $k+1; ?>"></i>
                                        <?php else: ?>
                                            <span><?php echo $k+1; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flo rank_data2">
                                        <div class="my_team_alon p">
                                            <div class="team_head">
                                                <img src="<?php echo (isset($v[head_pic]) && ($v[head_pic] !== '')?$v[head_pic]:"__STATIC__/distribut/images/user68.jpg"); ?>"/>
                                            </div>
                                            <div class="team_name_time">
                                                <span class="t_n"><?php echo $v[nickname]; ?></span>
                                                <?php if(\think\Request::instance()->param('sort') ==  'distribut_money'): ?>
                                                    <span class="t_t">获得佣金：<em>￥<?php echo $v[distribut_money]; ?></em></span>
                                                <?php else: ?>
                                                    <span class="t_t" style=" padding-top:3px;">推荐人数：<em><?php echo $v[underling_number]; ?></em>人</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="flo rank_data3"><a href=""><i class="icon-big_arrow_r"></i></a></div>-->
                                </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
                        <?php if(!(empty($lists) || (($lists instanceof \think\Collection || $lists instanceof \think\Paginator ) && $lists->isEmpty()))): ?>
                            <p class="nextpage" onclick="ajax_sourch_submit(-1)">上一页</p>
                            <p class="nextpage" onclick="ajax_sourch_submit(1)">下一页</p>
                        <?php endif; ?>
					</div>
				</div>
			</div>
			<i class="fla-f1"></i>
		</div>
		<div class="ranking_foot">
			<img class="big_pocket" src="__STATIC__/distribut/images/pock_02.png"/>
			<img class="litt_mony" src="__STATIC__/distribut/images/pock_05.png"/>
		</div>
	</body>
<script>
    var  page = 1;
    /*** ajax 提交表单 查询订单列表结果*/
    // ajax 提交购物车
    var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
    function ajax_sourch_submit(p)
    {
        if(before_request == 0)// 上一次请求没回来 不进行下一次请求
            return false;
        before_request = 0;
        page += p;
        page = page<=0 ? 0 : page;
        $.ajax({
            type : "GET",
            url:"/index.php?m=Mobile&c=Distribut&a=rankings&order=<?php echo \think\Request::instance()->param('sort'); ?>&is_ajax=1&p="+page,//+tab,
            success: function(data)
            {
                if($.trim(data) == '')
                    $('#getmore').hide();
                else{
                    $("#rankings").html('');
                    $("#rankings").append(data);
                    $('#getmore').show();
                    before_request = 1;
                }
            }
        });
    }
</script>
</html>

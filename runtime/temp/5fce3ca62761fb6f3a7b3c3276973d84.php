<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"./template/mobile/new2/distribut\lower_list_20181126.html";i:1570438140;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的团队</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/distribut/css/main.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="bag_gray2">

<div class="retails_head">
		<div class="my_head" >
				<div class="head">
                    <img src="<?php echo (isset($user[head_pic]) && ($user[head_pic] !== '')?$user[head_pic]:"__STATIC__/images/user68.jpg"); ?>"/>
                </div>
				<div class="my_name_in fl" style="width:10rem;height:auto;">
                    <p class="my_name" style="height:auto;"><span style="float:left; font-size:0.8rem;">ID:<?php echo $user['user_id']; ?></span><span style="float:left; font-size:0.8rem;"  >〖<?php if($user[level] == 2): ?>公司会员<?php elseif($user[level] == 3): ?>公司经销商<?php elseif($user[level] == 4): ?>合伙创始人<?php else: ?>注册会员<?php endif; ?>〗</span></p>
                    <p class="my_name" style="height:auto;"><span style="float:left; font-size:0.8rem;"><?php echo $user['nickname']; ?></span></p>

					<p class="my_in"><?php echo $store['store_name']; ?></p>
				</div>
			</div>
			<!--<div class="my_share">
                <a href="<?php echo U('Distribut/set_store'); ?>"><i class="icon-setting"></i></a>
            </div>-->
      <p class="open_time">一级：<?php echo $mycount; ?>个</p>
  </div>
  

<?php if(!empty($lists)): ?>
    <div id="ajax_return">
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$v): ?>
            <div class="my_team_alon p" <?php if($v[second_leader] == 2): ?>style="padding-left:3rem;"<?php endif; ?> >
                <a href="javascript:void(0)"
                <?php if($v[yjnum] > 0): ?> onclick="getTargetLowerList(<?php echo $v[user_id]; ?>,'<?php echo $v[nickname]; ?>')"<?php endif; ?> >

                    <div class="team_head">
                        <img src="<?php echo (isset($v[head_pic]) && ($v[head_pic] !== '')?$v[head_pic]:"__STATIC__/images/hi.jpg"); ?>"/>
                    </div>
                    <div class="team_name_time">

                      <!-- edit by libo  -->
                       <span class="t_t" ><?php echo $v[nickname]; ?></span>
                        <span class="t_t" >ID: &nbsp;<?php echo $v[user_id]; ?></span>
                        <span class="t_t" >
                          〖<?php if($v[first_leader] == $dqyh): ?>一级
                            <?php elseif($v[second_leader] == $dqyh): ?>二级<?php else: ?>三级<?php endif; ?>&nbsp;推荐人数：<?php echo $v[yjnum]; ?>〗
                        </span>

                        <span class="t_t" >〖<?php if($v[level] == 2): ?>公司会员<?php elseif($v[level] == 3): ?>公司经销商<?php elseif($v[level] == 4): ?>合伙创始人<?php else: ?>注册会员<?php endif; ?>〗</span> 
                        <span class="t_t">消费总额：<?php echo $v[total_amount]; ?>元</span>
                        <span class="t_t">累计佣金：<?php echo $v[distribut_money]; ?>元</span>
                        <span class="t_t">加入时间：<?php echo date('Y-m-d',$v[reg_time]); ?></span>
                    </div>
                    <!-- ADD BY LISHIBO 2018/11/26 -->
                    <?php if($v[yjnum] > 0): ?>
                      <i class="icon-arrow_r" onclick="getTargetLowerList(<?php echo $v[user_id]; ?>,<?php echo $v[nickname]; ?>)"></i>
                    <?php endif; ?>
                    
                </a>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <p class="nextpage" id="getNext"  style="background-color: #f94f50;" onclick="ajax_next(1)">下一页</p>

<?php else: ?>
    <!--没有内容时-s-->
    <div class="comment_con p">
        <div style="padding:1rem;text-align: center;font-size: .59733rem;color: #777777;"><img src="__STATIC__/images/none.png"/><br /><br />亲，您还没有分销代理！</div>
    </div>
    <!--没有内容时-e-->
<?php endif; ?>
<script>
    //获取子级别分销关系
    var  _page = 1;
    //允许查看的级别
    var _level = 1;
    function getTargetLowerList(param1,param2){

       $.ajax({
            type : "GET",
            url:"/index.php?m=Mobile&c=Distribut&a=getTargetLowerList_20181126&is_ajax=1&p="+_page+"&targetID="+param1+"&targetName="+param2,//+tab,
            success: function(data)
            {
                if($.trim(data) == ''){
                    $('#targetName').hide();
                    $('#getNext').hide();
                }else{
                    $("#ajax_return").html("");
                    $("#ajax_return").append(data);
                    $('#getNext').hide();
                    $('#targetName').show();
                    
                }
            }
        });
    }

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
            url:"/index.php?m=Mobile&c=Distribut&a=lower_list_20181126&is_ajax=1&p="+page,//+tab,
            success: function(data)
            {
                if($.trim(data) == ''){
                    $('#getNext').css("background-color","lightgrey");
                    $('#getNext').text("没有更多数据");
                    $('#getNext').attr("disabled",true);
                }else{
                    $("#ajax_return").append(data);
                    $('#getNext').show();
                    before_request = 1;
                }
            }
        });
    }


</script>

</body>
</html>

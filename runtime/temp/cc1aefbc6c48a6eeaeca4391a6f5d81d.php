<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"./template/mobile/new2/distribut\ajax_lower_list_20181127.html";i:1570438140;}*/ ?>
  <!-- 子级动态展示 lishibo 2018/11/26-->
  <div id="targetName" style="background-color: #fade7e; width: 100%;  height: 1.3rem;line-height: 1.3rem;
  color:rgb(236, 70, 4);font-weight: 700;display: none;   "> &nbsp;&nbsp; 公司会员【<?php echo $targetName; ?>】代理关系：</div>
 
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$v): ?>
  <div class="my_team_alon p" <?php if($v[second_leader] == 2): ?>style="padding-left:3rem;"<?php endif; ?> >
    <a href="javascript:void(0)">

          <div class="team_head">
              <img src="<?php echo (isset($v[head_pic]) && ($v[head_pic] !== '')?$v[head_pic]:"__STATIC__/images/hi.jpg"); ?>"/>
          </div>
          <div class="team_name_time">

            <!-- edit by libo  -->
             <span class="t_t" ><?php echo $v[nickname]; ?></span>
              <span class="t_t" >ID: &nbsp;<?php echo $v[user_id]; ?></span>
              <span class="t_t" >
                〖<?php if($v[first_leader] == $dqyh): ?>一级
                  <?php elseif($v[second_leader] == $dqyh): ?>二级<?php else: ?>三级<?php endif; ?> &nbsp;推荐人数：<?php echo $v[yjnum]; ?>〗
              </span>

              <span class="t_t" >〖<?php if($v[level] == 2): ?>公司会员<?php elseif($v[level] == 3): ?>公司经销商<?php elseif($v[level] == 4): ?>合伙创始人<?php else: ?>注册会员<?php endif; ?>〗</span> 
              <span class="t_t">消费总额：<?php echo $v[total_amount]; ?>元</span>
              <span class="t_t">累计佣金：<?php echo $v[distribut_money]; ?>元</span>
              <span class="t_t">加入时间：<?php echo date('Y-m-d',$v[reg_time]); ?></span>
          </div>
          
           <!-- ADD BY LISHIBO 2018/11/26 -->
           <!-- 客户不可以查看三级代理 故不展示
           <?php if($v[yjnum] > 0): ?>
              <i class="icon-arrow_r" onclick="getTargetLowerList(<?php echo $v[user_id]; ?>,<?php echo $v[nickname]; ?>)"></i>
            <?php endif; ?>
             -->
      </a>
  </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
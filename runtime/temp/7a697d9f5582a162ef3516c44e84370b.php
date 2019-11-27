<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"./application/admin/view2/user\ajaxindex.html";i:1571984324;}*/ ?>
<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
    <table>
        <tbody>
        <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <tr data-id="<?php echo $list['user_id']; ?>">
                <td class="sign">
                    <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 40px;"><?php echo $list['user_id']; ?></div>
                </td>
                 
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['nickname']; ?></div>
                </td>
                <td align="center" class="">
                    <div style="text-align: center; width: 280px; max-width:280px;">
                        <a class="btn blue" href="<?php echo U('Admin/user/detail',array('id'=>$list['user_id'])); ?>"><i class="fa fa-pencil-square-o"></i>详情</a>
                        <a class="btn blue" href="<?php echo U('Admin/user/account_log',array('id'=>$list['user_id'])); ?>"><i class="fa fa-search"></i>资金</a>
                        <a class="btn blue" href="<?php echo U('Admin/user/address',array('id'=>$list['user_id'])); ?>"><i class="fa fa-steam"></i>收货地址</a>
                        <a class="btn red"  href="javascript:void(0)" data-id="<?php echo $list['user_id']; ?>"  data-url="<?php echo U('Admin/user/ajax_delete'); ?>" onClick="delfun(this)"><i class="fa fa-trash-o"></i>删除</a>
                    </div>
                </td>
                
                <td align="left" class="" >
                    <div style="text-align: center; width: 280px;">
                    <?php echo $level[$list[level]]; ?> 
                    &nbsp;<?php 
                        $province_id = $list['province'];
                        $city_id = $list['city'];
                        $district_id = $list['district'];
                        $ppname = M('region')->where(array('id' => $province_id))->value('name');
                        $ccname = M('region')->where(array('id' => $city_id))->value('name');
                        $ddname = M('region')->where(array('id' => $district_id))->value('name');

                    	if ( $list['dljb'] == 3 ) {
                        	echo '区域经理';
                           // echo ' ' .$ppname . ' ' .$ccname . ' ' .$ddname ;
                        }
//                    	if ( $list['dljb'] == 8 ) {
//                        	echo '区县代理';
//                            echo ' ' .$ppname . ' ' .$ccname . ' ' .$ddname ;
//                        }
//                    	if ( $list['dljb'] == 9 ) {
//                        	echo '市级代理';
//                            echo ' ' .$ppname . ' ' .$ccname . ' ' .$ddname ;
//                        }
//                    	if ( $list['dljb'] == 10 ) {
//                        	echo '省级代理';
//                            echo ' ' .$ppname . ' ' .$ccname . ' ' .$ddname ;
//                        }
                     ?>
                    </div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['total_amount']; ?></div>
                </td>
                <!--<td align="left" class="">
                    <div style="text-align: center; width: 150px;"><?php echo $list['email']; if(($list['email_validated'] == 0) AND ($list['email'])): ?>
                            (未验证)
                        <?php endif; ?>
                    </div>
                </td>-->
                <td align="left" class="">
                    
                    <div style="text-align: center; width: 80px;">
                    <?php echo (isset($first_leader[$list[user_id]]['count']) && ($first_leader[$list[user_id]]['count'] !== '')?$first_leader[$list[user_id]]['count']:"0"); ?>&nbsp; <?php if($first_leader[$list[user_id]]['count']): 
                        $myusers = M('Users')->where(array('first_leader' => $list['user_id']))->field("user_id,nickname")->select();
                        $res = '';
                        foreach($myusers as $k=>$val){ 
                            if ( $val == "" ) {
                                continue;
                            }
                            $res = 'ID：'.$val['user_id'] .' 昵称：' .$val['nickname'] .'\r\n'.$res ;
                        }
                     ?>                    
                    <a class="btn blue" href="javascript:void(0)" onclick="alert('\t<?php echo $res; ?>\t\n');return false;" ><i class="fa fa-pencil-square-o"></i>查看</a>
                    <?php endif; ?>
                    </div>
                </td>
                <!--<td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo (isset($second_leader[$list[user_id]]['count']) && ($second_leader[$list[user_id]]['count'] !== '')?$second_leader[$list[user_id]]['count']:"0"); ?></div>
                </td>-->
                <!--<td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo (isset($third_leader[$list[user_id]]['count']) && ($third_leader[$list[user_id]]['count'] !== '')?$third_leader[$list[user_id]]['count']:"0"); ?></div>
                </td>-->
                
               
                
                <td align="left" class="">
                    <div style="text-align: center; width: 100px;"><?php echo $list['user_money']; ?></div>
                </td>
				<td align="left" class="">
                    <div style="text-align: center; width: 100px;"><?php echo (isset($list['distribut_money']) && ($list['distribut_money'] !== '')?$list['distribut_money']:"0.00"); ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 100px;"><?php echo (isset($list['frozen_money']) && ($list['frozen_money'] !== '')?$list['frozen_money']:"0.00"); ?></div>
                </td>
                
                <td align="left" class="">
                    <div style="text-align: center; width: 150px;"><?php echo $list['mobile']; if(($list['mobile_validated'] == 0) AND ($list['mobile'])): ?>
                            (未验证)
                        <?php endif; ?>
                    </div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i',$list['reg_time']); ?></div>
                </td>
                
                <td align="" class="" style="width: 100%;">
                    <div>&nbsp;</div>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<!--分页位置-->
<?php echo $page; ?>
<script>
    $(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid >table>tbody>tr').click(function(){
            $(this).toggleClass('trSelected');
        });
        $('#user_count').empty().html("<?php echo $pager->totalRows; ?>");
    });
    function delfun(obj) {
        // 删除按钮
        layer.confirm('确认删除？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.ajax({
                type: 'post',
                url: $(obj).attr('data-url'),
                data: {id : $(obj).attr('data-id')},
                dataType: 'json',
                success: function (data) {
                    layer.closeAll();
                    if (data.status == 1) {
                        $(obj).parent().parent().parent().remove();
                    } else {
                        layer.alert(data.msg, {icon: 2});
                    }
                }
            })
        }, function () {
        });
    }
</script>
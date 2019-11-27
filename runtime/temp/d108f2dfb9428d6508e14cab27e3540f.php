<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./application/admin/view2/order\index.html";i:1572403948;s:44:"./application/admin/view2/public\layout.html";i:1524293403;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
						layer.closeAll();
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['70%', '80%'],
            content: $(obj).attr('data-url'), 
        });
    }
    
    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
						layer.closeAll();
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);	
    }
</script>  

</head>
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商品订单</h3>
                <h5>商城实物商品交易订单查询及管理&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.kuaidi100.com/" target="_blank">快递100查询</a></h5>
            </div>
        </div>
    </div>
    <!-- 操作说明 -->
    <div id="explanation" class="explanation" style=" width: 99%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
            <li>查看操作可以查看订单详情, 包括支付费用, 商品详情等</li>
            <li>未支付的订单可以取消</li>
            <li>用户收货后, 如果没有点击"确认收货",系统自动根据设置的时间自动收货.</li>
        </ul>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>订单列表</h3>
                <h5>(共<?php echo $page->totalRows; ?>条记录)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline"  method="post" action="<?php echo U('Order/index'); ?>"  name="search-form2" id="search-form2">

                <input type="hidden" name="user_id" value="<?php echo \think\Request::instance()->param('user_id'); ?>">
                <!--选中得id -->
                <input type="hidden" name="order_ids" value="">
                <input type="hidden" name="p"  id="page" value="1">

                <!--用于查看结算统计 包含了哪些订单-->
                <input type="hidden" value="<?php echo $_GET['order_statis_id']; ?>" name="order_statis_id" />

                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="text" size="30" id="add_time_begin" name="add_time_begin" value="" class="qsbox"  placeholder="下单开始时间">
                    </div>
                    <div class="sDiv2">
                        <input type="text" size="30" id="add_time_end" name="add_time_end" value="" class="qsbox"  placeholder="下单结束时间">
                    </div>
                    <div class="sDiv2">
                        <select name="pay_status" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                            <option value="">支付状态</option>
                            <option value="0">未支付</option>
                            <option value="1">已支付</option>
                        </select>
                    </div>
                    <div class="sDiv2">
                        <select name="pay_name" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                            <option value="">支付方式</option>
                         <!--   <option value="alipay">支付宝支付</option>-->
                            <option value="微信支付">微信支付</option>
                            <option value="余额支付">余额支付</option>
                            <option value="货到付款">货到付款</option>
                        </select>
                    </div>
                    <div class="sDiv2">
                        <select name="shipping_status" class="select" style="width:100px;">
                            <option value="">发货状态</option>
                            <option value="0">未发货</option>
                            <option value="1">已发货</option>
                            <option value="2">部分发货</option>
                        </select>
                    </div>
                    <div class="sDiv2">
                        <select name="order_status" class="select" style="width:100px;">
                            <option value="">订单状态</option>
                            <?php if(is_array($order_status) || $order_status instanceof \think\Collection || $order_status instanceof \think\Paginator): $k = 0; $__LIST__ = $order_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                                <option value="<?php echo $k-1; ?>"><?php echo $v; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="sDiv2">
                        <select  name="keytype" class="select">
                            <option value="consignee">收货人</option>
                            <option value="order_sn">订单编号</option>
                            </foreach>
                        </select>
                    </div>
                    <div class="sDiv2">
                        <input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据...">
                    </div>
                    <div class="sDiv2">
                        <input type="submit"  class="btn" value="搜索">
                    </div>
                </div>
            </form>
        </div>

        <!--thead-->
        <div class="hDiv">
            <div class="hDivBox" id="ajax_return">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="sign" axis="col0">
                            <div style="width: 50px;"><i class="ico-check"></i></div>
                        </th>
                        <th align="center" axis="col1" class="handle">
                            <div style="text-align: left; width: 50px;">操作</div>
                        </th>
                        <th align="left" abbr="order_sn" axis="col3" class="">
                            <div style="text-align: center; width: 180px;" class="">订单编号</div>
                        </th>
                        <th align="left" abbr="consignee" axis="col4" class="">
                            <div style="text-align: center; width: 180px;" class="">收货人</div>
                        </th>
                        <th align="center" abbr="article_show" axis="col5" class="">
                            <div style="text-align: center; width: 60px;" class="">总金额</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 60px;" class="">应付金额</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 60px;" class="">订单状态</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 90px;" class="">支付状态</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 90px;" class="">发货状态</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 90px;" class="">支付方式</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 90px;" class="">配送方式</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 150px;" class="">下单时间</div>
                        </th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--操作-->
        <div class="tDiv">
            <div class="tDiv2">
                <div class="fbutton">
                    <a href="javascript:exportReport()">
                        <div class="add" title="选定行数据导出excel文件,如果不选中行，将导出列表所有数据">
                            <span><i class="fa fa-plus"></i>导出数据</span>
                        </div>
                    </a>
                </div>
                <div class="fbutton">
                    <a href="/index.php?m=Admin&c=Order&a=add_order">
                        <div class="add" title="添加订单">
                            <span><i class="fa fa-plus"></i>添加订单</span>
                        </div>
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>

      <div class="bDiv" style="height: auto;">
          <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">

              <table>
                  <tbody>
                  <?php if(empty($orderList) == true): ?>
                      <tr data-id="0">
                          <td class="no-data" align="center" axis="col0" colspan="50">
                              <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                          </td>
                      </tr>
                  <?php else: if(is_array($orderList) || $orderList instanceof \think\Collection || $orderList instanceof \think\Paginator): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                          <tr data-order-id="<?php echo $list['order_id']; ?>">
                              <td class="sign" axis="col0">
                                  <div style="width: 50px;"><i class="ico-check"></i></div>
                              </td>
                              <td  axis="col1" class="handle" align="center">
                                  <div style="text-align: left; width: 50px;">
                                      <a class="btn green" href="<?php echo U('Admin/order/detail',array('order_id'=>$list['order_id'])); ?>"><i class="fa fa-list-alt"></i>查看[<?php echo $list['order_id']; ?>]</a>
                                      <?php if(($list['order_status'] == 3  and $list['pay_status'] == 0) or ($list['order_status'] == 5)): ?>
                                          <a class="btn red" href="javascript:void(0);" data-href="<?php echo U('Admin/order/delete_order',array('order_id'=>$list['order_id'])); ?>" onClick="del(this)"><i class="fa fa-trash-o"></i>删除</a>
                                      <?php endif; if(($list['order_status'] == 3  and $list['pay_status'] == 1)): ?>
                                          <a class="btn green" href="<?php echo U('Admin/order/detail',array('order_id'=>$list['order_id'])); ?>"><i class="fa fa-list-alt"></i>查看</a>
                                      <?php endif; ?>
                                  </div>
                              </td>
                              <td align="left" abbr="order_sn" axis="col3" class="">
                                  <div style="text-align: left; width: 180px;" class=""><?php echo $list['order_sn']; ?></div>
                              </td>

                              <td align="left" abbr="consignee" axis="col4" class="">
                                  <div style="text-align: left; width: 180px;" class=""><?php echo $list['consignee']; ?>:<?php echo $list['mobile']; ?></div>
                              </td>
                              <td align="center" abbr="article_show" axis="col5" class="">
                                  <div style="text-align: center; width: 60px;" class=""><?php echo $list['goods_price']; ?></div>
                              </td>
                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 60px;" class=""><?php echo $list['order_amount']; ?></div>
                              </td>

                              <td align="center" abbr="article_time" axis="col6" class="" >
                                  <div  style="text-align: center; width: 60px;
                                        <?php if($list[order_status] == 0): ?>color:#d0b200;
                                        <?php elseif($list[order_status] == 1): ?>color:#12793b;
                                        <?php elseif($list[order_status] == 2): ?>color:#00796f;
                                        <?php elseif($list[order_status] == 3): ?>color:#999999;
                                        <?php else: ?>color:#000000;
                                        <?php endif; ?> " >
                                      <?php echo $order_status[$list[order_status]]; ?></div>
                                      <?php if($list['is_cod'] == '1'): ?>
                                          <span style="color: red">(货到付款)</span>
                                      <?php endif; ?>

                             </td>

                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 90px;<?php if($pay_status[$list[pay_status]] == '已支付'): ?>color:red;<?php endif; ?>" class="" ><?php echo $pay_status[$list[pay_status]]; ?></div>
                              </td>

                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 90px;color:<?php if($list[shipping_status] == 0): ?>#d0b200;<?php elseif($list[shipping_status] == 1): ?>#0150a6;<?php elseif($list[shipping_status] == 2): ?>#00796f;<?php elseif($list[shipping_status] == 3): ?>#12793b;<?php else: ?>#000000;<?php endif; ?>" class=""   ><?php echo $shipping_status[$list[shipping_status]]; ?></div>
                                </td>
                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 90px;" class=""><?php echo (isset($list['pay_name']) && ($list['pay_name'] !== '')?$list['pay_name']:'其他方式'); ?></div>
                              </td>
                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 90px;" class=""><?php echo $list['shipping_name']; ?></div>
                              </td>
                              <td align="center" abbr="article_time" axis="col6" class="">
                                  <div style="text-align: center; width: 150px;" class=""><?php echo date('Y-m-d H:i',$list['add_time']); ?></div>
                              </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                  </tbody>
              </table>

            <div class="row">
                <div class="col-sm-6 text-left"></div>
                <div class="col-sm-6 text-right"><?php echo $page; ?></div>
            </div>

            <script>

                // 表格行点击选中切换
                $('#flexigrid > table>tbody >tr').click(function(){
                    $(this).toggleClass('trSelected');
                });

                /*处理分页条件*/
                $(".pagination  a").click(function(){
                    var page = $(this).data('p');
                    $("#page").val(page);
                    $('#search-form2').submit();
                });
                // 删除操作
                function del(obj) {
                    confirm('确定要删除吗?', function(){
                        location.href = $(obj).data('href');
                    });
                }
                $('.ftitle>h5').empty().html("(共<?php echo $pager->totalRows; ?>条记录)");
            </script>
          </div>

          <div class="iDiv" style="display: none;"></div>
      </div>

  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#add_time_begin').layDate();
        $('#add_time_end').layDate();
        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        $('.ico-check' , '.hDivBox').click(function(){
            $('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
                var hasClass = $(this).hasClass('trSelected');
                $('tr' , '#flexigrid').each(function(){
                    if(hasClass){
                        $(this).addClass('trSelected');
                    }else{
                        $(this).removeClass('trSelected');
                    }
                });
            });
        });
    });

    function exportReport(){
        var selected_ids = '';
        $('.trSelected' , '#flexigrid').each(function(i){
            selected_ids += $(this).data('order-id')+',';
        });
        if(selected_ids != ''){
            $('input[name="order_ids"]').val(selected_ids.substring(0,selected_ids.length-1));
        }
        var exportURL = "/index.php/Admin/order/export_order";
        var searchURL = "/index.php/Admin/order/index";
        $("#search-form2").attr('action',exportURL);
        $('#search-form2').submit();
        $("#search-form2").attr('action',searchURL);
    }

</script>

</body>
</html>
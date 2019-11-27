<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 聊城市饮久舒新时代科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 * 
 * TPshop 公共逻辑类  将放到Application\Common\Logic\   由于很多模块公用 将不在放到某个单独模下面
 */

namespace app\common\logic;

use think\Model;
//use think\Page;

/**
 * 分销逻辑层
 * Class CatsLogic
 * @package Home\Logic
 */
class DistributLogic //extends Model
{
     public function hello(){
        echo 'function hello(){'; 
     }
     
     /**
      * 生成分销记录
      */
     public function rebate_log($order)
     {      
        //$commission  = $order['total_amount'];
        $commission  = $order['goods_price'];
        $user = M('users')->where("user_id", $order['user_id'])->find();

        $first_money  = 0.00 ;
        $second_money = 0.00 ;

        if ( (int)$user['first_leader'] > 0  ) { //tjrfy

            update_user_level($user['first_leader']);
            $user1 = M('users')->where("user_id", $user['first_leader'])->find();

            if ( (int)$user1['level']>1 && $commission >= 2000 ) {
                $tjrfy = M('user_level')->where('level_id',$user1['level'])->getField("tjrfy");
                $first_money = ($commission - 2000)*0.05 + 2000 * ($tjrfy / 100); // 首购
            }
            $user2 = M('users')->where("user_id", $user['first_leader'])->find();
            $shichangweihufei = M('user_level')->where('level_id',$user2['level'])->getField("shichangweihufei");
            $mycount = M('order')->where( "user_id =".$order['user_id']." AND pay_status=1 and order_status not in (3,5) and  `order_amount` + `user_money`  >= 1 ")->count();
            if (  (int)$user2['level']>1 && $mycount >= 2 &&  $user['level'] >= 1  )  {
                $second_money = $commission * ($shichangweihufei / 100); // 复购
            }
        }


        //  微信消息推送
        $wx_user = M('wx_user')->find();
        $jssdk = new \app\mobile\logic\Jssdk($wx_user['appid'],$wx_user['appsecret']);


         if( $first_money > 0.01 &&  (int)$user1['level']>1 && $commission >= 2000 &&  (int)$user['level'] == 1  )
         {

            $myidA = M('rebate_log')->where( " order_id = ".$order['order_id']." and jxmc LIKE '%首次购货%' " )->find();
            if ( (int)$myidA['id'] > 0 ) {
                M('rebate_log')->where("id", $myidA)->save(array("status"=>3));
            }  else {
                $dataA = array(


                    'user_id' =>$user['first_leader'],
                    'buy_user_id' => $user['user_id'],
                    'nickname' => $user['nickname'],
                    'order_sn' => $order['order_sn'],
                    'order_id' => $order['order_id'],
                    'goods_price' => $order['goods_price'],
                    'money' => $first_money,
                    'level' => 1,
                    'create_time' => time(),
                    'jxmc'  => '[推荐奖励]首次购货',
                    'confirm_time'  => time(),
                    'remark'  => '自动分成A',
                    'status'  => 3
                );
                 M('rebate_log')->add($dataA);

            }

            // 微信推送消息
            if($user1['oauth']== 'weixin')
            {
                $wx_content = "[推荐奖励]首次购货：恭喜您，您的一度人脉刚刚下单，您获得 ￥".$first_money." 元奖励！";
                $jssdk->push_msg($user1['openid'],$wx_content);
            }

            $my_log_idA = M('account_log')->where( " user_id = ". $user['first_leader'] ." and user_money = ".$first_money." and order_id = ".$order['order_id']." and `desc` = '首次购货' " )->find();
            if ( (int)$my_log_idA['log_id'] > 0 ) {
            } else {

//					$vala['user_money'] = $user1['user_money'] + $first_money;
//				    M("users")->where("user_id", $user['first_leader'])->save($vala);
//					
//					$data1['user_id'] = $user['first_leader'];
//					$data1['user_money'] = $first_money;
//					$data1['pay_points'] = 0;
//					$data1['change_time'] = time();
//					$data1['desc'] = '首次购货';
//					$data1['order_sn'] = $order['order_sn'];
//					$data1['order_id'] = $order['order_id'];
//					// 如果使用了积分或者余额才记录
//					M('account_log')->add($data1);
                accountLog($user['first_leader'], $first_money, 0, "首次购货", $first_money , $order['order_id'],$order['order_sn']);
            }



         }
          // 二次复购 分销商赚 的钱.
         if(  $second_money > 0.01 &&  (int)$user2['level']>1 && $commission >= 2000 && (int)$user['level'] > 1  )
         {

            $myidB = M('rebate_log')->where( " order_id = ".$order['order_id']." and jxmc LIKE '%二次复购%' " )->find();
            if ( (int)$myidB['id'] > 0 ) {
                M('rebate_log')->where("id", $myidB)->save(array("status"=>3));
            }  else {
                $dataB = array(
                    'user_id' =>$user['first_leader'],
                    'buy_user_id'=>$user['user_id'],
                    'nickname'=>$user['nickname'],
                    'order_sn' => $order['order_sn'],
                    'order_id' => $order['order_id'],
                    'goods_price' => $order['goods_price'],
                    'money' => $second_money,
                    'level' => 1,
                    'create_time' => time(),
                    'jxmc'  => '[推荐奖励]二次复购',
                    'confirm_time'  => time(),
                    'remark'  => '自动分成B',
                    'status'  => 3,

                );
                M('rebate_log')->add($dataB);
            }

            // 微信推送消息

            if($user2['oauth']== 'weixin')
            {
                $wx_content = "[推荐奖励]二次复购：恭喜您，您的一度人脉刚刚下单，您获得 ￥".$second_money." 元奖励！";
                $jssdk->push_msg($user2['openid'],$wx_content);
            }


            $my_log_idB = M('account_log')->where( " user_id = ". $user['first_leader'] ." and user_money = ".$second_money." and order_id = ".$order['order_id']." and `desc` = '二次复购' " )->find();
            if ( (int)$my_log_idB['log_id'] > 0 ) {
            } else {
//					$valb['user_money'] = $user2['user_money'] + $second_money;
//					M("users")->where("user_id", $user['first_leader'])->save($valb);
//					
//					$data2['user_id'] = $user['first_leader'];
//					$data2['user_money'] = $second_money;
//					$data2['pay_points'] = 0;
//					$data2['change_time'] = time();
//					$data2['desc'] = '二次复购';
//					$data2['order_sn'] = $order['order_sn'];
//					$data2['order_id'] = $order['order_id'];
//					// 如果使用了积分或者余额才记录
//					M('account_log')->add($data2);
                accountLog($user['first_leader'], $second_money, 0, "二次复购", $second_money , $order['order_id'],$order['order_sn']);
            }


         }



         $regionuid = M('region')->where(array('id' => (int)$order['district']))->value('uid');
         if( (int)$regionuid > 0 )
         {
             $user3 = M('users')->where("user_id", $regionuid )->find();
             $lingdaojiang = M('user_level')->where('level_id',$user3['level'])->getField("lingdaojiang");
             //$qyjl_money = $commission * ($lingdaojiang / 100); // 一级赚到的钱
             $qyjl_money = 200 ;

             if ( ( $qyjl_money > 0.01 ) &&  ( (int)$user3['level'] > 1 ) && ( $commission >= 2000 ) && ( (int)$user['level'] == 1 ) )
             {
                    $myidC = M('rebate_log')->where( " order_id = ".$order['order_id']." and jxmc LIKE '%管理服务费%' " )->find();
                    if ( (int)$myidC['id'] > 0 ) {
                        M('rebate_log')->where("id", $myidC)->save(array("status"=>3));
                    }  else {
                        $dataC = array(
                            'user_id' =>$regionuid,
                            'buy_user_id'=>$user['user_id'],
                            'nickname'=>$user['nickname'],
                            'order_sn' => $order['order_sn'],
                            'order_id' => $order['order_id'],
                            'goods_price' => $order['goods_price'],
                            'money' => $qyjl_money,
                            'level' => -1,
                            'create_time' => time(),
                            'jxmc'  => '[区域奖励]管理服务费',
                            'confirm_time'  => time(),
                            'remark'  => '自动分成C',
                            'status'  => 3,
                        );
                        M('rebate_log')->add($dataC);
                    }


                    // 微信推送消息
                    $tmp_user = M('users')->where("user_id", $regionuid)->find();
                    if($tmp_user['oauth']== 'weixin')
                    {
                        $wx_content = "[区域奖励]管理服务费：恭喜您，您所管理的区域内新增订单，您获得 ￥".$qyjl_money."奖励 !";
                        $jssdk->push_msg($tmp_user['openid'],$wx_content);
                    }


                    $my_log_idC = M('account_log')->where( " user_id = ". $regionuid ." and user_money = ".$qyjl_money." and order_id = ".$order['order_id']." and `desc` = '区域奖励' " )->find();
                    if ( (int)$my_log_idC['log_id'] > 0 ) {
                    } else {

//							$valc['user_money'] = $user3['user_money'] + $qyjl_money;
//							M("users")->where("user_id", $regionuid)->save($valc);
//							
//							$data3['user_id'] = $regionuid;
//							$data3['user_money'] = $qyjl_money;
//							$data3['pay_points'] = 0;
//							$data3['change_time'] = time();
//							$data3['desc'] = '区域奖励';
//							$data3['order_sn'] = $order['order_sn'];
//							$data3['order_id'] = $order['order_id'];
//							M('account_log')->add($data3);
                        accountLog($regionuid, $qyjl_money, 0, "区域奖励", $qyjl_money , $order['order_id'],$order['order_sn']);
                    }



             }

         }
        //添加分销项 每一个会员下单，则均分100元给所有会员
        $user_ids = M('users')->where("level", array('IN','2,3,4,5'))->select();;//获取所有会员用户
         if(!(count($user_ids)>10000)){
             //如果大于10000人暂时不分了 每人一分钱 不值当的。
             //获取100平分金额 金额扩大100倍，避免小数的精度缺失,向下取整
             $average_money = floor(10000 / count($user_ids))/100;
             foreach ($user_ids as $key=>$val){
                 $data['user_money'] = $val['user_id']+$average_money;
                 $rebate_data = array(
                     'user_id' =>$val['user_id'],
                     'buy_user_id'=>$user['user_id'],
                     'nickname'=>$user['nickname'],
                     'order_sn' => $order['order_sn'],
                     'order_id' => $order['order_id'],
                     'goods_price' => $order['goods_price'],
                     'money' => $average_money,
                     'level' => -1,
                     'create_time' => time(),
                     'jxmc'  => '[购单奖励]其他会员购单奖励',
                     'confirm_time'  => time(),
                     'remark'  => '购单奖励',
                     'status'  => 3,
                 ); 
                 M('rebate_log')->add($rebate_data);
                 $row = M('users')->where(array('user_id'=>$val['user_id']))->save($data);
                 accountLog($val['user_id'], $average_money, 0, "其他会员购单分成", $average_money , $order['order_id'],$order['order_sn']);
             }
         }


        M('order')->where("order_id", $order['order_id'])->save(array("is_distribut"=>1));  //修改订单为已经分成
     }
     
     /**
      * 自动分成 符合条件的 分成记录
      */
     function auto_confirm(){
         
         $switch = tpCache('distribut.switch');
         if($switch == 0)
             return false;
         
         $today_time = time();
         $distribut_date = tpCache('distribut.date');
         $distribut_time = $distribut_date * (60 * 60 * 24); // 计算天数 时间戳
         $rebate_log_arr = M('rebate_log')->where("status = 2 and ($today_time - confirm) >  $distribut_time")->select();
         foreach ($rebate_log_arr as $key => $val)
         {
             accountLog($val['user_id'], $val['money'], 0,"订单:{$val['order_sn']}分佣",$val['money']);             
             $val['status'] = 3;
             $val['confirm_time'] = $today_time;
             $val['remark'] = $val['remark']."满{$distribut_date}天,程序自动分成.";
             M("rebate_log")->where("id", $val['id'])->save($val);
			 
			    $distribut_money = M('rebate_log')->where(['user_id'=>$val['user_id'],'status'=>3])->sum('money');  //累计获得佣金
				if ( $distribut_money > 0  ) { 
					$data1['distribut_money'] = $distribut_money;
					$row = M('users')->where(array('user_id'=>$val['user_id']))->save($data1);
				}
         }
		 
     }
}
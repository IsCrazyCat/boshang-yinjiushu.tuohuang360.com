<?php

/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 山东博商网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.boshang3710.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Date: 2015-09-14
 */


namespace app\admin\logic;

use think\Model;
use think\Db;
class OrderLogic extends Model
{
    /**
     * @param array $condition  搜索条件
     * @param string $order   排序方式
     * @param int $start    limit开始行
     * @param int $page_size  获取数量
     */
    public function getOrderList($condition,$order='',$start=0,$page_size=20){
        $res = M('order')->where($condition)->limit("$start,$page_size")->order($order)->select();
        return $res;
    }

    /**
     * 获取订单商品详情  2017-4-28 lxl 改
     * @param $order_id
     * @param string $is_send
     * @return mixed
     */
    public function getOrderGoods($order_id,$is_send =''){
        if($is_send){
            $where=" and o.is_send < $is_send";
        }
        $sql = "SELECT g.*,o.*,(o.goods_num * o.member_goods_price) AS goods_total FROM __PREFIX__order_goods o ".
            "LEFT JOIN __PREFIX__goods g ON o.goods_id = g.goods_id WHERE o.order_id = $order_id ".$where;
        $res = DB::query($sql);
        return $res;
    }


    /*
     * 获取订单信息
     */
    public function getOrderInfo($order_id)
    {
        //  订单总金额查询语句		
        $order = M('order')->where("order_id = $order_id")->find();
        $order['address2'] = $this->getAddressName($order['province'],$order['city'],$order['district']);
        $order['address2'] = $order['address2'].$order['address'];		
        return $order;
    }

    /*
     * 根据商品型号获取商品
     */
    public function get_spec_goods($goods_id_arr){
    	if(!is_array($goods_id_arr)) return false;
    		foreach($goods_id_arr as $key => $val)
    		{
    			$arr = array();
    			$goods = M('goods')->where("goods_id = $key")->find();
    			$arr['goods_id'] = $key; // 商品id
    			$arr['goods_name'] = $goods['goods_name'];
    			$arr['goods_sn'] = $goods['goods_sn'];
    			$arr['market_price'] = $goods['market_price'];
    			$arr['goods_price'] = $goods['shop_price'];
    			$arr['cost_price'] = $goods['cost_price'];
    			$arr['member_goods_price'] = $goods['shop_price'];
    			foreach($val as $k => $v)
    			{
    				$arr['goods_num'] = $v['goods_num']; // 购买数量
    				// 如果这商品有规格
    				if($k != 'key')
    				{
    					$arr['spec_key'] = $k;
    					$spec_goods = M('spec_goods_price')->where("goods_id = $key and `key` = '{$k}'")->find();
    					$arr['spec_key_name'] = $spec_goods['key_name'];
    					$arr['member_goods_price'] = $arr['goods_price'] = $spec_goods['price'];
    					$arr['sku'] = $spec_goods['sku']; // 参考 sku  http://www.zhihu.com/question/19841574
    				}
    				$order_goods[] = $arr;
    			}
    		}
    		return $order_goods;	
    }

    /*
     * 订单操作记录
     */
    public function orderActionLog($order_id,$action,$note=''){    	
        $order = M('order')->where(array('order_id'=>$order_id))->find();
        $data['order_id'] = $order_id;
        $data['action_user'] = session('admin_id');
        $data['action_note'] = $note;
        $data['order_status'] = $order['order_status'];
        $data['pay_status'] = $order['pay_status'];
        $data['shipping_status'] = $order['shipping_status'];
        $data['log_time'] = time();
        $data['status_desc'] = $action;        
        return M('order_action')->add($data);//订单操作记录
    }

    /*
     * 获取订单商品总价格
     */
    public function getGoodsAmount($order_id){
        $sql = "SELECT SUM(goods_num * goods_price) AS goods_amount FROM __PREFIX__order_goods WHERE order_id = {$order_id}";
        $res = DB::query($sql);
        return $res[0]['goods_amount'];
    }

    /**
     * 得到发货单流水号
     */
    public function get_delivery_sn()
    {
//        /* 选择一个随机的方案 */send_http_status('310');
		mt_srand((double) microtime() * 1000000);
        return date('YmdHi') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    /*
     * 获取当前可操作的按钮
     */
    public function getOrderButton($order){
        /*
         *  操作按钮汇总 ：付款、设为未付款、确认、取消确认、无效、去发货、确认收货、申请退货
         * 
         */
    	$os = $order['order_status'];//订单状态
    	$ss = $order['shipping_status'];//发货状态
    	$ps = $order['pay_status'];//支付状态
        $btn = array();
        if($order['pay_code'] == 'cod') {
        	if($os == 0 && $ss == 0){
        		$btn['confirm'] = '确认';
        	}elseif($os == 1 && ($ss == 0 || $ss == 2)){
        		$btn['delivery'] = '去发货';
        		$btn['cancel'] = '取消确认';
        	}elseif($ss == 1 && $os == 1 && $ps == 0){
        		$btn['pay'] = '付款';
        	}elseif($ps == 1 && $ss == 1 && $os == 1){
        		$btn['pay_cancel'] = '设为未付款';
        	}
        }else{
        	if($ps == 0 && $os == 0 || $ps == 2){
        		$btn['pay'] = '付款';
        	}elseif($os == 0 && $ps == 1){
        		$btn['pay_cancel'] = '设为未付款';
        		$btn['confirm'] = '确认';
        	}elseif($os == 1 && $ps == 1 && ($ss == 0 || $ss == 2)){
        		$btn['cancel'] = '取消确认';
        		$btn['delivery'] = '去发货';
        	}
        } 
               
        if($ss == 1 && $os == 1 && $ps == 1){
//        	$btn['delivery_confirm'] = '确认收货';
        	$btn['refund'] = '申请退货';
        }elseif($os == 2 || $os == 4){
        	$btn['refund'] = '申请退货';
        }elseif($os == 3 || $os == 5){
        	$btn['remove'] = '移除';
        }
        if($os != 5){
        	$btn['invalid'] = '无效';
        }
        return $btn;
    }

    
    public function orderProcessHandle($order_id,$act,$ext=array()){
    	$updata = array();
    	switch ($act){
    		case 'pay': //付款
               	$order_sn = M('order')->where("order_id = $order_id")->getField("order_sn");
                update_pay_status($order_sn,$ext); // 调用确认收货按钮
    			return true;    			
    		case 'pay_cancel': //取消付款
    			$updata['pay_status'] = 0;
    			$this->order_pay_cancel($order_id);
    			return true;
    		case 'confirm': //确认订单
    			$updata['order_status'] = 1;
    			break;
    		case 'cancel': //取消确认
    			$updata['order_status'] = 0;
    			break;
    		case 'invalid': //作废订单
    			$updata['order_status'] = 5;
    			break;
    		case 'remove': //移除订单
    			$this->delOrder($order_id);
    			break;
    		case 'delivery_confirm'://确认收货
    			confirm_order($order_id); // 调用确认收货按钮
    			return true;
    		default:
    			return true;
    	}
    	return M('order')->where("order_id=$order_id")->save($updata);//改变订单状态
    }
    
    
    //管理员取消付款
    function order_pay_cancel($order_id)
    {
    	//如果这笔订单已经取消付款过了
    	$count = M('order')->where("order_id = $order_id and pay_status = 1")->count();   // 看看有没已经处理过这笔订单  支付宝返回不重复处理操作
    	if($count == 0) return false;
    	// 找出对应的订单
    	$order = M('order')->where("order_id = $order_id")->find();
    	// 增加对应商品的库存
        $orderGoodsArr = M('OrderGoods')->where("order_id = $order_id")->select();
    	foreach($orderGoodsArr as $key => $val)
    	{
    		if(!empty($val['spec_key']))// 有选择规格的商品
    		{   // 先到规格表里面增加数量 再重新刷新一个 这件商品的总数量
    			M('SpecGoodsPrice')->where("goods_id = {$val['goods_id']} and `key` = '{$val['spec_key']}'")->setInc('store_count',$val['goods_num']);
    			refresh_stock($val['goods_id']);
    		}else{
    			M('Goods')->where("goods_id = {$val['goods_id']}")->setInc('store_count',$val['goods_num']); // 增加商品总数量
    		}
    		M('Goods')->where("goods_id = {$val['goods_id']}")->setDec('sales_sum',$val['goods_num']); // 减少商品销售量
    		//更新活动商品购买量
    		if($val['prom_type']==1 || $val['prom_type']==2){
    			$prom = get_goods_promotion($val['goods_id']);
    			if($prom['is_end']==0){
    				$tb = $val['prom_type']==1 ? 'flash_sale' : 'group_buy';
    				M($tb)->where("id=".$val['prom_id'])->setDec('buy_num',$val['goods_num']);
    				M($tb)->where("id=".$val['prom_id'])->setDec('order_num');
    			}
    		}
    	}
    	// 根据order表查看消费记录 给他会员等级升级 修改他的折扣 和 总金额
    	M('order')->where("order_id=$order_id")->save(array('pay_status'=>0));
    	update_user_level($order['user_id']);
		
//		$myuser = M('users')->where("user_id", $order['user_id'])->find();//李洪顺
//		$first_leader = $myuser['first_leader'];
//		if ( (int)$first_leader > 0 ) {
//			update_user_level($first_leader);
//		}
//		$second_leader = $myuser['second_leader'];
//		if ( (int)$second_leader > 0 ) {
//			update_user_level($second_leader);
//		}
//		$third_leader = $myuser['third_leader'];
//		if ( (int)$third_leader > 0 ) {
//			update_user_level($third_leader);
//		}

		
		
    	// 记录订单操作日志
    	logOrder($order['order_id'],'订单取消付款','付款取消',$order['user_id']);
    	//分销设置
    	M('rebate_log')->where("order_id = {$order['order_id']}")->save(array('status'=>0));
    }
    
    /**
     *	处理发货单
     * @param array $data  查询数量
     */
    public function deliveryHandle($data){

		$order = $this->getOrderInfo($data['order_id']);
		$orderGoods = $this->getOrderGoods($data['order_id']);
		$selectgoods = $data['goods'];
		$data['order_sn'] = $order['order_sn'];
		$data['delivery_sn'] = $this->get_delivery_sn();
		$data['zipcode'] = $order['zipcode'];
		$data['user_id'] = $order['user_id'];
		$data['admin_id'] = session('admin_id');
		$data['consignee'] = $order['consignee'];
		$data['mobile'] = $order['mobile'];
		$data['country'] = $order['country'];
		$data['province'] = $order['province'];
		$data['city'] = $order['city'];
		$data['district'] = $order['district'];
		$data['address'] = $order['address'];
        $shipping = M('Plugin')->where("code", $data['shipping_code'])->cache(true,TPSHOP_CACHE_TIME)->find();
		$data['shipping_name'] = $shipping['name'];
		$data['shipping_price'] = $order['shipping_price'];
		$data['create_time'] = time();
		$did = M('delivery_doc')->add($data);
		$is_delivery = 0;
		foreach ($orderGoods as $k=>$v){
			if($v['is_send'] >= 1){
				$is_delivery++;
			}			
			if($v['is_send'] == 0 && in_array($v['rec_id'],$selectgoods)){
				$res['is_send'] = 1;
				$res['delivery_id'] = $did;
				$r = M('order_goods')->where("rec_id=".$v['rec_id'])->save($res);//改变订单商品发货状态
				$is_delivery++;
			}
		}
		$updata['shipping_time'] = time();
		if($is_delivery == count($orderGoods)){
			$updata['shipping_status'] = 1;
		}else{
			$updata['shipping_status'] = 2;
		}
        $updata['shipping_code'] = $data['shipping_code'];
        $updata['shipping_name'] = $data['shipping_name'];
		M('order')->where("order_id=".$data['order_id'])->save($updata);//改变订单状态
		$s = $this->orderActionLog($order['order_id'],'delivery',$data['note']);//操作日志
		
		//商家发货, 发送短信给客户
		$res = checkEnableSendSms("5");
		if($res && $res['status'] ==1){
		    $user_id = $data['user_id'];
		    $users = M('users')->where('user_id', $user_id)->getField('user_id , nickname , mobile' , true);
		    if($users){
		        $nickname = $users[$user_id]['nickname'];
		        $sender = $users[$user_id]['mobile'];
		        $params = array('user_name'=>$nickname , 'order_sn'=>$data['order_sn'],  'consignee'=>$data['consignee']);
		        $resp = sendSms("5", $sender, $params,'');
		    }
		}
		
		return $s && $r;
    }

    /**
     * 获取地区名字
     * @param int $p
     * @param int $c
     * @param int $d
     * @return string
     */
    public function getAddressName($p=0,$c=0,$d=0){
        $p = M('region')->where(array('id'=>$p))->field('name')->find();
        $c = M('region')->where(array('id'=>$c))->field('name')->find();
        $d = M('region')->where(array('id'=>$d))->field('name')->find();
        return $p['name'].','.$c['name'].','.$d['name'].',';
    }

    /**
     * 删除订单
     */
    function delOrder($order_id){
    	$a = M('order')->where(array('order_id'=>$order_id))->delete();
    	$b = M('order_goods')->where(array('order_id'=>$order_id))->delete();
    	return $a && $b;
    }

	/**
	 * 当订单里商品都退货完成，将订单状态改成关闭
	 * @param $order_id
	 */
	function closeOrderByReturn($order_id)
	{
		$order_goods_list = Db::name('order_goods')->where(['order_id' => $order_id])->select();
		$order_goods_count = count($order_goods_list);
		$order_goods_return_count = 0;//退货个数
		for ($i = 0; $i < $order_goods_count; $i++) {
			if ($order_goods_list[$i]['is_send'] == 3) {
				$order_goods_return_count++;
			}
		}
		if ($order_goods_count == $order_goods_return_count) {
			Db::name('order')->where(['order_id' => $order_id])->update(['order_status' => 5]);
		}
	}

    /**
     * 更改售后状态
     * @author lxl
     * @time 2017-5-10
     * @param $return_id    退货ID
     * @param $order_id    订单ID
     * @param int $is_end  订单商品状态
     * @return $this
     */
    public function alterReturnGoodsStatus($return_id,$order_id,$is_end=3){
        $update = M('return_goods')->where('id',$return_id)->update(['status'=>$is_end]);  //要更新退货单状态
        if($update) {
            $return_goods = M('return_goods')->where('id', $return_id)->find();
            $res = M('order_goods')->where(array(
                'order_id' => $order_id,
                'goods_id' => $return_goods['goods_id'],
                'spec_key' => $return_goods['spec_key']))->update(['is_send' => $is_end]);  //订单商品改为已退货
            return $res;
        }
    }

    /**
     * 售后通过后改变库存，根据不同的规格，商品活动修改对应的库存
     * @author lxl
     * @time 2017-5-10
     * @param $order_id 订单ID
     * @param $goods_id 商品ID
     */
    public function alterReturnGoodsInventory($order_id,$goods_id){
        $spec_goods=M('order_goods')->field('goods_num,spec_key,prom_type,prom_id')
            ->where(['order_id' =>$order_id,'goods_id'=>$goods_id])
            ->find(); //查找购买数量和购买规格

        $where = ['id' => $spec_goods['prom_id'] , 'goods_id' => $goods_id];
        if($spec_goods['prom_type']==1){    //是抢购的
            M('flash_sale')->where($where)->setDec('buy_num', $spec_goods['goods_num']);
        }
        if($spec_goods['prom_type']==2){    //是团购的
            M('group_buy')->where($where)->setDec('store_count', $spec_goods['goods_num']);
        }else{  //普通订单
            if(!empty($spec_goods['spec_key'])){
                M('spec_goods_price')
                    ->where("goods_id = $goods_id and `key` = '{$spec_goods['spec_key']}'")
                    ->setInc('store_count', $spec_goods['goods_num']);//有规格则增加商品对应规格的库存
            }else{
                M('goods')->where("goods_id = $goods_id")->setInc('store_count', $spec_goods['goods_num']);//没有规格则增加商品库存
            }
        }

    }

}
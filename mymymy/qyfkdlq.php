<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><?php


/*
    * curl请求数据
 */
function curl_get($url){  
    $ch = curl_init();    
    curl_setopt($ch, CURLOPT_URL, $url);    
     //参数为1表示传输数据，为0表示直接输出显示。  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
     //参数为0表示不带头文件，为1表示带头文件  
    curl_setopt($ch, CURLOPT_HEADER,0);  
    $output = curl_exec($ch);   
    curl_close($ch);   
    return $output;  
}  

/**
    * 以post方式提交xml到对应的接口url
    * 
    * @param string $xml  需要post的xml数据
    * @param string $url  url
    * @param bool $useCert 是否需要证书，默认不需要
    * @param int $second   url执行超时时间，默认30s
    * @throws WxPayException
*/

function postXmlCurl($xml, $url, $useCert = false, $second = 30){		

    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);

    curl_setopt($ch,CURLOPT_URL, $url);

//    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
//    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,true);//严格校验

if(stripos($url,"https://")!==FALSE){
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }    else    {
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
} 

    //
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $cpy_sslcert_path =  'D:/wwwroot/www.yinjiushu.com/plugins/payment/weixin/cert/apiclient_cert.pem';
    $cpy_sslkey_path =  'D:/wwwroot/www.yinjiushu.com/plugins/payment/weixin/cert/apiclient_key.pem';
    
    if($useCert == true){
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT, $cpy_sslcert_path);
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY, $cpy_sslkey_path);
    }
    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //运行curl
    $data = curl_exec($ch);
	
    //返回结果
    if($data){
        curl_close($ch);
        return $data;
        //print_r($data.'AAAAA');
    } else { 
        $error = curl_errno($ch);
        curl_close($ch);
        return $error;
        //print_r($error.'BBBBB');
    }
}

/**
 * 	作用：格式化参数，签名过程需要使用
 */
function formatBizQueryParaMap($paraMap, $urlencode)
{
    $buff = "";
    ksort($paraMap);
    foreach ($paraMap as $k => $v)
    {
        if($urlencode)
        {
            $v = urlencode($v);
        }
        $buff .= $k . "=" . $v . "&";
    }
    $reqPar;
    if (strlen($buff) > 0)
    {
        $reqPar = substr($buff, 0, strlen($buff)-1);
    }
    return $reqPar;
}

/**
 * 	作用：生成签名
 *      $obj 数组
 *      $key 商户key
 */
function getSign($Obj,$key)
{
    foreach ($Obj as $k => $v)
    {
        $Parameters[$k] = $v;
    }
    //签名步骤一：按字典序排序参数
    ksort($Parameters);
    $String = formatBizQueryParaMap($Parameters, false);
    //签名步骤二：在string后加入KEY
    $String = $String."&key=".$key;
    //签名步骤三：MD5加密
    $String = md5($String);
    //签名步骤四：所有字符转为大写
    $result = strtoupper($String);
    return $result;
}



/*查询*/

require_once("confige.php");
mysql_query("set names 'UTF8'");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
if ( (int)$id > 0 ) { 
    $sql="select * from `tp_withdrawals` where `status` = 0 and leixing = 1 and  id =  ".$id;
    $result = mysql_query($sql,$conn); //查询
    while($row = mysql_fetch_array($result)) {
		$user_id = (int)$row['user_id'];
		$amount = $row['money']*100;
		$desc = $row['remark'];
		$money = $row['money'];
		$re_user_name = $row['account_name'];
	    if ( strlen($desc) == 0 ) {
			$desc = '提现打款到零钱';	
		}
		if ( (int)$user_id > 0 ) { 
			 $sql1="select * from `tp_users` where  user_id =  ".$user_id;
			 $result1 = mysql_query($sql1,$conn); //查询
			 while($row1 = mysql_fetch_array($result1)) {
			 	$cpy_openid = $row1['openid'];
				$user_money = $row1['user_money'];
				
			 }
			 
			 
/*
    * 配置内容可以修改   XXXXXXXXXXXXXXXXXX替换成自己信息
    * 微信公众号配置
    * 用于微信企业付款
 */
$cpy_appid = 'wx0e7d379bbfdfb1c2';                  //公众号appid
$cpy_mchid = '1558500951';                          //商户id
$cpy_key = '462D54343D8AFA053FD38EE622D86701';      //商户key
$cpy_secret = '69e78848179c1bc7fb46c5ec306b4bd1';   //公众号secret
$cpy_nonce_str = time().rand(100000, 999999);   //随机字符串
$partner_trade_no = time().rand(100000, 999999).$id; // 唯一订单号
//$cpy_openid = 'oXJ0Z5x9C49DoRCRH_5PiuYMFEm8';       //公众号appid 所获取的用户openid

/*echo"<script>alert('".$re_user_name.'AAA ' .$partner_trade_no.'BBB ' .$amount.'CCC ' .$desc ."');history.go(-2);</script>"; 
exit; */


//封装数据
$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;
$dataArr = array(
    'mch_appid' => $cpy_appid,
    'mchid' => $cpy_mchid,
    'nonce_str' => $cpy_nonce_str,
    'partner_trade_no' => $partner_trade_no,
    'openid' => $cpy_openid,
    'check_name' => 'OPTION_CHECK',
    're_user_name' => $re_user_name, //填写对应openid真实姓名
    'amount' => $amount, //以分为单位,必须大于100
    'desc' => $desc,
    'spbill_create_ip' => $ip,
);

//生成签名
$sign=getSign($dataArr,$cpy_key);

$xml = '<xml>
            <mch_appid>'.$dataArr['mch_appid'].'</mch_appid>
            <mchid>'.$dataArr['mchid'].'</mchid>
            <nonce_str>'.$dataArr['nonce_str'].'</nonce_str>
            <partner_trade_no>'.$dataArr['partner_trade_no'].'</partner_trade_no>
            <openid>'.$dataArr['openid'].'</openid>
            <check_name>'.$dataArr['check_name'].'</check_name>
            <re_user_name>'.$dataArr['re_user_name'].'</re_user_name>
            <amount>'.$dataArr['amount'].'</amount>
            <desc>'.$dataArr['desc'].'</desc>
            <spbill_create_ip>'.$dataArr['spbill_create_ip'].'</spbill_create_ip>
            <sign>'.$sign.'</sign>
        </xml>';
$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

if ( $user_money >= $money  ) {


	$xiaoxi = postXmlCurl($xml, $url, true);
	print_r($xiaoxi);
	$responseObj = simplexml_load_string($xiaoxi, 'SimpleXMLElement', LIBXML_NOCDATA);
	$return_code= $responseObj->return_code; 
	$result_code= $responseObj->result_code; 
	$partner_trade_no = $responseObj->partner_trade_no; 
	$payment_no= $responseObj->payment_no; 
	$payment_time= $responseObj->payment_time; 

} else {
	
	mysql_query("UPDATE tp_withdrawals SET `status` = 2 ,`dsmoney` = '{$user_money}',`return_code` = '可扣余额不足'  WHERE id = '{$id}' ");
    mysql_query("UPDATE tp_remittance SET `status` = 2 ,`dsmoney` = '{$user_money}',`return_code` = '可扣余额不足'     WHERE  withdrawals_id = '{$id}' ");
    /*echo"<script>alert('打款失败');history.go(-3);</script>";  */
    echo"<script>alert('可扣余额不足');window.location.href='http://www.yinjiushu.com/index.php/admin/user/Withdrawals/';</script>";
}
	  
if ( ($return_code == 'SUCCESS') && ($result_code == 'SUCCESS') && ( strlen($payment_time)>10 )   ) {
	
	//$withdrawals['user_id'], ($withdrawals['money'] * -1), 0, "提现(打款到零钱)"
	$user_money_a = $user_money - $money;
	$moneya  = $money* -1;
	
	/*$account_log = array(
        'user_id' => $user_id,
        'user_money' => $money* -1,
        'pay_points' => 0,
        'change_time' => time(),
        'desc' => "提现(打款到零钱)",
        'distribut_money' => 0,
        'order_id' => $id,
        'order_sn' => $partner_trade_no,
    );
	M('account_log')->add($account_log);*/
    
	
	mysql_query("INSERT INTO `tp_account_log` (user_id, user_money, pay_points,change_time,`desc`,distribut_money,order_id,order_sn,payment_no,payment_time,jxmc,return_code,result_code,dsmoney) 
VALUES ('{$user_id}', '{$moneya}', '0','".time()."','打款到零钱','0','{$id}','{$partner_trade_no}','{$payment_no}','{$payment_time}','提现','{$return_code}','{$result_code}','{$user_money}')");
    
    
    $update = mysql_query("UPDATE tp_users SET `user_money` = '{$user_money_a}'   WHERE user_id = '{$user_id}' "); 
	
	
	//print_r($xiaoxi);
	mysql_query("UPDATE tp_withdrawals SET `status` = 1 , `partner_trade_no` = '{$partner_trade_no}', `payment_no` = '{$payment_no}', `payment_time` = '{$payment_time}',`dsmoney` = '{$user_money}',`return_code` = '{$return_code}',`result_code` = '{$result_code}'    WHERE id = '{$id}' ");
    mysql_query("UPDATE tp_remittance SET `status` = 1 , `partner_trade_no` = '{$partner_trade_no}', `payment_no` = '{$payment_no}', `payment_time` = '{$payment_time}',`dsmoney` = '{$user_money}',`return_code` = '{$return_code}',`result_code` = '{$result_code}'   WHERE  withdrawals_id = '{$id}' ");
	//header('Location: http://www.yinjiushu.com/index.php/admin/user/Withdrawals/'); //   注意这个函数前不能有输出
    /*header(location:.getenv("HTTP_REFERER"));   //   返回其调用页面 */ 
    /*echo"<script>alert('打款成功');history.go(-3);</script>";  */
    echo"<script>alert('打款成功');window.location.href='http://www.yinjiushu.com/index.php/admin/user/Withdrawals/'; </script>";
	
	
	 
} else {
	
	mysql_query("UPDATE tp_withdrawals SET `status` = 2,`dsmoney` = '{$user_money}',`return_code` = '{$return_code}',`result_code` = '{$result_code}'     WHERE id = '{$id}' ");
    mysql_query("UPDATE tp_remittance SET `status` = 2,`dsmoney` = '{$user_money}',`return_code` = '{$return_code}',`result_code` = '{$result_code}'     WHERE  withdrawals_id = '{$id}' ");
    /*echo"<script>alert('打款失败');history.go(-3);</script>";  */
    echo"<script>alert('打款失败');window.location.href='http://www.yinjiushu.com/index.php/admin/user/Withdrawals/';</script>";
}

//成功			 
			 
			 
			 
			 
		}
    }
	
	
	
	
	
	
} 




    if($result){
    	mysql_free_result($result); //关闭数据集
	}
    mysql_close(); //关闭MySQL连接
?>
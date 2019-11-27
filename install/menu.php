<?php
      header("Content-type: text/html; charset=utf-8");
	  define('IN_ECS', true);
	   require('D:/wwwroot/mcj/weixinServer/wechat.class.php');
       
         $weixin = new core_lib_wechat($weixinconfig);
		  // var_dump($weixin);
		  $appid="wx0e7d379bbfdfb1c2";
		  $appsecret="69e78848179c1bc7fb46c5ec306b4bd1";
		   $access_token=$weixin->checkAuth($appid,$appsecret);
$jsonmenu = '{
    "button": [
		
	  {	
          "type":"view",
          "name":"饮久舒新时代",
          "url":"http://www.yinjiushu.com/index.php/Mobile/"
      },
	    {	
          "type":"view",
          "name":"会员中心",
          "url":"http://www.yinjiushu.com/index.php/Mobile/User"
      },
	    {	
          "type":"view",
          "name":"分销中心",
          "url":"http://www.yinjiushu.com/index.php/mobile/Distribut/index.html"
      }
	  
	  
    ]
}';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;

$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>
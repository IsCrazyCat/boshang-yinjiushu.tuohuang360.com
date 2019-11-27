<?php


$mysql_server_name='127.0.0.1'; //改成自己的mysql数据库服务器
$mysql_username='yinjiushu_wxgf_c'; //改成自己的mysql数据库用户名
$mysql_password='8d9cf8a03ff4'; //改成自己的mysql数据库密码
$mysql_database='yinjiushu_weixinguanfang_com'; //改成自己的mysql数据库名
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
mysql_select_db($mysql_database); //打开数据库 $_W['os'] 
?>

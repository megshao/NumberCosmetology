<?php 
	//資料庫主機設定
	$db_host = "localhost";
	$db_table = "numberCosmetology";
	$db_username = "root";
	$db_password = "7731";
	//設定資料連線
	$db = @mysql_connect($db_host, $db_username, $db_password);
	if (!$db) die("資料連結失敗！");
	//mysql_query("SET NAMES 'utf8'");
	//連接資料庫
	if (!@mysql_select_db($db_table)) die("資料庫選擇失敗！");
	//設定字元集與連線校對
	//mysql_query("set character set utf8",$db);
	//mysql_query("SET CHARACTER_SET_database= utf8",$db);
	//mysql_query("SET CHARACTER_SET_CLIENT= utf8",$db);
	//mysql_query("SET CHARACTER_SET_RESULTS= utf8",$db);
	mysql_query("SET NAMES 'utf8'");
?>

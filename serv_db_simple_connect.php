<?
	$db_name = "infoampe_acc";
	$db_user = "infoampe_acc";
	$db_pass = "7257598";
	$db_serv = "localhost";
	
	$res = @mysql_connect($db_serv,$db_user ,$db_pass);
 
	if($res)
		mysql_select_db($db_name) or die(mysql_error());


?>
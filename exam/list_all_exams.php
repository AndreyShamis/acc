<?

	$admin_mode = 1;
	//$dataBase = "infoampe_acc";
	$dataBase = "infoampe_acc";
	include "../serv_db_simple_connect.php"; 
	include "../serv_db_tables_name.php" ;	//	ALL TABLES NAMES 
	
	function table_exists($tablename, $database = false) {

	    if(!$database) {
	        $res = mysql_query("SELECT DATABASE()");
	        $database = mysql_result($res, 0);
	    }

	    $res = mysql_query("
	        SELECT COUNT(*) AS count 
	        FROM information_schema.tables 
	        WHERE table_schema = '$database' 
	        AND table_name = '$tablename'
	    ");

	    return mysql_result($res, 0) == 1;

	}
	
	  $sql = "SELECT * FROM ". $db_exam_data . " ORDER BY id DESC" ;
	$q = mysql_query($sql);
	
	if(mysql_errno())
		echo mysql_error() . "<br>";
	$rows = mysql_num_rows($q);
	

?>
<table style="border:1px solid #231245;">
<?
	for($i=0;$i<$rows;$i++)
    {
		$f = mysql_fetch_array($q);	  
?>
<tr>
	<td style="border:1px solid #231245;"> <a title="Run this test" href="question.php?exam_id=<?=$f["id_table_exam"]?>"><?=$f["id_table_exam"]?></a> </td>
	<td style="border:1px solid #231245;"> <? if($admin_mode) echo $f["id_ip4"]?> </td>
	<td style="border:1px solid #231245;"> <? if($admin_mode) echo $f["id_ip6"]?> </td>
	<td style="border:1px solid #231245;"> <?=$f["id_time_start"]?> </td>
	<td style="border:1px solid #231245;"> <?=$f["id_questions_number"]?> </td>
	<td style="border:1px solid #231245;"> <?=$f["id_answers_number"]?> </td>
	<td style="border:1px solid #231245;"> <? 
	if(table_exists($f["id_table_exam"],$dataBase))
		echo "Exist";
	else
		echo "<a href=\"delete_exam.php?ex=" . $f["id"] . "\" target=\"_blank\">Table not exist</a>";
	?> </td>  
</tr>	
<?
	}
?>
</table>

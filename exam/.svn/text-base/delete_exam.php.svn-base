<?

	include "../serv_db_simple_connect.php"; 
	include "../serv_db_tables_name.php" ;	//	ALL TABLES NAMES 


	$id = (int)$_GET["ex"];
	
	if($id)
	{
		$sql = "DELETE FROM " . $db_exam_data . " WHERE id='" . $id . "'";
		mysql_query($sql);

		if(mysql_errno())
			echo "<br/>" . mysql_error() . "<br/>" ;
			
	
	}
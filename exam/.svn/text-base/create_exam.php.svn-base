<?
	include "../serv_db_simple_connect.php";
	include "../serv_db_tables_name.php" ;	//	ALL TABLES NAMES

	include "cookie.php";
include '../serv_function.php';
//=============================================================================
function ArrToSqlOr($cell_name , $condition, $arr)
{
	$ret_string = " ";
	if(strlen($cell_name)==0 || strlen($condition)==0 || count($arr)==0)
		return 0;
	else
	{
		$arr_size = count($arr);
		for($i=0;$i<$arr_size;$i++)
		{
			$ret_string.= $cell_name . $condition . "'" . $arr[$i] ."'";
			if($i<$arr_size-1)
				$ret_string.=" OR ";
		}
	}
	return($ret_string);
}
//=============================================================================

	$input_param = $_POST["subj"];

	$embeded_param;
	$param_counter=0;
	foreach($input_param as $entry=>$val)
	{
		//echo ":" . $entry . "-" . $val ."<br>";
		$embeded_param[$param_counter] = $entry;
		$param_counter++;
	}

	$exam_id = isset($_POST["examid"])? $_POST["examid"]: 0;
	$limit = isset($_POST["max_question"])? $_POST["max_question"]: 0;
	if($limit == 0)
		$limit = 100;
	$limit = min(200,$limit);

	//if($exam_id)
	//{
	   //	echo "Start build new exam table<br>";
	//}
	$arr[0] = "PHP";
	$arr[1] = "MySQL";
	$arr[2] = "ASP";
	$db_exam_new_name = $db_prefix_exam_question . $exam_id;
	$select_condition = ArrToSqlOr("subject_name", "=" , $embeded_param);
	$sql = "CREATE TABLE ". $db_exam_new_name. "
			(id INT(11) auto_increment primary key)
			SELECT * FROM ". $db_main_data ."
			WHERE " . $select_condition . "
			ORDER BY RAND()
			LIMIT " . $limit . "";
	//echo $sql;


    $sql_create_exam = "INSERT INTO " . $db_exam_data . "
	(id_table_exam,id_ip4,id_ip6,id_time_start,id_questions_number,id_answers_number)
	VALUES
	(
		'" . $db_exam_new_name . "',
		'" . getRealIpAddr(). "',
		'"
		. chr(rand(48,57)) . chr(rand(65,70)). ":"
		. chr(rand(48,57)) . chr(rand(65,70)). ":"
		. chr(rand(48,57)) . chr(rand(65,70)). ":"
		. chr(rand(48,57)) . chr(rand(65,70)). ":"
		. chr(rand(48,57)) . chr(rand(65,70)). ":"
		. chr(rand(48,57)) . chr(rand(48,57)) ."',
		'" . time(). "',
		'" . $limit. "',
		'" . '0' . "'
	)";
	mysql_query($sql_create_exam);

	if(mysql_errno())
		echo "<br/>" . mysql_error() . "<br/>" ;
	else
	{
		mysql_query($sql);
		if(mysql_errno())
			echo "<br/>" . mysql_error() . "<br/>" ;

	}

	$sql = "SELECT * FROM " . $db_exam_new_name;
	$q = mysql_query($sql);
		if(mysql_errno())
			echo "<br/>" . mysql_error() . "<br/>" ;
	$question_number = mysql_num_rows($q);

	createCookie($db_exam_new_name,"1");

	$sql = "UPDATE " . $db_exam_data . " SET id_questions_number='" . $question_number . "'
	WHERE id_table_exam = '".$db_exam_new_name."'
	LIMIT 1";
	$q = mysql_query($sql);
		if(mysql_errno())
			echo "<br/>" . mysql_error() . "<br/>" ;
?>
<strong>Questions number in exam:</strong> <?=$question_number?> <br/>
<strong>Subject:</strong> <br/>
<strong>Time start:</strong><?=time()?> <br/>
<strong>The exam will be saved for </strong>1 weak <br/>
<img src="../img/audio_application.png" />
<h2><a title="Run this test" href="question.php?exam_id=<?=$db_exam_new_name?>">Start EXAM</a></h2>


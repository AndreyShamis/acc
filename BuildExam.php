<?

?>

<h1>Build Exam</h1>

<form method="post" action="exam/create_exam.php">
<input type="hidden" value="<? echo md5('examid' . time() .rand(1000,50000)) .rand(1000,50000);?>" name="examid"/>
<div>
<label>Select subject </label>
<?php
include "serv_db_simple_connect.php";

	$sql = "SELECT * FROM tbl_tags LIMIT 1000";
    
	$q = mysql_query($sql);
	
	$rows = mysql_num_rows($q);
	

	for($i=0;$i<$rows;$i++)
    {
		$f = mysql_fetch_array($q);
?>
    <span><?=$f["tag_name"]?>
	<input type="checkbox" name="subj[<?=$f["tag_name"]?>]" /></span>
<?php
    }
?>
<div> Max question for exam: <em> 0 = Maximum </em><input type="text" name="max_question" value="0" /></div>
</div>
<input type="submit" value="Build" />
</form>

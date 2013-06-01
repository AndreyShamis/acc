<?




	include "../serv_db_simple_connect.php";
	include "../serv_db_tables_name.php" ;	//	ALL TABLES NAMES


	include "cookie.php";
	$arr_c = ReadAllExams($exam_id);

	$exam_id = isset($_GET["exam_id"])?$_GET["exam_id"]:0;
	if(!$exam_id)
	{
		 print_r(ReadAllExams($cookie_delimiter));
	?>

	<?
	}

?>
<html>
<body>
<? include "../main_links_menu.php"; ?><br />
Java Script Here(More AJAX)  <br />
<form name="answerForm" method="post" action="" id="answerForm">
<div>
<input type="hidden" name="exam_id" value="<?=$exam_id?>" /> Hidden : <?=$exam_id?><br />
<input type="hidden" name="command" value="" /> Hidden : Command<br />
<input type="hidden" name="question_number" value="<?=$arr_c[$exam_id]?>" /> Hidden : question_number <?=$arr_c[$exam_id]?><br />
</div>
<h2>Question number <?=$arr_c[$exam_id]?></h2>
<script type="text/javascript">
var answerForm = document.forms['answerForm'];

if (!answerForm)
{
    answerForm = document.answerForm;
}

function PostAnswer(eventTarget, eventArgument)
{
	//alert(answerForm.exam_id.value);
    if (!answerForm.onsubmit || (answerForm.onsubmit() != false))
	{
        answerForm.command.value = eventTarget;
        //answerForm.__EVENTARGUMENT.value = eventArgument;
        answerForm.submit();
		//alert(answerForm.exam_id.value);

	}
}
</script>
<?

	  $sql = "SELECT * FROM ". $exam_id . " ORDER BY RAND() LIMIT " . (int)$arr_c[$exam_id] ;
	$q = mysql_query($sql);


	if(mysql_errno())
		echo mysql_error() . "<br>";

	$f = mysql_fetch_array($q);

?>
<h1><?=$f["quiz_question"]?></h1>
<?
	$i = 0;
	while($i<7)
	{
		$i_cor = $i+1;
		if(strlen($f["answer_".$i_cor]))
		{
?>
<input  type="checkbox" name="answer<?=$i_cor?>" onclick="javascript:PostAnswer('answer<?=$i_cor?>$exam_id<?=$exam_id?>','');" style="font-size: 24px;"   />
<?=htmlspecialchars($f["answer_".$i_cor])?>
<br />
<?

		}
		$i++;
	}
?>

<?

?>
</form>




</body>
</html>

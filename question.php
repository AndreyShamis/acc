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
   //	createCookie($exam_id,31,);

?>
<html>
<body>
<? include "../main_links_menu.php";
Java Script Here(More AJAX)  <br />
<form name="answerForm" method="post" action="" id="answerForm">
<div>
<input type="hidden" name="exam_id" value="<?=$exam_id?>" /> Hidden : <?=$exam_id?><br />
<input type="hidden" name="command" value="" /> Hidden : Command<br />
<?

echo "\n $exam_id \n";
//$arr_c = ReadAllExams($exam_id);

//print_r($arr_c);
?>
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
		alert(answerForm.exam_id.value);

	}
}
</script>
<?

	  $sql = "SELECT * FROM ". $db_exam_data . " ORDER BY id DESC" ;
	$q = mysql_query($sql);

	
	if(mysql_errno())
		echo mysql_error() . "<br>";

	$f = mysql_fetch_array($q);

?>
<h1></h1

<span onclick="javascript:PostAnswer('answer<?=$i?>$exam_id<?=$exam_id?>','');" style="border: 1px solid #008080;font-size: 24px;">ANSWER </span>
<?

?>
</form>




</body>
</html>

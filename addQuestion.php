<?php
//=============================================================================
//
$canAddPost 	= isset($_POST["addPost"])			? $_POST["addPost"] : 0;
$subject        = isset($_POST['subject_name'])     ? $_POST['subject_name']    : Null; //
$question       = isset($_POST['question'])         ? $_POST['question']        : Null; //
$question_code  = isset($_POST['question_code'])    ? $_POST['question_code']   : Null; //
$desc           = isset($_POST['quiz_desc'])        ? $_POST['quiz_desc']       : Null; //
$answers        = isset($_POST['ans'])              ? $_POST['ans']             : Null; //
$checks         = isset($_POST['chkans'])           ? $_POST['chkans']          : Null; //
$urls           = isset($_POST['url'])              ? $_POST['url']             : Null; //

/*____________________________________________________________________________*/
if($canAddPost)
{
	$err='';
	//echo '<pre style="text-align:left;">';print_r($_POST);echo '</pre>';
/*____________________________________________________________________________*/
	//  проверяем количество галочек ответов
	$cchecks = count($checks);
	if($cchecks == 1)
	    $data['correct_answer'] = intval(key($checks));
	elseif($cchecks > 1)
	    $data['correct_answer'] = 0;
	elseif($cchecks < 1)
	    $err.= 'No checked answer found. Please try again<br />';
/*____________________________________________________________________________*/
//  проверяем ответы
	$answers_count = count($answers);
	if($answers_count)
	{
	    foreach($answers as $key => $val)
	    {
	        $data['answer_'. intval($key)] = $val;
	    }
	}
	else
	{
	    $err.= '2 answers minimum required.<br />';
	}
/*____________________________________________________________________________*/
	//  проверяем данные массива галочек ответов
	if($cchecks > 0)
	{
	    foreach($checks as $key => $val)
	    {
	        $data['var_'. intval($key)] =1;
	    }
	}
	else
		$err.= '1 right answer minimum required.<br />';
/*____________________________________________________________________________*/
	//  проверяем тему
	if(strlen($subject) > 1)
	    $data['subject_name'] = $subject;
	else
	    $err.= 'Subject required bigger than 2 chars<br />';
/*____________________________________________________________________________*/
//  проверяем ссылки
	$counter = 1;
	foreach($urls as $keys =>$val)
	{
		if(strlen($val) > 3 && is_valid_url($val))
		{
			$data["url_".$counter] = $val;
			$counter++;
		}
	}

/*____________________________________________________________________________*/
//  проверяем вопрос
if(strlen($question) < 1000 && strlen($question) > 1)
    $data['quiz_question'] = $question;
else
    $err.= 'Question field to big.<br />';
/*____________________________________________________________________________*/
//  проверяем текст правильного ответа
if(strlen($desc) < 1001)
    $data['quiz_answer'] = $desc;
else
    $err.= 'Question_answer field to big.<br />';
/*____________________________________________________________________________*/
//  проверяем код вопроса
if(strlen($question_code) < 1001)
    $data['quiz_code'] = $question_code;
else
    $err.= 'Question_code field to big.<br />';
/*____________________________________________________________________________*/
	//  если нет ошибок записываем в БД
	if($err == '')
	{
	    $db->dbAddQuestion($data);
		//$data="";
	}
}
/*____________________________________________________________________________*/
?>
<?php
	if($canAddPost && $err)
    {
?>
<table style="width:100%; background:crimson; color:white;">
  <tr><td>
	<tr><td colspan="2"><?=$err?></td></tr>
  </td></tr>
</table>
<?php
	}
?>
<form action="?pg=addQuestion"  method="post">
<input type="hidden" name="addPost" value="<?=rand(1,100)?>" />
   <table style="width: 100%;">
      <tr>
        <td colspan='2'>
            Subject Name <em>Like:PHP,MySQL,etc</em> :
            <input type="text" name="subject_name" value="<?=$data["subject_name"]?>"/>
        </td>
      </tr>
      <tr>
        <td style='width:50%;text-align:left;'>
            <strong>Question</strong><br />
            <textarea cols='50' rows='6' id='question' name='question'><?=htmlspecialchars($data["quiz_question"])?></textarea>
        </td>
        <td style='width:50%;text-align:left;'>
            <strong>Question Code </strong><br />
            <textarea cols='50' rows='6' id='question_code' name='question_code'><?=$data["quiz_code"]?></textarea>
        </td>
      </tr>
	  <tr>
	  	<td style="vertical-align: top;">
		<table>
      <?php
      for($i=1;$i<8;$i++)
      {
      ?>
		<tr>
        <td style='text-align:right;font-size:12pt;'>
            Answer <?=$i?>
        </td>
        <td style='text-align:left;'>
            <input type='text' name='ans[<?=$i?>]' value="<?=htmlspecialchars($data["answer_".$i])?>" />
            <input type='checkbox' name='chkans[<?=$i?>]' <?if($data["var_".$i]) echo "checked";?> />
        </td></tr>
      <?php
      }
      ?>

			</table>
		</td>
		<td style="vertical-align: top;">
      <?php
      for($i=1;$i<4;$i++)
      {
      ?>
            URL <?=$i?> :
            <input type="text" name="url[<?=$i?>]" value="<?=$data["url_".$i]?>"/>
   			<br />
      <?php
      }
      ?>
             <strong style="float: left;font-size:18pt;">Description of right answer to this query :</strong><br />
            <textarea type="text" name="quiz_desc" value=""><?=$data["quiz_answer"]?></textarea>
		</td>
	  </tr>

      <tr>
        <td colspan="2"><input type="submit" value="Add" /></td>
      </tr>
    </table>
</form>
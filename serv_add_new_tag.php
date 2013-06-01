<?

include "serv_db_simple_connect.php";

$result = "";
$tagName = isset($_POST["tagName"])? $_POST["tagName"] : "";

$sql = "INSERT INTO tbl_tags (tag_name) VALUES ('" . $tagName . "')";

mysql_query($sql);

if(mysql_errno())
{
	$result =  "<br />" . mysql_error() . "<br />";
}
else
{
	$tagName = "";
	$result = "The tag was added.";
}
?>


<form method="post">
<div><?=$result?></div>
<label for="tagName"></label>
<input name="tagName" value="<?=$tagName?>" />
<input type="submit" />
</form>
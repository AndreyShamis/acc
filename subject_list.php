
<div>
<?php
include "serv_db_simple_connect.php";

	$sql = "SELECT * FROM tbl_tags LIMIT 100";
    
	$q = mysql_query($sql);
	
	$rows = mysql_num_rows($q);
	
	for($i=0;$i<$rows;$i++)
    {
		$f = mysql_fetch_array($q);
?>
    <span class="tag"><a href="?pg=question-list&amp;subject=<?=$f["id"]?>&amp;subject_name=<?=urlencode($f["tag_name"])?>"><?=$f["tag_name"]?> </a></span>
<?php
    }
?>
</div>


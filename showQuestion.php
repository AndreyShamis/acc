
<h1>Automated Certification Coach (ACC)</h1>
<h3><a href="index.php">Main <strong>ACC</strong></a></h3>
<h3><a href="addQuestion.php">Add Question <strong>ACC</strong></a></h3>
<h3><a href="showQuestion.php?id=1">Show Question <strong>ACC</strong></a></h3>
<h3><a href="BuildExam.php" >Build EXAM <strong>ACC</strong></a></h3>

<center>
<h1>This is body of question</h1>

<div>
<?php

    for($i=0;$i<7;$i++)
    {
?>
    <label>Option for answer <?=$i+1?></label><br />
<?php
    }
?>
</div>

</center>
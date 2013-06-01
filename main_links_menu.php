
<?php
if($p != 'Home')
    $link_home = "<div class=\"vkladka-left\"><a href=\"/index.php?pg=Home\">ACC</a></div>";
elseif($p == 'Home')
    $link_home = "<div class=\"vkladka-selected\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">ACC</a></div>";

if($p != 'addQuestion')
    $link_add_question = "<div class=\"vkladka-left\"><a href=\"/index.php?pg=addQuestion\">+</a></div>";
elseif($p == 'addQuestion')
    $link_add_question = "<div class=\"vkladka-selected\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">+</a></div>";

if($p != 'question-list')
    $link_question_list = "<div class=\"vkladka-left\"><a href=\"/index.php?pg=question-list\">Questions</a></div>";
elseif($p == 'question-list')
    $link_question_list = "<div class=\"vkladka-selected\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">Questions</a></div>";

if($p != 'Build-Exam')
    $link_exam = "<div class=\"vkladka-left\"><a href=\"/index.php?pg=Build-Exam\">EXAM</a></div>";
elseif($p == 'Build-Exam')
    $link_exam = "<div class=\"vkladka-selected\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">EXAM</a></div>";

if($p != 'subject-list')
    $link_subjects = "<div class=\"vkladka-left\"><a href=\"/index.php?pg=subject-list\">Subjects</a></div>";
elseif($p == 'subject-list')
    $link_subjects = "<div class=\"vkladka-selected\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">Subjects</a></div>";

if($p != 'About-PHP-Certification')
    $link_PHP_CERTIFICATION = "<div class=\"vkladka-right\" style=\"margin:0 -14px 0 0;\"><a href=\"/index.php?pg=About-PHP-Certification\">PHP Certification</a></div>";
elseif($p == 'About-PHP-Certification')
    $link_PHP_CERTIFICATION = "<div class=\"vkladka-selected\" style=\"margin:0 -14px 0 0;\"><a style=\"color:#06DE01;font-weight:bold;text-shadow:2px 2px 2px #555;\">PHP Certification</a></div>";

echo $link_home .
$link_add_question .
$link_question_list .
$link_exam .
$link_subjects .
$link_PHP_CERTIFICATION;
?>
<div class="vkladka-right"><a href="/exam/list_all_exams.php">Exams</a></div>
<div class="vkladka-right"><a href="/showQuestion.php?id=1">Question</a></div>
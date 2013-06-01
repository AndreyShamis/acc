<?php
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset=utf-8');

include_once 'serv_function.php';
include_once 'serv_db_tables_name.php' ;	//	ALL TABLES NAMES
include_once 'clsdb.php';
include_once "ClassTemplate.php";


function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}

function getContent()
{
	$page = $_GET['pg']; //	Application Name
	$page_data;
	switch($page)
	{
		case	"Build-Exam":
			$page_data =  'BuildExam.php';
			break;
        case 	'About-PHP-Certification':
    		$page_data =  'About_php_sertification.php';
			break;
		case	'addQuestion':
        	$page_data =  'addQuestion.php';
			break;
		case 	'question-list':
        	$page_data =  "list_questions.php";
			break;
        case 	'subject-list':
        	$page_data =  'subject_list.php';
			break;
        case 	'addNew-TAG':
        	$page_data =  'serv_add_new_tag.php';
			break;
	}
	return(($page_data));

}

function BuildMenu()
{
	return get_include_contents("main_links_menu.php");
}

 $p =   isset($_GET['pg'])  ? $_GET['pg']   : 'Home';

$cl = 	isset($_GET['cl'])  ? $_GET['cl'] 	: 1;
$di = 	isset($_GET['di'])  ? $_GET['di'] 	: 25;

$db = new clsdb();
	$body = getContent();
    if (is_file($body)) {
        ob_start();
        include $body;
        $body =  ob_get_clean();
    }

	$indexPage = new ClassTemplate("templates/acc","MainPage.html");
	$indexPage->set(array(
				'title'		=> 		'Automated Certification Coach (ACC)',
				'analyst'	=>		get_include_contents("google_analytics.inc.php"),
				'content'	=>		$body,
				'menu'		=>	 	BuildMenu(),


			)
	);


	echo $indexPage->getTemplate();

?>


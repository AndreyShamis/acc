<?php
/*

                    ОБРАБОТЧИК ТАБЛИЦЫ ВОПРОСОВ

                        DATE: 21.07.2011
                      AUTHOR: qpayct


*/
	$order 		= isset($_GET['order'])? (int)$_GET['order']:0;
	$orderObj 	= isset($_GET['orderObj'])? (int)$_GET['orderObj']: NULL;

	if($orderObj == "question")
		$orderObj_str = " ORDER BY quiz_question ";
	else if($orderObj == "subject")
		$orderObj_str = " ORDER BY subject_name ";

	if($order && $order != 1)
		$order = 1;
	if($orderObj_str)
	{
		if($order)
			$order_str = " DESC ";
		else
			$order_str = " ASC ";
	}

	if($di > 50)
		$di = 50;

//  ОТКРЫВАЕМ ТАБЛИЦУ ВОПРОСОВ
    $db->execute("SELECT * FROM `tblacc_data` ");
    $st=0;    //  ТОЧКА СТАРТА ДЛЯ LIMIT x,
    if($di==25)     $checked = array(0 => 'checked', 1 => '', 2 => '');
    elseif($di==50) $checked = array(0 => '', 1 => 'checked', 2 => '');
    elseif($di==100)$checked = array(0 => '', 1 => '', 2 => 'checked');
    $max = $db->num_rows();  //  СКОЛЬКО ЗАПИСЕЙ В ТАБЛИЦЕ
    if($di > $max)  //  ЕСЛИ ДЕЛИМЕТР БОЛЬШЕ КОЛИЧЕСТВА ЭЛЕМЕНТОВ В СПИСКЕ, СРАВНЯТЬ.
        $di = $max;
    else
  	{               //  ИНАЧЕ ВЫВЕСТИ СПИСОК ОПЦИЙ ДЕЛИМЕТРА
        $htmlDivider = "<select onchange=\"listSwitcher(this, '". $p ."')\">";
        if($max > 25)
        {
            $htmlDivider = "<option checked=\"". $checked[0] ."\">25</option>";
            $htmlDivider.= "<option checked=\"". $checked[1] ."\">50</option>";
        }
        elseif($max > 50)
        {
            $htmlDivider = "<option checked=\"". $checked[0] ."\">25</option>";
            $htmlDivider.= "<option checked=\"". $checked[1] ."\">50</option>";
            $htmlDivider.= "<option checked=\"". $checked[2] ."\">100</option>";
        }
        $htmlDivider.= '</select>';
    }
    $c = ceil($max / $di);              // ВЫСЧИТЫВАЕМ КОЛИЧЕСТВО ЛИСТОВ ДЕЛЕНИЕМ НА ДЕЛИМЕТР.
    $os = $max%$di;                     //  ОСТАТОК
    if($cl>1) $st = $cl * $di - $di;    //  ПЕРЕНАЗНАЧАЕМ ТОЧКУ СТАРТА ДЛЯ LIMIT x,
    //  ВЫСЧИТЫВАЕМ ТОЧКУ ОСТАНОВА LIMIT ,y
    if($os>0 && $os<$di && $c==$cl || ($c+1)==$cl)  $of=$st+$os;            //  ЕСЛИ ОСТАТОК БОЛЬШЕ ДЕЛИМЕТРА
    else                                            $of=$st+$di;            //  ИНАЧЕ

    //  ЗАДАЁМ КВЕРИ ДЛЯ ВЫВОДА ЗАПРОШЕНЫХ ЗАПИСЕЙ
    $query = "SELECT * FROM `tblacc_data`". $orderObj_str. $order_str . " LIMIT ".$st .",". $di ." ";
//  далее генерируем меню навигации с проверкой какие кнопки меню с какими ссылками и каскадными стилями классов вывести.
    // УСЛОВИЯ ОТОБРАЖЕНИЯ МЕНЮ НАВИГАЦИИ
    if($cl > 1) // если листов в списке больше одного
    {
        $ifg1 = "class=\"tblPanel\"";
        $navmin1 = $cl - 1;
        $btnFirst = " onclick=\"window.location='index.php?pg=". $p ."&cl=1&di=". $di ."'\"";   //  УКАЗЫВАЕМ ССЫЛКУ ДЛЯ УКАЗАТЕЛЯ МЕНЮ НАВИГАЦИИ
        $btnBack1 = " onclick=\"window.location='index.php?pg=". $p ."&cl=". $navmin1 ."&di=". $di ."'\"";  //  УКАЗЫВАЕМ ССЫЛКУ ДЛЯ КНОПКИ ВОЗВРАТА НА ЛИСТ НАЗАД
    } else {
        $ifg1 = "class=\"tblPanel-non\"";
        $navmin1 = "&nbsp;";
    }
    if($cl > 2)
    {
        $ifg2 = "class=\"tblPanel\"";
        $navmin2 = $cl - 2;
        $btnBack2 = " onclick=\"window.location='index.php?pg=". $p ."&cl=". $navmin2 ."&di=". $di ."'\"";

    } else {
        $ifg2 = "class=\"tblPanel-non\"";
        $navmin2 = "&nbsp;";
    }
    if(($c - $cl) > 0)
    {
        $ifm1 = "class=\"tblPanel\"";
        $navmax1 = $cl + 1;
        $btnForward1 = " onclick=\"window.location='index.php?pg=". $p ."&cl=". $navmax1 ."&di=". $di ."'\"";
        $btnLast = " onclick=\"window.location='index.php?pg=". $p ."&cl=". $c ."&di=". $di ."'\"";
    } else {
        $ifm1 = "class=\"tblPanel-non\"";
        $navmax1 = "&nbsp;";
    }
    if(($c - $cl) > 1)
    {
        $ifm2 = "class=\"tblPanel\"";
        $navmax2 = $cl + 2;
        $btnForward2 = " onclick=\"window.location='index.php?pg=". $p ."&cl=". $navmax2 ."&di=". $di ."'\"";
    } else {
        $ifm2 = "class=\"tblPanel-non\"";
        $navmax2 = "&nbsp;";
    }
    //  HTML МЕНЮ НАВИГАЦИИ ПО ЗАПИСЯМ СПИСКА
    $htmlNav    = "<div class=\"navi\">
        <div style=\"background:#efefef;\"". $ifg1 . " ". $btnFirst ."><<</div>
        <div style=\"background:#e7e7e7;\"". $ifg1 . " ". $btnBack1 ."><</div>
        <div style=\"background:#dfdfdf;\"". $ifg2 . " ". $btnBack2 .">". $navmin2 ."</div>
        <div style=\"background:#d7d7d7;\"". $ifg1 . " ". $btnBack1 .">". $navmin1 ."</div>
        <div style=\"background:#cfcfcf;\" class=\"tblPanel-non\">". ($cl) ."</div>
        <div style=\"background:#d7d7d7;\"". $ifm1 . " ". $btnForward1 .">". $navmax1 ."</div>
        <div style=\"background:#dfdfdf;\"". $ifm2 . " ". $btnForward2 .">". $navmax2 ."</div>
        <div style=\"background:#e7e7e7;\"". $ifm1 . " ". $btnForward1 .">></div>
        <div style=\"background:#efefef;\"". $ifm1 . " ". $btnLast .">>></div>". $htmlDivider;



    //  ВЫВЕСТИ СПИСКИ ВОПРОСОВ.
    //echo $db->dbOpenAssoc($query, $htmlNav);

	//	Create Template file for Full Page view
	$full_page = new ClassTemplate("templates/acc","ListQuestionFull.php");

   	$page["nav"] 	= $htmlNav;					//	Navigation insert
   	$page["table"] 	= $db->dbBuildList($query);	//	All data insert

	$full_page->set($page);						//	Put data
	echo $full_page->getTemplate();				//	Get reult
	$full_page->_debug();						//	View Debug Message

?>
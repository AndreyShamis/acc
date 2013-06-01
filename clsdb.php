<?
/*____________________________________________________________________________*/
/*



                        DATABASE CONNECTION CLASS
                                                by qpayct 28.07.2010

                                                                              */
/*____________________________________________________________________________*/
class clsdb
{
    static protected $DB = "infoampe_acc";      //  database.
    static protected $HN = "localhost";         //  hostname.
    static protected $UN = "infoampe_acc";      //  username.
    static protected $PW = "7257598";           //  password.
    static protected $dblink;                   //  connection descriptor.

    protected $res;                             //  sql resource.
    protected $ip;                              //  sql resource.

/*____________________________________________________________________________*/
    public function __construct()
    {
        $this->ip = self::getRealIpAddr();
    }
/*____________________________________________________________________________*/
    private static function connect()
    {   // DB connection.
        self::$dblink = mysql_connect(self::$HN, self::$UN, self::$PW);
        if(!is_resource(self::$dblink)) die('is_resource error');
        if(!mysql_select_db(self::$DB, self::$dblink)) die(mysql_error());
        //mysql_query ("SET NAMES utf8");
        mysql_set_charset('utf8', self::$dblink);
        mysql_query("set character_set_client='utf8'");
        mysql_query("set character_set_results='utf8'");
        //mysql_query("set collation_connection='utf8_general_ci'");
    }
/*____________________________________________________________________________*/
    public function execute($query)
    {
        //  if no database connection then connect.
        if(!self::$dblink)
			self::connect();
        //  return sql query result.
        if(!$this->res = mysql_query($query))
            return mysql_errno() ."|". mysql_error() ."|". $query;
        else
            return (TRUE);
    }
/*____________________________________________________________________________*/
//
    public function fetchall_row()
    {
        $retval = array();
        while($row = mysql_fetch_row($this->res))
        {
            if($row!=' ')
            {
                $func = create_function('$row', 'return htmlspecialchars($row, ENT_QUOTES , "UTF-8");');
                $retval[] = array_map($func, $row);
            }
        }
        return $retval;
    }
/*____________________________________________________________________________*/
//
    public function fetchall_assoc()
    {
        $retval = array();
        while($row = mysql_fetch_assoc($this->res))
        {
            if($row!=' ')
            {
                $func = create_function('$row', 'return htmlspecialchars($row, ENT_QUOTES , "UTF-8");');
                $retval[] = array_map($func, $row);
            }
        }
        return $retval;
    }
//=============================================================================
//
    public function dbBuildList($query)
    {
        $this->execute($query);
		$templ = new ClassTemplate("templates/acc","ListQuestion.php");
		$urlTpl = new ClassTemplate("templates/acc","ListQuestionUrl.php");
		$AnswerTpl = new ClassTemplate("templates/acc","ListQuestionAnswer.php");

        $co = $this->num_rows();
        $row = $this->fetchall_assoc();
		for($i=0; $i<$co; $i++)
		{
            if($i%2==0) $col = 'tr-line1';
            else        $col = 'tr-line2';

			$row[$i]['col'] = $col;
            for($k=1;$k<4;$k++)
			{
				if(!empty($row[$i]['url_'.$k]))
                {
                	$link[1] = $row[$i]['url_'.$k];
					$urlTpl->set($link);
				}
				else
				{
					$urls_count = $k;
					break;
                }
				unset($row[$i]["url_".$j]);
			}
			$ans = NULL;
			for($j=1;$j<8;$j++)
			{
				if($row[$i]["answer_".$j])
				{
					$ans['answer'] = htmlspecialchars($row[$i]["answer_".$j], ENT_NOQUOTES, "UTF-8");
					$ans['var'] = (int)$row[$i]["var_".$j];
					$AnswerTpl->set($ans);
				}
				else
				{
					$answers_count = $j;
					break;
				}
				unset($row[$i]["answer_".$j]);
				unset($row[$i]["var_".$j]);
			}

			$row[$i]['urls'] = $urlTpl->getTemplate();
			$row[$i]['answers'] = $AnswerTpl->getTemplate();
			$templ->set($row[$i]);
		}
		$templ->_debug();
		return($templ->getTemplate());

    }
/*____________________________________________________________________________*/
//
    public function dbOpenAssoc($query, $nav)
    {
        //  описание генерируюегося листа
        $tbl =  "<div style=\"width:100%:\">". $nav ."</div>
            <div class='th-line'>
    		    <div style=\"width:80%;font-size:14pt;background:#000;\">Question</div>
    		    <div style=\"width:19%;font-size:14pt;background:#000;\">Subject</div>
            </div>
        ";

        $this->execute($query);
        $co = $this->num_rows();
        $row = $this->fetchall_assoc();
        //echo $query .'<br />';
        for($i=0; $i<$co; $i++)
        {
            if($i%2==0) $col = 'tr-line1';
            else        $col = 'tr-line2';
            //  листаем все записи таблицы вопросов
            $answers_count = 0;
            $urls_count = 0;

            //  заполняем переменные данными из таблицы
                                                    $quiz_answers   = htmlspecialchars($row[$i]['correct_answer'], ENT_NOQUOTES, "UTF-8");
            if(!empty($row[$i]['quiz_question']))   $quiz_question  = htmlspecialchars($row[$i]['quiz_question'], ENT_NOQUOTES, "UTF-8");
			if(!empty($row[$i]['quiz_answer']))     $quiz_answer    = htmlspecialchars($row[$i]['quiz_answer'], ENT_NOQUOTES, "UTF-8");
			if(!empty($row[$i]['quiz_code']))       $quiz_code      = htmlspecialchars($row[$i]['quiz_code'], ENT_NOQUOTES, "UTF-8");
			for($j=1;$j<8;$j++)
			{
				if(!empty($row[$i]["answer_".$j]))
				{
					$answers[$j] = htmlspecialchars($row[$i]["answer_".$j], ENT_NOQUOTES, "UTF-8");
					$checks[$j] = htmlspecialchars($row[$i]["var_".$j], ENT_NOQUOTES, "UTF-8");
					$anch[$j] = $answers[$j] . $checks[$j] . '<br />';
				}
				else
				{
					$answers_count = $j;
					break;
				}
			}
            $urlki='';
            for($k=1;$k<4;$k++)
			{
				if(!empty($row[$i]['url_'.$k]))
                {
					$urls[$k] = htmlspecialchars($row[$i]['url_'.$k], ENT_NOQUOTES, "UTF-8");
                    $urlki.= "<a href=\">". $urls[$k] ."\">". $urls[$k] ."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					$urls_count = $k;
					break;
                }
			}

            //  строим таблицу
            $tbl.= "<div class=\"". $col ."\" onclick=\"openHiddenPanel('hiddenPanel".(int)$row[$i]['id'] ."');\">
				        <div style=\"width:80%;text-align:left;\">&nbsp;". htmlspecialchars($row[$i]['quiz_question'], ENT_NOQUOTES, "UTF-8") ."</div>
				        <div style=\"width:19%;\">&nbsp;". htmlspecialchars($row[$i]['subject_name'], ENT_NOQUOTES, "UTF-8") ."</div>
                        <div id=\"hiddenPanel".(int)$row[$i]['id'] ."\" class=\"hide_object\">
				            <div style=\"float:left;width:60%;border-left:inset 1px #ccc;border-bottom:inset 1px #ccc;\">
					            <div style=\"float:left;width:100%;\">&nbsp;". $quiz_question ."<br />".$quiz_code ."</div>
					            <div style=\"float:left;width:100%;\">&nbsp;". $quiz_answer ."</div>
				            </div>
				            <div style=\"float:left;width:39%;border-left:inset 1px #ccc;border-bottom:inset 1px #ccc;\">&nbsp;". implode('<br />', $anch) ."</div>
                            <div class=\"urlki\">&nbsp;". $urlki ."</div>
                        </div>
                    </div>";

        }
        //return ("<div style=\"float:left;border:1px solid #ccc;\">". $tbl ."</div>");
        return ($tbl);
    }
/*____________________________________________________________________________*/
//
    public function dbAddQuestion(&$values)
    {
        //echo '<pre>';print_r($_POST);echo '</pre>';
        //  if no database connection then connect.
        if(!self::$dblink)
		  	self::connect();
		$sql = "INSERT INTO `tblacc_data` SET ";
		$input_size = count($values);
		$counter=0;

		foreach($values as $key=>$val)
		{
			$counter++;
			$sql.= " " . $key . "='" . mysql_real_escape_string($val) . "' ";
			if($counter < $input_size)
				$sql .= ",";
		}
		mysql_query($sql);

		if(mysql_errno())
			echo mysql_errno() ."|". mysql_error() ."|". $sql;
    }
/*____________________________________________________________________________*/
//
    public function num_rows() {if(mysql_num_rows($this->res)) return mysql_num_rows($this->res);}
/*____________________________________________________________________________*/
//
    public function free_results() {mysql_free_result($this->res);}
/*____________________________________________________________________________*/
//
    function sql_result() {if(mysql_result($this->res,1)) return mysql_result($this->res,1);}
/*____________________________________________________________________________*/
//
    private function getRealIpAddr() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown")){$my_ip = getenv("HTTP_CLIENT_IP");}
        elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){$my_ip = getenv("HTTP_X_FORWARDED_FOR");}
        elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){$my_ip = getenv("REMOTE_ADDR");}
        elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {$my_ip = $_SERVER['REMOTE_ADDR'];}
        else {$my_ip = "unknown";}
        return($my_ip);
    }
/*____________________________________________________________________________*/
//
}
?>

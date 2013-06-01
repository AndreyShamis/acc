<?
    
	$cookie_delimiter = "A271";
//==============================================================================
//		Function  
//	Author :	ACC	
function encrypt($value)
{
	$ret_val;
	$str_len = strlen($value);
	for($i=0;$i<$str_len;$i++)
	{               
		$char = substr($value,$i,1);
		$new_char = fmod(ord($char)+$str_len + 7,256);
		$ret_val .= chr($new_char);	
	
	}
	return  ($ret_val);		//	return encryped string
}
//==============================================================================
//		Function  
//	Author :	ACC	
function decrypt($value)
{                    
	$ret_val;
	$str_len = strlen($value);
	for($i=0;$i<$str_len;$i++)
	{               
		$char = substr($value,$i,1);
		$new_char = fmod(ord($char) + (256 - $str_len) + (256- 7),256);
		$ret_val .= chr($new_char);	
	
	}
	return  ($ret_val);		//	return decryped string
}
//==============================================================================


	$cookie_exam_name = "";
/*
$cookie_structure
	exam_name			= 	table in wich located exam
	question_number     =	question position
	cookie_name=        =	static name

*/
//	$decripted =decrypt("Hi all");
  //	echo  $decripted . " " . encrypt($decripted);
//==============================================================================
//		Function  
//	Author :	ACC	
	function createCookie($tbl_name,$question_pos)
	{                    
		
	
		$cookie_del = "A271"; 
		$cookie_val = decrypt($tbl_name) . $cookie_del . decrypt($question_pos);
		setcookie("exam_cook[".$tbl_name."]",($cookie_val),time()+3600*24);
		
	
	}
//==============================================================================
//		Function  
//	Author :	ACC	
	function UpdateCookie($question_pos)
	{
		
	
	}
//==============================================================================
//		Function read all cookies and return them in array when the key is 
//	table_name and value is question number in this exam
//	    Function get
//			1	-	Cookie delimiter for explode defined in head 
//			2	-	Debug FLAG false/not seted will be used for users
//					or TRUE for admin in debug bode 
//	Author :	ACC
function ReadAllExams($debug=false)
{
	$ret_arr;						//	Return value variable

	$cookie_del = "A271";
	//	Check if have something
	if (isset($_COOKIE['exam_cook'])) 
	{                          
		//	For each entry in cookie array get name and value
    	foreach ($_COOKIE['exam_cook'] as $name => $value) 
		{
			$val = explode($cookie_del,$value);
			//	Used inly for debug admin mode
			if($debug)
			{
				echo "First:" .encrypt($val[0]). "<br>"; 
				echo "Second:" . encrypt($val[1]) . "<br>";
			}
			$ret_arr[$name] = encrypt($val[1]); 	//	put into the array
	    }
	}
	else			//	if not find any cookie entry
	{
		if($debug)					//	If Debug mode
			echo "Not set<br>";     //	Just print error in admin debug mode                           
	}
	
	return($ret_arr);
}        
	function getExamFunction($nameinput)
	{                    
		$cookie_del = "A271";   
    	foreach ($_COOKIE['exam_cook'] as $name => $value) 
		{                           
			if($nameinput == $name)
			{
							
				$val = explode("'".$cookie_del."'",$value);	
				return(encrypt($val[1]));
			}
			else
			{
				return(-12);
			}
			
		}		
		return(-11);
	}                                           
//=============================================================================
	//createCookie("tbl_exam_jdkjk3jrfnu4vo8ny48ytb4241414",1,$cookie_delimiter);
	///./createCookie("tbl_exam_jdkjk3jrfnu4vo8ny48ytb4vtyll00",2,$cookie_delimiter);
	//createCookie("tbl_exam_jdkjk3jrfnu4vo8ny48ytb4vtyll11",3,$cookie_delimiter);
	//createCookie("tbl_exam_jdkjk3jrfnu4vo8ny48ytb4vtyll33",32,$cookie_delimiter);
	//createCookie("tbl_exam_jdkjk3jrfnu4vo8ny48ytb4vtyll66",31,$cookie_delimiter);
	
   //	ReadAllExams();
?>
<?
/*	///////////////////////////////////////////////////////////////////////////
 *
 *	Class wich provide tools for debuging mode
 *
 *
 *	Author : werd 		Email: lolnik@gmail.com
 *
 */	///////////////////////////////////////////////////////////////////////////
class ClassDebug
{
	private $_debug_arr;					//	DB of all errors and debug info
	private $_debug_counter 	=	0;		//	Counter of errors and debug info

	//=========================================================================
	//
	public function _debug_AddMessage($mess)
	{
        $this->_debug_arr[$this->_debug_counter++] = $mess . '';
	}
	//=========================================================================
	//
	public function _debug()
	{
		for($index = 0;$index < $this->_debug_counter;$index++)
		{
        	echo "<strong>$index </strong>". $this->_debug_arr[$index]. '<br />';
		}
	}
}
/*	///////////////////////////////////////////////////////////////////////////
 *
 *	Class wich provide tools for work with templates
 *		For more questions u can ask me werd and you can email
 *		me lolnik@gmail.com. So little description about this class
 *		If you need simple template creator with provide primitive functions
 *		for work with tampletes.
 *
 *
 *	Author : werd 		Email: lolnik@gmail.com
 *
 */	///////////////////////////////////////////////////////////////////////////
class ClassTemplate extends ClassDebug{

    private $tr_found 			= 	0;		//	Counter entrys in array
    private $replace;		                //	Array of set
    private $_file_entry;

//	private $_ConstructPattern = "|(.+?){foreach}(.+?){/foreach}(.*)|s";

	//=========================================================================
	//	Class constructor
	//	Get direcory of templates and file
	public function __construct($tplDir,$tplFile)
	{
		$this->tplDir 	= 	$tplDir;	//	Set template file directory
        $this->tplFile 	= 	$tplFile;	//	Set template file in this directory

		//	Reads entire file into a string is the preferred way to read the
		//	contents of a file into a string. It will use memory mapping
		//	techniques if supported by your OS to enhance performance.
        $this->_file_entry 	=
	   	@file_get_contents($this->tplDir . '/' . $this->tplFile);

		if(!$this->_file_entry)
		{
		 	$this->_debug_AddMessage('Can not open template file:'.
		 		$this->tplDir . '/' .
				$this->tplFile);
		}
	}
	//=========================================================================
	//	public function set($inputArray = NULL)
	//	Function wich get array. Array keys can be like number and strings
	//	For better useage you can use keys values from table in wich
	//	use save data(for example MySQL) or another array provider with keys
	//	If you preffer use integer index for key use must remember first
	//	Entry token from $0 value. So please provide to your template this key
	public function set($inputArray = NULL){
        $this->replace[$this->tr_found] = $inputArray;
        $this->tr_found++;
	}
	//=========================================================================
	//	Function return Builded Page by Getting Getting values from each set
	//	-setAdded entry saved in array wich work atomatic
	//	This function use in FOR to build page
    public function getTemplate()
	{
		$result = "";						//	String be returned
		for($index=0;$index<$this->tr_found;$index++)
		{

			if(count($this->replace[$index]))
			{
				//	temporary variable, get template
				$tmp_data = $this->_file_entry;
				foreach(@$this->replace[$index] as $arr_key => $val )
				{
					$tmp_data =  str_replace("{\$". $arr_key ."}", $val ,$tmp_data);
				}
				$result .=$tmp_data;
			}
		}
		$this->clear();
        return ($result);
    }
	//=========================================================================
	public function clear()
	{
	    $this->tr_found 			= 	0;
		$this->replace 				= 	NULL;
	}
}

?>
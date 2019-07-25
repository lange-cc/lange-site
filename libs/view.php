<?php

/**
* 
*/
class view
{
	
	function __construct()
	{
	

	}
	public function render($name,$noinclude=false,$menu)
	{
	    if ($noinclude == true) 
	   {
       	 require 'views/'.$name.'.php';
       }
       else
       {
	    require 'views/commonpage/header.php';
        require 'views/'.$name.'.php';
        require 'views/commonpage/footer.php';
       }
	}

public function CutText($length,$data){
      // strip tags to avoid breaking any html
$string = strip_tags(htmlspecialchars_decode($data, ENT_NOQUOTES));

if (strlen($string) > $length) {

    // truncate string
    $stringCut = substr($string, 0, $length);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
}
return $string;
   
}

}

?>
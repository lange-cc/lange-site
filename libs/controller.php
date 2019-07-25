<?php
/**
* 
*/
class controller extends controllerModel
{
	
	function __construct()
	{
		parent::__construct();
		$this->view = new View();
	}



public function loadModel($name)
  {
	$path = 'models/'.$name.'_model.php';

	if (file_exists($path)) {
		require 'models/'.$name.'_model.php';
        $modelname = $name.'_model';
        $this->model = new $modelname;
	} 
}



public function loadid($id)
{
 $this->idname = $id;
}


public function loadcontroler($controller)
{

$this->loadcontroller = $controller;

}


public function randomname($length=8)
{
$characters = 'cxbvjhuy78erfuwir8ycnkljafGHVHFCFGPONJBVFSESOKOM230peihurfg4uihfgbv p';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;	
}

public function Images($index)
{
return $this->Gallery($index);
}

public function CommonFindiData($id)
{
return $this->Finddata($id);
}




public function Statistics($page)
{
return $this->GetStatistics($page);
}


}
?>
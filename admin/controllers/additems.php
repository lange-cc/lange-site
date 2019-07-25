<?php
/**
* 
*/
class additems extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
        session:: init();
        $loged = session::get('username');
        if ($loged == false) {
        	session::destroy();
        	header('location: login');
        	exit;
        }
     	$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/additems.js');
		$this->view->css = array('editor/jquery-te-1.4.0.css');
	 $this->loadProfile();
	}

	public function autoload()
	{
	 $this->view->id   = $this->idname;
     $this->view->controller = $this->loadcontroller;
     session::set('folder_index',$this->idname);
	 $this->view->data = $this->model->FindData($this->idname);
	 $this->checklink('additems');
     $this->view->render('additems/index',false,$semenu=3,$menu=3);
	}


	public function delete()
	{
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$this->model->delete($id);
		}
	}



public function checkimg($img)
{
if (!empty($img)) 
   {
  echo $img;
   }
else
   {      
  echo  URL.'images/no-image.png';
   }
}

public function upload()
{
	$this->dataupload('/../public/all-images/',session::get('folder_index'));
}

}

?>
<?php
/**
* 
*/
class gallery extends controller
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

$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/gallery.js');
$this->view->css = array('editor/jquery-te-1.4.0.css');
	 $this->loadProfile();
  }

	public function autoload()
	{
   $this->view->data = $this->model->FindData();
   $this->view->controller = $this->loadcontroller;
   $this->checklink('gallery');
   $this->view->render('gallery/index',false,$semenu=3,$menu=3);
	}

 public function Addnew()
 {
  if (isset($_POST['name'])&&isset($_POST['content'])) {
    $name     = $_POST['name'];
    $content  = $_POST['content'];
    $index    = $this->randomname(4);

    $this->model->addnew($name,$content,$index);
  }
  else
  {
    //echo "id not set";
  }
 }

 public function Delete()
 {
if (isset($_POST['id'])) {
     $id = $_POST['id'];
    $this->model->Delete($id);
}
 }

public function FindFolder()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->FindFolder($id);
}
}
public function update()
{
if (isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['content'])) {
    $name     = $_POST['name'];
    $content  = $_POST['content'];
    $id       = $_POST['id'];
    $this->model->update($name,$content,$id);
  }
  else
  {
    //echo "id not set";
  }


}



}

?>
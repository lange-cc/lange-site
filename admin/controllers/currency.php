<?php
/**
*
*/
class currency extends controller
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

$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/currency.js');
$this->view->css = array('editor/jquery-te-1.4.0.css');
$this->loadProfile();
  }

	public function autoload()
	{
   $this->view->data = $this->model->Showlanguage();
   $this->view->controller = $this->loadcontroller;
   $this->checklink('currency');
   $this->view->render('currency/index',false,$semenu=3,$menu=1);
	}

 public function Addnew()
 {
  if (isset($_POST['name'])&&isset($_POST['logo'])&&isset($_POST['rates'])) {

    $name   = $_POST['name'];
    $logo   = $_POST['logo'];
    $rates  = $_POST['rates'];
    $this->model->addnew($name,$logo,$rates);
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



public function findcurrency()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->findcurrency($id);
}
}


public function update()
{
 if (isset($_POST['name'])&&isset($_POST['logo'])&&isset($_POST['rates'])&&isset($_POST['id'])) {

    $name   = $_POST['name'];
    $logo   = $_POST['logo'];
    $rates  = $_POST['rates'];
    $id     = $_POST['id'];

    $this->model->update($name,$logo,$rates,$id);
  }
  else
  {
    //echo "id not set";
  }
}



}

?>

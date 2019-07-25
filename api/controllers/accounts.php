<?php
/**
* 
*/
class accounts extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
    session:: init();
    $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/accounts.js');
    $this->view->css = array('editor/jquery-te-1.4.0.css');
	  $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->FindData();
    $this->FindAuthor();
     $this->view->controller = $this->loadcontroller;
     $this->checklink('accounts');
   $this->view->render('accounts/index',false,$semenu=1,$menu=5);
	}

 public function Addnew()
 {

  if (isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['day'])&&isset($_POST['mouth'])&&isset($_POST['year'])&&isset($_POST['sex'])&&isset($_POST['location'])&&isset($_POST['image-name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['re-password'])) {

if ($_POST['password']==$_POST['re-password']) {

    $f_name    = $_POST['f_name'];
    $l_name    = $_POST['l_name'];
    $day       = $_POST['day'];
    $mouth     = $_POST['mouth'];
    $year      = $_POST['year'];
    $sex       = $_POST['sex'];
    $location  = $_POST['location'];
    $image     = $_POST['image-name'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $this->model->addnew($f_name,$l_name,$day,$mouth,$year,$sex,$location,$image,$email,$password);
    }
    else
    {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Password are not the same, try again.";
$myJSON = json_encode($proced);
echo $myJSON;

    }

    
  }
  else
  {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Make sure all field are not empty";
$myJSON = json_encode($proced);
echo $myJSON;
  }

 }

 public function Delete()
 {
if (isset($_POST['id'])) {
     $id = $_POST['id'];
    $this->model->Delete($id);
}
 }

public function Find()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->Find($id);
}
}
public function update()
{

 if (isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['day'])&&isset($_POST['mouth'])&&isset($_POST['year'])&&isset($_POST['sex'])&&isset($_POST['location'])&&isset($_POST['image-name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['re-password'])&&isset($_POST['id'])) {

  if ($_POST['password']==$_POST['re-password']) {
    $f_name    = $_POST['f_name'];
    $l_name    = $_POST['l_name'];
    $day       = $_POST['day'];
    $mouth     = $_POST['mouth'];
    $year      = $_POST['year'];
    $sex       = $_POST['sex'];
    $location  = $_POST['location'];
    $image     = $_POST['image-name'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $id        = $_POST['id'];
    $this->model->update($f_name,$l_name,$day,$mouth,$year,$sex,$location,$image,$email,$password,$id);
  }
  else
  {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Password are not the same, try again.";
$myJSON = json_encode($proced);
echo $myJSON;
  }
  }
  else
  {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Make sure all field are not empty";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

public function FindAuthor()
{
  $this->view->author = $this->model->FindAuthor();
}


}

?>
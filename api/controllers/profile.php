<?php
/**
* 
*/
class profile extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
    // session:: init();
    // $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/profile.js');
    // $this->view->css = array('editor/jquery-te-1.4.0.css'); 
  }

	public function autoload()
	{
   //  $username = session::get('username');
   //  $password = session::get('password');
   //  $this->view->data = $this->model->FindData($username,$password);
   //  $this->view->profile = $this->loadProfile();
   //   $this->view->controller = $this->loadcontroller;
   //   $this->checklink('profile');
   // $this->view->render('profile/index',false,$semenu=5,$menu=7);
	}

public function getProfile()
{
  if (isset($_POST['email'])) 
  {
     $email = $_POST['email'];
     echo $this->loadProfile($email);
  }
  else
  {
      echo '[{"id":"2","name":"No name","logo":"no-profile.jpg"}]';
  }
  
}

public function Delete()
 {
if (isset($_POST['id'])) {
     $id = $_POST['id'];
    $this->model->Delete($id);
}
 }


public function update()
{

 if (isset($_POST['names'])&&isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['image-name'])&&isset($_POST['cover-image-name'])&&isset($_POST['id']) && isset($_POST['re-password'])) {

  if ($_POST['password']==$_POST['re-password']) {
    $names        = $_POST['names'];
    $username    = $_POST['username'];
    $email       = $_POST['email'];
    $password    = $_POST['password'];
    $image       = $_POST['image-name'];
    $cover_image = $_POST['cover-image-name'];
    $id          = $_POST['id'];
  
    $this->model->update($names,$username,$email,$password,$image,$cover_image,$id);
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


}

?>
<?php
/**
* 
*/
class team extends controller
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
  $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/team.js');
    $this->view->css = array('editor/jquery-te-1.4.0.css');
	 $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->FindData();
    $this->FindAuthor();
     $this->view->controller = $this->loadcontroller;
     $this->checklink('team');
   $this->view->render('team/index',false,$semenu=2,$menu=4);
	}

 public function Addnew()
 {

  if (isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['facebook'])&&isset($_POST['instagram'])&&isset($_POST['twitter'])&&isset($_POST['image-name'])&&isset($_POST['job'])&&isset($_POST['content'])) {
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $facebook    = $_POST['facebook'];
    $instagram   = $_POST['instagram'];
    $twitter     = $_POST['twitter'];
    $image       = $_POST['image-name'];
    $job_title   = $_POST['job'];
    $content     = $_POST['content'];
    $this->model->addnew($name,$email,$facebook,$instagram,$twitter,$image,$job_title,$content);
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

 if (isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['facebook'])&&isset($_POST['instagram'])&&isset($_POST['twitter'])&&isset($_POST['image-name'])&&isset($_POST['job'])&&isset($_POST['content'])&&isset($_POST['id'])) {
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $facebook    = $_POST['facebook'];
    $instagram   = $_POST['instagram'];
    $twitter     = $_POST['twitter'];
    $image       = $_POST['image-name'];
    $job_title   = $_POST['job'];
    $content     = $_POST['content'];
    $id          = $_POST['id'];
    $this->model->update($name,$email,$facebook,$instagram,$twitter,$image,$job_title,$content,$id);
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
<?php
/**
* 
*/
class task extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
        // session:: init();
        // $this->view->js = array('js/task.js');
        // $this->loadProfile($email= null);
	}

public function autoload()
  {
 // $profile   = json_decode($this->loadProfile());
 // $id        = $profile[0]->id;
 // $this->view->user    = $id;
 // //$this->view->accounts   = $this->model->listYears();
 // $this->view->project    = $this->model->project();
 // $this->view->todaytask  = $this->model->todaytask($id);
 // $this->view->controller = $this->loadcontroller;
 // $this->checklink('task');
 echo "Its working";
 }


public function project()
{
	echo $this->model->project();
}

public function AddActivity()
{
 
	if (isset($_POST['email']) && isset($_POST['account']) && isset($_POST['content'])) 
	{
	    $email      = $_POST['email'];
	    $profile    = json_decode($this->loadProfile($email));

        $user     = $profile[0]->id;
		$account  = $_POST['account'];
		$content  = $_POST['content'];
		$status   = $_POST['status'];
		$this->model->AddnewActivity($user,$content,$account,$status);
	}
	else
	{
		echo "Error occured";
	}
}

public function Delete()
{
if (isset($_POST['id'])) {
		$id =  $_POST['id'];
		$this->model->delete($id);
	}
}

public function Findactivity()
{
	if (isset($_POST['id'])) {
		$id =  $_POST['id'];
		$this->model->getActivitydata($id);
	}
}

public function activityUpdate()
{
if (isset($_POST['id']) && isset($_POST['content'])) 
	{
		$id       = $_POST['id'];
		$content  = $_POST['content'];
		$this->model->UpdateActivity($id,$content);
	}
}

public function history()
  {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
	    $profile   = json_decode($this->loadProfile($email));
        $id        = $profile[0]->id;
        $alltask   = $this->model->alltask($id);
        echo $alltask;
     }
     
 }

 public function AddComment()
{
   	if (isset($_POST['user']) && isset($_POST['activity']) && isset($_POST['comment'])) 
	{
		$user     = $_POST['user'];
		$activity = $_POST['activity'];
		$comment  = $_POST['comment'];
		$this->model->AddComment($user,$activity,$comment);
	}
}

}
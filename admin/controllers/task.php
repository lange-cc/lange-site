<?php
/**
* 
*/
class task extends controller
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

 $this->view->js = array('js/task.js');
 $this->loadProfile();

	}

public function autoload()
  {
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user    = $id;
 //$this->view->accounts   = $this->model->listYears();
 $this->view->project    = $this->model->project();
 $this->view->todaytask  = $this->model->todaytask($id);
 $this->view->controller = $this->loadcontroller;
 $this->checklink('task');
 $this->view->render('task/index',false,$semenu=1,$menu=8);
 }




public function AddActivity()
{
	if (isset($_POST['user']) && isset($_POST['account']) && isset($_POST['content'])) 
	{
		$user     = $_POST['user'];
		$account  = $_POST['account'];
		$content  = $_POST['content'];
		$status   = $_POST['status'];
		$this->model->AddnewActivity($user,$content,$account,$status);
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
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user    = $id;
 //$this->view->accounts   = $this->model->listYears();
 $this->view->project    = $this->model->project();
 $this->view->alltask    = $this->model->alltask($id);
 $this->view->controller = $this->loadcontroller;
 $this->checklink('task');
 $this->view->render('task/history',false,$semenu=2,$menu=8);
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
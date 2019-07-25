<?php
/**
* 
*/
class campany extends controller
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

 $this->view->js = array('js/campany.js');
 $this->loadProfile();

	}

public function autoload()
  {
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user_id    = $id;
 $this->view->accounts   = $this->model->listYears();
 $this->view->controller = $this->loadcontroller;
 $this->checklink('campany');
 $this->view->render('campany/index',false,$semenu=3,$menu=4);
 }

public function Addnew()
{
	if (isset($_POST['name']) && isset($_POST['user']) && isset($_POST['year']) && isset($_POST['content'])) 
	{
		$name = $_POST['name'];
		$user = $_POST['user'];
		$content = $_POST['content'];
		$date = $this->todayDate();
		$dd   = date('d');
		$mm   = date('m');
		$yyy  = $_POST['year'];
		$this->model->AddAcount($name,$user,$date,$dd,$mm,$yyy,$content);
	}
}

public function Addnewyear()
{
		if (isset($_POST['yyy'])) 
	{
		$year = $_POST['yyy'];
		$this->model->AddYear($year);
	}
}

public function Delete()
{
  if (isset($_POST['id'])) {
  	$id = $_POST['id'];
  	$this->model->DeleteAccount($id);
  }
}

public function view()
{
if (isset($this->idname)) 
{
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user_id    = $id;
 $this->view->account_id = $this->idname;
 $this->view->getaccount = $this->model->ShowAccount($this->idname);
 $this->view->Billings   = $this->model->getBillings($this->idname);
 $this->view->controller = $this->loadcontroller;
 $this->view->render('campany/ViewAccount',false,$semenu=3,$menu=4);
 }
 else
 {
   $this->autoload();
 }
}

public function AddActivity()
{
	if (isset($_POST['user']) && isset($_POST['account']) && isset($_POST['content'])) 
	{
		$user     = $_POST['user'];
		$account  = $_POST['account'];
		$content  = $_POST['content'];
		$this->model->AddnewActivity($user,$content,$account);
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

public function AddBilling()
{
if (isset($_POST['activity']) && isset($_POST['spend']) && isset($_POST['income']) && isset($_POST['account'])) 
	{
		$activity = $_POST['activity'];
		$spend    = $_POST['spend'];
		$income   = $_POST['income'];
		$account  = $_POST['account'];
		$this->model->AddBilling($activity,$spend,$income,$account);
	}
}

public function Findaccount()
{
	if (isset($_POST['id'])) {
		$id =  $_POST['id'];
		$this->model->getAccountdata($id);
	}
}

public function accountUpdate()
{
	if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['content'])) 
	{
		$id     = $_POST['id'];
		$name   = $_POST['name'];
		$content  = $_POST['content'];

		$this->model->UpdateAccount($id,$name,$content);
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

}
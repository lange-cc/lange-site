<?php
/**
* 
*/
class billing extends controller
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

 $this->view->js = array('js/billing.js');
 $this->loadProfile();

	}

public function autoload()
  {
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user_id    = $id;
 $this->view->project    = $this->model->project();
 $this->view->billing   = $this->model->getBillings($id);
 $this->view->controller = $this->loadcontroller;
 $this->checklink('billing');
 $this->view->render('billing/index',false,$semenu=1,$menu=9);
 }

public function Delete()
{
  if (isset($_POST['id'])) {
  	$id = $_POST['id'];
  	$this->model->Delete($id);
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
		$client   = $_POST['client'];
		$this->model->AddBilling($activity,$spend,$income,$account,$client);
	}
}

public function Findbilling()
{
	if (isset($_POST['id'])) 
	{
		$id =  $_POST['id'];
		$this->model->getBillingdata($id);
	}
}

public function Update()
{
if (isset($_POST['id']) && isset($_POST['activity']) && isset($_POST['spend']) && isset($_POST['income'])) 
	{
		$id       = $_POST['id'];
		$activity = $_POST['activity'];
		$spend    = $_POST['spend'];
		$income   = $_POST['income'];
        $client   = $_POST['client'];
		$this->model->Update($id,$activity,$spend,$income,$client);
	}
}


public function history()
{
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user_id    = $id;
  $this->view->project    = $this->model->project();
 $this->view->billing    = $this->model->Billings($id);
 $this->view->controller = $this->loadcontroller;
 $this->checklink('billing');
 $this->view->render('billing/history',false,$semenu=2,$menu=9);
}


}
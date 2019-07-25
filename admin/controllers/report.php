<?php
/**
* 
*/
class report extends controller
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

 $this->view->js = array('js/report.js');
 $this->loadProfile();

	}

public function autoload()
  {
 $profile   = json_decode($this->loadProfile());
 $id        = $profile[0]->id;
 $this->view->user    = $id;
 $this->view->account = $this->model->AllAccount();
 $this->view->controller = $this->loadcontroller;
 $this->checklink('report');
 $this->view->render('report/task',false,$semenu=1,$menu=10);
 }

 public function task()
 {
$profile   = json_decode($this->loadProfile());
$id        = $profile[0]->id;
$this->view->user    = $id;
 $this->view->account = $this->model->AllAccount();
$this->view->controller = $this->loadcontroller;
$this->checklink('report');
$this->view->render('report/task',false,$semenu=1,$menu=10);
}

public function viewreport()
{
    if (isset($_POST['user']) && isset($_POST['mm']) && isset($_POST['yyy'])) {
        
        $user  = $_POST['user'];
        $month = $_POST['mm'];
        $year  = $_POST['yyy'];
        $this->model->Taskreport($user,$month,$year); 
    }
    else
    {
        echo "error";
    }
   
}

public function billing()
{
$profile   = json_decode($this->loadProfile());
$id        = $profile[0]->id;
$this->view->user    = $id;

$this->view->controller = $this->loadcontroller;
$this->checklink('report');
$this->view->render('report/billing',false,$semenu=2,$menu=10);
}

public function viewbillingreport()
{
      if (isset($_POST['mm']) && isset($_POST['yyy'])) {
        
        $month = $_POST['mm'];
        $year  = $_POST['yyy'];
        $this->model->Billingreport($month,$year); 
    }
    else
    {
        echo "error";
    }  
}

}
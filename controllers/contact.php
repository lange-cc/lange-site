<?php
/**
* 
*/
class contact extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array();
		//$this->Statistics('Contact');
	}

	public function autoload()
	{
	$this->view->title = "LANGE - Contact us";
	  $this->view->controller = $this->loadcontroller;
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);
     $this->view->kill        = 'kill';
     $this->view->teamcontent  = $this->model->Finddata($id=19);
     $this->view->team        = $this->model->ourTeam();
     $this->view->render('contact/index',false,$menu=6);
	}

 public function MakeActive($key)
 {
 	if ($key==0) {
 		echo "active";
 	}
 	else
 	{
 		//nothing
 	}
 }


}

?>
<?php
/**
*
*/
class jyaonline extends controller
{


	function __construct()
	{
		parent::__construct();
		$this->view->js = array();
		//$this->Statistics('Contact');
	}

	public function autoload()
	{
	$this->view->title = "LANGE - Jyaonline";
	  $this->view->controller = $this->loadcontroller;
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);
	 $this->view->content       = $this->model->Finddata($id=28);
     $this->view->kill        = 'kill';
     $this->view->jyaonline = TRUE;
     $this->view->teamcontent  = $this->model->Finddata($id=19);
     $this->view->team        = $this->model->ourTeam();
     $this->view->render('jyaonline/index',false,$menu=8);

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

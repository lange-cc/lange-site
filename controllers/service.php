<?php
/**
* 
*/
class service extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array();
		//$this->Statistics('Service');
	}

	public function autoload()
	{
	$this->view->title = "LANGE - Service";
	$this->view->controller = $this->loadcontroller;
	$this->view->service    = $this->model->Finddata($id=16);
	$this->view->listwhatWeDo = $this->model->Finddata($id=11);
	
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);

      $this->view->render('service/index',false,$menu=3);
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
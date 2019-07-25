<?php
/**
* 
*/
class works extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array();
		//$this->Statistics('Works');
	}

	public function autoload()
	{
	  $this->view->title = "LANGE - Works";
	  $this->view->controller = $this->loadcontroller;
	  $this->view->slide      = $this->model->Finddata($id=8);
	  $this->view->project    = $this->model->Finddata($id=9);
	  $this->view->whatWeDo   = $this->model->Finddata($id=10);
	$this->view->listwhatWeDo = $this->model->Finddata($id=11);
	$this->view->testmonials  = $this->model->Finddata($id=12);
	$this->view->testmonials_people  = $this->model->Finddata($id=13);
	  $this->view->blog       = $this->model->BlogData($limit=2);
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);

      $this->view->render('works/index',false,$menu=2);
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
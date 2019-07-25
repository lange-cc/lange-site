<?php
/**
* 
*/
class culture extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js  = array('assets/js/jquery.classyscroll.js','assets/js/ekScrollable.js','assets/js/jquery.mousewheel.js','assets/js/cultule.js','assets/js/ayoshare.js');
	}

	public function autoload()
	{
	  $this->view->title = "LANGE - Culture";
	  $this->view->controller = $this->loadcontroller;
	  $this->view->client_logo = $this->Gallery($index='hCiS');
	  $this->view->culture    = json_decode($this->model->Finddata($id=29));
	  $this->view->location    = $this->model->Finddata($id=14);
	  $this->view->phone       = $this->model->Finddata($id=15);
      $this->view->render('culture/index',false,$menu=7);
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
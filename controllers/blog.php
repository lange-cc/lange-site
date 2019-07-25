<?php
/**
* 
*/
class blog extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js  = array('assets/js/jquery.classyscroll.js','assets/js/ekScrollable.js','assets/js/jquery.mousewheel.js','assets/js/demo.js','assets/js/ayoshare.js');
		//$this->Statistics('Blog');
	}

	public function autoload()
	{
	  $this->view->title = "LANGE - Blog";
	  $this->view->controller = $this->loadcontroller;
	  $this->view->blog = $this->model->BlogData();

	  $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);
      $this->view->render('blog/index',false,$menu=4);
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
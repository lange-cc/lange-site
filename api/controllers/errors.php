<?php
/**
* 
*/
class errors extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
        session:: init();
 $this->view->js = array('js/content.js');
 $this->loadProfile();

	}

	public function autoload()
	{
	  $this->view->controller = $this->loadcontroller;
      $this->view->render('errors/index',false,$semenu=0,$menu=0);
	}





}
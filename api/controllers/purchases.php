<?php
/**
*
*/
class purchases extends controller
{


	function __construct()
	{
		parent::__construct();
        session:: init();
        $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/purchases.js');
        $this->view->css = array('editor/jquery-te-1.4.0.css');
        $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->purchases = $this->model->FindPurchases();
    $this->view->controller = $this->loadcontroller;
    $this->checklink('purchases');
   $this->view->render('purchases/index',false,$semenu=2,$menu=1);
	}



public function Viewpuchases()
{
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $this->model->Viewpuchases($id); 
    }
}


public function Accept()
{
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $this->model->ComfirmPuchases($id); 
    } 
}

public function Delete()
{
    
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $this->model->DeletePuchases($id); 
    } 
}
}

?>

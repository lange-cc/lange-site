<?php
/**
* 
*/
class giftinfo extends controller
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
     	$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/giftinfo.js');
		$this->view->css = array('editor/jquery-te-1.4.0.css');
	 $this->loadProfile();
	}


public function autoload()
{
   $this->view->id   = $this->idname;
   $this->view->controller = $this->loadcontroller;
   $this->view->gift = $this->model->FindGift($this->idname);
   $this->view->productofgift = $this->model->FindProductOfGift($this->idname);
   $this->view->product = $this->model->Findproduct();
   $this->checklink('giftinfo');
   $this->view->render('giftinfo/index',false,$semenu=3,$menu=2);
}

public function Addnew()
 {

 if (isset($_POST['content'])&&isset($_POST['id'])) {
    $content = $_POST['content'];
    $id      = $_POST['id'];
    $this->model->ChangeData($content,$id);
  }
  else
  {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Make sure author was Selected";
$myJSON = json_encode($proced);
echo $myJSON;
  }

 }

public function Addcolor()
{
   
 if (isset($_POST['name'])) {
    $name  = $_POST['name'];
    $index = $_POST['index'];
    $this->model->Addcolor($name,$index);
  }
  else
  {
$proced = new \stdClass();    
$proced->status  = "fail";
$proced->message = "Make sure all field are not empty";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

	public function delete()
	{
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$this->model->delete($id);
		}
	}

public function imgDelete()
{
  if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $this->model->imgDelete($id);
    }
}

public function colorDelete()
{
  if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $this->model->colorDelete($id);
    }
}


public function checkimg($img)
{
if (!empty($img)) 
   {
  echo $img;
   }
else
   {      
  echo  URL.'images/no-image.png';
   }
}

public function putsessionid()
{
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    session::set('color_id',$id);
  }
}

public function join()
{
  if (isset($_POST['pro_id']) && isset($_POST['gif_id'])) {
    $pro_id = $_POST['pro_id'];
    $gif_id = $_POST['gif_id'];
    $this->model->join($pro_id,$gif_id);
  } 
}

}

?>
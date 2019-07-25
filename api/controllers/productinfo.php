<?php
/**
*
*/
class productinfo extends controller
{


	function __construct()
	{
		    parent::__construct();
        session:: init();
        $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/productinfo.js');
		    $this->view->css = array('editor/jquery-te-1.4.0.css');
	      $this->loadProfile();
	}


public function autoload()
{
   $this->view->id   = $this->idname;
   $this->view->controller = $this->loadcontroller;
   $this->view->product = $this->model->FindProduct($this->idname);
   $this->checklink('productinfo');
   $this->view->render('productinfo/index',false,$semenu=2,$menu=2);
}

public function Addnew()
 {

 if (isset($_POST['quantity'])&&isset($_POST['weight'])&&isset($_POST['discount'])&&isset($_POST['size'])&&isset($_POST['content'])&&isset($_POST['stock-info'])&&isset($_POST['manufacture-price'])&&isset($_POST['keywords'])&&isset($_POST['id'])) {
    $quantity    = $_POST['quantity'];
    $weight      = $_POST['weight'];
    $discount    = $_POST['discount'];
    $size        = $_POST['size'];
    $content     = $_POST['content'];
    $stockInfo   = $_POST['stock-info'];
    $manufaPrice = $_POST['manufacture-price'];
    $keywords    = $_POST['keywords'];
    $id          = $_POST['id'];
		$summury     = $_POST['summury'];

    $this->model->ChangeData($discount,$quantity,$weight,$size,$content,$stockInfo,$manufaPrice,$keywords,$id,$summury);
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

public function productsize()
{
	if (isset($_POST['index']) && isset($_POST['sizeName'])) {
		$index = $_POST['index'];
		$name  = $_POST['sizeName'];
		$this->model->productsize($index,$name);
	}

}
public function addproductsize()
{
	if (isset($_POST['index']) && isset($_POST['name'])) {
		 $name   = $_POST['name'];
		 $price  = $_POST['price'];
		 $index = $_POST['index'];
		 $this->model->addproductsize($name,$index,$price);
	}
}

public function SizeDelete()
{
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$this->model->SizeDelete($id);
	}
}

public function upload()
{
	$this->dataupload('/../public/all-images/','none',session::get('other_img_index'));
}

public function uploadColorImg()
{
	$this->dataupload('/../public/all-images/','none',session::get('color_index'),session::get('color_id'));
}

}

?>

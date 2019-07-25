<?php
/**
* 
*/
class blog extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
    session:: init();
    $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/blog.js');
    $this->view->css = array('editor/jquery-te-1.4.0.css');
	  $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->FindData();
    $this->FindAuthor();
     $this->view->controller = $this->loadcontroller;
     $this->checklink('blog');
   $this->view->render('blog/index',false,$semenu=2,$menu=3);
	}

 public function Addnew()
 {

$tz = 'UTC';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
// $dt->format('F j-Y');
$date =$dt->format('Y-m-d');

  if (isset($_POST['title'])&&isset($_POST['image-name'])&&isset($_POST['author'])&&isset($_POST['content'])) {
    $title       = $_POST['title'];
    $img_name    = $_POST['image-name'];
    $author      = $_POST['author'];
    $content     = $_POST['content'];
    $added_date  = $date;
    $update_date = $date;
    $views       = 0;
    $index       = $this->randomname(8);
    $this->model->addnew($title,$img_name,$author,$content,$added_date,$update_date,$views,$index);
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

 public function Delete()
 {
if (isset($_POST['id'])) {
     $id = $_POST['id'];
    $this->model->Delete($id);
}
 }

public function Findproduct()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->Findproduct($id);
}
}
public function update()
{
  $tz = 'UTC';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
// $dt->format('F j-Y');
$date =$dt->format('Y-m-d');
if (isset($_POST['id'])&&isset($_POST['title'])&&isset($_POST['image-name'])&&isset($_POST['author'])&&isset($_POST['content'])) {
    $title       = $_POST['title'];
    $img_name    = $_POST['image-name'];
    $author      = $_POST['author'];
    $content     = $_POST['content'];
    $id          = $_POST['id'];
    $update_date = $date;
    $this->model->update($title,$img_name,$author,$content,$update_date,$id);
  }
  else
  {
    //echo "id not set";
  }


}

public function FindAuthor()
{
  $this->view->author = $this->model->FindAuthor();
}

public function copy()
{
if (isset($_POST['data'])) 
{
  $lang = $_POST['data'];
  $this->model->copyData($lang);
}
else
{
  echo "error";
}
}

}

?>
<?php
/**
* 
*/
class section extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
    session:: init();
    $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/section.js');
		$this->view->css = array('editor/jquery-te-1.4.0.css');
	  $this->loadProfile();
  }

	public function autoload()
	{
	 $this->view->id   = $this->idname;
   $this->view->controller = $this->loadcontroller;
	 $this->view->data = $this->model->FindData($this->idname);
   $this->checklink('section');
   $this->view->render('section/index',false,$semenu=1,$menu=3);
	}

	public function save()
	{

	 if (isset($_POST['title']) && isset($_POST['content']) && $_POST['id']) {	
        $title         = $_POST['title'];
        $content       = $_POST['content'];
        $id            = $_POST['id'];
        $section_index = $this->randomname();

$this->model->addContent($title,$content,$id,$section_index);
}	
else
{
	#json
}	
	}

	public function delete()
	{
		if (isset($_POST['data'])) {
			$val = $_POST['data'];
			$this->model->delete($val);
		}
	}
	public function DeleteArticle()
	{
		if (isset($_POST['id'])) {
			$val = $_POST['id'];
			$this->model->DeleteArticle($val);
		}
	}
	

	public function getImage()
	{
	 $this->model->getImages();
	}
public function DeleteImage()
{
  if (isset($_POST['data']) && isset($_POST['id'])) {
    $id        = $_POST['id'];
    $file_name = $_POST['data'];
    $this->model->DeleteImage($id,$file_name);
  }

}

public function addArticle()
{
if (isset($_POST['title']) && isset($_POST['sub-title']) && isset($_POST['image-name']) && isset($_POST['content']) && $_POST['section_index']) {
	$title         = $_POST['title'];
	$subTitle      = $_POST['sub-title'];
	$img           = $_POST['image-name'];
	$content       = $_POST['content'];
	$section_index = $_POST['section_index'];
  $article_index = $this->randomname();

    $this->model->addArticle($title,$subTitle,$img,$content,$section_index,$article_index);

}


}

public function sectionUpdate()
{
if (isset($_POST['id'])) {
  	$id = $_POST['id'];
  	$this->model->sectionUpdate($id);
  }
  else
  {
  	//echo "id not set";
  }  


}
public function sectionView()
{
if (isset($_POST['id'])) {
  	$id = $_POST['id'];
  	$this->model->sectionView($id);
  }
  else
  {
  	//echo "id not set";
  }  


}

public function FindArticle()
{
if (isset($_POST['id'])) {
  	$id = $_POST['id'];
  	$this->model->FindArticle($id);
  }
  else
  {
  	//echo "id not set";
  }  


}


public function Update()
{
if (isset($_POST['title'])&&isset($_POST['content'])&&isset($_POST['id'])) {
  	$title   = $_POST['title'];
  	$id   = $_POST['id'];
  	$content = $_POST['content'];
  	$this->model->Update($title, $content, $id);
  }
  else
  {
  	//echo "id not set";
  }  


}

public function UpdateArticle()
{
  if (isset($_POST['title'])&&isset($_POST['sub-title'])&&isset($_POST['id'])&&isset($_POST['image-name'])&&isset($_POST['content'])) {
    $title    = $_POST['title'];
    $subTitle = $_POST['sub-title'];
    $id       = $_POST['id'];
    $img      = $_POST['image-name'];
    $content  = $_POST['content'];
    $this->model->ArticleUpdate($title,$subTitle,$id,$img,$content);
  }
  else
  {
    //echo "id not set";
  }
}

public function checkimg($path,$img)
{
if (!empty($img)) 
   {
  echo $path;
   }
else
   {      
  echo  URL.'images/no-image.png';
   }
}


public function upload()
{
	$this->dataupload('/../public/all-images/');
}

}

?>
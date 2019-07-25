<?php
/**
*
*/
class product extends controller
{


	function __construct()
	{
		 parent::__construct();
     session:: init();
     $this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/product.js');
     $this->view->css = array('editor/jquery-te-1.4.0.css');
     $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->FindData();
    $this->view->category = $this->model->Categoryview();
    $this->view->controller = $this->loadcontroller;
    $this->checklink('product');
    $this->view->render('product/index',false,$semenu=2,$menu=2);
  
	}

 public function Addnew()
 {
  if (isset($_POST['name'])&&isset($_POST['category_id'])&&isset($_POST['image-name'])&&isset($_POST['price'])) {
    $name        = $_POST['name'];
    $category_id = $_POST['category_id'];
    $main_img    = $_POST['image-name'];
    $price       = $_POST['price'];
    $other_img_id= $this->randomname($length=5);
    $color_index = $this->randomname($length=6);
		$size_index  = $this->randomname($length=6);
		$quantity    = $this->randomname($length=6);
    $this->model->addnew($other_img_id,$color_index,$name,$category_id,$main_img,$price,$size_index,$quantity);
  }
  else
  {
    //echo "id not set";
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
  if (isset($_POST['name'])&&isset($_POST['category_id'])&&isset($_POST['image-name'])&&isset($_POST['price'])&&isset($_POST['id'])) {
    $name        = $_POST['name'];
    $category_id = $_POST['category_id'];
    $main_img    = $_POST['image-name'];
    $price       = $_POST['price'];
    $id          = $_POST['id'];

    $this->model->update($name,$category_id,$main_img,$price,$id);
  }
  else
  {
    //echo "id not set";
  }


}


public function GetSubCategory($data)
{
if ($data != 'none')
{
 echo "<ul class='category-win'>";
$dataa = $data;
foreach ($dataa as $key => $value)
{
?>
<li class="category-list"  id="row_<?php echo $dataa[$key]->id; ?>"> <?php echo $dataa[$key]->name; ?>

<a href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" data-index="<?php echo $data[$key]->category_index;?>" data-name="<?php echo $data[$key]->name;?>" class="pull-right btn-select-cat" title="select">
  <span class="fa fa-check"></span>
</a>

<?php
if ($dataa[$key]->sub != 'none')
{
$dat = $dataa[$key]->sub;
$this->GetSubCategory($dat);
}
?>
</li>
<?php
}
echo "</ul>";
}
}

public function GetSubCategory2($data)
{
if ($data != 'none')
{
 echo "<ul class='category-win'>";
$dataa = $data;
foreach ($dataa as $key => $value)
{
?>
<li class="category-list"  id="row_<?php echo $dataa[$key]->id; ?>"> <?php echo $dataa[$key]->name; ?>

<a href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" data-index="<?php echo $data[$key]->category_index;?>" data-name="<?php echo $data[$key]->name;?>" class="pull-right btn-select-cat2" title="select">
  <span class="fa fa-check"></span>
</a>

<?php
if ($dataa[$key]->sub != 'none')
{
$dat = $dataa[$key]->sub;
$this->GetSubCategory2($dat);
}
?>
</li>
<?php
}
echo "</ul>";
}
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


public function index()
{
  $this->model->createindex();
}

}

?>

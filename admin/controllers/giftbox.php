<?php
/**
* 
*/
class giftbox extends controller
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

$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/giftbox.js');
$this->view->css = array('editor/jquery-te-1.4.0.css');
   $this->loadProfile();
  }

  public function autoload()
  {
    $this->view->data = $this->model->FindData();
    $this->view->category = $this->model->Categoryview();
    $this->view->controller = $this->loadcontroller;
    $this->checklink('giftbox');
   $this->view->render('giftbox/index',false,$semenu=3,$menu=2);
  }

 public function Addnew()
 {
  if (isset($_POST['name'])&&isset($_POST['image-name'])&&isset($_POST['price'])) {
    $name        = $_POST['name'];
    $main_img    = $_POST['image-name'];
    $price       = $_POST['price'];
    $box_index   = $this->randomname($length=6);
    $this->model->addnew($name,$main_img,$price,$box_index);
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

public function Findgift()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->Findgift($id);
}
}
public function update()
{
  if (isset($_POST['name'])&&isset($_POST['image-name'])&&isset($_POST['price'])&&isset($_POST['id'])) {
    $name   = $_POST['name'];
    $img    = $_POST['image-name'];
    $price  = $_POST['price'];
    $id     = $_POST['id'];

    $this->model->update($name,$img,$price,$id);
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

<a href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" data-name="<?php echo $data[$key]->name;?>" class="pull-right btn-select-cat" title="select">
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

<a href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" data-name="<?php echo $data[$key]->name;?>" class="pull-right btn-select-cat2" title="select">
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



}

?>
<?php
/**
*
*/
class category extends controller
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
    $this->view->js   = array('editor/jquery-te-1.4.0.min.js','js/category.js');
    $this->view->css  = array('editor/jquery-te-1.4.0.css');
	 $this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->FindData();
    $this->FindAuthor();
    $this->view->controller = $this->loadcontroller;
    $this->checklink('category');
    $this->view->render('category/index',false,$semenu=1,$menu=2);
	}

 public function Addnew()
 {
if (isset($_POST['name'])) {

if (isset($_POST['level'])&& isset($_POST['parent-id']) && isset($_POST['parindex'])) {
  if (empty($_POST['level']) && empty($_POST['parent-id'])) {
    $name      = $_POST['name'];
    $level     = 1;
    $parent_id = 0;
    $index     = $this->randomname(8);
    $parent_index = 0;
    $this->model->addnew($name,$level,$parent_id,$index,$parent_index);
  }
  else
  {
    $name         = $_POST['name'];
    $level        = $_POST['level']+1;
    $parent_id    = $_POST['parent-id'];
    $parent_index = $_POST['parindex'];
    $index        = $this->randomname(8); 
    $this->model->addnew($name,$level,$parent_id,$index,$parent_index);
  }
}

  }
  else
  {
$proced = new \stdClass();
$proced->status  = "fail";
$proced->message = "";
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

public function Find()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->Find($id);
}
}
public function update()
{

if (isset($_POST['id'])&&isset($_POST['name'])) {
    $id    = $_POST['id'];
    $name  = $_POST['name'];

    $this->model->update($id,$name);
  }
  else
  {
$proced = new \stdClass();
$proced->status  = "fail";
$proced->message = "problem found,try again.";
$myJSON = json_encode($proced);
echo $myJSON;
  }


}

public function FindAuthor()
{
  $this->view->author = $this->model->FindAuthor();
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
<a title="remove"  href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" class="btn-del-cat"><span class="fa fa-minus-square-o pull-right"></span></a>
<a title="edit"  href="javascript:void(0)" data-toggle="modal" data-target="#update-category" data-id="<?php echo $data[$key]->id;?>" class="cat-btn-update"><span class="fa fa-edit pull-right"></span>
</a>
<a title="add new" href="javascript:void(0)" data-toggle="modal" data-target="#add-new" data-id="<?php echo $data[$key]->id;?>" data-parent="<?php echo $data[$key]->parent_id;?>" data-level="<?php echo $data[$key]->level;?>" class="btn-add-cat"><span class="fa fa-plus-square pull-right"></span>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
<div class="row">
<div class="col-lg-12">
<h3>LIST OF PRODUCT CATEGORIES</h3>
</div>
</div>
<div class="row">

<?php
if (isset($this->data)) {

$val = $this->data;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>

<div class="col-lg-4"> <div class="category-widget" id="row_<?php echo $data[$key]->id;?>">
<label class="full-width main-category"><span class="fa fa-navicon"></span> <?php echo $data[$key]->name; ?>
<a title="remove" href="javascript:void(0)" href="javascript:void(0)" data-id="<?php echo $data[$key]->id;?>" class="btn-del-cat"><span class="fa fa-minus-square-o pull-right"></span></a>
<a title="add new" href="javascript:void(0)" data-toggle="modal" data-target="#add-new" data-id="<?php echo $data[$key]->id;?>" data-parent="<?php echo $data[$key]->parent_id;?>" data-parindex="<?=$data[$key]->category_index;?>" data-level="<?php echo $data[$key]->level;?>" class="btn-add-cat"><span class="fa fa-plus-square pull-right"></span></a>
<a title="edit" href="javascript:void(0)" data-toggle="modal" data-target="#update-category" data-id="<?php echo $data[$key]->id;?>" class="cat-btn-update"><span class="fa fa-edit pull-right"></span></a>
</label>

<?php
if ($data[$key]->sub != 'none')
{
$dataa = $data[$key]->sub;
$controller->GetSubCategory($dataa);
}
?>

</div>
</div>

<?php
}
}
}
?>


</div>



</div>

<div class="floating-options">
<div href="" data-toggle="modal" data-target="#add-new" class="btn-add-new">+</div>
<a href="" data-lang="<?=LANG?>" id="category-copy"><div href="" class="btn-copy-new" title="Copy content to this language from default language"><i class="fa fa-copy"></i></div></a> 
</div>


</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>

<!-- ============================================================================== -->

<div id="add-new" class="modal fade" role="dialog">
  <div class="fadeIn category-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="form" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create new category</h4>
      </div>
      <div class="modal-body">


<form action="" method="post" id="add-new-form">

<div class="row">
<div class="col-lg-12">
<label >Name</label>
<input name="name" class="form-control" placeholder="Enter category name" required> <br>
<input id="parent-id" name="parent-id" value="" type="hidden">
<input id="level" name="level" value="" type="hidden">
<input id="parindex" name="parindex" value="" type="hidden">

<input type="submit" class="create-btn btn btn-sl btn-success" value="Create"><br>
<div class="notification"></div>
</div>
</div>

</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- ============================================================================== -->

<div id="update-category" class="modal fade" role="dialog">
  <div class="fadeIn category-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="form" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update category</h4>
      </div>
      <div class="modal-body">


<form action="" method="post" id="update-form">

<div class="row">
<div class="col-lg-12">
<label >Name</label>
<input id="category_name" name="name" class="form-control" value="" placeholder="Enter category name" required> <br>
<input id="category_id" name="id" value="" type="hidden">

<input type="submit" class="create-btn btn btn-sl btn-success" value="Update"><br>
<div class="notification2"></div>
</div>
</div>

</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

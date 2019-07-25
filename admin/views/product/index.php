  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
  

<div class="row">
<div class="col-lg-8">

<div class="row">


<?php
$val = $this->data;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    $number = $key;
    $number = $number+1;
?>

<div id="row_<?php echo $data[$key]->id;?>" class="col-lg-4 product-win">
<div class="product-col">
<div class="product-image" style="height: 200px;
background:#a76ba1 url('<?php echo URL;?>all-images/thumbnail/<?php  echo $data[$key]->img;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover; width:100%;">

<div class="product-content">
<p><?php  echo $data[$key]->product_name;?></p>
<span class="label label-primary"> $<?php  echo $data[$key]->Price; ?></span>
</div>

</div>
<div class="blog-option">
<a href="javascript:void(0)" data-toggle="modal" data-target="#product-update" data-id="<?php  echo $data[$key]->id;?>"  class="btn-update-product pull-left">
  <span class="product-btn-update">Update</span>
</a>
<a href="<?php echo LINK;?>productinfo/details/<?php  echo $data[$key]->id;?>/" data-id="<?php  echo $data[$key]->id;?>" class="product-more"><span class="product-btn-more"><span class="fa fa-plus-circle"></span> More</span></a>
<a href="javascript:void(0)" data-id="<?php  echo $data[$key]->id;?>" class="product-delete"><span class="product-btn-delete">Delete</span></a>
</div>
</div>
</div>

<?php
 } 
 }  
?>

</div>




</div>
<div class="col-lg-4">
<div class="aside-content">

<h3>
Add New product
    </h3>
<form action="" method="post" id="product-form">
<label >Product name</label>
<input name="name" class="form-control" placeholder="Enter product name" required> <br>

<div class="fill-width category-option">

<div class="category-frame">

<div class="row">
<div class="col-lg-12">
<h3>LIST OF PRODUCT CATEGORIES</h3>
</div>
</div>
<div class="row">

<?php
$val = $this->category;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
<div class="col-lg-12"> <div class="fill-width" id="row_<?php echo $data[$key]->id;?>">
<label class="full-width main-category"><span class="fa fa-navicon"></span> <?php echo $data[$key]->name; ?> 
<a href="javascript:void(0)"  class="pull-right btn-close-cat">
  <span class="fa fa-close"></span> close
</a> 

</label>

<?php
if ($data[$key]->sub != 'none') 
{
$dataa = $data[$key]->sub;
$controller->GetSubCategory($dataa);
}
else
{
  echo "No sub-category found";
} 
?>

</div>
<br><br>
</div>
<?php
}
}   
?>


</div>
</div>



  <a href="" id="select-cat-btn" class="select-btn">Select category</a> <br><br>

<label class="checked-input"><span class="category-lebel ">No category selected</span>
  <input name="category_id" type="checkbox" checked="checked" value="" id="category-id">
  <span class="checkmark"></span>
</label>

</div>

<br>

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="form">Upload product image</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview">
<input name="image-name" type="hidden" id = "logo-input" value="">
<br><br>
<label>Product Price</label>
<input name="price" class="form-control" placeholder="Enter Price" required> <br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Add new content"><br>
    <div class="notification"></div>
  </div>
  <div class="col-lg-6">

  </div>
</div>
</form>


</div>

</div>


</div>
  

<div class="floating-options">
<a href="" data-lang="<?=LANG?>" id="product-copy"><div href="" class="btn-copy-new" title="Copy content to this language from default language"><i class="fa fa-copy"></i></div></a> 
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>


<!-- ================================================================ -->


<div id="product-update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update this product content</h4>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="product-form-update">
<label >Product name</label>
<input name="name" id="product-name" class="form-control" placeholder="Enter car name" required> <br>
<input name="id" type="hidden" id ="product-id" value="">


<div class="fill-width category-option">

<div class="category-frame2">

<div class="row">
<div class="col-lg-12">
<h3>LIST OF PRODUCT CATEGORIES</h3>
</div>
</div>
<div class="row">

<?php
$val = $this->category;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
<div class="col-lg-12"> <div class="fill-width" id="row_<?php echo $data[$key]->id;?>">
<label class="full-width main-category"><span class="fa fa-navicon"></span> <?php echo $data[$key]->name; ?> 
<a href="javascript:void(0)"  class="pull-right btn-close-cat">
  <span class="fa fa-close"></span> close
</a> 

</label>

<?php
if ($data[$key]->sub != 'none') 
{
$dataa = $data[$key]->sub;
$controller->GetSubCategory2($dataa);
}
else
{
  echo "No sub-category found";
} 
?>

</div>
<br><br>
</div>
<?php
}
}   
?>


</div>
</div>



  <a href="" id="select-cat-btn2" class="select-btn">Update category</a> <br><br>

<label class="checked-input"><span class="category-lebel2">No category selected</span>
  <input name="category_id" type="checkbox" checked="checked" value="" id="category-id2">
  <span class="checkmark"></span>
</label>

</div>

<br>




<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="modal" >Update Product image</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview2">
<input name="image-name" type="hidden" id ="logo-input2" value="">
<br><br>
<label>Product Price</label>
<input name="price" id="product-price" class="form-control" placeholder="Enter Price" required> <br>

<div class="row">
  <div class="col-lg-12">
    <input type="submit" class="btn btn-sl btn-success" value="Update content"><br>
    <div class="notification2"></div>
  </div>
  <div class="col-lg-6">
    
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

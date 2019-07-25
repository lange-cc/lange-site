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
<p><?php  echo $data[$key]->name;?></p>
<span class="label label-primary"> $<?php  echo $data[$key]->price; ?></span>
</div>

</div>
<div class="blog-option">
<a href="javascript:void(0)" data-toggle="modal" data-target="#gift-update" data-id="<?php  echo $data[$key]->id;?>"  class="btn-update-product pull-left">
  <span class="product-btn-update">Update</span>
</a>
<a href="<?php echo LINK;?>giftinfo/details/<?php  echo $data[$key]->id;?>/" data-id="<?php  echo $data[$key]->id;?>" class="product-more"><span class="product-btn-more"><span class="fa fa-plus-circle"></span> More</span></a>
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
Add New giftbox
    </h3>
<form action="" method="post" id="gift-form">
<label >Box name</label>
<input name="name" class="form-control" placeholder="Enter giftbox name" required> <br>

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="form">Upload box image</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview">
<input name="image-name" type="hidden" id = "logo-input" value="">
<br><br>
<label>Box Price</label>
<input name="price" class="form-control" placeholder="Enter Price" required> <br>

<div class="row">
  <div class="col-lg-12">
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
  

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>


<!-- ================================================================ -->


<div id="gift-update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update this giftbox content</h4>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="gift-form-update">
<label >Gift name</label>
<input name="name" id="gift-name" class="form-control" placeholder="Enter car name" required> <br>
<input name="id" type="hidden" id ="gift-id" value="">


<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="modal" >Update Gift image</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview2">
<input name="image-name" type="hidden" id ="logo-input2" value="">
<br><br>
<label>Product Price</label>
<input name="price" id="gift-price" class="form-control" placeholder="Enter Price" required> <br>

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
  

<div class="row">
<div class="col-lg-9">

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
<?php if (IDSTATUS == 'true') { echo " ".'[index='.$data[$key]->index.']'; } ?>
<a href="<?php echo LINK;?>additems/index/<?php  echo $data[$key]->index;?>/" class="img-btn-add-new" title="Add images">+</a>  

<div class="product-image" style="height: 200px;
background:#fff url('<?php echo ADMINURL;?>images/pictures-folder.png');
background-repeat: no-repeat;
background-position: center center;
background-size: cover; width:100%;">

<div class="product-content">
<p><?php  echo $data[$key]->name;?></p>

<span class="label label-warning"> <?php  echo $data[$key]->items_number;?> items</span>
</div>

</div>
<div class="blog-option">
<a href="javascript:void(0)" data-toggle="modal" data-target="#product-update" data-id="<?php  echo $data[$key]->id;?>"  class="btn-xs btn-update-folder pull-left"><span class="blog-btn-update">Update</span></a>
<a href="javascript:void(0)" data-id="<?php  echo $data[$key]->id;?>" class="folder-delete pull-right"><span class="btn-xs blog-btn-delete">Delete</span></a>
</div>
</div>
</div>

<?php
 } 
 }  
?>

</div>




</div>
<div class="col-lg-3">
<div class="aside-content">

<h3>
Create new folder
    </h3>
<form action="" method="post" id="folder-form">
<label >Folder name</label>
<input name="name" class="form-control" placeholder="Enter folder name" required> <br>

<label>Folder Description</label>
<textarea name="content" class="form-control" placeholder="Enter Description" required></textarea><br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Create folder"><br>
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


<div id="product-update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Folder</h4>
        <i class="fa fa-spinner fa-spin progress-spin"></i>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="folder-form-update">
<label >Folder name</label>
<input name="name" id="folder-name" class="form-control" placeholder="Enter car name" required> <br>
<input name="id" type="hidden" id="folder-id" value="">

<label>Folder Description</label>
<textarea name="content" id="folder-content" class="form-control" placeholder="Enter Price" required></textarea> <br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Update Folder"><br>
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

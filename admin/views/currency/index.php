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
?>

<div class="col-lg-4" id="row_<?=$data[$key]->id;?>">
  <div class="language-widget">
<div class="language-name">
 <span class="fa fa-money"></span> <?=$data[$key]->name;?>

</div>
<div class="language-details">
 <span class="fa fa-info-circle"></span> <?=$data[$key]->logo?> / <span class="fa fa-rocket"></span> <?=$data[$key]->rates?>
</div>
<div class="language-option">
 <ul>
<li><a href="javascript:void(0)" data-id="<?=$data[$key]->id;?>" class="update" title="Update language" data-toggle="modal" data-target="#language-update" ><span class="fa fa-pencil-square"></span></a></li>
<li><a href="javascript:void(0)" data-id="<?=$data[$key]->id;?>" class="delete" title="Delete language"><span class="fa fa-eraser"></span></a></li>
 </ul>
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
Add New Currency
    </h3>
<form action="" method="post" id="currency-form">
<label>Currency name</label>
<input name="name" class="form-control" placeholder="Enter Currency name" required> <br>

<label>Currency logo</label>
<input name="logo" class="form-control" placeholder="Enter Currency logo" required> <br>

<label>Rates</label>
<input name="rates" class="form-control" placeholder="Enter Currency Rates" required> <br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Add new currency"><br>
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


<div id="language-update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Currency details</h4>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="update-currency-form">
<label>Currency name</label>
<input name="name" id="name" class="form-control" placeholder="Enter Currency name" required> <br>
<input name="id"   id="id" type="hidden" value="">
<label>Currency logo</label>
<input name="logo"  id="logo" class="form-control" placeholder="Enter Currency logo" required> <br>

<label>Rates</label>
<input name="rates" id="rates" class="form-control" placeholder="Enter Currency Rates" required> <br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Update currency"><br>
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

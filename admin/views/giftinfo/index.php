

<?php
$val = $this->gift;
$val;

if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>

<div class="content-wrapper">
<section class="content">
  
<div class="row">

<div class="col-lg-7">
  <div class="widget">
<form action="" method="POST" id="gift-add-content-form">
  <input name="id" type="hidden" value="<?=$data[$key]->id;?>">


<div class="row">
<div class="col-lg-12">
<label>Giftbox description</label>
<textarea class="txtEditor" name="content"><?=$data[$key]->content ;?></textarea>
<br>
<br>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<input name="" type="submit" class="btn-save" value="Save">
</div>
<div class="col-lg-12">
<p class="notification"></p>
</div>
</div>

</form>
</div>
</div>

<input id="gift_index" type="hidden" value="<?=$data[$key]->index ;?>">
<?php
}
}
?>
<div class="col-lg-1">

</div>


</div>
</section>
  
</div>
<div class="gift-panel">
<br><br>

  <ul class="nav nav-tabs nav-justified" >
    <li class="active"><a data-toggle="tab" href="#home" style="color:#000;">Join new</a></li>
    <li><a data-toggle="tab" href="#menu1" style="color:#000;">Existing product</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      
<div class="fill-width widget-title">
<label>Join product to giftBox</label>
 <br>
 </div>
<div class="widget">
<?php
$val = $this->product;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>

<div class="row product-item">
<div class="col-lg-3">
<div class="widget-img" style="background:#000 url('<?php echo URL;?>all-images/thumbnail/<?php echo $data[$key]->img;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover;"></div>
</div>
<div class="col-lg-5">
<label><?php echo $data[$key]->product_name;?></label>
<br>
<p>$<?php echo $data[$key]->price;?></p>
</div>
<div class="col-lg-4">
  <label>
    <a href="" class="join-btn" data-id="<?php echo $data[$key]->id;?>">
      <span class="fa fa-gift"></span> Join
    </a>
  </label>
  <p class="join-status" id="join-status_<?php echo $data[$key]->id;?>">

  </p>
</div>
</div>
<?php
 } 
 }  
?>
</div>


    </div>
<div id="menu1" class="tab-pane fade">
    
<div class="fill-width widget-title">
<label>Product in giftbox</label>
 <br>
 </div>
<div class="widget">
<?php
$val = $this->productofgift;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>

<div class="row product-item" id="row_<?php echo $data[$key]->id;?>">
<div class="col-lg-3">
<div class="widget-img" style="background:#000 url('<?php echo URL;?>all-images/thumbnail/<?php echo $data[$key]->img;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover;"></div>
</div>
<div class="col-lg-5">
<label><?php echo $data[$key]->product_name;?></label>
<br>
<p>$<?php echo $data[$key]->price;?></p>
</div>
<div class="col-lg-4">
  <label>
    <a href="" class="remove-btn" data-id="<?php echo $data[$key]->id;?>">
      <span class="fa fa-close"></span> remove
    </a>
  </label>
  <p class="join-status" id="join-status_<?php echo $data[$key]->id;?>">

  </p>
</div>
</div>
<?php
 } 
 }  
?>
<br><br>
</div>

</div>
</div>

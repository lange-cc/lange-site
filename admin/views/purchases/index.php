  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

<div class="row">
<div class="col-lg-6">   
<div class="row">

<?php
$val = $this->purchases;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>

<div class="col-lg-6" id="row_<?php echo $data[$key]->id; ?>">
    <div class="purchase-widget">
        <div class="row no-margin purchase-title-bar">
    <strong class="pull-left"><span class="fa fa-user"></span>
     <?php
     if(isset($data[$key]->fname) && isset($data[$key]->lname))
     {
     echo $data[$key]->fname.' '.$data[$key]->lname;
     }
     else
     {
         echo 'No Name';
     }
    ?>
    
    </strong>
    <p class="pull-right text-right"><?php echo $data[$key]->status; ?> </p>
</div>
<div class="row no-margin">
    <strong class="pull-left">Product: </strong>
    <p class="pull-right text-right"><?php echo $data[$key]->pro_number; ?></p>
</div>
<div class="row no-margin">
    <strong class="pull-left">Gift: </strong>
    <p class="pull-right text-right"><?php echo $data[$key]->gift_number; ?></p>
</div>
<div class="row no-margin">
    <p class="pull-left" ><?php echo date('M j Y g:i A', strtotime($data[$key]->date)); ?></p>
    <p class="pull-right text-right">Total: $<?php echo $data[$key]->total; ?></p>
</div>
<div class="row no-margin">
    <a href='javascript:void(0)' class="pull-left select-btn"      data-id="<?php echo $data[$key]->id; ?>">View</a>
    <a href='javascript:void(0)' class="pull-right btn btn-delete" data-id="<?php echo $data[$key]->id; ?>">delete</a>
</div>

</div>
</div>
<?php
}}
?>





</div>
</div>
</div>


<div class="purchase-preview">
    <center class="item-center">
        <img style="display:none;" id="loading" src="<?=ADMINURL?>images/loading4.gif" width="300">
</center>
<div class="purchase-widget" style="display:none;" id="purchase-widget">
<div class="row no-margin purchase-title-bar">
<strong class="pull-left"><span class="fa fa-user"></span>
<span class="names"></span>   
<p class="date"> </p>
<p class="status"> </p>
</strong>
<p class="pull-right text-right der-notification">Not accepted</p>
<a class="accept-btn" data-id="" href="">Comfirm</a>
</div>
<br>

<div class="row no-margin">
<div class="col-lg-6">
  <div class="row preview-purchase-title-bar">
 Client information
  </div>

   
  <label>Name:</label><br>
  <p class="client-names">
 </p>
  <label>Location:</label><br>
  <p class="client-location">
  </p>

  <label>Zip:</label><br>
  <p class="client-zip">
  </p>

  <label>City:</label><br>
  <p class="client-City">
  </p>
  
  <label>Phone:</label><br>
  <p class="client-phone">
  </p>
  
  <label>Email:</label><br>
  <p class="client-email">
  </p>
   
</div>


<div class="col-lg-6">
  <div class="row preview-purchase-title-bar">
 Delivery information
  </div>
  
  <label>Name:</label><br>
   <p class="names">
  </p>
   <label>Location:</label><br>
   <p class="location">
   </p>

   <label>City:</label><br>
   <p class="city">
   </p>

   <label>Phone:</label><br>
   <p class="phone">
   </p>
   
   <label>Road:</label><br>
   <p class="road">
   </p>
   
   <label>Information:</label><br>
   <p class="infor">
   </p>

</div>
</div>
<hr>
<div class="row text-center preview-purchase-title-bar">
    <div class="col-lg-12">
 Product to deliver
</div>
  </div><br>
<div class="row" id="product-preview">

    <!-- <div class="col-lg-4 der-product-widget">
        <div style="background: #99cc33 url('');
               background-repeat: no-repeat;
               background-position: center center;
               background-origin: content-box;
               width:100%;
               height: 150px;
               background-size: contain;"></div>
               <div class="quantity">4</div>
               <div class="product-name">
                   Papa Gift
               </div>
               <div class="total-price">
                  Total: $50
              </div>
</div> -->



</div>
<hr>
<div class="row text-center preview-purchase-title-bar">
    <div class="col-lg-12">
 Client code
</div>
  </div>
  <h3 class="code text-center">
  </h3>
<hr>
<div class="row text-center preview-purchase-title-bar">
    <div class="col-lg-12">
 Total Amount
</div>
  </div>
  <h3 class="total text-center">
  </h3>



    </div>
</div>

    </section>
</div>


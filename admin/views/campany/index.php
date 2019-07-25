  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
   
<div class="row">
<div class="col-lg-8">

<?php
$val = $this->accounts;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) 
{
    $number = $key;
    $number = $number+1;
?>
<div class="row" style="border-left: 6px solid #000;background:#f6f6f6;margin-left:8px">
<div class="year-project-title">
 Clients accounts in <?=$data[$key]->year?> <a href="javascript:void(0)" data-year="<?=$data[$key]->year?>" data-toggle="modal" data-target="#add-account"  class="org_add_account-btn">+</a>
</div>


<?php
 $account = $data[$key]->accounts; 
 if ($account != null) {
 foreach ($account as $keyy => $value) 
{
?>

<div class="col-lg-6" id="row_<?=$account[$key]->id?>">
   <div class="account-widget" style="background:#fff">
     <div class="account-ribbon">
      <span class="pull-left"><span class="fa fa-archive"></span> <?=$account[$keyy]->name?></span> 
      <span class="pull-right" style="font-size: 11px;"> <span class="fa fa-clock-o"></span> Started on <?=date('M j Y g:i A', strtotime($account[$keyy]->date))?></span>
     </div>
<?php
 $profile = $account[$keyy]->profile; 
 if ($profile != null) {
 foreach ($profile as $key1 => $value) 
{
?>
     <div class="who-posted-account">
      <p class="text-center">Added by <?=$profile[$key1]->name?></p>
       <img src="<?php echo URL;?>all-images/thumbnail/<?=$profile[$key1]->logo?>" class="user-image" alt="User Image">
     </div>

<?php
}
}
?>
  

     <div class="account-option">
<div class="accc-add-more-btn">
  <a href="<?=LINK?>campany/view/<?=$account[$keyy]->id?>/"><span class="fa fa-folder-o"></span> View more</a>
</div>
<div class="accc-del-more-btn">
  <a href="" data-id="<?=$account[$keyy]->id?>" class="delete"><span class="fa fa-trash"></span> Delete</a>
</div>
<!-- <div class="report-btn">
   <a href=""><span class="fa fa-newspaper-o"></span> View report</a>
</div> -->
     </div>
   </div>
</div>
<?php
 }
}
else
{
  echo "<div class='text-center'>No any project/client available</div>";
}
?>

</div>

<?php
 } 
 }  
?>











</div>

<div class="col-lg-4">
  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
</div>
</div>
  
<div class="floating-options">
<a href="javascript:void(0)" title="add year" data-toggle="modal" data-target="#add-years"><div  class="btn-add-new">+</div></a>
</div>

</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<div id="add-account" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add account</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="add-accounts-form">
<label>Account name</label>
<input name="name" class="form-control" placeholder="Enter Account Name"  required> <br>
<label>Account Definition</label>
<textarea name="content" class="form-control" placeholder="Account description"  class="form-control" required></textarea> <br>
<input name="user" type="hidden" value="<?=$this->user_id;?>" >
<input name="year" type="hidden" value="" id="year-input">


<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Save account">
  </div>
  <div class="col-lg-6">
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



<div id="add-years" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add year</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="add-year-form">
<label>Add year</label>
<input name="yyy" class="form-control" placeholder="Enter number of year" required> <br>


<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Add year">
  </div>
  <div class="col-lg-6">
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




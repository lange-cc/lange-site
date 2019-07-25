
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">


<div class="row">
  <div class="col-lg-12">
   <div class="year-project-title">
 All billings history<!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#add-billing"  class="org_add_account-btn">+</a> -->
  </div>
  <table class="table table-striped">
  <tr>
<th></th>
<th>Client</th>
<th>Activity name</th>
<th>Date</th>
<th>Spent</th>
<th>Income</th>
<th></th>
<th></th>
  </tr>

  <?php
$spend = 0;
$income = 0;
$val = $this->billing;
//echo $val;
if (!empty($val)) {
$bill = json_decode($val);
foreach ($bill as $key => $value) 
{
    $number = $key;
    $number = $number+1;
?>
  <tr id="row_<?=$bill[$key]->id?>">
<td><?=$number?></td>
<td><?=$bill[$key]->client?></td>
<td><?=$bill[$key]->name?></td>
<td><?=date('M j Y g:i A', strtotime($bill[$key]->date))?></td>
<td>FRW <?=$bill[$key]->spent?></td>
<td>FRW <?=$bill[$key]->income?></td>
<?php
$spend  = $spend+$bill[$key]->spent;
$income = $income+$bill[$key]->income;
?>


<td><a href="" class="btn btn-update update" data-id="<?=$bill[$key]->id?>" data-toggle="modal" data-target="#update-billing">Update</a></td>
<td><a href="" class="btn btn-delete delete" data-id="<?=$bill[$key]->id?>">Delete</a></td>
  </tr>
<?php
}}
else
{
	echo "<p class='center'>no today s' billings</p>";
}
?>
  <tr>
<th></th>
<th>TOTAL</th>
<th></th>
<th></th>
<th>FRW <?=$spend?></th>
<th>FRW <?=$income?></th>
<th></th>
<th></th>
  </tr>
  </table>



  </div>
</div>


  </section>
    <!-- /.content -->
  </div>


  <div id="add-billing" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Billings</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="add-billings-form">
<label>Activity</label>
<input name="activity" class="form-control" placeholder="Tell us your activity" required> <br>
<label>Spending (FRW)</label>
<input name="spend" class="form-control" placeholder="Enter Spendings" type="number" required> <br>
<label>Income (FRW)</label>
<input name="income" class="form-control" placeholder="Enter income" type="number" required> <br>
<input name="account" type="hidden" value="<?=$this->user_id?>" >

<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Save">
  </div>
  <div class="col-lg-6">
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




<div id="update-billing" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update This Billings</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="update-billings-form">
  <label>Update client:</label> Currently(<span class="Currently"></span>)
<select name="client" class="form-control">
  <option value="" id="client-input">Currently</option>
 <?php
$val = $this->project;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
        <option value="<?=$data[$key]->id?>"><?=$data[$key]->name?></option>
<?php
}}
?>
</select>
<label>Activity</label>
<input name="activity" id="activity" class="form-control" placeholder="Tell us your activity" required> <br>
<label>Spending (FRW)</label>
<input name="spend" id="spend"  class="form-control" placeholder="Enter Spendings" type="number" required> <br>
<label>Income (FRW)</label>
<input name="income" id="income" class="form-control" placeholder="Enter income" type="number" required> <br>
<input name="id" id="id" type="hidden" value="" >

<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Update">
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


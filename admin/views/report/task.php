<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">
<div class="row">

<div class="col-lg-12">
 <div class="report-search-report">
<div class="report-ribon">
    <p>Genelate report for task</p>
</div> 
<br>
 <div class="row">
    <form id="search">
<div class="col-lg-3">
    <label>Select user</label>
    <select name="user" class="form-control">
      <option value="all">All</option>
  <?php
$val = $this->account;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
  <option value="<?=$data[$key]->id?>"><?=$data[$key]->name?></option>
<?php
}}
?>
    </select>
</div>

<div class="col-lg-3">
    <label>Select date(Month)</label>
    <select name="mm" class="form-control">
        <option value="today">today</option>
        <option value="yest">Yesterday</option>
        <?php
          $i = 01;
          while ( $i <= 12) {
        ?>
        <option value="<?=$i?>"><?=date('F', mktime(0, 0, 0, $i, 10))?></option>
        <?php
          $i++;
         }
        ?>
    </select>
</div>

<div class="col-lg-3">
    <label>Select year</label>
    <select name="yyy" class="form-control">
        <?php
          $i = date('Y');
          while ( $i >= 2018) {
        ?>
        <option value="<?=$i?>"><?=$i?></option>
         <?php
          $i--;
         }
        ?>
    </select>
</div>

<div class="col-lg-3">
    <br>
  <button type="submit" class="btn btn-report">View report</button>
</div>
 </form>
</div>


</div>
</div>




<div class="col-lg-12" style="margin-top:20px;">
 <div class="report-search-report  report">
<div class="report-ribon">
    <span class="">Report</span>
    <span class="pull-right notification"></span>
</div> 
<br>

<table class="table table-striped">
 <tr>
  <th>Date</th>
  <th>Project</th>
  <th>Task</th>
  <th>Status</th>
 </tr>
<tbody id="tabledata">

</tbody>
</table>



</div>
</div>


</div>
</section>
</div>
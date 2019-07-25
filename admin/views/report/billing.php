<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">
<div class="row">

<div class="col-lg-12">
 <div class="report-search-report">
<div class="report-ribon">
    <p>Genelate report for billing</p>
</div> 
<br>
 <div class="row">
    <form id="search-billing">


<div class="col-lg-3">
    <label>Select date(Month)</label>
    <select name="mm" class="form-control">
      <option value="0000">All</option>
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
          while ( $i >=2018 ) {
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
  <th>Client</th>
  <th>Date</th>
  <th>Task name</th>
  <th>spent</th>
  <th>income</th>
 </tr>
<tbody id="tabledata">

</tbody>
</table>



</div>
</div>


</div>
</section>
</div>
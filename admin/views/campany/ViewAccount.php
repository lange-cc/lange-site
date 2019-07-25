  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
<section class="content">

 <div class="nav-tabs-custom">
            
  <div class="tab-content" style="background:#f6f6f6">
        <div class="active tab-pane" id="activity">
                  
  <?php
$val = $this->getaccount;
//echo $val;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $account_key => $value) 
{
    $number = $account_key;
    $number = $number+1;
?>
<div class="row" id="row_<?=$data[$account_key]->id?>">
      <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=date('M j Y g:i A', strtotime($data[$account_key]->date))?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-archive bg-blue"></i>

              <div class="timeline-item">
                <span class="time"></span>

                <h3 class="timeline-header"><?=$data[$account_key]->name?></h3>

                <div class="timeline-body">
                 <?=$data[$account_key]->content?>
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs account-update" data-id="<?=$data[$account_key]->id?>" data-toggle="modal" data-target="#update-account">Update</a>
                  <a class="btn btn-danger btn-xs delete" data-id="<?=$data[$account_key]->id?>" >Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> on <?=date('M j Y g:i A', strtotime($data[$account_key]->date))?></span>
<?php
 $profile = $data[$account_key]->profile; 
 if ($profile != null) {
 foreach ($profile as $key => $value) 
{
?>
                <h3 class="timeline-header no-border"><img src="<?php echo URL;?>all-images/thumbnail/<?=$profile[$key]->logo?>" class="account-user-image" alt="User Image"> <?=$profile[$key]->name?> Created this account</h3>

      <?php
}
}
?>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>
    <?php
 $activity = $data[$account_key]->activity; 
 if ($activity != null) {
 foreach ($activity as $keyy => $value) 
{
?>
              

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=date('M j Y g:i A', strtotime($activity[$keyy]->date))?></span>
<?php
 $act_profile = $activity[$keyy]->profile; 
 if ($act_profile != null) {
 foreach ($act_profile as $key3 => $value) 
{
?>
                <h3 class="timeline-header"><img src="<?php echo URL;?>all-images/thumbnail/<?=$act_profile[$key3]->logo?>" class="account-user-image" alt="User Image"> <?=$act_profile[$key3]->name?> Added an activity on this Account</h3>
<?php
}
}
?>
                <div class="timeline-body timeline-header" >
                  <?=$activity[$keyy]->content?><br><br>
                   <a class="btn btn-primary btn-xs activity-update" data-id="<?=$activity[$keyy]->id?>" data-toggle="modal" data-target="#update-activity">Update</a>
                </div>


                <div class="timeline-footer">
                  <form action="" method=""  class="comment-form">
                    <img src="<?php echo URL;?>all-images/thumbnail/<?php echo $profile_img;?>" class="">
                    <input name="user" type="hidden" value="<?=$this->user_id;?>">
                    <input name="activity" type="hidden" value="<?=$activity[$keyy]->id?>">
                    <textarea class="form-control comment-textarea" name="comment" placeholder="Leave comment here"></textarea><br>
                    <span>
                    <button type="submit" class="btn btn-omment">Comment</button>
                    <p class="sms"></p>
                    </span>
                  </form>
                </div>
                 <div class="timeline-footer">
                  <ul class="comment-list" id="account-comment_<?=$activity[$keyy]->id?>">

                    <?php
 $comment = $activity[$keyy]->comment; 
 if ($comment != null) {
 foreach ($comment as $key1 => $value) 
{
?>
                    <li>
                       <div>
                         <span class="pull-right time"><i class="fa fa-clock-o"></i> <?=date('M j Y g:i A', strtotime($comment[$key1]->date))?></span>
             <?php
 $comment_profile = $comment[$key1]->profile; 
 if ($comment_profile != null) {
 foreach ($comment_profile as $key2 => $value) 
{
?>
        <label><img src="<?php echo URL;?>all-images/thumbnail/<?=$comment_profile[$key2]->logo?>" class="comment-user-profile"> <?=$comment_profile[$key2]->name?></label>
<?php
}
}
?>
                          <p><?=$comment[$key1]->content?></p>
                       </div>
                    </li>
<?php
}
}
else
{
  echo "<li class='no-comment'><div><p>No comment found</p></div></li>";
}
?>
                  </ul>

                </div>
              </div>

      <?php
}
}
?>

          <div class="timeline-item ">
<a href="" data-toggle="modal" data-target="#add-activity" class="btn btn-add-activity">Add activity</a>
          </div>

            </li>
            <!-- END timeline item -->
         
          </ul>
        </div>


</div>
<?php
}}
?>
              </div>

           

         </div>
</div>

</section>
</div>
  <!-- /.content-wrapper -->




<div id="add-activity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add activity</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="add-activity-form">
<label>What did you do on this account?</label>
<textarea name="content" class="form-control" placeholder="Enter your Answer"  class="form-control" required></textarea> <br>
<input name="user" type="hidden" value="<?=$this->user_id;?>">
<input name="account" type="hidden" value="<?=$data[$key]->id?>" >
<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Save">
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
<label>Spending</label>
<input name="spend" class="form-control" placeholder="Enter Spendings" required> <br>
<label>Income</label>
<input name="income" class="form-control" placeholder="Enter income" required> <br>
<input name="account" type="hidden" value="<?=$this->account_id?>" >

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



<div id="update-account" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update this account</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="update-account-form">
<label>Account name</label>
<input name="name" class="form-control" placeholder="Enter Account Name" value="" id="account-name" required> <br>
<label>Account Definition</label>
<textarea name="content" class="form-control" placeholder="Account description" value="" id="account-content" class="form-control" required></textarea> <br>
<input name="id" type="hidden" value="" id="account_id">

<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Update">
  </div>
  <div class="col-lg-6">
    <div class="account-notification"></div>
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


<div id="update-activity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update this activity</h4>
      </div>
      <div class="modal-body">
  
<form action="#" method="post" id="update-activity-form">
<label>Update your activity</label>
<textarea name="content" class="form-control" placeholder="Activity" value="" id="activity-content" class="form-control" required></textarea> <br>
<input name="id" type="hidden" value="" id="activity_id">

<div class="row">
  <div class="col-lg-6">
    <input type="submit"  class="btn btn-sl btn-success" value="Update">
  </div>
  <div class="col-lg-6">
    <div class="activity-notification"></div>
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

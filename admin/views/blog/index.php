  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
<div class="row">


<?php
$val = $this->data;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    $number = $key;
    $number = $number+1;
?>

<div class="col-lg-4" id="row_<?php echo $data[$key]->id;?>">
<div class="blog-post">
<div class="blog-image" style="height: 220px;
background:#000 url('<?php echo URL;?>all-images/thumbnail/<?php echo $data[$key]->logo;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover;">

<span class="badge pull-left"><?php echo $data[$key]->comment_number;?> comments</span>
<span class="badge pull-right"><?php echo $data[$key]->views;?> views</span>

</div>

<img src="<?php echo URL;?>all-images/thumbnail/<?php echo $data[$key]->author;?>" class="autho-logo">

<div class="blog-content">
<h4 style="margin-top: 0px;"><?php echo $data[$key]->Title;?></h4>
<p><?php echo $this->CutText(100,$data[$key]->content);?></p>
<span class="author-descr">By <?php echo $data[$key]->author_name;?> - <?php echo $data[$key]->added_date;?></span>  

</div>

<div class="blog-option">
<a href="javascript:void(0)" data-toggle="modal" data-target="#post-update" data-id="<?php  echo $data[$key]->id;?>" class="btn-update-post pull-left"><span class="blog-btn-update">Update</span></a>
<a href="javascript:void(0)" data-id="<?php  echo $data[$key]->id;?>" class="post-delete pull-right"><span class="blog-btn-delete">Delete</span></a>
</div>
</div>
</div>

<?php
 } 
 }  
?>





</div>
 
<div class="floating-options">
<div href="" data-toggle="modal" data-target="#new-post-modal" class="btn-add-new">+</div>
<a href="" data-lang="<?=LANG?>" id="blog-copy"><div href="" class="btn-copy-new" title="Copy content to this language from default language"><i class="fa fa-copy"></i></div></a> 
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>





<div id="new-post-modal" class="modal fade" role="dialog">
  <div class="fadeIn blog-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="form">&times;</button>
        <h4 class="modal-title">Add new blog post content</h4>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="post-form">
<div class="row">
<div class="col-lg-5">

<label >Post Title</label>
<input name="title"  class="form-control" placeholder="Enter Post Title" required> <br>
<input name="id" type="hidden"  value="">

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="form" >Add Post Logo</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview">
<input name="image-name" type="hidden"  value="" id="logo-input">
<br><br>
<label>Change author</label>
<select name="author" class="form-control">
<?php
$val = $this->author;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    $number = $key;
    $number = $number+1;
?>
<option value="<?php echo $data[$key]->id;?>"><?php echo $data[$key]->name;?></option>
<?php
 } 
 }  
?>

</select>
<br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="save content"><br>
    <div class="notification"></div>
  </div>
  <div class="col-lg-6">
    
  </div>
</div>


</div>
<div class="col-lg-7">

<textarea class="txtEditor" name="content"  placeholder="Enter your content" style="height:400px;"></textarea>


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

<!-- ================================================================ -->

<div id="post-update" class="modal fade" role="dialog">
  <div class="fadeIn blog-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update This Blog Post Content</h4>
      </div>
      <div class="modal-body">
        

<form action="" method="post" id="post-form-update">

<div class="row">
<div class="col-lg-5">

<label >Post Title</label>
<input name="title" id="post-title" class="form-control" placeholder="Enter Post Title" required> <br>
<input name="id" type="hidden" id ="post-id" value="">

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="modal" >Change Post Logo</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview2">
<input name="image-name" type="hidden" id ="logo-input2" value="">
<br><br>
<label>Select author(Now is <span id="author"></span>)</label>
<select name="author" class="form-control">
<?php
$val = $this->author;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    $number = $key;
    $number = $number+1;
?>
<option value="<?php echo $data[$key]->id;?>"><?php echo $data[$key]->name;?></option>
<?php
 } 
 }  
?>
</select>
<br>

<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Update content"><br>
    <div class="notification2">
    </div>
  </div>
  <div class="col-lg-6">
    
  </div>
</div>


</div>
<div class="col-lg-7">

<textarea id="post-content" class="txtEditor" name="content"  placeholder="Enter your content" style="height:400px;"></textarea>


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

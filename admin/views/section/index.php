  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
  

<div class="row">
<div class="col-lg-8">

<table class="table table-striped table-content">
<thead>
<tr>
  <th width="15%"></th>
  <th width="40%">Section Name</th>
  <th width="70%">Discription</th>
  <th></th><th></th><th> </th>
</tr>
</thead>
<tbody id="data">
  <?php
$val = $this->data;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    $number = $key;
    $number = $number+1;
?>
<tr id="row_<?php echo $data[$key]->section_index;?>">
<td class="numbering"><?php  echo $number; ?> <?php if (IDSTATUS == 'true') { echo '[id='.$data[$key]->id.']'; } ?></td>
<td><span class="fa fa-archive"></span> <?php  echo $data[$key]->title;?></td>
<td>
    <?php  echo $data[$key]->discription ;?>
</td>
<td><a href="javascript:void(0)" data-id="<?php  echo $data[$key]->id;?>" class="view-section btn-view">View</a></td>
<td><a href="javascript:void(0)" data-id="<?php  echo $data[$key]->id;?>" class="btn-update-section btn-update">Update</a></td>
<td><a href="javascript:void(0)" data-link="<?php  echo $data[$key]->section_index;?>" class="content-delete btn-delete">Delete</a></td>
</tr>

<tr>
<td colspan="6">
  <br>
    <a href="" data-title="<?php  echo $data[$key]->title;?>" data-index="<?php  echo $data[$key]->section_index;?>" class="add-article">Add new Article</a>
    <br>  <br>  
<div class="row">
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
<div class="fadeIn col-lg-6" id="row_art_<?php echo $article[$key]->id;?>">
<div class="row article-li">
<div class="col-lg-3 padding-left-on-row">
<div style="background: transparent url('<?php $controller->checkimg(URL."all-images/thumbnail/".$article[$key]->logo,$article[$key]->logo);?>');
               background-repeat: no-repeat;
               background-position: center center;
               width:100%;
               height: 130px;
               background-size: cover;">

</div>

</div>
<div class="col-lg-9">
<h4><span class="fa fa-file-word-o"></span> <?php echo $this->CutText(19,$article[$key]->title);?></h4>
<p><?php  echo $this->CutText(85,$article[$key]->content);?></p>
<a href="javascript:void(0)" data-id="<?php echo $article[$key]->id;?>" class="btn-article-read btn btn-xs btn-success">View</a>
<a href="javascript:void(0)" data-id="<?php echo $article[$key]->id;?>" class="btn-article-upadete btn btn-xs btn-primary">Update</a>
<a href="javascript:void(0)" data-id="<?php echo $article[$key]->id;?>" class="btn btn-xs btn-danger btn-article-delete">Delete</a>
</div>
</div>
</div>

<?php
}
?>

</div>


</td>
</tr>

<?php
 } 
 }  
?>




</tbody>

</table>

</div>
<div class="col-lg-4">
<div class="aside-content">




</div>

</div>


</div>
  

    </section>


<div class="floating-options">
<div href="" id="show"  class="btn-add-new" title="Add new content">+</div>

</div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>

<div class="right-sidebar2">
<h3 class="white">
Create new Section
    </h3>
<form action="" method="post" id="content-form">
<label class="white">Section title</label>
<input name="title" class="form-control" placeholder="Enter type" required> <br>
<input name="id" value="<?php echo $this->id; ?>" type="hidden" required id="id">
<label class="white">Section Description</label>
<textarea name="content" class="form-control" placeholder="Enter type" required></textarea>
<br>
<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" value="Add new content">
  </div>
  <div class="col-lg-6">
    <a href="#" class="hidenow btn btn-sl btn-danger">Cancel</a>
  </div>
</div>
</form>

</div>


<div class="article-aside">

  <h3 class="white">
Create new Article on(<b class="article-section"></b>)  
 <a href="#" class="pull-right hidearticle-aside btn btn-sl btn-danger">Cancel</a>
    </h3> 

<form action="<?php echo LINK;?>admin/section/addArticle/" method="post" id="article-form" enctype="multipart/form-data">
<label class="white">Title</label>
<input name="title" class="form-control" placeholder="Enter title" required> <br>
<label class="white">Sub Title</label>
<input name="sub-title" class="form-control" placeholder="Enter Sub title" required> <br>

<input name="section_index" type="hidden" value="" id="section_index_input" required>

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="form">Upload logo</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview">
<input name="image-name" type="hidden" id="logo-input" value="">
<br><br>

<label class="white">Article content</label>

<textarea id="txtEditor" name="content"  placeholder="Enter your content" style="height:500px;"></textarea>
<br>
<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" id="form-btn-save" value="Add new content">
  </div>
  <div class="col-lg-6">
    
  </div>
  <div class="col-lg-12">
    <div class="white" id="msg-notification"></div>
  </div>
</div>
<br><br><br><br>
</form>

</div>

<!-- ==================================================================== -->

<div class="article-update-sidebar">

<form action="<?php echo LINK;?>admin/section/UpdateArticle/" method="post" id="article-update-form" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-5">
<label class="white">Title</label>
<input name="title" class="title form-control" placeholder="Enter title" required> <br>
<label class="white">Sub Title</label>
<input name="sub-title" class="sub-title form-control" placeholder="Enter Sub title" required> <br>

<input name="id" type="hidden" value="" id="article_id" required>

<a href="javascript:void(0)" class="btn btn-sl btn-success upload-btn" data-type="modal">Change logo</a><br><br>
<img src="<?php echo ADMINURL; ?>images/no-image.png" width="250" id="logo-preview2">
<input name="image-name" type="hidden" id="logo-input2" value="">
<br><br>
<hr>
<div class="row">
  <div class="col-lg-6">
    <input type="submit" class="btn btn-sl btn-success" id="form-btn-save" value="Update this content">
  </div>
  <div class="col-lg-6">
     <a href="#" class="btn btn-danger btn-sl close-article-update"><i class="fa fa-power-off"></i> Close</a>
  </div>
  <div class="col-lg-12">
    <div class="white" id="article-msg"></div>
  </div>
</div>
<hr>
</div>

<div class="col-lg-7">

<textarea name="content"  class="txtEditor" placeholder="Enter your content" style="height:300px;"></textarea>

<br><br>
</div>
</div>
</form>
<br><br><br><br>

</div>


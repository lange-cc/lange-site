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

<div class="col-lg-4 img-gallery" id="row_<?php echo $data[$key]->id;?>">
<div class="photo-widget">
<div class="blog-image" style="height: 220px;
background:#000 url('<?php echo URL;?>all-images/thumbnail/<?php echo $data[$key]->image_name;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover;">
</div>

<div class="img-options fadeInLeft"><a href="" data-id="<?php echo $data[$key]->id;?>" class="btn-trash"><span class="fa fa-trash"></span></div>
</div>
</div>

<?php
 } 
 }  
?>






</div>

<div class="floating-options">
<a data-toggle="modal" data-target="#upload-items-modal" class="btn-add-new" title="Upload images">+</a> 
</div> 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>





<div id="upload-items-modal" class="modal fade" role="dialog">
<div class="fadeIn blog-dialog">
    <!-- Modal content-->
  <div class="modal-content">
      <div class="modal-header">
      <a class="btn btn-default close" href=''>&times;</a>
        <h4 class="modal-title">Add new images</h4>
      </div>
      <div class="modal-body">
        

    <form id="galery-upload" action="" method="POST" enctype="multipart/form-data">
      
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary btn-sl start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning btn-sl cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger btn-sl delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-4 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    
 
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" href=''>Refresh</a>
      </div>
    </div>

  </div>
</div>


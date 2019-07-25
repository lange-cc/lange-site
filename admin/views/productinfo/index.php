
<?php
$val = $this->product;
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
              <form action="" method="POST" id="product-add-content-form">
                <input name="id" type="hidden" value="<?=$data[$key]->id;?>">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Quantity</label>
                    <input class="form-control" name="quantity" value="<?=$data[$key]->quantity;?>" type="text"> <br>
                  </div>
                  <div class="col-lg-6">
                    <label>Weight</label>
                    <input class="form-control" name="weight" value="<?=$data[$key]->weight;?>" type="text"> <br>

                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <label>Discount</label>
                    <input class="form-control" name="discount" value="<?=$data[$key]->discount;?>"  type="text"> <br>
                  </div>
                  <div class="col-lg-6">
                    <label>Available Size</label>
                    <input class="form-control" name="size" value="<?=$data[$key]->size;?>" type="text"> <br>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <label>Product description</label>
                    <textarea class="txtEditor" name="content"><?=$data[$key]->description ;?></textarea>
                  </div>
                </div>

                <br>
                <label>Stock Information</label>
                <textarea class="form-control" name="stock-info" type="text"><?=$data[$key]->stock_info;?></textarea><br>

                <br>
                <label>Product summury</label>
                <textarea class="txtEditor" name="summury" type="text"><?=$data[$key]->summury;?></textarea><br>


                <label>Manufacture price</label>
                <input class="form-control" name="manufacture-price" value="<?=$data[$key]->manufacture_price;?>" type="text"> <br>

                <label>Keywords</label>
                <textarea class="form-control" name="keywords" type="text"><?=$data[$key]->keywords;?></textarea><br>

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
          <div class="col-lg-5">
            <div class="widget">

              <div class="row">
                <div class="col-lg-12">
                  <label>Other product images</label>
                  <br>
                  <a data-toggle="modal" data-target="#upload-items-modal" href="" class="btn-upload">Upload</a>
                  <div class="fill-width upload-panel">
                    <?php
                    if (!empty($data[$key]->other_images)) {
                      $images = $data[$key]->other_images;
                      foreach ($images as $key => $value) {
                        ?>
                        <div class="col-lg-2 col-md-2 col-sl-2 col-xs-2" id="img_id_<?=$images[$key]->id;?>">
                          <div class="widget-img" style="background:#000 url('<?php echo URL;?>all-images/thumbnail/<?=$images[$key]->image_name;?>');
                            background-repeat: no-repeat;
                            background-position: center center;
                            background-size: cover;">
                            <a href="" data-id="<?=$images[$key]->id;?>" title="Delete" class="fill-width img-btn-delete visible-on-hover"> <span class="fa fa-trash"></span></a>
                          </div>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>

                </div>
              </div>


              <hr>

              <?php
              $val = $this->product;
              if (!empty($val)) {
                $data = json_decode($val);
                foreach ($data as $key => $value) {
                  ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <label>Product size managment</label>
                      <br>
                      <p>Size type <span class="size-not"></span></p>
                      <form id="size-form" method="POST" action="">
                        <div class="input-group">
                          <input type="hidden" value="<?=$data[$key]->sizeIndex;?>" name="index" id="size-index">

                          <input class="form-control" type="text" value="<?php
                            $size = $data[$key]->products_size;
                              foreach ($size as $key => $value) {
                              echo $sizeType =  $size[$key]->size_type;
                              }
                            ?>" id="size-type" name="sizeName" required>

                          <a class="input-group-addon save-size"><i class="fa fa-floppy-o"></i> Save</a>

                        </div>
                      </form>
                      <br>
                      <a data-toggle="modal" data-target="#size-items-modal" href="" class="btn-upload">Add size</a>
                      <br><br>
                      <div class="row">

                        <?php
                        $sizeitem = $data[$key]->products_size;
                          foreach ($sizeitem as $key => $value) {

                            $sizeitems = $sizeitem[$key]->size_item;
                              foreach ($sizeitems as $key => $value) {
                        ?>
                        <div class="col-lg-4" id="size_item_<?=$sizeitems[$key]->id;?>">
                          <div class="size-item">
                            <a href="" data-id="<?=$sizeitems[$key]->id;?>" title="Delete" class="fill-width size-item-btn-delete"> <span class="fa fa-trash"></span></a>
                            <span class="fa fa-hourglass-2"></span> <?=$sizeitems[$key]->name;?> <br>
                            <span>$<?=$sizeitems[$key]->price;?></span>
                          </div>
                        </div>

                        <?php
                      }
                         }
                        ?>

                      </div>
                    </div>
                  </div>

                <?php }} ?>


                <?php
              }
            }
            ?>
            <hr>
            <br>

            <?php
            $val = $this->product;
            if (!empty($val)) {
              $data = json_decode($val);
              foreach ($data as $key => $value) {
                ?>
                <div clas="row">
                  <div class="col-lg-12">

                    <label>Avaliable Colors</label>
                    <a data-toggle="modal" data-target="#add-color" href="" class="btn-color pull-righ">+ Add color</a>
                    <hr>

                  </div>
                </div>


                <?php
                if (!empty($data[$key]->product_colors)) {
                  $color = $data[$key]->product_colors;
                  foreach ($color as $key => $value) {
                    ?>
                    <div class="row color-item" id="color_id_<?=$color[$key]->id;?>">
                      <div class="col-lg-12">
                        <label><span class="color-widget fa fa-circle-o" style="background: <?=$color[$key]->color_name;?>;"></span> <?=$color[$key]->color_name;?></label>
                        <a href="" data-id="<?=$color[$key]->id;?>" class="pull-right btn-color-delete btn-delete btn-delete-size"><span class="fa fa-trash"></span></a>
                        <a href="" data-toggle="modal" data-target="#add-image-to-color" class="pull-right btn-add-images" data-id="<?=$color[$key]->id;?>"><span class="fa fa-plus-circle"></span> image</a>
                        <div class="row fill-width">


                          <div class="fill-width upload-panel">

                            <?php
                            if (!empty($color[$key]->color_images)) {
                              $col_images =$color[$key]->color_images;
                              foreach ($col_images as $key => $value) {
                                ?>
                                <div class="col-lg-2 col-md-2 col-sl-2 col-xs-2" id="img_id_<?=$col_images[$key]->id;?>">
                                  <div class="widget-img" style="background:#000 url('<?php echo URL;?>all-images/thumbnail/<?=$col_images[$key]->image_name;?>');
                                    background-repeat: no-repeat;
                                    background-position: center center;
                                    background-size: cover;">
                                    <a href="" data-id="<?=$col_images[$key]->id;?>" title="Delete" class="fill-width img-btn-delete visible-on-hover"> <span class="fa fa-trash"></span></a>
                                  </div>
                                </div>
                                <?php
                              }
                            }
                            ?>


                          </div>


                        </div>
                      </div>
                    </div>

                    <hr>
                    <?php
                  }
                }
                ?>
                <br>
                <br>

              </div>

            </div>





          </div>


        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php
    }
  }
  ?>

  <?php
  $val = $this->product;
  if (!empty($val)) {
    $data = json_decode($val);
    foreach ($data as $key => $value) {
      ?>
      <div id="add-color" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add product colors</h4>
            </div>
            <div class="modal-body">

              <form action="" method="post" id="add-color-form">
                <label>Name color</label>
                <input name="name" class="form-control" placeholder="Enter name of color" id="content-type" required> <br>
                <input name="id" type="hidden" value="" id="content-id">
                <input name="index" type="hidden" value="<?=$data[$key]->color_index;?>">
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" class="btn btn-sl btn-success" value="Add color">
                    <div id="color-notification"></div>
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
              </form>


            </div>
            <div class="modal-footer">
              <a href="" class="btn btn-default" >Reflesh</a>
            </div>
          </div>

        </div>
      </div>




      <div id="size-items-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Size Item</h4>
            </div>
            <div class="modal-body">

              <form action="" method="post" id="add-size-form">
                <div class="row">
                  <div class="col-lg-12">
                    <label>Size</label>
                    <input name="name" class="form-control" placeholder="Enter size" id="content-type" required> <br>
                    <label>Price</label>
                    <input name="price" class="form-control" placeholder="Enter price" required> <br>
                    <input name="index" type="hidden" value="<?=$data[$key]->sizeIndex;?>">
                    <input type="submit" class="btn btn-sl btn-success" value="Add size">
                    <div id="size-notification"></div>
                  </div>

                </div>
              </form>


            </div>
            <div class="modal-footer">
              <a href="" class="btn btn-default" data-dismiss="modal" >Close</a>
            </div>
          </div>

        </div>
      </div>





      <div id="add-image-to-color" class="modal fade" role="dialog">
        <div class="modal-color-image-upload">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add images</h4>
            </div>
            <div class="modal-body">

              <form id="color-image-fileupload" action="" method="POST" enctype="multipart/form-data">
    
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
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
              <br>


            </div>
            <div class="modal-footer">
              <a href="" class="btn btn-default" >Reflesh</a>
            </div>
          </div>

        </div>
      </div>


      <div id="upload-items-modal" class="modal fade" role="dialog">
        <div class="fadeIn blog-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload other product images</h4>
            </div>
            <div class="modal-body">


              <form id="upload-other-images" action="" method="POST" enctype="multipart/form-data">
               
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
              <br>




            </div>
            <div class="modal-footer">
              <a href="" class="btn btn-default" >Reflesh</a>
            </div>
          </div>

        </div>
      </div>

      <?php
    }
  }
  ?>

<section class="site-section">
        
<div class="row">

<?php
$info = $this->blog;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>

                <div class="col-lg-6 story-widget">
                    <div class="story-window">
                        <div class="row"> 
                            <div class="col-lg-5" style="background: transparent url('<?php echo IMG_URL.'thumbnail/'.$data[$key]->logo; ?>');
               background-repeat: no-repeat;
               background-position: center center;
               background-origin: content-box;
               height: 370px;
               background-size: cover;">
</div>
                            <div class="col-lg-7 story-content">
                                <h3 class="gotham-bold">
                         <?php echo $data[$key]->title; ?></h3>
                                <p class="gotham-light">
                         <?php echo $this->CutText(210,$data[$key]->content);?>
                        </p>

                       <div class="row">

<div class="col-lg-3">
<img src="<?php echo IMG_URL.$data[$key]->author_img; ?>" class="autho-logo">
</div>
<div class="col-lg-9">
<label class="gotham-medium"><?php echo $data[$key]->author_name;?></label>
<p class="gotham-light"><?php echo date('M j Y g:i A', strtotime($data[$key]->added_date));?></p>
</div>
                       </div>
                                
                            </div> 

                        </div>
                        <a class="story-btn" href="<?php echo LINK;?>read/story/<?php echo $data[$key]->id; ?>/">READ FULL STORY</a> 
                    </div>
                </div>
          
 
<?php
}} ?>         


            </div>
        </section>

<section class="culture-section">

  <div class="row">


    <?php
     $data = $this->culture[0]->article;
     foreach ($data as $key => $value) {
    ?>
      <div class="col-lg-4">
        <div class="culture-widget" data-toggle="modal" data-target="#culture-modal-<?=$key?>" >
           <img src="<?=URL?>all-images/<?=$data[$key]->logo;?>" style="width: 80">
           <p class="gotham-bold fcolor" style="color:#ffc91b;font-size: 21px;"><?=$data[$key]->title;?></p>
        </div>
   

<div id="culture-modal-<?=$key?>" class="modal fade" role="dialog">
      <div class="culture-child">
  <div class="fadeIn" style="width: 400px;margin-top:-100px;margin-left: 10px;">

    <!-- Modal content-->
    <div class="modal-content" style="border-top-right-radius: 20px;background: transparent;">
      <div class="modal-header" style="background: #ffca1e; border-bottom: 0;border-top-right-radius: 20px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title gotham-bold" id="cul-title"><?=$data[$key]->title;?></h4>
      </div>
      <div class="modal-body gotham-light text-black" style="background:#ffca1e!important;border-bottom-left-radius: 20px;" id="cul-content">
        <?=$data[$key]->content;?>
      </div>
    </div>
  </div>
  </div>
</div>
                  
</div>
 
   <?php
        }
    ?>




  </div>
  
 </section>      
    



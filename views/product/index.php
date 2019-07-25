<div class="row">
	    <?php
     $data = $this->product[0]->article;
     foreach ($data as $key => $value) {
    ?>
	<div class="col-lg-6">
		<div class="col-padding line-spacer">
		  <div class="product-widget ">
		  	<a href="<?=$data[$key]->title;?>">
			  <img src="<?=URL?>all-images/<?=$data[$key]->logo;?>" class="">
			</a>
		  </div>
		</div>
	</div>


	   <?php
        }
    ?>
</div>
<!--  <section class="site-section-for-title">
<h1 class="text-white text-center gotham-bold">JYA ONLINE</h1>

 </section>
 -->
<section class="site-section" style="padding: 0 !important">
  <?php $data = json_decode($this->content)[0]->article; ?>
  <?php foreach ($data as $key => $value): ?>
   <?php if ($key == 0): ?>
       <div class="row no-gutters">
    <?php else: ?>
        <div class="row no-gutters" style="margin-top:50px;">
   <?php endif; ?>

    <?php if ($key % 2 == 0): ?>

        <div class="col-lg-6 col-md-6 pd-0">
          <img src="<?=LINK?>public/all-images/<?=$value->logo?>" alt="" class="img img-responsive">
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="jya-content">
            <h3 class="text-white gotham-bold"><?=$value->title?></h3>
            <p></p>
            <hr class="section-line new-hr">
            <div class="text-white section-content jya-text">
              <?=$value->content?>
      </div>
          </div>

        </div>
    <?php else: ?>
      <div class="row no-gutters" style="margin-top:50px;">
        <div class="col-lg-6 col-md-6">
          <div class="jya-content">
            <h3 class="text-white gotham-bold"><?=$value->title?></h3>
            <p></p>
            <hr class="section-line new-hr">
            <div class="text-white section-content jya-text">
              <?=$value->content?>
      </div>
          </div>

        </div>
        <div class="col-lg-6 col-md-6 pd-0">
          <img src="<?=LINK?>public/all-images/<?=$value->logo?>" alt="" class="img img-responsive">
        </div>
      </div>
    <?php endif; ?>
  </div>

<?php endforeach; ?>
</section>

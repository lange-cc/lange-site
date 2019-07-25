
<section class="site-section">
<?php
$info = $this->project;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
<div class="row project-full-widget"> 
   <div class="col-lg-7 project-widget">
<div class="embed-video" data-source="youtube" data-video-url="<?php  echo $article[$key]->subtitle;?>"></div>
   </div>
   <div class="col-lg-5 project-widget project-win">
<div class="fill-width">
    <img src="<?php  echo IMG_URL.$article[$key]->logo;?>" class="project-campany-logo">
</div>

<div class="fill-width">
<h2 class="text-white gotham-bold"> 
<?php  echo $article[$key]->title;?>
</h2>
<br>
</div>
<div class="fill-width text-white gotham-light">
<p class="text-white text-justfy"> 
<?php  echo $article[$key]->content;?>
</p>
</div>
</div>

</div>

   <div class="row">
                <div class="col-lg-12">
                    <p><hr class="project-line" /></p> 
                </div>
            </div> 
<?php }}} ?>  
</section>

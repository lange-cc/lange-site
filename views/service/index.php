


<?php
$info = $this->service;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
<div class="row"> 
            <div class="col-lg-12 slide-widget">

                <div class="slide-caption-content">
<!--                    <h2 class="text-center text-white gotham-medium " style="text-transform: uppercase;">
     <?php echo $article[$key]->title;?>
 </h2> -->
 <p class="text-center gotham-medium text-shadow">
     <?php  echo $article[$key]->content;?>
 </p>
    
                 
                </div>


             </div>
        </div>

<?php }}} ?>
        
           <div class="row">
                    <div class="col-lg-12 item-center">
                        <div class="service-bottom-btn gotham-bold">
                            OUR SERVICES
                        </div>                         
                    </div>
                </div>



<section class="site-section" id="service">
<?php
$info = $this->listwhatWeDo;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {

if ($key % 2 == 0) {
?>       

<div class="row project-full-widget" id="service<?php  echo $article[$key]->id;?>"> 

<div class="col-lg-7 project-widget">

<div class="fill-width">
<h2 class="site-yellow gotham-bold"> 
<?php  echo $article[$key]->title;?>
</h2><br>
</div>

<div class="fill-width text-white gotham-light">
<p class="text-white text-justfy"> 
<?php  echo $article[$key]->content;?>
</p>
</div>

</div>

<div class="col-lg-5 project-widget project-win">

<div class="fill-width">
    <img src="<?php  echo IMG_URL.$article[$key]->logo;?>" class="fill-width">
</div>

</div>



</div>

   <div class="row">
                <div class="col-lg-12">
                    <p><hr class="project-line" /></p> 
                </div>
</div> 

<?php
}
else
{
?>

<div class="row project-full-widget" id="service<?php  echo $article[$key]->id;?>"> 

<div class="col-lg-5 project-widget">
<div class="fill-width">
    <img src="<?php  echo IMG_URL.$article[$key]->logo;?>" class="fill-width">
</div>
</div>

<div class="col-lg-7 project-widget project-win">
<div class="fill-width">
<h2 class="site-yellow gotham-bold"> 
<?php  echo $article[$key]->title;?>
</h2><br>
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

<?php
}

}}}?>
</section>



       
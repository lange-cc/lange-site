<?php
$info = $this->event;
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
                <img src="<?php  echo IMG_URL.$article[$key]->logo ;?>" class="img-responsive fill-width">
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-bottom-btn gotham-bold">
                            Apply Now
                        </div>                         
                    </div>
                </div>
            </div>
        </div>


        

<section class="site-section">
    <h2 class="text-center text-white gotham-medium">
     <?php echo $article[$key]->title;?>
 </h2>
<p class="text-center text-white gotham-light">
     <?php  echo $article[$key]->content;?>
 </p> 


 <center>
<div class="row">
<div class="col-lg-3">

</div>

<div class="col-lg-6">
<div class="row">
    <form action="<?php echo LINK;?>events/mail/" method="post" id="Event-Form">

        <div id="notfication">

        </div>
   <div class="col-lg-6 input-widget">
<input name="name" class="site-input" type="text" placeholder="Names">
<input name="subject" type="hidden" value="<?php echo $article[$key]->subtitle;?>">
</div>                                 
<div class="col-lg-6 input-widget">
    <input name="email" class="site-input" type="text" placeholder="Email">
</div> 
<button id="send1" type="submit" class="sendemail-btn">Submit</button>
</form>
</div>



</div>

<div class="col-lg-3">
</div>

</div>



 </center>            
                   
</section>


<?php }}} ?>

       
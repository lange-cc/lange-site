<?php
$info = $this->slide;
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
                   <h2 class="text-center text-white gotham-medium">
     <?php echo $article[$key]->title;?>
 </h2>
<!--  <p class="text-center gotham-medium text-shadow">
     <?php  echo $article[$key]->content;?>
 </p> -->
    
                 
                </div>


             </div>
        </div>

<?php }}} ?>
        
           <div class="row">
                    <div class="col-lg-12 item-center">
                        <div class="slide-bottom-btn gotham-bold">
                            MORE ABOUT US
                        </div>                         
                    </div>
                </div>

    
     <section class="site-section" id="project">
            <div class="row">
                <h3 class="text-white gotham-bold">OUR LATEST PROJECTS.</h3>
                <p><hr class="section-line"></p>



            </div>

                <?php
$info = $this->project_title;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>

<div class="row">
<div class="col-lg-7 text-white section-content">
<p class="text-left text-white ">
 <?php echo $article[$key]->content;?>
 </p>
 <br>
</div>
</div>

<?php }}} ?>

    <div class="row" style="background: #ffffff1a;">

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
<div class="col-lg-6 project-widget" style="background: #000;">
<div class="embed-video" data-source="youtube" data-video-url="<?php echo $article[$key]->subtitle;?>">
</div>                     
</div>

<?php }}} ?>



                <div class="col-lg-6 project-widget">
                       <div class="more-videos">

                        <a href="<?php echo LINK; ?>works/" class="wath-more">Watch more
PROJECTS</a>
</div> 
                </div>
            </div>             
        </section>


<!-- 
<section class="site-section">
    <div class="row">
        <h3 class="text-white gotham-bold">WHAT WE DO.</h3>
           <p><hr class="section-line"></p>
             <br>
                <br>


                
<?php
$info = $this->whatWeDo;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
<p class="text-left text-white ">
<div class="row">
<div class="col-lg-7 text-white section-content">
 <?php echo $article[$key]->content;?>
</div>
</div>
</p>
<?php }}} ?>
            </div>
            <div class="row">
                <?php
$info = $this->listwhatWeDo;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
                <div class="col-lg-4 col-md-4 col-sl-6 col-xs-6 wht-we-do-widget">
                    <a href="<?php echo LINK; ?>service/#service<?php  echo $article[$key]->id;?>" class="site-yellow"> <?php echo $article[$key]->title;?></a> 
                </div>
   <?php }}} ?>             
            </div>             
        </section> -->




<!-- 
    <section class="site-section">
            <div class="row">
                <h3 class="text-white gotham-bold">COMPANY PROFILE</h3>
                <p><hr class="section-line"></p>
            </div>

                <?php
$info = $this->campany;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
            <div class="row">
              <div class="col-lg-4">
                  <img src="<?php  echo IMG_URL.$article[$key]->logo ;?>" width="300" class="img-responsive">

              </div>
              <div class="col-lg-8">
                  <h4 class="campany-profile-title text-white">
                     <?php  echo $article[$key]->title;?>
                  </h4>
                  <p class="text-white campany-profile-content">
                     <?php  echo $article[$key]->content;?> 
                  </p>
                   <p>
                        <a href="<?=URL?>document/Lange company profile.pdf" download class="btn btn-doanload">Download</a>
                   </p>
                 
              </div>
             
            </div> 

    <?php }}} ?>             
        </section> -->


        <section class="site-section">

                            <?php
$info = $this->testmonials;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?> 

            <div class="row">
                <h3 class="text-white gotham-bold">TESTIMONIALS.</h3>
                <p><hr class="section-line"></p>
                <br>
                <br>

                <p class="text-white "><div class="row">
                        <div class="col-lg-12 text-center text-white section-content">
                            <?php  echo $article[$key]->content;?>
</div>
                    </div></p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p><hr class="section-center-line" /></p> 
                    <p class="text-center text-white section-content">
       <?php  echo $article[$key]->subtitle;?>  </p>
                    <br>
                </div>
            </div> 
<?php }}} ?>

            <div class="row">



<?php
$info = $this->testmonials_people;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?> 

                <div class="col-lg-4 testmonial-profile-widget">
                    <div class="profile-images testmonial-profile-widget">
                        <img src="<?php echo IMG_URL.$article[$key]->logo; ?>"> 
                    </div>
                    <div class="text-center profile-name gotham-medium">
                        <?php  echo $article[$key]->title;?>
</div>
                    <div class="text-center text-white profile-job gotham-bold">
                       <?php  echo $article[$key]->subtitle;?>
</div>
                    <div class="text-center text-white profile-job">
                        <p class="gotham-light">
              <?php  echo $article[$key]->content;?></p>
                    </div>
                </div>
 <?php }}} ?>               
                            
            </div>
        </section>




  <!--    <section class="site-section">


            <div class="row">
                <h3 class="text-white gotham-bold">MEET OUR TEAM</h3>
                <p><hr class="section-line"></p>
                <br>
                <br>
<?php
$info = $this->teamcontent;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?> 
                <p class="text-white "><div class="row">
                        <div class="col-lg-12 text-center text-white section-content">
                            <?=$article[$key]->content?>
                        </div>
                    </div>
                </p>
<?php
}}}
?>
            </div>
<div class="row">
<?php
$val = $this->team;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
  <div class="col-lg-3 team-col">
    <div class="team-widget">
      <img src="<?php echo URL;?>all-images/<?php echo $data[$key]->logo;?>" class="img-responsive">
      <div class="team-content">
        <label><?php echo $data[$key]->names;?></label>
        <p class="job-title"><?php echo $this->CutText(50,$data[$key]->job_title);?></p>
        <p class="member-contact"><span class="fa fa-envelope"></span> <a href="mailto:<?php echo $this->CutText(100,$data[$key]->email);?>"><?php echo $this->CutText(100,$data[$key]->email);?></a></p>
      </div>
    </div>
  </div>
<?php
}}
?>


</div>

</section>

-->














        <section class="site-section">
            <div class="row">
                <h3 class="text-white gotham-bold">LATEST STORIES.</h3>
                <p><hr class="section-line"></p>
                <br>
                <br>
            </div>
            <div class="row">

<?php
$info = $this->blog;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>

                <div class="col-lg-6 col-md-6 col-xm-6 col-xs-12 story-widget">
                    <div class="story-window">
                        <div class="row"> 
                            <div class="col-lg-5" style="background: transparent url('<?php echo IMG_URL.$data[$key]->logo; ?>');
               background-repeat: no-repeat;
               background-position: center center;
               background-origin: content-box;
               height: 300px;
               background-size: cover;">
</div>
                            <div class="col-lg-7 story-content">
                                <h3 class="gotham-bold">
                         <?php echo $data[$key]->title; ?></h3>
                                <p class="gotham-light">
                         <?php echo $this->CutText(250,$data[$key]->content);?>
                        </p>
                                
                            </div>                             
                        </div>
                        <a class="story-btn" href="<?php echo LINK;?>read/story/<?php echo $data[$key]->id; ?>/">READ FULL STORY</a>
                    </div>
                </div>
          
  <?php }} ?>         


            </div>
        </section>
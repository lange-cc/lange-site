 <section class="site-section-for-title">
<h1 class="text-white text-center gotham-bold">GET IN TOUCH WITH US</h1>

<div class="fill-width">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5196229069566!2d30.0550664148918!3d-1.9450144372483558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca4230d0e2727%3A0x2d03650983ab1d6e!2sLange+Technologiez!5e0!3m2!1sen!2srw!4v1512761541980" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
 </section>
<!--  
      <section class="site-section">


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
        <!-- <p class="member-contact"><span class="fa fa-envelope"></span> <a href="mailto:<?php echo $this->CutText(100,$data[$key]->email);?>"><?php echo $this->CutText(100,$data[$key]->email);?></a></p> -->
      </div>
    </div>
  </div>
<?php
}}
?>


</div>

</section>
 -->
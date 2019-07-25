    
<?php
if (!isset($this->kill)) 
{
?>
<section class="site-section">
            <div class="row">
                <h3 class="text-white gotham-bold">OUR ESTEEMED CLIENTS AND PARTNERS.</h3>
                <p><hr class="section-line"></p>
                <br>
                <br>
            </div>
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="customer-logos">
<?php
$val = $this->client_logo;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
<div class="slide">
    <img src="<?php echo IMG_URL;?><?php echo $data[$key]->image_name;?>">
</div>
<?php }} ?>


                    </div>
                </div>                 
            </div>
        </section>
<?php   
}
?>



<?php if( ! isset($this->jyaonline)): ?>
  <section class="site-section">
            <div class="row">
                <h3 class="text-white gotham-bold"> 
                  <a href="<?=URL?>document/Lange company profile.pdf" download class="btn btn-doanload">
                    DOWNLOAD OUR COMPANY PROFILE
                  </a>
                </h3>
                
            </div>

    </section>
<?php endif; ?>

        <section class="site-section">
            <div class="row"> 


                <div class="col-lg-12">
                    <h2 class="text-center text-white gotham-bold">
                         <?php if(isset($this->jyaonline)): ?>
                                       DUSURE <b class="site-yellow">
               CYANGWA UTWANDIKIRE </b>
                                    <?php else: ?>
                                         GET IN <b class="site-yellow">
               TOUCH WITH US </b>
                                    <?php endif ?>
    
               
               </h2>
                    <p><hr class="section-center-line" /></p> 
                    <br>
                </div> 


                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="address">
                                <li class="h3 site-yellow gotham-bold">
                                    <?php if(isset($this->jyaonline)): ?>
                                        Ngwino udusure
                                    <?php else: ?>
                                       Come Visit
                                    <?php endif ?>
                                </li>
<?php
$info = $this->location;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
<li class="text-white gotham-light"><?php  echo $article[$key]->content;?></li>
<?php }}} ?>                                 
                            </ul>
                            <ul class="address">
                                <li class="h3 site-yellow gotham-bold">
                                    <?php if(isset($this->jyaonline)): ?>
                                        Duhamagare kuri:
                                    <?php else: ?>
                                       Contact Numbers
                                    <?php endif ?>
                                </li>
<?php
$info = $this->phone;
if (!empty($info)) {
$data = json_decode($info);
foreach ($data as $key => $value) {
?>
<?php
$article = $data[$key]->article;
foreach ($article as $key => $value) {
?>
                                <li class="text-white gotham-light"><?php  echo $article[$key]->content;?></li>
<?php }}} ?>                              
                                
                            </ul>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <form id="main-contact-form" action="<?php echo LINK;?>home/mail/" method="post">
                                <div class="col-lg-6 input-widget">
                                    <input class="site-input" type="text" name="name" placeholder="<?php if( ! isset($this->jyaonline)) echo 'Names'; else echo 'Amazina'; ?>" required>
                                    <input type="hidden" name="subject" value="Message from lange site">
                                </div>                                 
                                <div class="col-lg-6 input-widget">
                                    <input class="site-input" type="text" name="email" placeholder="Email" required>
                                </div>                                 

                                <div class="col-lg-12 input-widget">
                                    <textarea class="site-textarea" name="message" placeholder="<?php if( ! isset($this->jyaonline)) echo 'Message'; else echo 'Ubutumwa'; ?>" required></textarea>
                                </div>   
                                <div class="col-lg-12 input-widget">
                                    <button type="submit" class="sendemail-btn pull-right" id="send">
                                    <?php if(isset($this->jyaonline)): ?>
                                        Ohereza
                                    <?php else: ?>
                                        Send
                                    <?php endif ?>
                                </button>
                                </div> 
                                </form>                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p class="copyright text-white text-center gotham-light">
               &copy Copyright 2017 - <?php echo date('Y') ?> LANGE.</p>
                </div>
            </div>
        </section>

   
    </body>
</html>

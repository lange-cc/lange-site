 <?php $controller = $this->controller;?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
<?php
if (isset($this->metablog)) {
$val = $this->blog;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
<meta property="og:title" content="<?php echo $data[$key]->title;?>" />
<meta property="og:description" content="<?php echo $this->CutText(300,$data[$key]->content);?>" />
<meta property="og:url" content="<?php echo LINK;?>read/story/<?php echo $data[$key]->id;?>/"/>
<meta property="og:image" content="<?php echo IMG_URL.$data[$key]->logo;?>"/> 
<?php
}
}
}
?>
        <title>
            <?php 
            if(isset($this->title))
            {
              echo $this->title;
            }
            else{
                echo 'Welcome to LANGE';
            }
            ?>
        </title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo URL; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets/fonts/font-awesome.min.css" rel="stylesheet">

        
  <link rel="shortcut icon" href="<?php echo URL; ?>favicon.png" >

    <?php
if (isset($this->css)) {
  foreach ($this->css as $css) {
?>
<link rel="stylesheet" href="<?php echo URL.$css; ?>">
<?php  
}
}
?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script src="<?php echo URL; ?>assets/js/jquel.js"></script>
        <script src="<?php echo URL; ?>assets/js/site-load.js"></script>
        <script src="<?php echo URL; ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>assets/js/jquel_ui.js"></script>
        <script src="<?php echo URL; ?>video-plugin/embed.videos.js"></script>
        <script src="<?php echo URL; ?>assets/js/slick.js"></script>

<?php
if (isset($this->js)) {
  foreach ($this->js as $js) {
?>
<script type="text/javascript" src="<?php echo URL.$js; ?>"></script>
<?php  
}
}
?>
<script src="<?php echo URL; ?>assets/js/main.js" data-turbolinks-track="reload"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo URL; ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    
</head>
<body>

<div class="turbolinks-progress-bar"></div>

<input id="js-file-location" type="hidden" value="<?php echo URL;?>">
<input id="js-site-location" type="hidden" value="<?php echo LINK;?>">
    
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
            <div class="container-fluid"> 
                <div class="navbar-header"> 
                    <button type="button" class="navbar-toggle text-white" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
                        <span class="sr-only">Toggle navigation</span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                    </button>                     
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo URL; ?>assets/images/logo-white.png">
                    </a>                     
                </div>                 
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                    <ul class="nav navbar-nav navbar-right"> 
                        <li class="<?php if ($menu == 1) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>home/">HOME</a>
                        </li> 

                        <li class="<?php if ($menu == 7) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>culture/">CULTURE</a>
                        </li> 

                         <li class="<?php if ($menu == 3) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>service/">SERVICES</a>
                        </li>

                        <li class="<?php if ($menu == 9) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>product/">PRODUCTS</a>
                        </li>

                        <li class="<?php if ($menu == 2) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>works/">WORKS</a>
                        </li>
                        
                        <li class="<?php if ($menu == 8) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>jyaonline/">JYAONLINE</a>
                        </li> 

                        <li class="<?php if ($menu == 4) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>blog/">BLOG</a>
                        </li> 
                       <!--  <li class="<?php if ($menu == 5) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>events/">EVENTS</a>
                        </li>-->
                        <li class="<?php if ($menu == 6) {echo "active";}?>">
                            <a href="<?php echo LINK; ?>contact/">CONTACT US</a>
                        </li>

                        <li class="nav-space social-medial-link">
                            <span></span>
                        </li>
                        <li class="social-medial-link">
                            <a href="https://web.facebook.com/langetech/"><span class="fa fa-facebook"></span></a>
                        </li>
                        <li class="social-medial-link">
                            <a href="https://www.instagram.com/lange_tech/?hl=en/"><span class="fa fa-instagram"></span></a>
                        </li>
                        <li class="social-medial-link">
                            <a href="https://twitter.com/lange_tech"><span class="fa fa-twitter"></span></a>
                        </li>
                        <li class="social-medial-link">
                            <a href="https://www.behance.net/LangeTechnologiez"><span class="fa fa-behance"></span></a>
                        </li>
                        <li class="social-medial-link">
                            <a href="#"><span class="fa fa-youtube"></span></a>
                        </li>
                        <li class="social-medial-link">
                            <a href="https://www.linkedin.com/company/lange-technologiez1?trk=extra_biz_viewers_viewed"><span class="fa fa-linkedin"></span></a>
                        </li>
                    </ul>                     
                </div>                 
            </div>             
        </nav>

<div class="give-space">

</div>

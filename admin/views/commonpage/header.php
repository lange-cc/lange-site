 <?php $controller = $this->controller;?>
 <?php

$userMail = session::get('username');

$val = $this->profile;
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
    
$profile_names = $this->CutText(50,$data[$key]->name);
$profile_img   = $this->CutText(50,$data[$key]->logo);
if ($profile_img == 'none')
 {
  $profile_img = "no-profile.png";
 }

$profile_cover = $this->CutText(50,$data[$key]->cover_logo);
     } 
 }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo ADMINURL; ?>css/animate.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- uploading css -->
<link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/upload/css/blueimp-gallery.css">
<link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/upload/css/jquery.fileupload-ui.css">
<noscript><link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?php echo ADMINURL; ?>plugins/upload/css/jquery.fileupload-ui-noscript.css"></noscript>



  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<?php
if (isset($this->css)) {
  foreach ($this->css as $css) {
?>
<link rel="stylesheet" href="<?php echo ADMINURL.$css; ?>">
<?php  
}
}
?>

</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
  <input id="js-file-location" type="hidden" value="<?php echo URL;?>">
  <input id="js-ad-file-location" type="hidden" value="<?php echo ADMINURL;?>">
  <input id="js-site-location" type="hidden" value="<?php echo LINK;?>">
  <input id="caret-position" type="hidden" value="0">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">   </span>
      <!-- logo for regular state and mobile devices -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
<?php if ($this->run->getPermisssion($userMail, $per_name="Language", $per_ky = 'k_languag', $page = 'language', $type = 'submenu')) { ?>
          <li class="dropdown messages-menu" id="top-nav-sms-btn">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="languages">
              <i class="fa fa-language"></i>
              <span class="label label-success top-nav-label" id=""><?=LANG?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">List of Languages</li>
              <li>
                <!-- inner menu: contains the actual data -->
              <ul class="menu">

<?php
$val = $this->run->languages();
if (!empty($val)) {
$data = json_decode($val);
foreach ($data as $key => $value) {
?>
    <li>
      <a data-abrev="<?=$data[$key]->abrev?>" class="lang" href="javascript:void(0)">
        <span class="pull-left"><i class="fa fa-language text-aqua"></i> <?=$data[$key]->name;?></span>
  <?php if ($data[$key]->abrev == LANG) { ?>
        <i class="pull-right fa fa-thumbs-o-up"></i>
  <?php } ?>
      </a>
    </li>  
<?php 
}
}
?>
                   
                </ul>
              </li>
              <li class="footer"><a href="<?php echo LINK; ?>language">Manage languages</a></li>
            </ul>
          </li>
<?php
}
?>

          <!-- Messages: style can be found in dropdown.less-->
        <?php if ($this->run->getPermisssion($userMail, $per_name="Messages", $per_key = 'k_messag', $page = 'none', $type = 'navbar')) { ?>
          <li class="dropdown messages-menu" id="top-nav-sms-btn">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success top-nav-label" id="N_new_sms1">wait...</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="new-sms-number">4</span> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="top_nav_sms_panel">
         
                </ul>
                <ul class="menu">
<img src="<?php echo ADMINURL; ?>images/loading1.gif" width="60" id="nav-tab-loading"> 
            
                </ul>
              </li>
              <li class="footer"><a href="<?php echo LINK; ?>inbox">See All Messages</a></li>
            </ul>
          </li>
          <?php
            }
          ?>
          <!-- Notifications: style can be found in dropdown.less 
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning top-nav-label">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
               
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>-->
          <!-- Tasks: style can be found in dropdown.less 
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
               inner menu: contains the actual data 
                <ul class="menu">
                  <li>Task item
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                  /a>
              </li>
            </ul>
          </li>
          -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo URL;?>all-images/thumbnail/<?php echo $profile_img;?>" class="user-image" alt="User Image">
              <span class="hidden-xs text-uppercase"><?php echo $profile_names;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo URL;?>all-images/thumbnail/<?php echo $profile_img;?>" class="img-circle" alt="User Image">

                <p class="text-uppercase">
                  <?php echo $profile_names;?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                 <?php if ($this->run->getPermisssion($userMail, $per_name="Your Profire", $per_ky = 'k_yprofile', $page = 'profile', $type = 'submenu')) { ?>
                <div class="pull-left">
                  <a href="<?php echo LINK; ?>profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <?php
                 }
                 ?>
                <div class="pull-right">
                  <a href="<?php echo LINK;?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="profile">

<div class="profile-cover" style="
background:#000 url('<?php echo URL;?>all-images/thumbnail/<?php echo $profile_cover;?>');
background-repeat: no-repeat;
background-position: center center;
background-size: cover;">
</div>
<p class="user-caption text-uppercase">WELCOME <br> <span class="text-uppercase"><?php echo $profile_names;?></span></p>

<img src="<?php echo URL;?>all-images/thumbnail/<?php echo $profile_img;?>" class="user-logo">

      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
    
    <?php if ($this->run->getPermisssion($userMail, $per_name="Dashboard", $per_key = 'k_dashbad', $page = 'none', $type = 'navbar')) { ?>
        <li class="<?php if ($menu == 1) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <?php if ($this->run->getPermisssion($userMail, $per_name="Statistics", $per_key = 'k_statitsics', $page = 'index', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 1 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>index"><i class="fa fa-circle-o"></i> Statistics</a></li>
             <?php } ?>

             <?php if ($this->run->getPermisssion($userMail, $per_name="Purchases", $per_key = 'k_purchas', $page = 'purchases', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 1 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>purchases"><i class="fa fa-money"></i> Purchases</a></li>
            <?php } ?>
             
             <?php if ($this->run->getPermisssion($userMail, $per_name="Currency", $per_key = 'k_curency', $page = 'currency', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 1 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK; ?>currency"><i class="fa fa-dollar"></i> Currency</a></li>
              <?php } ?>

          </ul>
        </li>
    <?php } ?>

    <?php if ($this->run->getPermisssion($userMail, $per_name="Product", $per_key = 'k_prodt', $page = 'none', $type = 'navbar')) { ?>

         <li class="<?php if ($menu == 2) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-opencart"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <?php if ($this->run->getPermisssion($userMail, $per_name="Categories", $per_ky = 'k_catgry', $page = 'category', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 2 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>category"><i class="fa fa-bars"></i>Categories</a></li>
              <?php } ?>
           

             <?php if ($this->run->getPermisssion($userMail, $per_name="Items", $per_ky = 'k_itm', $page = 'product', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 2 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>product"><i class="fa fa-newspaper-o"></i> Items</a></li>
             <?php } ?>

             <?php if ($this->run->getPermisssion($userMail, $per_name="Giftbox", $per_ky = 'k_giftbx', $page = 'giftbox', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 2 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK; ?>giftbox"><i class="fa fa-gift"></i> Giftbox</a></li>
             <?php } ?>

          </ul>
        </li>
    <?php } ?>

 <?php if ($this->run->getPermisssion($userMail, $per_name="Site Content", $per_key = 'k_stcont', $page = 'none', $type = 'navbar')) { ?>
         <li class="<?php if ($menu == 3) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-globe"></i> <span>Site Content</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->run->getPermisssion($userMail, $per_name="Main content", $per_ky = 'k_mancont', $page = 'content', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 3 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>content"><i class="fa fa-list-alt"></i>Main content</a></li>
             <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Blog", $per_ky = 'k_blog', $page = 'blog', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 3 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>blog"><i class="fa fa-quote-left"></i> Blog</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Gallery", $per_ky = 'k_garly', $page = 'gallery', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 3 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK; ?>gallery"><i class="fa  fa-image"></i> Gallery</a></li>
            <?php } ?>

           </ul>
        </li>
<?php } ?>

<?php if ($this->run->getPermisssion($userMail, $per_name="Organisation", $per_key = 'k_orgnstion', $page = 'none', $type = 'navbar')) { ?>
          <li class="<?php if ($menu == 4) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-circle-o-notch"></i> <span>Organisation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->run->getPermisssion($userMail, $per_name="Authors", $per_ky = 'k_autor', $page = 'authors', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 4 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>authors"><i class="fa fa-pencil"></i> Authors</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Team", $per_ky = 'k_team', $page = 'team', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 4 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>team"><i class="fa fa-puzzle-piece"></i> Team</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="About Campany", $per_ky = 'k_abtcompany', $page = 'campany', $type = 'submenu')) { ?>
             <li class="<?php if ($menu == 4 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK; ?>campany"><i class="fa fa-line-chart"></i> About Campany</a></li>
             <?php } ?>

           </ul>
        </li>
<?php } ?>

<?php if ($this->run->getPermisssion($userMail, $per_name="Account", $per_key = 'k_acount', $page = 'none', $type = 'navbar')) { ?>

        <li class="<?php if ($menu == 5) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->run->getPermisssion($userMail, $per_name="Site Accounts", $per_ky = 'k_stacount', $page = 'accounts', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 5 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>accounts"><i class="fa fa-group"></i>Site Accounts</a></li>
            <?php } ?>
          </ul>
        </li>
<?php } ?>

  <?php if ($this->run->getPermisssion($userMail, $per_name="Messages", $per_key = 'k_messag', $page = 'none', $type = 'navbar')) { ?>

         <li class="<?php if ($menu == 6) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
               <small class="label pull-right bg-yellow" id="N_new_sms">wait...</small>
            </span>
          </a>
          <ul class="treeview-menu">
           <!-- <li class=""><a href="index.html"><i class="fa fa-circle" style="color:#1cdc25;"></i>Online</a></li> -->
          <?php if ($this->run->getPermisssion($userMail, $per_name="Inbox", $per_ky = 'k_inbx', $page = 'inbox', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 6 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>inbox"><i class="fa fa-commenting"></i> <span>Inbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green sms-notification-laber" id="N_inbox_sms">wait...</small>
            </span>
          </a></li>
         <?php } ?>

         <?php if ($this->run->getPermisssion($userMail, $per_name="Sent", $per_ky = 'k_sent', $page = 'sent', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 6 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>sent"><i class="fa fa-comments"></i> <span>Sent</span>
  <span class="pull-right-container">
              <small class="label pull-right bg-blue sms-notification-laber" id="N_sent_sms">wait...</small>
            </span>
            </a>
            </li>
          <?php } ?>
      
      <?php if ($this->run->getPermisssion($userMail, $per_name="E-Mail", $per_ky = 'k_email', $page = 'email', $type = 'submenu')) { ?>
          <li class="<?php if ($menu == 6 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK; ?>email"><i class="fa fa-envelope"></i> <span>E-Mail</span>
            </a>
          </li>
        <?php } ?> 
          
          </ul>
        </li>
<?php } ?>

 <?php if ($this->run->getPermisssion($userMail, $per_name="Setting", $per_key = 'k_seting', $page = 'none', $type = 'navbar')) { ?>

         <li class="<?php if ($menu == 7) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <?php if ($this->run->getPermisssion($userMail, $per_name="Site preference", $per_ky = 'k_stpreferense', $page = 'settingLogin', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 7 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK;?>settingLogin"><i class="fa fa-cog"></i>Site preference</a></li>
        <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Language", $per_ky = 'k_languag', $page = 'language', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 7 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK;?>language"><i class="fa fa-language"></i>Language</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Permissions", $per_ky = 'k_permition', $page = 'permission', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 7 && $semenu == 3) {echo "active";}?>"><a href="<?php echo LINK;?>permission"><i class="fa fa-lock"></i>Permissions</a></li>
             <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Client Account", $per_ky = 'k_clientaccount', $page = 'client', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 7 && $semenu == 4) {echo "active";}?>"><a href="<?php echo LINK;?>client"><i class="fa fa-suitcase"></i>Client Account</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Your Profire", $per_ky = 'k_yprofile', $page = 'profile', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 7 && $semenu == 5) {echo "active";}?>"><a href="<?php echo LINK; ?>profile"><i class="fa fa-user"></i>Your Profire</a></li>
            <?php } ?>

          </ul>
        </li>
   <?php } ?>

 <?php if ($this->run->getPermisssion($userMail, $per_name="Task", $per_key = 'k_task', $page = 'none', $type = 'navbar')) { ?>
        <li class="<?php if ($menu == 8) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Task</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if ($this->run->getPermisssion($userMail, $per_name="Add Task", $per_ky = 'k_adtask', $page = 'task', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 8 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>task"><i class="fa fa-plus-circle"></i> Add Task</a></li>
          <?php } ?>
   
          <?php if ($this->run->getPermisssion($userMail, $per_name="History", $per_ky = 'k_history', $page = 'task', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 8 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>task/history/"><i class="fa fa-clock-o"></i> History</a></li>
          <?php } ?>

          </ul>
        </li>
<?php } ?>

 <?php if ($this->run->getPermisssion($userMail, $per_name="Billing", $per_key = 'k_biling', $page = 'none', $type = 'navbar')) { ?>
      <li class="<?php if ($menu == 9) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Billing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->run->getPermisssion($userMail, $per_name="Add Billing", $per_ky = 'k_addbiling', $page = 'billing', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 9 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>billing"><i class="fa fa-plus-circle"></i> Add Billing</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Billig History", $per_ky = 'k_bilhistory', $page = 'billing', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 9 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>billing/history"><i class="fa fa-clock-o"></i> History</a></li>
             <?php } ?>
          </ul>
        </li>
<?php } ?>


 <?php if ($this->run->getPermisssion($userMail, $per_name="Report", $per_key = 'k_repot', $page = 'none', $type = 'navbar')) { ?>
      <li class="<?php if ($menu == 10) {echo "active";}?> treeview">
          <a href="#">
            <i class="fa fa-folder-open-o"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->run->getPermisssion($userMail, $per_name="Task report", $per_ky = 'k_taskrept', $page = 'report', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 10 && $semenu == 1) {echo "active";}?>"><a href="<?php echo LINK; ?>report/task"><i class="fa fa-edit"></i> Task</a></li>
            <?php } ?>

            <?php if ($this->run->getPermisssion($userMail, $per_name="Billig report", $per_ky = 'k_billrept', $page = 'report', $type = 'submenu')) { ?>
            <li class="<?php if ($menu == 10 && $semenu == 2) {echo "active";}?>"><a href="<?php echo LINK; ?>report/billing"><i class="fa fa-edit"></i> Billing</a></li>
             <?php } ?>
          </ul>
        </li>
<?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
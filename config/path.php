<?php
$actual_link  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$actual_link  = rtrim($actual_link,'/');
$actual_link .= '/lange';
define('URL',$actual_link.'/public/');
define('LINK',$actual_link.'/');
define('IMG_URL',$actual_link.'/public/all-images/');
define('FILE_URL',$actual_link.'/public/');
define('THUMBNAIL','thumbnail/');
define('MAIL','nidijoyeux@gmail.com');


?>
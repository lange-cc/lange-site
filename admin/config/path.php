<?php
$actual_link  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$actual_link  = rtrim($actual_link,'/');
$actual_link .= '/lange';
define('URL',$actual_link.'/public/');
define('ADMINURL',$actual_link.'/admin/public/');
define('LINK',$actual_link.'/admin/');
define('SITE',$actual_link.'/');
define('COMPANY_EMAIL','nididie@gmail.com');
define('OWNER_NAME','Didier juaeux');

?>

<?php
/**
* 
*/
class events extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array();
		//$this->Statistics('Event');
	}

	public function autoload()
	{
	  $this->view->title = "LANGE - Event";
	  $this->view->controller = $this->loadcontroller;
	  $this->view->event      = $this->model->Finddata($id=17);
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);

      $this->view->render('events/index',false,$menu=5);
	}

 public function MakeActive($key)
 {
 	if ($key==0) {
 		echo "active";
 	}
 	else
 	{
 		//nothing
 	}
 }


public function mail()
{
if(trim($_POST['name']) === '') {
$nameError =  'Forgot your name!'; 
$hasError = true;
} else {
$name = trim($_POST['name']);
}
if(trim($_POST['email']) === '')  {
$emailError = 'Forgot to enter in your e-mail address.';
$hasError = true;
} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
$emailError = 'You entered an invalid email address.';
$hasError = true;
} else {
$email = trim($_POST['email']);
}

$subject = trim($_POST['subject']);
$message = "Hey, this is ".$name." \n I would like to attend. My email is ".$email."  \n Thanks.";

if(!isset($hasError)) {
$emailTo = 'didier@lange.rw';
$body = "Name: $name \n\nEmail: $email  \n\nMessage: $message";
$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
if(! mail($emailTo, $subject, $body, $headers))
{
echo "Try again, Message not sent";
}
else {
echo 'Your request sent,You are going to get your invitation as soon as possible.';
}  
$emailSent = true;
} 
else
{
echo $messageError; 
}


}

}

?>
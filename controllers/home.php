<?php
/**
* 
*/
class home extends controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->view->js  = array('assets/js/jquery.classyscroll.js','assets/js/ekScrollable.js','assets/js/jquery.mousewheel.js','assets/js/demo.js','assets/js/ayoshare.js');
	}

	public function autoload()
	{
	$this->view->title = "LANGE - We understand the internet";
	  $this->view->controller = $this->loadcontroller;
	  $this->view->slide      = $this->model->Finddata($id=8);
   $this->view->project_title = $this->model->Finddata($id=18);
	  $this->view->project    = $this->model->Findproject($id=9);
	  $this->view->whatWeDo   = $this->model->Finddata($id=10);
	$this->view->listwhatWeDo = $this->model->Finddata($id=11);
	$this->view->testmonials  = $this->model->Finddata($id=12);
	$this->view->testmonials_people  = $this->model->Finddata($id=13);
	$this->view->campany      = $this->model->Finddata($id=20);
	$this->view->teamcontent  = $this->model->Finddata($id=19);
	  $this->view->blog       = $this->model->BlogData($limit=2);
	 //$this->view->client_logo = $this->Images($index='hCiS');
	 $this->view->client_logo = $this->Gallery($index='hCiS');
	 $this->view->location    = $this->model->Finddata($id=14);
	 $this->view->phone       = $this->model->Finddata($id=15);
	 
	 $this->view->team        = $this->model->ourTeam();

      //$this->statistics('Home');


        $this->view->name =  $this->model->Finddata($id=8);
      $this->view->render('home/index',false,$menu=1);


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
if(trim($_POST['subject']) === '')  {
$subject = 'Submitted message from '.$name;
} else {
$subject = trim($_POST['subject']);
}
if(trim($_POST['message']) === '') {
$messageError = 'You forgot to enter a message!';
$hasError = true;
} else {
if(function_exists('stripslashes')) {
$message = stripslashes(trim($_POST['message']));
} else {
$message = trim($_POST['message']);
}
}
if(!isset($hasError)) {
$emailTo = MAIL;
$body = "Name: $name \n\nEmail: $email  \n\nMessage: $message";
$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

$this->model->sendnewmail($name,$email,$emailTo,$subject,$message);

if(!mail($emailTo, $subject, $body, $headers))
{
echo "Try again, Message not sent";
}
else {
echo 'Your email sent,Thank you!!';
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
<?php
/**
*
*/
class mail extends controller
{


function __construct()
{
 parent::__construct();
 session:: init();
 $loged = session::get('username');
 if ($loged == false) {
   session::destroy();
   header('location: login');
   exit;
}

$this->view->js  = array('editor/jquery-te-1.4.0.min.js','js/mail.js');
$this->view->css = array('editor/jquery-te-1.4.0.css');
$this->loadProfile();
  }

	public function autoload()
	{
    $this->view->data = $this->model->templetes();
    $this->view->controller = $this->loadcontroller;
    $this->checklink('mail');
    $this->view->render('mail/index',false,$semenu=3,$menu=6);
	}

 public function Addnew()
 {
  if (isset($_POST['title'])&&isset($_POST['subject'])&&isset($_POST['content'])) {
    $title   = $_POST['title'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $mail_index= $this->randomname($length=10);
    $this->model->addnew($title,$subject,$content,$mail_index);
  }
  else
  {
    //echo "id not set";
  }
 }

 public function Delete()
 {
if (isset($_POST['id'])) {
     $id = $_POST['id'];
    $this->model->Delete($id);
}
 }


public function FindMail()
{
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $this->model->FindMail($id);
}
}
public function update()
{
  if (isset($_POST['id'])&&isset($_POST['title']) && isset($_POST['subject']) && isset($_POST['content'])) {
    $id      = $_POST['id'];
    $title   = $_POST['title'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $this->model->update($id,$title,$subject,$content);
  }
  else
  {
    //echo "id not set";
  }
}


public function copy()
{
if (isset($_POST['data'])) 
{
  $lang = $_POST['data'];
  $this->model->copyData($lang);
}
else
{
  echo "error";
}
}


//============ tast for client emails =====================

public function client()
{
    $this->view->UserNotPayed     = $this->model->userMail('not-payed');
    $this->view->UserPayed        = $this->model->userMail('payed');
    $this->view->UserWithAccounts = $this->model->account();
    $this->view->data             = $this->model->templetes();
    $this->view->controller       = $this->loadcontroller;
    $this->view->render('mail/client',false,$semenu=3,$menu=6);
}

public function SendMiltEmail()
{
if (isset($_POST['section'])&&isset($_POST['content'])&&isset($_POST['subject'])) {
  $section = $_POST['section'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];
 if ($section == 1) 
 {
    $this->model->SendEmail($subject,$content,'payed');
 }
 else if($section == 2)
 { 
    $this->model->SendEmail($subject,$content,'not-payed');
 }
 else if ($section = 3) {
   $this->model->SendEmailToUserHaveAccount($subject,$content);
 }

  }
 
}


public function SendSingleEmail()
{
if (isset($_POST['content'])&&isset($_POST['subject'])&&isset($_POST['email'])) 
{

  $subject = $_POST['subject'];
  $content = $_POST['content'];
  $email   = $_POST['email'];

   $this->model->SendSingeleEmai($subject,$content,$email);
 
  }

}

}

?>

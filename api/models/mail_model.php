<?php
/**
*
*/
class mail_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}


public function addnew($title,$subject,$content,$mail_index)
	{
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `mvc_mail` (`id`, `title`, `subject`, `content`, `mail_index`, `lang`) VALUES (NULL, :title, :subject, :content, :index,'en')");
  if ($command->execute(array(
    	    ':title'   => $title,
    	    ':subject' => $subject,
          ':content' => $content,
    	    ':index'   => $mail_index
            )))
  {
$proced->status   = "success";
$proced->message = "Templete was saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Templete was not saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

public function addnewcontent($index,$content)
{
  $proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `mvc_mail_content` (`id`, `mail_index`, `content`, `lang`) VALUES (NULL, :index, :content, :lang)");
  if ($command->execute(array(
          ':index'   => $index,
          ':content' => $content,
          ':lang'    => LANG
            )))
  {
$proced->status   = "success";
$proced->message = "new content added";
$myJSON = json_encode($proced);
echo $myJSON;
  }
  else
  {
$proced->status  = "fail";
$proced->message = "Failed to add content";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


public function templetes()
{
 $command = $this->db->prepare("SELECT * FROM `mvc_mail` WHERE lang = :lang ORDER BY `mvc_mail`.`id` DESC");
 $command->execute( array(':lang' => LANG));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']         = $row['id'];
        $row_array['title']      = $row['title'];
        $row_array['subject']    = $row['subject'];
        $row_array['index']      = $row['mail_index'];

array_push($json_response, $row_array);
}
return json_encode($json_response);
}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_mail` WHERE `mvc_mail`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Data was Delete";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Data was not Delete";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }

public function FindMail($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_mail` WHERE id = $id ");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']      = $row['id'];
        $row_array['title']   = $row['title'];
        $row_array['subject'] = $row['subject'];
        $row_array['content'] = $row['content'];

array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($id,$title,$subject,$content)
{
$proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_mail` SET `title` = :title, `subject` = :subject, `content` = :content WHERE `mvc_mail`.`id` = $id");
  if ($command->execute(array(
          ':title'   => $title,
          ':subject' => $subject,
          ':content' => $content
            )))
  {
$proced->status   = "success";
$proced->message = "Mail item was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Mail was not updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}



public function copyData($lang)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_mail` WHERE lang = 'en'");
 $command->execute();
if($command->rowCount()  > 0)
{ 
  $num = 0;
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
  $num = $num + 1;
        $id       = $row['id'];
        $title    = $row['title']; 
        $subject  = $row['subject']; 
        $content  = $row['content']; 
        $index    = $row['mail_index']; 
    

$command2 = $this->db->prepare("SELECT * FROM `mvc_mail` WHERE lang = :lang AND mail_index = :index");
$command2->execute(array(
  ':lang'  => $lang,
  ':index' => $index));

if($command2->rowCount()  > 0)
{
if ($num == $command->rowCount()) 
{
$proced = new \stdClass();
$proced->status  = "success";
$proced->message = "All data Updated";
$myJSON = json_encode($proced);
echo $myJSON;
}
}
else
{          
$this->addcopy($title,$subject,$content,$index,$lang);

if ($num == $command->rowCount()) 
{
$proced = new \stdClass();
$proced->status  = "success";
$proced->message = "All data saved";
$myJSON = json_encode($proced);
echo $myJSON;
}

}


}
}

}

  public function addcopy($title,$subject,$content,$index,$lang)
  {
    $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `mvc_mail` (`id`, `title`, `subject`, `content`, `mail_index`, `lang`) VALUES (NULL, :title, :subject, :content, :index, :lang)");
if ($command->execute(array(
          ':title'    => $title,
          ':subject'  => $subject,
          ':content'  => $content,
          ':index'    => $index,
          ':lang'     => $lang
            ))) 
  {}
  else
  {}

   }

//============ tast for client emails =====================
public function userMail($status)
{
$data = array();

$command = $this->db->prepare("SELECT * FROM `deliver` WHERE pay_status = :pay ");
$command->execute(array(':pay' => $status));

if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
    
$account_id    = $row['client_id'];

$command2 = $this->db->prepare("SELECT * FROM `client_information` WHERE account_id = :id");
$command2->execute(array(':id' => $account_id ));

if($command2->rowCount()  > 0)
{
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
{
       
 $row_array = array();
 $row_array['names']   = $row2['first_name']." ".$row2['last_name'];
 $row_array['email']   = $row2['user_email'];

   array_push($data, $row_array);
   }
   }

}

return json_encode($data);

}

}

public function account()
{
$data = array();
$command2 = $this->db->prepare("SELECT * FROM `mvc_site_accounts`");
$command2->execute();
if($command2->rowCount()  > 0)
{
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
{
       
 $row_array = array();
 $row_array['names']   = $row2['f_name']." ".$row2['l_name'];
 $row_array['email']   = $row2['email'];

   array_push($data, $row_array);
}
   return json_encode($data);
}


}

public function SendEmail($subject,$content,$status)
{
$command = $this->db->prepare("SELECT * FROM `deliver` WHERE pay_status = :pay ");
$command->execute(array(':pay' => $status));

if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
    
$account_id    = $row['client_id'];

$command2 = $this->db->prepare("SELECT * FROM `client_information` WHERE account_id = :id");
$command2->execute(array(':id' => $account_id ));

if($command2->rowCount()  > 0)
{
  $num = 0;
  $max = $command2->rowCount();
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
{
  $num = $num + 1;
 $email = $row2['user_email'];
 
    $to      = $email; 
    $message = $content;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Nilefy.com <info@nilefy.com>" . "\r\n"."X-MSMail-Priority: High". "\r\n";
if( mail($to,$subject,$message,$headers)){
if ($num == $max) 
{
    $proced = new \stdClass();
    $proced->status  = "success";
    $proced->message = "Message sent to all users";
    $myJSON = json_encode($proced);
    echo $myJSON;
}

  }
else 
{
  if ($num == $max) 
{
    $proced = new \stdClass();
    $proced->status  = "fail";
    $proced->message = "Message not sent to all users";
    $myJSON = json_encode($proced);
    echo $myJSON;
}  
  
}
   }
 }
}
}  
}

public function SendEmailToUserHaveAccount($subject,$content)
{ 
$command2 = $this->db->prepare("SELECT * FROM `mvc_site_accounts`");
$command2->execute(array(':id' => $account_id ));

if($command2->rowCount()  > 0)
{
  $num = 0;
  $max = $command2->rowCount();
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
{
  $num = $num + 1;
  $email = $row2['email'];
 
    $to      = $email; 
    $message = $content;
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Nilefy.com <info@nilefy.com>" . "\r\n"."X-MSMail-Priority: High". "\r\n";
if( mail($to,$subject,$message,$headers)){
if ($num == $max) 
{
    $proced = new \stdClass();
    $proced->status  = "success";
    $proced->message = "Message sent to all users";
    $myJSON = json_encode($proced);
    echo $myJSON;
}

  }
else 
{
  if ($num == $max) 
{
    $proced = new \stdClass();
    $proced->status  = "fail";
    $proced->message = "Message not sent to all users";
    $myJSON = json_encode($proced);
    echo $myJSON;
}  
  
}
  }
 }
}

public function SendSingeleEmai($subject,$content,$email)
{
    $to      = $email; 
    $message = $content;
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Nilefy.com <info@nilefy.com>" . "\r\n"."X-MSMail-Priority: High". "\r\n";
if(mail($to,$subject,$message,$headers)){

    $proced = new \stdClass();
    $proced->status  = "success";
    $proced->message = "Message sent to this user";
    $myJSON = json_encode($proced);
    echo $myJSON;


  }
else 
{

    $proced = new \stdClass();
    $proced->status  = "fail";
    $proced->message = "Message not sent";
    $myJSON = json_encode($proced);
    echo $myJSON;
 
 } 

}

}
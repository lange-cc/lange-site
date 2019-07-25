<?php
/**
* 
*/
class setting_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
    header('location: ../../login/');
	}

	public function addNew($names,$username,$email,$password,$image,$cover_image,$index )
	{
  $proced = new \stdClass();
	$command = $this->db->prepare("INSERT INTO `login` (`id`, `name`, `username`, `password`, `email`, `index`, `logo`, `cover_logo`) VALUES (NULL, :name, :username, :password, :email, :index, :logo, :coverLogo)");
  if ($command->execute(array(
    	    ':name'      => $names,
    	    ':username'  => $username,
          ':password'  => $password,
    	    ':email'     => $email,
          ':index'     => $index,
    	    ':logo'      => $image,
          ':coverLogo' => $cover_image
         
            ))) 
  {
$proced->status   = "success";
$proced->message = "New member added ";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Member not added";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }


public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `login`  ORDER BY `login`.`id` DESC");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    return $myJSON;
    }
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `login` WHERE `login`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Member was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Member was not Removed";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }

public function Find($id)
{

$command = $this->db->prepare("SELECT * FROM `login` WHERE id = $id ");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
}

public function update($names,$username,$email,$password,$image,$cover_image,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `login` SET `name` = :names, `username` = :username, `password` = :password, `email` = :email, `logo` = :image, `cover_logo` = :cover_image WHERE `login`.`id` = $id");
  if ($command->execute(array(
          ':names'       => $names,
          ':username'    => $username,
          ':email'       => $email,
          ':password'    => $password,
          ':image'       => $image,
          ':cover_image' => $cover_image

            ))) 
  {
$proced->status   = "success";
$proced->message = "Profile was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Profile was not saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

public function idStatus($status)
{

if ($status == 'false') {
  $sms = 'Desactivated';
}
else
{
  $sms = 'Activated';
}

  $proced = new \stdClass();
  $command = $this->db->prepare("UPDATE `mvc_dev_option` SET `option_status` = :status WHERE `mvc_dev_option`.`id` = 1");
  if ($command->execute(array(
          ':status' => $status
            ))) 
  {
$proced->status  = "success";
$proced->message = $sms;
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Failed to change setting try again";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}
public function FindAuthor()
{

  $command = $this->db->prepare("SELECT * FROM `mvc_author`");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']           = $row['id'];
        $row_array['name']         = $row['name']; 
        $row_array['description']  = $row['description']; 
        $row_array['logo']         = $row['logo']; 
        $row_array['added_date']   = $row['added_date'];

        array_push($json_response, $row_array);
}
return json_encode($json_response);
}

}

 }
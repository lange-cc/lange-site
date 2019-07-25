<?php
/**
* 
*/
class client_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
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




 }
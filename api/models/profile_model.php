<?php
/**
* 
*/
class profile_model extends model
{
  
  function __construct()
  {
    parent::__construct();
  }
  public function logout()
  {
      header('location: ../login/');
  }

 

public function FindData($username,$password)
{

 $command = $this->db->prepare("SELECT * FROM `login`  WHERE email= :user AND password= :pass");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute( array(
  ':user' => $username, 
  ':pass' => $password
  ));
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
$proced->message = "Profile was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Profile was not Deleted";
$myJSON = json_encode($proced);
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
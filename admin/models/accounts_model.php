<?php
/**
* 
*/
class accounts_model extends model
{
  
  function __construct()
  {
    parent::__construct();
  }
  public function logout()
  {
      header('location: ../../login/');
  }

  public function addnew($f_name,$l_name,$day,$mouth,$year,$sex,$location,$image,$email,$password)
  {
  $proced = new \stdClass();
  $command = $this->db->prepare("INSERT INTO `mvc_site_accounts` (`id`, `f_name`, `l_name`, `dd`, `mm`, `yyy`, `sex`, `location`, `email`, `password`, `status`, `logo`) VALUES (NULL, :f_name, :l_name, :dd, :mm, :yyy, :sex, :location, :email, :password, :status, :logo)");
  if ($command->execute(array(
          ':f_name'   => $f_name,
          ':l_name'   => $l_name,
          ':dd'       => $day,
          ':mm'       => $mouth,
          ':yyy'      => $year,
          ':sex'      => $sex,
          ':location' => $location,
          ':email'    => $email,
          ':password' => $password,
          ':status'   => "active",
          ':logo'     => $image
         
            ))) 
  {
$proced->status   = "success";
$proced->message = "Account was created";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Account was not created";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }


public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `mvc_site_accounts`  ORDER BY `mvc_site_accounts`.`id` DESC");
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
 $command = $this->db->prepare("DELETE FROM `mvc_site_accounts` WHERE `mvc_site_accounts`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Account was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Account was not Deleted";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }

public function Find($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_site_accounts` WHERE id = $id");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
}

public function update($f_name,$l_name,$day,$mouth,$year,$sex,$location,$image,$email,$password,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_site_accounts` SET `f_name` = :f_name, `l_name` = :l_name, `dd` = :dd, `mm` = :mm, `yyy` = :yyy,`sex` = :sex, `location` = :location, `email` = :email, `password` = :password, `logo` = :logo WHERE `mvc_site_accounts`.`id` = $id");
  if ($command->execute(array(
          ':f_name'   => $f_name,
          ':l_name'   => $l_name,
          ':dd'       => $day,
          ':mm'       => $mouth,
          ':yyy'      => $year,
          ':sex'      => $sex,
          ':location' => $location,
          ':email'    => $email,
          ':password' => $password,
          ':logo'     => $image

            ))) 
  {
$proced->status   = "success";
$proced->message = "Account was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Account was not saved";
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
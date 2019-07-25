<?php
/**
* 
*/
class team_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}

	public function addnew($name,$email,$facebook,$instagram,$twitter,$image,$job_title,$content)
	{
  $proced = new \stdClass();
	$command = $this->db->prepare("INSERT INTO `mvc_team` (`id`, `names`, `job_title`, `content`, `facebook`, `twitter`, `instagram`, `email`, `logo`) VALUES (NULL, :name, :job, :content, :facebook, :twitter, :instagram, :email, :image)");
  if ($command->execute(array(
    	    ':name'      => $name,
    	    ':job'       => $job_title,
          ':content'   => $content,
    	    ':facebook'  => $facebook,
          ':twitter'   => $twitter,
    	    ':instagram' => $instagram,
          ':email'     => $email,
          ':image'     => $image
         
            ))) 
  {
$proced->status   = "success";
$proced->message = "New member added into the team";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Post not saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }


public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `mvc_team`  ORDER BY `mvc_team`.`id` DESC");
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
 $command = $this->db->prepare("DELETE FROM `mvc_team` WHERE `mvc_team`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Member was Deleted";
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

public function Find($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_team` WHERE id = $id ");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
}

public function update($name,$email,$facebook,$instagram,$twitter,$image,$job_title,$content,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_team` SET `names` = :name, `job_title` = :job, `content` = :content, `facebook` = :facebook, `twitter` = :twitter, `instagram` = :instagram, `email` = :email, `logo` = :image WHERE `mvc_team`.`id` = $id");
  if ($command->execute(array(
          ':name'      => $name,
          ':job'       => $job_title,
          ':content'   => $content,
          ':facebook'  => $facebook,
          ':twitter'   => $twitter,
          ':instagram' => $instagram,
          ':email'     => $email,
          ':image'     => $image
            ))) 
  {
$proced->status   = "success";
$proced->message = "Member was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Member was not saved";
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
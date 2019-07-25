<?php
/**
* 
*/
class gallery_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}

	public function addnew($name,$content,$index)
	{
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `mvc_image_folder` (`id`, `name`, `content`, `index`) VALUES (NULL,:name,:content, :index)");
  if ($command->execute(array(
    	    ':name'     => $name,
    	    ':content'  => $content,
    	    ':index'    => $index
            ))) 
  {
$proced->status   = "success";
$proced->message = "Folder ".$name." created";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Folder ".$name." not created";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }


public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `mvc_image_folder`");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']      = $row['id'];
        $row_array['name']    = $row['name'];  
        $row_array['content'] = $row['content']; 
        $row_array['index']   = $row['index'];

        $row_array['items'] = array(); 
        $index =  $row_array['index'];
        

 $command2 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE folder_name = :index");
 $command2->execute(array(':index' => $index));
if($command2->rowCount()  > 0)
{ 
 $row_array['items_number']   = $command2->rowCount();
}
else
{
  $row_array['items_number']   = 0;
}

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_image_folder` WHERE `mvc_image_folder`.`id` = :id");
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

public function FindFolder($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_image_folder` WHERE id = $id ");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']      = $row['id'];
        $row_array['name']    = $row['name'];  
        $row_array['content'] = $row['content']; 
        $row_array['index']   = $row['index'];

array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($name,$content,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_image_folder` SET `name` = :name, `content` = :content WHERE `mvc_image_folder`.`id` = $id");
  if ($command->execute(array(
          ':name'   => $name,
          ':content'  => $content
            ))) 
  {
$proced->status   = "success";
$proced->message = "Folder Updated to ".$name;
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Folder not created";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

 }
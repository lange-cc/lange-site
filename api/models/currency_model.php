<?php
/**
*
*/
class currency_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}




public function addnew($name,$logo,$rates)
	{
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `mvc_currency` (`id`, `name`, `logo`, `rates`) VALUES (NULL, :name, :logo, :rates)");
  if ($command->execute(array(
    	    ':name'  => $name,
    	    ':logo'  => $logo,
    	    ':rates' => $rates
            )))
  {
$proced->status  = "success";
$proced->message = "New currency was added";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Currency not added";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}


public function Showlanguage()
{
 $command = $this->db->prepare("SELECT * FROM `mvc_currency`");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['name'];
        $row_array['logo']   = $row['logo'];
        $row_array['rates']  = $row['rates'];     

array_push($json_response, $row_array);
    }

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_currency` WHERE `mvc_currency`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status  = "success";
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



public function findcurrency($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_currency` WHERE id = $id ");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name'];
        $row_array['logo']  = $row['logo'];
        $row_array['rates'] = $row['rates'];


array_push($json_response, $row_array);
}

echo json_encode($json_response);
}
}



public function update($name,$logo,$rates,$id)
{
$proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_currency` SET `name` = :name, `logo` = :logo, `rates` = :rates WHERE `mvc_currency`.`id` = $id");
  if ($command->execute(array(
          ':name'  => $name,
          ':logo'  => $logo,
          ':rates' => $rates
            )))
  {
$proced->status  = "success";
$proced->message = "Currency was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Currency was not updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}



 }

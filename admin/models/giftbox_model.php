<?php
/**
* 
*/
class giftbox_model extends model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function logout()
  {
      header('location: ../../login/');
  }



public function FindsubSubcategory($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_id = $id");
 $command->execute();
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']   = $row['id'];
        $row_array['name'] = $row['name']; 
        $row_array['level'] = $row['level'];
        $row_array['parent_id'] = $row['parent_id'];  
            $id   = $row['id'];
        $row_array['sub'] = $this->Findsubcategory($id);
        array_push($json_response, $row_array);
      }
      return $json_response;
}
else
{
  return 'none';
}

}


public function Findsubcategory($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_id = $id");
 $command->execute();
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']   = $row['id'];
        $row_array['name'] = $row['name']; 
        $row_array['level'] = $row['level']; 
        $row_array['parent_id'] = $row['parent_id']; 
            $id   = $row['id'];
        $row_array['sub'] = $this->FindsubSubcategory($id);
        array_push($json_response, $row_array);
      }

      return $json_response;
}
else
{
return 'none';
}

}




public function Categoryview()
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE level = 1");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
{
  $row_array = array();
  $row_array['id']   = $row['id'];
  $row_array['name'] = $row['name'];
  $row_array['level'] = $row['level']; 
  $row_array['parent_id'] = $row['parent_id']; 

  $id   = $row['id'];
  $row_array['sub']  = $this->Findsubcategory($id);

  array_push($json_response, $row_array);
}

return json_encode($json_response);
}
else
{
  $row_array = array();
  $row_array['status']   = 'none';
  array_push($json_response, $row_array);
  return $json_response;
}


}




public function addnew($name,$main_img,$price,$box_index)
  {
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `product_gift_box` (`id`, `name`, `description`, `price`, `logo`, `box_index`, `type`) VALUES (NULL, :name, '', :price, :main_img, :index, 'box')");
  if ($command->execute(array(
          ':name'        => $name,
          ':main_img'    => $main_img,
          ':price'       => $price,
          ':index'       => $box_index
            ))) 
  {
$proced->status  = "success";
$proced->message = "Giftbox was Added";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Giftbox was not Added";
$myJSON = json_encode($proced);
echo $myJSON;
  }

   }


public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `product_gift_box` ORDER BY `product_gift_box`.`id` DESC");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']       = $row['id'];
        $row_array['name']     = $row['name']; 
        $row_array['price']    = $row['price'];  
        $row_array['img']      = $row['logo'];

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `product_gift_box` WHERE `product_gift_box`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Data was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Data was not Deleted";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }

public function Findgift($id)
{

$command = $this->db->prepare("SELECT * FROM `product_gift_box` WHERE id = $id");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name']; 
        $row_array['price'] = $row['price']; 
        $row_array['logo']  = $row['logo'];

array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($name,$img,$price,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `product_gift_box` SET `name` = :name, `price` = :price, `logo` = :main_img WHERE `product_gift_box`.`id` = $id");
  if ($command->execute(array(
          ':name'        => $name,
          ':main_img'    => $img,
          ':price'       => $price
            ))) 
  {
$proced->status   = "success";
$proced->message = "Giftbox item was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Giftbox was not updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

 }

 ?>
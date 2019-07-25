<?php
/**
*
*/
class category_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}

	public function addnew($name,$level,$parent_id,$index,$parent_index)
	{
    $proced = new \stdClass();
		  $command = $this->db->prepare("INSERT INTO `mvc_category` (`id`, `name`, `level`, `parent_id`,`lang`,`category_index`,`parent_index`) VALUES (NULL, :name, :level, :parent_id,:lang,:index,:parindex)");
  if ($command->execute(array(
    	    ':name'      => $name,
          ':level'     => $level,
          ':parent_id' => $parent_id,
          ':index'     => $index,
          ':lang'      => 'en',
          ':parindex'  => $parent_index

            )))
  {
$proced->status   = "success";
$proced->message = "Category created";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Category not created";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }


public function FindsubSubcategory($index)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_index = :index AND lang = :lang");
 $command->execute( array(
  ':lang' => LANG,
  ':index'=> $index
 ));
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name'];
        $row_array['level'] = $row['level'];
        $row_array['parent_id'] = $row['parent_id'];
        $row_array['parent_index']   = $row['parent_index'];
        $row_array['category_index'] = $row['category_index'];
        $index = $row['category_index'];
        $row_array['sub'] = $this->Findsubcategory($index);
        array_push($json_response, $row_array);
      }
      return $json_response;
}
else
{
  return 'none';
}

}


public function Findsubcategory($index)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_index = :index  AND lang = :lang");
 $command->execute(array(
  ':lang' => LANG,
  ':index'=> $index

   ));
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
        $row_array['parent_index']   = $row['parent_index'];
        $row_array['category_index'] = $row['category_index'];
        $index = $row['category_index'];
        $row_array['sub'] = $this->FindsubSubcategory($index);
        array_push($json_response, $row_array);
      }

      return $json_response;
}
else
{
return 'none';
}

}




public function FindData()
{

 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE level = 1 AND lang = :lang");
 $command->execute(array(':lang' => LANG ));
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
  $row_array['parent_index']   = $row['parent_index'];
  $row_array['category_index'] = $row['category_index'];

  $index   = $row['category_index'];
  $row_array['sub']  = $this->Findsubcategory($index);

  array_push($json_response, $row_array);
}

return json_encode($json_response);
}
else
{
  // $row_array = array();
  // $row_array['status']   = 'none';
  // array_push($json_response, $row_array);
  // return $json_response;
}


}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_category` WHERE `mvc_category`.`id` = :id");
  if ($command->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Category was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Category was not Deletes";
$myJSON = json_encode($proced);
echo $myJSON;
  }
   }

public function Find($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE id = $id ");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
  while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
        $row_array = array();
        $row_array['id']   = $row['id'];
        $row_array['name'] = $row['name'];

array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($id,$name)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_category` SET `name` = :name WHERE `mvc_category`.`id` = $id");
  if ($command->execute(array(
          ':name' => $name
            )))
  {
$proced->status  = "success";
$proced->message = "Category was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Category was not updated";
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

public function copyData($lang)
{
  $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE lang = 'en'");
 $command->execute();
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
   $num = 0;
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
      $num = $num + 1;
        $id        = $row['id'];
        $name      = $row['name'];
        $level     = $row['level'];
        $parent_id = $row['parent_id'];
        $index     = $row['category_index'];
        $parindex  = $row['parent_index'];
    
$command2 = $this->db->prepare("SELECT * FROM `mvc_category` WHERE lang = :lang AND category_index  = :index");
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
$this->addcopy($name,$level,$parent_id,$lang,$index,$parindex);

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

public function addcopy($name,$level,$parent_id,$lang,$index,$parindex)
  {
    $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `mvc_category` (`id`, `name`, `level`, `parent_id`,`lang`,`category_index`,`parent_index`) VALUES (NULL, :name, :level, :parent_id,:lang,:index,:parindex)");
  if ($command->execute(array(
          ':name'      => $name,
          ':level'     => $level,
          ':parent_id' => $parent_id,
          ':lang'      => $lang,
          ':index'     => $index,
          ':parindex'  => $parindex
          
            )))
  {}
  else
  {}

}



 }

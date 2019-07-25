<?php
/**
*
*/
class language_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}




public function addnew($name,$abrev,$type)
	{
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `mvc_language` (`id`, `name`, `abreviation`, `type`) VALUES (NULL, :name, :abrev, :type)");
  if ($command->execute(array(
    	    ':name'  => $name,
    	    ':abrev' => $abrev,
    	    ':type'  => $type
            )))
  {
$proced->status  = "success";
$proced->message = "Language was added";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Language not added";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}


public function Showlanguage()
{
 $command = $this->db->prepare("SELECT * FROM `mvc_language`");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']           = $row['id'];
        $row_array['name']         = $row['name'];
        $row_array['abreviation '] = $row['abreviation'];
        $row_array['type']         = $row['type'];

        $abrev = $row['abreviation'];

$command1 = $this->db->prepare("SELECT * FROM `mvc_lang_keywords` WHERE abreviation = :abrev");
$command1->execute(array(':abrev' => $abrev ));

if($command1->rowCount()  > 0)
{
   $row_array['keywordNumber'] = $command1->rowCount();
}
else
{
  $row_array['keywordNumber'] = 0;
}      

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_language` WHERE `mvc_language`.`id` = :id");
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

public function DeleteKeyword($id)
{
   $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_lang_keywords` WHERE `mvc_lang_keywords`.`id` = :id");
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

public function findlanguage($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_language` WHERE id = $id ");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name'];
        $row_array['abrev'] = $row['abreviation'];
        $row_array['type']  = $row['type'];


array_push($json_response, $row_array);
}

echo json_encode($json_response);
}
}



public function update($name,$abrev,$type,$id)
{
  if ($type == 'default') {

$command = $this->db->prepare("UPDATE `mvc_language` SET  `type` = 'other'");
  if($command->execute())
  {
    $this->LanguageUpdate($name,$abrev,$type,$id);
  }

  }
  else
  {
    $this->LanguageUpdate($name,$abrev,$type,$id);
  }

}



public function LanguageUpdate($name,$abrev,$type,$id)
{
  $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_language` SET `name` = :name, `abreviation` = :abrev, `type` = :type WHERE `mvc_language`.`id` = $id");
  if ($command->execute(array(
          ':name'  => $name,
          ':abrev' => $abrev,
          ':type'  => $type
            )))
  {
$proced->status   = "success";
$proced->message = "Language was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Language was not updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

public function GetlanguageAbrev($id)
{
$command = $this->db->prepare("SELECT * FROM `mvc_language` WHERE id = $id ");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $abrev = $row['abreviation'];
     }
return $abrev;
}
}

public function Addnewkeyword($keyword,$key,$abrev,$langId)
{
  $proced = new \stdClass();
  $status = $this->Checkifkeyexist($key,$keyword,$abrev);

if ($status == 1) {
$proced->status  = "fail";
$proced->message = "keyword exist";
$myJSON = json_encode($proced);
echo $myJSON;
  }
  else if($status == 0)
  {
$command = $this->db->prepare("INSERT INTO `mvc_lang_keywords` (`id`, `lang_id`, `keyword`, `keytext`, `abreviation`) VALUES (NULL, :langId, :keyword, :key, :abrev)");
  if ($command->execute(array(
          ':langId'  => $langId,
          ':keyword' => $keyword,
          ':key'     => $key,
          ':abrev'   => $abrev
            )))
  {
$proced->status  = "success";
$proced->message = "keyword was added";
$proced->key     = $key;
$proced->keyword = $keyword;
$proced->id = $this->getlangkeyid($key,$keyword);
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "keyword not added";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}
}



public function GetLanguage($id)
{
  $command = $this->db->prepare("SELECT * FROM `mvc_language` WHERE id = $id ");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name'];
        $row_array['abrev'] = $row['abreviation'];
        $row_array['type']  = $row['type'];
        $id                 = $row['id'];

        $row_array['keywords'] = $this->GetKeywords($id);
       

array_push($json_response, $row_array);
}

return json_encode($json_response);
}
}



public function GetKeywords($id)
{
$command = $this->db->prepare("SELECT * FROM `mvc_lang_keywords` WHERE lang_id = $id ");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
        $row_array = array();
        $row_array['id']       = $row['id'];
        $row_array['lang_id']  = $row['lang_id'];
        $row_array['keyword']  = $row['keyword'];
        $row_array['key']      = $row['keytext'];
        $row_array['abrev']    = $row['abreviation'];

array_push($json_response, $row_array);
}
return $json_response;
}
else
{
  return 'none';
}
}


public function GetId()
{
$command = $this->db->prepare("SELECT * FROM `mvc_language` WHERE type = 'default'");
$command->execute();
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
        $id        = $row['id'];
}
return $id;
}
}

public function getlangkeyid($key,$keyword)
{
$command = $this->db->prepare("SELECT * FROM `mvc_lang_keywords` WHERE keytext = :key AND keyword =:keyword");
$command->execute(array(':key' => $key,':keyword'=>$keyword));
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
        $id        = $row['id'];
}
return $id;
}
else
{
  return 0;
}
}


public function Checkifkeyexist($key,$keyword,$abrev)
{
  $command = $this->db->prepare("SELECT * FROM `mvc_lang_keywords` WHERE abreviation = :abrev AND keytext = :key");
$command->execute(array(':abrev' => $abrev,':key' => $key));
if($command->rowCount()  > 0)
{
  return 1;
}
else
{
  return 0;
}
}

public function updatekeyword($keyword,$key,$id)
{
    $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_lang_keywords` SET `keyword` = :keyword, `keytext` = :key WHERE `mvc_lang_keywords`.`id` = $id");
  if ($command->execute(array(
          ':keyword'  => $keyword,
          ':key'      => $key
            )))
  {
$proced->status   = "success";
$proced->message = "Saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Fail";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


public function copy($DefaultlangId,$EditlangId,$abrev)
{
  
$command = $this->db->prepare("SELECT * FROM `mvc_lang_keywords` WHERE lang_id = $DefaultlangId");
$command->execute();
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
$keyword = $row['keyword'];
$key     = $row['keytext'];
$this->Addnewkeyword($keyword,$key,$abrev,$EditlangId);   
}

}

}


 }

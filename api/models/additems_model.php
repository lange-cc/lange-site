<?php
/**
* 
*/
class additems_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}


public function FindData($index)
   {

 $command = $this->db->prepare("SELECT * FROM `mvc_images` WHERE folder_name  = :index ORDER BY `mvc_images`.`id` DESC");
 $command->execute(array(':index' => $index));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id'] = $row['id'];
        $row_array['image_name'] = $row['name']; 
       
      
array_push($json_response, $row_array);

    }
return json_encode($json_response);


}
      
}

   public function delete($val)
   {
$proced = new \stdClass();

$command1 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE id = :id");
$command1->execute(array(':id' => $val));
if($command1->rowCount()  > 0)
{ 
while ($row1 = $command1->fetch(PDO::FETCH_ASSOC)) 
{
 $file_name = $row1['name']; 
}

if (file_exists('../public/all-images/'.$file_name)) {
$path = '../public/all-images/'.$file_name;
$thumbnail_path = '../public/all-images/thumbnail/'.$file_name;
if (unlink($path) && unlink($thumbnail_path)) {

  if (file_exists('../public/medium/all-images/'.$file_name)) 
  {
    unlink('../public/medium/all-images/'.$file_name);
  }

$command = $this->db->prepare("DELETE FROM `mvc_images` WHERE id = :id");
if ($command->execute(array(':id' => $val ))) {
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
else
{
 $proced->status   = "fail";
$proced->message = "image was not Deleted";
$myJSON = json_encode($proced);
echo $myJSON; 
}
}
else
{
$command4 = $this->db->prepare("DELETE FROM `mvc_images` WHERE id = :id");
if ($command4->execute(array(':id' => $val ))) {
$proced->status   = "success";
$proced->message = "Data was Delete but Image not exist";
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


}


   }

   public function DeleteArticle($id)
  {
    $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_article` WHERE id = :id");
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

  public function getImage()
  {
$command = $this->db->prepare("SELECT * FROM `mvc_uploaded_img` ORDER BY `mvc_uploaded_img`.`id` DESC");

   $command->setFetchMode(PDO::FETCH_ASSOC);
   $command->execute();
     $data = $command->fetchAll();

      if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
  }




  public function DeleteImage($id,$file_name)
  {
    $proced = new \stdClass();
if (file_exists('public/upload/all_images/'.$file_name)) {
$path = 'public/upload/all_images/'.$file_name;
$thumbnail_path = 'public/upload/all_images/thumbnail/'.$file_name;
$command = $this->db->prepare("DELETE FROM `mvc_uploaded_img` WHERE `mvc_uploaded_img`.`id` = $id");

if (unlink($path) && unlink($thumbnail_path)) {
  if ($command->execute()) {
$proced->status   = "success";
$proced->message = "Image was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;
  }
  else
  {
    $proced->status   = "fail";
$proced->message = "image not Deleted in database";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}
else
{
 $proced->status   = "fail";
$proced->message = "image was not Deleted";
$myJSON = json_encode($proced);
echo $myJSON; 
}


}
else
{
$command = $this->db->prepare("DELETE FROM `mvc_uploaded_img` WHERE `mvc_uploaded_img`.`id` = $id");
if ($command->execute()) {
$proced->status   = "success";
$proced->message = 'Image was deleted in db';
$myJSON = json_encode($proced);
echo $myJSON;
  }
  else
  {
$proced->status  = "fail";
$proced->message = "image not Deleted in database";
$myJSON = json_encode($proced);
echo $myJSON;
  } 
}

  } 

  public function addArticle($title,$subTitle,$img,$content,$section_index,$article_index)
  {
    $proced = new \stdClass();
   $command = $this->db->prepare("INSERT INTO `mvc_article` (`id`, `title`, `subtitle`, `content`, `article_index`, `logo`, `section_index`) VALUES (NULL, :title, :subtitle, :content, :article_index, :logo, :section_index)");
   if ($command->execute(array(
        ':title'         => $title,
        ':subtitle'      => $subTitle,
        ':content'       => $content,
        ':article_index' => $article_index,
        ':logo'          => $img,
        ':section_index' => $section_index

        )))
   {
$proced->status  = "success";
$proced->message = "Article was Saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }


  }

  public function FindArticle($id)
  {
   $command = $this->db->prepare("SELECT * FROM `mvc_article` WHERE id = :id");
   $command->setFetchMode(PDO::FETCH_ASSOC);
   $command->execute(array(':id' => $id));
    $data = $command->fetchAll();

      if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
  }

public function sectionUpdate($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id = :id ");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['title'] = $row['title']; 
        $row_array['discription'] = $row['discription']; 
        array_push($json_response, $row_array);
      }
      
      echo json_encode($json_response);
    }

}
public function sectionView($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id = :id ");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['title'] = $row['title']; 
        $row_array['discription'] = $row['discription']; 
        array_push($json_response, $row_array);
      }
      
      echo json_encode($json_response);
    }

}
public function Update($title, $content, $id)
{
 $proced = new \stdClass();
   $command = $this->db->prepare("UPDATE `mvc_section` SET `title` = :title, `discription` = :content WHERE `mvc_section`.`id` = $id ");
   if ($command->execute(array(
        ':title'         => $title,
        ':content'       => $content
        )))
   {
$proced->status  = "success";
$proced->message = "Section was Updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

public function ArticleUpdate($title,$subTitle,$id,$img,$content)
{
  $proced = new \stdClass();
   $command = $this->db->prepare("UPDATE `mvc_article` SET `title` = :title, `subtitle` = :subtitle, `content` = :content, `logo` = :logo WHERE `mvc_article`.`id` = $id ");
   if ($command->execute(array(
        ':title'         => $title,
        ':subtitle'      => $subTitle,
        ':content'       => $content,
        ':logo'          => $img
        )))
   {
$proced->status  = "success";
$proced->message = "Article was Updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

}

?>
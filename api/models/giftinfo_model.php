<?php
/**
* 
*/
class giftinfo_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}


public function FindGift($id)
   {

$command = $this->db->prepare("SELECT * FROM `product_gift_box` WHERE id = :id");
$command->execute(array(':id' => $id));
$json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
  while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
    {
        $row_array = array();
        $row_array['id']      = $row['id'];
        $row_array['name']    = $row['name']; 
        $row_array['price']   = $row['price'];  
        $row_array['img']     = $row['logo'];
        $row_array['content'] = $row['description'];
        $row_array['index']   = $row['box_index'];

        array_push($json_response, $row_array);
}
}

return json_encode($json_response);

}

public function FindProductOfGift($id)
{
   $json_response = array(); //Create an array
$command = $this->db->prepare("SELECT * FROM `product_gift_box` WHERE id = :id");
$command->execute(array(':id' => $id));
if($command->rowCount()  > 0)
{ 
while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
{
 $index  = $row['box_index'];
}

$command2 = $this->db->prepare("SELECT * FROM `product_of_gift` WHERE gift_index = :index");
$command2->execute(array(':index' => $index));
if($command2->rowCount()  > 0)
{ 
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) 
{
$row_array = array();
$row_array['id'] = $row2['id'];
$product_id      = $row2['product_id'];

$command3 = $this->db->prepare("SELECT * FROM `product` WHERE id = :product_id");
$command3->execute(array(
  ':product_id' => $product_id 
  ));
if($command3->rowCount()  > 0)
{ 
while ($row3 = $command3->fetch(PDO::FETCH_ASSOC)) 
     {
        
        $row_array['product_name'] = $row3['product_name']; 
        $row_array['price']        = $row3['price'];  
        $row_array['img']          = $row3['main_img'];

     }

}

array_push($json_response, $row_array);

}
}


}
return json_encode($json_response);
}



public function Findproduct()
{

 $command = $this->db->prepare("SELECT * FROM `product` ORDER BY `product`.`id` DESC");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']           = $row['id'];
        $row_array['product_name'] = $row['product_name']; 
        $row_array['price']        = $row['price'];  
        $row_array['img']          = $row['main_img'];

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}      

public function ChangeData($content,$id)
{
$proced = new \stdClass();
$command = $this->db->prepare("UPDATE `product_gift_box` SET `description` = :content WHERE `product_gift_box`.`id` = $id");
if ($command->execute(array(':content' => $content )))
  {
$proced->status  = "success";
$proced->message = "This data saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "This,Data was not Saved,try again.";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


public function Addcolor($name,$index)
{
  $proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `product_colors` (`id`, `color_name`, `color_index`) VALUES (NULL, :name, :index)");
if ($command->execute(array(
        ':name'  => $name,
        ':index' => $index

        )))
   {
$proced->status  = "success";
$proced->message = "Color added.";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Color not added.";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


   public function imgDelete($id)
   {
$proced = new \stdClass();

$command1 = $this->db->prepare("SELECT * FROM `product_images` WHERE id = :id");
$command1->execute(array(':id' => $id));
if($command1->rowCount()  > 0)
{ 
while ($row1 = $command1->fetch(PDO::FETCH_ASSOC)) 
{
 $file_name = $row1['image_name']; 
}

if (file_exists('../images/'.$file_name)) {
$path = '../images/'.$file_name;
$thumbnail_path = '../images/thumbnail/'.$file_name;
if (unlink($path) && unlink($thumbnail_path)) {

$command = $this->db->prepare("DELETE FROM `product_images` WHERE id = :id");
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
$command4 = $this->db->prepare("DELETE FROM `product_images` WHERE id = :id");
if ($command4->execute(array(':id' => $id ))) {
$proced->status   = "success";
$proced->message = "Data was Deleted, but Image not exist";
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

public function Delete($id)
{
    $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `product_of_gift` WHERE id = :id");
  if ($command->execute(array(':id' => $id ))) 
  {
$proced->status   = "success";
$proced->message = "Product removed";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Product not removed";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

public function colorDelete($id)
{
     $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `product_colors` WHERE id = :id");
if ($command->execute(array(':id' => $id ))) {
$this->coloeimgDelete($id);
$proced->status  = "success";
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



 public function coloeimgDelete($id)
   {
$proced = new \stdClass();

$command1 = $this->db->prepare("SELECT * FROM `product_images` WHERE color_id = :id");
$command1->execute(array(':id' => $id));
if($command1->rowCount()  > 0)
{ 
while ($row1 = $command1->fetch(PDO::FETCH_ASSOC)) 
{
 $file_name = $row1['image_name']; 
}

if (file_exists('../images/'.$file_name)) {
$path = '../images/'.$file_name;
$thumbnail_path = '../images/thumbnail/'.$file_name;
if (unlink($path) && unlink($thumbnail_path)) 
{
$command = $this->db->prepare("DELETE FROM `product_images` WHERE color_id = :id");
$command->execute(array(':id' => $id ));
}
else
{
$command4 = $this->db->prepare("DELETE FROM `product_images` WHERE color_id = :id");
$command4->execute(array(':id' => $id ));
}
}

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


public function join($pro_id,$gif_id)
{
$proced = new \stdClass();
$command = $this->db->prepare("SELECT * FROM `product_of_gift` WHERE gift_index = :gif_id AND product_id = :pro_id");
$command->execute(array(
  ':pro_id' => $pro_id,
  ':gif_id' => $gif_id
  ));
if($command->rowCount()  > 0)
{ 
$proced->status  = "fail";
$proced->message = "Product exist";
$myJSON = json_encode($proced);
echo $myJSON;
}
else
{

$command = $this->db->prepare("INSERT INTO `product_of_gift` (`id`, `gift_index`, `product_id`) VALUES (NULL, :gif_id, :pro_id)");
if($command->execute(array(':pro_id' => $pro_id,':gif_id' => $gif_id )))
  {
$proced->status  = "success";
$proced->message = "product Added";
$myJSON = json_encode($proced);
echo $myJSON;
  }
  else
  {
$proced->status  = "fail";
$proced->message = "product not added";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

}


}

?>
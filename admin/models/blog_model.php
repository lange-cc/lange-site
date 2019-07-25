<?php
/**
* 
*/
class blog_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}

	public function addnew($title,$img_name,$author,$content,$added_date,$update_date,$views,$index)
	{
    $proced = new \stdClass();
		  $command = $this->db->prepare("INSERT INTO `mvc_blog` (`id`, `Title`, `content`, `logo`, `author_id`, `views`, `added_date`, `updated_date`,`lang`, `blog_index`) VALUES ( NULL, :title, :content, :img, :author, :views, :added_date, :updated_date, :lang, :index)");
  if ($command->execute(array(
    
    	    ':title'        => $title,
    	    ':img'          => $img_name,
    	    ':author'       => $author,
    	    ':content'      => $content,
          ':added_date'   => $added_date,
          ':updated_date' => $update_date,
          ':views'        => $views,
          ':lang'         => 'en',
          ':index'        => $index
            ))) 
  {
$proced->status   = "success";
$proced->message = "New blog post was added";
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

 $command = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE lang = :lang ORDER BY `mvc_blog`.`id` DESC");
 $command->execute( array(':lang' => LANG ));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']             = $row['id'];
        $row_array['Title']          = $row['Title']; 
        $row_array['content']        = $row['content']; 
        $row_array['logo']           = $row['logo']; 
        $row_array['author_id']      = $row['author_id'];
        $row_array['views']          = $row['views'];
        $row_array['added_date']     = $row['added_date']; 
        $row_array['updated_date']   = $row['updated_date']; 
        $row_array['comment'] = array(); 
        $row_array['author_data'] = array(); 
        $id = $row['id'];
        $author_id = $row['author_id'];

 $command2 = $this->db->prepare("SELECT * FROM `mvc_comment` WHERE post_id = :id");
 $command2->execute(array(':id' => $id));
if($command2->rowCount()  > 0)
{ 
     while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) 
     {
       $row_array['comment'][] = array(
                'id'            => $row2['id'],
                'post_id'       => $row2['post_id'],
                'name'          => $row2['name'],
                'content'       => $row2['content'],
                'added_date'    => $row2['added_date']
            );

     }
     $row_array['comment_number']   = $command2->rowCount();
   }
   else
   {
    $row_array['comment_number']   = 0;
   }


 $command3 = $this->db->prepare("SELECT * FROM `mvc_author` WHERE id = :id");
 $command3->execute(array(':id' => $author_id));
if($command3->rowCount()  > 0)
{ 
     while ($row2 = $command3->fetch(PDO::FETCH_ASSOC)) 
     {
       $row_array['author_data'][] = array(
                'id'         => $row2['id'],
                'name'       => $row2['name'],
                'description'=> $row2['description'],
                'logo'       => $row2['logo'],
                'added_date' => $row2['added_date']
            );

          $name       = $row2['name'];
          $author_img = $row2['logo'];
     }
     $row_array['author']        = $author_img;
     $row_array['author_name']   = $name;
   }
   else
   {
    $row_array['author']   = 'none';
   }




array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_blog` WHERE `mvc_blog`.`id` = :id");
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

public function Findproduct($id)
{

$command = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE id = $id ");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']             = $row['id'];
        $row_array['Title']          = $row['Title']; 
        $row_array['content']        = $row['content']; 
        $row_array['logo']           = $row['logo']; 
        $row_array['author_id']      = $row['author_id'];

        $author_id = $row['author_id'];


$command3 = $this->db->prepare("SELECT * FROM `mvc_author` WHERE id = :id");
 $command3->execute(array(':id' => $author_id));
if($command3->rowCount()  > 0)
{ 
     while ($row2 = $command3->fetch(PDO::FETCH_ASSOC)) 
     {
       $row_array['author_data'][] = array(
                'id'         => $row2['id'],
                'name'       => $row2['name'],
                'description'=> $row2['description'],
                'logo'       => $row2['logo'],
                'added_date' => $row2['added_date']
            );

          $name       = $row2['name'];
          $author_img = $row2['logo'];
     }
     $row_array['author']   =  $name;
   }
   else
   {
    $row_array['author']   = 'none';
   }


array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($title,$img_name,$author,$content,$update_date,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `mvc_blog` SET `Title` = :title, `content` = :content, `logo` = :img, `author_id` = :author, `updated_date` = :updated_date WHERE `mvc_blog`.`id` =$id");
  if ($command->execute(array(
          ':title'        => $title,
          ':img'          => $img_name,
          ':author'       => $author,
          ':content'      => $content,
          ':updated_date' => $update_date
            ))) 
  {
$proced->status   = "success";
$proced->message = "Blog post was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Blog post was not saved";
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
 $command = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE lang = 'en'");
 $command->execute();
if($command->rowCount()  > 0)
{ 
  $num = 0;
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
  $num = $num + 1;
        $id            = $row['id'];
        $Title         = $row['Title']; 
        $content       = $row['content']; 
        $logo          = $row['logo']; 
        $author_id     = $row['author_id'];
        $views         = $row['views'];
        $added_date    = $row['added_date']; 
        $updated_date  = $row['updated_date']; 
        $author_id     = $row['author_id'];
        $index         = $row['blog_index'];


$command2 = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE lang = :lang AND  blog_index = :index");
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
$this->addcopy($Title,$logo,$author_id,$content,$added_date,$updated_date,$views,$lang,$index);

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

  public function addcopy($title,$img_name,$author,$content,$added_date,$update_date,$views,$lang,$index)
  {
    $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `mvc_blog` (`id`, `Title`, `content`, `logo`, `author_id`, `views`, `added_date`, `updated_date`, `lang`, `blog_index`) VALUES ( NULL, :title, :content, :img, :author, :views, :added_date, :updated_date, :lang, :index)");
  if ($command->execute(array(
          ':title'        => $title,
          ':img'          => $img_name,
          ':author'       => $author,
          ':content'      => $content,
          ':added_date'   => $added_date,
          ':updated_date' => $update_date,
          ':views'        => $views,
          ':lang'         => $lang,
          ':index'        => $index
            ))) 
  {}
  else
  {}

   }


 }
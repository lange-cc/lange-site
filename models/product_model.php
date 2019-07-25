<?php
/**
* 
*/
class product_model extends model
{
	
	function __construct()
	{
	  parent::__construct();
	}

	
public function Findproject($id)
   {
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id  = :id");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['article'] = array(); 
        $section_index = $row['section_index'];

 $command2 = $this->db->prepare("SELECT * FROM `mvc_article` WHERE section_index = :index LIMIT 3");
 $command2->execute(array(':index' => $section_index));
if($command2->rowCount()  > 0)
{ 
     while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) 
     {
       $row_array['article'][] = array(
                'id'            => $row2['id'],
                'title'         => $row2['title'],
                'subtitle'      => $row2['subtitle'],
                'content'       => $row2['content'],
                'article_index' => $row2['article_index'],
                'logo'          => $row2['logo'],
                'section_index' => $row2['section_index']
            );

     }
   }


array_push($json_response, $row_array);

    }
return json_encode($json_response);


}
      
}

public function Finddata($id)
   {
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id  = :id ");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['article'] = array(); 
        $section_index = $row['section_index'];

 $command2 = $this->db->prepare("SELECT * FROM `mvc_article` WHERE section_index = :index");
 $command2->execute(array(':index' => $section_index));
if($command2->rowCount()  > 0)
{ 
     while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) 
     {
       $row_array['article'][] = array(
                'id'            => $row2['id'],
                'title'         => $row2['title'],
                'subtitle'      => $row2['subtitle'],
                'content'       => $row2['content'],
                'article_index' => $row2['article_index'],
                'logo'          => $row2['logo'],
                'section_index' => $row2['section_index']
            );

     }
   }


array_push($json_response, $row_array);

    }
return json_encode($json_response);


}
      
}


public function BlogData($limit)
{

 $command = $this->db->prepare("SELECT * FROM `mvc_blog`  ORDER BY `mvc_blog`.`id` DESC LIMIT $limit");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']             = $row['id'];
        $row_array['title']          = $row['Title']; 
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




public function FindProduct()
{

$command = $this->db->prepare("SELECT * FROM `product`  ORDER BY `product`.`id` DESC");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']       = $row['id'];
        $row_array['car_name'] = $row['car_name']; 
        $row_array['Price']    = $row['Price']; 
        $row_array['speed']    = $row['speed']; 
        $row_array['img']      = $row['img'];

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}


public function sendnewmail($name,$email,$emailTo,$subject,$message)
  {
    $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `mvc_message` (`id`, `names`, `mail_to`, `mail_from`, `subject`, `content`, `status`, `type`, `reply_id`, `date`) VALUES (NULL,:names, :mail_to, :mail_from, :subject, :content, :status, :type, :reply_id, now())");
  if ($command->execute(array(
    ':names'     => $name,
    ':mail_to'   => $emailTo,
    ':mail_from' => $email,
    ':subject'   => $subject,
    ':content'   => $message,
    ':status'    => 0,
    ':type'      => 'inbox',
    ':reply_id'  => '0'
            ))) 
  {
}
}

public function randomnumber($length = 15) {
    $characters = '3456013454563456345345634566734568962345634563445634563453445634563453456345664563456345345634566734568973456895634566734568953456345667345689';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

public function ourTeam()
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
	
}

?>
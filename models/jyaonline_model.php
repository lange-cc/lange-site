<?php
/**
*
*/
class jyaonline_model extends model
{

	function __construct()
	{
	  parent::__construct();
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

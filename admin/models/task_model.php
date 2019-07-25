<?php
/**
* 
*/
class task_model extends model
{
	  
function __construct()
  {
    parent::__construct();
  }



public function project()
{
 $yyy = date("Y");
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_accounts` WHERE `year` = $yyy  ORDER BY `org_accounts`.`id` DESC");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']      = $row['id'];
        $row_array['name']    = $row['name'];
        $row_array['content'] = $row['content'];  
        $row_array['date']    = $row['added_date'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  }
}

public function userdata($id)
{
    
 $command = $this->db->prepare("SELECT * FROM `login`  WHERE id = $id");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
       return $data;
    }
}



public function todaytask($id)
{
  $dd  = date("d");
  $mm  = date("m");
  $yyy = date("Y");
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `user` = $id AND `dd`= :dd AND `mm`= :mm AND `yyy`= :yyy  ORDER BY `org_activities`.`id` DESC");
 $command->execute(array(
  ':dd'  => $dd,
  ':mm'  => $mm,
  ':yyy' => $yyy

   ));
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['content']= $row['activity_name'];
        $project = $row['org_account_id'];
        $row_array['project']= $this->getProjectname($project); 
        $row_array['date']   = $row['added_date'];
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
}


public function alltask($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `user` = $id  ORDER BY `org_activities`.`id` DESC");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['content']= $row['activity_name'];
        $project = $row['org_account_id'];
        $row_array['project']= $this->getProjectname($project); 
        $task_id = $row['id'];
        $row_array['comment']= $this->GetComment($task_id );
        $row_array['date']   = $row['added_date'];
        $row_array['status'] = $row['Status'];
array_push($json_response, $row_array);
    }
return json_encode($json_response);
  } 
}



public function GetComment($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activitie_comments` WHERE `activity_id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['content']= $row['comment']; 
        $user_id             = $row['user_id']; 
        $row_array['profile']= $this->userdata($user_id);
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return $json_response;
  } 
}

public function AddComment($user,$activity,$comment)
{
      $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `org_activitie_comments` (`id`, `activity_id`, `user_id`, `comment`, `added_date`) VALUES (NULL, :activity, :user, :comment, CURRENT_TIMESTAMP)");
  if ($command->execute(array(
          ':user'     => $user,
          ':activity' => $activity,
          ':comment'  => $comment
            ))) 
  {

 $comment_profile = json_decode(json_encode($this->userdata($user))); 
 if ($comment_profile != null) {
 foreach ($comment_profile as $key=> $value) 
{
  $logo =  $comment_profile[$key]->logo;
  $name =  $comment_profile[$key]->name; 
}
}

  $proced->status  = "success";
  $proced->message = "none";
  $proced->html    = '<li>
    <div class="comment-widget">
      <div class="img">

      
      </div>
      <div class="live-comment-content">
        <div class="data">
        <strong>'.$name.'</strong> 
'.$comment.'
        <div>
        <span class="time task-time-label"><i class="fa fa-clock-o"></i> Just now</span>
        </div>
         </div>
      </div>
    </div>
</li>';

  $proced->id      = $activity;
  $myJSON = json_encode($proced);
  echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "failed to save";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}

public function getProjectname($id)
{
 $command = $this->db->prepare("SELECT * FROM `org_accounts` WHERE `id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $name  = $row['name'];
     }

return $name ;
  }
  else
  {
return 'No project';    
  }
}


public function delete($id)
{

$proced = new \stdClass();
$command = $this->db->prepare("DELETE FROM `org_activities` WHERE `org_activities`.`id` = $id");
  if ($command->execute()) 
  {
  $proced->status  = "success";
  $proced->message = "your task removed";
  $myJSON = json_encode($proced);
  echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "failed to remove task";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}


public function AddnewActivity($user,$content,$account,$status)
{
  $dd  = date("d");
  $mm  = date("m");
  $yyy = date("Y");

$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `org_activities` (`id`, `org_account_id`, `activity_name`, `user`, `added_date`, `dd`, `mm`, `yyy`, `Status`) VALUES (NULL, :account, :content, :user, CURRENT_TIMESTAMP, :dd, :mm, :yyy, :status)");
  if ($command->execute(array(
          ':user'     => $user,
          ':account'  => $account,
          ':content'  => $content,
          ':dd'       => $dd,
          ':mm'       => $mm,
          ':yyy'      => $yyy,
          ':status'   => $status

            ))) 
  {
  $proced->status  = "success";
  $proced->message = "New activity was added";
  $myJSON = json_encode($proced);
  echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "failed to save activity";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}




public function getActivities($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['content']= $row['activity_name']; 
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return $json_response;
  } 
}




public function getActivitydata($id)
{
   echo json_encode($this->getActivities($id));
}


public function UpdateActivity($id,$content)
{
$proced = new \stdClass();
$command = $this->db->prepare("UPDATE `org_activities` SET `activity_name` = :content WHERE `org_activities`.`id` = $id");
if ($command->execute(array( 
          ':content'   => $content
            ))) 
  {
$proced->status  = "success";
$proced->message = "Activity was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Activity not Updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }
 
}



}


?>
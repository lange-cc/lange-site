<?php
/**
* 
*/
class campany_model extends model
{
	  
function __construct()
  {
    parent::__construct();
  }

public function AddAcount($name,$user,$date,$dd,$mm,$yyy,$content)
  {
    $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `org_accounts` (`id`, `user_id`, `name`, `content`, `added_date`, `dd`, `mm`, `year`) VALUES (NULL, :user, :name, :content, CURRENT_TIMESTAMP, :dd, :mm, :yyy)");
  if ($command->execute(array(
          ':user'       => $user,
          ':name'       => $name,
          ':content'    => $content,
          ':dd'         => $dd,
          ':mm'         => $mm,
          ':yyy'        => $yyy
            ))) 
  {
  $proced->status  = "success";
  $proced->message = "New account was added";
  $myJSON = json_encode($proced);
  echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "Account not saved";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
 }

public function AddYear($year)
 {
  $proced = new \stdClass();
  $command = $this->db->prepare("INSERT INTO `org_accounts_years` (`id`, `yyy`) VALUES (NULL, :yyy)");
if($command->execute(array(
   ':yyy' => $year
       ))) 
  {
    $proced->status  = "success";
    $proced->message = "New year added";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "Year not saved";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
 }

public function listYears()
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_accounts_years` ORDER BY `org_accounts_years`.`yyy` DESC ");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']       = $row['id'];
        $row_array['year']     = $row['yyy']; 
        $yyy                   = $row['yyy'];
        $row_array['accounts'] = $this->listAccount($yyy);
        array_push($json_response, $row_array);
     }
return json_encode($json_response);
   }
}

public function listAccount($yyy)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_accounts` WHERE `year` = $yyy  ORDER BY `org_accounts`.`id` DESC");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['name'];
        $row_array['content'] = $row['content']; 
        $user_id             = $row['user_id']; 
        $row_array['profile']= $this->userdata($user_id);
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return $json_response;
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


public function DeleteAccount($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `org_accounts` WHERE `org_accounts`.`id` = :id");
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


public function ShowAccount($id)
{
    $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_accounts` WHERE `id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['name']; 
        $row_array['content'] = $row['content']; 
        $user_id             = $row['user_id']; 
        $row_array['profile']= $this->userdata($user_id);
        $id                  = $row['id'];
        $row_array['activity'] = $this->getActivity($id);
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
}

public function getActivity($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `org_account_id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['content']= $row['activity_name']; 
        $user_id             = $row['user']; 
        $row_array['profile']= $this->userdata($user_id);
        $id                  = $row['id'];
        $row_array['comment']= $this->GetComment($id);
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return $json_response;
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
        $user_id             = $row['user']; 
        $row_array['profile']= $this->userdata($user_id);
        $id                  = $row['id'];
        $row_array['comment']= $this->GetComment($id);
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return $json_response;
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
  $proced->html    = '<li class="fadeIn"><div> <span class="pull-right time"><i class="fa fa-clock-o"></i> just now</span>
                      <label><img src="'.URL.'all-images/thumbnail/'.$logo.'" class="comment-user-profile"> '.$name.'</label><p>'.$comment.'</p></div></li>';
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

public function AddnewActivity($user,$content,$account)
{
      $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `org_activities` (`id`, `org_account_id`, `activity_name`, `user`, `added_date`) VALUES (NULL, :account, :content, :user, CURRENT_TIMESTAMP)");
  if ($command->execute(array(
          ':user'     => $user,
          ':account'  => $account,
          ':content'  => $content
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


public function AddBilling($activity,$spend,$income,$account)
{
      $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `org_billings` (`id`, `org_account_id`, `billing_activity_name`, `spend`, `income`, `added_date`) VALUES (NULL, :account, :activity, :spent, :income, CURRENT_TIMESTAMP)");
  if ($command->execute(array(
          ':account'   => $account,
          ':activity'  => $activity,
          ':spent'     => $spend,
          ':income'    => $income
            ))) 
  {
  $proced->status  = "success";
  $proced->message = "New Billing was added";
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


public function getBillings($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `org_account_id` = $id  ORDER BY `org_billings`.`id` DESC");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['billing_activity_name']; 
        $row_array['spent']  = $row['spend'];
        $row_array['income'] = $row['income']; 
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
}

public function getAccountdata($id)
{
   echo $this->ShowAccount($id);
}


public function UpdateAccount($id,$name,$content)
{
    $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `org_accounts` SET `name` = :name, `content` = :content WHERE `org_accounts`.`id` = $id");
  if ($command->execute(array( 
          ':name'      => $name,
          ':content'   => $content
            ))) 
  {
$proced->status  = "success";
$proced->message = "Account was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Account not Updated";
$myJSON = json_encode($proced);
echo $myJSON;
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

 }


?>
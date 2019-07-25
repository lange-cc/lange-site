<?php
/**
* 
*/
class report_model extends model
{
	  
function __construct()
  {
    parent::__construct();
  }

public function AllAccount()
{

 $command = $this->db->prepare("SELECT * FROM `login`  ORDER BY `login`.`id` DESC");
 $command->setFetchMode(PDO::FETCH_ASSOC);
 $command->execute();
 $data = $command->fetchAll();

  if ($command->rowCount() > 0) 
    {
   $myJSON = json_encode($data);
    return $myJSON;
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


public function Taskreport($user,$month,$year)
{
  if ($user == 'all') 
  {
       $data =  $this->allusertask($month,$year);
  }
  else
  {
  if ($month == 'today') 
  {
      $data =  $this->todaytask($user);
  }
  elseif($month == 'yest')
  {
    $data =  $this->yesterdaytask($user);
  }
  else
  {
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `user` = $user AND `mm` =  $month AND `yyy`= :yyy  ORDER BY `org_activities`.`id` DESC");
 $command->execute(array(
  ':yyy' => $year

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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];
array_push($json_response, $row_array);
    }

$data = json_encode($json_response);
  }
else
  {
   $data = 0;
  }
  }
}

echo $data;

}



public function allusertask($month,$year)
{
  if ($month == 'today') {
   
    $data =  $this->allusertodaytask();
  }
  else if($month == 'yest')
  {
    $data =  $this->alluseryesterdaytask();
  }
  else
  {
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `mm` =  $month AND `yyy`= :yyy  ORDER BY `org_activities`.`id` DESC");
 $command->execute(array(
  ':yyy' => $year

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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

$data = json_encode($json_response);
  }
else
  {
   $data = 0;
  }
  }

  return $data;
}


public function alluseryesterdaytask()
{
  $dd  = date("d") - 1;
  $mm  = date("m");
  $yyy = date("Y");
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `dd`= :dd AND `mm`= :mm AND `yyy`= :yyy  ORDER BY `org_activities`.`id` DESC");
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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
  else
  {
    return 0;
  }
}
public function allusertodaytask()
{
  $dd  = date("d");
  $mm  = date("m");
  $yyy = date("Y");
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_activities` WHERE `dd`= :dd AND `mm`= :mm AND `yyy`= :yyy  ORDER BY `org_activities`.`id` DESC");
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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
  else
  {
    return 0;
  }
}

public function yesterdaytask($id)
{
  $dd  = date("d") - 1;
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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
  else
  {
    return 0;
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
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
        $row_array['status'] = $row['Status'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
  else
  {
    return 0;
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

public function getClient($id)
{

 $command = $this->db->prepare("SELECT * FROM `org_accounts` WHERE `id` = $id");
 $command->execute();
if($command->rowCount()  > 0)
 { 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $name  = $row['name'];
     }

        return $name;
  }
  else
  {
  return 'Others';
  }
}

public function Billingreport($month,$year)
{
if ($month == 0000) 
  {
    $this->Billingreportperyear($year);
  }
  else
  {
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `mm`= :mm AND `yyy`= :yyy ORDER BY `org_billings`.`id` DESC");
 $command->execute(array(
  ':mm'  => $month,
  ':yyy' => $year

   ));
if($command->rowCount()  > 0)
  { 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['billing_activity_name'];
        $row_array['client'] = $this->getClient($row['org_client']);
        $row_array['spent']  = $row['spend'];
        $row_array['income'] = $row['income']; 
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));

array_push($json_response, $row_array);
    }

echo json_encode($json_response);
  }
  else
  {
    echo "no data";
  }
}
}

public function Billingreportperyear($year)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `yyy`= :yyy ORDER BY `org_billings`.`id` DESC");
 $command->execute(array(
       ':yyy' => $year
   ));
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['billing_activity_name']; 
        $row_array['client'] = $this->getClient($row['org_client']);
        $row_array['spent']  = $row['spend'];
        $row_array['income'] = $row['income']; 
        $row_array['date']   = date('M j Y g:i A', strtotime($row['added_date']));
array_push($json_response, $row_array);
     }
echo json_encode($json_response);
  }
  else
  {
    echo "no data";
  }
}


}


?>
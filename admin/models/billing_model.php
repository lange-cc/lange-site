<?php
/**
* 
*/
class billing_model extends model
{
	  
function __construct()
  {
    parent::__construct();
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





public function AddBilling($activity,$spend,$income,$account,$client)
{

  $dd  = date("d");
  $mm  = date("m");
  $yyy = date("Y");

      $proced = new \stdClass();
      $command = $this->db->prepare("INSERT INTO `org_billings` (`id`, `org_account_id`, `billing_activity_name`, `org_client`, `spend`, `income`, `added_date`, `dd`, `mm`, `yyy`) VALUES (NULL, :account, :activity, :client, :spent, :income, CURRENT_TIMESTAMP, :dd, :mm, :yyy)");
  if ($command->execute(array(
          ':account'   => $account,
          ':activity'  => $activity,
          ':client'    => $client,
          ':spent'     => $spend,
          ':income'    => $income,
          ':dd'        => $dd,
          ':mm'        => $mm,
          ':yyy'       => $yyy
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


public function getBillings($id)
{
  $dd  = date("d");
  $mm  = date("m");
  $yyy = date("Y");
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `org_account_id` = $id AND `dd`= :dd AND `mm`= :mm AND `yyy`= :yyy ORDER BY `org_billings`.`id` DESC");
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
        $row_array['name']   = $row['billing_activity_name']; 
        $row_array['client'] = $this->getClient($row['org_client']); 
        $row_array['spent']  = $row['spend'];
        $row_array['income'] = $row['income']; 
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  } 
}

public function Delete($id)
{
  $proced = new \stdClass();
$command = $this->db->prepare("DELETE FROM `org_billings` WHERE `org_billings`.`id` = $id");
  if ($command->execute()) 
  {
  $proced->status  = "success";
  $proced->message = "your Billing removed";
  $myJSON = json_encode($proced);
  echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "failed to remove billing";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}




public function getBillingdata($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `id` = $id  ORDER BY `org_billings`.`id` DESC");
 $command->execute();
if($command->rowCount()  > 0)
{ 
     while ($row = $command->fetch(PDO::FETCH_ASSOC)) 
     {
        $row_array = array();
        $row_array['id']     = $row['id'];
        $row_array['name']   = $row['billing_activity_name']; 
        $row_array['client']        = $row['org_client'];
        $row_array['client_name']   = $this->getClient($row['org_client']);
        $row_array['spent']  = $row['spend'];
        $row_array['income'] = $row['income']; 

array_push($json_response, $row_array);
    }

echo json_encode($json_response);
  } 
}


public function Update($id,$activity,$spend,$income,$client)
{
    $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `org_billings` SET `billing_activity_name` = :activity, `spend` = :spent, `income` = :income, `org_client`= :client WHERE `org_billings`.`id` = $id");
  if ($command->execute(array( 
          ':activity'=> $activity,
          ':spent'   => $spend,
          ':income'  => $income,
          ':client'  => $client
            ))) 
  {
$proced->status  = "success";
$proced->message = "Billing was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Billing not Updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }
 
}

public function Billings($id)
{
 $json_response = array(); //Create an array
 $command = $this->db->prepare("SELECT * FROM `org_billings`  WHERE `org_account_id` = $id ORDER BY `org_billings`.`id` DESC");
 $command->execute();
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
        $row_array['date']   = $row['added_date'];

array_push($json_response, $row_array);
    }

return json_encode($json_response);
  }
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


}


?>
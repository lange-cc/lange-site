
<?php
/**
* 
*/
class controllerModel
{
	
	function __construct()
	{
	   $this->db = new database();	
	}

public function Gallery($index)
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


public function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

public function detectDevice()
{
  $userAgent = $_SERVER["HTTP_USER_AGENT"];
  $devicesTypes = array(
        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
  foreach($devicesTypes as $deviceType => $devices) {
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst("browser");
  }




public function GetStatistics($page)
{
 
$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$this->getRealIpAddr());

$country=$xml->geoplugin_countryName;
$city=$xml->geoplugin_city;
$device=$this->detectDevice();
if(isset($_SERVER['HTTP_REFERER'])){
  $referrer=$_SERVER['HTTP_REFERER'];
} else {
  $referrer='Direct';
}

if(isset($_COOKIE['user_id'])){
//setcookie("user_id", "", time() - (96400 * 30), "/");
  $cookie=$_COOKIE['user_id'];
  $exist=$this->db->prepare("SELECT * FROM mvc_status WHERE user_id=:user_id AND page=:page");
  $exist->execute(array(
      ':user_id'=>$cookie,
      ':page'   => $page
    ));
  if($exist->rowCount() > 0){
      
    $update=$this->db->prepare("UPDATE `mvc_status` SET `views` = views+1, `time` = now() WHERE `mvc_status`.`page` = :page AND `user_id` = :user_id");
    $update->execute(array(
      ':user_id'=>$cookie,
      ':page'   => $page
      ));
  }
  else
  {
$insert=$this->db->prepare("INSERT into mvc_status(`user_id`, `country`, `city`, `time`, `device`, `page`, `ip`, `views`, `referrer`) VALUES (:user_id, :country, :city, now(), :device, :page, :ip, :views, :referrer)");
  $insert->execute(array(
      ':user_id' => $cookie,
      ':country' => $country,
      ':city' => $city,
      ':device' => $device,
      ':page' => $page,
      ':ip' => $this->getRealIpAddr(),
      ':views' => 1,
      ':referrer' => $referrer
  ));


  }
} else {
  $cookie_name = "user_id";
  $cookie_value = 'User_'.$this->randomnumber(10);
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  $insert=$this->db->prepare("INSERT into mvc_status(`user_id`, `country`, `city`, `time`, `device`, `page`, `ip`, `views`, `referrer`) VALUES (:user_id, :country, :city, now(), :device, :page, :ip, :views, :referrer)");
  $insert->execute(array(
      ':user_id' => $cookie_value,
      ':country' => $country,
      ':city' => $city,
      ':device' => $device,
      ':page' => $page,
      ':ip' => $this->getRealIpAddr(),
      ':views' => 1,
      ':referrer' => $referrer
  ));
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



}

?>
<?php
/**
*
*/
class email_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}


public function FindsubSubcategory($index)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_index = :index AND lang = :lang");
 $command->execute( array(
  ':lang' => LANG,
  ':index'=> $index
 ));
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']    = $row['id'];
        $row_array['name']  = $row['name'];
        $row_array['level'] = $row['level'];
        $row_array['parent_id'] = $row['parent_id'];
        $row_array['parent_index']   = $row['parent_index'];
        $row_array['category_index'] = $row['category_index'];
        $index = $row['category_index'];
        $row_array['sub'] = $this->Findsubcategory($index);
        array_push($json_response, $row_array);
      }
      return $json_response;
}
else
{
  return 'none';
}

}


public function Findsubcategory($index)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE parent_index = :index  AND lang = :lang");
 $command->execute(array(
  ':lang' => LANG,
  ':index'=> $index

   ));
 $json_response = array(); //Create an array
 if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']   = $row['id'];
        $row_array['name'] = $row['name'];
        $row_array['level'] = $row['level'];
        $row_array['parent_id'] = $row['parent_id'];
        $row_array['parent_index']   = $row['parent_index'];
        $row_array['category_index'] = $row['category_index'];
        $index = $row['category_index'];
        $row_array['sub'] = $this->FindsubSubcategory($index);
        array_push($json_response, $row_array);
      }

      return $json_response;
}
else
{
return 'none';
}

}



public function Categoryview()
{
 $command = $this->db->prepare("SELECT * FROM `mvc_category` WHERE level = 1 AND lang = :lang");
 $command->execute(array(':lang' => LANG ));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
  $row_array = array();
  $row_array['id']   = $row['id'];
  $row_array['name'] = $row['name'];
  $row_array['level'] = $row['level'];
  $row_array['parent_id'] = $row['parent_id'];
  $row_array['parent_index']   = $row['parent_index'];
  $row_array['category_index'] = $row['category_index'];

  $index   = $row['category_index'];
  $row_array['sub']  = $this->Findsubcategory($index);

  array_push($json_response, $row_array);
}

return json_encode($json_response);
}
else
{
  // $row_array = array();
  // $row_array['status']   = 'none';
  // array_push($json_response, $row_array);
  // return $json_response;
}
}




public function addnew($other_img_id,$color_index,$name,$category_id,$main_img,$price,$size_index,$quantity)
	{
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `product` (`id`, `product_name`, `category_id`, `main_img`, `price`, `discount`, `quantity`, `size`, `description`, `weight`, `stock_info`, `other_img_index`, `keywords`, `color_index`, `manufacture_price`, `type`, `summury`, `size_index`, `quantity_index`,`lang`, `product_index`) VALUES (NULL, :name, :category_id, :main_img, :price, '', '', '', '', '', '', :other_img_id, '', :color_index, '', :type, '', :size_index, :quantity_index, :lang, :product_index)");
  if ($command->execute(array(
    	    ':name'        => $name,
    	    ':category_id' => $category_id,
    	    ':main_img'    => $main_img,
    	    ':price'       => $price,
          ':other_img_id'=> $other_img_id,
          ':color_index' => $color_index,
          ':type'        => 'product',
					':size_index'  => $size_index,
					':quantity_index' => $quantity,
          ':lang'           => 'en',
          ':product_index'  => $this->randomname(20)
            )))
  {
$proced->status   = "success";
$proced->message = "product item was saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "product was not saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}


public function FindData()
{
 $command = $this->db->prepare("SELECT * FROM `product` WHERE lang = :lang ORDER BY `product`.`id` DESC");
 $command->execute( array(':lang' => LANG));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']       = $row['id'];
        $row_array['product_name'] = $row['product_name'];
        $row_array['Price']    = $row['price'];
        $row_array['img']      = $row['main_img'];

array_push($json_response, $row_array);
}

return json_encode($json_response);

}
}

   public function Delete($id)
   {
 $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `product` WHERE `product`.`id` = :id");
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

$command = $this->db->prepare("SELECT * FROM `product` WHERE id = $id ");
 $command->execute();
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['id']           = $row['id'];
        $row_array['product_name'] = $row['product_name'];
        $row_array['category_id']  = $row['category_id'];
        $row_array['img']          = $row['main_img'];
        $row_array['price']        = $row['price'];
        $categoryId                = $row['category_id'];

$command2 = $this->db->prepare("SELECT * FROM `mvc_category` WHERE category_index = :index AND lang = :lang");
$command2->execute( array(':index' => $categoryId, ':lang' => LANG ));
if($command2->rowCount()  > 0)
{
     while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
     {
        $name = $row2['name'];
     }
   $row_array['category_name'] = $name;
}
else
{
  $row_array['category_name'] = 'none';
}


array_push($json_response, $row_array);
}

echo json_encode($json_response);

}

}

public function update($name,$category_id,$main_img,$price,$id)
{
 $proced = new \stdClass();
$command = $this->db->prepare("UPDATE `product` SET `product_name` = :name, `category_id` = :category_id, `main_img` = :main_img, `price` = :price WHERE `product`.`id` = $id");
  if ($command->execute(array(
          ':name'        => $name,
          ':category_id' => $category_id,
          ':main_img'    => $main_img,
          ':price'       => $price
            )))
  {
$proced->status   = "success";
$proced->message = "product item was updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "product was not updated";
$myJSON = json_encode($proced);
echo $myJSON;
  }

}

public function copyData($lang)
{
 $command = $this->db->prepare("SELECT * FROM `product` WHERE lang = 'en'");
 $command->execute();
  
if($command->rowCount()  > 0)
{
  $num = 0;
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
    $num = $num + 1;
  
        $id                = $row['id'];
        $product_name      = $row['product_name'];
        $Price             = $row['price'];
        $img               = $row['main_img'];
        $category_index    = $row['category_id'];
        $discount          = $row['discount'];
        $quantity          = $row['quantity'];
        $size              = $row['size'];
        $description       = $row['description'];
        $weight            = $row['weight'];
        $stock_info        = $row['stock_info'];
        $other_img_index   = $row['other_img_index'];
        $keywords          = $row['keywords'];
        $color_index       = $row['color_index'];
        $manufacture_price = $row['manufacture_price'];
        $summury           = $row['summury'];
        $size_index        = $row['size_index'];
        $quantity_index    = $row['quantity_index'];
        $product_index     = $row['product_index'];

        
$command2 = $this->db->prepare("SELECT * FROM `product` WHERE lang = :lang AND  product_index = :index");
$command2->execute(array(
  ':lang'  => $lang,
  ':index' => $product_index));

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
$this->addcopy($product_name,$Price,$img,$category_index,$discount,$quantity,$size,$description,$weight,$stock_info,$other_img_index,$keywords,$color_index,$manufacture_price,$summury,$size_index,$product_index,$lang,$quantity_index);

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


public function addcopy($product_name,$Price,$img,$category_index,$discount,$quantity,$size,$description,$weight,$stock_info,$other_img_index,$keywords,$color_index,$manufacture_price,$summury,$size_index,$product_index,$lang,$quantity_index)
  {
$proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `product` (`id`, `product_name`, `category_id`, `main_img`, `price`, `discount`, `quantity`, `size`, `description`, `weight`, `stock_info`, `other_img_index`, `keywords`, `color_index`, `manufacture_price`, `type`, `summury`, `size_index`, `quantity_index`, `lang`, `product_index`) VALUES (NULL, :name, :category_id, :main_img, :price, :discount, :quantity, :size, :description, :weight, :stock_info, :other_img, :keywords, :color_index, :manufacture_price, :type, :summury, :size_index, :quantity_index, :lang, :product_index)");
  if ($command->execute(array(
          ':name'              => $product_name,
          ':category_id'       => $category_index,
          ':main_img'          => $img,
          ':price'             => $Price,
          ':discount'          => $discount,
          ':quantity'          => $quantity,
          ':size'              => $size,
          ':description'       => $description,
          ':weight'            => $weight,
          ':stock_info'        => $stock_info,
          ':other_img'         => $other_img_index,
          ':keywords'          => $keywords,
          ':color_index'       => $color_index,
          ':manufacture_price' => $manufacture_price,
          ':type'              => 'product',
          ':summury'           => $summury,
          ':size_index'        => $size_index,
          ':quantity_index'    => $quantity_index,
          ':lang'              => $lang,
          ':product_index'     => $product_index
          
            )))
  {}
  else
  {}

}

public function createindex()
{
 $command = $this->db->prepare("SELECT * FROM `product`");
 $command->execute();
  
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
$id  = $row['id'];
$cat_id  = $row['category_id'];


$command1 = $this->db->prepare("SELECT * FROM `mvc_category` WHERE id = :id");
$command1->execute( array(':id' => $cat_id ));
if($command1->rowCount()  > 0)
{
     while ($row1 = $command1->fetch(PDO::FETCH_ASSOC))
     {
        $index = $row1['category_index'];
     }
   
}
else
{
  $index = 'none';
}

$command2 = $this->db->prepare("UPDATE `product` SET `category_id` = :index WHERE id = $id");
$command2->execute(array(
          ':index' => $index
          ));
 }
}

 }

}
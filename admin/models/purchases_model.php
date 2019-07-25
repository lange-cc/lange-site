<?php
/**
*
*/
class purchases_model extends model
{

	function __construct()
	{
	  parent::__construct();
    }
    
    public function product($id)
{
	$command = $this->db->prepare("SELECT * FROM `product` WHERE id = :id");
  $command->execute(array(':id' => $id));
  $json_response = array(); //Create an array
  if($command->rowCount()  > 0)
  {

 	 while ($row = $command->fetch(PDO::FETCH_ASSOC))
 		 {
 				 $row_array = array();
 				 $row_array['id']                = $row['id'];
 				 $row_array['name']              = $row['product_name'];
 				 $row_array['price']             = $row['price'];
				 $row_array['img']               = $row['main_img'];
				 array_push($json_response, $row_array);
			 }
			return $json_response;
	}

}

public function gift($id)
{
	$command = $this->db->prepare("SELECT * FROM `product_gift_box` WHERE id = :id");
  $command->execute(array(':id' => $id));
  $json_response = array(); //Create an array
  if($command->rowCount()  > 0)
  {

 	 while ($row = $command->fetch(PDO::FETCH_ASSOC))
 		 {
 				 $row_array = array();
 				 $row_array['id']         = $row['id'];
 				 $row_array['name']       = $row['name'];
 				 $row_array['price']      = $row['price'];
				 $row_array['img']        = $row['logo'];
				 array_push($json_response, $row_array);
			 }
			return $json_response;
	}

}


    public function size($id)
    {
      $json_response = array(); //Create an array
      $command3 = $this->db->prepare("SELECT * FROM `product_size_item` WHERE  id = :id");
      $command3->execute(array(':id' => $id));
      if($command3->rowCount()  > 0)
      {
      while ($row3 = $command3->fetch(PDO::FETCH_ASSOC))
      {
      $row_data = array();
      $row_data['id']        = $row3['id'];
      $row_data['size_name'] = $row3['size_name'];
      $row_data['price']     = $row3['price'];
      $row_data['size_type'] = array();
      $size_index            = $row3['size_index'];
    
    
      $size = $this->db->prepare("SELECT * FROM `products_size` WHERE size_index = :index");
      $size->execute(array(':index' => $size_index));
      if($size->rowCount()  > 0)
      {
      while ($rowsize = $size->fetch(PDO::FETCH_ASSOC))
      {
        $row_data['size_type'][] = array(
                        'id'         => $rowSizeItem['id'],
                        'size_type'  => $rowSizeItem['size_type']
                    );
    
      }
      }
      else
      {
     
        $row_data['size_type'][] = array(
            'id'         => 0,
            'size_type'  => ''
        );

      }
    

      }
      
    }
    else {
 
        $row_data = array();
        $row_data['size_type'] = array();
        $row_data['size_type'][] = array(
          'id'         => 0,
          'size_type'  => ''
      );
        $row_data['size_name'] = '';
        $row_data['price']     = '';
    }


array_push($json_response, $row_data);
return $json_response;

    }
    
    public function color($id)
    {
      $json_response = array(); //Create an array
      $command3 = $this->db->prepare("SELECT * FROM `product_colors` WHERE id = :id");
      $command3->execute(array(':id' => $id));
      if($command3->rowCount()  > 0)
      {
      while ($row3 = $command3->fetch(PDO::FETCH_ASSOC))
      {
      $row_data = array();
      $row_data['id']           = $row3['id'];
      $row_data['color_name']   = $row3['color_name'];
      array_push($json_response, $row_data);
      }
      return $json_response;
    }
    else {
      $row_data = array();
      $row_data['color_name']   = 'none';
      array_push($json_response, $row_data);
      return $json_response;
    }
    }


    public function getProduct($deriver_id)
    {
 $jsondata = array();
 $product=$this->db->prepare("SELECT * FROM `product_to_deliver` WHERE derivery_index  = :deriver_index");
 $product->execute(array(':deriver_index' => $deriver_id));
 if($product->rowCount()>0)
 {
   while($productRow = $product->fetch(PDO::FETCH_ASSOC))
     {
       $row_array1 = array();
       $row_array1['id']           = $productRow['id'];
       $row_array1['product_id']   = $productRow['product_id'];
       $row_array1['color_id']     = $productRow['color_id'];
       $row_array1['size_id']      = $productRow['size_id'];
       $row_array1['quantity']     = $productRow['quantity'];
       $row_array1['type']         = $productRow['type'];

       if ($productRow['type'] == 'product') 
       {
         $row_array1['productdata'] = $this->product($productRow['product_id']);
         if ($productRow['size_id'] != 0) {
            $row_array1['price']        = $productRow['quantity'] * $this->productTotalPrice($productRow['size_id']);
            $row_array1['productprice'] = $this->productTotalPrice($productRow['size_id']);
         }
         else {
            $row_array1['price']  = $productRow['quantity'] * $this->productdefaulPrice($productRow['product_id']);
            $row_array1['productprice'] = $this->productdefaulPrice($productRow['product_id']);
         }

       }
       elseif ($productRow['type'] == 'gift') 
       {
         $row_array1['productdata'] = $this->gift($productRow['product_id']);
         $row_array1['price']   = $productRow['quantity'] * $this->giftdefaulPrice($productRow['product_id']);
         $row_array1['productprice'] = $this->giftdefaulPrice($productRow['product_id']);
       }
       else
       {
         $row_array1['productdata'] = '';
       }

       $row_array1['color'] = $this->color($productRow['color_id']);
       $row_array1['size']  = $this->size($productRow['size_id']);

       array_push($jsondata,$row_array1);
       }
   return $jsondata;
}
    }


public function Viewpuchases($id)
{
 $command = $this->db->prepare("SELECT * FROM `deliver` WHERE id = $id");
 $command->execute();
 $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
  $row_array = array();
  $row_array['id']     = $row['id'];
  $row_array['date']   = $row['date'];
  $row_array['status'] = $row['pay_status'];
  $row_array['code']   = $row['index_code'];
  $row_array['date']   = date('M j Y g:i A', strtotime($row['date']));
  $client_index        = $row['client_id'];
  $deriver_index       = $row['index_number'];
  $row_array['product'] = $this->getProduct($deriver_index);
  $row_array['total']   = $this->Totalprice($deriver_index);
  $status = $row['status'];


  if($status == 0)
  {
  $row_array['btn']     = 'Confirm';
  $row_array['message'] = 'Not accepted';
  }
  elseif($status == 1)
  {
    $row_array['btn']     = 'all done';
    $row_array['message'] = 'Accepted but derivering...';
  }
  else
  {
    $row_array['btn']     = 'ok';
    $row_array['message'] = 'All done';
  }



  $command1 = $this->db->prepare("SELECT * FROM `client_information` WHERE account_id = :index");
  $command1->execute(array(':index' => $client_index));
 if($command1->rowCount()  > 0)
 {
 while ($row1 = $command1->fetch(PDO::FETCH_ASSOC))
 {
   //derivery information
   $row_array['names']    = $row1['first_name'].' '.$row1['last_name'];
   $row_array['location'] = $row1['location'];
   $row_array['city']     = $row1['city'];
   $row_array['phone']    = $row1['phone'];
   $row_array['road']     = $row1['road'];
   $row_array['info']     = $row1['other_info'];

   //client information
   $row_array['username']     = $row1['user_f_name'].' '.$row1['user_l_name'];
   $row_array['userLocation'] = $row1['user_location'];
   $row_array['userZip']      = $row1['user_zip'];
   $row_array['userCity']     = $row1['user_city'];
   $row_array['userPhone']    = $row1['user_phone'];
   $row_array['userEmail']    = $row1['user_email'];
 }
}


  array_push($json_response, $row_array);
}

echo json_encode($json_response);
}
   
}

public function DeletePuchases($id)
{
  $proced = new \stdClass();

  $command2 = $this->db->prepare("SELECT * FROM `deliver` WHERE id = $id");
  $command2->execute();
   if($command2->rowCount()  > 0)
   {
   while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
   {
     
    $index = $row2['index_number'];
   }
   $command1 = $this->db->prepare("DELETE FROM `product_to_deliver` WHERE `product_to_deliver`.`derivery_index` = :index");
   if($command1->execute(array(':index' => $index )))
  {
  $command = $this->db->prepare("DELETE FROM `deliver` WHERE `deliver`.`id` = $id");
  if($command->execute())
  {
    $proced->status  = "success";
    $proced->message = "Data delete";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
  else
  {
    $proced->status  = "fail";
    $proced->message = "Error occured during deleting.";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}
}
}

public function ComfirmPuchases($id)
{
 $proced = new \stdClass();
 $command = $this->db->prepare("SELECT * FROM `deliver` WHERE id = $id");
 $command->execute();
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
  $status = $row['status'];
}

if($status == 0)
{
  $update = $this->db->prepare("UPDATE `deliver` SET `status` = '1' WHERE `deliver`.`id` = $id");
  if($update->execute())
  {
    $proced->status  = "success";
    $proced->message = "Accepted-Derivering...";
    $proced->btn     = "All done";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}
elseif($status == 1)
{
  $update = $this->db->prepare("UPDATE `deliver` SET `status` = '2' WHERE `deliver`.`id` = $id");
  if($update->execute())
  {
    $proced->status  = "success";
    $proced->message = "All done";
    $proced->btn     = "ok";
    $myJSON = json_encode($proced);
    echo $myJSON;
  }
}
else
{
    $proced->status  = "success";
    $proced->message = "All done";
    $proced->btn     = "ok";
    $myJSON = json_encode($proced);
    echo $myJSON;
}


}
   
}

public function Totalprice($deriver_index)
{
    $total = 0;
    $product=$this->db->prepare("SELECT * FROM `product_to_deliver` WHERE derivery_index  = :deriver_index");
    $product->execute(array(':deriver_index' => $deriver_index));
    if($product->rowCount()>0)
    {
      while($productRow = $product->fetch(PDO::FETCH_ASSOC))
      {
        $id          = $productRow['id'];
        $product_id  = $productRow['product_id'];
        $quantity    = $productRow['quantity'];
        $type        = $productRow['type'];
        $size_id     = $productRow['size_id'];
  
  
        if ($type == "product")
        {
          if ($productRow['size_id'] != 0) {
            $price  = $quantity * $this->productTotalPrice($size_id);
          }
          else {
            $price  = $quantity * $this->productdefaulPrice($product_id);
          }
        }
        elseif ($type == "gift") {
          $price  = $quantity * $this->giftdefaulPrice($product_id);
        }
        else
        {
         
        }
  
        if (isset($price)) {
          $total = $total+ $price;
        }
  
  
      }
  
    }
  
    if (isset($total))
    {
    return $total;
    }
    else
    {
    return 0;
    }
}


public function FindPurchases()
{
 $command = $this->db->prepare("SELECT * FROM `deliver` ORDER BY `deliver`.`id` DESC");
 $command->execute();
 $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
while ($row = $command->fetch(PDO::FETCH_ASSOC))
{
  $row_array = array();
  $row_array['id']     = $row['id'];
  $row_array['date']   = $row['date'];
  $row_array['status'] = $row['pay_status'];
  $client_index        = $row['client_id'];
  $deriver_index       = $row['index_number'];

  $command1 = $this->db->prepare("SELECT * FROM `client_information` WHERE account_id = :index");
  $command1->execute(array(':index' => $client_index));
 if($command1->rowCount()  > 0)
 {
 while ($row1 = $command1->fetch(PDO::FETCH_ASSOC))
 {
   $row_array['fname'] = $row1['first_name'];
   $row_array['lname'] = $row1['last_name'];
 }
}



  $total = 0;
  $product=$this->db->prepare("SELECT * FROM `product_to_deliver` WHERE derivery_index  = :deriver_index");
  $product->execute(array(':deriver_index' => $deriver_index));
  if($product->rowCount()>0)
  {
    while($productRow = $product->fetch(PDO::FETCH_ASSOC))
    {
      $id          = $productRow['id'];
      $product_id  = $productRow['product_id'];
      $quantity    = $productRow['quantity'];
      $type        = $productRow['type'];
      $size_id     = $productRow['size_id'];


      if ($type == "product")
      {
        if ($productRow['size_id'] != 0) {
          $price  = $quantity * $this->productTotalPrice($size_id);
        }
        else {
          $price  = $quantity * $this->productdefaulPrice($product_id);
        }
      }
      elseif ($type == "gift") {
        $price  = $quantity * $this->giftdefaulPrice($product_id);
      }
      else
      {
       
      }

      if (isset($price)) {
        $total = $total+ $price;
      }


    }

  }

  if (isset($total))
  {
  $row_array['total'] = $total;
  }
  else
  {
  $row_array['total'] = 0;
  }


  $pro_number = $this->db->prepare("SELECT * FROM `product_to_deliver` WHERE `derivery_index`  = :deriver_index AND `type` ='product'");
  $pro_number->execute(array(':deriver_index' => $deriver_index));
  if($pro_number->rowCount()>0)
  {
    $row_array['pro_number'] = $pro_number->rowCount();
  }
  else
  {
    $row_array['pro_number'] = 0;
  }


  $gift_number = $this->db->prepare("SELECT * FROM `product_to_deliver` WHERE `derivery_index`  = :deriver_index AND `type` ='gift'");
  $gift_number->execute(array(':deriver_index' => $deriver_index));
  if($gift_number->rowCount()>0)
  {
    $row_array['gift_number'] = $gift_number->rowCount();
  }
  else
  {
    $row_array['gift_number'] = 0;
  }



  array_push($json_response, $row_array);
}

return json_encode($json_response);
}

}

public function productTotalPrice($id)
{
	$price = $this->db->prepare("SELECT * FROM `product_size_item`  WHERE id = :id");
	$price->execute(array(':id'  => $id  ));
	if($price->rowCount()  > 0)
	{
	while ($rowSizeItem = $price->fetch(PDO::FETCH_ASSOC))
	{
      return preg_replace('/[^0-9]+/', '', $rowSizeItem['price']);
	}
	}
}

public function productdefaulPrice($id)
{
	$price = $this->db->prepare("SELECT * FROM `product` WHERE id = :id");
	$price->execute(array(':id'  => $id  ));
	if($price->rowCount()  > 0)
	{
	while ($row = $price->fetch(PDO::FETCH_ASSOC))
	{
      return preg_replace('/,/', '.', $row['price']);
	}
	}
}


public function  giftdefaulPrice($id)
{
	$price = $this->db->prepare("SELECT * FROM `product_gift_box` WHERE id = :id");
	$price->execute(array(':id'  => $id  ));
	if($price->rowCount()  > 0)
	{
	while ($row = $price->fetch(PDO::FETCH_ASSOC))
	{
			return preg_replace('/,/', '.', $row['price']);
	}
	}

}




 }

<?php
/**
*
*/
class productinfo_model extends model
{

	function __construct()
	{
	  parent::__construct();
	}
	public function logout()
	{
      header('location: ../../login/');
	}


public function FindProduct($id)
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
        $row_array['discount']          = $row['discount'];
        $row_array['quantity']          = $row['quantity'];
        $row_array['size']              = $row['size'];
        $row_array['description']       = $row['description'];
        $row_array['weight']            = $row['weight'];
        $row_array['stock_info']        = $row['stock_info'];
        $row_array['other_img_index']   = $row['other_img_index'];
        $row_array['keywords']          = $row['keywords'];
        $row_array['color_index']       = $row['color_index'];
        $row_array['manufacture_price'] = $row['manufacture_price'];
		$row_array['summury']           = $row['summury'];
		$row_array['sizeIndex']         = $row['size_index'];
        $row_array['other_images']      = array();
        $row_array['product_colors']    = array();
				$row_array['products_size']     = array();
        $index                          = $row['other_img_index'];
        $color_index                    = $row['color_index'];
				$size_index                     = $row['size_index'];

$command2 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE img_index = :index");
$command2->execute(array(':index' => $index));
if($command2->rowCount()  > 0)
{
while ($row2 = $command2->fetch(PDO::FETCH_ASSOC))
{

$row_array['other_images'][] = array(
                'id'         => $row2['id'],
                'image_name' => $row2['name'],
                'index'      => $row2['img_index']

            );
}
}


$command3 = $this->db->prepare("SELECT * FROM `product_colors` WHERE color_index = :index ORDER BY `product_colors`.`id` DESC");
$command3->execute(array(':index' => $color_index));
if($command3->rowCount()  > 0)
{
while ($row3 = $command3->fetch(PDO::FETCH_ASSOC))
{
   $row_data = array();
$row_data['id']           = $row3['id'];
$row_data['color_name']   = $row3['color_name'];
$row_data['index']        = $row3['color_index'];
$row_data['color_images'] = array();


$color_indexx  = $row3['color_index'];
$color_id      = $row3['id'];

$command4 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE img_index = :index AND color_id = :color_id");
$command4->execute(array(
  ':index'    => $color_indexx,
  ':color_id' => $color_id
  ));
if($command4->rowCount()  > 0)
{
while ($row4 = $command4->fetch(PDO::FETCH_ASSOC))
{

$row_data['color_images'][] = array(
                'id'         => $row4['id'],
                'image_name' => $row4['name'],
                'index'      => $row4['img_index']

            );


}
}


array_push($row_array['product_colors'], $row_data);

}
}

$size = $this->db->prepare("SELECT * FROM `products_size` WHERE size_index = :index");
$size->execute(array(':index' => $size_index));
if($size->rowCount()  > 0)
{
while ($rowsize = $size->fetch(PDO::FETCH_ASSOC))
{
$row_size = array();
$row_size['id']         = $rowsize['id'];
$row_size['size_type']  = $rowsize['size_type'];
$row_size['size_index'] = $rowsize['size_index'];
$size_index             = $rowsize['size_index'];
$row_size['size_item']  = array();

$sizeItem = $this->db->prepare("SELECT * FROM `product_size_item`  WHERE size_index = :index");
$sizeItem->execute(array(
  ':index'  => $size_index
  ));
if($sizeItem->rowCount()  > 0)
{
while ($rowSizeItem = $sizeItem->fetch(PDO::FETCH_ASSOC))
{
$row_size['size_item'][] = array(
                'id'    => $rowSizeItem['id'],
                'name'  => $rowSizeItem['size_name'],
								'price' => $rowSizeItem['price'],
                'index' => $rowSizeItem['size_index']

            );
}
}
array_push($row_array['products_size'], $row_size);
}
}


array_push($json_response, $row_array);

    }

session::set('other_img_index',$index);
session::set('color_index', $color_index);
return json_encode($json_response);


}

}


public function ChangeData($discount,$quantity,$weight,$size,$content,$stockInfo,$manufaPrice,$keywords,$id,$summury)
{
$proced = new \stdClass();
$command = $this->db->prepare("UPDATE `product` SET `summury` = :summury, `discount` = :discount, `quantity` = :quantity, `size` = :size, `description` = :description, `weight` = :weight, `stock_info` = :stock_info, `keywords` = :keywords, `manufacture_price` = :manufacture_price WHERE `product`.`id` = $id");
if ($command->execute(array(
        ':discount'         => $discount,
        ':quantity'         => $quantity,
        ':size'             => $size,
        ':description'      => $content,
        ':weight'           => $weight,
        ':stock_info'       => $stockInfo,
        ':keywords'         => $keywords,
        ':manufacture_price'=> $manufaPrice,
				':summury'          => $summury

        )))
   {
$proced->status  = "success";
$proced->message = "This data saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "This,Data was not Saved,try again.";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


public function Addcolor($name,$index)
{
  $proced = new \stdClass();
$command = $this->db->prepare("INSERT INTO `product_colors` (`id`, `color_name`, `color_index`) VALUES (NULL, :name, :index)");
if ($command->execute(array(
        ':name'  => $name,
        ':index' => $index

        )))
   {
$proced->status  = "success";
$proced->message = "Color added.";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Color not added.";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}


public function imgDelete($id)
{
	$proced = new \stdClass();
	$command1 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE id = :id");
	$command1->execute(array(':id' => $id));
	if($command1->rowCount()  > 0)
	{
		while ($row1 = $command1->fetch(PDO::FETCH_ASSOC))
		{
			$file_name = $row1['image_name'];
		}

		if (file_exists('../public/all-images/'.$file_name)) {
			$path = '../public/all-images/'.$file_name;
			$thumbnail_path = '../public/all-images/thumbnail/'.$file_name;
			if (unlink($path) && unlink($thumbnail_path)) {

				$command = $this->db->prepare("DELETE FROM `mvc_images` WHERE id = :id");
				if ($command->execute(array(':id' => $id ))) {
					$proced->status  = "success";
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
			else
			{
				$proced->status   = "fail";
				$proced->message = "image was not Deleted";
				$myJSON = json_encode($proced);
				echo $myJSON;
			}
		}
		else
		{
			$command4 = $this->db->prepare("DELETE FROM `mvc_images` WHERE id = :id");
			if ($command4->execute(array(':id' => $id ))) {
				$proced->status   = "success";
				$proced->message = "Data was Deleted, but Image not exist";
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


	}
	else {
		$proced->status  = "fail";
		$proced->message = "No images found to detete";
		$myJSON = json_encode($proced);
		echo $myJSON;
	}


}

   public function DeleteArticle($id)
  {
    $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `mvc_article` WHERE id = :id");
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

public function colorDelete($id)
{
     $proced = new \stdClass();
 $command = $this->db->prepare("DELETE FROM `product_colors` WHERE id = :id");
if ($command->execute(array(':id' => $id ))) {
$this->coloeimgDelete($id);
$proced->status  = "success";
$proced->message = "Data was Deleted";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else{
$proced->status  = "fail";
$proced->message = "Data was not Deleted";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}



 public function coloeimgDelete($id)
   {
$proced = new \stdClass();

$command1 = $this->db->prepare("SELECT * FROM `mvc_images` WHERE color_id = :id");
$command1->execute(array(':id' => $id));
if($command1->rowCount()  > 0)
{
while ($row1 = $command1->fetch(PDO::FETCH_ASSOC))
{
 $file_name = $row1['image_name'];
}

if (file_exists('../public/all-images/'.$file_name)) {
$path = '../public/all-images/'.$file_name;
$thumbnail_path = '../public/all-images/thumbnail/'.$file_name;
if (unlink($path) && unlink($thumbnail_path))
{
$command = $this->db->prepare("DELETE FROM `mvc_images` WHERE color_id = :id");
$command->execute(array(':id' => $id ));
}
else
{
$command4 = $this->db->prepare("DELETE FROM `mvc_images` WHERE color_id = :id");
$command4->execute(array(':id' => $id ));
}
}

}
}



  public function addArticle($title,$subTitle,$img,$content,$section_index,$article_index)
  {
    $proced = new \stdClass();
   $command = $this->db->prepare("INSERT INTO `mvc_article` (`id`, `title`, `subtitle`, `content`, `article_index`, `logo`, `section_index`) VALUES (NULL, :title, :subtitle, :content, :article_index, :logo, :section_index)");
   if ($command->execute(array(
        ':title'         => $title,
        ':subtitle'      => $subTitle,
        ':content'       => $content,
        ':article_index' => $article_index,
        ':logo'          => $img,
        ':section_index' => $section_index

        )))
   {
$proced->status  = "success";
$proced->message = "Article was Saved";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }


  }

  public function FindArticle($id)
  {
   $command = $this->db->prepare("SELECT * FROM `mvc_article` WHERE id = :id");
   $command->setFetchMode(PDO::FETCH_ASSOC);
   $command->execute(array(':id' => $id));
    $data = $command->fetchAll();

      if ($command->rowCount() > 0)
    {
   $myJSON = json_encode($data);
    echo $myJSON;
    }
  }

public function sectionUpdate($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id = :id ");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['title'] = $row['title'];
        $row_array['discription'] = $row['discription'];
        array_push($json_response, $row_array);
      }

      echo json_encode($json_response);
    }

}
public function sectionView($id)
{
 $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id = :id ");
 $command->execute(array(':id' => $id));
    $json_response = array(); //Create an array
if($command->rowCount()  > 0)
{
     while ($row = $command->fetch(PDO::FETCH_ASSOC))
     {
        $row_array = array();
        $row_array['title'] = $row['title'];
        $row_array['discription'] = $row['discription'];
        array_push($json_response, $row_array);
      }

      echo json_encode($json_response);
    }

}
public function Update($title, $content, $id)
{
 $proced = new \stdClass();
   $command = $this->db->prepare("UPDATE `mvc_section` SET `title` = :title, `discription` = :content WHERE `mvc_section`.`id` = $id ");
   if ($command->execute(array(
        ':title'         => $title,
        ':content'       => $content
        )))
   {
$proced->status  = "success";
$proced->message = "Section was Updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

public function ArticleUpdate($title,$subTitle,$id,$img,$content)
{
  $proced = new \stdClass();
   $command = $this->db->prepare("UPDATE `mvc_article` SET `title` = :title, `subtitle` = :subtitle, `content` = :content, `logo` = :logo WHERE `mvc_article`.`id` = $id ");
   if ($command->execute(array(
        ':title'         => $title,
        ':subtitle'      => $subTitle,
        ':content'       => $content,
        ':logo'          => $img
        )))
   {
$proced->status  = "success";
$proced->message = "Article was Updated";
$myJSON = json_encode($proced);
echo $myJSON;

  }
  else
  {
$proced->status  = "fail";
$proced->message = "Data was not Saved";
$myJSON = json_encode($proced);
echo $myJSON;
  }
}

public function productsize($index,$name)
{
	$proced = new \stdClass();
	$command1 = $this->db->prepare("SELECT * FROM `products_size` WHERE size_index = :index");
	$command1->execute(array(':index' => $index));
	if($command1->rowCount()  > 0)
	{
		$command = $this->db->prepare("UPDATE `products_size` SET `size_type` = :name WHERE `products_size`.`size_index` = :index");
		if ($command->execute(array(
			':index' => $index,
			':name'  => $name,
		)))
		{
			$proced->status  = "success";
			$proced->message = "saved";
			$myJSON = json_encode($proced);
			echo $myJSON;

		}
		else
		{
			$proced->status  = "fail";
			$proced->message = "Data was not Saved";
			$myJSON = json_encode($proced);
			echo $myJSON;
		}
	}
	else
	{
		$command = $this->db->prepare("INSERT INTO `products_size` (`id`, `size_type`, `size_index`) VALUES (NULL, :name, :index)");
		if ($command->execute(array(
			':index' => $index,
			':name'  => $name,
		)))
		{
			$proced->status  = "success";
			$proced->message = "saved";
			$myJSON = json_encode($proced);
			echo $myJSON;

		}
		else
		{
			$proced->status  = "fail";
			$proced->message = "Data was not Saved";
			$myJSON = json_encode($proced);
			echo $myJSON;
		}
	}

}

public function addproductsize($name,$index,$price)
{
	$proced = new \stdClass();
	$command = $this->db->prepare("INSERT INTO `product_size_item` (`id`, `size_name`, `size_index`, `price`) VALUES (NULL, :name, :index, :price)");
	if ($command->execute(array(
		':name'  => $name,
		':index' => $index,
		':price' => $price
	)))
	{
		$proced->status  = "success";
		$proced->message = "size item added";
		$myJSON = json_encode($proced);
		echo $myJSON;

	}
	else
	{
		$proced->status  = "fail";
		$proced->message = "Data was not added";
		$myJSON = json_encode($proced);
		echo $myJSON;
	}

}

public function SizeDelete($id)
{
	$proced = new \stdClass();
	$command = $this->db->prepare("DELETE FROM `product_size_item` WHERE `product_size_item`.`id` = :id");
	if ($command->execute(array(
		':id'  => $id
	)))
	{
		$proced->status  = "success";
		$proced->message = "item deleted";
		$myJSON = json_encode($proced);
		echo $myJSON;

	}
	else
	{
		$proced->status  = "fail";
		$proced->message = "Item not deleted";
		$myJSON = json_encode($proced);
		echo $myJSON;
	}
}

}

?>

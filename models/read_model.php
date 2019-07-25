<?php
/**
 *
 */
class read_model extends model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addnew($name, $content, $date, $id)
    {
        $proced = new \stdClass();
        $command = $this->db->prepare("INSERT INTO `mvc_comment` (`id`, `post_id`, `name`, `content`, `added_date`) VALUES (NULL, :id, :name, :content, DATE('CURRENT_TIMESTAMP()'))");
        if ($command->execute(array(
            ':id' => $id,
            ':name' => $name,
            ':content' => $content,
        ))) {
            $proced->status = "success";
            $proced->message = "Comment Added";
            $proced->name = $name;
            $proced->content = $content;
            $proced->date = $date;

            $myJSON = json_encode($proced);
            echo $myJSON;

        } else {
            $proced->status = "fail";
            $proced->message = "Comment not Added";
            $myJSON = json_encode($proced);
            echo $myJSON;
        }

    }

    public function Finddata($id)
    {
        $command = $this->db->prepare("SELECT * FROM `mvc_section` WHERE id  = :id ");
        $command->execute(array(':id' => $id));
        $json_response = array(); //Create an array
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
                $row_array = array();
                $row_array['article'] = array();
                $section_index = $row['section_index'];

                $command2 = $this->db->prepare("SELECT * FROM `mvc_article` WHERE section_index = :index");
                $command2->execute(array(':index' => $section_index));
                if ($command2->rowCount() > 0) {
                    while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) {
                        $row_array['article'][] = array(
                            'id' => $row2['id'],
                            'title' => $row2['title'],
                            'subtitle' => $row2['subtitle'],
                            'content' => $row2['content'],
                            'article_index' => $row2['article_index'],
                            'logo' => $row2['logo'],
                            'section_index' => $row2['section_index'],
                        );

                    }
                }

                array_push($json_response, $row_array);

            }
            return json_encode($json_response);

        }

    }

    public function BlogData($id)
    {

        $command = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE id = $id");
        $command->execute();
        $json_response = array(); //Create an array
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
                $row_array = array();
                $row_array['id'] = $row['id'];
                $row_array['title'] = $row['Title'];
                $row_array['content'] = $row['content'];
                $row_array['logo'] = $row['logo'];
                $row_array['author_id'] = $row['author_id'];
                $row_array['views'] = $row['views'];
                $row_array['added_date'] = $row['added_date'];
                $row_array['updated_date'] = $row['updated_date'];
                $row_array['comment'] = array();
                $row_array['author_data'] = array();
                $id = $row['id'];
                $author_id = $row['author_id'];
                $views = $row['views'];

                $command2 = $this->db->prepare("SELECT * FROM `mvc_comment` WHERE post_id = :id");
                $command2->execute(array(':id' => $id));
                if ($command2->rowCount() > 0) {
                    while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) {
                        $row_array['comment'][] = array(
                            'id' => $row2['id'],
                            'post_id' => $row2['post_id'],
                            'name' => $row2['name'],
                            'content' => $row2['content'],
                            'added_date' => $row2['added_date'],
                        );

                    }
                    $row_array['comment_number'] = $command2->rowCount();
                } else {
                    $row_array['comment_number'] = 0;
                }

                $command3 = $this->db->prepare("SELECT * FROM `mvc_author` WHERE id = :id");
                $command3->execute(array(':id' => $author_id));
                if ($command3->rowCount() > 0) {
                    while ($row2 = $command3->fetch(PDO::FETCH_ASSOC)) {
                        $row_array['author_data'][] = array(
                            'id' => $row2['id'],
                            'name' => $row2['name'],
                            'description' => $row2['description'],
                            'logo' => $row2['logo'],
                            'added_date' => $row2['added_date'],
                        );

                        $name = $row2['name'];
                        $author_img = $row2['logo'];
                        $content = $row2['description'];
                    }
                    $row_array['author'] = $author_img;
                    $row_array['author_name'] = $name;
                    $row_array['author_content'] = $content;

                } else {
                    $row_array['author'] = 'none';
                }

                array_push($json_response, $row_array);
            }

            return json_encode($json_response);

        }
    }

    public function BlogTitle($id)
    {
        $command = $this->db->prepare("SELECT * FROM `mvc_blog` WHERE id = $id");
        $command->execute();
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {

                $title = $row['Title'];
                $content = $row['content'];
            }
            return $title;
        }

    }

    public function addviews($id)
    {
        $command = $this->db->prepare("UPDATE `mvc_blog` SET `views` = views+1 WHERE `mvc_blog`.`id` = :id");
        $command->execute(array(
            ':id' => $id,
        ));
    }

    public function Gallery($index)
    {

        $command = $this->db->prepare("SELECT * FROM `mvc_gallery_images` WHERE folder_index  = :index ORDER BY `mvc_gallery_images`.`id` DESC");
        $command->execute(array(':index' => $index));
        $json_response = array(); //Create an array
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
                $row_array = array();
                $row_array['id'] = $row['id'];
                $row_array['image_name'] = $row['image_name'];

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
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
                $row_array = array();
                $row_array['id'] = $row['id'];
                $row_array['car_name'] = $row['car_name'];
                $row_array['Price'] = $row['Price'];
                $row_array['speed'] = $row['speed'];
                $row_array['img'] = $row['img'];

                array_push($json_response, $row_array);
            }

            return json_encode($json_response);

        }
    }

    public function RelatedBlog()
    {
        $command = $this->db->prepare("SELECT * FROM `mvc_blog`  ORDER BY `mvc_blog`.`id` DESC LIMIT 3");
        $command->execute();
        $json_response = array(); //Create an array
        if ($command->rowCount() > 0) {
            while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
                $row_array = array();
                $row_array['id'] = $row['id'];
                $row_array['title'] = $row['Title'];
                $row_array['content'] = $row['content'];
                $row_array['logo'] = $row['logo'];
                $row_array['author_id'] = $row['author_id'];
                $row_array['views'] = $row['views'];
                $row_array['added_date'] = $row['added_date'];
                $row_array['updated_date'] = $row['updated_date'];
                $row_array['comment'] = array();
                $row_array['author_data'] = array();
                $id = $row['id'];
                $author_id = $row['author_id'];

                $command2 = $this->db->prepare("SELECT * FROM `mvc_comment` WHERE post_id = :id");
                $command2->execute(array(':id' => $id));
                if ($command2->rowCount() > 0) {
                    while ($row2 = $command2->fetch(PDO::FETCH_ASSOC)) {
                        $row_array['comment'][] = array(
                            'id' => $row2['id'],
                            'post_id' => $row2['post_id'],
                            'name' => $row2['name'],
                            'content' => $row2['content'],
                            'comment_added_date' => $row2['added_date'],
                        );

                    }
                    $row_array['comment_number'] = $command2->rowCount();
                } else {
                    $row_array['comment_number'] = 0;
                }

                $command3 = $this->db->prepare("SELECT * FROM `mvc_author` WHERE id = :id");
                $command3->execute(array(':id' => $author_id));
                if ($command3->rowCount() > 0) {
                    while ($row2 = $command3->fetch(PDO::FETCH_ASSOC)) {
                        $row_array['author_data'][] = array(
                            'id' => $row2['id'],
                            'name' => $row2['name'],
                            'description' => $row2['description'],
                            'logo' => $row2['logo'],
                            'author_added_date' => $row2['added_date'],
                        );

                        $name = $row2['name'];
                        $author_img = $row2['logo'];

                    }
                    $row_array['author_img'] = $author_img;
                    $row_array['author_name'] = $name;
                } else {
                    $row_array['author'] = 'none';
                }

                array_push($json_response, $row_array);
            }

            return json_encode($json_response);

        }
    }

}
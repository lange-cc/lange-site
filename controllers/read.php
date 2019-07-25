<?php
/**
 *
 */
class read extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->js = array('assets/js/jquery.classyscroll.js', 'assets/js/ekScrollable.js', 'assets/js/jquery.mousewheel.js', 'assets/js/demo.js', 'assets/js/ayoshare.js');
        $this->view->css = array('css/jquery.classyscroll.css', 'css/scoll.css', 'css/ayoshare.css');
        //$this->Statistics('Read');
    }

    public function autoload()
    {
        $this->view->id = $this->idname;
        $this->view->controller = $this->loadcontroller;
        $this->view->blog = $this->model->BlogData($this->idname);
        $this->view->title = $this->model->BlogTitle($this->idname);
        $this->view->addviews = $this->model->addviews($this->idname);
        $this->view->metablog = $this->model->BlogData($this->idname);
        $this->view->relatedblog = $this->model->RelatedBlog();
        $this->view->Authtoken = $this->CreateAuthToken();
        $this->view->client_logo = $this->Gallery($index = 'hCiS');
        $this->view->location = $this->model->Finddata($id = 14);
        $this->view->phone = $this->model->Finddata($id = 15);
        $this->view->render('read/index', false, $menu = 4);
    }

    public function addcomment()
    {
        $tz = 'UTC';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        // $dt->format('F j-Y');
        $date = $dt->format('Y-m-d');

        if (isset($_POST['names']) && isset($_POST['content']) && isset($_POST['post-id'])) {
            $name = $_POST['names'];
            $content = $_POST['content'];
            $id = $_POST['post-id'];

            $this->model->addnew($name, $content, $date, $id);
        } else {
            $proced = new \stdClass();
            $proced->status = "fail";
            $proced->message = "Make sure author was Selected";
            $myJSON = json_encode($proced);
            echo $myJSON;
        }

    }

}
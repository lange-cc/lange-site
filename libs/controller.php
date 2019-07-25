<?php
/**
 *
 */
class controller extends controllerModel
{

    public function __construct()
    {
        parent::__construct();
        $this->view = new View();
    }

    public function loadModel($name)
    {
        $path = 'models/' . $name . '_model.php';

        if (file_exists($path)) {
            require 'models/' . $name . '_model.php';
            $modelname = $name . '_model';
            $this->model = new $modelname;
        }
    }

    public function loadid($id)
    {
        $this->idname = $id;
    }

    public function loadcontroler($controller)
    {

        $this->loadcontroller = $controller;

    }

    public function randomname($length = 8)
    {
        $characters = 'cxbvjhuy78erfuwlkskjdjkefreFKJGRJHFlgkojrtgitklrjmgoijrtioejgertpogkortpg94w5u8rt92u4h5u3h034u18hgf4oERJHJRFJER4839YR34HUU0349UF4O3H2R3U4Oir8ycnkljafGHVHFCFGPONJBVFSESOKOM230peihurfg4uihfgbvp';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function CreateAuthToken()
    {

        $token = $this->randomname(100);
        session::init();
        session::set("auth", $token);
        return $token;
    }

    public function Images($index)
    {
        return $this->Gallery($index);
    }

    public function CommonFindiData($id)
    {
        return $this->Finddata($id);
    }

    public function Statistics($page)
    {
        return $this->GetStatistics($page);
    }

}
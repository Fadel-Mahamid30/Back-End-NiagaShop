<?php

class Controller {

    private $auth_link = "/login/index";
    private $guest_link = "/product/index";

    public $title = "Niaga Shop - ";
    public function view($view, $data = []) {
        extract($data);
        if (isset($_SESSION["error"])) extract($_SESSION["error"]);
        
        require_once "../app/views/" . $view . ".php";
        if (isset($_SESSION["error"])) unset($_SESSION["error"]);
    }

    public function authView() {
        if (!isset($_SESSION["user_id"])) {
            header("location:" . BASEURL . "/login");
            exit;
        }
    }

    public function guestView(){
        
        if (isset($_SESSION["user_id"])) {
            header("location:" . BASEURL . "/product");
            exit;
        }
    }
    
    public function img() {
        require_once "../public/img/ImageFile.php";
        return new ImageFile;
    }

    public function model($model) {
        require_once "../app/models/" . $model . ".php";
        return new $model;
    }

    public function validate($data, $nameImput, $link, $message=[]) {
        $error = [];
        foreach ($nameImput as $x) {
            if (is_array($data[$x])) {
                if (in_array("", $data)) $error[$x] = "Kolom " . $x . " tidak boleh kosong.";;
            } else if (!$data[$x] || trim($data[$x]) == "") {
                if (isset($message[$x])) {
                    $error[$x] = $message[$x];    
                } else {
                    $error[$x] = "Kolom " . $x . " tidak boleh kosong.";
                }
            }
        }

        if (count($error) > 0) {
            Flasher::setError($error, $nameImput);
            header("location:" . BASEURL . $link);
            exit;
        }
    }

    public function hasData($data) {
        if (is_array($data)) {
            if (in_array("", $data)) return $data = false;
            return $data;
        } else if ($data == "" || !$data) {
            return $data = false;    
        } else {
            return $data;
        }
    }

    public function autentikasi($model, $username, $password) {
        require_once "../app/models/" . $model . ".php";
        $model = new $model;
        $result = $model->autentikasi($username, $password);
        return $result;
    }

    public function user($model) {
        require_once "../app/models/" . $model . ".php";
        $model = new $model;
        $result = $model->getUser();
        return $result;
    }

    public function redirect($link) {
        header("location:" . BASEURL . $link);
        exit;
    }

    
}
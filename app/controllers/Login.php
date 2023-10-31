<?php

class Login extends Controller {

    public function index() {
        $this->guestView();
        $this->view("auth/login", [
            "title" => $this->title.  "Login"
        ]);
    }

    public function auth() {
        if (!$_POST) {
            header("location:" . BASEURL . "/login/index");
            exit;
        }

        $this->validate($_POST, ["username", "password"], "/login/index", [
            "username" => "Kolom username tidak boleh kosong",
            "password" => "Kolom password tidak boleh kosong"
        ]);

        if ($this->autentikasi("User_Model", $_POST["username"], $_POST["password"])) {
            header("location:" . BASEURL . "/product/index");
        } else {
            header("location:" . BASEURL . "/login/index");
        }
    }
}
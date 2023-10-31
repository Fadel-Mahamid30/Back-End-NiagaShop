<?php

class Logout {
    public function index() {
        session_destroy();
        header("location:" . BASEURL . "/login");
        exit;   
    }
}
<?php

class User_Model {
    private $table = "users";
    private $db;

    public function __construct() {
        $this->db = New Database;
    }

    public function autentikasi($username, $password) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind("username", $username);
        $user = $this->db->single();
        if (!$user) {
            Flasher::setError([
                "username" => "Username yang dimasukan salah!"
            ],["username"]);
            return false;
            exit;
        } else {
            if (password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = base64_encode($user["id"]);
                return true;
            } else {
                Flasher::setError([
                    "password" => "Password yang dimasukan salah!"
                ],["password"]);
                return false;
            }
        } 
    }

    public function getUser() {
        if (isset($_SESSION["user_id"])) {
            $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
            $this->db->bind("id", base64_decode($_SESSION["user_id"]));
            return $user = $this->db->single();
        } else {
            echo "User tidak terdeteksi";
            exit;
        }
    }

    public function getAllData() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getDetailData($nim) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE nim=:nim");
        $this->db->bind("nim", $nim);
        return $this->db->single();
    }
}
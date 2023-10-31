<?php

class Mahasiswa_model
{
    private $table = "mahasiswa";
    private $db;

    public function __construct() {
        $this->db = New Database;
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
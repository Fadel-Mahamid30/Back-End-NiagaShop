<?php

class Ukuran_Model {
    private $table = "ukuran";
    private $db;

    public function __construct() {
        $this->db = New Database;
    }

    public function insertData($id, $data) {
        $this->db->query("INSERT INTO " . $this->table . " VALUES ('', :produk_id, :ukuran)");
        foreach ($data as $key => $value) {
            $this->db->bind("produk_id", $id);
            $this->db->bind("ukuran", $value);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function deleteData($id_produk, $data) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = :id AND produk_id = :produk_id");
        foreach ($data as $key => $value) {
            $this->db->bind("id", $value);
            $this->db->bind("produk_id", $id_produk);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function getAllDataForId($id_produk) {
        $this->db->query("SELECT * FROM ". $this->table ." WHERE produk_id = :produk_id ORDER BY ukuran ASC");
        $this->db->bind("produk_id", $id_produk);
        return $this->db->resultSet();
    }
}
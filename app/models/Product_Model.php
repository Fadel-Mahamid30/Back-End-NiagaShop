<?php
require_once "Ukuran_Model.php";

class Product_Model {
    private $table = "produk";
    private $ukuran;
    private $db;

    public function __construct() {
        $this->db = New Database;
        $this->ukuran = New Ukuran_Model;
    }

    public function getAllData() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY create_at DESC");
        return $this->db->resultSet();
    }

    public function getSingleData($id_produk) {
        $this->db->query("SELECT * FROM ". $this->table ." WHERE id_produk = :id_produk");
        $this->db->bind("id_produk", $id_produk);
        return $this->db->single();
    }

    public function searchData($search) {
        $this->db->query("SELECT * FROM ". $this->table ." WHERE name LIKE :name");
        $name = "%" . $search . "%";
        $this->db->bind("name", $name);
        return $this->db->resultSet();
    }

    public function insertData($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $this->db->query("INSERT INTO " . $this->table . " VALUES ('', :image, :name, :deskripsi, :harga, :qty, :create_at)");

        $this->db->bind("image", $data["image"]);
        $this->db->bind("name", $data["name"]);
        $this->db->bind("deskripsi", $data["deskripsi"]);
        $this->db->bind("harga", $data["harga"]);
        $this->db->bind("qty", $data["qty"]);
        $this->db->bind("create_at", $date);

        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function updateData($id_produk, $data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        if (isset($data["image"])) {
            $query = "UPDATE " . $this->table . " SET image = :image, name = :name, deskripsi = :deskripsi, harga = :harga, qty = :qty, create_at = :create_at WHERE id_produk = :id_produk";
        } else {
            $query = "UPDATE " . $this->table . " SET name = :name, deskripsi = :deskripsi, harga = :harga, qty = :qty, create_at = :create_at WHERE id_produk = :id_produk";
        }

        $this->db->query($query);

        if (isset($data["image"])) {
            $this->db->bind("image", $data["image"]);
        }

        $this->db->bind("name", $data["name"]);
        $this->db->bind("deskripsi", $data["deskripsi"]);
        $this->db->bind("harga", $data["harga"]);
        $this->db->bind("qty", $data["qty"]);
        $this->db->bind("create_at", $date);
        $this->db->bind("id_produk", $id_produk);

        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function multipleInsert($data) {
        $this->db->beginTransaction();
        try {
            $id = $this->insertData($data);
            $cek = $this->ukuran->insertData($id, $data["ukuran"]);
            if (!$cek) {
                throw new Exception("Data gagal dimasukan");
            }
            $this->db->commit();
            return true;
        } catch (\Throwable $th) {
            $this->db->rollback();
            return false;
        }
    }

    public function multipleUpdate($id, $data) {
        $this->db->beginTransaction();
        $sizeAddSt = 1;
        $sizeDeleteSt = 1;  
        try {
            $this->updateData($id, $data);

            if (isset($data["ukuran"])) {
                $addSize = $this->ukuran->insertData($id, $data["ukuran"]);
                $sizeAddSt = $addSize;
            }

            if (isset($data["hapus_ukuran"])) {
                $deleteSize = $this->ukuran->deleteData($id, $data["hapus_ukuran"]);
                $sizeDeleteSt = $deleteSize;
            }

            if (!$sizeAddSt || !$sizeDeleteSt) {
                throw new Exception("Data gagal dimasukan");
            }

            $this->db->commit();
            return true;
        } catch (\Throwable $th) {
            $this->db->rollback();
            var_dump($th);
            // return false;
        }
    }

    public function deleteData($id_produk) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_produk = :id_produk");
        $this->db->bind("id_produk", $id_produk);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
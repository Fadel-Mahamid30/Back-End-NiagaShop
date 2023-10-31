<?php

class Product extends Controller
{
    private $db;

    public function __construct() {
        $this->authView();
        $this->db = New Database;
    }

    public function index() 
    {
        $search = "";
        if (isset($_POST["search"])) $search = $_POST["search"];
        $this->model("Product_Model")->searchData($search);
        $this->view("product/index", [
            "title" => $this->title . "Dashboard",
            "user" => $this->user("User_Model"),
            "produk" => $this->model("Product_Model")->searchData($search),
            "search" => $search
        ]);
    }

    public function detail_produk($id_produk = 0) {

        $produk = $this->model("Product_Model")->getSingleData($id_produk);
        if (!$produk) $this->redirect("/product/index");
        $size = $this->model("Ukuran_Model")->getAllDataForId($id_produk);

        $this->view("product/detail_produk", [
            "title" => $this->title . "Detail Produk",
            "produk" => $produk,
            "size" => $size
        ]);
    }

    public function addData() {
        $this->view("product/add_data", [
            "title" => $this->title . "Add Data"
        ]);
    }

    public function insert() {
        $data = [
            "image" => $this->img()->isImage($_FILES["upload-foto"]),
            "name" => $this->hasData($_POST["nama-produk"]),
            "ukuran" => $this->hasData($_POST["ukuran"]),
            "deskripsi" => $this->hasData($_POST["deskripsi"]),
            "harga" => $this->hasData($_POST["harga"]),
            "qty" => $this->hasData($_POST["qty"])
        ];

        $nameInput = ["image", "name", "ukuran", "deskripsi", "harga", "qty"];
        $this->validate($data, $nameInput, "/product/addData");
        $result = $this->model("Product_Model")->multipleInsert($data);
    
        if ($result) {
            Flasher::setFlash("success", "Data Berhasil Ditambahkan!");
            $this->redirect("/product/index");
        } else {
            Flasher::setFlash("failed", "Data Gagal Ditambahkan!");
            $this->img()->deleteImage($data["image"]);
            $this->redirect("/product/index");
        }
    }

    public function editData($id_produk = 0) {
        $produk = $this->model("Product_Model")->getSingleData($id_produk);
        if (!$produk) $this->redirect("/product/index");
        $size = $this->model("Ukuran_Model")->getAllDataForId($id_produk);

        $this->view("product/edit_data", [
            "title" => $this->title . "Edit Produk",
            "produk" => $produk,
            "size" => $size
        ]);
    }

    public function delete($id_produk = 0) {

        $data = $this->model("Product_Model")->getSingleData($id_produk);

        if ($data) {
            if ($this->model("Product_Model")->deleteData($id_produk) >= 0) {
                Flasher::setFlash("success", "Data Berhasil Dihapus!");
                $this->img()->deleteImage($data["image"]);
                $this->redirect("/product/index");
            } else {
                Flasher::setFlash("failed", "Data Gagal Dihapus!");
                $this->redirect("/product/index");
            }
        } else {
            Flasher::setFlash("failed", "Data Tidak Ditemukan");
            $this->redirect("/product/index");
        }

    }

    public function update($id_produk = 0) {

        var_dump($_POST["hapus_ukuran"]);
        $produk = $this->model("Product_Model")->getSingleData($id_produk);
        if (!$produk) $this->redirect("/product/index");

        $data = [
            "name" => $this->hasData($_POST["nama-produk"]),
            "deskripsi" => $this->hasData($_POST["deskripsi"]),
            "harga" => $this->hasData($_POST["harga"]),
            "qty" => $this->hasData($_POST["qty"])
        ];

        $nameInput = ["name","deskripsi", "harga", "qty"];

        if (!isset($_POST["tambah_ukuran"]) && count($_POST["ukuran"]) <= 0) {
            $this->validate($_POST["ukuran"], ["ukuran"], "/product/editData");
        } else {
            if (isset($_POST["tambah_ukuran"])) {
                $data["ukuran"] = $this->hasData($_POST["tambah_ukuran"]);
                $nameInput[] = "ukuran";
            }
        }

        if ($this->hasData($_FILES["upload-foto"])) {
            $data["image"] = $this->img()->isImage($_FILES["upload-foto"]);
            $nameInput[] = "image";
        }

        
        if (isset($_POST["hapus_ukuran"])) {
            $data["hapus_ukuran"] = $_POST["hapus_ukuran"];
        }
        
        $this->validate($data, $nameInput, "/product/editData");

        $result = $this->model("Product_Model")->multipleUpdate($produk["id_produk"], $data);

        if ($result) {
            Flasher::setFlash("success", "Data Berhasil Diupdate!");
            if ($this->hasData($_FILES["upload-foto"])) $this->img()->deleteImage($produk["image"]);
            $this->redirect("/product/index");
        } else {
            Flasher::setFlash("failed", "Data Gagal Diupdate!");
            if ($this->hasData($_FILES["upload-foto"])) $this->img()->deleteImage($data["image"]);
            $this->redirect("/product/index");
        }
    }

}
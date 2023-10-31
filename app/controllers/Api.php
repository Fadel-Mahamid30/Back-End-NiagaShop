<?php

class Api extends Controller {
    private $codeApi = 30092002;
    
    public function headerApi() {
        // Set header CORS untuk mengizinkan permintaan dari domain yang spesifik
        header("Access-Control-Allow-Origin: *"); // Mengizinkan akses dari semua domain, untuk pengembangan
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type");
        
        // Penanganan permintaan OPTIONS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
            header('Access-Control-Allow-Headers: Content-Type');
            http_response_code(200);
            exit;
        }
    }

    public function index($code) {
        $this->headerApi();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                if ($code != $this->codeApi) {
                    throw new Exception("Kode API tidak dikenali");
                }
                
                // Lakukan pengambilan data dari model Anda
                $data = $this->model("Product_Model")->getAllData();
                $produk = [];
                foreach ($data as $key => $value) {
                    $produk[] = [
                        "id" => $value["id_produk"],
                        "foto" => BASEURL .  $value["image"],
                        "nama_produk" => $value["name"],
                        "deskripsi" => $value["deskripsi"],
                        "harga" => $value["harga"],
                        "qty" => $value["qty"],
                        "create_at" => $value["create_at"]
                    ];
                }
                echo json_encode($produk);
            } catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(array("message" => "Terjadi kesalahan: " . $e->getMessage()));
            }
        } else {
            http_response_code(405); // Method not allowed
            echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
        }
    }

    public function getId($code, $id) {
        $this->headerApi();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                if ($code != $this->codeApi) {
                    throw new Exception("Kode API tidak dikenali");
                }
                
                // Lakukan pengambilan data dari model Anda
                $data = $this->model("Product_Model")->getSingleData($id);
                $dataUkuran = $this->model("Ukuran_Model")->getAllDataForId($id);
                $ukuran = [];
                foreach ($dataUkuran as $key => $value) {
                    $ukuran[] = $value["ukuran"];
                }
                $produk = [
                    "id" => $data["id_produk"],
                    "foto" => BASEURL .  $data["image"],
                    "nama_produk" => $data["name"],
                    "deskripsi" => $data["deskripsi"],
                    "harga" => $data["harga"],
                    "qty" => $data["qty"],
                    "ukuran" => $ukuran,
                    "create_at" => $data["create_at"]
                ];
                echo json_encode($produk);
            } catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(array("message" => "Terjadi kesalahan: " . $e->getMessage()));
            }
        } else {
            http_response_code(405); // Method not allowed
            echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
        }
    }

    public function search($code, $search = "") {
        $this->headerApi();
	$search = str_replace('*-*', ' ', $search);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if ($code != $this->codeApi) {
            throw new Exception("Kode API tidak dikenali");
        }
        
        $data = $this->model("Product_Model")->searchData(ucwords($search));
        $produk = [];
        foreach ($data as $key => $value) {
            $produk[] = [
                "id" => $value["id_produk"],
                "foto" => BASEURL .  $value["image"],
                "nama_produk" => $value["name"],
                "deskripsi" => $value["deskripsi"],
                "harga" => $value["harga"],
                "qty" => $value["qty"],
                "create_at" => $value["create_at"]
            ];
        }
        echo json_encode($produk);
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Terjadi kesalahan: " . $e->getMessage()));
    }
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
}
    }
}

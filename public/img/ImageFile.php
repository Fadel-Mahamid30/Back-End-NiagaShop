<?php 

class ImageFile {

    private $targetUploadFile = __DIR__.'/product/';

    private function generateRandomFileName($firstName,$data) {
        $uploadedFile = $data['tmp_name'];
        $originalFileName = $data['name'];

        // Membuat timestamp untuk nama file baru
        $timestamp = time();

        // Mengekstrak ekstensi file dari nama file asli
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Membuat nama file baru dengan timestamp
        $newFileName = $firstName . $timestamp . '_' . uniqid() . '.' . $fileExtension;
        return $newFileName;
    }

    public function isImage($data) {
        if (is_array($data)) {
            if (in_array("", $data)) {
                return false;
            }

            $uploadedFile = $data['tmp_name'];
            $targetFile = $this->targetUploadFile . basename($data["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return false;
            }

            $newFileName = $this->generateRandomFileName("img-", $data);
            $targetFilePath = $this->targetUploadFile . $newFileName;

            if (move_uploaded_file($uploadedFile, $targetFilePath)) {
                return "/img/product/" . $newFileName;
            } else {
                echo $data["error"];
                return false;
            }
        } else {
            return $data;
        }
    }

    public function deleteImage($nameFile) {
        $x = explode("/", $nameFile);
        $nameFile = $x[count($x)-1];

        $filePath = $this->targetUploadFile . $nameFile;
        if (file_exists($filePath)) {
            unlink($filePath);   
        }
    }
}
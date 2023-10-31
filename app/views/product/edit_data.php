<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= BASEURL ?>/img/asset/logo-title.ico" type="image/x-icon">

    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style_form.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style_flesher.css">
</head>
<body>
    <section id="container">
        <div class="return">
            <a href="<?= BASEURL; ?>/product" class="btn-return">
                <ion-icon name="arrow-back-circle-outline"></ion-icon>
                <span>Kembali</span>
            </a>
        </div>
        <div class="card">
            <h2>Tambah Data Produk</h2>
            <div class="image">
                <img src="<?= BASEURL . $produk['image']; ?>" alt="" id="image-upload">
            </div>
            <form action="<?= BASEURL?>/product/update/<?= $produk["id_produk"] ?>" method="post" enctype="multipart/form-data">
                <div class="input-file">
                    <label class="file-upload">
                        <input type="file" id="upload-file" name="upload-foto">
                        <span class="btn-select">Select a file</span>
                        <span class="name-file"></span>
                    </label>
                    <?= isset($image) ? "<p class='error-validate'>" . $image . "</p>" : ""; ?>
                </div>
                <label for="nama">
                    <span>Nama produk</span>
                    <input type="text" name="nama-produk" id="nama" value="<?= $produk['name']; ?>">
                    <?= isset($name) ? "<p class='error-validate'>" . $name . "</p>" : ""; ?>
                </label>
                <label for="ukuran">
                    <span>Ukuran</span>
                    <div class="input-ukuran">
                        <input type="number" name="ukuran" id="ukuran">
                        <div id="btn-addUkuran"><ion-icon name="add"></ion-icon></div>
                    </div>
                    <?= isset($ukuran) ? "<p class='error-validate'>" . $ukuran . "</p>" : ""; ?>
                </label>
                <div id="list-ukuran">
                    <?php foreach ($size as $key => $value) : ?>
                        <div class="item-ukuran">
                            <input type="checkbox" name="ukuran[]" style="display: none;" value="<?= $value['id'] ?>" checked readonly>
                            <span><?= $value['ukuran']; ?></span>
                            <ion-icon name="close-outline" class="delete-data" data-id="<?= $key + 1; ?>"></ion-icon>
                        </div>
                    <?php endforeach; ?>
                </div>
                <label for="deskripsi">
                    <span>Deskripsi</span>
                    <textarea name="deskripsi"  id="deskripsi" cols="30" rows="5"><?= $produk["deskripsi"]; ?></textarea>
                    <?= isset($deskripsi) ? "<p class='error-validate'>" . $deskripsi . "</p>" : ""; ?>
                </label>
                <label for="harga">
                    <span>Harga</span>
                    <input type="number" name="harga" id="harga" value="<?= $produk['harga']; ?>">
                    <?= isset($harga) ? "<p class='error-validate'>" . $harga . "</p>" : ""; ?>
                </label>
                <label for="qty">
                    <span>Qty</span>
                    <input type="number" name="qty" id="qty"  value="<?= $produk['qty']; ?>">
                    <?= isset($qty) ? "<p class='error-validate'>" . $qty . "</p>" : ""; ?>
                </label>
                <button type="submit" name="submit" class="btn-submit">Tambah</button>
            </form>
        </div>
    </section>
    <!-- ion-icon  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="<?= BASEURL; ?>/js/editData.js"></script>
</body>
</html>
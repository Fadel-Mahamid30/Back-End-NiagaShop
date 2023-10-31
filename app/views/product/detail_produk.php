<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= BASEURL ?>/img/asset/logo-title.ico" type="image/x-icon">

    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style_detail_produk.css">
</head>
<body>
<section id="container">
        <div class="return">
            <a href="<?= BASEURL; ?>/product" class="btn-return">
                <ion-icon name="arrow-back-circle-outline"></ion-icon>
                <span>Kembali</span>
            </a>
        </div>
        <div class="content">
            <div class="card">
                <div class="image-product">
                    <img src="<?= BASEURL . $produk['image']; ?>" alt="">
                </div>
                <div class="info-product">
                    <h1 class="name-product"><?= $produk['name']; ?></h1>
                    <div class="deskripsi">
                        <p>Deskripsi</p>
                        <p><?= $produk['deskripsi']; ?></p>
                    </div>
                    <div class="size">
                        <p>Size</p>
                        <div class="list-size">
                            <?php foreach ($size as $key => $value) : ?>
                                <div class="item-size"><?= $value["ukuran"]; ?></div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="PriceQuantityBundle">
                        <div class="harga">
                            <p>Harga</p>
                            <p>Rp <?= number_format($produk["harga"], 0, ",", "."); ?></p>
                        </div>
                        <div class="qty">
                            <p>Qty</p>
                            <p><?= $produk["qty"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ion-icon  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
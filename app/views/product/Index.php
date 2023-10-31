<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= BASEURL ?>/img/asset/logo-title.ico" type="image/x-icon">

    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style_dashboard.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style_flesher.css">
</head>
<body>
    <section id="container">
        <nav>
            <div class="logo">
                <img src="<?= BASEURL; ?>/img/asset/logo-white.png" alt="">
                <div class="text">
                    <h2>NIAGA SHOP</h2>
                    <p>Online Shop</p>
                </div>
            </div>
            <div class="user">
                <div class="profile">
                    <img src="<?= BASEURL; ?>/<?= $user['image_profil'] ?? ""; ?>" alt="">
                </div>
                <p><?= $user['name'] ?? ""; ?> </p>
                <div class="action">
                    <ion-icon name="chevron-up-outline"></ion-icon>
                </div>
                <a href="<?= BASEURL; ?>/logout" class="menu">
                    <ion-icon name="log-in-outline"></ion-icon>
                    <span>Log Out</span>
                </a>
            </div>
        </nav>

        <div id="content">
            <div class="body-content">

                <?= Flasher::flash(); ?>

                <h2 class="title">Data Produk</h2>
                <div class="data-action">
                    <form action="<?= BASEURL; ?>/product" method="POST" class="search">
                        <input type="text" class="input-search" name="search" value="<?= $search ?? '';  ?>" placeholder="Search">
                        <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
                    </form>
                    <a href="<?= BASEURL; ?>/product/addData" class="add-data">
                        <ion-icon name="add"></ion-icon>
                        <span>Tambah Data</span>
                    </a>
                </div>
                <div class="data-table">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-items">
                                <?php foreach ($produk as $key => $value) : ?>
                                    <tr class="item">
                                        <td><?= $key + 1; ?></td>
                                        <td>
                                            <div class="produk">
                                                <div class="img-produk">
                                                    <img src="<?= BASEURL . $value['image']; ?>" alt="">
                                                </div>
                                                <p><?= $value["name"] ?></p>
                                            </div>
                                        </td>
                                        <td><?= "Rp " . number_format($value["harga"], 0, ',', '.') ?></td>
                                        <td><?= $value["qty"] ?></td>
                                        <td>
                                            <div class="aksi">
                                                <a href="<?= BASEURL . '/product/editData/' . $value['id_produk'] ?>" class="edit"><ion-icon name="create-outline"></ion-icon></a>
                                                <a href="<?= BASEURL . '/product/detail_produk/' . $value['id_produk'] ?>" class="view-detail"><ion-icon name="eye-outline"></ion-icon></a>
                                                <a href="<?= BASEURL . '/product/delete/' . $value['id_produk'] ?>" class="delete"><ion-icon name="trash-outline"></ion-icon></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="pagination">
                    <p><span class="first-page"></span> Page For <span class="last-page"></span> Page</p>
                    <ul>
                        <li><div class="prev"><ion-icon name="chevron-back-outline"></ion-icon></div></li>
                        <li><p>1</p></li>
                        <li><div class="next"><ion-icon name="chevron-forward-outline"></ion-icon></div></li>
                    </ul>
                </div>
            </div>
            
        </div>

    </section>

    <!-- ion-icon  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="<?= BASEURL; ?>/js/dashboard.js"></script>
    <script src="<?= BASEURL; ?>/js/flash.js"></script>
</body>
</html>
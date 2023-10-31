<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= BASEURL ?>/img/asset/logo-title.ico" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASEURL ?>/css/style_login.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style_flesher.css">
</head>
<body style="min-height: 100vh;background: url('<?= BASEURL ?>/img/asset/bg-img.png');background-repeat: no-repeat;background-size: cover;">
    <section id="container">
        <div class="card">
            <form action="<?= BASEURL?>/login/auth" method="post">
                <div class="logo">
                    <img src="<?= BASEURL ?>/img/asset/logo-black.png" alt="">
                    <h2>Niaga Shop</h2>
                </div>
                <div class="text">
                    <h2>Login</h2>
                    <p>Fill The Bellow Informaton To Log In</p>
                </div>
                <div class="inputs">
                    <label for="username">
                        <span>Username</span>
                        <input class="input" type="text" id="username" name="username" placeholder="Username">
                        <?= isset($username) ? "<p class='error-validate'>" . $username . "</p>" : ""; ?>
                    </label>
                    <label for="password">
                        <span>Password</span>
                        <input class="input" type="password" id="password" name="password" placeholder="Password">
                        <?= isset($password) ? "<p class='error-validate'>" . $password . "</p>" : ""; ?>
                    </label>
                    <button class="btn-login">Login</button>
                </div>
            </form>
        </div>
    </section>
    
    <!-- ion-icon  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php session_start();
require_once "./login/checkAccountAdmin.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản trị</title>
    <link rel="stylesheet" type="text/css" href="./css/style1.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://kit.fontawesome.com;">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body> <img class="wave" src="./img/wave.png">
    <h1>Quản lý nhân viên</h1>
    <div class="container">
        <div class="img"> <img src="./img/bg.svg"> </div>
        <div class="login-content">
            <form action="" method="post"> <img src="./img/avatar.svg">
                <h2 class="title">Đăng nhập</h2>
                <div class="input-div one">
                    <div class="i"> <i class="fas fa-user"></i> </div>
                    <div class="div">
                        <h5>Tên đăng nhập</h5> <input id="user_login" type="text" class="input" name="user" autocomplete="current-user">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> <i class="fas fa-lock"></i> </div>
                    <div class="div">
                        <h5>Mật khẩu</h5> <input id="pass_login" type="password" class="input" name="pass" autocomplete="current-password">
                    </div>
                </div> <a href="#">Quên mật khẩu</a> <?php if ($loi) echo "<p id=\"loi\"> Tài khoản hoặc mật khẩu không chính xác</p>"; ?> <input type="submit" class="btn" value="Đăng nhập" name="submit">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="./js/main.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
</body>

</html>
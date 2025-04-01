<?php if (isset($_SESSION['userNhanVien']) && isset($_SESSION['passMatKhau'])) {
    require_once "sql.php";
    $Sql = new SQL();
    $user = $_SESSION['userNhanVien'];
    $pass = $_SESSION['passMatKhau'];
    checkdata($Sql, $user, $pass);
} else {
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 1000);
            setcookie($name, '', time() - 1000, '/');
        }
    }
    header("location: ./");
}
function checkdata($sql, $user, $pass)
{
    $data = $sql->getdata("select * from taikhoan where TaiKhoan = '$user' and MatKhau = '$pass'");
    if ($data->num_rows < 1) {
        header("location: ./");
        die();
    }
}

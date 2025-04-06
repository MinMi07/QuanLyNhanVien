<?php $loi = false;
if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['submit'])) {
    require_once "sql.php";
    $Sql = new SQL();
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    checkdata($Sql, $user, $pass, 'nhanVien.php', $loi);
}

if (isset($_COOKIE['checkNhanVien'])) {
    if ($_COOKIE['checkNhanVien']) {
        header("location: ./nhanVien.php");
    }
}
function checkdata($sql, $user, $pass, $trang, &$loi)
{
    $data = $sql->getdata("select * from taikhoan where TaiKhoan = '$user' and MatKhau = '$pass'");
    
    if ($data->num_rows > 0) {
        $nhavien = $sql->getdata("SELECT MaNhanVien from nhanvien where TaiKhoan = '$user'")->fetch_assoc()['MaNhanVien'];
        setcookie('checkNhanVien', true, time() + 3600);
        $_SESSION['userNhanVien'] = $_POST['user'];
        $_SESSION['passMatKhau'] = $_POST['pass'];
        $_SESSION['maNhanVien'] = $nhavien;
        header("location: ./" . $trang . "");
        die();
    } else {
        $loi = true;
    }
}

<?php $loi = false;
if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['submit'])) {
    require_once "sql.php";
    $Sql = new SQL();
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    checkdata($Sql, $user, $pass, 'admin.php', $loi);
}

if (isset($_COOKIE['checkadmin'])) {
    if ($_COOKIE['checkadmin']) {
        header("location: ./admin.php");
    }
}
function checkdata($sql, $user, $pass, $trang, &$loi)
{
    $data = $sql->getdata("select * from admin where username = '$user' and pass = '$pass'");
    if ($data->num_rows > 0) {
        setcookie('checkadmin', true, time() + 3600);
        $_SESSION['userad'] = $_POST['user'];
        $_SESSION['passad'] = $_POST['pass'];
        header("location: ./" . $trang . "");
        die();
    } else {
        $loi = true;
    }
}

<?php if (isset($_SESSION['userad']) && isset($_SESSION['passad'])) {
    require_once "sql.php";
    $Sql = new SQL();
    $user = $_SESSION['userad'];
    $pass = $_SESSION['passad'];
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
    $data = $sql->getdata("select * from admin where username = '$user' and pass = '$pass'");
    if ($data->num_rows < 1) {
        header("location: ./");
        die();
    }
}

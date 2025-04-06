<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
header('Content-Type: application/json');
require_once "sql.php";

$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['manhanvien']) || 
    empty($data['manhanvien'])
) {
    echo json_encode(["success" => false, "message" => "Không có dữ liệu"]);
    exit;
}

$maNhanVien = (int)$data['manhanvien'];

$timeNow = date("Y-m-d H:i:s");
$statusCheckin = 1;
$type = 2; // 1 : công thường, 2 : công tăng ca 

$rawQuery = "INSERT INTO chamcong (MaNhanVien, ThoiGian, TrangThai, Loai) VALUES ($maNhanVien,'$timeNow',$statusCheckin,$type)";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

if ($query) {
    echo json_encode(["success" => true, "message" => "Chấm công tăng ca thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Chấm công tăng ca thất bại"]);
}

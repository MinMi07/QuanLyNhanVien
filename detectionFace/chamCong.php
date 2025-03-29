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

$ruleTime = date("Y-m-d 09:00:00");
$timeNow = date("Y-m-d H:i:s");
$statusCheckin = 1;

if ($timeNow > $ruleTime) {
    $statusCheckin = 0;
}

$rawQuery = "INSERT INTO chamcong (MaNhanVien, ThoiGian, TrangThai) VALUES ($maNhanVien,'$timeNow',$statusCheckin)";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

if ($query) {
    if (!$statusCheckin) {
        echo json_encode(["success" => true, "message" => "Bạn đã chấm công muộn"]);
        exit;
    }
    echo json_encode(["success" => true, "message" => "Chấm công thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Chấm công thất bại"]);
}

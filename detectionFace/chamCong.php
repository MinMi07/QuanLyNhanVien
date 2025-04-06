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
$timeCheckin = $sql->getdata("SELECT GiaTri FROM cauhinhthongso WHERE CauHinh = 'thoiGianChamCong'")->fetch_assoc()['GiaTri'];

$ruleTime = date("Y-m-d $timeCheckin");
$timeNow = date("Y-m-d H:i:s");
$statusCheckin = 1; // chấm công đúng giờ
$type = 1; // 1 : công thường, 2 : công tăng ca 

if ($timeNow > $ruleTime) {
    $statusCheckin = 0; // chấm công muộn
}

$rawQuery = "INSERT INTO chamcong (MaNhanVien, ThoiGian, TrangThai, Loai) VALUES ($maNhanVien,'$timeNow',$statusCheckin,$type)";

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

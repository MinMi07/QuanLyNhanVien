<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once "./logIn/sql.php";
require_once "./infor_general.php";

$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["CONTENT_TYPE"] !== "application/json") {
    echo json_encode(["success" => false, "message" => "Sai kiểu dữ liệu, yêu cầu JSON"]);
    exit;
}

// Lấy dữ liệu từ request POST
$maNhanVien = $data['MaNhanVien'] ?? null;
$loaiHopDong = $data['LoaiHopDong'] ?? null;
$ngayBatDau = $data['NgayBatDau'] ?? null;
$ngayHetHan = $data['NgayHetHan'] ?? null;
$bacLuong = $data['BacLuong'] ?? null;
$heSoLuong = $data['HeSoLuong'] ?? null;
$phuCap = $data['PhuCap'] ?? null;
$baoHiem = $data['BaoHiem'] ?? null;
$luongThoaThuan = $data['LuongThoaThuan'] ?? null;
$trangThai = $data['TrangThai'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maNhanVien || !$loaiHopDong || !$ngayBatDau || !$ngayHetHan || !$bacLuong || !$heSoLuong || !$phuCap || !$baoHiem || !$luongThoaThuan || !$trangThai) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO hopdong (MaNhanVien,LoaiHopDong,NgayBatDau,NgayHetHan,BacLuong,HeSoLuong,PhuCap,BaoHiem,LuongThoaThuan,TrangThai) VALUES ('$maNhanVien','$loaiHopDong','$ngayBatDau','$ngayHetHan','$bacLuong','$heSoLuong','$phuCap','$baoHiem','$luongThoaThuan','$trangThai')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm hợp đồng thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm hợp đồng!"]);
}

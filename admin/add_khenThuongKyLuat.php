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
$thoiGianKhenThuongKyLuat = $data['ThoiGianKhenThuongKyLuat'] ?? null;
$loai = $data['Loai'] ?? null;
$noiDung = $data['NoiDung'] ?? null;
$soQuyetDinh = $data['SoQuyetDinh'] ?? null;
$coQuanQuyetDinh = $data['CoQuanQuyetDinh'] ?? null;
$hinhThuc = $data['HinhThuc'] ?? null;
$soTien = $data['SoTien'] ?? null;
$ghiChu = $data['GhiChu'] ?? null;

// Kiểm tra dữ liệu hợp lệ

if (!$maNhanVien || !$thoiGianKhenThuongKyLuat || !$loai || !$noiDung || !$soQuyetDinh || !$coQuanQuyetDinh || !$hinhThuc || !$soTien || !$ghiChu) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO khenthuongkyluat (MaNhanVien,ThoiGianKhenThuongKyLuat,Loai,NoiDung,SoQuyetDinh,CoQuanQuyetDinh,HinhThuc,SoTien,GhiChu) VALUES ('$maNhanVien','$thoiGianKhenThuongKyLuat','$loai','$noiDung','$soQuyetDinh','$coQuanQuyetDinh','$hinhThuc','$soTien','$ghiChu')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm khen thưởng, kỷ luật thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm khen thưởng, kỷ luật!"]);
}

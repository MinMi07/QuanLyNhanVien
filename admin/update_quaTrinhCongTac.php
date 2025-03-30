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
$maQuaTrinh = $data['MaQuaTrinh'] ?? null;
$maNhanVien = $data['MaNhanVien'] ?? null;
$loai = $data['Loai'] ?? null;
$thoiGian = $data['ThoiGian'] ?? null;
$moTaChiTiet = $data['MoTaChiTiet'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maNhanVien || !$loai || !$thoiGian || !$moTaChiTiet) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "UPDATE quatrinhcongtac 
            SET 
                MaNhanVien = '$maNhanVien',
                Loai = '$loai',
                ThoiGian = '$thoiGian',
                MoTaChiTiet = '$moTaChiTiet'
            WHERE MaQuaTrinh = $maQuaTrinh";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Cập nhật quá trình công tác thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật quá trình công tác!"]);
}

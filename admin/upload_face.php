<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taiKhoan = trim($_POST['taiKhoan']);

    if (empty($taiKhoan)) {
        die("Lỗi: Không nhận được tài khoản!");
    }

    $uploadDir = "C:/xampp/htdocs/QuanLyNhanVien/detectionFace/dataset/" . $taiKhoan;

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedFiles = $_FILES['images'];

    if (!isset($uploadedFiles)) {
        die("Lỗi: Không có file nào được tải lên!");
    }

    // Xóa các file cũ trước khi lưu mới
    array_map('unlink', glob("$uploadDir/*.jpg"));

    for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
        $tmpFilePath = $uploadedFiles['tmp_name'][$i];
        if ($tmpFilePath) {
            $newFilePath = $uploadDir . "/" . ($i + 1) . ".jpg";
            move_uploaded_file($tmpFilePath, $newFilePath);
        }
    }

    echo json_encode(["success" => true, "message" => "Ảnh của tài khoản '$taiKhoan' đã được lưu thành công"]);
}

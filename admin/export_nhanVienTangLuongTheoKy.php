<?php
require_once "./logIn/sql.php";
$sql = new SQL();

// Lấy tháng hiện tại
$threeYearsAgo = date("Y-m-d", strtotime("-3 years"));

// Truy vấn danh sách nhân viên có ngày tham gia công ty đúng 3 năm trước
$query = "SELECT MaNhanVien, HoTen, NgayThamGia FROM nhanvien WHERE NgayThamGia = '$threeYearsAgo'";
$result = $sql->getdata($query);

if ($result && $result->num_rows > 0) {
    $filename = "nhanVienTangLuongTheoKy_" . date("Y-m-d") . ".csv";
    $filepath = __DIR__ . "/exports/" . $filename;

    // Tạo thư mục nếu chưa có
    if (!file_exists(__DIR__ . "/exports")) {
        mkdir(__DIR__ . "/exports", 0777, true);
    }

    // Mở file để ghi dữ liệu
    $file = fopen($filepath, "w");

    // **Thêm BOM để hỗ trợ Unicode trong Excel**
    fwrite($file, "\xEF\xBB\xBF");

    // Ghi tiêu đề cột
    fputcsv($file, ["Mã Nhân Viên", "Họ Tên", "Ngày Tham Gia Công Ty"]);

    // Ghi dữ liệu
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, [$row["MaNhanVien"], $row["HoTen"], $row["NgayThamGia"]]);
    }

    fclose($file);
    echo "✅ Xuất file thành công: $filename\n";
} else {
    echo "⚠️ Không có nhân viên nào có sinh nhật trong tháng này.\n";
}

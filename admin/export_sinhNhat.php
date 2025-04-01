<?php
require_once "./logIn/sql.php";
$sql = new SQL();

// Kiểm tra nếu hôm nay là ngày đầu tiên của tháng
$firstDay = "01";
$curDay = date("d");
if (date("d") === $curDay) {
    // Lấy tháng hiện tại
    $month = date("m");

    // Truy vấn danh sách nhân viên có sinh nhật trong tháng
    $query = "SELECT MaNhanVien, HoTen, NgaySinh FROM nhanvien WHERE MONTH(NgaySinh) = $month";
    $result = $sql->getdata($query);

    // Tạo tên file
    $filename = "sinhNhat_" . date("Y-m") . ".csv";
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
    fputcsv($file, ["Mã Nhân Viên", "Họ Tên", "Ngày Sinh"]);

    // Ghi dữ liệu nếu có
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, [$row["MaNhanVien"], $row["HoTen"], $row["NgaySinh"]]);
        }
    }

    fclose($file);
    echo "✅ Xuất file thành công: $filename\n";
} else {
    echo "⏳ Hôm nay không phải ngày đầu tháng, không xuất file.\n";
}
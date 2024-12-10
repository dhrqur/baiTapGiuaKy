<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

// Lấy id từ URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id != 0) {
    // Xóa sinh viên theo id
    $delete_sql = "DELETE FROM table_Students WHERE id = $id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>
        alert('Xóa sinh viên thành công!');
        window.location.href = 'index.php';
        </script>";
    } else {
        echo "Lỗi khi xóa sinh viên.";
    }
} else {
    echo "ID không hợp lệ";
    exit;
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>

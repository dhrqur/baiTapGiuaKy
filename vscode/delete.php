<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu có tham số id truyền vào
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa sinh viên
    $delete_sql = "DELETE FROM table_Students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);

    if ($stmt) {
        // Liên kết tham số với câu lệnh SQL
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {
            // Sau khi xóa thành công, chuyển hướng về trang danh sách sinh viên
            header('Location: index.php');
            exit;
        } else {
            echo "Lỗi khi xóa sinh viên.";
        }

        // Đóng statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi khi chuẩn bị câu lệnh SQL.";
    }
} else {
    echo "Không có id sinh viên.";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>

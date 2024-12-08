<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

// Lấy id từ URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id != 0) {
    // Lấy thông tin chi tiết của sinh viên theo id
    $read_sql = "SELECT * FROM table_Students WHERE id = $id";
    $result = mysqli_query($conn, $read_sql);

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy sinh viên";
        exit;
    }
} else {
    echo "ID không hợp lệ";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>CHI TIẾT SINH VIÊN</title>
</head>
<body>
    <div class="container mb-5 mt-5">
        <h1>CHI TIẾT SINH VIÊN</h1>

        <!-- Hiển thị thông tin chi tiết của sinh viên -->
        <div class="card">
            <div class="card-header">
                <h3><?php echo $student['fullname']; ?></h3>
            </div>
            <div class="card-body">
                <p><strong>Ngày sinh:</strong> <?php echo date("d/m/Y", strtotime($student['dob'])); ?></p>
                <p><strong>Giới tính:</strong> <?php echo ($student['gender'] == 1) ? 'Nam' : 'Nữ'; ?></p>
                <p><strong>Quê quán:</strong> <?php echo $student['hometown']; ?></p>
                <p><strong>Trình độ học vấn:</strong> 
                    <?php 
                    switch ($student['level']) {
                        case 0:
                            echo 'Tiến sĩ';
                            break;
                        case 1:
                            echo 'Thạc sĩ';
                            break;
                        case 2:
                            echo 'Kỹ sư';
                            break;
                        case 3:
                            echo 'Khác';
                            break;
                    }
                    ?>
                </p>
                <p><strong>Nhóm:</strong> <?php echo $student['group_id']; ?></p>
            </div>
            <div class="card-footer">
                <a href="index.php" class="btn btn-secondary">Trở về danh sách</a>
            </div>
        </div>
    </div>
</body>
</html>

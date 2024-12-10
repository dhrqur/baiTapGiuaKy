<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu có từ khóa tìm kiếm
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']); //trim dùng để loại bỏ tất cả các khoảng trắng trong chuỗi
    $search_sql = "SELECT * FROM table_Students WHERE fullname LIKE '%$search%' OR hometown LIKE '%$search%' ORDER BY id DESC"; //DESC là sắp xếp id giảm dần
}

$result = mysqli_query($conn, $search_sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>KẾT QUẢ TÌM KIẾM</title>
</head>
<body>
<div class="container mb-5 mt-5">
    <h1>KẾT QUẢ TÌM KIẾM</h1>
    <a href="index.php" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Trình độ học vấn</th>
                <th>Nhóm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $dob = date("d/m/Y", strtotime($row['dob']));
                    $gender = ($row['gender'] == 1) ? 'Nam' : 'Nữ';
                    $level = ($row['level'] == 0) ? 'Tiến sĩ' : (($row['level'] == 1) ? 'Thạc sĩ' : (($row['level'] == 2) ? 'Kỹ sư' : 'Khác'));

                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$dob}</td>
                            <td>{$gender}</td>
                            <td>{$row['hometown']}</td>
                            <td>{$level}</td>
                            <td>{$row['group_id']}</td>
                            <td>
                                <a href='update.php?id={$row['id']}' class='btn btn-warning'>
                                    <i class='bi bi-pencil'></i> Sửa
                                </a> |
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>
                                    <i class='bi bi-trash'></i> Xóa
                                </a> |
                                <a href='read.php?id={$row['id']}' class='btn btn-info'>
                                    <i class='bi bi-eye'></i> Chi tiết
                                </a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có kết quả tìm kiếm nào</td></tr>";
            }

            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>



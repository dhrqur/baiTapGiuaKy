<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group_id = $_POST['group_id']; 
    

    // Thêm sinh viên vào cơ sở dữ liệu
    $create_sql = "INSERT INTO table_Students (fullname, dob, gender, hometown, level, group_id)
            VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$group_id')";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $create_sql)) {
        echo "<script>
             alert('Thêm sinh viên thành công!');
             window.location.href = 'index.php';
        </script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Đóng kết nối
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="vali.js" defer></script> 
    <title>THÊM SINH VIÊN</title>
</head>
<body>
<div class="container mb-2 mt-2">
    <h1>THÊM SINH VIÊN</h1>
    <form  action="create.php" method="POST">
        <!-- Nhập họ tên -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" required>
        </div>
        <!-- Nhập dob -->
        <div class="mb-3">
            <label for="dob" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <!-- Nhập giới tính -->
        <div class="mb-3">
            <label>Giới tính</label><br>
            <input type="radio" id="male" name="gender" value="1" required>
            <label for="male">Nam</label><br>

            <input type="radio" id="female" name="gender" value="0" required>
            <label for="female">Nữ</label>
        </div>
        <!-- Nhập quê quán-->
        <div class="mb-3">
            <label for="hometown" class="form-label">Quê quán</label>
            <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Nhập quê quán" required>
        </div>
        <!-- Trình độ học vấn -->
        <div class="mb-3">
            <label for="level" class="form-label">Trình độ học vấn</label>
            <select class="form-select" id="level" name="level" required>
                <option value="0">Tiến sĩ</option>
                <option value="1">Thạc sĩ</option>
                <option value="2">Kỹ sư</option>
                <option value="3">Khác</option>
            </select>
        </div>
        <!-- Nhập nhóm -->
        <div class="mb-3">
            <label for="group_id" class="form-label">Nhóm</label>
            <input type="number" class="form-control" id="group_id" name="group_id" required min="1" placeholder="Nhập nhóm">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>

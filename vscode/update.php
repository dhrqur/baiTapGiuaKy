<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

$id = $_GET['id'];

    $sql = "SELECT * FROM table_Students WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $hometown = $_POST['hometown'];
        $level = $_POST['level'];
        $group_id = $_POST['group_id'];

        $update_sql = "UPDATE table_Students SET fullname = '$fullname', dob = '$dob', gender = $gender, hometown = '$hometown', level = $level, `group_id` = $group_id WHERE id = $id";

        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Cập nhật thành công!'); 
            window.location.href = 'index.php';</script>";
        } else {
            echo "Lỗi cập nhật: " . mysqli_error($conn);
        }
    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- Link đến js để xử lí thông tin khi nhập sai định dạng -->
    <title>SỬA SINH VIÊN</title>
</head>
<body>
<div class="container mb-5 mt-5">
    <h1>SỬA SINH VIÊN</h1>
    <form onsubmit="return validateForm()" method="POST">
        <!-- Truyền ID của sinh viên (ẩn) -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="mb-3">
            <label for="fullname" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên"
                   value="<?php echo ($row['fullname']); ?>" required>
                   <span id="fullnameError" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="dob" name="dob" required
                   value="<?php echo $row['dob']; ?>">
        </div>

        <div class="mb-3">
            <label>Giới tính</label><br>
            <input type="radio" id="male" name="gender" value="1" <?php if ($row['gender'] == 1) echo 'checked'; ?> required>
            <label for="male">Nam</label><br>
            <input type="radio" id="female" name="gender" value="0" <?php if ($row['gender'] == 0) echo 'checked'; ?> required>
            <label for="female">Nữ</label>
        </div>

        <div class="mb-3">
            <label for="hometown" class="form-label">Quê quán</label>
            <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Nhập quê quán" required
                   value="<?php echo ($row['hometown']); ?>">
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Trình độ học vấn</label>
            <select class="form-select" id="level" name="level" required>
                <option value="0" <?php if ($row['level'] == 0) echo 'selected'; ?>>Tiến sĩ</option>
                <option value="1" <?php if ($row['level'] == 1) echo 'selected'; ?>>Thạc sĩ</option>
                <option value="2" <?php if ($row['level'] == 2) echo 'selected'; ?>>Kỹ sư</option>
                <option value="3" <?php if ($row['level'] == 3) echo 'selected'; ?>>Khác</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">Nhóm</label>
            <input type="number" class="form-control" id="group_id" name="group_id" required min="1"
                   value="<?php echo $row['group_id']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>

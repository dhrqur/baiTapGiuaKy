<?php
require_once 'connect.php'; // Kết nối cơ sở dữ liệu

$sql = "SELECT * FROM table_Students";  // Lấy tất cả sinh viên
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    <title>QUẢN LÍ SINH VIÊN</title>
</head>
<body>
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3 mt-5"> <!--justify-content-between: căn chỉnh cho cùng 1 dòng; align-items-center: căn giữa theo chiều dọc-->
        <div class="d-flex align-items-center">
            <img src="https://th.bing.com/th/id/R.e86a2f7c0d27cb5c409a7b3f3a315fe8?rik=1SybyVGiBwPFxw&riu=http%3a%2f%2futt.edu.vn%2fuploads%2fimages%2fnews%2flogo-utt-border2.png&ehk=Iq8gAijp%2bWQ7W1Udi5hNKjfTWEeJS4ORvhCjMVdfq8o%3d&risl=&pid=ImgRaw&r=0" alt="Logo" style="max-height: 50px; margin-right: 15px;">
            <h1 class="mb-0">DANH SÁCH SINH VIÊN</h1>
        </div>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-person-plus"></i> Thêm sinh viên
        </button>
    </div>

    <!-- Nút và thanh tìm kiếm -->
    <div class="d-flex mb-3">
        <form action="search.php" method="GET" class="d-flex w-100"> <!--Cho vào 1 container flex, width = 100-->
            <input type="text" name="search" placeholder="Nhập thông tin để tìm kiếm..." class="form-control me-2" required style="flex: 1;">
            <button type="submit" class="btn btn-secondary">
                <i class="bi bi-search"></i> Tìm kiếm
            </button>
        </form>
    </div>

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
                while($row = mysqli_fetch_array($result)) {
                    // Xử lí thông tin về định dạng ngày sinh, giói tính, trình độ học vấn
                    $dob = date("d/m/Y", strtotime($row['dob']));
                    $gender = ($row['gender'] == 1) ? 'Nam' : 'Nữ';
                    $level = ($row['level'] == 0) ? 'Tiến sĩ' : 
                             (($row['level'] == 1) ? 'Thạc sĩ' : 
                             (($row['level'] == 2) ? 'Kỹ sư' : 'Khác'));
                    $group = $row['group_id'];
                    
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$dob}</td>
                            <td>{$gender}</td>
                            <td>{$row['hometown']}</td>
                            <td>{$level}</td>
                            <td>{$group}</td>
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
                echo "<tr><td colspan='8'>Không có sinh viên nào</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal Form Thêm Sinh Viên -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="create.php" method="POST" onsubmit="return validateForm()">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">THÊM SINH VIÊN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nhập họ tên -->
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                        <span id="fullnameError" class="text-danger"></span>
                    </div>
                    <!-- Nhập dob-->
                    <div class="mb-3">
                        <label for="dob" class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <!-- Nhập giới tính -->
                    <div class="mb-3">
                        <label>Giới tính</label><br>
                        <input type="radio" id="male" name="gender" value="1" required>
                        <label for="male">Nam</label>
                        <input type="radio" id="female" name="gender" value="0" required>
                        <label for="female">Nữ</label>
                    </div>
                    <!-- Nhập quê quán -->
                    <div class="mb-3">
                        <label for="hometown" class="form-label">Quê quán</label>
                        <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Nhập quê quán" required>
                    </div>
                    <!-- Trình độ học vấn-->
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="script.js"></script> <!-- Link đến js để xử lí thông tin khi nhập sai định dạng -->
</body>
</html>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>

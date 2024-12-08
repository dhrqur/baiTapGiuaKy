function validateForm() {
    var fullname = document.getElementById('fullname').value.trim(); // Loại bỏ khoảng trắng thừa
    var error = false;

    var namePattern = /^[\p{L}\s]+$/u; 
    // sử dụng biểu thức chính quy Unicode (\p{L}) để nhận diện bất kỳ ký tự chữ nào, bao gồm các ký tự có dấu và dấu cách (\s)
    var nameError = document.getElementById('fullnameError');
    
    if (!namePattern.test(fullname)) {
        nameError.textContent = 'Họ tên không được chứa số hoặc ký tự đặc biệt.';
        error = true;
    } else {
        nameError.textContent = ''; // Xóa thông báo lỗi nếu tên hợp lệ
    }

    // Trả về false nếu có lỗi
    return !error;
}

<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'qlsv_nguyenngocbich';

    $conn = mysqli_connect($server, $user, $pass, $database);
    if (!$conn) {
        die("Kết nối thất bại. ");
    }
    //else{
    //    echo "Kết nối thành công <br>";
    //}

    // $db = mysqli_select_db($conn, $database);
    // if (!$db) {
    //     echo "Không có database";
    // }else{
    //     echo "Đã chọn CSDL" . $database . "<br>";
    // }

    // $sql = 'SELECT * FROM danhsachlop';
    // $q = mysqli_query($conn, $sql);
    // $result = mysqli_fetch_array($q);
    // // var_dump('<pre>'); 
    // var_dump($result);
    // // var_dump('</pre>');

?>
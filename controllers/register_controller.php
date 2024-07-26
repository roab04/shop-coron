<?php
require_once('../models/pdo.php');
require_once('../models/login_model.php');

// Hàm này được gọi khi người dùng gửi form đăng ký
function dang_ky() {
    // Kiểm tra nếu người dùng đã nhấn nút đăng ký
    if (isset($_POST['btn_register'])) {
        // Kiểm tra xem tất cả các trường đã được gửi chưa
        if (!isset($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
            // echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
           echo "error";
            return;
        }

        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Kiểm tra mật khẩu và xác nhận mật khẩu
        if ($password !== $confirm_password) {
            // echo "<script>alert('Mật khẩu và xác nhận mật khẩu không khớp. Vui lòng thử lại!');</script>";
            echo "mk không trùng";
            return;
        }

        // Kiểm tra độ dài tối thiểu của mật khẩu và username
        if (strlen($password) < 4 || strlen($username) < 4) {
            // echo "<script>alert('Tên đăng nhập phải có ít nhất 4 ký tự và mật khẩu phải có ít nhất 4 ký tự.');</script>";
            echo "sai kích thước";
            return;
        }

        // Kiểm tra xem tên đăng nhập đã tồn tại chưa
        $user_exists = kiem_tra_user_ton_tai($username);
        if ($user_exists) {
            // echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!');</script>";
            echo "user tồn tại ";
            return;
        }

        // Mã hóa mật khẩu trước khi lưu vào database
        $hashed_password = md5($password);

        // Thêm người dùng mới vào database
        $result = tao_nguoi_dung_moi($fullname, $username, $hashed_password);
        if ($result) {
            // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            header("Location: ../index.php?page=login");
            exit();
        } else {
            echo "error create user";
            // echo "<script>alert('Đã có lỗi xảy ra. Vui lòng thử lại sau!');</script>";
        }
    }
}

// Xử lý request từ người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn_register'])) {
        dang_ky();
    }
}
?>

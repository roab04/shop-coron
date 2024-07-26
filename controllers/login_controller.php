<?php
    require_once "../models/pdo.php";
    require_once "../models/login_model.php";

// Hàm này được gọi khi người dùng gửi form đăng nhập
function dang_nhap() {
    // Kiểm tra nếu người dùng đã nhấn nút đăng nhập
    if (isset($_POST['btn_login'])) {
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra thông tin đăng nhập
        $user = kiem_tra_dang_nhap($username, $password);

        if ($user) {
            // Nếu đăng nhập thành công, lưu thông tin người dùng vào session
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../index.php?page=home");
        } else {
            header("Location: ../index.php?page=login");
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại!');</script>";
        }
    }
}

// Xử lý các request từ người dùng  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn_login'])) {
        dang_nhap();
    }
}
?>

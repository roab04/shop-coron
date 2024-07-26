<?php
    // Hàm này được gọi khi người dùng đăng xuất
    // Hủy session
    session_unset();
    session_destroy();
    // Chuyển hướng về trang đăng nhập sau khi đăng xuất
    header("Location: index.php?page=home");
    // echo "hello";
    // exit();
?>
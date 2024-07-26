<h2>Đăng ký tài khoản</h2>
<form action="controllers/register_controller.php" method="POST">
    <label for="fullname">Họ và tên:</label><br>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="username">Tên đăng nhập:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Mật khẩu:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirm_password">Xác nhận mật khẩu:</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <button type="submit" name="btn_register">Đăng ký</button>
</form>
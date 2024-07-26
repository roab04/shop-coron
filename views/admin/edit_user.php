<?php
require "./config/config.php";
include './model/conn.php';

// Kiểm tra nếu user_id được truyền từ URL và có giá trị
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    // Truy vấn để lấy thông tin của người dùng từ cơ sở dữ liệu
    $query = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Kiểm tra xem có người dùng nào tồn tại không
    if ($stmt->rowCount() == 1) {
        // Lấy thông tin người dùng từ kết quả truy vấn
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Người dùng không tồn tại.";
        exit;
    }
} else {
    echo "Thiếu thông tin user_id.";
    exit;
}

// Xử lý dữ liệu được gửi từ biểu mẫu nếu có
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem các trường dữ liệu đã được gửi chưa
    if (isset($_POST['user_id']) && isset($_POST['fullname']) && isset($_POST['role']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['address'])) {
        // Lấy dữ liệu từ biểu mẫu
        $user_id = $_POST['user_id'];
        $fullname = htmlspecialchars($_POST['fullname']);
        $role = $_POST['role'];
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $address = htmlspecialchars($_POST['address']);

        // Truy vấn để cập nhật thông tin người dùng
        $query = "UPDATE user
        SET fullname = :fullname,
            email = :email,
            password = :password,
            phone = :phone,
            address = :address,
            role = :role
        WHERE user_id = :user_id";
        $stmt = $conn->prepare($query); 
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            echo "Thông tin người dùng đã được cập nhật thành công.";
        } else {
            echo "Đã xảy ra lỗi khi cập nhật thông tin người dùng.";
        }
    } else {
        echo "Thiếu thông tin cần thiết.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa thông tin người dùng</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- <div class="form-group">
                <label for="user_id">Mã khách hàng:</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>">
            </div> -->
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
            </div>
            <!-- <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
            </div> -->
            <div class="form-group">
                <label for="role">Vai trò:</label>
                <select class="form-control" id="role" name="role">
                    <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Người dùng</option>
                    <option value="2" <?php if ($user['role'] == 2) echo 'selected'; ?>>Quản trị viên</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="index.php?page=accounts" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>

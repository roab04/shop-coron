<?php
// Kết nối đến cơ sở dữ liệu
require "./config/config.php";
include './model/conn.php';


function deleteUser($user_id) {
    global $conn;

    try {
        // Chuẩn bị câu truy vấn xóa người dùng
        $query = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = $conn->prepare($query);

        // Gán giá trị cho tham số
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Thực thi truy vấn
        $stmt->execute();

        // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
        if ($stmt->rowCount() > 0) {
            return true; // Trả về true nếu xóa thành công
        } else {
            return false; // Trả về false nếu không có bản ghi nào bị xóa
        }
    } catch (PDOException $e) {
        // Xử lý ngoại lệ nếu có lỗi xảy ra
        echo "Lỗi khi xóa người dùng: " . $e->getMessage();
        return false;
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra nút xóa được nhấn và user_id được gửi từ biểu mẫu
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        
        // Gọi hàm deleteUser và kiểm tra kết quả
        if (deleteUser($user_id)) {
            echo "Người dùng đã được xóa thành công!";
        } else {
            echo "Đã xảy ra lỗi khi xóa người dùng!";
        }
    }
}
?>


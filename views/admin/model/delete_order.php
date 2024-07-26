<?php
require_once "../config/config.php";
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];
        
        try {
            // Xóa sản phẩm từ cơ sở dữ liệu
            $query = "DELETE FROM orders WHERE order_id = :productId";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
            
            // Trả về phản hồi thành công
            echo "Xóa sản phẩm thành công!";
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Lỗi xóa sản phẩm: " . $e->getMessage();
        }
    }
}
?>
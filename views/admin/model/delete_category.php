<?php
    require_once "../config/config.php";
    include "conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['categoryId'])) {
            $categoryId = $_POST['categoryId'];
            
            try {
                // Xóa sản phẩm từ cơ sở dữ liệu
                $query = "DELETE FROM category WHERE category_id = :categoryId";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':categoryId', $categoryId);
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
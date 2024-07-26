<?php
    require_once "../config/config.php";
    include "conn.php";
    // Kiểm tra xem yêu cầu là phương thức POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Lấy dữ liệu từ biểu mẫu
        $name = $_POST["name"];
        // Thực hiện truy vấn để thêm sản phẩm vào cơ sở dữ liệu
        try {
            $stmt = $conn->prepare("INSERT INTO category(name) VALUES (:name)");
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            header("Location: ../index.php?page=category");
            exit;
        } catch (PDOException $e) {
            echo "Lỗi thêm sản phẩm: " . $e->getMessage();
        }
    }
?>
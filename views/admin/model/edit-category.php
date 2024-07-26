<?php
require_once "../config/config.php";
include "conn.php";

// Kiểm tra xem yêu cầu là phương thức POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST["name"];
    // Lấy id từ URL parameter
    $category_id = $_GET['category_id'];

    // Thực hiện truy vấn để cập nhật sản phẩm trong cơ sở dữ liệu
// ...

// Thực hiện truy vấn để cập nhật sản phẩm trong cơ sở dữ liệu
try {
    $stmt = $conn->prepare("UPDATE category SET name = :name WHERE category_id = :category_id");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":category_id", $category_id);
    $stmt->execute();

    echo "Cập nhật sản phẩm thành công!";
    header("Location: ../index.php?page=category");
} catch (PDOException $e) {
    echo "Lỗi cập nhật sản phẩm: " . $e->getMessage();
}
}
?>
<?php
require_once "../config/config.php";
include "conn.php";

// Kiểm tra xem yêu cầu là phương thức POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST["name"];
    $price = $_POST["price"];
    $price_sale = $_POST["price_sale"];
    $description = $_POST["description"];
    $category_id = $_POST["category"];

    // Xử lý tập tin hình ảnh
    $imageFileName = $_FILES["image"]["name"]; // Lấy tên tập tin hình ảnh

    // Thực hiện truy vấn để thêm sản phẩm vào cơ sở dữ liệu
    try {
        $stmt = $conn->prepare("INSERT INTO product(name, description, price, thumbnail, price_sale, category_id) VALUES (:name, :description, :price, :thumbnail, :price_sale, :category_id)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":thumbnail", $imageFileName);
        $stmt->bindParam(":price_sale", $price_sale);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        header("Location: ../index.php?page=products");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi thêm sản phẩm: " . $e->getMessage();
    }
}
?>
<?php
require_once "../config/config.php";
include "conn.php";

// Kiểm tra xem yêu cầu là phương thức POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST["name"];
     $description = $_POST["description"];
    $price = $_POST["price"];
    $price_sale = $_POST["price_sale"];
    // $images = $_POST["thumbnail"];
   
    $category_id = $_POST["category"];

    // Lấy id từ URL parameter
    $id = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_NUMBER_INT);

    // Thực hiện truy vấn để cập nhật sản phẩm trong cơ sở dữ liệu
    try {
        $stmt = $conn->prepare("UPDATE product SET name = :name, price = :price, price_sale = :price_sale, thumbnail = :images, description = :description, category_id = :category_id WHERE product_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":price_sale", $price_sale);
        $stmt->bindParam(":images", $images);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();

        echo "Cập nhật sản phẩm thành công!";
    } catch (PDOException $e) {
        echo "Lỗi cập nhật sản phẩm: " . $e->getMessage();
    }
}
?>
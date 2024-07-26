<?php
require_once "../config/config.php";
include "conn.php";

// Kiểm tra xem yêu cầu là phương thức POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $order_status_id = $_POST["order_status_id"];
    $order_id=$_POST["order_id"];



    // Thực hiện truy vấn để thêm sản phẩm vào cơ sở dữ liệu
    try {
        $stmt = $conn->prepare("UPDATE orders SET order_status_id = :order_status_id WHERE order_id = :order_id");
        $stmt->bindParam(":order_status_id", $order_status_id);
        $stmt->bindParam(":order_id", $order_id);

        $stmt->execute();
        header("Location: ../index.php?page=order");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi thêm sản phẩm: " . $e->getMessage();
    }
}
?>


<?php
require_once '../models/pdo.php'; // Đường dẫn tới file chứa các hàm PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Lấy user_id từ session
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        try {
            // Kiểm tra xem sản phẩm đã tồn tại trong cơ sở dữ liệu chưa
            $result = lay_mot_hang("SELECT * FROM cart_item WHERE product_id = ? AND user_id = ?", $product_id, $user_id);

            if ($result) {
                // Nếu sản phẩm đã tồn tại, thực hiện update
                thay_doi_du_lieu("UPDATE cart_item SET quantity = quantity + ? WHERE product_id = ? AND user_id = ?", $quantity, $product_id, $user_id);
            } else {
                // Nếu sản phẩm chưa tồn tại, thực hiện insert
                thay_doi_du_lieu("INSERT INTO cart_item (product_id, quantity, user_id) VALUES (?, ?, ?)", $product_id, $quantity, $user_id);
            }

            header('Location: ../index.php?page=cart');
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        header('Location: ../index.php?page=login');
    }
}
?>

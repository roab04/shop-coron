<?php
require_once "models/pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Lấy thông tin từ form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của user chưa (dựa vào user_id, ở đây giả sử user_id = 1)
    $user_id = 1; // Giả sử user_id = 1, thực tế sẽ phải lấy từ session hoặc database
    $existing_cart_item = lay_mot_hang("SELECT * FROM cart_item WHERE user_id = ? AND product_id = ?", $user_id, $product_id);

    if ($existing_cart_item) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        $new_quantity = $existing_cart_item['quantity'] + $quantity;
        thay_doi_du_lieu("UPDATE cart_item SET quantity = ? WHERE user_id = ? AND product_id = ?", $new_quantity, $user_id, $product_id);
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
        thay_doi_du_lieu("INSERT INTO cart_item (user_id, product_id, quantity) VALUES (?, ?, ?)", $user_id, $product_id, $quantity);
    }
    header('Location: index.php?page=cart'); // Sửa: dấu cách sau 'Location:'
    exit; // Thêm dòng này để đảm bảo không có mã lệnh nào thực thi sau header
}
?>
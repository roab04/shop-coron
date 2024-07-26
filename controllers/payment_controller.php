<?php
    require_once "../models/pdo.php";
    require_once "../models/order_model.php";
    require_once "../models/cart_model.php";
    if(isset($_POST['btn-order'])) {
        $order_id = $_POST['order-id'];
        $payment_method_id = $_POST['payment-method'];
        $contact_id = $_POST['contact-id'];
        update_du_lieu_khi_order($order_id, $payment_method_id, $contact_id);
        $user_id =lay_user_id_tu_order_id($order_id);
        // Xóa hết sản phẩm trong giỏ hàng của người dùng
        clear_cart($user_id);

        //redirect đến trang lịch sử giao hàng
        header("location:../index.php?page=payment-success");
    }
    
?>
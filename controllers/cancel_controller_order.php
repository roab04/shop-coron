<?php
require_once "../models/pdo.php";

// Kiểm tra xem có order_id được truyền vào không
if (isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];

    // Kiểm tra trạng thái của đơn hàng trước khi hủy
    $order_status = get_order_status($order_id);

    if ($order_status === 'chờ xác nhận') {
        // Nếu đơn hàng ở trạng thái chờ xác nhận thì cho phép hủy
        cancel_order($order_id);
        header("location:../index.php?page=view_order");
    } else {
        // Nếu không ở trạng thái chờ xác nhận, không thực hiện hủy và quay lại trang xem đơn hàng
        header("location:../index.php?page=view_order");
    }
} else {
    // Nếu không có order_id được truyền vào, quay lại trang xem đơn hàng
    header("location:../index.php?page=view_order");
}

// Hàm lấy trạng thái của đơn hàng từ cơ sở dữ liệu
function get_order_status($order_id) {
    global $conn;
    $sql = "SELECT `value` FROM order_status 
            INNER JOIN orders ON orders.order_status_id = order_status.order_status_id 
            WHERE orders.order_id = ?";
    $result = lay_mot_hang($sql, $order_id);
    if ($result && isset($result['value'])) {
        return $result['value'];
    }
    return false;
}

// Hàm hủy đơn hàng
function cancel_order($order_id) {
    global $conn;
    $sql = "UPDATE orders SET order_status_id = (SELECT order_status_id FROM order_status WHERE `value` = 'hủy') WHERE order_id = ?";
    thay_doi_du_lieu($sql, $order_id);
}
?>

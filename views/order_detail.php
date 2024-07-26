<?php

try {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user_id'])) {
        echo "Bạn cần đăng nhập trước khi xem đơn hàng.";
        exit;
    }

    // Kiểm tra xem order_id đã được truyền qua URL không
    if (!isset($_GET['id'])) {
        echo "Không có đơn hàng nào được chọn.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $order_id = $_GET['id'];

    // Truy vấn để lấy thông tin chi tiết đơn hàng
    $sql = "SELECT orders.order_id, orders.order_date, orders.payment_status, order_status.value AS order_status, payment_method.method_name, contact.address 
            FROM orders
            INNER JOIN order_status ON orders.order_status_id = order_status.order_status_id
            INNER JOIN payment_method ON orders.payment_method_id = payment_method.payment_method_id
            INNER JOIN contact ON orders.contact_id = contact.contact_id
            WHERE orders.user_id = $user_id AND orders.order_id = $order_id";

    $order = lay_mot_hang($sql);

    if ($order) {
        // In ra thông tin chi tiết đơn hàng
        echo "<h2>Chi tiết đơn hàng #{$order['order_id']}</h2>";
        echo "<p><strong>Ngày đặt hàng:</strong> {$order['order_date']}</p>";
        echo "<p><strong>Trạng thái thanh toán:</strong> " . ($order['payment_status'] == 1 ? "Đã thanh toán" : "Chưa thanh toán") . "</p>";
        echo "<p><strong>Trạng thái đơn hàng:</strong> {$order['order_status']}</p>";
        echo "<p><strong>Phương thức thanh toán:</strong> {$order['method_name']}</p>";
        echo "<p><strong>Địa chỉ:</strong> {$order['address']}</p>";

        // Hiển thị danh sách sản phẩm trong đơn hàng này
        $sqlProducts = "SELECT product.name, product.thumbnail, order_item.quantity, order_item.price, (order_item.quantity * order_item.price) AS total_price
                FROM order_item
                INNER JOIN product ON order_item.product_id = product.product_id
                WHERE order_item.order_id = $order_id";
        $products = lay_nhieu_hang($sqlProducts);

        if (count($products) > 0) {
            echo "<h3>Danh sách sản phẩm:</h3>";
            echo "<table style='border-collapse: collapse; width: 100%;'>";
            echo "<tr style='background-color: #00BBA6; color: white;'>";
            echo "<th style='padding: 10px;'>STT</th>";
            echo "<th style='padding: 10px;'>Ảnh</th>";
            echo "<th style='padding: 10px;'>Tên sản phẩm</th>";

            echo "<th style='padding: 10px;'>Số lượng</th>";
            echo "<th style='padding: 10px;'>Đơn giá</th>";
            echo "<th style='padding: 10px;'>Thành tiền</th>";
            echo "</tr>";
            $stt = 1;
            $totalAmount = 0; // Tổng số tiền của đơn hàng
            foreach ($products as $product) {
            $productName = $product["name"];
            $image = 'assets/'.$product['thumbnail']; // Lấy giá trị ảnh sản phẩm
            $quantity = $product["quantity"];
            $price = $product["price"];
            $totalPrice = $product["total_price"];

            $totalAmount += $totalPrice; // Cộng vào tổng số tiền

            echo "<tr style='border-bottom: 1px solid #ccc;'>";
            echo "<td style='padding: 10px;'>$stt</td>";
            echo "<td style='padding: 10px;'><img src='$image' alt='$productName' style='width: 50px; height: 50px;'></td>"; // Hiển thị ảnh sản phẩm
            echo "<td style='padding: 10px;'>$productName</td>";
            echo "<td style='padding: 10px;'>$quantity</td>";
            echo "<td style='padding: 10px;'>$price đ</td>";
            echo "<td style='padding: 10px;'>$totalPrice đ</td>";
            echo "</tr>";
            $stt++;
        }
            echo "</table>";

            // Hiển thị tổng số tiền của đơn hàng
            echo "<p style='text-align: center;'><strong>Tổng số tiền của đơn hàng:</strong> $totalAmount đ</p>";
            echo '<h4><a href="index.php?page=view_order"><-- Xem đơn hàng</a></h4>';

        } else {
            echo "Không có sản phẩm nào trong đơn hàng này.";
        }
    } else {
        echo "Không tìm thấy đơn hàng.";
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>

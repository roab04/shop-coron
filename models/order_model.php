<?php
    /**
     * Đức: Hàm này dùng để lấy tất cả phương thức thanh toán trong database
     */
    function lay_phuong_thuc_thanh_toan() {
        $sql = "select * from payment_method";
        return lay_nhieu_hang($sql);
    }

    /**
     * Đức: Hàm này dùng để lấy địa chỉ giao hàng trong database
     */
    function lay_dia_chi_giao_hang($contact_id) {
        $sql = "select address from contact
            where contact_id = '$contact_id'";
        return lay_mot_hang($sql);
    }

    /**
     * Đức: Hàm này dùng để tạo order trong database
     */
    function tao_order($user_id) {
        $sql = "insert into orders (user_id) 
        values (?)";
        thay_doi_du_lieu($sql, $user_id);
        return kiem_tra_su_ton_tai_order($user_id);
    }

    /**
     * Đức: Hàm này dùng để tạo order_item trong database
     */

    function insert_mot_order_item($product_id, $quantity, $order_id, $price) {
        $sql = "insert into order_item (product_id, quantity, order_id, price) 
            values (?, ?, ?, ?)";
        return thay_doi_du_lieu($sql, $product_id, $quantity, $order_id, $price);
    }

    function tao_order_item($user_id, $order_id) {
        $sql = "select cart_item.product_id, quantity, price_sale 
        from cart_item
        inner join product 
        on cart_item.product_id = product.product_id
        where user_id = $user_id";
        $rows = lay_nhieu_hang($sql);
        foreach($rows as $item) {
            insert_mot_order_item($item['product_id'], $item['quantity'], $order_id, $item['price_sale']);
        }
    }

    /**
     * Đức: Hàm này dùng để kiểm tra order đã được tạo
     * mà chưa được đặt hàng trước khi tạo một order mới.
     * Chúng dựa trên ngày order (ở đây là cột order_date) là null 
     * trong database
     */
    function kiem_tra_su_ton_tai_order($user_id) {
        $sql = "select order_id from orders
            where user_id = $user_id and order_date is null;
        ";
        return lay_mot_hang($sql);
        // return lay_nhieu_hang($sql);
    }
    /**
     * Đức: Hàm này dùng để xóa những order chưa được đặt hàng trước đó
     *  tương ứng với order_id đã lấy ở hàm "kiem_tra_su_ton_tai_order($user_id)" trong database
     */
    function delete_order($order_id) {
        $sql = "DELETE FROM orders where order_id = $order_id";
        thay_doi_du_lieu($sql);
    }
    /**
      * Đức: Hàm này dùng để xóa những order_item chưa được đặt hàng trước đó
     *  tương ứng với order_id đã lấy ở hàm "kiem_tra_su_ton_tai_order($user_id)" 
     * và được gọi từ hàm xoa_order_item_null($order_item_id) trong database
     */
    function delete_order_item($order_item_id) {
        $sql = "DELETE FROM order_item where order_item_id = $order_item_id";
        thay_doi_du_lieu($sql);
    }
    /**
     * Đức: Hàm này dùng để lấy những order_item chưa được đặt hàng trước đó
     *  tương ứng với order_id đã lấy ở hàm "kiem_tra_su_ton_tai_order($user_id)"
     */
    function xoa_order_item_null($order_id) {
        $sql = "select order_item_id from order_item where order_id = $order_id";
        $rows = lay_nhieu_hang($sql);
        foreach($rows as $item) {
            delete_order_item($item['order_item_id']);
        }
    }

    /**
     * Đức: Hàm dùng để lấy tất cả sản phẩm trong bảng order_item
     */

    function lay_tat_ca_san_pham_trong_order_item($order_id) {
        $sql = "select thumbnail, name, order_item.price, quantity
        from order_item 
        inner join product
        on order_item.product_id = product.product_id
        where order_id = $order_id";
        return lay_nhieu_hang($sql);
    }
    /**
     * Đức: Hàm dùng để update bảng order 
     * Chuyển từ:
     *     - 0 (Không có trạng thái gì) --> 1 (chờ xác nhận)
     *     - Thêm order_date --> Ngày hiện tại
     *     - Lấy payment_method khi người dùng chọn phương thức thanh toán
     */
    function update_du_lieu_khi_order($order_id, $payment_method_id, $contact_id) {
        $sql = "UPDATE orders
        SET order_status_id = 1, order_date = now(), payment_method_id = ?, contact_id = ?
        WHERE order_id = $order_id";
        thay_doi_du_lieu($sql, $payment_method_id, $contact_id);
        // 1: Thanh toán bằng tiền mặt
        // 2: Thanh toán bằng Momo
        if($payment_method_id == 2) {
            update_trang_thai_thanh_toan($order_id);
        }
    }

    /**
     * Đức: Hàm dùng để update bảng order 
     * Chuyển từ:
     *          0 (Chưa thanh toán)
     *    sang 1 nếu người dùng chọn thanh toán bằng MOMO --> Đã thanh toán
     */
    function update_trang_thai_thanh_toan($order_id) {
        $sql = "UPDATE orders
            SET payment_status = 1
            WHERE order_id = $order_id
        ";
        thay_doi_du_lieu($sql);
    }

    function lay_user_id_tu_order_id($order_id) {
        global $conn;
        try {
            $sql = "SELECT user_id FROM orders WHERE order_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
?>
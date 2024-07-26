<?php
    require_once "pdo.php";
    
    function lay_so_luong_khach_hang() {
        $sql = "select count(*) as 'khach_hang' from user where role = 1";
        return lay_mot_hang($sql);
    }
    
    function lay_so_luong_admin() {
        $sql = "select count(*) as 'admin' from user where role = 2";
        return lay_mot_hang($sql);
    }
    
    function lay_so_luong_danh_muc() {
        $sql = "select count(*) as 'danh_muc' from category";
        return lay_mot_hang($sql);
    }
    
    function lay_so_luong_san_pham() {
        $sql = "select count(*) as 'san_pham' from product";
        return lay_mot_hang($sql);
    }
    
    function lay_all_nam() {
        $sql = "select distinct(year(order_date)) as 'nam' from orders order by nam";
        return lay_nhieu_hang($sql);
    }
    
    function lay_doanh_thu_theo_thang_nam() {
        $sql = "select sum(price*quantity) as 'doanh_thu', month(order_date) as 'thang', year(order_date) as 'nam'
            from orders inner join order_item 
            on orders.order_id = order_item.order_id
            where order_date is not null
            group by month(order_date), year(order_date)
            order by year(order_date), month(order_date);";
        return lay_nhieu_hang($sql);
    }

    /**
     * Đức: Lấy số lượng order theo trạng thái của đơn hàng
     * Bỏ qua order_status = 0 vì đây không thuộc bảng order_status
     *  (0: Trạng thái người dùng đang khởi tạo đơn hàng)
     * 
     */
    function lay_so_luong_order_theo_trang_thai() {
        $sql = 'select count(order_id) as "so_luong", `value`
            from orders
            inner join order_status
            on order_status.order_status_id = orders.order_status_id
            group by order_status.order_status_id';
        return lay_nhieu_hang($sql);
    }
?>
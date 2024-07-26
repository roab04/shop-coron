<?php
    /**
     * Đức: Lấy thông tin liên lạ của người dùng
     */
    function lay_thong_tin_lien_lac_mac_dinh($user_id) {
        $sql = "select * from contact 
        where user_id = $user_id and is_default = 0";
        return lay_mot_hang($sql);
    }

    /**
     * Đức: Lấy tất cả thông tin của một user từ `user table`
     */
    function lay_tat_ca_thong_tin_cua_mot_user($user_id) {
        $sql = "select * from user where user_id =$user_id";
        return lay_mot_hang($sql);
    }

    /**
     * Đức: Lấy tất cả thông tin từ bảng contact của 1 user
     */
    function lay_thong_tin_lien_lac_cua_user($user_id) {
        $sql = "select * from contact where user_id = $user_id";
        return lay_nhieu_hang($sql);
    }
    /**
     * Đức: Thêm avatar cho bảng user
     */
    function them_avatar($avatar, $user_id) {
        $sql = "update user set avatar= ? where user_id=?";
        thay_doi_du_lieu($sql, $avatar, $user_id);
    }
    /**
     * Đức: lay avatar
     */
    function lay_hinh_anh($user_id) {
        $sql = "select avatar from user where user_id='$user_id'";
        return lay_mot_hang($sql);
    }

    /**
     * Đức: Kiểm tra thông tin mặc định của user
     */
    function kiem_tra_thong_tin_lien_lac_mac_dinh($contact_id, $user_id) {
        $real_contact_id = lay_thong_tin_lien_lac_mac_dinh($user_id)['contact_id'];
        if($contact_id == $real_contact_id) return true;
        return false;
    }

    /**
     * Đức: cập nhật tên user
     */
    function cap_nhat_ten_user($user_id, $fullname) {
        $sql = "update user set fullname= ? where user_id=?";
        thay_doi_du_lieu($sql, $fullname, $user_id);
    }
    function cap_nhat_thong_tin_lien_lac_mac_dinh_user($address, $phone, $email, $contact_id) {
        $sql = "update contact set address = ?, phone = ?, email = ? where contact_id = ?";
        thay_doi_du_lieu($sql, $address, $phone, $email, $contact_id);
    }
    /**
     * Đức: Them địa chỉ người dùng
     */
    function them_dia_chi_nguoi_dung($user_id, $email, $address, $phone) {
        $sql = "insert into contact (user_id, email, address, phone) values (?, ?, ?, ?)";
        thay_doi_du_lieu($sql, $user_id, $email, $address, $phone);
    }
?>
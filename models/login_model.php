<?php
    // include_once('pdo.php');

/**
 * Hàm kiểm tra đăng nhập của người dùng
 */
function kiem_tra_dang_nhap($username, $password) {
    $hashed_password = md5($password); // Mã hóa mật khẩu để so khớp với mật khẩu đã mã hóa trong database
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    return lay_mot_hang($sql, $username, $hashed_password);
}


/**a
 * Bảo: Hàm này dùng để lấy thông tin người dùng dựa trên ID
 */
function lay_thong_tin_nguoi_dung($user_id) {
    $sql = "SELECT * FROM user WHERE user_id = ?";
    return lay_mot_hang($sql, $user_id);
}

/**
 * Bảo: Hàm này dùng để cập nhật thông tin người dùng
 */
function cap_nhat_thong_tin_nguoi_dung($user_id, $fullname, $phone, $email, $address) {
    $sql = "UPDATE user SET fullname = ?, phone = ?, email = ?, address = ? WHERE user_id = ?";
    return thay_doi_du_lieu($sql, $fullname, $phone, $email, $address, $user_id);
}

/**
 * Bảo: Hàm này dùng để đăng ký người dùng mới
 */
function dang_ky_nguoi_dung($username, $password, $fullname, $phone, $email, $address) {
    $hashed_password = md5($password); // Hash mật khẩu trước khi lưu vào database
    $register_date = date('Y-m-d'); // Ngày đăng ký
    $role = 1; // Phân quyền mặc định
    $sql = "INSERT INTO user (username, password, fullname, phone, email, address, register_date, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    return thay_doi_du_lieu($sql, $username, $hashed_password, $fullname, $phone, $email, $address, $register_date, $role);
}


/**
 * Bảo: Hàm này dùng để lấy danh sách tất cả người dùng
 */
function lay_danh_sach_nguoi_dung() {
    $sql = "SELECT * FROM user";
    return lay_nhieu_hang($sql);
}

/**
 * Bảo: Hàm này dùng để xóa người dùng dựa trên ID
 */
function xoa_nguoi_dung($user_id) {
    $sql = "DELETE FROM user WHERE user_id = ?";
    return thay_doi_du_lieu($sql, $user_id);
}


// Kiểm tra xem tên đăng nhập đã tồn tại trong database chưa
function kiem_tra_user_ton_tai($username) {
    try {
        $sql = "SELECT * FROM user WHERE username = ?";
        $row = lay_mot_hang($sql, $username);

        if ($row) {
            return true; // Tên đăng nhập đã tồn tại
        } else {
            return false; // Tên đăng nhập chưa tồn tại
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function tao_nguoi_dung_moi($fullname, $username, $hashed_password) {
    global $conn;

    try {
        $sql = "INSERT INTO user (fullname, username, password) VALUES (?, ?, ?)";
        thay_doi_du_lieu($sql, $fullname, $username, $hashed_password);
        return true; // Trả về true nếu thành công
    } catch (PDOException $e) {
        throw $e;
    }
}
?>



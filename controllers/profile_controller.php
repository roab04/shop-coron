<?php
    session_start();
    require_once "../models/pdo.php";
    require_once "../models/user_model.php";
    print_r($_SERVER['HTTP_REFERER']);
    $url_history = $_SERVER['HTTP_REFERER'];
    if (isset($_POST['btn-upload'])){
        // $mota = $_POST['mota'];
        $f1 = $_FILES['fileToUpload'];
        // print_r($f1);
        $filesize = $f1['size'];
        $filename = $f1['name'];
        $ext = $f1['type'];
        $filepath = $f1['tmp_name'];
        $file_path_database = "assets/img/users/". $filename;
        $destination = "../".$file_path_database;
        $array_ext = ['image/png','image/jpeg','video/mp4'];
        $loi='';
        try {        
            move_uploaded_file($filepath, $destination);
            if (session_status() === PHP_SESSION_NONE) session_start();        
            $user_id = $_SESSION['user_id'];
            them_avatar($file_path_database, $user_id);
            header("location:../index.php?page=profile");
        } catch (Exception $e) {
            echo "Lỗi: " . $e;
        }
    }
    if (isset($_POST['btn-change-info'])){
        $contact_id = $_POST['contact_id'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $user_id = $_SESSION['user_id'];
        if($contact_id) {
            // Kiem tra thong tin lien lac mac dinh de tranh cap nhat sai bang
            $is_right = kiem_tra_thong_tin_lien_lac_mac_dinh($contact_id, $user_id);
            if($is_right) {
                cap_nhat_ten_user($user_id, $fullname);
                cap_nhat_thong_tin_lien_lac_mac_dinh_user($address, $phone, $email, $contact_id);
            }
        } else {
            cap_nhat_ten_user($user_id, $fullname);
            them_dia_chi_nguoi_dung($user_id, $email, $address, $phone);
        }
        header("location:$url_history");
    }
?>
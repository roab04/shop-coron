<?php
    /**
     *  Hàm này là hàm được built-in sẵn của php nha
     *  Mở docs của php ra đọc --> session_start()
     *  */
    session_start();
    
    /**
     * import tất cả các file của models
     *  */
    require_once "models/pdo.php";
    require_once "models/cart_model.php";
    require_once "models/order_model.php";

    /**
     * Lay cac tham so can thiet
     *  */
    // 
    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = "";
    };
    if(isset($_GET["page-nr"])) {
        $id = $_GET["page-nr"];
    } else {
        $id = 1;
    };
    if(isset($_GET["id"])) {
        $idsp = $_GET["id"];
    } else {
        $idsp = 1;
    };
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        if( $_SESSION['role'] == 2) {
           header('Location: views/admin/'); 
        }
    }

    // Redirect
    $url = $_SERVER['REQUEST_URI'];
    if($url == "/shop-coron/index.php" || $url == "/shop-coron/") {
        header("Location: index.php?page=home");
    };
    if ($url == "/shop-coron/index.php?page=$page") {
        switch($page) {
            case "order":
                if(isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $ket_qua_kiem_tra_order = kiem_tra_su_ton_tai_order($user_id);
                    if($ket_qua_kiem_tra_order){
                        $order_id = $ket_qua_kiem_tra_order['order_id'];
                        $all_products = lay_tat_ca_san_pham_trong_order_item($order_id);
                    } else {
                        header("Location: index.php?page=home");
                    }
                } else {
                    header("Location: index.php?page=home");
                }
                break;
            case "home":
                $start = 0;
                $rows_per_page = 8;
                $records = lay_nhieu_hang("SELECT * FROM product");
                $nr_of_rows = count($records);
                $pages = ceil($nr_of_rows / $rows_per_page);
                if(isset($_GET['page-nr'])) {
                    $page = ((int)$_GET['page-nr'] - 1);
                    $start = $page * $rows_per_page;
                }
                $products = lay_nhieu_hang("SELECT * FROM product LIMIT $start, $rows_per_page");
                $featuredProducts = lay_nhieu_hang("SELECT * FROM `product` ORDER BY views DESC LIMIT $start, $rows_per_page");  
                $categorys = lay_nhieu_hang("SELECT * FROM category");
                break;
            case "cart":
                if(!isset($_SESSION['user_id'])) {
                    header("Location: index.php?page=home");
                }
                break;
            case "thoat":
                require_once "controllers/exit_controller.php";
                break;
            case "view_order":
                if(!isset($_SESSION['user_id'])) {
                    header("Location: index.php?page=home");
                }
                break;
        }
    } else if($url == "/shop-coron/index.php?page=$page&id=$idsp") {
        switch($page) {
            case 'order_detail':
                if(!isset($_SESSION['user_id'])) {
                    header("Location: index.php?page=home");
                }
                break;
        }
    }

?>
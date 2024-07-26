<?php
    /**
     *  Hàm này là hàm được built-in sẵn của php nha
     *  Mở docs của php ra đọc --> session_start()
     *  */
    session_start();
    
    /**
     * import tất cả các file của models
     *  */
    // require_once "models/pdo.php";
    // require_once "models/cart_model.php";
    // require_once "models/order_model.php";
    // require_once "";

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = "";
    };
    if(isset($_GET["page-pt"])) {
        $page_pt = $_GET["page-pt"];
    } else {
        $page_pt = "";
    };
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    } else  $id = 1;
    $url = $_SERVER['REQUEST_URI'];
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        if( $_SESSION['role'] == 1) {
           header('Location: ../../index.php');
        }

    } else {
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Product Admin - Dashboard HTML Template</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
        <!-- https://fonts.google.com/specimen/Roboto -->
        <link rel="stylesheet" href="../../assets/css/fontawesome.min.css">
        <!-- https://fontawesome.com/ -->
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <!-- https://getbootstrap.com/ -->
        <link rel="stylesheet" href="../../assets/css/templatemo-style.css">
        <!--
            Product Admin CSS Template
            https://templatemo.com/tm-524-product-admin
        -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body id="reportsPage">
        <div class="" id="home">
            <?php require_once "../components/header_admin.php"?>
            <?php
                if($url == "/shop-coron/views/admin/index.php" || $url == "/shop-coron/views/admin/") {
                    header("Location: index.php?page=dashboard");
                }
                if($url == "/shop-coron/views/admin/index.php?page=$page") {
                    switch($page) {
                        case "dashboard":
                            require_once "home.php";
                            break;
                        case "category":
                            require_once "category.php";
                            break;
                        case "accounts":
                            require_once "accounts.php";
                            break;
                        case "order":
                            require_once "order.php";
                            break;
                        case "products":
                            require_once "products.php";
                            break;
                        case "add-category":
                            require_once "add-category.php";
                            break;
                    }
                } else if($url == "/shop-coron/views/admin/index.php?page=$page&id=$id") {
                    switch($page) {
                        case "edit-category":
                            require_once "edit-category.php";
                            break;
                        case "order_detail":
                            require_once "order_detail.php";
                            break;
                        case "order_detail":
                            require_once "order_detail.php";
                            break;
                        case "edit-product":
                            require_once "edit-product.php";
                            break;
                        case "accounts_detail":
                            require_once "accounts_detail.php";
                            break;
                    }
                } else if($url == "/shop-coron/views/admin/index.php?page=$page&page-pt=$page_pt") {
                    switch($page) {
                        case "accounts":
                            require_once "accounts.php";
                            break;
                    }
                }
            ?>
            <?php require_once "../components/footer_admin.php"?>
        </div>
        
    </body>
</html>

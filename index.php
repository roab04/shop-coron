<?php
    require_once "controllers/index.php";
    
?>
<!doctype php>
<php class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Shop-Coron</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets\img\favicon.png">
		<!-- all css here -->
        <link rel="stylesheet" href="assets\css\bootstrap.min.css">
        <link rel="stylesheet" href="assets\css\plugin.css">
        <link rel="stylesheet" href="assets\css\bundle.css">
        <link rel="stylesheet" href="assets\css\style.css">
        <link rel="stylesheet" href="assets\css\responsive.css">
        <link rel="stylesheet" href="assets\css\fontawesome.min.css">
        <script src="assets\js\vendor\modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--pos page start-->
        <div class="pos_page">
            <div class="container">
                <!--pos page inner-->
                <div class="pos_page_inner">
                    <?php
                        require_once "views/components/header.php";
                    ?>
                    <?php
                        /**
                         *  Kiểm tra trang hiện tại là trang nào
                         *  ví dụ với link: localhost:8080/index.php?page=home
                         *  Trang hiện tại là trang home --> $page có giá trị là "home"
                         * 
                         *  */
                        if($url == "/shop-coron/index.php?page=$page") {
                            switch($page) {
                                case "cart":
                                    require_once "views/cart.php";
                                    break;
                                case "order":
                                    require_once "views/order.php";
                                    break;
                                case "home":
                                    require_once "views/home.php";
                                    // modal area start
                                    require_once "views/components/modal.php";
                                    // modal area end
                                    break;
                                case "payment-success":
                                    require_once "views/order-success.php";
                                    break;
                                case "login":
                                    require_once "views/login.php";
                                    break;
                                case "profile":
                                    require_once "views/profile.php";
                                    break;
                                case "view_order":
                                    require_once "views/view_order.php";
                                    break;
                                case "dangky":
                                    require_once "views/register.php";
                                    break;
                                case "shop":
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
                                    require_once "views/shop.php";
                            }
                        }
                        else if($url == "/shop-coron/index.php?page-nr=$id") {
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
                            require_once "views/home.php";
                        } else if($url == "/shop-coron/index.php?page=$page&id=$idsp") {
                            switch($page) {
                                case "single-product":
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
                                    $productsDetail = lay_mot_hang("SELECT * FROM product WHERE product_id = $id");
                                    $productSimilars = lay_nhieu_hang("SELECT * FROM product ORDER BY RAND() LIMIT 4");
                                    require_once "views/single-product.php";
                                    break;
                                case 'cancel_order':
                                    require_once "views/cancel_order.php";
                                    break;
                                case 'order_detail':
                                    require_once "views/order_detail.php";
                                    break;
                            }
                        }
                        else {
                            require_once "views/404.php";
                        }
                    ?>
                    <?php
                        require_once "views/components/footer.php";
                    ?>            
                </div>
            </div>
    </div>
        <!-- all js here -->
        <script src="assets\js\vendor\jquery-1.12.0.min.js"></script>
        <script src="assets\js\popper.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
        <script src="assets\js\ajax-mail.js"></script>
        <script src="assets\js\plugins.js"></script>
        <script src="assets\js\main.js"></script>
    </body>
</php>
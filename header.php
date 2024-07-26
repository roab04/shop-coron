<!--header area -->
<div class="header_area">
    <!--header top-->
    <div class="header_top">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
               
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header_links">
                    <ul>
                        <?php
                        if (isset($_SESSION['username']) && ($_SESSION['username'] != "")) {
                            // Người dùng đã đăng nhập
                            echo '<li><a href="index.php?page=userinfo" title="Username">' . $_SESSION['username'] . '</a></li>';
                            echo '<li><a href="index.php?page=thoat" title="Thoát" name="btn_logout">Thoát</a></li>';
                        } else {
                            // Người dùng chưa đăng nhập
                            echo '<li><a href="index.php?page=dangky" title="Register">Đăng ký</a></li>';
                            echo '<li><a href="index.php?page=login" title="Login">Đăng nhập</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--header top end-->

    <!--header middel-->
    <div class="header_middel">
        <div class="row align-items-center">
            <!--logo start-->
            <div class="col-lg-3 col-md-3">
                <div class="logo">
                    <a href="index.php"><img src="assets\img\logo\logo.jpg.png" alt=""></a>
                </div>
            </div>
            <!--logo end-->
            <div class="col-lg-9 col-md-9">
                <div class="header_right_info">
                    <div class="search_bar">
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="shopping_cart">
                        <a href="index.php?page=cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->
    <div class="header_bottom">
        <div class="row">
            <div class="col-12">
                <div class="main_menu_inner">
                    <div class="main_menu d-none d-lg-block">
                        <nav>
                            <ul>
                                <li class="active"><a href="index.php">Home</a>
                                    
                                </li>
                                <li><a href="shop.php">shop</a>
                                    
                                </li>
                               
                            
                               

                                <li><a href="blog.php">blog</a>
                                    <div class="mega_menu jewelry">
                                        <div class="mega_items jewelry">
                                            <ul>
                                                <li><a href="blog-details.php">blog details</a></li>
                                                <li><a href="blog-fullwidth.php">blog fullwidth</a></li>
                                                <li><a href="blog-sidebar.php">blog sidebar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="contact.php">contact us</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--header end -->
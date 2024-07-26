<!--header end -->
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.php">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--pos home section-->
<div class=" pos_home_section">
    <div class="row pos_home">
        <div class="col-lg-3 col-md-12">
            <!--layere categorie"-->
            <div class="sidebar_widget shop_c">
                <div class="categorie__titile">
                    <h4>Categories</h4>
                </div>
                <div class="layere_categorie">
                    <ul>
                        <?php foreach($categorys as $categorys) : ?>
                        <li class="has-sub"><a href="#"><i class="fa fa-caret-right"></i> <?=$categorys["name"] ?></a>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!--layere categorie end-->

            <!--color area end-->

            <!--price slider start-->
            <!-- <div class="sidebar_widget price">
                    <h2>Price</h2>
                    <div class="ca_search_filters">

                        <input type="text" name="text" id="amount">  
                        <div id="slider-range"></div> 
                    </div>
                </div>                                                        -->
            <!--price slider end-->

            <!--wishlist block start-->
            <!-- <div class="sidebar_widget wishlist mb-30">
                    <div class="block_title">
                        <h3><a href="#">Wishlist</a></h3>
                    </div>
                    <div class="cart_item">
                        <div class="cart_img">
                            <a href="#"><img src="assets\img\cart\cart.jpg" alt=""></a>
                        </div>
                        <div class="cart_info">
                            <a href="#">lorem ipsum dolor</a>
                            <span class="cart_price">$115.00</span>
                            <span class="quantity">Qty: 1</span>
                        </div>
                        <div class="cart_remove">
                            <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                        </div>
                    </div>
                    <div class="cart_item">
                        <div class="cart_img">
                            <a href="#"><img src="assets\img\cart\cart2.jpg" alt=""></a>
                        </div>
                        <div class="cart_info">
                            <a href="#">Quisque ornare dui</a>
                            <span class="cart_price">$105.00</span>
                            <span class="quantity">Qty: 1</span>
                        </div>
                        <div class="cart_remove">
                            <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                        </div>
                    </div>
                    <div class="block_content">
                        <p>2  products</p>
                        <a href="#">» My wishlists</a>
                    </div>
                </div> -->
            <!--wishlist block end-->

            <!--popular tags area-->
            <!-- <div class="sidebar_widget tags  mb-30">
                    <div class="block_title">
                        <h3>popular tags</h3>
                    </div>
                    <div class="block_tags">
                        <a href="#">ipod</a>
                        <a href="#">sam sung</a>
                        <a href="#">apple</a>
                        <a href="#">iphone 5s</a>
                        <a href="#">superdrive</a>
                        <a href="#">shuffle</a>
                        <a href="#">nano</a>
                        <a href="#">iphone 4s</a>
                        <a href="#">canon</a>
                    </div>
                </div> -->
            <!--popular tags end-->

            <!--newsletter block start-->
            <!-- <div class="sidebar_widget newsletter mb-30">
                    <div class="block_title">
                        <h3>newsletter</h3>
                    </div> 
                    <form action="#">
                        <p>Sign up for your newsletter</p>
                        <input placeholder="Your email address" type="text">
                        <button type="submit">Subscribe</button>
                    </form>   
                </div> -->
            <!--newsletter block end-->

            <!--special product start-->
            <!-- <div class="sidebar_widget special">
                    <div class="block_title">
                        <h3>Special Products</h3>
                    </div>
                    <div class="special_product_inner mb-20">
                        <div class="special_p_thumb">
                            <a href="single-product.php"><img src="assets\img\cart\cart3.jpg" alt=""></a>
                        </div>
                        <div class="small_p_desc">
                            <div class="product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h3><a href="single-product.php">Lorem ipsum dolor</a></h3>
                            <div class="special_product_proce">
                                <span class="old_price">$124.58</span>
                                <span class="new_price">$118.35</span>
                            </div>
                        </div>
                    </div>
                    <div class="special_product_inner">
                        <div class="special_p_thumb">
                            <a href="single-product.php"><img src="assets\img\cart\cart18.jpg" alt=""></a>
                        </div>
                        <div class="small_p_desc">
                            <div class="product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h3><a href="single-product.php">Printed Summer</a></h3>
                            <div class="special_product_proce">
                                <span class="old_price">$124.58</span>
                                <span class="new_price">$118.35</span>
                            </div>
                        </div>
                    </div>
                </div> -->
            <!--special product end-->
        </div>
        <div class="col-lg-9 col-md-12">
            <!--banner slider start-->
            <div class="banner_slider mb-35">
                <img src="assets\img\banner\banner_shop.jpg" alt="">
            </div>
            <!--banner slider start-->
            <!--shop toolbar start-->
            <!--shop toolbar end-->
            <div class="new_product_area">
                <div class="block_title">
                    <h3>Sản phẩm khuyến mãi</h3>
                </div>
                <div class="row mb-4">
                    <?php foreach($products as $product) { ?>
                    <div class="col-lg-3">
                        <div class="single_product" style="height: 410px;">
                            <div class="product_thumb">
                                <a href="?page=single-product&id=<?= $product["product_id"] ?>"><img
                                        src="assets/<?=$product['thumbnail']?>" alt="" style="height: 250px;"></a>
                                <div class="img_icone">
                                    <img src="../assets/<?=$product['thumbnail']?>" alt="">
                                </div>
                                <div class="product_action">
                                    <form method="post" action="controllers/addtocart_controller.php">
                                        <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                                            hàng</button>
                                    </form>
                                </div>
                            </div>
                            <div class="product_content">
                                <span class="product_price"><del
                                        style="color: gray;"><?= number_format($product["price"]) ?> đ</del></span>
                                <span class="product_price"><?= number_format($product["price_sale"]) ?> đ</span>
                                <h3 class="product_title"><a
                                        href="?page=single-product&id=<?= $product["product_id"] ?>"><?= $product['name'] ?></a>
                                </h3>
                            </div>
                            <div class="product_info">
                                <ul>
                                    <!-- <li><a href="#" title="Thêm vào yêu thích">Thêm vào yêu thích</a></li> -->
                                    <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">Chi
                                            tiết</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example"
                        style="width: 100%; display: flex; justify-content: center;">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?page-nr=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for($counter = 1; $counter <= $pages; $counter++) : ?>
                            <li class="page-item"><a class="page-link"
                                    href="?page-nr=<?= $counter ?>"><?= $counter ?></a></li>
                            <?php endfor ; ?>
                            <li class="page-item">
                                <a class="page-link" href="?page-nr=<?= $pages ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--pos home section end-->
<!--pos home section-->
<div class=" pos_home_section">
    <div class="row pos_home">
        <div class="col-lg-3 col-md-8 col-12">
            <!--categorie menu start-->
            <div class="sidebar_widget catrgorie mb-35">
                <h3>Danh mục</h3>
                <ul>
                    <?php foreach($categorys as $categorys) : ?>
                    <li class="has-sub"><a href="#"><i class="fa fa-caret-right"></i> <?=$categorys["name"] ?></a>
                        <?php endforeach; ?>
                </ul>
            </div>
            <!--categorie menu end-->
        </div>
        <div class="col-lg-9 col-md-12">
            <!--banner slider start-->
            <div class="banner_slider slider_1">
                <div class="single_slider" style="background-image: url(assets/img/banner/banner_3.jpg)">
                    <div class="slider_content">
                        <div class="slider_content_inner">
                            <h1>Best Collection</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                            <a href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--banner slider start-->

            <!--new product area start-->
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
                                    <li><a href="?page=single-product&id=<?= $product["product_id"] ?>"
                                            data-toggle="modal" data-target="#modal_box" title="Quick view">Chi tiết</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            </div>
            <!--new product area start-->

            <!--featured product end-->
            <div class="featured_product">
                <div class="block_title">
                    <h3>Sản phẩm xem nhiều nhất</h3>
                </div>
                <div class="row">
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
                </div>
            </div>
        </div>
    </div>
</div>
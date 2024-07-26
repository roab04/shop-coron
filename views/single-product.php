 <!--product wrapper start-->
 <div class="product_details">
     <div class="row">
         <div class="col-lg-5 col-md-6">
             <div class="product_tab fix">
                 <div class="product_tab_button">
                     <ul class="nav" role="tablist">
                         <li>
                             <a class="active" data-toggle="tab" href="#p_tab1" role="tab" aria-controls="p_tab1"
                                 aria-selected="false"><img src="assets\img\cart\cart.jpg" alt=""></a>
                         </li>
                         <li>
                             <a data-toggle="tab" href="#p_tab2" role="tab" aria-controls="p_tab2"
                                 aria-selected="false"><img src="assets\img\cart\cart2.jpg" alt=""></a>
                         </li>
                         <li>
                             <a data-toggle="tab" href="#p_tab3" role="tab" aria-controls="p_tab3"
                                 aria-selected="false"><img src="assets\img\cart\cart4.jpg" alt=""></a>
                         </li>
                     </ul>
                 </div>
                 <div class="tab-content produc_tab_c">
                     <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                         <div class="modal_img">
                             <a href="#"><img src="assets\<?=$productsDetail['thumbnail']?>" alt="" height="421px"></a>
                             <div class="img_icone">
                                 <img src="<?=$productsDetail['thumbnail']?>" alt="">
                             </div>
                             <div class="view_img">
                                 <a class="large_view" href="assets\img\product\product13.jpg"><i
                                         class="fa fa-search-plus"></i></a>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="p_tab2" role="tabpanel">
                         <div class="modal_img">
                             <a href="#"><img src="assets\img\product\product14.jpg" alt=""></a>
                             <div class="img_icone">
                                 <img src="<?=$productsDetail['thumbnail']?>" alt="">
                             </div>
                             <div class="view_img">
                                 <a class="large_view" href="assets\img\product\product14.jpg"><i
                                         class="fa fa-search-plus"></i></a>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="p_tab3" role="tabpanel">
                         <div class="modal_img">
                             <a href="#"><img src="assets\img\product\product15.jpg" alt=""></a>
                             <div class="img_icone">
                                 <img src="<?=$productsDetail['thumbnail']?>" alt="">
                             </div>
                             <div class="view_img">
                                 <a class="large_view" href="assets\img\product\product15.jpg"> <i
                                         class="fa fa-search-plus"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
         <div class="col-lg-7 col-md-6">
             <div class="product_d_right">
                 <h1><?= $productsDetail['name'] ?></h1>
                 <div class="product_ratting mb-10">
                     <ul>
                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                         <li><a href="#"> Write a review </a></li>
                     </ul>
                 </div>
                 <div class="product_desc">
                     <p><?= $productsDetail['description'] ?></p>
                 </div>

                 <div class="content_price mb-15">
                     <span><?= number_format($productsDetail['price_sale']) ?> đ</span>
                     <span class="old-price"><?= number_format($productsDetail['price']) ?> đ</span>
                 </div>
                 <div class="box_quantity mb-20">
                     <form method="post" action="controllers/addtocart_controller.php">
                         <input type="hidden" name="product_id" value="1">
                         <input type="number" name="quantity" value="1" min="1" max="10">
                         <button type="submit">Thêm vào giỏ hàng</button>
                     </form>
                     <a href="#" title="Add to Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
                 </div>

                 <div class="product_stock mb-20">
                     <p>299 items</p>
                     <span> In stock </span>
                 </div>
                 <div class="wishlist-share">
                     <h4>Share on:</h4>
                     <ul>
                         <li><a href="#"><i class="fa fa-rss"></i></a></li>
                         <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                         <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                         <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                         <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                     </ul>
                 </div>

             </div>
         </div>
     </div>
     <!--product details end-->


     <!--product info start-->
     <div class="product_d_info">
         <div class="row">
             <div class="col-12">
                 <div class="product_d_inner">
                     <div class="product_info_button">
                         <ul class="nav" role="tablist">
                             <li>
                                 <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                                     aria-selected="false">Thông tin thêm</a>
                             </li>
                         </ul>
                     </div>
                     <div class="tab-content">
                         <div class="tab-pane fade show active" id="info" role="tabpanel">
                             <div class="product_info_content">
                                 <p><?= $productsDetail['description'] ?></p>
                             </div>
                         </div>

                         <div class="tab-pane fade" id="sheet" role="tabpanel">
                             <div class="product_d_table">
                                 <form action="#">
                                     <table>
                                         <tbody>
                                             <tr>
                                                 <td class="first_child">Compositions</td>
                                                 <td>Polyester</td>
                                             </tr>
                                             <tr>
                                                 <td class="first_child">Styles</td>
                                                 <td>Girly</td>
                                             </tr>
                                             <tr>
                                                 <td class="first_child">Properties</td>
                                                 <td>Short Dress</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </form>
                             </div>
                             <div class="product_info_content">
                                 <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                     feminine designs delivering stylish separates and statement dresses which have
                                     since evolved into a full ready-to-wear collection in which every item is a vital
                                     part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful
                                     elegance and unmistakable signature style. All the beautiful pieces are made in
                                     Italy and manufactured with the greatest attention. Now Fashion extends to a range
                                     of accessories including shoes, hats, belts and more!</p>
                             </div>
                         </div>
                         <div class="tab-pane fade" id="reviews" role="tabpanel">
                             <div class="product_info_content">
                                 <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                     feminine designs delivering stylish separates and statement dresses which have
                                     since evolved into a full ready-to-wear collection in which every item is a vital
                                     part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful
                                     elegance and unmistakable signature style. All the beautiful pieces are made in
                                     Italy and manufactured with the greatest attention. Now Fashion extends to a range
                                     of accessories including shoes, hats, belts and more!</p>
                             </div>
                             <div class="product_info_inner">
                                 <div class="product_ratting mb-10">
                                     <ul>
                                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                                         <li><a href="#"><i class="fa fa-star"></i></a></li>
                                     </ul>
                                     <strong>Posthemes</strong>
                                     <p>09/07/2018</p>
                                 </div>
                                 <div class="product_demo">
                                     <strong>demo</strong>
                                     <p>That's OK!</p>
                                 </div>
                             </div>
                             <div class="product_review_form">
                                 <form action="#">
                                     <h2>Add a review </h2>
                                     <p>Your email address will not be published. Required fields are marked </p>
                                     <div class="row">
                                         <div class="col-12">
                                             <label for="review_comment">Your review </label>
                                             <textarea name="comment" id="review_comment"></textarea>
                                         </div>
                                         <div class="col-lg-6 col-md-6">
                                             <label for="author">Name</label>
                                             <input id="author" type="text">

                                         </div>
                                         <div class="col-lg-6 col-md-6">
                                             <label for="email">Email </label>
                                             <input id="email" type="text">
                                         </div>
                                     </div>
                                     <button type="submit">Submit</button>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--product info end-->


     <!--new product area start-->
     <div class="new_product_area product_page">
         <div class="row">
             <div class="col-12">
                 <div class="block_title">
                     <h3>Một số sản phẩm khác</h3>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="new_product_area">
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
                                     <a href="#"> <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
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
                                             data-toggle="modal" data-target="#modal_box" title="Quick view">Chi
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
     <!--new product area start-->
 </div>
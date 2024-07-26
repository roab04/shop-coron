<?php
    /**
     * Đức: Tính số tiền cần thanh toán
     */
    $ket_qua = lay_tat_ca_san_pham_trong_cart_item($user_id);
    if(count($ket_qua) > 0){
        $chi_phi_giao_hang = 100000;
    } else {
        $chi_phi_giao_hang = 0;
    }
    $thanh_tien = 0;
    foreach($ket_qua as $item) {
        $thanh_tien += $item['quantity'] * $item['price_sale'];
    }
    $tong_so_tien_can_thanh_toan = $thanh_tien + $chi_phi_giao_hang;
    require_once 'models/pdo.php';
    require_once 'models/cart_model.php'; // Đường dẫn đến file chứa các hàm liên quan đến giỏ hàng
    // Kiểm tra nếu user_id không được đặt trong session (chưa đăng nhập)
    if (!isset($_SESSION['user_id'])) {
        // Đẩy sang trang đăng nhập
        header("Location: ../index.php?page=login");
        exit(); // Đảm bảo không chạy code phía dưới sau khi chuyển hướng
    }

    // Xử lý cập nhật số lượng sản phẩm trong giỏ hàng
    if (isset($_POST['update_cart'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Kiểm tra số lượng cập nhật
        if ($quantity > 0 && $quantity <= 10) {
            update_cart_item_quantity($user_id, $product_id, $quantity);
        } else {
            echo "Số lượng không hợp lệ!";
        }
    }

    // Xử lý xóa sản phẩm khỏi giỏ hàng
    if (isset($_POST['remove_cart'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['remove_cart'];
        remove_from_cart($user_id, $product_id);
    }
    // Xử lý xóa hết giỏ hàng
    if (isset($_POST['clear_cart'])) {
        $user_id = $_SESSION['user_id'];
        clear_cart($user_id);
        echo "<script>window.location.href = window.location.href;</script>";
        exit();
    }

?>

<!--shopping cart area start -->
<div class="shopping_cart_area">
    <!-- Xử lý cart -->
    <div class="row">
        <div class="col-12">
            <div class="table_desc">
                <div class="cart_page table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Đặt user_id từ session vào biến
                            $user_id = $_SESSION['user_id'];

                            // Gọi hàm lấy danh sách sản phẩm trong giỏ hàng
                            $cart_items = lay_nhieu_hang("SELECT cart_item.product_id, cart_item.quantity, product.name, product.price_sale, product.thumbnail FROM cart_item INNER JOIN product ON cart_item.product_id = product.product_id WHERE cart_item.user_id = $user_id");

                            // Kiểm tra xem có sản phẩm trong giỏ hàng không
                            $total = 0;
                            if ($cart_items):
                                $stt = 1;
                                foreach ($cart_items as $item):
                                    // Tính tổng tiền cho từng sản phẩm
                                    $subtotal = $item['price_sale'] * $item['quantity'];
                                    $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><img src="<?='assets/'.$item['thumbnail']; ?>" alt="<?php echo $item['name']; ?>"
                                        class="product-thumbnail" height="40px"></td>
                                <td><?php echo $item['name']; ?></td>
                                <td>
                                    <?= number_format($item['price_sale'], 0, ',', '.') . ' đ'; ?>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="number" name="quantity" min="1" max="10"
                                            value="<?php echo $item['quantity']; ?>" style="width: 50px;">
                                        <input type="hidden" name="product_id"
                                            value="<?php echo $item['product_id']; ?>">
                                        <button type="submit" name="update_cart" class="btn btn-primary btn-sm">Cập
                                            nhật</button>
                                    </form>
                                </td>
                                <td>
                                    <?= number_format($subtotal, 0, ',', '.') . ' đ'; ?>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="remove_cart"
                                            value="<?php echo $item['product_id']; ?>">
                                        <button type="submit" name="remove" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="total-row">
                                <td colspan="5"><strong>Tổng cộng</strong></td>
                                <td>
                                    <?= number_format($total, 0, ',', '.') . ' đ'; ?>
                                <td>
                                    <form method="post" class="actions">
                                        <button type="submit" name="clear_cart" class="btn btn-warning">Xóa hết giỏ
                                            hàng</button>
                                    </form>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="7">Không có sản phẩm trong giỏ hàng</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Coupon code -->
    <!--coupon code area start-->
    <div class="coupon_area">
        <div class="row">
            <!-- Xử lý trước khi order -->
            <div class="col-lg-12 col-md-6">
                <div class="coupon_code">
                    <h3>Cart Totals</h3>
                    <div class="coupon_inner">
                        <div class="cart_subtotal">
                            <p>Thành tiền</p>
                            <p class="cart_amount">
                                <?= number_format($total, 0, ',', '.') . ' đ'; ?>
                            </p>
                        </div>
                        <div class="cart_subtotal">
                            <p>Chi phí giao hàng:</p>
                            <p class="cart_amount"><?= number_format($chi_phi_giao_hang, 0, ',', '.') . ' đ'; ?></p>
                        </div>
                        <div class="cart_subtotal">
                            <p>Tổng cộng:</p>
                            <p class="cart_amount">
                                <?= number_format($total + $chi_phi_giao_hang, 0, ',', '.') . ' đ'; ?>
                            </p>
                        </div>
                        <?php
                            if(count($cart_items) > 0) {
                        ?>
                            <div class="checkout_btn">
                                <a href="controllers/order_controller.php" class="btn btn-success">Proceed to Checkout</a>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--coupon code area end-->
</div>
<!--shopping cart area end -->
</div>

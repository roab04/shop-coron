<?php
    require_once "models/user_model.php";
    $user = lay_tat_ca_thong_tin_cua_mot_user($user_id);
    $contact = lay_thong_tin_lien_lac_cua_user($user_id);
    if($contact) {
        $contact_info_default = lay_thong_tin_lien_lac_mac_dinh($user_id);
        if(isset($contact_info_default)) {
            if(count($contact_info_default) > 0) { 
                $contact_default = $contact_info_default['contact_id'];
            }
        }
    }
    /**
     * Đức: Tính số tiền cần thanh toán
     */
    // $url_his = $_SERVER['HTTP_REFERER'];
    // if($url_his == "http://localhost:8080/shop-coron/index.php?page=cart") {
    $ket_qua = lay_tat_ca_san_pham_trong_cart_item($user_id);
    if($ket_qua) {
        $chi_phi_giao_hang = 100000;
    } else {
        $chi_phi_giao_hang = 0;
    }
    $thanh_tien = 0;
    foreach($ket_qua as $item) {
        $thanh_tien += $item['quantity'] * $item['price_sale'];
    }
    $tong_so_tien_can_thanh_toan = $thanh_tien + $chi_phi_giao_hang;
    $ket_qua_kiem_tra_order = kiem_tra_su_ton_tai_order($user_id);
    if($ket_qua_kiem_tra_order){
        $order_id = $ket_qua_kiem_tra_order['order_id'];
        $all_products = lay_tat_ca_san_pham_trong_order_item($order_id);
    }

?>

<!--shopping cart area start -->
<div class="shopping_cart_area">
    <div class="row">
        <div class="col-12">
            <div class="table_desc">
                <div class="cart_page table-responsive">
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th class="product_thumb">Ảnh</th>
                                <th class="product_name">Sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product_quantity">Số lượng</th>
                                <th class="product_total">Tổng tiền</th>
                            </tr>
                        </thead>
                        <?php foreach ($all_products as $item) {
                            ?>
                            <tbody>
                                <tr>
                                    <td class="product_thumb"><a href="#"><img src="assets/<?=$item['thumbnail']?>" width="50px" height="50px" alt=""></a></td>
                                    <td class="product_name"><a href="#"><?=$item['name']?></a></td>
                                    <td class="product-price"><?=number_format($item['price'], 0, ',', '.').' đ';?></td>
                                    <td class="product_quantity"><?=$item['quantity']; ?></td>
                                    <td class="product_total">
                                        <?php
                                            $total_price = $item['price'] * $item['quantity'];
                                            echo number_format($total_price, 0, ',', '.').' đ';
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>   
                </div>  
            </div>
        </div>
    </div>
        <!--coupon code area start-->
    <form action="controllers/payment_controller.php" method="post"> 
        <div class="coupon_area">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="order_section">
                        <h3>Thanh toán</h3>
                        <div class="order_inner">
                            <div class="order_subtotal">
                                <p>Chọn phương thức thanh toán:</p>
                                <select class="order_subtotal w-50" name="payment-method">
                                    <?php
                                        $list = lay_phuong_thuc_thanh_toan();
                                        foreach($list as $item) {
                                    ?>
                                        <option value="<?=$item['payment_method_id']?>"><?=$item['method_name']?></option>
                                    <?php }; ?>
                                </select>
                            </div>
                            <div class="order_subtotal mt-3">
                                <p>Địa chỉ giao hàng:
                                    <!-- <a href="index.php?page=profile" class="px-3" style="color:#7777e6;" data-toggle="modal" data-target="#exampleModal"> -->
                                    <button type="button" style="border: none; cursor:pointer;" class="text-primary" data-toggle="modal" data-target="#exampleModal">
                                        Sửa địa chỉ tại đây
                                    </button>
                                <!-- (Sửa địa chỉ tại đây)</a></p> -->
                                <p>
                                    <?php
                                        // $dia_chi_giao_hang = lay_dia_chi_giao_hang($user_id);
                                    ?>
                                    <input name="address" value="<?php
                                        if($contact) {echo $contact_info_default['address'];}
                                        else {echo "chưa có địa chỉ";}
                                    ?>" disabled>
                                    <input name="order-id" value="<?=$order_id?>" hidden>
                                    <input name="contact-id" value="<?=$contact_default?>" hidden>
                                    
                                </p>
                            </div>
                            <div class="order_subtotal">
                                <p>Thành tiền:</p>
                                <p class="cart_amount">
                                    <?=number_format($thanh_tien, 0, ',', '.').' đ';?>
                                </p>
                            </div>
                            <div class="order_subtotal ">
                                <p>Chi phí giao hàng:</p>
                                
                                <p class="cart_amount"><?=number_format($chi_phi_giao_hang, 0, ',', '.').' đ';?></p>
                            </div>
                            <div>
                            </div>
                            <div class="order_subtotal">
                                <p>Tổng cộng:</p>
                                <p class="cart_amount">
                                    <?=number_format($tong_so_tien_can_thanh_toan, 0, ',', '.').' đ';?>
                                </p>
                            </div>
                            <div class="checkout_btn">
                                <!-- <a href="index.php?page=payment" target="blank">Thanh toán</a> -->
                                <button type="submit" name="btn-order">
                                    Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--coupon code area end-->
    </form>
    <!--shopping cart area end -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="controllers/profile_controller.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin cá nhân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    if($contact) {
                ?>
                    <div class="modal-body">
                            <label>Họ và tên</label>
                            <input type="text" name="fullname" value="<?=$user['fullname']?>">
                            <h5 class="mt-4">Thông tin giao hàng</h5>
                            <label>Email</label>
                            <input type="email" name="email" value="<?=$contact_info_default['email']?>" required>
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" value="<?=$contact_info_default['phone']?>" required>
                            <label>Địa chỉ</label>
                            <input type="text" name="address" value="<?=$contact_info_default['address']?>" required>
                            <input type="text" name="contact_id" value="<?=$contact_default?>" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button id="btn-change-info" type="submit" class="btn btn-primary" name="btn-change-info">Lưu thay đổi</button>
                    </div>
                <?php
                    } else {
                ?>
                    <div class="modal-body">
                        <label>Họ và tên</label>
                        <input type="text" name="fullname" value="<?=$user['fullname']?>">
                        <h5 class="mt-4">Thông tin giao hàng</h5>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email..." required>
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" placeholder="phone..." required>
                        <label>Địa chỉ</label>
                        <input type="text" name="address" placeholder="address..." required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button id="btn-change-info" type="submit" class="btn btn-primary" name="btn-change-info">Lưu</button>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  const exampleModal = document.getElementById('exampleModal');
  console.log(exampleModal);
  if (exampleModal) {
      exampleModal.addEventListener('show.bs.modal', event => {
          // Button that triggered the modal
          const button = event.relatedTarget
          // Update the modal's content.
          const modalTitle = exampleModal.querySelector('.modal-title');
          const modalBodyInput = exampleModal.querySelector('.modal-body h4');
          const deleteElement = exampleModal.querySelector('a');
          modalTitle.innerHTML = 'Warning ' + '<i class="fa-solid fa-skull-crossbones">';
          modalBodyInput.textContent = `You want to remove ${nameCategory}`;
          deleteElement.href = `index.php?page=delete-category&id_loai=${idCategory}`;
      })
  }
</script>
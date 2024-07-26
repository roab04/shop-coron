<style>
    .tm-content-row {
        margin-right: -650px !important;
    }
    .tm-product-table-container
    {
        max-height: 650px !important;
    }
</style>

<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table"    >
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">SDT</th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ </th>
                                <th scope="col">Trạng thái thanh toán</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                            </tr>
                        </thead>

                        <?php
                            require "./config/config.php";
                            include './model/conn.php';
                            try {
                                $query = "SELECT * FROM orders  
                                INNER JOIN payment_method ON payment_method.payment_method_id = orders.payment_method_id 
                                INNER JOIN order_status ON orders.order_status_id = order_status.order_status_id
                                INNER JOIN contact ON orders.contact_id = contact.contact_id
                                INNER JOIN user ON contact.user_id=user.user_id
                                ORDER BY order_id ASC";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $query2= "SELECT * FROM order_status";
                                $stmt = $conn->prepare($query2);
                                $stmt->execute();
                                $order_status = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($orders as $order) {
                                    echo '<tr>';
                                    echo '<td class="tm-product-name">' . $order['order_id'] . '</td>';
                                    echo '<td class="tm-product-name">' . $order['fullname'] . '</td>';
                                    echo '<td>' . $order['phone'] . '</td>';
                                    echo '<td>' . $order['email'] . '</td>';
                                    echo '<td>' . $order['address'] . '</td>';
                                    echo '<td>' ;
                                    $selectedValue = '4';
                                    if($order['order_status_id'] == $selectedValue) echo "đã thanh toán";
                                    else echo "Chưa thanh toán";
                                     '</td>';
                                    echo '<td>' . '<form action="model/update_order.php" method="post" enctype="multipart/form-data" class="tm-edit-product-form">' . '<input name="order_id" value="' . $order['order_id'] . '" style="display:none !important;">' . '<select id="order_status_id" name="order_status_id">';
                            foreach ($order_status as $o) {
                                echo '<option value="' . $o['order_status_id'] . '"';
                                if ($o['order_status_id'] == $order['order_status_id']) {
                                    echo ' selected'; 
                                     $selectedValue = $o['value'];
                                }
                                echo '>' . $o['value'] . '</option>';
                            }
                            echo '</select>' . '</td>';
                                    echo '<td>  ';
                                    echo '<input type="submit"></input>';
                                    // echo '<td><a style="color:white;" href="order_detetils.php?order_id=' . $order['order_id'] . '">Xem chi tiết</a></td>';
                                    echo '<td><a style="color:white;" href="index.php?page=order_detail&id=' . $order['order_id'] . '">Xem chi tiết</a></td>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
                            }
                        ?>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $(".tm-product-name").on("click", function() {
            window.location.href = "edit-product.html";
        });
    });
</script>

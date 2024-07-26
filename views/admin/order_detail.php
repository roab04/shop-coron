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
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Mô Tả</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Giá </th>
                                <th scope="col">Số Lượng</th>
                            </tr>
                        </thead>
                            <?php
                                require "./config/config.php";
                                include './model/conn.php';
                                $thanhtien=0;
                                $soluong=0;
                                $dongia=0;
                                if (isset($_GET['id']) && !empty($_GET['id'])) {
                                    $order_id = intval($_GET['id']);
                                    // Query to retrieve order information along with product details
                                    $query = "SELECT orders.*, 
                                                payment_method.method_name, 
                                                order_status.value, 
                                                user.fullname, 
                                                contact.phone, 
                                                contact.email, 
                                                contact.address, 
                                                user.username,
                                                product.name AS product_name,
                                                product.price,
                                                product.description,
                                                product.thumbnail,
                                                order_item.quantity
                                            FROM orders  
                                            INNER JOIN payment_method ON payment_method.payment_method_id = orders.payment_method_id 
                                            INNER JOIN order_status ON orders.order_status_id = order_status.order_status_id
                                            INNER JOIN contact ON orders.contact_id = contact.contact_id
                                            INNER JOIN user ON contact.user_id=user.user_id
                                            INNER JOIN order_item ON orders.order_id = order_item.order_id
                                            INNER JOIN product ON order_item.product_id = product.product_id
                                            WHERE orders.order_id = :order_id";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bindParam(':order_id', $order_id);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
                                
                                
                                <?php
                                    if (!empty($result)) {
                                        echo "<h3 style='color:white;padding:5px;'>Sản phẩm trong đơn hàng:</h3>";
                                    
                                        foreach ($result as $row) {
                                            echo "<tr>"; // Start table row     
                                            echo "<td>" . $row['product_name'] . "</td>";
                                            echo "<td><img width='150px' height='150px' src='../../assets/".$row['thumbnail']."'></td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['order_date'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "</tr>"; // End table row
                                            $thanhtien+=$row['price']*$row['quantity'];
                                        }
                                
                                    } else {
                                        echo "<p>Không tìm thấy đơn hàng có ID: {$order_id}.</p>";
                                    }
                                
                                }
                            ?>
                    </table>
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                            <tr>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                $customerInfo = $result[0]; // Lấy thông tin khách hàng từ kết quả đầu tiên
                                echo "<tr>";
                                echo "<td>" . $customerInfo['fullname'] . "</td>";
                                echo "<td>" . $customerInfo['phone'] . "</td>";
                                echo "<td>" . $customerInfo['email'] . "</td>";
                                echo "<td>" . $customerInfo['address'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        echo "<div style='background-color:white;font-size:150%; margin-top: 20px;padding:5px;text-alight:right;'>";
                        echo "Thành Tiền: " .$thanhtien;
                        echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>



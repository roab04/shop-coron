<style>
    .tm-content-row{
        margin-right: -650px !important;
    }
    .tm-product-table-container
    {
        max-height: 580px !important;
    }
</style>
<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table" >
                        <thead>
                            <tr>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá gốc</th>
                                <th scope="col">Giá khuyến mãi</th>
                                <th scope="col">Hình ảnh sản phẩm</th>
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">&nsc;</th>
                            </tr>
                        </thead>
                        <?php
                            require "./config/config.php";
                            include './model/conn.php';

                            try {
                                $query = "SELECT * FROM product";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($products as $product) {
                                    echo '<tr>';
                                    echo '<td  onclick="window.location.href = \'index.php?page=edit-product&id=' . $product['product_id'] . '\';" class="product-name">' . $product['product_id'] . '</td>';
                                    echo '<td  onclick="window.location.href = \'index.php?page=edit-product&id=' . $product['product_id'] . '\';" class="product-name">' . $product['name'] . '</td>';
                                    echo '<td>' . $product['description'] . '</td>';
                                    echo '<td>' . number_format($product['price'], 0, ',', '.') . ' VND</td>';
                                    echo '<td>' . number_format($product['price_sale'], 0, ',', '.') . ' VND</td>';
                                    echo '<td  onclick="window.location.href = \'index.php?page=edit-product&id=' . $product['product_id'] . '\';"><img style="width:150px;height:150px" src="../../assets/' . $product['thumbnail'] . '" alt="Product Image"></td>';
                                    echo '<td>' . $product['views'] . '</td>';
                                    echo '<td>' . $product['post_date'] . '</td>';
                                    echo '<td>';
                                
                                    echo '<a href="#" class="tm-product-delete-link" onclick="deleteProduct(' . $product['product_id'] . ', this); return false;">';
                                    echo '<i class="far fa-trash-alt tm-product-delete-icon"></i>';
                                    echo '</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
                            }
                        ?>
                        <script>
                            function deleteProduct(productId, linkElement) {
                                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "model/delete_product.php", true);
                                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                        
                                            console.log(xhr.responseText);
                                            
                                            
                                            if (xhr.responseText === "Xóa sản phẩm thành công!") {
                                                var row = linkElement.parentNode.parentNode;
                                                row.parentNode.removeChild(row);
                                            }
                                        }
                                    };
                                    xhr.send("productId=" + productId);
                                }
                            }
                        </script>
                    </table>
                </div>
                <!-- table container -->
                <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Thêm sản phẩm mới</a>
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
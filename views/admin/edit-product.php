<style>
    .form-control{
        padding:0 0 5px 10px !important;
    }
</style>
<!-- Main content -->
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Cập nhật sản phẩm</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <?php
                            require "./config/config.php";
                            include './model/conn.php';
                            $product_id = intval($_GET['id']);

                            try {
                                $query = "SELECT * 
                                            FROM product 
                                            WHERE product_id = :product_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                                $stmt->execute();
                                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                                $query2 = "SELECT * 
                                            FROM category";
                                $stmt2 = $conn->prepare($query2);
                                $stmt2->execute();
                                $categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <form action="./model/edit-product.php?product_id=<?php echo $product['product_id']; ?>" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input id="name" name="name" type="text" value="<?php echo $product['name']; ?>" class="form-control validate" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Giá gốc</label>
                                <input id="price" name="price" type="text" value="<?php echo $product['price']; ?>" class="form-control validate" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="price_sale">Giá Khuyến mãi</label>
                                <input id="price_sale" name="price_sale" type="text" value="<?php echo $product['price_sale']; ?>" class="form-control validate" required />
                            </div>
                            <img width="200px" height="200px" src="../../assets/<?php echo $product['thumbnail']; ?>" alt="">
                            <div class="form-group mb-3">
                                <label for="thumbnail">Hình ảnh sản phẩm</label>
                                <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="form-control-file"  />
                            </div>
                            
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                            <div class="form-group mb-3">
                                <label for="description">Mô tả sản phẩm</label>
                                <textarea id="description" name="description" class="form-control validate" rows="3" required><?php echo $product['description']; ?></textarea>
                            </div>
                            <div class="form-group mb-3" style="padding:0 0 0 0 !important;">
                                <label for="category">Chọn danh mục sản phẩm</label>
                                <select id="category" name="category" class="form-control validate" required>
                                    <?php
                                        foreach ($categories as $category) {
                                            echo '<option value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Cập nhật ngay</button>
                        </div>
                        </form>
                        <?php
                            } catch (PDOException $e) {
                                echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#expire_date").datepicker();
    });
</script>

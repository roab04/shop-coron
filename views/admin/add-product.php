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
                        <h2 class="tm-block-title d-inline-block">Thêm sản phẩm</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <!-- Product form -->
                        <form action="./model/add_product.php" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input id="name" name="name" type="text" class="form-control validate" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Giá gốc</label>
                                <input id="price" name="price" type="text" class="form-control validate" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Giá Khuyến mãi</label>
                                <input id="price_sale" name="price_sale" type="text" class="form-control validate" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Hình ảnh sản phẩm</label>
                                <input id="image" name="image" type="file" accept="image/*" class="form-control-file" required />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                            <div class="form-group mb-3">
                                <label for="description">Mô tả sản phẩm</label>
                                <textarea id="description" name="description" class="form-control validate" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3" style="padding:0 0 0 0 !important;">
                                <label for="category">Chọn danh mục sản phẩm</label>
                                <select id="category" name="category" class="form-control validate" required>
                                    <?php
                                        require_once "config/config.php";
                                        include "model/conn.php";

                                        // Retrieve categories from the database
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        // Generate options for each category
                                        foreach ($categories as $category) {
                                            echo '<option value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Thêm sản phẩm ngay</button>
                        </div>
                    </form>
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

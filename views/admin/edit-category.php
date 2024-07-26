
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
                        <h2 class="tm-block-title d-inline-block">Cập nhật danh mục</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <?php
                        require "./config/config.php";
                        include './model/conn.php';
                        $category_id = intval($_GET['id']);

                        try {
                            $query2 = "SELECT * 
                                       FROM category 
                                       WHERE category_id = :category_id";
                            $stmt2 = $conn->prepare($query2);
                            $stmt2->bindValue(':category_id', $category_id, PDO::PARAM_INT);
                            $stmt2->execute();
                            $category = $stmt2->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <form action="./model/edit-category.php?category_id=<?php echo $category['category_id']; ?>" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
    
                            <div class="form-group mb-3">
                                <label for="name">Tên danh mục</label>
                                <input id="name" name="name" type="text" value="<?php echo $category['name']; ?>" class="form-control validate"  />
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
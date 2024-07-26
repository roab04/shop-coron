<style>
    .tm-content-row{
        margin-right: -550px !important;
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
                                <th scope="col">Mã danh mục</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">&nsc;</th>
                            </tr>
                        </thead>
                        <?php
                            require "./config/config.php";
                            include './model/conn.php';

                            try {
                                $query = "SELECT * FROM category";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($category as $c) {
                                    echo '<tr>';
                                    echo '<td  onclick="window.location.href = \'index.php?page=edit-category&id=' . $c['category_id'] . '\';" class="product-name">' . $c['category_id'] . '</td>';
                                    echo '<td  onclick="window.location.href = \'index.php?page=edit-category&id=' . $c['category_id'] . '\';" class="product-name">' . $c['name'] . '</td>';

                                    echo '<td>';
                                
                                    echo '<a href="" class="tm-product-delete-link" onclick="deleteCategory(' . $c['category_id'] . ', this); return false;">';
                                    echo '<i class="far fa-trash-alt tm-product-delete-icon"></i>';
                                    echo '</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
                            }
                        ?>
                    </table>
                </div>
                <!-- table container -->
                <a href="/shop-coron/views/admin/index.php?page=add-category" class="btn btn-primary btn-block text-uppercase mb-3">Thêm danh mục mới</a>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteCategory(categoryId, linkElement) {
        // if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "model/delete_category.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                // if (xhr.readyState === 4 && xhr.status === 200) {
                    // console.log(xhr.responseText);
                    // if (xhr.responseText === "Xóa danh mục thành công!") {
                        location.reload(); // Reload the page
                    // }
                // }
            };
            xhr.send("categoryId=" + categoryId);
        // }
    }
</script>
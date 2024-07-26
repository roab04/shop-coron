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
                            <h2 class="tm-block-title d-inline-block">Thêm danh mục sản phẩm</h2>
                        </div>
                    </div>
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <!-- Product form -->
                            <form action="./model/add_category.php" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <label for="name">Tên danh mục</label>
                                        <input id="name" name="name" type="text" class="form-control validate" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block text-uppercase">Thêm danh mục ngay</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
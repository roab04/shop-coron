<?php
    require_once "../../models/admin_model.php";
    $so_luong_khach_hang = lay_so_luong_khach_hang();
    $so_luong_admin = lay_so_luong_admin();
    $so_luong_danh_muc = lay_so_luong_danh_muc();
    $so_luong_san_pham = lay_so_luong_san_pham();
    $ket_qua_lay_doanh_thu_theo_thang_nam = json_encode(lay_doanh_thu_theo_thang_nam());
    $all_years = lay_all_nam();
    // $year = 2022;
    // $kq = $ket_qua_lay_doanh_thu_theo_thang_nam;
    // print_r($ket_qua_lay_doanh_thu_theo_thang_nam);
    // print_r(gettype($ket_qua_lay_doanh_thu_theo_thang_nam));
    // echo '<br>';
    // print_r($kq);
    // echo '<br>';
    // print_r(count($ket_qua_lay_doanh_thu_theo_thang_nam));
    $ket_qua_lay_so_order_theo_order_status = lay_so_luong_order_theo_trang_thai();
    // print_r($all_years);
?>

    <div class="container">
        <div class="row">
            <div class="col">
                <p class="text-white mt-5 mb-5">Xin chào, <b>Quản trị viên</b></p>
            </div>
        </div>
        <!-- row -->
        <div class="row tm-content-row">
            <!-- Danh mục -->
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block">
                    <div class="d-flex justify-content-between home-box-item">
                        <h2 class="tm-block-title home-title">Danh mục</h2>
                        <span><i class="home-font-icon w-100 h-100 fas fa-list"></i></span>
                    </div>
                    <p class="home-font-item text-center"><?=$so_luong_danh_muc['danh_muc']?></p>
                </div>
            </div>
            <!-- Sản phẩm -->
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block">
                    <div class="d-flex justify-content-between home-box-item">
                        <h2 class="tm-block-title home-title">Sản phẩm</h2>
                        <span><i class="home-font-icon w-100 h-100 fas fa-tree"></i></span>
                    </div>
                    <p class="home-font-item text-center"><?=$so_luong_san_pham['san_pham']?></p>
                </div>
            </div>
            <!-- Thành viên -->
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-taller">
                    <div class="d-flex justify-content-between home-box-item">
                        <h2 class="tm-block-title home-title">Thành viên</h2>
                        <span><i class="home-font-icon w-100 h-100 fas fa-user-circle"></i></span>
                    </div>
                    <div class="h-75 home-member justify-content-center d-flex flex-column">
                        <div class="d-flex h-25 justify-content-between align-items-center home-member-list p-3">
                            <h3 class="home-member-title">Khách hàng:</h3>
                            <p class="text-center home-member-qt"><?=$so_luong_khach_hang['khach_hang']?></p>
                        </div>
                        <div class="d-flex h-25 align-items-center justify-content-between home-member-list p-3 mt-2">
                            <h3 class="home-member-title">Admin:</h3>
                            <p class="text-center home-member-qt"><?=$so_luong_admin['admin']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Doanh thu -->
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                    <h2 class="tm-block-title">Doanh thu</h2>
                    <div class="">
                        <div class="media tm-notification-item">
                            <div class="home-revenue-chart">
                                <div class="home-revenue-char-list">
                                    <div class="home-revenue-char-item">
                                        <input type="text" hidden value='<?=$ket_qua_lay_doanh_thu_theo_thang_nam?>'>
                                        <canvas id="myChart" class="w-100 h-75"></canvas>
                                    </div>
                                    <div>
                                        <?php 
                                            foreach($all_years as $year) { ?>
                                                <button class="btn-year border-0 btn-primary" onclick="layNam(<?=$year['nam']?>)"><?=$year['nam']?></button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hóa đơn -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-taller">
                    <div class="d-flex justify-content-between home-box-item">
                        <h2 class="tm-block-title home-title">Hóa đơn</h2>
                        <span><i class="home-font-icon w-100 h-100 fas fa-file-invoice-dollar"></i></span>
                    </div>
                    <div class="h-75 home-member justify-content-center d-flex flex-column mt-2">
                        <?php
                            foreach($ket_qua_lay_so_order_theo_order_status as $order_status) {
                        ?>
                            <div class="d-flex h-25 justify-content-between align-items-center home-member-list p-3">
                                <h3 class="home-member-title-order"><?=$order_status['value']?></h3>
                                <p class="text-center home-member-qt"><?=$order_status['so_luong']?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../../assets/js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="../../assets/js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="../../assets/js/tooplate-scripts.js"></script>
    <!-- Chartjs -->
    <script src="../../assets/js/chartjs.js"></script>
    <script>
        const inputRevenue = document.querySelector('.home-revenue-char-item input');
        let year = 2022;
        function layNam(nam_hien_tai) {
            const oldChart = document.querySelector('#myChart');
            year = Number(nam_hien_tai);
            oldChart.remove();
            const boxChart = document.querySelector('.home-revenue-char-item');
            boxChart.innerHTML = '<canvas id="myChart" class="w-100 h-75"></canvas>';
            formatDataBar(inputRevenue.value, year);
        }
        document.addEventListener("DOMContentLoaded", () => {
            formatDataBar(inputRevenue.value, year);
        });
    </script>

<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="index.php?page=dashboard">
            <h1 class="tm-site-title mb-0">Trang quản trị</h1>
        </a>
        <button 
            class="navbar-toggler ml-auto mr-0" 
            type="button" data-toggle="collapse" 
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        >
            <i class="fas fa-bars tm-nav-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=dashboard">
                        <i class="fas fa-tachometer-alt"></i> Trang chủ
                        <span class="sr-only">(Hiện tai)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/shop-coron/views/admin/index.php?page=order" >
                        <i class="far fa-file-alt"></i>
                        <span>
                            Đơn hàng <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shop-coron/views/admin/index.php?page=products">
                        <i class="fas fa-shopping-cart"></i> Sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shop-coron/views/admin/index.php?page=accounts">
                        <i class="far fa-user"></i> Tài khoản
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/shop-coron/views/admin/index.php?page=category" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span>
                            Danh mục<i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-block" href="../../index.php?page=thoat">
                        Quản trị viên, <b>Đăng xuất</b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
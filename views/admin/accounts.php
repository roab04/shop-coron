<style>
    table{
        width:1000px !important;    
    }
    .tm-product-table-container
    {
        max-height: none !important;
    }
</style>
<?php
    // Kết nối đến cơ sở dữ liệu
    require_once "config/config.php";
    include 'model/conn.php';
    // Số bản ghi trên mỗi trang
    $records_per_page = 5;

    // Xác định trang hiện tại
    if (isset($_GET['page-pt']) && is_numeric($_GET['page-pt'])) {
        $current_page = (int)$_GET['page-pt'];
    } else {
        $current_page = 1;
    }

    // Tính offset
    $offset = ($current_page - 1) * $records_per_page;

    // Lấy tổng số bản ghi
    $query = "SELECT COUNT(*) AS total FROM user";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_records = $row['total'];

    // Tính tổng số trang
    $total_pages = ceil($total_records / $records_per_page);

    // Truy vấn dữ liệu cho trang hiện tại
    $query = "SELECT * FROM user LIMIT :offset, :records_per_page";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':records_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <!-- Hiển thị dữ liệu từ cơ sở dữ liệu -->
    <div class="row">
        <div class="m-auto">
            <h2>Danh sách người dùng</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã người dùng</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Ngày đăng ký</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <td><?php echo $u['user_id']; ?></td>
                            <td><?php echo $u['fullname']; ?></td>
                            <td><?php echo $u['register_date']; ?></td>
                            <td><?php echo $u['role'] == 1 ? 'Người dùng' : 'Quản trị viên'; ?></td>
                            <td>
                            <form method="post" action="delete_user.php">
                                <input type="hidden" name="user_id" value="<?php echo $u['user_id']; ?>">
                                <!-- <button type="submit" style="background-color:darkcyan">Xóa</button> -->
                                <a class="text-white" href="edit_user.php?user_id=<?php echo $u['user_id']; ?>" >Sửa</a>
                                <a class="p-4 text-white" href="/shop-coron/views/admin/index.php?page=accounts_detail&id=<?=$u['user_id']?>" ><i class="far fa-eye"></i></a>
                            </form>
                            </td>
                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Phân trang -->
    <div class="row">
        <div class="mx-auto mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?page=accounts&page-pt=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
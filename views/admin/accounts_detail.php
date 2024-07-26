<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                            <tr>
                                <th scope="col">Thông tin Tài khoản</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Kết nối đến cơ sở dữ liệu
                            require_once "config/config.php";
                            include 'model/conn.php';

                            // Kiểm tra xem ID người dùng có được truyền từ URL không
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                // Lấy ID người dùng từ URL
                                $user_id = $_GET['id'];
                                // Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết của tài khoản dựa trên ID người dùng
                                $query = "SELECT * FROM user where user_id = :user_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                $stmt->execute();
                                // Kiểm tra xem có bản ghi nào được tìm thấy không
                                if($stmt->rowCount() > 0) {
                                    // Lấy thông tin người dùng từ kết quả truy vấn
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                    // Hiển thị thông tin chi tiết của tài khoản
                                    echo "<tr>
                                            <td>Mã người dùng</td>
                                            <td>{$user['user_id']}</td>
                                        </tr>
                                        <tr>
                                            <td>Tên người dùng</td>
                                            <td>{$user['fullname']}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày đăng ký</td>
                                            <td>{$user['register_date']}</td>
                                        </tr>
                                        <tr>
                                            <td>Vai trò</td>
                                            <td>".($user['role'] == 1 ? 'Người dùng' : 'Quản trị viên')."</td>
                                        </tr>";
                                    // Các thông tin khác của tài khoản có thể được thêm ở đây
                                } else {
                                    echo "<tr><td colspan='2'>Không tìm thấy thông tin tài khoản.</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>Không tìm thấy ID người dùng.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

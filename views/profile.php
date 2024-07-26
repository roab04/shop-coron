<?php
    require_once "models/user_model.php";
    $user = lay_tat_ca_thong_tin_cua_mot_user($user_id);
    $contact = lay_thong_tin_lien_lac_cua_user($user_id);
    if($contact) {
        $contact_info_default = lay_thong_tin_lien_lac_mac_dinh($user_id);
        if(isset($contact_info_default) && count($contact_info_default) > 0) { 
            $contact_default = $contact_info_default['contact_id'];
        }
    }
?>
<!-- UI -->
<?php 
  // if(count($contact) > 0) { 
  ?>
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img
              src="<?php if(!$user['avatar']) {
                echo "assets/img/person.png";
              } else echo $user['avatar'];?>" alt="avatar"
              class="rounded-circle img-fluid" id="avatar-show"
            >
            <!--  -->
            <form action="controllers/profile_controller.php" method="post" enctype="multipart/form-data" class="mt-3">
                <div class="d-flex justify-content-center">
                      <?php if(!$user['avatar']) {
                        echo "<label id='label-image' for='fileToUpload'><i class='fas fa-upload'></i>Chọn avatar</label>";
                      } else echo "<label id='label-image' for='fileToUpload'><i class='fas fa-upload'></i>Cập nhật avatar</label>";?>
                      <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <button type="submit" id="btn-upload-avatar" name="btn-upload" class="btn btn-primary">Upload</button>
            </form>
            <!--  -->
            <h5 class="my-3"><?=$user['fullname']?></h5>
            <div class="d-flex justify-content-center mb-2">
            <!-- Change info -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Sửa thông tin cá nhân
            </button>
              <!-- Button trigger modal -->
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="col-lg-8">
        <!-- Địa chỉ đã điền -->
        <div class="card mb-4">
          <div class="card-body">
            <?php
                foreach ($contact as $item) {;
            ?>
              <?php
                if($item['contact_id'] == $contact_default) {
              ?>
                <h3>Địa chỉ giao hàng</h3>
              <?php } else { ?>
                <h4>Địa chỉ khác</h4>
              <?php }?>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?=$item['email']?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                      <p class="text-muted mb-0"><?=$item['phone']?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?=$item['address']?></p>
                </div>
              </div>
              <hr>
            <?php }?>
          </div>
        </div>
        <!-- View order -->
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-12 mb-md-0">
              <div class="card-body">
                <h3 class="mb-4">
                  <span class="me-1">Xem đơn hàng của bạn</span> 
                </h3>
                <a href="index.php?page=view_order" class="btn btn-primary">View</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="controllers/profile_controller.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin cá nhân</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                        if($contact) {
                    ?>
                        <div class="modal-body">
                                <label>Họ và tên</label>
                                <input type="text" name="fullname" value="<?=$user['fullname']?>">
                                <h5 class="mt-4">Thông tin giao hàng</h5>
                                <label>Email</label>
                                <input type="email" name="email" value="<?=$contact_info_default['email']?>" required>
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" value="<?=$contact_info_default['phone']?>" required>
                                <label>Địa chỉ</label>
                                <input type="text" name="address" value="<?=$contact_info_default['address']?>" required>
                                <input type="text" name="contact_id" value="<?=$contact_default?>" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button id="btn-change-info" type="submit" class="btn btn-primary" name="btn-change-info">Lưu thay đổi</button>
                        </div>
                    <?php
                        } else {
                    ?>
                        <div class="modal-body">
                            <label>Họ và tên</label>
                            <input type="text" name="fullname" value="<?=$user['fullname']?>">
                            <h5 class="mt-4">Thông tin giao hàng</h5>
                            <label>Email</label>
                            <input type="email" name="email" placeholder="email..." required>
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" placeholder="phone..." required>
                            <label>Địa chỉ</label>
                            <input type="text" name="address" placeholder="address..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button id="btn-change-info" type="submit" class="btn btn-primary" name="btn-change-info">Lưu</button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
  // }
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  const exampleModal = document.getElementById('exampleModal');
  console.log(exampleModal);
  if (exampleModal) {
      exampleModal.addEventListener('show.bs.modal', event => {
          // Button that triggered the modal
          const button = event.relatedTarget
          // Extract info from data-bs-* attributes
          // console.log(button);
          // const nameCategory = button.getAttribute('data-bs-name');
          // const idCategory = button.getAttribute('data-bs-id');
          // console.log(nameCategory);
          // If necessary, you could initiate an Ajax request here
          // and then do the updating in a callback.

          // Update the modal's content.
          const modalTitle = exampleModal.querySelector('.modal-title');
          const modalBodyInput = exampleModal.querySelector('.modal-body h4');
          const deleteElement = exampleModal.querySelector('a');
          console.log(modalBodyInput);
          modalTitle.innerHTML = 'Warning ' + '<i class="fa-solid fa-skull-crossbones">';
          modalBodyInput.textContent = `You want to remove ${nameCategory}`;
          deleteElement.href = `index.php?page=delete-category&id_loai=${idCategory}`;
      })
  }
</script>
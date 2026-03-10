@extends('admin_layout')
@section('admin_content')
<script>
  document.addEventListener("DOMContentLoaded", function() {
      @if(session('success'))
          Swal.fire({
              title: "Thành công!",
              text: "{{ session('success') }}",
              icon: "success",
              confirmButtonText: "OK"
          });
      @endif
  });
</script>
<style type="text/css">
.upload-container {
    position: relative;
    display: inline-block;
}

.upload-button {
    font-size: 24px; /* Kích thước icon */
    cursor: pointer;
    position: absolute;
    top: 70px;
    left: -50px;
    color: #fb0000;
    background: white;
    border: 2px solid #ddd;
    padding: 6px;
    border-radius: 50%;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    
}

.upload-button:hover {
    color: #0056b3;
}

.file-upload {
    display: none;
}

.avatar-preview {
    width: 250px;
    height: 250px;
    object-fit: cover; /* Cắt ảnh vừa khung */
    border-radius: 50%; /* Giữ hình tròn */
    border: 3px solid #ddd; /* Viền cho đẹp */
    margin-bottom: 2.0em;
}
</style>

<div class="body-wrapper">
    <div class="container-fluid">
      <div class="card card-body py-3">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
              <h4 class="mb-4 mb-sm-0 card-title">Cài đặt tài khoản</h4>
              <nav aria-label="breadcrumb" class="ms-auto">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                      <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                        Cài đặt tài khoản
                    </span>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
              <i class="ti ti-user-circle me-2 fs-6"></i>
              <span class="d-none d-md-block">Tài khoản</span>
            </button>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                  <div class="card w-100 border position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h4 class="card-title mb-4">Thay đổi hồ sơ</h4>
                      <div class="text-center">
                        <!-- Ảnh đại diện -->
                        <img id="preview-image" 
                          src="{{ $account_admin->admin_avt ? asset('public/backend/images/profile/' . $account_admin->admin_avt) : asset('public/backend/images/profile/avt_default.webp') }}" 
                          alt="avatar" 
                          class="img-fluid rounded-circle avatar-preview" >
                        <!-- Khu vực upload ảnh -->
                        <div class="upload-container">
                            <iconify-icon icon="iconamoon:folder-image" class="upload-button" onclick="triggerUpload()" width="30" height="30" title="Chọn hình ở đây"></iconify-icon>
                            <form id="upload-form" action="{{ route('admin.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="file-upload" id="image" name="Avatar" onchange="loadPreview(this)" type="file" accept="image/*">
                            </form>
                        </div>                      
                    
                        <!-- Nút tải lên & xóa -->
                        <div class="d-flex align-items-center justify-content-center gap-6">
                          <button class="btn btn-primary" onclick="submitForm()">Cập nhật ảnh đại diện</button>
                          <button class="btn bg-danger-subtle text-danger" onclick="deleteAvatar()">Xoá ảnh</button>
                        </div>
                    </div>
                    
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                  <div class="card w-100 border position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h4 class="card-title">Đổi mật khẩu</h4>
                      <p class="card-subtitle mb-4">Thay đổi mật khẩu tại đây</p>
                      <form action="{{ route('admin.updatePassword') }}" method="POST" id="form-update-password" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password" name="password_old" class="form-control border" placeholder="Mật khẩu hiện tại">
                            <label>
                              <i class="ti ti-lock me-2 fs-4"></i>
                              <span class="border-start ps-3">Mật khẩu hiện tại</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_new" class="form-control border" placeholder="Mật khẩu mới">
                            <label>
                              <i class="ti ti-lock me-2 fs-4"></i>
                              <span class="border-start ps-3">Mật khẩu mới</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_new_again" class="form-control border" placeholder="Nhập lại mật khẩu mới">
                            <label>
                              <i class="ti ti-lock me-2 fs-4"></i>
                              <span class="border-start ps-3">Nhập lại mật khẩu mới</span>
                            </label>
                        </div>
                        <div class="form-actions" style="text-align: center;">
                          <button type="submit" class="btn btn-primary"
                              style="margin-top: 20px; padding: 20px; width:100%">Đổi mật khẩu</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card w-100 border position-relative overflow-hidden mb-0">
                    <div class="card-body p-4">
                      <h4 class="card-title">Thông tin cá nhân</h4>
                      <p class="card-subtitle mb-4">Thay đổi thông tin cá nhân ở đây</p>
                      <form action="{{ route('admin.updateProfile') }}" method="POST" id="form-update-profile" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="admin_name" class="form-label">Tên của bạn</label>
                              <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="" value="{{ $account_admin->admin_name }}"> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="admin_phone" class="form-label">Số điện thoại</label>
                              <input type="text" class="form-control" name="admin_phone" id="admin_phone" placeholder="Số điện thoại" value="{{ $account_admin->admin_phone }}">
                            </div>
                          </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                  <label for="admin_email" class="form-label">Email</label>
                                  <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Email" readonly value="{{ $account_admin->admin_email }}">
                                </div>
                          </div>
                          <div class="col-lg-6">
                            <div>
                              <label for="position" class="form-label">Chức vụ</label>
                              <input type="text" class="form-control" name="position" id="position" placeholder="Chức vụ" readonly value="{{ $account_admin->position }}">
                            </div>
                          </div>
                        </div>
                        <div class="form-actions" style="text-align: center;">
                          <button type="submit" class="btn btn-primary"
                              style="margin-top: 20px; padding: 20px; width:100%">Đổi thông tin cá nhân</button>
                      </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const passwordNew = document.querySelector("input[name='password_new']");
    const passwordNewAgain = document.querySelector("input[name='password_new_again']");

    const errorPasswordNew = document.createElement("div");
    errorPasswordNew.classList.add("text-danger", "mt-1");
    passwordNew.parentNode.appendChild(errorPasswordNew);

    const errorPasswordNewAgain = document.createElement("div");
    errorPasswordNewAgain.classList.add("text-danger", "mt-1");
    passwordNewAgain.parentNode.appendChild(errorPasswordNewAgain);

    function validatePasswordNew() {
        if (passwordNew.value.length < 6) {
            errorPasswordNew.textContent = "Mật khẩu mới phải có ít nhất 6 ký tự.";
            passwordNew.classList.add("is-invalid");
        } else {
            errorPasswordNew.textContent = "";
            passwordNew.classList.remove("is-invalid");
        }
    }

    function validatePasswordNewAgain() {
        if (passwordNewAgain.value !== passwordNew.value) {
            errorPasswordNewAgain.textContent = "Mật khẩu nhập lại không khớp.";
            passwordNewAgain.classList.add("is-invalid");
        } else {
            errorPasswordNewAgain.textContent = "";
            passwordNewAgain.classList.remove("is-invalid");
        }
    }

    passwordNew.addEventListener("blur", validatePasswordNew);
    passwordNewAgain.addEventListener("blur", validatePasswordNewAgain);
});

  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("admin_phone");

    // Tạo phần hiển thị lỗi
    const errorPhone = document.createElement("div");
    errorPhone.classList.add("text-danger", "mt-1");
    phoneInput.parentNode.appendChild(errorPhone);

    // Chỉ cho phép nhập số
    phoneInput.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, ""); // Loại bỏ tất cả ký tự không phải số
    });

    // Kiểm tra số điện thoại khi rời khỏi input
    phoneInput.addEventListener("blur", function () {
        if (this.value.length !== 10) {
            errorPhone.textContent = "Số điện thoại phải có đúng 10 số.";
            phoneInput.classList.add("is-invalid");
        } else {
            errorPhone.textContent = "";
            phoneInput.classList.remove("is-invalid");
        }
    });
});

  </script>
  <script>
  // Gọi input file khi click vào icon
function triggerUpload() {
    document.getElementById('image').click();
}

// Hiển thị preview ảnh khi chọn file
function loadPreview(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-image').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Gửi form tải ảnh lên server
function submitForm() {
    document.getElementById('upload-form').submit();
}

// Sử dụng SweetAlert2 để xác nhận xóa ảnh
function deleteAvatar() {
    Swal.fire({
        title: "Bạn có chắc muốn xóa ảnh đại diện không?",
        text: "Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa ngay",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("{{ route('admin.deleteAvatar') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})  // Gửi request xóa ảnh
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('preview-image').src = "public/backend/images/profile/avt_default.webp"; // Ảnh mặc định
                    Swal.fire("Đã xóa!", "Ảnh đại diện của bạn đã được xóa.", "success");
                } else {
                    Swal.fire("Lỗi!", "Không thể xóa ảnh, vui lòng thử lại.", "error");
                }
            }).catch(error => {
                Swal.fire("Lỗi mạng", "Không thể kết nối với máy chủ", "error");
            });
        }
    });
}
  </script>
@endsection
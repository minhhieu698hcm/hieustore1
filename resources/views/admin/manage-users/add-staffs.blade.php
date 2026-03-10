@extends('admin_layout')
@section('admin_content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Thêm Nhân Viên</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex"
                                        href="{{ URL::to('/dashboard') }}">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Thêm Nhân Viên
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- start Basic Area Chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('/submit-add-staffs')}}" id="form-insert-users" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên tài khoản (Đăng nhập)<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="admin_email" name="admin_email" class="form-control"
                                    placeholder="Tên tài khoản">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ Và Tên<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="admin_name" name="admin_name" min="0" class="form-control"  placeholder="Họ và tên">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật Khẩu<span class="text-danger"> *</span>
                                </label>
                                <input type="password" id="admin_password" name="admin_password" min="0" class="form-control"  placeholder="Mật khẩu">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xác Nhận Mật Khẩu<span class="text-danger"> *</span>
                                </label>
                                <input type="password" id="admin_repassword" name="admin_repassword" min="0" class="form-control"  placeholder="Nhập lại mật khẩu">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số Điện Thoại<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="admin_phone" name="admin_phone" class="form-control" placeholder="Nhập số điện thoại" oninput="validatePhone()">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chức vụ <span class="text-danger"> *</span></label>
                                <select name="position" class="selectpicker form-control" data-style="py-0" required>
                                <option value="">Chọn chức vụ</option>
                                <option value="admin">Quản trị</option>
                                <option value="sale">Kinh Doanh</option>
                            </select>
                            </div>
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_staff" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Thêm nhân viên</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    </form>
</div>         

<!-- Page end  -->

<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-insert-users",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#admin_name"),
            Validator.isRequired("#admin_password"),  
            Validator.isRequired("#admin_repassword"),
            Validator.isRequired("#admin_email"),
            Validator.isRequired("admin_phone"),
            Validator.isFullname('#admin_name'),
            Validator.isEmail("#admin_mail"),
            Validator.isPassword("#admin_password"),
            Validator.isRePassword("#admin_repassword",function(){
                return  document.querySelector("#form-insert-users #admin_password").value;
            }),
            Validator.isPhone("#admin_phone")
            ]
        });
    });
</script>
<script>
    function validatePhone() {
        var phoneInput = document.getElementById("admin_phone");
        var phoneValue = phoneInput.value;
        
        // Chỉ cho phép nhập số và giới hạn tối đa 10 chữ số
        phoneValue = phoneValue.replace(/[^0-9]/g, ''); // Xóa ký tự không phải số
        if (phoneValue.length > 10) {
            phoneValue = phoneValue.slice(0, 10); // Giới hạn tối đa 10 số
        }
        
        phoneInput.value = phoneValue;
    }
</script>
@endsection

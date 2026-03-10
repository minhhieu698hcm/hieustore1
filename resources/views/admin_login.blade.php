<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/backend/images/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('public/backend/libs/sweetalert2/dist/sweetalert2.min.css') }}">

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/styles.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hiếu Store ADMIN</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('public/backend/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('error'))
                Swal.fire({
                    title: "Đăng nhập thất bại!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "Thử lại"
                });
            @endif
        });
    </script>
    
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center" style="width:50%">
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <div class="card mb-0 bg-body auth-login m-auto w-100">
                            <div class="card-body">
                                <a href="{{ URL::to('/dashboard') }}" class="text-nowrap logo-img d-flex mb-4 w-100 justify-content-center">
                                    <img src="{{ asset('public/backend/images/logos/logo.webp') }}" class="dark-logo"
                                        alt="Logo-Dark" />
                                </a>
                                <h1 class="lh-base mb-4" style="text-align: center"><strong>Đăng nhập</strong></h1>
                                <form action="{{URL::to('/admin-dashboard')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for="admin_email" class="form-label">Email đăng nhập</label>
                                        <input type="text" class="form-control" name="admin_email" id="admin_email"
                                            placeholder="Nhập email của bạn" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="admin_password" class="form-label">Mật khẩu</label>
                                        </div>
                                        <input type="password" class="form-control" name="admin_password" id="admin_password"
                                            placeholder="Nhập mật khẩu" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Đăng nhập</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="{{ asset('public/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/backend/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('public/backend/js/theme/theme.js') }}"></script>
    <script src="{{ asset('public/backend/js/theme/app.min.js') }}"></script>
    <script src="{{ asset('public/backend/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
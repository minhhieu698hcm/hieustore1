<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title & Meta Description -->
<title>Hiếu Store - Website chính thức thương hiệu Hiếu Store tại Việt Nam</title>
   <meta name="description"
    content="Hiếu Store - Website chính thức thương hiệu Hiếu Store tại Việt Nam. Cung cấp cáp HDMI, cáp HDMI Hiếu Store, USB, dock sạc, hub USB, bộ chuyển đổi, bộ thu phát HDMI không dây, bộ mở rộng HDMI, phụ kiện máy tính, phụ kiện laptop, thiết bị mạng và nhiều linh kiện công nghệ chính hãng, chất lượng cao." />
    <meta name="keywords"
    content="Hiếu Store, Hiếu Store, cáp hdmi, cáp HDMI Hiếu Store, bộ chuyển đổi Hiếu Store, bộ thu phát HDMI, bộ thu phát không dây, bộ thu phát hdmi không dây, dây sạc Hiếu Store,dây sạc,dock sạc, dock sạc Hiếu Store, hub chia,hub máy tính, card PCI, switch, phụ kiện gaming, phụ kiện âm thanh, phụ kiện video, bộ mở rộng, đầu đọc thẻ, giá đỡ laptop, hdd ssd lưu trữ, bộ chuyển mạch KVM, thiết bị mạng, phụ kiện sạc, linh kiện công nghệ, Hiếu Store chính hãng, linh kiện Hiếu Store giá tốt, sản phẩm Hiếu Store, đại lý Hiếu Store, bộ chuyển đổi, bộ phát HDMI, bộ mở rộng HDMI, bộ chuyển mạch, bộ chia cổng, bộ chuyển đổi tín hiệu, phụ kiện máy tính, phụ kiện laptop, phụ kiện điện tử, phụ kiện văn phòng, phụ kiện công nghệ" />
    <meta name="author" content="Hiếu Store" />
    <meta name="robots" content="index, follow" />

    <!-- Canonical URL -->
    <link rel="canonical" href="https://khotoolsocial.click/" />

    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="Fe6Jgoc5-M4ZJ0GZkNVSVLyW5PYY2G9UA_4ysIJo7Do" />


    <!-- Open Graph (OG) -->
    <meta property="og:title" content="Hiếu Store - Đại lý phân phối linh kiện Hiếu Store chính hãng tại Việt Nam" />
    <meta property="og:description"
        content="Khám phá linh kiện Hiếu Store chính hãng: cáp HDMI, USB, dock sạc, bộ chuyển đổi và các sản phẩm công nghệ cao cấp tại Hiếu Store." />
    <meta property="og:image" content="https://khotoolsocial.click//path-to-your-image.jpg" />
    <meta property="og:url" content="https://khotoolsocial.click/" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="Hiếu Store" />


    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Hiếu Store - Đại lý phân phối linh kiện Hiếu Store chính hãng tại Việt Nam" />
    <meta name="twitter:description"
        content="Hiếu Store chuyên phân phối linh kiện Hiếu Store chính hãng: cáp HDMI, USB, dock sạc, bộ chuyển đổi và nhiều sản phẩm công nghệ khác." />
    <meta name="twitter:image" content="https://khotoolsocial.click//path-to-your-image.jpg" />
	<!-- ==================== FAVICON ==================== -->
    <link rel="icon" href="{{ asset('public/frontend/images/favicon.ico') }}" type="image/png">
    {{-- <link rel="preload" href="{{ asset('public/frontend/css/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin> --}}

    <!-- Font icons -->
    <link href="https://fonts.googleapis.com/css2?family=Borel&family=Libre+Barcode+128&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preload" href="{{ asset('public/frontend/css/icons/finder-icons.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/icons/finder-icons.min.css') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/account/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/account/flatpickr.min.css') }}">
    <!-- Bootstrap + Theme styles -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <link rel="preload" href="{{ asset('public/frontend/css/account/theme.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/account/theme.min.css') }}" id="theme-styles">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/css/nice-select.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">  
    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
/* Tam giác nhỏ */
.dropdown-toggle-triangle {
  display: inline-block;
  width: 0;
  height: 0;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 9px solid #555;
  transition: transform .2s ease;
  cursor: pointer;
}

/* Khi hover vào toàn bộ dropdown (avatar + tam giác) */
.dropdown:hover .dropdown-menu {
  display: block;
}

/* Khi hover dropdown => tam giác xoay lên */
.dropdown:hover .dropdown-toggle-triangle {
  transform: rotate(180deg);
}

/* Container cho tooltip */
.tooltip-btn {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

/* Tooltip ẩn mặc định */
.tooltip-text {
  position: absolute;
  bottom: 130%; /* hiển thị phía trên nút */
  left: 50%;
  transform: translateX(-50%);
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 13px;
  white-space: nowrap;
  pointer-events: none;
  opacity: 0;
  visibility: hidden;
  transition: opacity .25s ease;
  transition-delay: 0.2s; /* ⏱️ delay 0.6s trước khi hiện */
  z-index: 1000;
}

/* Hiển thị tooltip khi hover */
.tooltip-btn:hover .tooltip-text {
  opacity: 1;
  visibility: visible;
}

/* Mũi tên nhỏ phía dưới tooltip */
.tooltip-text::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  border-width: 5px;
  border-style: solid;
  border-color: rgba(0, 0, 0, 0.8) transparent transparent transparent;
}

</style>

    

<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: '{{ session('error') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
});
</script>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

 <body>
    <!-- Navigation bar (Page header) -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element>
      <div class="container">

        <!-- Mobile offcanvas menu toggler (Hamburger) -->
        <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar brand (Logo) -->
          <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="{{URL::to($logo_main->link)}}" style="width:12%"><img
                                    src="{{ asset('public/frontend/images/logo/' . $logo_main->image_url) }}"
                                    alt="Logo Hiếu Store"></a>

        <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
        <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
          <div class="offcanvas-header py-3">
            <h5 class="offcanvas-title" id="navbarNavLabel">Thông tin cá nhân</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
            <ul class="navbar-nav position-relative">
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="{{URL::to('/')}}">Trang chủ Hiếu StoreVN</a>
              </li>
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="{{ URL::to('/myaccount') }}">Tổng quan cá nhân</a>
              </li>
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="{{ URL::to('/list-order') }}">Đơn hàng</a>
              </li>
            </ul>
          </div>
        </nav>

       <div class="d-flex align-items-center gap-1">
  <div class="dropdown position-relative" id="accountDropdown">
    <a class="btn btn-icon hover-effect-scale position-relative bg-body-secondary border rounded-circle overflow-hidden"
       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
       aria-label="My account" style="width: 60px;height: 60px;">
      <img src="{{ Auth::user()->avatar ? asset('public/frontend/images/customer/' . Auth::user()->avatar) : asset('public/frontend/images/customer/avt_default.webp') }}"
           class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
           alt="Avatar">
    </a>

    <!-- tam giác -->
    <span class="dropdown-toggle-triangle ms-1"></span>

    <ul class="dropdown-menu dropdown-menu-end" style="top: 102%;right: -50%;">
      <li><span class="h6 dropdown-header">{{ Auth::user()->last_name . ' ' . Auth::user()->first_name }}</span></li>
      <li><a class="dropdown-item" href="{{ URL::to('/myaccount') }}"><i class="fi-user opacity-75 me-2"></i>Thông tin cá nhân</a></li>
      <li><a class="dropdown-item" href="{{ URL::to('/list-order') }}"><i class="fi-layers opacity-75 me-2"></i>Đơn hàng</a></li>
      <li><a class="dropdown-item" href="{{ URL::to('/setting-account') }}"><i class="fi-settings opacity-75 me-2"></i>Cài đặt tài khoản</a></li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <form id="logout-form" action="{{ URL::to('/logout') }}" method="POST" style="display:none;">@csrf</form>
        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fi-log-out opacity-75 me-2"></i>Đăng xuất
        </a>
      </li>
    </ul>
  </div>
</div>
      </div>
    </header>



    <!-- Page content -->
    <main class="content-wrapper">
      <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
        <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


          <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
          <aside class="col-lg-3" style="margin-top: -105px">
            <div class="offcanvas-lg offcanvas-start sticky-lg-top pe-lg-3 pe-xl-4" id="accountSidebar">
              <div class="d-none d-lg-block" style="height: 105px"></div>

              <!-- Header -->
              <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                  <div class="flex-shrink-0 bg-body-secondary border rounded-circle overflow-hidden" style="width: 64px; height: 64px">
                    <img src="{{ Auth::user()->avatar ? asset('public/frontend/images/customer/' . Auth::user()->avatar) : asset('public/frontend/images/customer/avt_default.webp') }}" class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Avatar">
                  </div>
                  <div class="pt-lg-3 ps-3 ps-lg-0">
                    <h6 class="mb-1">{{ Auth::user()->last_name . ' ' . Auth::user()->first_name }}</h6>
                    <p class="fs-sm mb-0">{{ Auth::user()->username }}</p>
                  </div>
                </div>
                <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar" aria-label="Close"></button>
              </div>

              <!-- Body (Navigation) -->
              <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                <nav class="list-group list-group-borderless">
                  <a class="list-group-item list-group-item-action d-flex align-items-center active" aria-current="page" href="{{ URL::to('/myaccount') }}">
                    <i class="fi-user fs-base opacity-75 me-2"></i>
                    Thông tin cá nhân
                  </a>
                  <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ URL::to('/list-order') }}">
                    <i class="fi-layers fs-base opacity-75 me-2"></i>
                    Đơn hàng
                  </a>
                  <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ URL::to('/setting-account') }}">
                    <i class="fi-settings fs-base opacity-75 me-2"></i>
                    Cài đặt tài khoản
                  </a>
                </nav>
                <nav class="list-group list-group-borderless pt-3">
                    <form id="logout-form" action="{{ URL::to('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center"
                      data-logout="true"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fi-log-out fs-base opacity-75 me-2"></i>
                        Đăng xuất
                    </a>
                </nav>
              </div>
            </div>
          </aside>

          @yield('account-content')
          
        </div>
      </div>
    </main>


    <!-- Sidebar navigation offcanvas toggle that is visible on screens < 992px wide (lg breakpoint) -->
    <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" aria-controls="accountSidebar" data-bs-theme="light">
      <i class="fi-sidebar fs-base me-2"></i>
      Tài khoản
    </button>


    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
      <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
        Đầu trang
        <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
        <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
        <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 100 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x=".75" y=".75" width="98" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
        </svg>
      </a>
    </div>
 </body>

<!-- Vendor scripts -->
    <script src="{{ asset('public/frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/js/jquery.nice-select.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('public/frontend/js/theme.min.js') }}"></script>
    @stack('scripts')

<script>
document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.pathname;

    let activeSet = false;

    document.querySelectorAll('.list-group-item').forEach(link => {
        if (link.dataset.logout === "true") return;

        const linkPath = new URL(link.href).pathname;

        // Nếu URL hiện tại trùng link, set active
        if (linkPath === currentUrl) {
            link.classList.add('active');
            activeSet = true;
        } else {
            link.classList.remove('active');
        }

        // Click lưu localStorage
        link.addEventListener('click', function () {
            localStorage.setItem('activeLink', linkPath);
        });
    });

    // Nếu chưa set active theo URL, dùng localStorage
    if (!activeSet) {
        const saved = localStorage.getItem('activeLink');
        if (saved) {
            document.querySelectorAll('.list-group-item').forEach(link => {
                if (link.dataset.logout === "true") return;
                const linkPath = new URL(link.href).pathname;
                link.classList.toggle('active', linkPath === saved);
            });
        }
    }
});
</script>


<script>
$(document).ready(function () {
    $("input[name='phone']").on("input", function () {
        var input = $(this);
        var value = input.val();

        // Loại bỏ tất cả ký tự không phải số
        value = value.replace(/\D/g, "");

        // Giới hạn tối đa 10 số
        if (value.length > 10) {
            value = value.slice(0, 10);
        }

        // Gán giá trị mới vào input
        input.val(value);

        // Kiểm tra số lượng ký tự nhập vào
        if (value.length !== 10) {
            input.next(".error-message").remove();
            input.after('<span class="error-message" style="color: red; font-size: 14px;">Số điện thoại phải có đúng 10 số!</span>');
        } else {
            input.next(".error-message").remove(); // Xóa thông báo lỗi nếu hợp lệ
        }
    });
});
</script>

</body>

</html>
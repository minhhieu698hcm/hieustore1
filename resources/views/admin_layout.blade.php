<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="{{ session('data_bs_theme', 'light') }}" data-color-theme="{{ session('data_color_theme', 'Blue_Theme') }}" data-layout="{{ session('data_layout', 'vertical') }}" data-boxed-layout="{{ session('data_boxed_layout', 'boxed') }}" data-card="{{ session('data_card', 'shadow') }}">
<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="{{ asset('public/backend/images/logos/favicon.ico') }}" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('public/backend/css/styles.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/backend/libs/sweetalert2/dist/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/libs/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/libs/quill/dist/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hiếu Store ADMIN</title>

</head>
    <div class="preloader">
        <img src="{{ asset('public/backend/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

<body>
  <div id="main-wrapper">
    <!-- Sidebar Start -->
    <aside class="side-mini-panel with-vertical">
      <!-- ---------------------------------- -->
      <!-- Start Vertical Layout Sidebar -->
      <!-- ---------------------------------- -->
      <div class="iconbar">
        <div>
          <div class="mini-nav">
            <div class="brand-logo d-flex align-items-center justify-content-center">
              <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
              </a>
            </div>
            <ul class="mini-nav-ul" data-simplebar>

              <!-- --------------------------------------------------------------------------------------------------------- -->
              <!-- Tổng quan -->
              <!-- --------------------------------------------------------------------------------------------------------- -->
              <li class="mini-nav-item" id="mini-1">
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Tổng quan">
                  <iconify-icon icon="solar:diagram-up-broken" class="fs-7"></iconify-icon>
                </a>
              </li>

              <!-- --------------------------------------------------------------------------------------------------------- -->
              <!-- ADMIN -->
              <!-- --------------------------------------------------------------------------------------------------------- -->
              @if (Auth::check() && (Auth::user()->position === 'admin' || Auth::user()->position === 'dev'))
              <li class="mini-nav-item" id="mini-3">
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Admin">
                  <iconify-icon icon="solar:shield-user-broken" class="fs-7"></iconify-icon>
                </a>
              </li>
              @else
              <li class="mini-nav-item" id="mini-3">
                  <a href="javascript:void(0)" class="disabled-link" data-bs-toggle="tooltip"
                     data-bs-custom-class="custom-tooltip" data-bs-placement="right" 
                     data-bs-title="Bạn không có quyền truy cập">
                      <iconify-icon icon="solar:shield-user-broken" class="fs-7 text-danger"></iconify-icon>
                  </a>
              </li>
          @endif
          
              <!-- --------------------------------------------------------------------------------------------------------- -->
              <!-- SALE  -->
              <!-- --------------------------------------------------------------------------------------------------------- -->
              <li class="mini-nav-item" id="mini-4">
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Sale">
                  <iconify-icon icon="solar:chat-round-money-broken" class="fs-7"></iconify-icon>
                </a>
              </li>

              <li>
                <span class="sidebar-divider lg"></span>
              </li>
              <!-- --------------------------------------------------------------------------------------------------------- -->
              <!-- ACCOUNT -->
              <!-- --------------------------------------------------------------------------------------------------------- -->
              <li class="mini-nav-item" id="mini-5">
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Account">
                  <iconify-icon icon="solar:tuning-square-2-line-duotone" class="fs-7"></iconify-icon>
                </a>
              </li>
            </ul>

          </div>
          <div class="sidebarmenu">
            <div class="brand-logo d-flex align-items-center nav-logo">
              <a href="{{ URL::to('/dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('public/backend/images/logos/logo.webp') }}" alt="Logo" />
              </a>

            </div>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <nav class="sidebar-nav" id="menu-right-mini-1" data-simplebar>
              <ul class="sidebar-menu" id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                  <span class="hide-menu">Tổng quan</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Tổng quan -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ URL::to('/dashboard') }}" aria-expanded="false">
                    <iconify-icon icon="solar:chart-line-duotone"></iconify-icon>
                    <span class="hide-menu">Tổng quan</span>
                  </a>
                </li>
              </ul>
            </nav>

            <!-- ---------------------------------- -->
            <!-- ADMIN -->
            <!-- ---------------------------------- -->
            <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-3" data-simplebar>
              <ul class="sidebar-menu" id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                  <span class="hide-menu">ADMIN</span>
                </li>
  
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:box-linear"></iconify-icon>
                      <span class="hide-menu">Sản phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-product')}}">
                          <span class="icon-small"></span> Thêm sản phẩm
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-product')}}">
                          <span class="icon-small"></span> Tất cả sản phẩm
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:waterdrops-broken"></iconify-icon>
                      <span class="hide-menu">Phân loại</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-attribute')}}">
                          <span class="icon-small"></span> Nhóm phân loại
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-attr-value')}}">
                          <span class="icon-small"></span> Phân loại
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:server-minimalistic-broken"></iconify-icon>
                      <span class="hide-menu">Danh mục</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-category-product')}}">
                          <span class="icon-small"></span> Thêm danh mục
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-category-product')}}">
                          <span class="icon-small"></span> Tất cả danh mục
                        </a>
                      </li>
                    </ul>
                  </li>
                  
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:notebook-bookmark-broken"></iconify-icon>
                      <span class="hide-menu">Tin tức</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-blog')}}">
                          <span class="icon-small"></span> Thêm tin tức
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-blog')}}">
                          <span class="icon-small"></span> Tất cả tin tức
                        </a>
                      </li>
                    </ul>
                  </li>
                  
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:ticket-sale-broken"></iconify-icon>
                      <span class="hide-menu">Mã khuyến mãi</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-voucher')}}">
                          <span class="icon-small"></span> Thêm khuyến mãi
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-voucher')}}">
                          <span class="icon-small"></span> Tất cả khuyến mãi
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:course-down-bold"></iconify-icon>
                      <span class="hide-menu">Giảm giá</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-discount')}}">
                          <span class="icon-small"></span> Thêm giảm giá
                        </a>
                      </li>
                    </ul>
                  </li>
				   <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:gift-linear"></iconify-icon>
                      <span class="hide-menu">Quà tặng</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-promotion')}}">
                          <span class="icon-small"></span> Thêm promotion
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-promotion')}}">
                          <span class="icon-small"></span> Tất cả promotion
                        </a>
                      </li>
                    </ul>
                  </li>
				  
				          <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:mailbox-broken"></iconify-icon>
                      <span class="hide-menu">Mail Promo</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-mailpromo')}}">
                          <span class="icon-small"></span> Thêm Mail Promo
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-mailpromo')}}">
                          <span class="icon-small"></span> Tất cả Mail Promo
                        </a>
                      </li>
                    </ul>
                  </li>
                  
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:user-circle-broken"></iconify-icon>
                      <span class="hide-menu">Staff & Customer</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-staffs')}}">
                          <span class="icon-small"></span> Danh sách nhân viên
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-staffs')}}">
                          <span class="icon-small"></span> Thêm nhân viên
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-customers')}}">
                          <span class="icon-small"></span> Danh sách khách
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:bill-list-broken"></iconify-icon>
                      <span class="hide-menu">Đơn hàng</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-bill')}}">
                          <span class="icon-small"></span> Danh sách đơn hàng
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-waiting')}}">
                          <span class="icon-small"></span> ĐH chưa thanh toán
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-pending')}}">
                          <span class="icon-small"></span> ĐH chờ xác nhận
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-confirmed')}}">
                          <span class="icon-small"></span> ĐH đã xác nhận
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-shipped')}}">
                          <span class="icon-small"></span> ĐH đang vận chuyển
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-delivered')}}">
                          <span class="icon-small"></span> ĐH đã giao
                        </a>
                      </li>
                    </ul>
                  </li>

              </ul>
              <ul class="sidebar-menu" id="sidebarnav">
                <li class="nav-small-cap">
                  <span class="hide-menu">Giao diện</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:incognito-broken"></iconify-icon>
                      <span class="hide-menu">Giao diện Web</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/banner-manager')}}">
                          <span class="icon-small"></span> Sửa giao diện
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/info-manager')}}">
                          <span class="icon-small"></span> Sửa thông tin
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/admin/suspended')}}">
                          <span class="icon-small"></span> Bảo trì trang web
                        </a>
                      </li>
                    </ul>
                  </li>
              </ul>
            </nav>

            <!-- ---------------------------------- -->
            <!-- SALE -->
            <!-- ---------------------------------- -->
            <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-4" data-simplebar>
              <div>
                <ul class="sidebar-menu" id="sidebarnav">
                  <!-- ---------------------------------- -->
                  <!-- Home -->
                  <!-- ---------------------------------- -->
                  <li class="nav-small-cap">
                    <span class="hide-menu">SALE</span>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:box-linear"></iconify-icon>
                      <span class="hide-menu">Sản phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-product')}}">
                          <span class="icon-small"></span> Thêm sản phẩm
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-product')}}">
                          <span class="icon-small"></span> Tất cả sản phẩm
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:waterdrops-broken"></iconify-icon>
                      <span class="hide-menu">Phân loại</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-attribute')}}">
                          <span class="icon-small"></span> Nhóm phân loại
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/manage-attr-value')}}">
                          <span class="icon-small"></span> Phân loại
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:server-minimalistic-broken"></iconify-icon>
                      <span class="hide-menu">Danh mục</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-category-product')}}">
                          <span class="icon-small"></span> Thêm danh mục
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-category-product')}}">
                          <span class="icon-small"></span> Tất cả danh mục
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:notebook-bookmark-broken"></iconify-icon>
                      <span class="hide-menu">Tin tức</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-blog')}}">
                          <span class="icon-small"></span> Thêm tin tức
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-blog')}}">
                          <span class="icon-small"></span> Tất cả tin tức
                        </a>
                      </li>
                    </ul>
                  </li>
					
					        <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:mailbox-broken"></iconify-icon>
                      <span class="hide-menu">Mail Promo</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-mailpromo')}}">
                          <span class="icon-small"></span> Thêm Mail Promo
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-mailpromo')}}">
                          <span class="icon-small"></span> Tất cả Mail Promo
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:bill-list-broken"></iconify-icon>
                      <span class="hide-menu">Đơn hàng</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-bill')}}">
                          <span class="icon-small"></span> Danh sách đơn hàng
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-waiting')}}">
                          <span class="icon-small"></span> ĐH chưa thanh toán
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-pending')}}">
                          <span class="icon-small"></span> ĐH chờ xác nhận
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-confirmed')}}">
                          <span class="icon-small"></span> ĐH đã xác nhận
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-shipped')}}">
                          <span class="icon-small"></span> ĐH đang vận chuyển
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/bill-delivered')}}">
                          <span class="icon-small"></span> ĐH đã giao
                        </a>
                      </li>
                    </ul>
                  </li>
                 
                </ul>
              </div>
            </nav>

            <!-- ---------------------------------- -->
            <!-- Account -->
            <!-- ---------------------------------- -->
            <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-5" data-simplebar>
              <ul class="sidebar-menu" id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                  <span class="hide-menu">Thông tin tài khoản</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->

                <li class="sidebar-item">
                  <a href="{{URL::to('/account-setting')}}" class="sidebar-link">
                    <iconify-icon icon="solar:tablet-line-duotone"></iconify-icon>
                    <span class="hide-menu">Cài đặt tài khoản</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </aside>
    <!--  Sidebar End -->
    <div class="page-wrapper">
      <!--  Header Start -->
      <header class="topbar">
        <div class="with-vertical">
          <!-- ---------------------------------- -->
          <!-- Start Vertical Layout Header -->
          <!-- ---------------------------------- -->
          <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
              <li class="nav-item d-flex d-xl-none">
                <a class="nav-link nav-icon-hover-bg rounded-circle  sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                  <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-6"></iconify-icon>
                </a>
              </li>
              <li class="nav-item d-none d-lg-flex dropdown nav-icon-hover-bg rounded-circle">
                <div class="hover-dd">
                  <a class="nav-link" id="drop2" href="javascript:void(0)" aria-haspopup="true" aria-expanded="false">
                    <iconify-icon icon="solar:widget-3-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                  <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden" aria-labelledby="drop2">
                    <div class="position-relative">
                      <div class="row">
                        <div class="col-md-7">
                          <div class="p-4 pb-3">

                            <div class="row">
                              <div class="col-md-12">
                                <div class="position-relative">
                                  <a href="{{ url('/admin/chats') }}" target="_blank" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-primary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:chat-line-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Chat</h6>
                                      <span class="fs-11 d-block text-body-color">Chat với khách hàng</span>
                                    </div>
                                  </a>
                                  <a href="{{URL::to('/all-bill')}}" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-secondary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:bill-list-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Đơn hàng</h6>
                                      <span class="fs-11 d-block text-body-color">Kiểm tra đơn hàng</span>
                                    </div>
                                  </a>
                                  <a href="{{URL::to('/account-setting')}}" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-success-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:user-bold-duotone" class="fs-7 text-success"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Tài khoản</h6>
                                      <span class="fs-11 d-block text-body-color">Tài khoản cá nhân</span>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-5 d-none d-lg-flex">
                          <img src="{{ asset('public/backend/images/backgrounds/mega-dd-bg.jpg') }}" alt="mega-dd" class="img-fluid mega-dd-bg" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>

            <div class="d-block d-lg-none py-9 py-xl-0">
              <img src="{{ asset('public/backend/images/logos/logo.webp') }}" alt="matdash-img" />
            </div>
            <a class="navbar-toggler p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <iconify-icon icon="solar:menu-dots-bold-duotone" class="fs-6"></iconify-icon>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                      <iconify-icon icon="solar:sort-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link moon dark-layout nav-icon-hover-bg rounded-circle" href="javascript:void(0)">
                      <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                    </a>
                    <a class="nav-link sun light-layout nav-icon-hover-bg rounded-circle" href="javascript:void(0)" style="display: none">
                      <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item d-block d-xl-none">
                    <a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <iconify-icon icon="solar:magnifer-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>

                  <!-- ------------------------------- -->
                  <!-- start notification Dropdown -->
                  <!-- ------------------------------- -->
                  <li id="notifications" class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                    <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                      <iconify-icon id="bell-icon" icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="d-flex align-items-center justify-content-between py-3 px-7">
                        <h5 class="mb-0 fs-5 fw-semibold">Thông báo</h5>
                        <span id="notifications_count" class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">0 mới</span>
                      </div>
                      <div class="message-body" data-simplebar>
                        <!--<a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                          <span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                            <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                          </span>
                          <div class="w-75">
                            <div class="d-flex align-items-center justify-content-between">
                              <h6 class="mb-1 fw-semibold">Đơn hàng</h6>
                              <span class="d-block fs-2">9:30 AM</span>
                            </div>
                            <span class="d-block text-truncate text-truncate fs-11">1 đơn hàng mới</span>
                          </div>
                        </a>-->
                      </div>
                       <!--<div class="py-6 px-7 mb-1">
                        <button class="btn btn-primary w-100">See All Notifications</button>
                      </div>-->

                    </div>
                  </li>
                  <!-- ------------------------------- -->
                  <!-- end notification Dropdown -->
                  <!-- ------------------------------- -->

                  <!-- ------------------------------- -->
                  <!-- start profile Dropdown -->
                  <!-- ------------------------------- -->
                  <?php
                  // Lấy avatar trực tiếp từ CSDL
                  $admin = Auth::guard('admin')->user();
                  $avatar = $admin ? $admin->admin_avt : null;
                  ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center gap-2 lh-base">
                        <img src="{{ $avatar ? asset('public/backend/images/profile/' . $avatar) : asset('public/backend/images/profile/avt_default.webp') }}"  class="rounded-circle" width="40" height="40" alt="admin-avatar" style="border: 2px solid #ddd;"/>
                        <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                      </div>
                    </a>
                    <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="position-relative px-4 pt-3 pb-2">
                        
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                          <img src="{{ $avatar ? asset('public/backend/images/profile/' . $avatar) : asset('public/backend/images/profile/avt_default.webp') }}" class="rounded-circle" width="60" height="60" alt="admin-avatar" style="border: 2px solid #ddd;"/>
                          <div>
                            <h5 class="mb-0 fs-12 mb-2" style="margin-left: 4px">  
                             <strong style="font-size:18px"> <?php
                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?> 
                                <span class="text-success fs-12"> Pro</span></strong>
                            </h5>
                            <?php
                            $position = Session::get('position');
                            if ($position) {           
                                if ($position == 'dev') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-danger d-flex align-items-center">Lập trình viên &nbsp;<iconify-icon icon="solar:crown-star-broken" width="24" height="24"></iconify-icon></span>';
                                } elseif ($position == 'admin') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-warning d-flex align-items-center">Quản trị viên &nbsp;<iconify-icon icon="solar:laptop-minimalistic-broken" width="24" height="24"></iconify-icon></span>';
                                } elseif ($position == 'sale') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-success d-flex align-items-center">Kinh doanh &nbsp;<iconify-icon icon="solar:sale-broken" width="24" height="24"></iconify-icon></span>';
                                }
                            }
                            ?>
                          </div>
                        </div>
                        <div class="message-body">
                          <a href="{{URL::to('/account-setting')}}" class="p-2 dropdown-item h6 rounded-1">
                            Cài đặt tài khoản
                          </a>
                          <a href="{{ URL::to('/logout') }}" class="p-2 dropdown-item h6 rounded-1">
                            Đăng xuất
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- ------------------------------- -->
                  <!-- end profile Dropdown -->
                  <!-- ------------------------------- -->
                </ul>
              </div>
            </div>
          </nav>
          <!-- ---------------------------------- -->
          <!-- End Vertical Layout Header -->
          <!-- ---------------------------------- -->

        </div>
        <div class="app-header with-horizontal">
          <nav class="navbar navbar-expand-xl container-fluid p-0">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item d-flex d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover-bg rounded-circle" id="sidebarCollapse" href="javascript:void(0)">
                  <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                </a>
              </li>
              <li class="nav-item d-none d-xl-flex align-items-center">
                <a href="{{ URL::to('/dashboard') }}" class="text-nowrap nav-link">
                  <img src="{{ asset('public/backend/images/logos/logo.webp') }}" alt="matdash-img" />
                </a>
              </li>
              <li class="nav-item d-none d-lg-flex align-items-center dropdown nav-icon-hover-bg rounded-circle">
                <div class="hover-dd">
                  <a class="nav-link" id="drop2" href="javascript:void(0)" aria-haspopup="true" aria-expanded="false">
                    <iconify-icon icon="solar:widget-3-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                  <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden" aria-labelledby="drop2">
                    <div class="position-relative">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="p-4 pb-3">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="position-relative">
                                  <a href="{{ url('/admin/chats') }}" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-primary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:chat-line-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Chat</h6>
                                      <span class="fs-11 d-block text-body-color">Chat với khách hàng</span>
                                    </div>
                                  </a>
                                  <a href="{{URL::to('/all-bill')}}" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-secondary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:bill-list-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Đơn hàng</h6>
                                      <span class="fs-11 d-block text-body-color">Kiểm tra đơn hàng</span>
                                    </div>
                                  </a>
                                  <a href="{{URL::to('/account-setting')}}" class="d-flex align-items-center pb-9 position-relative">
                                    <div class="bg-success-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                      <iconify-icon icon="solar:user-bold-duotone" class="fs-7 text-success"></iconify-icon>
                                    </div>
                                    <div>
                                      <h6 class="mb-0">Tài khoản</h6>
                                      <span class="fs-11 d-block text-body-color">Tài khoản cá nhân</span>
                                    </div>
                                  </a>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-4 d-none d-lg-flex">
                          <img src="{{ asset('public/backend/images/backgrounds/mega-dd-bg.jpg') }}" alt="mega-dd" class="img-fluid mega-dd-bg" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="d-block d-xl-none">
              <a href="{{ URL::to('/dashboard') }}" class="text-nowrap nav-link">
                <img src="{{ asset('public/backend/images/logos/logo.webp') }}" alt="matdash-img" />
              </a>
            </div>
            <a class="navbar-toggler nav-icon-hover p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
              </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                      <iconify-icon icon="solar:sort-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link nav-icon-hover-bg rounded-circle moon dark-layout" href="javascript:void(0)">
                      <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                    </a>
                    <a class="nav-link nav-icon-hover-bg rounded-circle sun light-layout" href="javascript:void(0)" style="display: none">
                      <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item d-block d-xl-none">
                    <a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <iconify-icon icon="solar:magnifer-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>

                  <!-- ------------------------------- -->
                  <!-- start notification Dropdown -->
                  <!-- ------------------------------- -->
                  <li id="notifications" class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                    <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                      <iconify-icon id="bell-icon" icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="d-flex align-items-center justify-content-between py-3 px-7">
                        <h5 class="mb-0 fs-5 fw-semibold">Thông báo</h5>
                        <span id="notifications_count" class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">0 mới</span>
                      </div>
                      <div class="message-body" data-simplebar>
                       <!-- <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                          <span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                            <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                          </span>
                          <div class="w-75">
                            <div class="d-flex align-items-center justify-content-between">
                              <h6 class="mb-1 fw-semibold">Đơn hàng</h6>
                              <span class="d-block fs-2">9:30 AM</span>
                            </div>
                            <span class="d-block text-truncate text-truncate fs-11">1 đơn hàng mới</span>
                          </div>
                        </a> -->
                      </div>
                      <!-- <div class="py-6 px-7 mb-1">
                        <button class="btn btn-primary w-100">See All Notifications</button>
                      </div> -->
                    </div>
                  </li>
                  <!-- ------------------------------- -->
                  <!-- end notification Dropdown -->
                  <!-- ------------------------------- -->
                  <!-- ------------------------------- -->
                  <!-- start profile Dropdown -->
                  <!-- ------------------------------- -->
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center gap-2 lh-base">
                        <img src="{{ $avatar ? asset('public/backend/images/profile/' . $avatar) : asset('public/backend/images/profile/avt_default.webp') }}" class="rounded-circle" width="40" height="40" alt="admin-avatar" style="border: 2px solid #ddd;"/>
                        <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                      </div>
                    </a>
                    <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="position-relative px-4 pt-3 pb-2">
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                          <img src="{{ $avatar ? asset('public/backend/images/profile/' . $avatar) : asset('public/backend/images/profile/avt_default.webp') }}" class="rounded-circle" width="60" height="60" alt="admin-avatar" style="border: 2px solid #ddd;"/>
                          <div>
                            <h5 class="mb-0 fs-12 mb-2" style="margin-left: 4px">
                               <strong style="font-size:18px"> <?php
                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?> 
                                <span class="text-success fs-12"> Pro</span></strong>
                            </h5>
                            <?php
                            $position = Session::get('position');
                            if ($position) {           
                                if ($position == 'dev') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-danger d-flex align-items-center">Lập trình viên &nbsp;<iconify-icon icon="solar:crown-star-broken" width="24" height="24"></iconify-icon></span>';
                                } elseif ($position == 'admin') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-warning d-flex align-items-center">Quản trị viên &nbsp;<iconify-icon icon="solar:laptop-minimalistic-broken" width="24" height="24"></iconify-icon></span>';
                                } elseif ($position == 'sale') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-success d-flex align-items-center">Kinh doanh &nbsp;<iconify-icon icon="solar:sale-broken" width="24" height="24"></iconify-icon></span>';
                                }
                            }
                            ?>
                          </div>
                        </div>
                        <div class="message-body">
                          <a href="{{URL::to('/account-setting')}}" class="p-2 dropdown-item h6 rounded-1">
                            Cài đặt tài khoản
                          </a>
                          <a href="{{ URL::to('/logout') }}" class="p-2 dropdown-item h6 rounded-1">
                           Đăng xuất
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- ------------------------------- -->
                  <!-- end profile Dropdown -->
                  <!-- ------------------------------- -->
                </ul>
              </div>
            </div>
          </nav>

        </div>

      </header>
      <!--  Header End -->

      <aside class="left-sidebar with-horizontal">
        <!-- Sidebar scroll-->
        <div>
          <!-- Sidebar navigation-->
          <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              {{-- <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Tổng quan</span>
              </li> --}}
              <!-- =================== -->
              <!-- Dashboard -->
              <!-- =================== -->
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:layers-line-duotone" class="ti"></iconify-icon>
                    </span>
                    <span class="hide-menu">Tổng quan</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="../main/index.html" class="sidebar-link">
                        <i class="ti ti-aperture"></i>
                        <span class="hide-menu">Tổng quan</span>
                        </a>
                    </li>
                    </ul>
                </li> --}}

              <!-- ============================= -->
              <!-- Front Pages -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Sản phẩm</span>
              </li>

              <!-- =================== -->
              <!-- Icon -->
              <!-- =================== -->
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span class="rounded-3">
                    <iconify-icon icon="solar:box-linear" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Sản phẩm</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="{{URL::to('/add-product')}}" aria-expanded="false">
                      <span class="rounded-3">
                        <i class="ti ti-circle"></i>
                      </span>
                      <span class="hide-menu">Thêm sản phẩm</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{URL::to('/all-product')}}" aria-expanded="false">
                      <span class="rounded-3">
                        <i class="ti ti-circle"></i>
                      </span>
                      <span class="hide-menu">Tất cả sản phẩm</span>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- ============================= -->
              <!-- Apps -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Phân loại</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span>
                    <iconify-icon icon="solar:widget-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Phân loại</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{URL::to('/manage-attribute')}}" class="sidebar-link">
                        <span class="rounded-3">
                            <i class="ti ti-circle"></i>
                          </span>
                      <span class="hide-menu">Nhóm phân loại</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/manage-attr-value')}}" class="sidebar-link">
                        <span class="rounded-3">
                            <i class="ti ti-circle"></i>
                          </span>
                      <span class="hide-menu">Phân loại</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- ============================= -->
              <!-- PAGES -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Danh mục</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span>
                    <iconify-icon icon="solar:notes-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Danh mục</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{URL::to('/add-category-product')}}" class="sidebar-link">
                        <span class="rounded-3">
                            <i class="ti ti-circle"></i>
                          </span>
                      <span class="hide-menu">Thêm danh mục</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/all-category-product')}}" class="sidebar-link">
                        <span class="rounded-3">
                            <i class="ti ti-circle"></i>
                          </span>
                      <span class="hide-menu">Tất cả danh mục</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- ============================= -->
              <!-- UI -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Tin tức</span>
              </li>
              <!-- =================== -->
              <!-- UI Elements -->
              <!-- =================== -->
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span class="rounded-3">
                    <iconify-icon icon="solar:archive-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Tin tức</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{URL::to('/add-blog')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Thêm tin tức</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/all-blog')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Tất cả tin tức</span>
                    </a>
                  </li>
                </ul>
              </li>
				<li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <iconify-icon icon="solar:cart-3-line-duotone"></iconify-icon>
                      <span class="hide-menu">Mail Promo</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/add-mailpromo')}}">
                          <span class="icon-small"></span> Thêm Mail Promo
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link" href="{{URL::to('/all-mailpromo')}}">
                          <span class="icon-small"></span> Tất cả Mail Promo
                        </a>
                      </li>
                    </ul>
                  </li>
              <!-- ============================= -->
              <!-- Forms -->
              <!-- ============================= -->
              @if (Auth::check() && (Auth::user()->position === 'admin' || Auth::user()->position === 'dev'))
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Mã khuyến mãi</span>
              </li>
              <!-- =================== -->
              <!-- Forms -->
              <!-- =================== -->
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span class="rounded-3">
                    <iconify-icon icon="solar:folder-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Mã khuyến mãi</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <!-- form elements -->
                  <li class="sidebar-item">
                    <a href="{{URL::to('/add-voucher')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Thêm khuyến mãi</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/manage-voucher')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Tất cả mã khuyến mãi</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- ============================= -->
              <!-- Tables -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Staff & Customer</span>
              </li>
              <!-- =================== -->
              <!-- Bootstrap Table -->
              <!-- =================== -->
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span class="rounded-3">
                    <iconify-icon icon="solar:tuning-square-2-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Staff & Customer</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{URL::to('/manage-staffs')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Danh sách nhân viên</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/add-staffs')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Thêm nhân viên</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/manage-customers')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Danh sách khách</span>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              <!-- ============================= -->
              <!-- Charts -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Đơn hàng</span>
              </li>
              <!-- =================== -->
              <!-- Apex Chart -->
              <!-- =================== -->
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <span class="rounded-3">
                    <iconify-icon icon="solar:chart-square-line-duotone" class="ti"></iconify-icon>
                  </span>
                  <span class="hide-menu">Đơn hàng</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{URL::to('/all-bill')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">Danh sách đơn hàng</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/bill-waiting')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">ĐH chưa thanh toán</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/bill-pending')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">ĐH chờ xác nhận</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/bill-confirmed')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">ĐH đã xác nhận</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/bill-shipped')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">ĐH đang vận chuyển</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{URL::to('/bill-delivered')}}" class="sidebar-link">
                      <i class="ti ti-circle"></i>
                      <span class="hide-menu">ĐH đã giao</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>

      
     <!-- Content body-->
        <section class="wrapper">
            @yield('admin_content')
        </section>
      <!-- Content body-->



     <button class="btn btn-danger p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="icon ti ti-settings fs-7"></i>
      </button>

      <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
          <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
            Cài đặt giao diện
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" data-simplebar style="height: calc(100vh - 80px)">
          <h6 class="fw-semibold fs-4 mb-2">Giao diện</h6>

          <div class="d-flex flex-row gap-3 customizer-box" role="group">
            <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" value="light"/>
            <label class="btn p-9 btn-outline-primary rounded-2" for="light-layout">
              <i class="icon ti ti-brightness-up fs-7 me-2"></i>Sáng
            </label>

            <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" value="dark" />
            <label class="btn p-9 btn-outline-primary rounded-2" for="dark-layout">
              <i class="icon ti ti-moon fs-7 me-2"></i>Tối
            </label>
          </div>

          <h6 class="mt-5 fw-semibold fs-4 mb-2">Màu sắc</h6>

          <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
            <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" value="Blue_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" value="Aqua_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" value="Purple_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" value="Green_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" value="Cyan_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" value="Orange_Theme"/>
            <label class="btn p-9 btn-outline-primary rounded-2 d-flex align-items-center justify-content-center" onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                <i class="ti ti-check text-white d-flex icon fs-5"></i>
              </div>
            </label>
          </div>

          <h6 class="mt-5 fw-semibold fs-4 mb-2">Kiểu bố cục</h6>
          <div class="d-flex flex-row gap-3 customizer-box" role="group">
            <div>
              <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" value="vertical"/>
              <label class="btn p-9 btn-outline-primary rounded-2" for="vertical-layout">
                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Kiểu Dọc 
              </label>
            </div>
            <div>
              <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" value="horizontal"/>
              <label class="btn p-9 btn-outline-primary rounded-2" for="horizontal-layout">
                <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Kiểu Ngang
              </label>
            </div>
          </div>

          <h6 class="mt-5 fw-semibold fs-4 mb-2">Vùng nội dung</h6>

          <div class="d-flex flex-row gap-3 customizer-box" role="group">
            <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" value="boxed"/>
            <label class="btn p-9 btn-outline-primary rounded-2" for="boxed-layout">
              <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Thu gọn
            </label>

            <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" value="full"/>
            <label class="btn p-9 btn-outline-primary rounded-2" for="full-layout">
              <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Đầy đủ
            </label>
          </div>

          <h6 class="fw-semibold fs-4 mb-2 mt-5">Kiểu Sidebar</h6>
          <div class="d-flex flex-row gap-3 customizer-box" role="group">
            <a href="javascript:void(0)" class="fullsidebar">
              <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary rounded-2" for="full-sidebar">
                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Đầy đủ
              </label>
            </a>
            <div>
              <input type="radio" class="btn-check" name="sidebar-type" id="mini-sidebar" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary rounded-2" for="mini-sidebar">
                <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Thu gọn
              </label>
            </div>
          </div>

          <h6 class="mt-5 fw-semibold fs-4 mb-2">Hiệu ứng khung</h6>

          <div class="d-flex flex-row gap-3 customizer-box" role="group">
            <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" value="border"/>
            <label class="btn p-9 btn-outline-primary rounded-2" for="card-with-border">
              <i class="icon ti ti-border-outer fs-7 me-2"></i>Viền
            </label>
            <div>
              <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" value="shadow"/>
            <label class="btn p-9 btn-outline-primary rounded-2" for="card-without-border">
              <i class="icon ti ti-border-none fs-7 me-2"></i>Đổ bóng
            </label>
          </div>
        </div>
      </div>

      <script>
  function handleColorTheme(e) {
    document.documentElement.setAttribute("data-color-theme", e);
  }
</script>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="{{ asset('public/backend/js/vendor.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/theme/app.init.js') }}"></script>
  <script src="{{ asset('public/backend/js/theme/theme.js') }}"></script>
  <script src="{{ asset('public/backend/js/theme/app.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/theme/sidebarmenu.js') }}"></script>
  

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="{{ asset('public/backend/libs/fullcalendar/index.global.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/forms/select2.init.js') }}"></script>
  <script src="{{ asset('public/backend/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/plugins/bootstrap-validation-init.js') }}"></script>
  <script src="{{ asset('public/backend/js/extra-libs/moment/moment.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/forms/datepicker-init.js') }}"></script>
  

  <!-- JS -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".disabled-link").forEach(link => {
          link.addEventListener("click", function(event) {
              event.preventDefault();
              event.stopPropagation();
          });
      });
  });
</script>
	  
	  <!-- CKEditor 4 -->
<script src="https://cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
<style>
    .cke_notification {
        display: none !important;
    }
</style>
<!-- CKEditor 4 (full-all để đủ toolbar và tính năng) -->
<script src="https://cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>

<style>
    .cke_notification {
        display: none !important;
    }
</style>

<script>
    const selectors = [
        '#ckeditor1',
        '[name="product_desc"]',
        '[name="product_content"]',
        '[name="product_gale_desc"]',
        '[name="blog_desc"]',
        '[name="blog_content"]',
        '[name="blog_content2"]',
        '[name="mailpromo_content"]'
    ];

    document.addEventListener('DOMContentLoaded', () => {
        selectors.forEach(selector => {
            const el = document.querySelector(selector);
            if (el) {
                CKEDITOR.replace(el, {
                    height: 300,
                    allowedContent: true,
                    extraAllowedContent: '*[*]{*}',
                    removePlugins: 'easyimage, cloudservices',

                    toolbar: [
                        { name: 'document', items: ['Source', '-', 'Preview'] },
                        { name: 'clipboard', items: ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'] },
                        { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                        { name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'links', items: ['Link', 'Unlink'] },
                        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar'] },
                        { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                        { name: 'colors', items: ['TextColor', 'BGColor'] },
                        { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                    ],

                    font_names: 'Roboto;Arial;Times New Roman;Verdana;Tahoma;Courier New',

                    contentsCss: [
                        'https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap',
                        CKEDITOR.basePath + 'contents.css'
                    ],

                    bodyClass: 'document-editor',

                    on: {
                        instanceReady: function (evt) {
                            const editor = evt.editor;
                            editor.document.getBody().setStyle('background-color', '#fff');
                            editor.document.getBody().setStyle('color', '#29343d');
                            editor.document.getBody().setStyle('font-family', 'Roboto, Arial, sans-serif');

                            // 👉 Chỉ áp dụng max-width nếu là mailpromo_content
                            if (el.getAttribute('name') === 'mailpromo_content') {
                                editor.document.getBody().setStyle('max-width', '600px');
                                editor.document.getBody().setStyle('margin', '0 auto');
                            }
                        }
                    }
                });
            }
        });
    });
</script>


	  
<!--<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script type="text/javascript">
    function initEditor(selector) {
        const element = document.querySelector(selector);
        if (!element) return;

        ClassicEditor
            .create(element, {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'link',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'blockQuote', 'insertTable', 'imageUpload', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                        'alignment', 'undo', 'redo', 'indent', 'outdent', '|',
                        'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', 'highlight',
                        'horizontalLine', 'pageBreak', 'removeFormat', '|',
                        'sourceEditing' // ✅ Cho phép xem và chỉnh HTML
                    ]
                },
				htmlEmbed: {
						showPreviews: true // ⚠️ Cho phép hiển thị nội dung HTML thực
					},
                language: 'en',
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/, // Cho phép mọi tag
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                }
            })
            .then(editor => {
                // Giới hạn kích thước khung hiển thị cho nội dung mailpromo
                if (selector === '[name="mailpromo_content"]') {
                    const editableElement = editor.ui.view.editable.element;
                    editableElement.style.maxWidth = '600px';
                    editableElement.style.margin = 'auto';
                }

                // Cài màu nền/trắng + màu chữ mặc định
                editor.editing.view.change(writer => {
                    writer.setStyle('background-color', '#fff', editor.editing.view.document.getRoot());
                    writer.setStyle('color', '#29343d', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error('CKEditor init error:', error);
            });
    }

    // Khởi tạo nhiều editor nếu cần
    document.addEventListener('DOMContentLoaded', () => {
        const selectors = [
            '#ckeditor1',
            '[name="product_desc"]',
            '[name="product_content"]',
            '[name="product_gale_desc"]',
            '[name="blog_desc"]',
            '[name="blog_content"]',
            '[name="blog_content2"]',
            //'[name="mailpromo_content"]' // ✅ Email content
        ];

        selectors.forEach(initEditor);
    });
</script>-->

<script type="text/javascript">
 function ChangeToSlug(idInput, idOutput) {
    var slug = document.getElementById(idInput).value;
    slug = slug.toLowerCase();

    // Đổi ký tự có dấu thành không dấu
    slug = slug.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Loại bỏ dấu
    slug = slug.replace(/đ/gi, 'd');

    // Xóa các ký tự đặc biệt
    slug = slug.replace(/[^a-z0-9\s-]/gi, '');

    // Đổi khoảng trắng thành dấu gạch ngang
    slug = slug.replace(/\s+/g, "-");

    // Xóa các ký tự gạch ngang đầu & cuối
    slug = slug.replace(/^-+|-+$/g, '');

    document.getElementById(idOutput).value = slug;
}

</script>

<!-- JS sidebar edit-->
<script>
  document.addEventListener("DOMContentLoaded", function () {
     var currentUrl = window.location.href;
 
     // Lặp qua tất cả các link trong sidebar
     document.querySelectorAll("#sidebarnav a").forEach(function (link) {
         var linkHref = link.href;
 
         // Nếu link hiện tại trùng khớp URL
         if (linkHref === currentUrl) {
             link.classList.add("active");
         }
 
         //  Nếu đang ở edit-product thì giữ active cho "Tất cả sản phẩm"
         if (currentUrl.includes("edit-product") && linkHref.includes("all-product")) {
             link.classList.add("active");
         }
 
         // Nếu đang ở add-product thì chỉ active nó, KHÔNG active "Tất cả sản phẩm"
         if (currentUrl.includes("add-product") && linkHref.includes("add-product")) {
             link.classList.add("active");
         }
         
          // Nếu đang ở edit-attribute thì giữ active cho "Nhóm phân loại"
        if (currentUrl.includes("edit-attribute") && linkHref.includes("manage-attribute")) {
            link.classList.add("active");
        }
          // Nếu đang ở edit-category thì giữ active cho "Nhóm danh mục"
          if (currentUrl.includes("edit-category-product") && linkHref.includes("all-category-product")) {
            link.classList.add("active");
        }
         // Nếu đang ở edit-voucher thì giữ active cho "Nhóm khuyến mãi"
         if (currentUrl.includes("edit-voucher") && linkHref.includes("manage-voucher")) {
            link.classList.add("active");
        }
         // Nếu đang ở chitietdonhang thì giữ active cho "Nhóm đơn hàng"
         if (currentUrl.includes("bill-info") && linkHref.includes("all-bill")) {
            link.classList.add("active");
        }
        // Nếu đang ở edit-attr-value thì giữ active cho "Phân loại"
        if (currentUrl.includes("edit-attr-value") && linkHref.includes("manage-attr-value")) {
            link.classList.add("active");
        }
         // Kích hoạt menu cha nếu đang active một trang con
         if (link.classList.contains("active")) {
             var parentItem = link.closest("ul.collapse");
             if (parentItem) {
                 parentItem.classList.add("in");
                 parentItem.closest("li.sidebar-item").classList.add("selected");
             }
         }
     });
 
     // ===========================
     // Xử lý Mini Sidebar (ĐÃ ĐÚNG)
     // ===========================
     document.querySelectorAll(".mini-nav .mini-nav-item").forEach(function (item) {
         item.addEventListener("click", function () {
             var id = this.id.replace("mini-", "");
 
             // Bỏ class "selected" khỏi tất cả mini-nav-item
             document.querySelectorAll(".mini-nav .mini-nav-item").forEach(function (navItem) {
                 navItem.classList.remove("selected");
             });
 
             // Thêm class "selected" cho item được click
             this.classList.add("selected");
 
             // Ẩn tất cả sidebar menu
             document.querySelectorAll(".sidebarmenu nav.sidebar-nav").forEach(function (nav) {
                 nav.classList.remove("d-block");
             });
 
             // Hiển thị sidebar menu tương ứng
             var selectedMenu = document.getElementById("menu-right-mini-" + id);
             if (selectedMenu) {
                 selectedMenu.classList.add("d-block");
             }
 
             // Lưu trạng thái vào localStorage
             localStorage.setItem("selectedMiniNav", id);
         });
     });
 
     // Giữ trạng thái đã chọn sau khi reload
     var savedMiniNav = localStorage.getItem("selectedMiniNav");
     if (savedMiniNav) {
         var savedItem = document.getElementById("mini-" + savedMiniNav);
         var savedMenu = document.getElementById("menu-right-mini-" + savedMiniNav);
 
         if (savedItem) savedItem.classList.add("selected");
         if (savedMenu) savedMenu.classList.add("d-block");
     }
 });
 </script>
 <!-- JS sidebar edit-->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Giới hạn phạm vi chỉ trong offcanvas cài đặt
    const settingContainer = document.querySelector("#offcanvasExample");
    const settingInputs = settingContainer.querySelectorAll('input[type="radio"]');

    settingInputs.forEach((input) => {
      input.addEventListener("change", function () {
        const themeData = {
          _token: '{{ csrf_token() }}',
          admin_id: '{{ Auth::id() }}',
          'data-bs-theme': settingContainer.querySelector('input[name="theme-layout"]:checked')?.value || null,
          'data-color-theme': settingContainer.querySelector('input[name="color-theme-layout"]:checked')?.value || null,
          'data-layout': settingContainer.querySelector('input[name="page-layout"]:checked')?.value || null,
          'data-boxed-layout': settingContainer.querySelector('input[name="layout"]:checked')?.value || null,
          'data-card': settingContainer.querySelector('input[name="card-layout"]:checked')?.value || null,
        };

        fetch("{{ route('theme.update') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": themeData._token,
          },
          body: JSON.stringify(themeData),
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.status === "success") {
              fetch("{{ route('admin.update-theme-session') }}", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": themeData._token,
                },
                body: JSON.stringify({}),
              })
                .then((res) => res.json())
                .then((sessionData) => {
                  if (sessionData.status === "success") {
                    console.log("✅ Đã cập nhật session theme thành công");
                    location.reload();
                  } else {
                    console.warn("⚠️ Cập nhật session thất bại");
                  }
                });
            } else {
              console.warn("⚠️ Lỗi khi cập nhật theme:", data.message);
            }
          })
          .catch((err) => console.error("❌ Lỗi Ajax:", err));
      });
    });
  });
</script>
	  
<style>
@keyframes shake {
  0%   { transform: rotate(0deg); }
  20%  { transform: rotate(-10deg); }
  40%  { transform: rotate(10deg); }
  60%  { transform: rotate(-10deg); }
  80%  { transform: rotate(10deg); }
  100% { transform: rotate(0deg); }
}

.bell-shake {
  animation: shake 0.8s ease-in-out infinite;
}
</style>

<script>
  const originalTitle = document.title;
  let blinkInterval = null;
  let blinkToggle = false;

  function startTitleBlink(count) {
      if (blinkInterval) return;

      blinkInterval = setInterval(() => {
          document.title = blinkToggle
              ? `🔔 (${count}) Đơn hàng mới!`
              : originalTitle;

          blinkToggle = !blinkToggle;
      }, 1000);
  }

  function stopTitleBlink() {
      clearInterval(blinkInterval);
      blinkInterval = null;
      document.title = originalTitle;
  }

  function fetchNotifications() {
      $.ajax({
          url: "{{ url('/admin/notifications/orders') }}",
          method: "GET",
          success: function (res) {
              const container = $('#notifications .message-body');
              container.html('');

              $('#notifications_count .badge.text-bg-primary').text(`${res.count} mới`);

              const bellIcon = document.getElementById('bell-icon');
              if (res.count > 0) {
                  bellIcon.style.color = '#f00';
                  bellIcon.classList.add('bell-shake');

                  startTitleBlink(res.count); // Bắt đầu nhấp nháy

              } else {
                  bellIcon.style.color = '';
                  bellIcon.classList.remove('bell-shake');

                  stopTitleBlink(); // Không có đơn mới thì dừng nhấp nháy
              }

              // Render danh sách đơn hàng
              res.orders.forEach(order => {
                  const html = `
                    <a href="{{ url('/bill-info') }}/${order.order_number}" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                      <span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                        <iconify-icon icon="solar:bag-5-outline"></iconify-icon>
                      </span>
                      <div class="w-75">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 fw-semibold">Đơn hàng mới</h6>
                          <span class="d-block fs-2">${new Date(order.created_at).toLocaleTimeString()}</span>
                        </div>
                        <span class="d-block text-truncate fs-11">Mã #${order.order_number}</span>
                      </div>
                    </a>`;
                  container.append(html);
              });
          }
      });
  }

  // Khi quay lại tab
  document.addEventListener("visibilitychange", function () {
      if (document.visibilityState === 'visible') {
          fetchNotifications();
      }
  });

  // Cập nhật mỗi 30s
  setInterval(fetchNotifications, 30000);

  // Gọi ngay khi load
  document.addEventListener("DOMContentLoaded", function () {
      fetchNotifications();
  });

  // Dừng nhấp nháy khi click chuông
  document.getElementById('drop2').addEventListener('click', function () {
      const bellIcon = document.getElementById('bell-icon');
      bellIcon.classList.remove('bell-shake');
      stopTitleBlink();
  });
</script>
</body>

</html>
<!-- Allow child views to push scripts into this layout -->
@stack('scripts')

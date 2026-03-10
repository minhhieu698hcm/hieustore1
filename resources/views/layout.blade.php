<!DOCTYPE html>
<html lang="vi">

<head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title & Meta Description -->
    <title>@yield('title', 'Hiếu Store - Website chính thức thương hiệu Hiếu Store tại Việt Nam')</title>
    <meta name="description" content="@yield('description', 'Hiếu Store - Website chính thức thương hiệu Hiếu Store tại Việt Nam. Cung cấp cáp HDMI, USB, dock sạc, bộ chuyển đổi, bộ thu phát HDMI không dây, phụ kiện máy tính và nhiều linh kiện công nghệ chính hãng.')">
    <meta name="keywords" content="@yield('keywords', 'Hiếu Store, Hiếu Store, cáp HDMI, USB, bộ thu phát HDMI, dock sạc, bộ chuyển đổi, phụ kiện công nghệ, linh kiện Hiếu Store')">
    <meta name="author" content="Hiếu Store" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta http-equiv="content-language" content="vi-VN">
    <meta name="theme-color" content="#ffffff">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    
    <!-- Alternate for Language -->
    <link rel="alternate" hreflang="vi-VN" href="{{ url()->current() }}" />
    
    <!-- Pagination Hints -->
    @yield('pagination_prev')
    @yield('pagination_next')

    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="Fe6Jgoc5-M4ZJ0GZkNVSVLyW5PYY2G9UA_4ysIJo7Do" />

    <!-- Open Graph (OG) -->
    <meta property="og:title" content="@yield('og_title', 'Hiếu Store - Đại lý phân phối linh kiện Hiếu Store chính hãng tại Việt Nam')" />
    <meta property="og:description" content="@yield('og_description', 'Khám phá linh kiện Hiếu Store chính hãng: cáp HDMI, USB, dock sạc, bộ chuyển đổi và các sản phẩm công nghệ cao cấp tại Hiếu Store.')" />
    <meta property="og:image" content="@yield('og_image', asset('public/frontend/images/default-og-image.jpg'))" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="Hiếu Store" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter_title', 'Hiếu Store - Đại lý phân phối linh kiện Hiếu Store chính hãng tại Việt Nam')" />
    <meta name="twitter:description" content="@yield('twitter_description', 'Hiếu Store chuyên phân phối linh kiện Hiếu Store chính hãng: cáp HDMI, USB, dock sạc, bộ chuyển đổi và nhiều sản phẩm công nghệ khác.')" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('public/frontend/images/default-og-image.jpg'))" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/frontend/images/favicon.ico') }}" type="image/png">

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://code.jquery.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload Hero Image -->
    {{-- <link rel="preload" as="image" fetchpriority="high" href="{{ asset('public/upload/banner_hero/banner-1.webp') }}"> --}}

    <link rel="stylesheet" href="{{ asset('public/frontend/css/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/fonts/font-icons.css') }}">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">  

    <!-- CSS Core -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/styles.css') }}">

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap-select.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('styles')
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <!-- Organization Schema - Brand Info -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Hiếu Store",
      "alternateName": "Hiếu Store",
      "url": "https://khotoolsocial.click/",
      "logo": "{{ asset('public/frontend/images/logo/logo.webp') }}",
      "description": "Đại lý phân phối chính hãng các sản phẩm Hiếu Store tại Việt Nam: cáp HDMI, USB, dock sạc, bộ chuyển đổi, bộ thu phát HDMI không dây, phụ kiện máy tính và linh kiện công nghệ cao cấp",
      "sameAs": [
        "https://www.facebook.com/Hiếu Storevn/",
        "https://www.youtube.com/@Hiếu StoreVNOfficial",
        "https://www.instagram.com/Hiếu Store_official"
      ],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "contactType": "Customer Service",
          "telephone": "+84-989-188-768",
          "contactOption": "TollFree"
        },
        {
          "@type": "ContactPoint",
          "contactType": "Customer Support",
          "email": "hotro@huyphatelectronics.com"
        }
      ],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "444 Nguyễn Tri Phương, Phường Vườn Lài",
        "addressLocality": "Thành phố Hồ Chí Minh",
        "addressRegion": "TP. HCM",
        "postalCode": "",
        "addressCountry": "VN"
      },
      "areaServed": "VN",
      "priceRange": "VND"
    }
    </script>

    <!-- LocalBusiness Schema with Google Maps -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "LocalBusiness",
      "name": "Hiếu Store",
      "image": "{{ asset('public/frontend/images/logo/logo.webp') }}",
      "description": "Đại lý phân phối chính hãng các sản phẩm Hiếu Store tại Việt Nam: cáp HDMI, USB, dock sạc, bộ chuyển đổi, bộ thu phát HDMI không dây, phụ kiện máy tính",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "444 Nguyễn Tri Phương, Phường Vườn Lài",
        "addressLocality": "Thành phố Hồ Chí Minh",
        "addressRegion": "TP. HCM",
        "postalCode": "700000",
        "addressCountry": "VN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "10.7655505",
        "longitude": "106.6678255"
      },
      "url": "https://khotoolsocial.click/",
      "telephone": "+84-989-188-768",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
          "opens": "08:30",
          "closes": "19:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Saturday"],
          "opens": "08:30",
          "closes": "18:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Sunday"],
          "opens": "09:00",
          "closes": "17:00"
        }
      ],
      "sameAs": [
        "https://www.facebook.com/Hiếu Storevn/",
        "https://www.youtube.com/@Hiếu StoreVNOfficial",
        "https://www.instagram.com/Hiếu Store_official"
      ]
    }
    </script>
</head>
<body class="preload-wrapper {{ auth()->check() ? 'logged-in' : 'guest' }}">

    @if(isset($promotion) && $promotion)
        @component('components.promotion-popup', ['promotion' => $promotion])
        @endcomponent
    @endif

    <!-- Toast Notification Container -->
    <div id="toast-container" style="position: fixed; top: 80px; right: 20px; z-index: 9998; max-width: 400px;"></div>

    <div class="preloader">
        <img src="{{ asset('public/frontend/images/favicon.ico') }}" alt="Loading...">
    </div>

<style>
.preloader {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  opacity: 1;
  visibility: visible;
  transition: opacity 0.3s ease, visibility 0.3s ease;
  pointer-events: auto;
}

.preloader.hide {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  z-index: -1;
}

.preloader img {
  width: 64px;
  height: 64px;
  object-fit: contain;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
</style>

<script>
// Hide preloader as soon as possible
document.addEventListener('DOMContentLoaded', function() {
  const preloader = document.querySelector('.preloader');
  if (preloader) {
    preloader.classList.add('hide');
    setTimeout(() => { try { preloader.remove(); } catch(e) {} }, 400);
  }
});

// Fallback if DOM takes too long
setTimeout(function() {
  const preloader = document.querySelector('.preloader');
  if (preloader && !preloader.classList.contains('hide')) {
    preloader.classList.add('hide');
    setTimeout(() => { try { preloader.remove(); } catch(e) {} }, 400);
  }
}, 1500);
</script>

    

    <!-- ...:::: Start Top Bar Section:::... -->
    <div id="wrapper" class="tf-topbar bg-main" style="background-color: #000 !important; border-bottom: 1px solid #ffffff75;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 d-none d-xl-block">
                        <div class="tf-cur">
                            <div class="tf-currencies">
                                <select class="image-select center style-default type-currencies color-white">
                                    <option data-thumbnail="{{ asset('public/frontend/images/icon/lang-vn.webp') }}">VND</option>
                                </select>
                            </div>
                            <div class="tf-languages">
                                <select class="image-select center style-default type-languages color-white">
                                    <option data-thumbnail="{{ asset('public/frontend/images/icon/lang-vn.webp') }}">Vietnam</option>
                                    <!--<option data-thumbnail="{{ asset('public/frontend/images/icon/lang-en.webp') }}">English</option>-->
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="col-xl-6 col-12 text-center position-relative">
                    <div dir="ltr" class="swiper tf-sw-top_bar" data-preview="1" data-space="0" data-loop="true"
                        data-speed="1000" data-auto-play="true" data-delay="2000">
                        <div class="swiper-wrapper">
                            {{-- Hiển thị Banner Text (Info) --}}
                            @if(isset($banner_text) && $banner_text && count($banner_text) > 0)
                                @foreach($banner_text as $text)
                                    <div class="swiper-slide">
                                        <p class="top-bar-text text-line-clamp-1 text-btn-uppercase fw-semibold letter-1 text-white" style="color: #ffffff !important;">
                                            {!! $text->message ?? $text->title ?? 'Chào mừng bạn đến với Hiếu Store!' !!}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <button name="button-close-topbar" aria-label="Đóng thông báo" class="topbar-close-btn d-none" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: transparent; border: none; color: #ffffff; cursor: pointer; font-size: 20px; padding: 5px; z-index: 10;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="col-xl-3 d-none d-xl-block">
                    <ul class="tf-social-icon style-fill style-fill-2 justify-content-end">
                        <li><a href="https://www.facebook.com/Hiếu Storevn/" class="social-facebook"><i class="icon icon-fb" style="color: #ffffff;"></i></a></li>
                        <li><a href="https://www.instagram.com/Hiếu Store_official" class="social-instagram"><i class="icon icon-instagram" style="color: #ffffff;"></i></a></li>
                        <li><a href="https://www.tiktok.com" class="social-tiktok"><i class="icon icon-tiktok" style="color: #ffffff;"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: Start Mobile Header Section:::... -->
    <header id="header" class="mobile-header d-lg-none d-flex align-items-center justify-content-between bg-main px-3 py-3">
        <div class="d-flex align-items-center gap-2">
            <button class="mobile-menu-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Menu">
                <i class="icon icon-categories" style="color: #FFFFFF; font-size: 24px;"></i>
            </button>
            <a href="{{URL::to($logo_main->link)}}" class="mobile-logo"><img
                                    src="{{ asset('public/frontend/images/logo/' . $logo_main->image_url) }}"
                                    alt="Logo Hiếu Store" style="max-height: 50px;margin-left: 12px;"></a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ URL::to('/search') }}" class="mobile-search-btn" data-bs-toggle="modal" data-bs-target="#search">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20.9984 20.9999L16.6484 16.6499" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            @if (Auth::check())
    <!-- Đã đăng nhập -->
    <a href="{{ URL::to('/myaccount') }}" class="mobile-account-btn" aria-label="Tài khoản">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                stroke="#FFFFFF" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="7" r="4"
                stroke="#FFFFFF" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
@else
    <!-- Chưa đăng nhập -->
    <a href="{{ URL::to('/login') }}" class="mobile-account-btn" aria-label="Đăng nhập">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                stroke="#FFFFFF" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="7" r="4"
                stroke="#FFFFFF" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
@endif
        </div>
    </header>
    <!-- ...:::: End Mobile Header Section:::... -->

        <!-- Header -->
        <header id="header" class="header-default header-fullwidth header-style-7 d-none d-lg-block">
            
            <div class="container">
                <div class="row wrapper-header align-items-center">
                    <div class="col-xl-8 col-md-4 col-6">
                        <div class="d-xl-flex align-items-xl-center gap-xl-60">
                           <!-- Logo Header -->
                         @if($logo_main)
                        <div class="header-logo logo-header">
                            <a href="{{URL::to($logo_main->link)}}"><img
                                    src="{{ asset('public/frontend/images/logo/' . $logo_main->image_url) }}"
                                    alt="Logo Hiếu Store"></a>
                        </div>
                        @endif
                            <div class="d-none d-xl-block">
                                <nav class="box-navigation text-center">
                                    <ul class="box-nav-ul d-flex align-items-center justify-content-center">
                                        <li class="menu-item active">
                                            <a href="{{ URL::to('/') }}" class="item-link">Trang chủ</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ URL::to('/san-pham') }}" class="item-link">Sản phẩm<i class="icon icon-arrow-down"></i></a>
                                            <div class="sub-menu mega-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        
                                                                <div class="col-lg-4">
                                                                    {{-- <div class="mega-menu-images">
                                                                        <img
                                                                        src="{{ asset('public/upload/category/' . $category->category_image) }}"
                                                                        alt="Logo Hiếu Store">
                                                                    </div> --}}
                                                                    <div class="mega-menu-item">
                                                                        <a href="{{ URL::to('/san-pham') }}" class="menu-heading">Danh Mục</a>
                                                                            <ul class="menu-list" style="margin-top: 8px;">
                                                                                @foreach ($categories_col_1 as $category)
                                                                                    <li>
                                                                                        <a href="{{ url('/san-pham/' . $category->category_slug) }}" class="menu-link-text">
                                                                                            {{ $category->category_name }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    {{-- <div class="mega-menu-images">
                                                                        <img
                                                                        src="{{ asset('public/upload/category/' . $category->category_image) }}"
                                                                        alt="Logo Hiếu Store">
                                                                    </div> --}}
                                                                    <div class="mega-menu-item">
                                                                            <a href="{{ URL::to('/san-pham') }}" class="menu-heading">Danh Mục</a>
                                                                            <ul class="menu-list" style="margin-top: 8px;">
                                                                                @foreach ($categories_col_2 as $category)
                                                                                    <li>
                                                                                        <a href="{{ url('/san-pham/' . $category->category_slug) }}" class="menu-link-text">
                                                                                            {{ $category->category_name }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    {{-- <div class="mega-menu-images">
                                                                        <img
                                                                        src="{{ asset('public/upload/category/' . $category->category_image) }}"
                                                                        alt="Logo Hiếu Store">
                                                                    </div> --}}
                                                                    <div class="mega-menu-item">
                                                                            <a href="{{ URL::to('/san-pham') }}" class="menu-heading">Phân loại</a>
                                                                            <ul class="menu-list" style="margin-top: 8px;">
                                                                                <li><a href="{{ URL::to('/san-pham?sort_by=newest&page=1') }}" class="menu-link-text">Sản
                                                                phẩm mới nhất</a></li>
                                                        <li><a
                                                                href="{{ URL::to('/san-pham?sort_by=best_selling&page=1') }}" class="menu-link-text">Sản
                                                                phẩm bán chạy</a></li>
                                                        <li><a href="{{ URL::to('/san-pham?sort_by=on_sale&page=1') }}" class="menu-link-text">Sản
                                                                phẩm Sale</a></li>
                                                        <li><a
                                                                href="{{ URL::to('/san-pham?sort_by=price_asc&page=1') }}" class="menu-link-text">Giá
                                                                thấp - cao</a></li>
                                                        <li><a
                                                                href="{{ URL::to('/san-pham?sort_by=price_desc&page=1') }}" class="menu-link-text">Giá
                                                                cao - thấp</a></li>
                                                                            </ul>
                                                                    </div>
                                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="menu-item position-relative">
                                            <a href="#" class="item-link">Về chúng tôi<i class="icon icon-arrow-down"></i></a>
                                            <div class="sub-menu mega-menu" style="padding-top:4px;padding-bottom:4px">
                                                <ul class="menu-list">
                                                    <li><a href=""
                                                                            class="menu-link-text">Giới thiệu</a>
                                                                    </li>
                                                    <li><a href="" class="menu-link-text">Liên hệ</a>
                                                    </li>
                                                    <li><a href="{{ URL::to('/policy-all') }}" class="menu-link-text">Chính sách</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item position-relative">
                                            <a href="{{ URL::to('/tin-tuc') }}" class="item-link">Tin tức</a>
                                        </li>
                                        <li class="menu-item position-relative">
                                            <a href="#" class="item-link">Driver</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-3">
                        <div class="d-flex justify-content-end align-items-center gap-16 gap-xl-24">
                            <ul class="nav-icon d-flex justify-content-end align-items-center">
                                <li class="nav-search">
                                    <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                            <span class="br-line type-vertical d-none d-sm-block bg-line"></span>
                            <ul class="nav-icon d-flex justify-content-end align-items-center">
                                <li class="nav-account">
                                    <a href="#" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <div class="dropdown-account dropdown-login">
                                        @if (Auth::check())
                                            <!-- Đã đăng nhập -->
                                            <div class="sub-top">
                                                <a href="{{ URL::to('/myaccount') }}" class="tf-btn btn-reset">
                                                    Tài khoản của tôi
                                                </a>
                                            </div>
                                            <div class="sub-bot">
                                                <form action="{{ URL::to('/logout') }}" method="POST" class="text-center">
                                                    @csrf
                                                    <button type="submit" class="tf-btn btn-logout">
                                                        Đăng xuất
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- Chưa đăng nhập -->
                                            <div class="sub-top">
                                                <a href="{{ URL::to('/login') }}" class="tf-btn btn-reset">
                                                    Đăng nhập
                                                </a>
                                            </div>
                                            <div class="sub-bot">
                                                <p class="text-center">
                                                    Bạn chưa có tài khoản?
                                                    <a class="register-button" href="{{ URL::to('/register') }}">
                                                        Đăng ký
                                                    </a>
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                </li>
                                <li class="nav-cart">
                                    <a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span class="count-box">1</span>
                                    </a>
                                </li>
                                <li class="nav-order">
                                    <a href="#search-order" data-bs-toggle="modal" class="nav-icon-item">
                                        
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3.17004 7.43994L12 12.5499L20.77 7.46991" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 21.6099V12.5399" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21.61 12.83V9.17C21.61 7.79 20.62 6.11002 19.41 5.44002L14.07 2.48C12.93 1.84 11.07 1.84 9.92999 2.48L4.59 5.44002C3.38 6.11002 2.39001 7.79 2.39001 9.17V14.83C2.39001 16.21 3.38 17.89 4.59 18.56L9.92999 21.52C10.5 21.84 11.25 22 12 22C12.75 22 13.5 21.84 14.07 21.52" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M19.2 21.4C20.9673 21.4 22.4 19.9673 22.4 18.2C22.4 16.4327 20.9673 15 19.2 15C17.4327 15 16 16.4327 16 18.2C16 19.9673 17.4327 21.4 19.2 21.4Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M23 22L22 21" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    
                                </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
        
        @yield('content')
        
        
        <!-- Footer -->
        <footer class="footer-section section-top-gap-100">
        <!-- Start Footer Top Area -->
        <div class="footer-top section-inner-bg">
            <div class="container" style="padding-bottom:25px">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5" style="margin-top: -25px;">
                        <div class="footer-widget footer-widget-contact">
                            <div class="footer-logo">
								@if($logo_footer)
                                <a href="{{ $logo_footer->link }}" target="_blank"><img
                                        src="{{ asset('public/frontend/images/logo/'. $logo_footer->image_url) }}"
                                        alt="" class="img-fluid" style="width: 220px;"></a>
								@endif
                            </div>
                            <div class="footer-contact">
                                <div class="customer-support">
                                    <div class="customer-support-icon">
                                        <img src="{{ asset('public/frontend/images/icon/support-icon.webp') }}" alt="">
                                    </div>
                                    <div class="customer-support-text">
                                        <span>Hotline</span>
                                        <a class="customer-support-text-phone" href="tel:0903390721">0903390721</a>
                                    </div>
                                </div>
                                <div class="customer-support">
                                    <div class="customer-support-icon">
                                        <img src="{{ asset('public/frontend/images/icon/mail-support-icon.webp') }}" alt="">
                                    </div>
                                    <div class="customer-support-text">
                                        <span>Mail Support</span>
                                        <a class="customer-support-text-phone" href="https://mail.google.com/mail/?view=cm&to=minhhieu698hcm@gmail.com">minhhieu698hcm@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-7" id="footer-mid">
                        <h3 class="footer-widget-title">Mạng xã hội</h3>
                        <div class="footer-widget footer-widget-subscribe" style="padding-bottom: 10px; border-bottom: 1px solid #ffffff75;"> 
                            <ul class="tf-social-icon style-fill style-fill-2 justify-content-start" style="gap:24px">
                                <li><a href="#" class="social-facebook" style="width:42px;height:42px;border-color: #000000;border: 1px solid rgb(0 0 0 / 50%);"><i class="icon icon-fb" style="color: #000000; font-size: 24px;"></i></a></li>
                                <li><a href="#" class="social-instagram" style="width:42px;height:42px;border-color: #000000;border: 1px solid rgb(0 0 0 / 50%);"><i class="icon icon-instagram" style="color: #000000; font-size: 24px;"></i></a></li>
                                <li><a href="#" class="social-tiktok" style="width:42px;height:42px;border-color: #000000;border: 1px solid rgb(0 0 0 / 50%);"><i class="icon icon-tiktok" style="color: #000000; font-size: 24px;"></i></a></li>
                            </ul>
                        </div>
                        
                        <p style="margin-top: 10px;"><strong>Văn phòng:</strong> 102 Phan Văn Hớn, Phường Đông Hưng Thuận, TP. Hồ Chí Minh, Việt Nam.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6" >
                        <div class="footer-widget footer-widget-menu">
                            <h3 class="footer-widget-title">Thông tin</h3>
                            <div class="footer-menu">
                                <ul class="footer-menu-nav">
                                    <li><a href="">Về chúng tôi</a></li>
                                    <li><a href="">Liên hệ</a></li>
                                    <li><a href="{{ URL::to('/san-pham') }}">Sản phẩm</a></li>
                                </ul>
                                <ul class="footer-menu-nav">
                                    <li><a href="{{ URL::to('/policy-all') }}">Chính sách HiếuStore</a></li>
                                    <li><a href="https://mail.google.com/mail/?view=cm&to=minhhieu698hcm@gmail.com&su=Chào%20Hiếu Store%20&body=Tôi%20quan%20tâm%20đến%20mặt%20hàng%3A%0AHãy%20tư%20vấn%20cho%20tôi%20qua%20số%3A"
                                            target="_blank">Gửi Hỗ Trợ Ngay</a></li>
                                    @if (Auth::check())
                                        <li><a href="{{ URL::to('/myaccount') }}">Tài khoản của tôi</a></li>
                                    @else <!-- Nếu người dùng chưa đăng nhập -->
                                        <li><a href="{{ URL::to('/login') }}">Đăng nhập</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div id='footer-image-payment'>
                                <img src="{{ asset('public/frontend/images/icon/payment-icon.webp') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Footer Top Area -->
            <!-- Start Footer Bottom Area -->
            <div class="footer-bottom" id="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-10 col-md-6">
                            <div class="copyright-area">
                               <p class="copyright-area-text">
                                    ©2025 - All Rights Reserved. Developed by
                                    <a class="copyright-link" href="https://www.facebook.com/truong.cong.tan.nam" target="blank">Kirse</a>
                                    <a style="color:#ff0000">x</a>
                                    <a class="copyright-link" href="https://www.facebook.com/minhhieunguyen2502/" target="blank">Kami</a>
                                    <a href="https://mail.google.com/mail/?view=cm&to=minhhieu698hcm@gmail.com,tannam151197@gmail.com&su=B%C3%A1o%20l%E1%BB%97i%20web%20Hiếu StoreVN&body=Ch%C3%A0o%20Kami%20v%C3%A0%20Kirse%0A%0AT%C3%B4i%20mu%E1%BB%91n%20b%C3%A1o%20c%C3%A1o%20l%E1%BB%97i%20v%E1%BB%81%20website"
                                    class="btn-report"
                                    target="_blank">
                                    BÁO LỖI
                                    </a>
                                    <br>Địa chỉ: Số 102 Phan Văn Hớn, Phường Đông Hưng Thuận, TP. Hồ Chí Minh, Việt Nam<br>©2024 - TEAM 2K
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6" style="display: flex; justify-content: center;align-items: center; height: 100%;">
                            <div id='footer-bocongthuong'>
                           <a href='#' target="blank"><img
                                        src="{{ asset('public/frontend/images/icon/logoSaleNoti.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Footer Bottom Area -->
		</div>
        </footer>
        <!-- /Footer -->
	
<button id="scrollTopBtn" aria-label="Lên đầu trang"></button>
	@include('components.chat-widget')

        <!-- toolbar-bottom -->
        <div class="tf-toolbar-bottom">
            <div class="toolbar-item">
                <a href="{{ URL::to('/san-pham') }}">
                    <div class="toolbar-icon">
                        <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.125 3.125H4.375C4.04348 3.125 3.72554 3.2567 3.49112 3.49112C3.2567 3.72554 3.125 4.04348 3.125 4.375V8.125C3.125 8.45652 3.2567 8.77446 3.49112 9.00888C3.72554 9.2433 4.04348 9.375 4.375 9.375H8.125C8.45652 9.375 8.77446 9.2433 9.00888 9.00888C9.2433 8.77446 9.375 8.45652 9.375 8.125V4.375C9.375 4.04348 9.2433 3.72554 9.00888 3.49112C8.77446 3.2567 8.45652 3.125 8.125 3.125ZM8.125 8.125H4.375V4.375H8.125V8.125ZM15.625 3.125H11.875C11.5435 3.125 11.2255 3.2567 10.9911 3.49112C10.7567 3.72554 10.625 4.04348 10.625 4.375V8.125C10.625 8.45652 10.7567 8.77446 10.9911 9.00888C11.2255 9.2433 11.5435 9.375 11.875 9.375H15.625C15.9565 9.375 16.2745 9.2433 16.5089 9.00888C16.7433 8.77446 16.875 8.45652 16.875 8.125V4.375C16.875 4.04348 16.7433 3.72554 16.5089 3.49112C16.2745 3.2567 15.9565 3.125 15.625 3.125ZM15.625 8.125H11.875V4.375H15.625V8.125ZM8.125 10.625H4.375C4.04348 10.625 3.72554 10.7567 3.49112 10.9911C3.2567 11.2255 3.125 11.5435 3.125 11.875V15.625C3.125 15.9565 3.2567 16.2745 3.49112 16.5089C3.72554 16.7433 4.04348 16.875 4.375 16.875H8.125C8.45652 16.875 8.77446 16.7433 9.00888 16.5089C9.2433 16.2745 9.375 15.9565 9.375 15.625V11.875C9.375 11.5435 9.2433 11.2255 9.00888 10.9911C8.77446 10.7567 8.45652 10.625 8.125 10.625ZM8.125 15.625H4.375V11.875H8.125V15.625ZM15.625 10.625H11.875C11.5435 10.625 11.2255 10.7567 10.9911 10.9911C10.7567 11.2255 10.625 11.5435 10.625 11.875V15.625C10.625 15.9565 10.7567 16.2745 10.9911 16.5089C11.2255 16.7433 11.5435 16.875 11.875 16.875H15.625C15.9565 16.875 16.2745 16.7433 16.5089 16.5089C16.7433 16.2745 16.875 15.9565 16.875 15.625V11.875C16.875 11.5435 16.7433 11.2255 16.5089 10.9911C16.2745 10.7567 15.9565 10.625 15.625 10.625ZM15.625 15.625H11.875V11.875H15.625V15.625Z"
                                fill="#4D4E4F" />
                        </svg>
                    </div>
                    <div class="toolbar-label">Mua sắm</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#search" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.9419 17.058L14.0302 13.1471C15.1639 11.7859 15.7293 10.04 15.6086 8.27263C15.488 6.50524 14.6906 4.85241 13.3823 3.65797C12.074 2.46353 10.3557 1.81944 8.58462 1.85969C6.81357 1.89994 5.12622 2.62143 3.87358 3.87407C2.62094 5.12671 1.89945 6.81406 1.8592 8.5851C1.81895 10.3561 2.46304 12.0745 3.65748 13.3828C4.85192 14.691 6.50475 15.4884 8.27214 15.6091C10.0395 15.7298 11.7854 15.1644 13.1466 14.0306L17.0575 17.9424C17.1156 18.0004 17.1845 18.0465 17.2604 18.0779C17.3363 18.1094 17.4176 18.1255 17.4997 18.1255C17.5818 18.1255 17.6631 18.1094 17.739 18.0779C17.8149 18.0465 17.8838 18.0004 17.9419 17.9424C17.9999 17.8843 18.046 17.8154 18.0774 17.7395C18.1089 17.6636 18.125 17.5823 18.125 17.5002C18.125 17.4181 18.1089 17.3367 18.0774 17.2609C18.046 17.185 17.9999 17.1161 17.9419 17.058ZM3.12469 8.75018C3.12469 7.63766 3.45459 6.55012 4.07267 5.6251C4.69076 4.70007 5.56926 3.9791 6.5971 3.55336C7.62493 3.12761 8.75593 3.01622 9.84707 3.23326C10.9382 3.4503 11.9405 3.98603 12.7272 4.7727C13.5138 5.55937 14.0496 6.56165 14.2666 7.6528C14.4837 8.74394 14.3723 9.87494 13.9465 10.9028C13.5208 11.9306 12.7998 12.8091 11.8748 13.4272C10.9497 14.0453 9.86221 14.3752 8.74969 14.3752C7.25836 14.3735 5.82858 13.7804 4.77404 12.7258C3.71951 11.6713 3.12634 10.2415 3.12469 8.75018Z"
                                fill="#4D4E4F" />
                        </svg>
                    </div>
                    <div class="toolbar-label">Tìm kiếm</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#shoppingCart" data-bs-toggle="modal" style="position: relative;">
                    <div class="toolbar-icon">
                        <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.75 8.23389V4.48389C13.75 3.48932 13.3549 2.5355 12.6517 1.83224C11.9484 1.12897 10.9946 0.733887 10 0.733887C9.00544 0.733887 8.05161 1.12897 7.34835 1.83224C6.64509 2.5355 6.25 3.48932 6.25 4.48389V8.23389M3.4375 6.35889H16.5625L17.5 17.6089H2.5L3.4375 6.35889Z"
                                stroke="#4D4E4F" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="count-box" style="position: absolute; top: -8px; right: -18px; background-color: #ff4444; color: #fff; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 11px; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">1</span>
                    </div>
                    <div class="toolbar-label">Giỏ hàng</div>
                </a>
            </div>
        </div>
        <!-- /toolbar-bottom -->

    </div>

    <!-- search -->
    <div class="modal fade modal-search" id="search">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
            <div class="modal-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 style="margin: 0;">Tìm kiếm sản phẩm</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form class="form-search" id="search-form">
                    <fieldset class="text" style="position: relative; width: 100%;">
                        <input type="text" 
                            placeholder="Nhập tên sản phẩm, mã sản phẩm..." 
                            class="search-input" 
                            id="keywords" 
                            name="query" 
                            tabindex="0" 
                            value=""
                            aria-required="true">
                    </fieldset>
                    <button class="search__submit" type="button">
                        <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.35 21.0004L17 16.6504" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </form>
                <!-- Autocomplete Results -->
                <div id="search_ajax" style="border: 1px solid rgb(68, 68, 68); padding-top: 0;border-radius: 1%;">
                    <ul id="autocomplete-results" style="list-style: none; padding: 0; margin: 0;"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /search -->
    <!-- search order -->
<div class="modal fade modal-search" id="search-order">
    <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
        <div class="modal-content">

            <div class="d-flex justify-content-between align-items-center">
                <h5>Tìm kiếm đơn hàng</h5>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>

            <form class="form-search" id="search-order-form">
                <fieldset style="position:relative;width:100%">
                    <input type="text"
                        id="keywords_order"
                        class="search-input"
                        placeholder="Nhập mã đơn hàng...">
                </fieldset>

                <button class="search__submit" type="button">
                        <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.35 21.0004L17 16.6504" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
            </form>

            <!-- Result -->
            <div id="search_order_ajax" style="display:none;border:1px solid #444;border-radius:4px;">
                <ul id="autocomplete-results-order" style="list-style:none;margin:0;padding:0"></ul>
            </div>

        </div>
    </div>
</div>

    <!-- /search order-->

    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu" data-bs-backdrop="false" data-bs-scroll="true">
         <!-- Start Offcanvas Header -->
        <div class="offcanvas-header d-flex justify-content-start" style="border-bottom: 1px solid #2b2b2b;background-color: #ff0000;">
            <a href="{{URL::to($logo_main->link)}}" class="mobile-logo"><img
                                    src="{{ asset('public/frontend/images/logo/' . $logo_main->image_url) }}"
                                    alt="Logo Hiếu Store" style="max-height: 50px;margin-left: 12px;"></a>
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close" style="right:15px!important"></span>
        </div> <!-- End Offcanvas Header -->
        
        <div class="mb-canvas-content">
            <div class="mb-body">
                <div class="mb-content-top">
    <ul class="nav-ul-mb" id="wrapper-menu-navigation">

        {{-- Trang chủ --}}
        <li class="nav-mb-item active">
            <a href="{{ URL::to('/') }}" class="mb-menu-link">
                <span>Trang chủ</span>
            </a>
        </li>

        {{-- Sản phẩm --}}
        <li class="nav-mb-item">
            <a href="#dropdown-menu-products" class="collapsed mb-menu-link"
               data-bs-toggle="collapse">
                <span>Sản phẩm</span>
                <span class="btn-open-sub"></span>
            </a>

            <div id="dropdown-menu-products" class="collapse">
                <ul class="sub-nav-menu">
                    @foreach ($categories_col_1 as $category)
                        <li class="nav-mb-item">
                            <a href="{{ url('/san-pham/' . $category->category_slug) }}" class="mb-menu-link">
                                {{ $category->category_name }}
                            </a>
                        </li>
                    @endforeach
                    @foreach ($categories_col_2 as $category)
                        <li class="nav-mb-item">
                            <a href="{{ url('/san-pham/' . $category->category_slug) }}" class="mb-menu-link">
                                {{ $category->category_name }}
                            </a>
                        </li>
                    @endforeach                            
                </ul>
            </div>
        </li>
{{-- Về chúng tôi --}}
        <li class="nav-mb-item">
            <a href="#dropdown-menu-about-us" class="collapsed mb-menu-link"
               data-bs-toggle="collapse">
                <span>Về chúng tôi</span>
                <span class="btn-open-sub"></span>
            </a>

            <div id="dropdown-menu-about-us" class="collapse">
                <ul class="sub-nav-menu">
                    <li class="nav-mb-item">
            <a href="{{ URL::to('/gioi-thieu') }}" class="mb-menu-link">
                <span>Giới thiệu</span>
            </a>
        </li>
        <li class="nav-mb-item">
            <a href="{{ URL::to('/lien-he') }}" class="mb-menu-link">
                <span>Liên hệ</span>
            </a>
        </li>
        <li class="nav-mb-item">
            <a href="{{ URL::to('/policy-all') }}" class="mb-menu-link">
                <span>Chính sách</span>
            </a>
        </li>
                </ul>
            </div>
        </li>
        {{-- Tin tức --}}
        <li class="nav-mb-item">
            <a href="{{ URL::to('/tin-tuc') }}" class="mb-menu-link">
                <span>Tin tức</span>
            </a>
        </li>

        {{-- Driver --}}
        <li class="nav-mb-item">
            <a href="{{ URL::to('/driver') }}" class="mb-menu-link">
                <span>Driver</span>
            </a>
        </li>
        <li class="nav-mb-item">
            <a href="#dropdown-menu-search" class="collapsed mb-menu-link"
               data-bs-toggle="collapse">
                <span>Tìm kiếm</span>
                <span class="btn-open-sub"></span>
            </a>

            <div id="dropdown-menu-search" class="collapse">
                <ul class="sub-nav-menu">
                       <li class="nav-mb-item nav-mb-search-order" style="border-bottom: none;"> 
            <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                <span class="nav-mb-text">Tìm sản phẩm &nbsp;</span>
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M21.35 21.0004L17 16.6504" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </li>
        <li class="nav-mb-item nav-mb-search-order">
            <a href="#search-order" data-bs-toggle="modal" class="nav-icon-item">
                <span class="nav-mb-text">Tìm đơn hàng &nbsp;</span>
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M21.35 21.0004L17 16.6504" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </li>
                </ul>
            </div>
        </li>

        


    </ul>
</div>

                <div class="mb-other-content">
    <div class="group-icon">

        @if (Auth::check())
            <!-- ĐÃ ĐĂNG NHẬP -->
            <a href="{{ URL::to('/myaccount') }}" class="site-nav-icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 19v-1.25c0-2.071-1.919-3.75-4.286-3.75h-3.428C7.919 14 6 15.679 6 17.75V19m9-11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Tài khoản của tôi
            </a>
        @else
            <!-- CHƯA ĐĂNG NHẬP -->
            <a href="{{ URL::to('/register') }}" class="site-nav-icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11h3m0 0h3m-3 0v3m0-3V8m-3 11v-1.25c0-2.071-1.919-3.75-4.286-3.75H7.286C4.919 14 3 15.679 3 17.75V19m9-11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Đăng ký
            </a>

            <a href="{{ URL::to('/login') }}" class="site-nav-icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 19v-1.25c0-2.071-1.919-3.75-4.286-3.75h-3.428C7.919 14 6 15.679 6 17.75V19m9-11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Đăng nhập
            </a>
        @endif

    </div>

    <div class="mb-contact">
        <p class="text-caption-1">
            444 Nguyễn Tri Phương, Phường Vườn Lài, TP. Hồ Chí Minh, Việt Nam.
        </p>
        <a href="{{ URL::to('/lien-he') }}" class="tf-btn-default text-btn-uppercase">
            Địa chỉ <i class="icon-arrowUpRight"></i>
        </a>
    </div>

    <div class="mb-notice">
        <a href="{{ URL::to('/lien-he') }}" class="text-need">Bạn cần hỗ trợ?</a>
    </div>

    <ul class="mb-info">
        <li>
            <i class="icon icon-mail"></i>
            <p>hotro@huyphatelectronics.com</p>
        </li>
        <li>
            <i class="icon icon-phone"></i>
            <p>(08) 66638328</p>
        </li>
    </ul>
</div>

            </div>
            <div class="mb-bottom">
                <div class="bottom-bar-language">
                    <div class="tf-currencies">
                        <select class="image-select center style-default type-currencies">
                            <option data-thumbnail="{{ asset('public/frontend/images/icon/lang-vn.webp') }}">VND</option>
                        </select>
                    </div>
                    <div class="tf-languages">
                        <select class="image-select center style-default type-languages">
                            <option data-thumbnail="{{ asset('public/frontend/images/icon/lang-vn.webp') }}">Vietnam</option>
                            <!--<option data-thumbnail="{{ asset('public/frontend/images/icon/lang-en.webp') }}">English</option>-->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /mobile menu -->


    <!-- quickView -->
    <div class="modal fullRight fade modal-quick-view" id="quickView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                <div class="tf-quick-view-image">
                    <div class="wrap-quick-view">
                        <div class="wrapper-scroll-quickview modal-product-image-large">
                            <!-- Images will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="modal-product-image-thumb" style="display: flex; gap: 9px; padding: 8px 0; flex-wrap: wrap; justify-content: center;">
                        <!-- Thumbnails will be populated by JavaScript -->
                    </div>
                </div>
                <div class="wrap" style="padding-left: 24px; padding-right: 24px;">
                    <div class="header">
                        <h5 class="title"></h5>
                        
                    </div>
                    <div class="tf-product-info-list" >
                        <div class="tf-product-info-heading" style="border-bottom: 1px solid #2b2b2b;">
                            <div class="tf-product-info-name" style="display: flex;margin-top: 10px;align-items: center;gap: 15px;border-bottom: 1px solid #2b2b2b; padding-bottom: 10px;width: 100%;">
                                <div class="product_code text text-btn-uppercase" style="color: red; font-size:16px; font-weight: 600;"><!-- Product Code --></div>
                                <div class="sub">
                                    <div class="product-stock-status tf-product-info-rate">
                                        <!-- Stock Status -->
                                    </div>
                                </div>
                            </div>
                            <div class="tf-product-info-desc" style="margin-top: 8px; ">
                                <div class="price font-2" style="margin-top: 0; font-size: 20px; font-weight: 600; color: #000;">
                                    <!-- Price -->
                                </div>
                                <div class="warranty-VAT">
                                    <span class="VAT badge rounded-pill bg-danger" style="font-size: 13px">Full
                                            VAT</span>
                                    <span class="warranty-badge badge rounded-pill bg-danger" style="font-size: 13px; color: #fff; display: inline-flex; align-items: center; justify-content: center; gap: 5px; height: 32px; padding: 0 12px;">
                                        <i class="fa-solid fa-shield"></i>
                                        <span class="warranty-text">Bảo hành 24 tháng</span>
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tf-product-info-choose-option">
                            <div class="tf-product-info-quantity">
                                <div class="title_mb_12">Số lượng:</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity btn-decrease">-</span>
                                    <input class="quantity-product" id="quickview-quantity" type="text" name="number" value="1">
                                    <span class="btn-quantity btn-increase">+</span>
                                </div>
                            </div>

                            <div class="dropdown-attribute" style="display: none;">
                                <label style="font-weight: 700; font-size: 16px; display: block; margin-bottom: 8px;">Phân loại:</label>
                                <h1 class="animated-button1" style="cursor: pointer; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #f9f9f9; margin-bottom: 8px; font-size: 14px; min-height: 28px;">
                                    Chọn phân loại
                                </h1>
                                <ul style="list-style: none; padding: 0; margin: 0; max-height: 250px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px; background: #fff; display: none;">
                                    <!-- Attributes will be populated by JavaScript -->
                                </ul>
                            </div>

                            <div>
                                <div class="tf-product-info-by-btn mb_10">
                                     <div class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 product-details-meta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview -->
    <!-- /quickView -->

    <!-- shoppingCart Modal -->
    <div class="modal fade" id="shoppingCart" tabindex="-1" aria-labelledby="shoppingCartLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="shoppingCartLabel" style="font-size: 22px;">GIỎ HÀNG</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto; padding: 0;">
                    <!-- Free Shipping Alert -->
                    <div class="alert mx-3 mt-3 mb-3 rounded-3 d-none" id="freeShippingAlert" role="alert" style="background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%); border: 1px solid #43a047; color: #81c784; display: flex; align-items: center; gap: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <strong style="font-size: 14px;">Chúc mừng! Bạn được miễn phí vận chuyển!</strong>
                    </div>

                    <!-- Cart Items List -->
                    <ul class="offcanvas-cart" style="list-style: none; padding: 0; margin: 0;">
                        <!-- Sản phẩm sẽ được render ở đây -->
                    </ul>

                    <!-- Empty Cart Message -->
                    <div class="text-center py-5" id="emptyCart" style="display: none;">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="opacity: 0.3; margin-bottom: 15px; color: #999;">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <p style="color: #888; font-size: 16px; font-weight: 500;">Giỏ hàng của bạn đang trống</p>
                    </div>
                </div>

                <!-- Cart Summary & Actions -->
                <div class="modal-footer" style="flex-direction: column; gap: 0; padding: 0;  border-top-color: #333 !important; pointer-events: auto; position: relative; z-index: 1050;">
                    <div class="w-100 p-3" style=" border-bottom: 1px solid #333; pointer-events: auto;">
                        <div class="tf-product-info-total-price">
                            <div class="flex-between mb-3" >
                                <span class="label" style="font-weight: 500; color: #aaa;">Tạm tính</span>
                                <span class="tf-product-info-price-value offcanvas-cart-subtotal-price fw-bold" style="font-size: 20px; color: #2b2b2b;">0 đ</span>
                            </div>
                            <hr style="margin: 12px 0; border: none; border-top: 1px solid #333;">
                            <div class="flex-between">
                                <span class="label fw-bold" style="font-weight: 700; color: #fff; font-size: 16px;">Tổng cộng</span>
                                <span class="tf-product-info-price-value offcanvas-cart-total-price-value fw-bold" style="font-size: 20px; color: #ff4444;">0 đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 px-3 pb-3" style="padding-top: 12px; pointer-events: auto;">
                        {{-- <a href="{{ URL::to('gio-hang') }}" class="tf-btn w-100 btn-fill radius-4 justify-content-center mb-2 checkout-btn-cart" style="padding: 12px; background-color: #333; color: #fff; border: 1px solid #555; text-decoration: none; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: all 0.3s ease; cursor: pointer; pointer-events: auto; z-index: 1051;">
                            <span class="text" style="font-size: 14px;">XEM GIỎ HÀNG</span>
                        </a> --}}
                        <a href="{{ URL::to('/thanh-toan') }}"
                        class="tf-btn w-100 btn-fill radius-4 justify-content-center checkout-btn-checkout"
                        style="padding: 12px; background: linear-gradient(135deg, #ff3c3c 0%, #dd0000 100%); text-decoration: none; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: all 0.3s ease; cursor: pointer; border: 1px solid #333;">
                            <span class="text" style="font-size: 16px;">TIẾN HÀNH THANH TOÁN</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /shoppingCart Modal -->

     <!-- JavaScript -->
    
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="{{ asset('public/frontend/js/carousel.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
    <script src="{{ asset('public/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/multiple-modal.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/product-gallery-sync.js') }}"></script>

    @stack('scripts')




    <!--=================================================================================================================================================-->
    <!--================================================================== JS Function ==================================================================-->
    <!--=================================================================================================================================================-->

     <!-- JS Filter Product + Pagonation -->
    <script>
        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        }

        $(document).ready(function () {
            var currentUrl = window.location.pathname;

            if (currentUrl.includes('/san-pham')) {
                var filterCategory = getUrlParameter('filter_category') || '';
                var sortBy = getUrlParameter('sort_by') || 'newest';
                var page = getUrlParameter('page') || 1;

                // Kiểm tra xem có phải URL slug hay không
                var pathParts = currentUrl.split('/');
                var categorySlug = null;
                
                // Tìm slug ở vị trí sau '/san-pham/'
                if (pathParts.includes('san-pham') && pathParts.length > pathParts.indexOf('san-pham') + 1) {
                    categorySlug = pathParts[pathParts.indexOf('san-pham') + 1];
                }

                // Nếu là URL slug, tích checkbox tương ứng
                if (categorySlug && !filterCategory) {
                    $('input[type="checkbox"][name="category"][data-slug="' + categorySlug + '"]').prop('checked', true);
                    updateSortDropdown(sortBy);
                } else if (filterCategory) {
                    // Nếu có filter_category parameter, áp dụng từ URL
                    applyFilterCategoryFromUrl(filterCategory);
                    updateSortDropdown(sortBy);
                    filterProducts(page, filterCategory, sortBy);
                } else {
                    // Trường hợp không có filter, chỉ cập nhật sort
                    updateSortDropdown(sortBy);
                }
            }

            // Sự kiện thay đổi sắp xếp (sort_by)
            $('#sort_by').change(function () {
                var selectedSort = $(this).val();
                updateSortDropdown(selectedSort);
                filterProducts(1);
            });

            // Xử lý khi chọn danh mục sản phẩm (checkbox)
            $('input[type="checkbox"][name="category"]').change(function () {
                if (currentUrl.includes('/san-pham')) {
                    filterProducts(1);
                }
            });
            // ================= RESET FILTER =================
$(document).on('click', '.reset-attribute-filter, #reset-filter', function (e) {
    e.preventDefault();

    // 1. Bỏ check toàn bộ checkbox
    $('input[type="checkbox"][name="category"]').prop('checked', false);

    // 2. Reset sort về mặc định
    $('#sort_by').val('newest');

    updateSortDropdown('newest');

    // 3. Reset URL về trang tổng
    var baseUrl = "{{ url('/san-pham') }}";
    window.history.pushState(null, null, baseUrl);

    // 4. Reload sản phẩm bằng AJAX
    filterProducts(1, '', 'newest');
});
            // Xử lý khi nhấn vào phân trang
            $(document).on('click', '.pagination-link', function (e) {
                e.preventDefault();
                if (currentUrl.includes('/san-pham')) {
                    var page = $(this).data('page');
                    var currentSortBy = getUrlParameter('sort_by') || $('#sort_by').val() || 'newest';
                    filterProducts(page, '', currentSortBy);
                }
            });

            function filterProducts(page = 1, filterCategory = '', sortBy = '') {
                var selectedCategories = [];
                var selectedSlugs = [];

                if (!filterCategory) {
                    $('input[type="checkbox"][name="category"]:checked').each(function () {
                        selectedCategories.push($(this).attr('id'));
                        selectedSlugs.push($(this).attr('data-slug'));
                    });
                } else {
                    selectedCategories = filterCategory.split(',');
                }

                sortBy = sortBy || $('#sort_by').val() || 'newest';
                
                // Nếu chỉ có 1 danh mục được chọn, hướng tới URL SEO friendly
                if (selectedSlugs.length === 1 && selectedSlugs[0]) {
                    var newUrl = "{{ url('/san-pham') }}/" + selectedSlugs[0];
                    var params = [];
                    
                    // Chỉ thêm sort_by nếu không phải là giá trị default (newest)
                    if (sortBy && sortBy !== 'newest') {
                        params.push("sort_by=" + sortBy);
                    }
                    // Chỉ thêm page nếu không phải trang 1
                    if (page && page != 1) {
                        params.push("page=" + page);
                    }
                    
                    if (params.length > 0) {
                        newUrl += "?" + params.join('&');
                    }
                    
                    window.location.href = newUrl;
                    return;
                }
                
                // Nếu nhiều danh mục hoặc không có, dùng query parameter cũ
                var newUrl = "{{ url('/san-pham') }}";
                var params = [];

                if (selectedCategories.length > 0) {
                    params.push("filter_category=" + selectedCategories.join(','));
                }
                // Chỉ thêm sort_by nếu không phải default
                if (sortBy && sortBy !== 'newest') {
                    params.push("sort_by=" + sortBy);
                }
                if (page && page != 1) {
                    params.push("page=" + page);
                }

                if (params.length > 0) {
                    newUrl += "?" + params.join('&');
                }

                window.history.pushState(null, null, newUrl);
                updateSortDropdown(sortBy);

                $.ajax({
                    url: newUrl,
                    method: "GET",
                    data: {
                        category: selectedCategories,
                        sort_by: sortBy,
                        page: page
                    },
                    success: function (response) {
                        $('.product-filter').html(response.html);
                        $('.page-pagination').html(response.pagination);
                        $('.page-amount span').text("Hiển thị " + response.start + "–" + response.end + " trên " + response.total + " kết quả");
                    }
                });
            }

            function updateSortDropdown(sortBy) {
                $('.nice-select .current').text($(`.nice-select .list .option[data-value="${sortBy}"]`).text());
                $('.nice-select .list .option').removeClass('selected');
                $(`.nice-select .list .option[data-value="${sortBy}"]`).addClass('selected');
            }

            function applyFilterCategoryFromUrl(filterCategory) {
                if (filterCategory) {
                    var categories = filterCategory.split(',');
                    $('input[type="checkbox"][name="category"]').each(function () {
                        if (categories.includes($(this).attr('id'))) {
                            $(this).prop('checked', true);
                        }
                    });
                }
            }
        });
    </script>
    <!-- JS Filter Product + Pagonation -->
    <!-- Quickview Script -->
    <script>
        $(document).ready(function () {
            function formatPrice(price) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(price);
            }

            function updatePriceDisplay(price, original, percent) {
                let html = '';
                if (original > price) {
                    html += '<span class="text-danger fw-bold" style="font-size: 26px;">' + formatPrice(price) + '</span>';
                    html += '<span class="old-price text-muted" style="text-decoration: line-through; margin-left: 6px; font-weight: 500; font-size: 20px;">' + formatPrice(original) + '</span>';
                    html += '<span class="badge bg-danger" style="margin-left: 6px;">-' + percent + '%</span>';
                } else {
                    html += '<span class="text-danger fw-bold" style="font-size: 26px;color:#ff0000!important">' + formatPrice(price) + '</span>';
                }
                $('#quickView .price').html(html);
                $('.VAT').text('Full VAT');
            }

            // Toggle dropdown attribute list
            $(document).on('click', '#quickView .dropdown-attribute h1', function () {
                $(this).siblings('ul').slideToggle(200);
                $(this).toggleClass('active');
            });

            // Khi nhấn vào phân loại trong modal quickview
            $(document).on('click', '#quickView .dropdown-attribute ul li', function () {
                $('#quickView .dropdown-attribute ul li').removeClass('selected');
                $(this).addClass('selected');

                var selectedText = $(this).html();
                var productAttributeCode = $(this).data('value');
                var selectedPrice = parseFloat($(this).data('price'));
                var originalPrice = parseFloat($(this).data('original'));
                var discountPercent = parseFloat($(this).data('percent'));
                var stockStatus = $(this).data('stock');

                var h1Content = selectedText;
                $('#quickView .dropdown-attribute h1').html(h1Content);

                $('#quickView .product_code').text(productAttributeCode ? '(' + productAttributeCode + ')' : '');

                if (!isNaN(selectedPrice) && selectedPrice > 0) {
                    updatePriceDisplay(selectedPrice, originalPrice, discountPercent);
                } else {
                    $('#quickView .price').html('<span class="text-danger fw-bold" style="font-size: 26px;color:#ff0000!important">LIÊN HỆ</span>');
                }

                var statusLabel = stockStatus == 1 ? 'Còn hàng' : (stockStatus == 0 ? 'Hết hàng' : 'Sắp về hàng');
                var badgeClass = stockStatus == 1 ? 'bg-success' : (stockStatus == 0 ? 'bg-danger' : 'bg-warning text-dark');
                var productStockStatus = `
                    <strong style="font-size: 15px;line-height: 1;">Trạng thái: </strong>
                    <span class="badge rounded-pill ${badgeClass}" style="font-size: 14px;">${statusLabel}</span>
                `;
                $('#quickView .product-stock-status').html(productStockStatus).show();

                var addToCartBtn = '';

if (stockStatus == 0 || stockStatus == 2) {

    addToCartBtn = `
        <a href="javascript:void(0);" 
           class="animated-button1 disabled mt-2"
           style="pointer-events:none;opacity:0.6;">
            <i class="fa-solid fa-ban"></i>&nbsp;
            Sản phẩm hiện không khả dụng
        </a>
    `;

} else if (!isNaN(selectedPrice) && selectedPrice > 0) {

    var productId = $('#quickView').data('product-id');

    addToCartBtn = `
        <a href="javascript:void(0);" 
           class="animated-button1 add-to-cart mt-2"
           data-bs-toggle="modal"
           data-bs-target="#modalAddcart"
           data-product-id="${productId}">
            <i class="fa-solid fa-cart-shopping"></i>&nbsp;
            Thêm vào giỏ hàng
        </a>
    `;

} else {

    addToCartBtn = `
        <a href="javascript:void(0);" 
           class="animated-button1 disabled mt-2"
           style="pointer-events:none;opacity:0.6;">
            <i class="fa-solid fa-ban"></i>&nbsp;
            Vui lòng liên hệ Kinh Doanh - 0866638328
        </a>
    `;
}

$('#quickView .product-details-meta').html(addToCartBtn);

                
                // Đóng dropdown sau khi chọn
                $('#quickView .dropdown-attribute ul').slideUp(200);
                $('#quickView .dropdown-attribute h1').removeClass('active');
            });

            // Event to open Quickview
            $(document).on('click', '.quick-view-btn', function (e) {
                e.preventDefault();
                e.stopPropagation();
                
                var productId = $(this).data('product-id');
                console.log('🔵 Quick View button clicked for product ID:', productId);
                
                if (!productId) {
                    console.error('❌ Product ID is missing!');
                    alert('Lỗi: Không tìm thấy ID sản phẩm');
                    return false;
                }

                clearModalContent();

                var ajaxUrl = "{{ url('/product') }}/" + productId + '/quickview';
                console.log('🔵 AJAX URL:', ajaxUrl);

                $.ajax({
                    url: ajaxUrl,
                    type: 'GET',
                    dataType: 'json',
                    timeout: 10000,
                    success: function (response) {
                        console.log('✅ Quick View data received:', response);
                        
                        if (!response || !response.product) {
                            console.error('❌ Invalid response structure');
                            alert('Lỗi: Dữ liệu sản phẩm không hợp lệ');
                            return;
                        }

                        var product = response.product;
                        var gallery = response.gallery || [];
                        var attributes = response.attributes || [];
                        
                        console.log('Product:', product);
                        console.log('Gallery items:', gallery.length);
                        console.log('Attributes:', attributes.length);
                        
                        $('#quickView .title').text(product.product_name);
                        $('#quickView .product_code').html('(' + product.product_code + ')');
                        $('#quickView').attr('data-product-id', product.product_id);

                        var html = '';
                        if (!isNaN(product.final_price) && parseFloat(product.final_price) > 0) {
                            var formattedProductPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.final_price);
                            var formattedOriginal = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.original_price);

                            if (product.original_price > product.final_price) {
                                html += '<span class="text-danger fw-bold" style="font-size: 26px;color:#ff0000!important">' + formattedProductPrice + '</span>';
                                html += '<span class="old-price text-muted" style="text-decoration: line-through; margin-left: 6px;font-weight: 500; font-size: 20px;">' + formattedOriginal + '</span>';
                                html += '<span class="badge bg-danger" style="margin-left: 6px;">-' + product.discount_percent + '%</span>';
                            } else {
                                html += '<span class="text-danger fw-bold" style="font-size: 26px;color:#ff0000!important">' + formattedProductPrice + '</span>';
                            }
                        } else {
                            html = '<span class="text-danger fw-bold style="color:#ff0000!important">LIÊN HỆ</span>';
                        }
                        $('#quickView .price').html(html);
                        console.log('✅ Price updated');
                        
                        $('#quickView .VAT').replaceWith('<span class="VAT badge rounded-pill bg-danger" style="font-size: 13px; color:#fff; display:flex; align-items:center; justify-content:center; gap:5px; min-width: 80px; height: 32px;">Full VAT</span>');
                        
                        var warrantyPeriod = product.warranty_period || 24;
                        var warrantyText = '';
                        if (warrantyPeriod == 0) {
                            warrantyText = 'Không bảo hành';
                        } else {
                            warrantyText = 'Bảo hành ' + warrantyPeriod + ' tháng';
                        }
                        $('#quickView .warranty-text').text(warrantyText);

                        var stockStatus = product.product_stock_status;
                        var statusLabel = stockStatus == 1 ? 'Còn hàng' : (stockStatus == 0 ? 'Hết hàng' : 'Sắp về hàng');
                        var badgeClass = stockStatus == 1 ? 'bg-success' : (stockStatus == 0 ? 'bg-danger' : 'bg-warning text-dark');

                        var productStockStatus = `
                            <strong style="font-size: 15px;line-height: 1;">Trạng thái: </strong>
                            <span class="badge rounded-pill ${badgeClass}" style="font-size: 14px;">${statusLabel}</span>
                        `;

                        $('#quickView .product-stock-status').html(productStockStatus).show();
                        console.log('✅ Stock status updated');

                        $('#quickView .product-details-text').html(product.product_short_desc);

                        // Load product images
                        var mainImage = '{{ URL::to('public/upload/product/') }}/' + product.product_image;
                        console.log('Main image URL:', mainImage);
                        $('#quickView .modal-product-image-large').html(
                            '<div class="product-image-large-single active"><img class="img-fluid" src="' + mainImage + '" alt="" style="cursor: pointer; width: 100%; height: auto;"></div>');
                        $('#quickView .modal-product-image-thumb').html(
                            '<div class="product-image-thumb-single active" style="width: 50px; height: 50px; border: 2px solid #ff6b6b; border-radius: 3px; overflow: hidden; cursor: pointer; flex-shrink: 0;"><img class="img-fluid" src="' + mainImage + '" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>');

                        console.log('✅ Main image loaded');

                        // Load gallery images
                        gallery.forEach(function (image) {
                            var galleryImage = '{{ URL::to('public/upload/gallery/') }}/' + image.gallery_image;
                            $('#quickView .modal-product-image-large').append(
                                '<div class="product-image-large-single"><img class="img-fluid" src="' + galleryImage + '" alt="" style="cursor: pointer; width: 100%; height: auto;"></div>');
                            $('#quickView .modal-product-image-thumb').append(
                                '<div class="product-image-thumb-single" style="width: 50px; height: 50px; border: 2px solid #ddd; border-radius: 3px; overflow: hidden; cursor: pointer; flex-shrink: 0;"><img class="img-fluid" src="' + galleryImage + '" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>');
                        });

                        console.log('✅ Gallery images loaded');

                        // Setup gallery thumbnail click handlers AFTER images are loaded
                        setTimeout(function() {
                            setupQuickViewGalleryHandlers();
                        }, 100);

                        // Setup attributes and Add to Cart button
                        if (attributes.length > 0) {
                            console.log('Setting up', attributes.length, 'attributes');
                            var attributesHtml = '';
                            attributes.forEach(function (attribute) {
                                var iconHtml = (attribute.idAttribute == 1) ? '<i class="fa-solid fa-ruler-horizontal" style="color: #e884b0; flex-shrink: 0;"></i>' :
                                    (attribute.idAttribute == 2) ? '<i class="fa-solid fa-palette" style="color: #8773ec; flex-shrink: 0;"></i>' : '';

                                attributesHtml += '<li style="padding: 8px 12px; border-bottom: 1px solid #eee; cursor: pointer; transition: background 0.2s; line-height: 1.4; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: flex; align-items: center; flex-wrap: nowrap; gap: 4px;" ' +
                                    'data-value="' + attribute.product_attribute_code + '" ' +
                                    'data-price="' + attribute.final_price + '" ' +
                                    'data-original="' + (attribute.original || attribute.product_price) + '" ' +
                                    'data-percent="' + (attribute.percent || 0) + '" ' +
                                    'data-stock="' + attribute.stock_status + '">' +
                                    iconHtml + '<b style="flex-shrink: 0;">' + attribute.AttributeName + ':</b> <span style="flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis;">&nbsp;' + attribute.AttrValName + ' <strong style="color:red;font-weight:600">(' + attribute.product_attribute_code + ')</strong></span></li>';
                            });
                            $('#quickView .dropdown-attribute ul').html(attributesHtml);
                            $('#quickView .dropdown-attribute').css('display', 'block');
                            $('#quickView .product-details-meta').html(
                                '<a href="javascript:void(0);" class="animated-button1 disabled mt-2 select-variant-first" style="pointer-events: none; opacity: 0.6;">' +
                                '<i class="fa-solid fa-cart-shopping"></i>&nbsp; Vui lòng chọn phân loại ở trên</a>'
                            );
                        } else {
                            console.log('No attributes - showing single product add to cart button');
                            $('#quickView .dropdown-attribute').css('display', 'none');
                            
                            var addToCartButton = '';
                            if (stockStatus == 0 || stockStatus == 2) {
                                addToCartButton = '<a href="javascript:void(0);" class="animated-button1 disabled mt-2" style="pointer-events: none; opacity: 0.6;">' +
                                    '<i class="fa-solid fa-ban"></i> &nbsp;Sản phẩm hiện không khả dụng</a>';
                            } else {
                                if (!isNaN(product.final_price) && parseFloat(product.final_price) > 0) {
                                    addToCartButton = '<a href="javascript:void(0);" class="animated-button1 add-to-cart mt-2" data-bs-toggle="modal" data-bs-target="#modalAddcart" data-product-id="' + product.product_id + '">' +
                                        '<i class="fa-solid fa-cart-shopping"></i>&nbsp; Thêm vào giỏ hàng</a>';
                                } else {
                                    addToCartButton = '<a href="javascript:void(0);" class="animated-button1 disabled mt-2" style="pointer-events: none; opacity: 0.6;">' +
                                        '<i class="fa-solid fa-ban"></i>&nbsp; Vui lòng liên hệ Kinh Doanh - 0866638328</a>';
                                }
                            }
                            $('#quickView .product-details-meta').html(addToCartButton);
                        }

                        resetProductAttributes();
                        $('#quickView').modal('show');
                        console.log('✅ Modal showed successfully');
                    },
                    error: function (xhr, status, error) {
                        console.error('❌ AJAX Error:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            error: error,
                            responseText: xhr.responseText
                        });
                        alert('Lỗi tải sản phẩm. Vui lòng thử lại. (Error: ' + xhr.status + ')');
                    }
                });
                
                return false;
            });

            function clearModalContent() {
                console.log('Clearing modal content');
                $('#quickView .modal-product-image-large').empty();
                $('#quickView .modal-product-image-thumb').empty();
            }

            function resetProductAttributes() {
                $('.dropdown-attribute ul li').removeClass('selected');
                $('.dropdown-attribute h1').html('Chọn phân loại').removeClass('active');
                $('.dropdown-attribute h1').attr('class', 'animated-button1');
                $('.dropdown-attribute ul').slideUp(0);
                $('#quickview-quantity').val(1);
            }

            // Setup gallery handlers for Quick View
            function setupQuickViewGalleryHandlers() {
                var $largeContainer = $('#quickView .modal-product-image-large');
                var $thumbContainer = $('#quickView .modal-product-image-thumb');
                var $thumbs = $thumbContainer.find('.product-image-thumb-single');
                var $largeImages = $largeContainer.find('.product-image-large-single');

                console.log('Setting up gallery handlers:', {
                    largeImages: $largeImages.length,
                    thumbnails: $thumbs.length
                });

                // Remove existing handlers
                $thumbs.off('click');
                
                $thumbs.each(function(index) {
                    var $thumb = $(this);
                    $thumb.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Update active classes
                        $thumbs.removeClass('active').css('border-color', '#ddd');
                        $(this).addClass('active').css('border-color', '#ff6b6b');

                        // Hide all large images and show selected one
                        $largeImages.removeClass('active');
                        $largeImages.eq(index).addClass('active');

                        console.log('✅ Gallery image switched to:', index);
                    });
                });

                // Highlight first thumbnail
                if ($thumbs.length > 0) {
                    $thumbs.first().addClass('active').css('border-color', '#ff6b6b');
                }

                console.log('✅ Quick View gallery handlers setup complete (' + $thumbs.length + ' thumbnails)');
            }

            // Handle quantity buttons
            $(document).on('click', '#quickView .btn-decrease', function() {
                var $input = $('#quickview-quantity');
                var currentVal = parseInt($input.val()) || 1;
                if (currentVal > 1) {
                    $input.val(currentVal - 1);
                }
            });

            $(document).on('click', '#quickView .btn-increase', function() {
                var $input = $('#quickview-quantity');
                var currentVal = parseInt($input.val()) || 1;
                $input.val(currentVal + 1);
            });
        });

    </script>
    <!-- JS Quickview-->


    <!-- JS Cart Offcanvas-->
    <script>
        // Toast Notification Function
        function showToast(message, type = 'success', title = '', duration = 4000) {
            const container = document.getElementById('toast-container');
            if (!container) return;

            // Map icon based on type
            const iconMap = {
                'success': '<i class="fa-solid fa-check-circle"></i>',
                'error': '<i class="fa-solid fa-exclamation-circle"></i>',
                'warning': '<i class="fa-solid fa-exclamation-triangle"></i>',
                'info': '<i class="fa-solid fa-info-circle"></i>'
            };

            // Default titles
            const titleMap = {
                'success': title || '✅ Thành công',
                'error': title || '❌ Lỗi',
                'warning': title || '⚠️ Cảnh báo',
                'info': title || 'ℹ️ Thông tin'
            };

            const toastEl = document.createElement('div');
            toastEl.className = `toast-notification ${type}`;
            toastEl.innerHTML = `
                <div class="toast-icon">${iconMap[type]}</div>
                <div class="toast-content">
                    <div class="toast-title">${titleMap[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" aria-label="Đóng">
                    <i class="fa-solid fa-times"></i>
                </button>
            `;

            container.appendChild(toastEl);

            // Close button handler
            const closeBtn = toastEl.querySelector('.toast-close');
            const removeToast = () => {
                toastEl.classList.add('hide');
                setTimeout(() => toastEl.remove(), 300);
            };

            closeBtn.addEventListener('click', removeToast);

            // Auto remove after duration
            setTimeout(removeToast, duration);
        }

        // Helper function to format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(amount);
        }

        // Function to render cart items dynamically
        function renderCartItems(cart) {
            let cartItems = '';
            let totalQuantity = 0;
            let totalPrice = 0;

            $.each(cart, function (key, item) {
                const itemTotalPrice = item.quantity * item.price;
                const hasDiscount = item.original_price > item.price;
                const discountPercent = item.discount_percent || 0;

                cartItems += `
                <li class="offcanvas-cart-item-single" data-cart-key="${key}">
                    <a href="{{URL::to('chi-tiet-san-pham')}}/${item.product_slug}" class="offcanvas-cart-image-link" target="_blank">
                        <img src="{{ URL::to('public/upload/product/') }}/${item.image}" alt="${item.name}" class="offcanvas-cart-image" loading="lazy">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="{{URL::to('chi-tiet-san-pham')}}/${item.product_slug}" class="offcanvas-cart-item-name" target="_blank">
                            <strong>${item.name}</strong>
                        </a>
                        <div class="offcanvas-cart-item-details">
                            ${item.attribute ? `<span style="display: flex; gap: 6px;"><strong>Phân loại:</strong> <span style="font-weight: 600;">${item.attribute}</span></span>` : ''}
                            <span style="display: flex; gap: 6px; align-items: center;">
                                <strong>Mã:</strong> 
                                <span style="color: #ff4444; font-weight: 600;">${item.productAttributeCode ? item.productAttributeCode : item.product_code}</span>
                            </span>
                            <span style="display: flex; gap: 6px; align-items: center; margin-top: -6px;">
                                <strong>Số lượng:</strong> 
                                <span style="font-weight: 600;">${item.quantity}</span>
                            </span>
                        </div>
                        <div class="offcanvas-cart-item-details-price" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                            <span style="display: flex; gap: 8px; align-items: center;">
                                ${hasDiscount 
                                    ? `<strong style="color: #ff4444; font-size: 14px;">${formatCurrency(item.price)}</strong>
                                       <span class="text-muted" style="color: #666; text-decoration: line-through; font-size: 12px;">${formatCurrency(item.original_price)}</span>
                                       <span class="badge bg-danger" style="font-size: 11px; margin-left: 4px;padding-top: 6px;">-${discountPercent}%</span>`
                                    : `<strong style="color: #ff4444; font-size: 14px;">${formatCurrency(item.price)}</strong>`
                                }
                            </span>
                        </div>
                    </div>
                    <button class="offcanvas-remove-item-btn" data-product-id="${key}" type="button" title="Xóa khỏi giỏ hàng">
                        <i class="icon-close" style="color: #fff;"></i>
                    </button>
                </li>`;

                totalQuantity += item.quantity;
                totalPrice += itemTotalPrice;
            });

            // Update the cart HTML
            if (Object.keys(cart).length > 0) {
                $('.offcanvas-cart').html(cartItems);
                $('#emptyCart').hide();
                $('#freeShippingAlert').toggleClass('d-none', totalPrice < 500000);
            } else {
                $('.offcanvas-cart').html('');
                $('#emptyCart').show();
                $('#freeShippingAlert').addClass('d-none');
            }

            $('.total-product').text(`(${totalQuantity} sản phẩm)`);
            $('.count-box').text(totalQuantity);
            $('.offcanvas-cart-subtotal-price').text(formatCurrency(totalPrice));
            $('.offcanvas-cart-total-price-value').text(formatCurrency(totalPrice));
            $('#tamtinh').text(formatCurrency(totalPrice));
        }

        // Fetch and render the cart from the server
        $.ajax({
            url: "{{ url('/cart') }}",
            method: 'GET',
            success: function (response) {
                if (response.success) {
                    renderCartItems(response.cart);
                }
            },
            error: function () {
                console.log('Không thể tải giỏ hàng.');
            }
        });

        $(document).ready(function () {
            // Handle attribute selection from product_single.blade.php
            $(document).on('click', '.attribute-option', function () {
                $('.attribute-option').removeClass('selected');
                $(this).addClass('selected');
                
                const price = $(this).data('price');
                const original = $(this).data('original');
                const percent = $(this).data('percent') || 0;
                const attrName = $(this).find('.attribute-btn').text().trim();
                
                // Update hidden inputs
                $('#selected-attribute').val($(this).data('value'));
                $('#selected-price').val(price);
                
                console.log('Attribute selected:', {
                    code: $(this).data('value'),
                    price: price,
                    attrName: attrName
                });
            });

            // Add to cart functionality
            $(document).on('click', '.add-to-cart', function (e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                let productAttributeCode = '';
                let attributeName = '';
                let quantity = 1;

                // Kiểm tra nếu sản phẩm được thêm từ QuickView
                if ($('#quickView').is(':visible')) {
                    quantity = parseInt($('#quickView').find('#quickview-quantity').val()) || 1;
                    // Lấy attribute từ QuickView
                    if ($('#quickView .dropdown-attribute li.selected').length > 0) {
                        productAttributeCode = $('#quickView .dropdown-attribute li.selected').data('value');
                        attributeName = $('#quickView .dropdown-attribute li.selected').text().trim();
                    }
                }
                // Kiểm tra nếu sản phẩm được thêm từ trang Product Details
                else {
                    quantity = parseInt($('#details-quantity').val()) || 1;
                    // Lấy attribute từ product details page - TỪ ATTRIBUTE-OPTION CLASS
                    if ($('.attribute-option.selected').length > 0) {
                        productAttributeCode = $('.attribute-option.selected').data('value');
                        attributeName = $('.attribute-option.selected').find('.attribute-btn').text().trim();
                        console.log('Product detail attribute:', {
                            code: productAttributeCode,
                            name: attributeName
                        });
                    }
                }

                if (productId) {
                    console.log('Add to cart request:', {
                        productId: productId,
                        attribute: productAttributeCode,
                        attributeName: attributeName,
                        quantity: quantity
                    });

                    $.ajax({
                        url: "{{ url('/add-to-cart') }}",
                        method: 'POST',
                        data: {
                            product_id: productId,
                            product_attribute_code: productAttributeCode,
                            attribute_name: attributeName,
                            quantity: quantity,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log('Add to cart response:', response);
                            
                            if (response.success) {
                                // Cập nhật giỏ hàng offcanvas
                                renderCartItems(response.cart);

                                // Hiển thị toast notification
                                const toastMessage = `<strong>${response.product.product_name}</strong>${attributeName ? ' (' + attributeName + ')' : ''}<br>Số lượng: ${quantity} - Đã thêm vào giỏ hàng`;
                                showToast(toastMessage, 'success', '', 3000);

                                // Hiển thị modal success nếu tồn tại
                                const successModal = document.querySelector('.tf-add-cart-success');
                                if (successModal) {
                                    // Update modal với thông tin sản phẩm
                                    const modalImg = successModal.querySelector('#success-modal-image');
                                    const modalName = successModal.querySelector('#success-modal-name');
                                    const modalAttr = successModal.querySelector('#success-modal-attribute');
                                    const modalPrice = successModal.querySelector('#success-modal-price');
                                    
                                    if (modalImg) {
                                        modalImg.src = `{{ URL::to('public/upload/product/') }}/${response.product.product_image}`;
                                        modalImg.setAttribute('data-src', `{{ URL::to('public/upload/product/') }}/${response.product.product_image}`);
                                    }
                                    if (modalName) {
                                        modalName.textContent = response.product.product_name;
                                        modalName.href = `{{ URL::to('chi-tiet-san-pham') }}/${response.product.product_Slug}${productAttributeCode ? '/' + productAttributeCode : ''}`;
                                    }
                                    if (modalAttr && attributeName) {
                                        modalAttr.textContent = attributeName;
                                    }
                                    if (modalPrice) {
                                        // Lấy giá từ item cuối cùng trong cart và nhân với số lượng
                                        const lastCartKey = Object.keys(response.cart)[Object.keys(response.cart).length - 1];
                                        const cartItem = response.cart[lastCartKey];
                                        const totalPrice = cartItem.price * quantity;
                                        modalPrice.innerHTML = formatCurrency(totalPrice) + ' ₫';
                                        console.log('✅ Modal price updated:', {
                                            price: cartItem.price,
                                            quantity: quantity,
                                            total: totalPrice
                                        });
                                    }
                                    
                                    // Thêm class active để hiển thị modal
                                    successModal.classList.add('active');
                                    
                                    // Tự động ẩn sau 3 giây
                                    setTimeout(() => {
                                        successModal.classList.remove('active');
                                    }, 3000);
                                }

                                // Cập nhật modal #modalAddcart nếu có
                                if ($('#modalAddcart').length > 0) {
                                    $('#modalAddcart .modal-add-cart-product-img img').attr('src', `{{ URL::to('public/upload/product/') }}/${response.product.product_image}`);
                                    $('#modalAddcart .modal-add-cart-info').html(`Đã thêm <strong>${response.product.product_name}${attributeName ? ' - ' + attributeName : ''}</strong> vào giỏ hàng!`);
                                    $('#modalAddcart').modal('show');

                                    // Cập nhật số lượng tổng trong giỏ hàng
                                    const totalQuantity = Object.values(response.cart).reduce((acc, item) => acc + item.quantity, 0);
                                    $('.modal-add-cart-product-shipping-info li:first-child strong').html(`<i class="fa-solid fa-cart-shopping"></i> Có ${totalQuantity} sản phẩm trong giỏ hàng.`);

                                    // Cập nhật tổng giá trị giỏ hàng
                                    const totalPrice = Object.values(response.cart).reduce((acc, item) => acc + (item.quantity * item.price), 0);
                                    $('.modal-add-cart-product-shipping-info li:nth-child(2) strong').html('Tổng cộng: ');
                                    $('.modal-add-cart-product-shipping-info li:nth-child(2) span').html(`${formatCurrency(totalPrice)}`);
                                }

                                console.log(`Sản phẩm ${response.product.product_name} đã được thêm vào giỏ hàng với số lượng: ${quantity}`);
                            } else {
                                // Hiển thị toast error
                                showToast('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại!', 'error', '', 4000);
                                console.error('Response error:', response);
                            }
                        },
                        error: function (xhr) {
                            console.error('AJAX Error:', xhr);
                            console.error('Status:', xhr.status);
                            console.error('Response:', xhr.responseText);
                            showToast('Kết nối lỗi. Vui lòng kiểm tra kết nối mạng và thử lại!', 'error', '', 4000);
                        }
                    });
                } else {
                    console.error('Product ID not found');
                }
            });

            // Khi đóng QuickView, reset số lượng về 1
            $('#quickView').on('hidden.bs.modal', function () {
                $('#quickview-quantity').val(1);
            });

            // Khi đóng modal giỏ hàng, reset số lượng về 1
            $('#modalAddcart').on('hidden.bs.modal', function () {
                $('#quickview-quantity, #details-quantity').val(1);
            });

            // Remove item from cart - Updated for new shopping cart modal
            $(document).on('click', '.offcanvas-cart-item-delete, .offcanvas-remove-item-btn', function (e) {
                e.preventDefault();
                e.stopPropagation();
                
                const $btn = $(this);
                const productId = $btn.data('product-id');
                
                if (!productId && !productId === 0) {
                    console.warn('⚠️ Product ID not found');
                    return false;
                }
                
                // Confirm before delete
                if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                    return false;
                }
                
                // Store original state
                const originalHtml = $btn.html();
                
                // Show loading state
                $btn.html('<i class="fa-solid fa-spinner fa-spin"></i>').prop('disabled', true);
                
                $.ajax({
                    url: "{{ url('/remove-from-cart') }}",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log('✅ Remove from cart response:', response);
                        
                        if (response.success) {
                            // Xóa item khỏi DOM với animation
                            $btn.closest('.offcanvas-cart-item-single').fadeOut(300, function() {
                                $(this).remove();
                                
                                // Cập nhật lại giỏ hàng
                                renderCartItems(response.cart || {});
                                if (typeof updateCartTable === 'function') {
                                    updateCartTable(response.cart || {});
                                }
                                
                                // Hiển thị thông báo thành công
                                showCartNotification('✓ Xóa sản phẩm thành công!', 'success');
                                
                                console.log('🗑️ Product removed successfully. Cart:', response.cart);
                            });
                        } else {
                            // Restore button state
                            $btn.html(originalHtml).prop('disabled', false);
                            showCartNotification(response.message || '❌ Có lỗi xảy ra khi xóa sản phẩm.', 'error');
                            console.error('❌ Remove failed:', response);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Restore button state
                        $btn.html(originalHtml).prop('disabled', false);
                        
                        console.error('❌ AJAX Error:', {status, error, xhr});
                        let errorMsg = 'Có lỗi xảy ra. Vui lòng thử lại.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        
                        showCartNotification(errorMsg, 'error');
                    }
                });
                
                return false;
            })
            
            // Hàm hiển thị notification
            function showCartNotification(message, type) {
                const bgColor = type === 'success' ? 'linear-gradient(135deg, #28a745 0%, #1e7e34 100%)' : 'linear-gradient(135deg, #dc3545 0%, #c82333 100%)';
                const borderColor = type === 'success' ? '#43a047' : '#e57373';
                const icon = type === 'success' ? '✓' : '⚠';
                
                const notifHtml = `
                    <div class="cart-notification" style="
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: ${bgColor};
                        color: white;
                        padding: 16px 20px;
                        border-radius: 8px;
                        border-left: 4px solid ${borderColor};
                        z-index: 9999;
                        animation: slideIn 0.3s ease-out;
                        max-width: 400px;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                        font-weight: 500;
                        font-size: 14px;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    ">
                        <span style="font-size: 18px;">${icon}</span>
                        <span>${message}</span>
                    </div>
                    <style>
                        @keyframes slideIn {
                            from {
                                transform: translateX(500px);
                                opacity: 0;
                            }
                            to {
                                transform: translateX(0);
                                opacity: 1;
                            }
                        }
                        @keyframes slideOut {
                            from {
                                transform: translateX(0);
                                opacity: 1;
                            }
                            to {
                                transform: translateX(500px);
                                opacity: 0;
                            }
                        }
                    </style>
                `;
                
                $('body').append(notifHtml);
                
                // Auto remove notification sau 3 giây
                setTimeout(function() {
                    $('.cart-notification').css('animation', 'slideOut 0.3s ease-out').fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 3000);
            }

            function updateCartTable(cart) {
                let cartItemsHtml = '';
                let totalQuantity = 0;
                let totalPrice = 0;

                $.each(cart, function (key, item) {
                    const itemTotalPrice = item.quantity * item.price;
                    cartItemsHtml += `
             <tr>
                 <td class="product_remove">
                     <a href="#" class="remove-item" data-product-id="${key}">
                         <i class="fa-regular fa-trash-can"></i>
                     </a>
                 </td>
                 <td class="product_thumb">
                     <a href="{{URL::to('chi-tiet-san-pham')}}/${item.product_slug}"><img src="{{ URL::to('public/upload/product/') }}/${item.image}" alt=""></a>
                 </td>
                 <td class="product_name">
                     <a href="{{URL::to('chi-tiet-san-pham')}}/${item.product_slug}">${item.name}${item.attribute ? ' - ' + item.attribute : ''}</a>
                 </td>
                 <td class="product-price">${formatCurrency(item.price)}</td>
                 <td class="product_quantity">
                     <label>Số lượng</label>
                     <input min="1" max="100" value="${item.quantity}" type="number" aria-label="Số lượng" data-product-id="${key}" class="update-quantity">
                 </td>
                 <td class="product_total">${formatCurrency(itemTotalPrice)}</td>
             </tr>
         `;

                    totalQuantity += item.quantity;
                    totalPrice += itemTotalPrice;
                });

                $('#cart-items').html(cartItemsHtml);
                $('#tamtinh').text(formatCurrency(totalPrice));
            }

            $(document).on('click', '.remove-item', function (e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var row = $(this).closest('tr');
                if (productId) {
                    $.ajax({
                        url: "{{ url('/remove-from-cart') }}",
                        method: 'POST',
                        data: {
                            product_id: productId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                row.remove();
                                renderCartItems(response.cart);
                            } else {
                                alert(response.message || 'Có lỗi xảy ra.');
                            }
                        },
                        error: function () {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    });
                }
            });

            // Clear entire cart
            $(document).on('click', '#clear-cart, #clear-cart1', function (e) {
                e.preventDefault();
                if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?')) {
                    $.ajax({
                        url: "{{ url('/clear-cart') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                renderCartItems({});
                                updateCartTable({});
                                alert('Giỏ hàng đã được xoá thành công!');
                            } else {
                                alert(response.message || 'Có lỗi xảy ra khi xoá giỏ hàng.');
                            }
                        },
                        error: function () {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).on('show.bs.modal', '.modal', function () {
            $('.modal-backdrop').remove();
        });

        $(document).on('hidden.bs.modal', '.modal', function () {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });

    </script>
    <!-- JS Cart Offcanvas-->


    <!-- JS Autocomplete-->
    <script>
        function formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
        }

        $(document).ready(function () {
            let debounceTimer;
            const debounceDelay = 300;

            $('#keywords').on('input', function () {
                let query = $(this).val().trim();
                clearTimeout(debounceTimer);

                if (query !== '') {
                    debounceTimer = setTimeout(function () {
                        $.ajax({
                            url: "{{ URL('/autocomplete-ajax') }}",
                            method: "GET",
                            data: { query: query },
                            dataType: "json",
                            success: function (data) {
                                console.log('Autocomplete data:', data);
                                $('#autocomplete-results').empty();

                                if (Array.isArray(data) && data.length > 0) {
                                    data.forEach(item => {
                                        let priceHtml = '';
                                        if (item.price === 0 || item.price === '0') {
                                            priceHtml = '<strong>LIÊN HỆ</strong>';
                                        } else if (item.original_price > item.price) {
                                            priceHtml = '<strong>' + formatCurrency(item.price) + '</strong> <span class="text-muted">' + formatCurrency(item.original_price) + '</span> <span class="badge bg-danger">-' + Math.round(item.discount_percent) + '%</span>';
                                        } else {
                                            priceHtml = '<strong>' + formatCurrency(item.price) + '</strong>';
                                        }

                                        let productUrl = "{{ url('chi-tiet-san-pham/') }}/" + item.product_slug;
                                        let productImageUrl = "{{ URL::to('public/upload/product/') }}/" + item.product_image;
                                        let placeholderUrl = "{{ URL::to('public/frontend/images/placeholder.png') }}";
                                        
                                        let itemHtml =
                                        '<li class="offcanvas-cart-item-single-search">' +

                                            '<a href="' + productUrl + '" class="offcanvas-cart-item-image-link-search">' +
                                                '<img src="' + productImageUrl + '" class="offcanvas-cart-image-search" ' +
                                                'onerror="this.src=\'' + placeholderUrl + '\'">' +
                                            '</a>' +

                                            '<div class="offcanvas-cart-item-content-search">' +

                                                '<a class="offcanvas-cart-item-link-search" href="' + productUrl + '">' +
                                                    item.product_name +
                                                '</a>' +

                                                '<div class="offcanvas-cart-item-details-search">' +
                                                    '<span class="product-code" data-code="' +
                                                        (item.productAttributeCode ?? item.product_code) +
                                                    '">' +
                                                        (item.productAttributeCode ? 'Mã phân loại: ' : 'Mã sản phẩm: ') +
                                                        (item.productAttributeCode ?? item.product_code) +
                                                    '</span>' +
                                                '</div>' +

                                                '<div class="offcanvas-cart-item-details-price-search">' +
                                                    priceHtml +
                                                '</div>' +

                                            '</div>' +
                                        '</li>';              
                                        $('#autocomplete-results').append(itemHtml);
                                    });
                                    $('#search_ajax').css('display', 'block');
                                } else {
                                    $('#autocomplete-results').append('<li style="text-align: center; padding: 20px; font-weight:600; color: #2b2b2b;">Không tìm thấy sản phẩm</li>');
                                    $('#search_ajax').css('display', 'block');
                                }
                            },
                            error: function (xhr) {
                                console.error('Lỗi tìm kiếm:', xhr);
                                $('#autocomplete-results').empty();
                                $('#autocomplete-results').append('<li style="text-align: center; padding: 20px; font-weight:600; color: #2b2b2b;">Không tìm thấy sản phẩm</li>');
                                $('#search_ajax').css('display', 'block');
                            }
                        });
                    }, debounceDelay);
                } else {
                    $('#search_ajax').css('display', 'none');
                    $('#autocomplete-results').empty();
                }
            });

            $(document).on('click', '.offcanvas-cart-item-link-search', function (e) {
                e.preventDefault();
                let productUrl = $(this).attr('href');
                window.location.href = productUrl;
            });

            $(document).mouseup(function (e) {
                var $modal = $('#search .modal-content');
                var $trigger = $('[data-bs-target="#search"]');
                if ($modal && !$modal.is(e.target) && $modal.has(e.target).length === 0 && 
                    !$trigger.is(e.target) && $trigger.has(e.target).length === 0) {
                    $('#search_ajax').css('display', 'none');
                }
            });

            $('.search__submit').on('click', function (e) {
                e.preventDefault();
                let query = $('#keywords').val().trim();
                if (query) {
                    window.location.href = "{{ URL::to('/search') }}?query=" + encodeURIComponent(query);
                }
            });

            $('#keywords').on('keypress', function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    let query = $(this).val().trim();
                    if (query) {
                        window.location.href = "{{ URL::to('/search') }}?query=" + encodeURIComponent(query);
                    }
                }
            });

            $('#search-form').on('submit', function (e) {
                e.preventDefault();
                let query = $('#keywords').val().trim();
                if (query) {
                    window.location.href = "{{ URL::to('/search') }}?query=" + encodeURIComponent(query);
                }
            });

            $('#search').on('hidden.bs.modal', function () {
                $('#keywords').val('');
                $('#search_ajax').css('display', 'none');
                $('#autocomplete-results').empty();
            });

            $('#search').on('shown.bs.modal', function () {
                $('#keywords').focus();
            });
        });
    </script>
    <!-- JS Autocomplete-->

    <!-- JS Search -->
    <script>
        $(document).ready(function () {
            var currentUrl = window.location.pathname;
            var initialQuery = getUrlParameter('query') || '';
            var filterCategory = getUrlParameter('filter_category') || '';
            var filterClassification = getUrlParameter('filter_classification') || '';
            var sortBy = getUrlParameter('sort_by');
            var page = getUrlParameter('page') || 1;

            if (currentUrl.includes('/search')) {
            }

            $('input[type="checkbox"][name="category"]').change(function () {
            });

            $('input[type="checkbox"][name="classification"]').change(function () {
            });

            // Xử lý pagination khi click
            $(document).on('click', '.pagination-link', function (e) {
                e.preventDefault();
                var pageNumber = $(this).data('page');
                var query = getUrlParameter('query') || '';
                
                if (!query) {
                    return false;
                }

                // Gửi AJAX request
                $.ajax({
                    url: "{{ URL::to('/search') }}",
                    method: "GET",
                    data: {
                        query: query,
                        page: pageNumber
                    },
                    success: function (response) {
                        // Update products - replace the entire product-filter div
                        $('.product-filter').replaceWith(response.html);
                        // Update pagination - update the entire page-pagination div
                        $('.page-pagination').replaceWith(response.pagination);
                        // Update text
                        $('.page-amount span').text("Hiển thị " + response.start + "–" + response.end + " trên " + response.total + " kết quả");
                        // Update URL
                        var newUrl = "{{ URL::to('/search') }}?query=" + encodeURIComponent(query) + (pageNumber > 1 ? "&page=" + pageNumber : "");
                        window.history.pushState(null, null, newUrl);
                        // Scroll to top
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    },
                    error: function () {
                        alert('Lỗi tải dữ liệu');
                    }
                });
            });

            $('#sort_by').change(function () {
            });

        });
    </script>
    <!-- JS Search -->
 	  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C7K7R1V55N"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C7K7R1V55N');
</script>

    <script>
        document.addEventListener("touchstart", function () {
            document.body.classList.add("no-hover");
        });

        document.addEventListener("mousemove", function () {
            document.body.classList.remove("no-hover");
        });

    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.querySelector('#product_new');
    if (!el) return;

    const swiper = new Swiper(el, {
        loop: true,

        slidesPerView: Number(el.dataset.preview) || 4,
        slidesPerGroup: 1,
        spaceBetween: Number(el.dataset.spaceLg) || 12,

        speed: 600,
        lazy: true,
        watchSlidesProgress: true,

        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        breakpoints: {
            0: {
                slidesPerView: Number(el.dataset.mobile) || 2,
                spaceBetween: Number(el.dataset.space) || 6,
            },
            768: {
                slidesPerView: Number(el.dataset.tablet) || 3,
                spaceBetween: Number(el.dataset.spaceMd) || 10,
            },
            1200: {
                slidesPerView: Number(el.dataset.preview) || 4,
                spaceBetween: Number(el.dataset.spaceLg) || 12,
            }
        },

        navigation: {
            nextEl: el.querySelector('.swiper-button-next'),
            prevEl: el.querySelector('.swiper-button-prev'),
        },

        pagination: el.dataset.pagination === '1'
            ? {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            }
            : false,

        on: {
            slideChange(swiper) {
                if (!swiper.pagination?.bullets) return;
                swiper.pagination.bullets.forEach((b, i) => {
                    b.classList.toggle(
                        'swiper-pagination-bullet-active',
                        i === swiper.realIndex
                    );
                });
            }
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.querySelector('#product_sale');
    if (!el) return;

    const swiper = new Swiper(el, {
        loop: true,

        slidesPerView: Number(el.dataset.preview) || 4,
        slidesPerGroup: 1,
        spaceBetween: Number(el.dataset.spaceLg) || 12,
        autoHeight: true,

        speed: 600,
        lazy: true,
        watchSlidesProgress: true,

        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        breakpoints: {
            0: {
                slidesPerView: Number(el.dataset.mobile) || 2,
                spaceBetween: Number(el.dataset.space) || 6,
            },
            768: {
                slidesPerView: Number(el.dataset.tablet) || 3,
                spaceBetween: Number(el.dataset.spaceMd) || 10,
            },
            1200: {
                slidesPerView: Number(el.dataset.preview) || 4,
                spaceBetween: Number(el.dataset.spaceLg) || 12,
            }
        },

        navigation: {
            nextEl: el.querySelector('.swiper-button-next'),
            prevEl: el.querySelector('.swiper-button-prev'),
        },

        pagination: el.dataset.pagination === '1'
            ? {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            }
            : false,

        on: {
            slideChange(swiper) {
                if (!swiper.pagination?.bullets) return;
                swiper.pagination.bullets.forEach((b, i) => {
                    b.classList.toggle(
                        'swiper-pagination-bullet-active',
                        i === swiper.realIndex
                    );
                });
            }
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.querySelector('#logo_partner');
    if (!el) return;

    let swiperInstance = null;
    let currentMode = null; // 'mobile' | 'pc'

    function initMobileSwiper() {
        const totalSlides = el.querySelectorAll('.swiper-slide').length;

        swiperInstance = new Swiper(el, {
            slidesPerView: 1,
            slidesPerGroup: 1,
            centeredSlides: true,
            spaceBetween: Number(el.dataset.space) || 8,
            speed: 500,
            lazy: true,

            loop: totalSlides > 3,

            autoplay: totalSlides > 1 ? {
                delay: 2200,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            } : false,

            pagination: el.dataset.pagination === '1'
                ? {
                    el: el.querySelector('.swiper-pagination'),
                    clickable: true,
                }
                : false,

            on: {
                init() {
                    el.classList.add('is-mobile-swiper');
                }
            }
        });
    }

    function destroySwiper() {
        if (swiperInstance) {
            swiperInstance.destroy(true, true);
            swiperInstance = null;
            el.classList.remove('is-mobile-swiper');
        }
    }

    function handleResize() {
        const isMobile = window.innerWidth < 768;
        const newMode = isMobile ? 'mobile' : 'pc';

        if (newMode === currentMode) return; // không đổi mode thì thôi
        currentMode = newMode;

        if (isMobile) {
            initMobileSwiper();
        } else {
            destroySwiper();
        }
    }

    // Debounce resize cho mượt
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 200);
    });

    handleResize(); // chạy lần đầu
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const thumb = document.querySelector('#quickView .modal-product-image-thumb');
    if (!thumb) return;

    thumb.addEventListener('wheel', function (e) {
        if (e.deltaY === 0) return;
        e.preventDefault();
        this.scrollLeft += e.deltaY;
    }, { passive: false });
});
</script>
<!-- Tìm đơn hàng -->
<script>
$(function () {

    // focus input khi mở modal
    $('#search-order').on('shown.bs.modal', function () {
        $('#keywords_order').focus();
    });

    $('#keywords_order').on('input', function () {
        let query = $(this).val().trim();

        if (!query) {
            $('#search_order_ajax').hide();
            return;
        }

        $.ajax({
            url: "{{ url('/search-order') }}",
            method: "GET",
            data: { query_order: query },
            success: function (res) {

                let orders = res.orders || [];
                let currentUserId = res.currentUserId;

                $('#autocomplete-results-order').empty();
                $('#search_order_ajax').show();

                if (!orders.length) {
                    $('#autocomplete-results-order').append(`
                        <li class="p-3 text-center">Không tìm thấy đơn hàng</li>
                    `);
                    return;
                }

                orders.forEach(order => {

                    let url = "{{ route('order.details', ':code') }}"
                        .replace(':code', order.order_number);

                    if (order.idCustomer && currentUserId !== order.idCustomer) {
                        url = "{{ route('login') }}";
                    }

                    $('#autocomplete-results-order').append(`
                        <li class="p-3 border-bottom">
                            <div><strong>Đơn hàng:</strong> ${order.order_number}</div>
                            <a href="${url}" class="btn btn-danger btn-sm mt-2">
                                Xem chi tiết
                            </a>
                        </li>
                    `);
                });
            },
            error: function (err) {
                console.error('Search order error', err);
            }
        });
    });

});
</script>

    <!-- Tìm đơn hàng -->
<script>
(function () {
    function markUserInteraction() {
        sessionStorage.setItem("site_user_interacted", "true");
    }

    window.addEventListener("click", markUserInteraction, { passive: true });
    window.addEventListener("touchstart", markUserInteraction, { passive: true });
})();
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("scrollTopBtn");
    if (!btn) return;

    const toggleBtn = () => {
        btn.classList.toggle("show", window.scrollY > 300);
    };

    btn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    window.addEventListener("scroll", toggleBtn, { passive: true });
});
</script>
<script>
    document.addEventListener('click', function(e){
    const li = e.target.closest('.offcanvas-cart-item-single-search');
    if(!li) return;

    const link = li.querySelector('.offcanvas-cart-item-link-search');
    if(link){
        window.location.href = link.href;
    }
});
</script>

</body>

</html>
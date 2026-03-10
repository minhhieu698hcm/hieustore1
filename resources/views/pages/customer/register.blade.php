<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title & Meta Description -->
    <title>@yield('title', 'Hiếu Store - Cung cấp Bàn phím cơ, Chuột gaming, Tai nghe chính hãng')</title>
    <meta name="description" content="@yield('description', 'Hiếu Store - Đại lý phân phối chính hãng các sản phẩm gaming Hiếu Store: bàn phím cơ, chuột gaming, tai nghe, mousepad và phụ kiện gaming cao cấp tại Việt Nam.')">
    <meta name="keywords" content="@yield('keywords', 'Hiếu Store, Hiếu Store, bàn phím cơ, chuột gaming, tai nghe gaming, mousepad, phụ kiện gaming, gaming peripherals')">
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
    <meta property="og:title" content="@yield('og_title', 'Hiếu Store - Bàn phím cơ, Chuột gaming, Tai nghe gaming chính hãng')" />
    <meta property="og:description" content="@yield('og_description', 'Khám phá sản phẩm gaming Hiếu Store chính hãng: bàn phím cơ, chuột gaming, tai nghe gaming, mousepad và các phụ kiện gaming cao cấp tại Hiếu Store.')" />
    <meta property="og:image" content="@yield('og_image', asset('public/frontend/images/default-og-image.jpg'))" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="Hiếu Store" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter_title', 'Hiếu Store - Bàn phím cơ, Chuột gaming, Tai nghe gaming chính hãng')" />
    <meta name="twitter:description" content="@yield('twitter_description', 'Hiếu Store chuyên phân phối sản phẩm gaming chính hãng: bàn phím cơ, chuột gaming, tai nghe gaming, mousepad và phụ kiện gaming cao cấp.')" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('public/frontend/images/default-og-image.jpg'))" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/frontend/images/favicon.ico') }}" type="image/png">

<link rel="stylesheet" href="{{ asset('public/frontend/css/style-login.css') }}">
<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap'>
<link rel="stylesheet" href="{{ asset('public/frontend/sweetalert2/dist/sweetalert2.min.css') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('styles')
    
    <!-- Organization Schema - Brand Info -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Hiếu Store",
      "alternateName": "Hiếu Store",
      "url": "https://khotoolsocial.click/",
      "logo": "{{ asset('public/frontend/images/logo/logo.webp') }}",
      "description": "Đại lý phân phối chính hãng các sản phẩm gaming Hiếu Store tại Việt Nam: bàn phím cơ, chuột gaming, tai nghe gaming, mousepad và phụ kiện gaming cao cấp",
      "sameAs": [
       
      ],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "contactType": "Customer Service",
          "telephone": "+84-975-999-628",
          "contactOption": "TollFree"
        },
        {
          "@type": "ContactPoint",
          "contactType": "Customer Support",
          "email": "minhhieu698hcm@gmail.com"
        }
      ],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "102 Phan Văn Hớn",
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
      "description": "Đại lý phân phối chính hãng các sản phẩm gaming Hiếu Store tại Việt Nam: bàn phím cơ, chuột gaming, tai nghe gaming, mousepad và phụ kiện gaming cao cấp",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "102 Phan Văn Hớn",
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
      "telephone": "+84-975-999-628",
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
          "opens": "09:00",
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
        "https://www.facebook.com/Hiếu Store/",
        "https://www.youtube.com/@ReddragonOfficial",
        "https://www.instagram.com/reddragon_official"
      ]
    }
    </script>
</head>

<div class="wrapper">
  <div class="login_box">
    <div class="login-header">
      <span><a href="{{ URL::to('/') }}"><strong>Đăng ký</strong></a></span>
    </div>
     <form action="{{ URL::to('/register') }}" method="post" id="admin-register-form" novalidate>
                    {{ csrf_field() }}
    <div class="input_box">
      <input type="email" class="input-field" id="username" name="username" placeholder=" " required="">
      <label for="user" class="label">Tài khoản</label>
      <i class="bx bx-user icon"></i>
      <small class="error-text" id="email-error"></small>
    </div>

    <div class="input_box">
        <input type="password" class="input-field" id="password" name="password" placeholder=" " required="">
      <label for="pass" class="label">Mật khẩu</label>
      <i class="bx bx-lock-alt icon"></i>
      <small class="error-text" id="password-error"></small>
    </div>

    <div class="input_box">
       <input type="password" class="input-field" id="password_confirmation" name="password_confirmation" placeholder=" " required="" style="margin-bottom:10px">
      <label for="pass" class="label">Nhập lại mật khẩu</label>
      <i class="bx bx-lock-alt icon"></i>
      <small class="error-text" id="password-error"></small>
    </div>

    {{-- <div class="remember-forgot">
      <div class="remember-me">
        <input type="checkbox" id="remember">
        <label for="remember">Ghi nhớ tài khoản</label>
      </div>

      {{-- <div class="forgot">
        <a href="#">Forgot password?</a>
      </div> 
    </div> --}}

    <div class="input_box">
      <input type="submit" class="input-submit" id="register-button" value="Đăng ký">
    </div>
   
    <div class="register">
      <span>Bạn đã có tài khoản? <a href="{{ URL::to('/login') }}">&nbsp;<strong>Đăng nhập ngay</strong></a></span>
    </div>
    <div class="register" style="margin-top: 20px">
      <span><a href="{{URL::to('/')}}"><strong class="back-link"><i class="bx bx-undo"></i>Quay lại Hiếu Store.</strong></a></span>
    </div>
  </div>
</div>
 </form>
 <script src="{{ asset('public/frontend/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    @if(session('success'))
        Swal.fire({
            title: "Thành công!",
            text: "{{ session('success') }}",
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6"
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: "Thất bại!",
            text: "{{ session('error') }}",
            confirmButtonText: "Thử lại",
            confirmButtonColor: "#d33"
        });
    @endif
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("admin-register-form");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const confirmPass = document.getElementById("password_confirmation");

    // Map lỗi để tiện gọi
    const errors = {
        username: document.getElementById("email-error"),
        password: document.querySelectorAll("#password-error")[0],
        confirm: document.querySelectorAll("#password-error")[1],
    };

    const setError = (input, errorEl, message) => {
        const box = input.closest(".input_box");
        box.classList.add("error");
        errorEl.innerHTML = `<strong>${message}</strong>`;
    };

    const clearError = (input, errorEl) => {
        const box = input.closest(".input_box");
        box.classList.remove("error");
        errorEl.innerHTML = "";
    };

    form.addEventListener("submit", function (e) {
        let hasError = false;

        // reset lỗi cũ
        clearError(username, errors.username);
        clearError(password, errors.password);
        clearError(confirmPass, errors.confirm);

        const emailVal = username.value.trim();
        const passVal = password.value.trim();
        const confirmVal = confirmPass.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // kiểm tra email
        if (!emailVal) {
            setError(username, errors.username, "Vui lòng nhập email.");
            hasError = true;
        } else if (!emailRegex.test(emailVal)) {
            setError(username, errors.username, "Email không hợp lệ.");
            hasError = true;
        }

        // kiểm tra mật khẩu
        if (!passVal) {
            setError(password, errors.password, "Vui lòng nhập mật khẩu.");
            hasError = true;
        } else if (passVal.length < 6) {
            setError(password, errors.password, "Mật khẩu phải có ít nhất 6 ký tự.");
            hasError = true;
        }

        // kiểm tra xác nhận mật khẩu
        if (!confirmVal) {
            setError(confirmPass, errors.confirm, "Vui lòng nhập lại mật khẩu.");
            hasError = true;
        } else if (confirmVal !== passVal) {
            const msg = "Mật khẩu nhập lại không khớp.";
            setError(password, errors.password, msg);
            setError(confirmPass, errors.confirm, msg);
            hasError = true;
        }

        if (hasError) e.preventDefault();
    });

    // reset lỗi khi nhập lại
    [username, password, confirmPass].forEach(input => {
        input.addEventListener("input", function () {
            if (this.id === "username") clearError(this, errors.username);
            if (this.id === "password") clearError(this, errors.password);
            if (this.id === "password_confirmation") clearError(this, errors.confirm);
        });
    });
});
</script>




<style>
    
.input_box {
  position: relative;
  margin-bottom: 20px;
}

.input-field {
  width: 100%;
  height: 55px;
  font-size: 16px;
  background: transparent;
  color: var(--second-color);
  padding-inline: 20px 50px;
  border: 2px solid var(--primary-color);
  border-radius: 30px;
  outline: none;
  transition: border-color 0.2s ease-in-out;
}

/* Icon */
.icon {
  position: absolute;
  top: 18px;
  right: 25px;
  font-size: 20px;
  color: var(--primary-color);
  transition: color 0.2s ease-in-out;
}

/* Lỗi */
.input_box.error .input-field {
  border-color: red !important;
}
.input_box.error .icon {
  color: red !important;
}

/* Text lỗi */
.error-text {
  display: block;
  color: red;
  font-size: 13px;
  margin-top: 4px;
  padding-left: 10px;
}
.error-text strong {
  color: red;
  text-shadow: 0 0 2px #fff;
}

</style>
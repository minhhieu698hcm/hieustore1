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
        "https://www.facebook.com/Hiếu Store/",
        "https://www.youtube.com/@ReddragonOfficial",
        "https://www.instagram.com/reddragon_official"
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
          "email": "support@Hiếu Store.vn"
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
     <span><a href="{{ URL::to('/') }}"><strong>Đăng nhập</strong></a></span>
    </div>
    <form action="{{URL::to('/login')}}" method="post" id="admin-login-form" novalidate>
                    {{ csrf_field() }}
    <div class="input_box">
      <input type="text" id="email" name="email" class="input-field" value="{{ old('email', request()->cookie('remember_email')) }}" autocomplete="off" placeholder=" " required>
      <label for="user" class="label">Tài khoản</label>
      <i class="bx bx-user icon"></i>
      <small class="error-text" id="email-error"></small>
    </div>

    <div class="input_box">
      <input type="password" id="password" name="password" class="input-field" autocomplete="off" placeholder=" " required>
      <label for="pass" class="label">Mật khẩu</label>
      <i class="bx bx-lock-alt icon"></i>
      <small class="error-text" id="password-error"></small>
    </div>

    <div class="remember-forgot">
      <div class="remember-me">
        <input type="checkbox" id="remember" name="remember" {{ request()->cookie('remember_email') ? 'checked' : '' }}>
        <label for="remember">Ghi nhớ tài khoản</label>
      </div>

      <div class="forgot">
        <a href="#" id="forgot-password-link">Quên mật khẩu?</a>
    </div>

    </div>

    <div class="input_box">
      <input type="submit" class="input-submit" id="login-button" value="Đăng nhập">
    </div>
   
    <div class="register">
      <span>Bạn chưa có tài khoản? <a href="{{URL::to('/register')}}">&nbsp;<strong>Đăng ký</strong></a></span>
    </div>
		<div class="register" style="margin-top: 20px">
      <span><a href="{{URL::to('/')}}"><strong class="back-link"><i class="bx bx-undo"></i>Quay lại Hiếu StoreVN.</strong></a></span>
    </div>
  </div>
</div>
 </form>
 <script src="{{ asset('public/frontend/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Hiển thị thông báo thành công (vd: đăng ký, đăng xuất)
    @if(session('success'))
        Swal.fire({
            title: "Thành công!",
            text: "{{ session('success') }}",
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6"
            // Không có 'icon' => sẽ không hiển thị biểu tượng
        });
    @endif

    // Khi đăng nhập thành công
    @if(session('login_success'))
        Swal.fire({
            icon: "success",
            title: "Đăng nhập thành công!",
            text: "Bạn sẽ được chuyển đến trang chủ sau giây lát...",
            showConfirmButton: false,
            timer: 1500,
            willClose: () => {
                window.location.href = "{{ url('/') }}";
            }
        });
    @endif

    // Khi đăng nhập thất bại
    @if(session('error'))
        Swal.fire({
            icon: "error",
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
    const form = document.getElementById("admin-login-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("email-error");
    const passError = document.getElementById("password-error");

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
        const emailVal = email.value.trim();
        const passVal = password.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        clearError(email, emailError);
        clearError(password, passError);

        if (!emailVal) {
            setError(email, emailError, "Vui lòng nhập email.");
            hasError = true;
        } else if (!emailRegex.test(emailVal)) {
            setError(email, emailError, "Email không hợp lệ.");
            hasError = true;
        }

        if (!passVal) {
            setError(password, passError, "Vui lòng nhập mật khẩu.");
            hasError = true;
        }

        if (hasError) e.preventDefault();
    });

    [email, password].forEach(input => {
        input.addEventListener("input", function () {
            const err = this.id === "email" ? emailError : passError;
            clearError(this, err);
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const forgotLink = document.getElementById("forgot-password-link");

    forgotLink.addEventListener("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Quên mật khẩu",
            html: `
                <input type="email" id="forgot-email" class="swal2-input" placeholder="Nhập email của bạn">
                <div id="forgot-error" style="color:red;font-size:13px;margin-top:5px;"></div>
            `,
            showCancelButton: true,
            confirmButtonText: "Gửi link khôi phục",
            cancelButtonText: "Hủy",
            focusConfirm: false,
            allowOutsideClick: () => !Swal.isLoading(),
            preConfirm: () => {
                const email = document.getElementById("forgot-email").value.trim();
                const errorEl = document.getElementById("forgot-error");
                errorEl.textContent = "";

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    errorEl.textContent = "Vui lòng nhập email.";
                    return false;
                }
                if (!emailRegex.test(email)) {
                    errorEl.textContent = "Email không hợp lệ.";
                    return false;
                }

                // Bắt đầu loading
                Swal.showLoading();
                const cancelBtn = document.querySelector(".swal2-cancel");
                if (cancelBtn) cancelBtn.style.display = "none"; // ẩn nút hủy

                return fetch("{{ URL::to('/forgot-password') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ email })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.hideLoading();
                    if (cancelBtn) cancelBtn.style.display = ""; // hiện lại nút hủy

                    if (!data.success) {
                        errorEl.textContent = data.message || "Email không tồn tại trong hệ thống.";
                        return false;
                    }

                    return data;
                })
                .catch(() => {
                    Swal.hideLoading();
                    if (cancelBtn) cancelBtn.style.display = ""; // hiện lại nút hủy nếu lỗi
                    errorEl.textContent = "Có lỗi xảy ra, vui lòng thử lại.";
                    return false;
                });
            }
        }).then((result) => {
            if (result.value && result.value.success) {
                Swal.fire({
                    title: "Thành công!",
                    text: "Link khôi phục mật khẩu đã được gửi đến email của bạn.",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6"
                });
            }
        });
    });
});
</script>



<style>
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

.icon {
  position: absolute;
  top: 18px;
  right: 25px;
  font-size: 20px;
  color: var(--primary-color);
  transition: color 0.2s ease-in-out;
}

.error-text {
  display: block;
  color: red;
  font-size: 13px;
  margin-top: 4px;
  padding-left: 10px;
}

/* khi có lỗi thì đổi border và icon */
.input_box.error .input-field {
  border-color: red !important;
}

.input_box.error .icon {
  color: red !important;
}
</style>
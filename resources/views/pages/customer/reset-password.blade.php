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
	<link rel="shortcut icon" href="{{ asset('public/frontend/images/favicon.ico') }}" type="image/png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Hiếu Store - Đại lý phân phối linh kiện Hiếu Store chính hãng tại Việt Nam" />
    <meta name="twitter:description"
        content="Hiếu Store chuyên phân phối linh kiện Hiếu Store chính hãng: cáp HDMI, USB, dock sạc, bộ chuyển đổi và nhiều sản phẩm công nghệ khác." />
    <meta name="twitter:image" content="https://khotoolsocial.click//path-to-your-image.jpg" />
<link rel="stylesheet" href="{{ asset('public/frontend/css/style-login.css') }}">
<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap'>
<link rel="stylesheet" href="{{ asset('public/frontend/sweetalert2/dist/sweetalert2.min.css') }}">

<div class="wrapper">
  <div class="login_box">
    <div class="login-header" style="width: 280px!important;">
      <span><a href="{{ URL::to('/') }}"><strong>Đặt lại mật khẩu</strong></a></span>
    </div>
     <form action="{{ route('password.update') }}" method="post" id="admin-register-form" novalidate>
                    {{ csrf_field() }}
     <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
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

    <div class="input_box">
      <input type="submit" class="input-submit" id="register-button" value="Cập nhật mật khẩu">
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
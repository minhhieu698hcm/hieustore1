@component('mail::message')
# 🔐 Khôi phục mật khẩu - UnitekVN

Xin chào **{{ $email }}**,

Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản UnitekVN của mình.

@component('mail::button', ['url' => $resetUrl])
Đặt lại mật khẩu
@endcomponent

Nếu bạn không yêu cầu, vui lòng bỏ qua email này.

Trân trọng,  
**Đội ngũ UnitekVN**

<hr>
<small style="color:#888;">© {{ date('Y') }} Unitek Việt Nam. Tất cả các quyền được bảo lưu.</small>
@endcomponent

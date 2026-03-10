@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Chính Sách Thanh Toán </h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. Thanh toán tiền mặt/COD</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. Thanh toán quét mã chuyển khoản</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>


<main>
    <h6>Để nâng cao và cải thiện trải nghiệm mua hàng của Quý Khách, Hiếu Store hiện hỗ trợ những
        phương thức thanh toán cho website Hiếu Store như sau: </h6>
    <section id="terms-1" class="policy-section">
        <h2>1. Thanh toán tiền mặt/COD:</h2>
        <p>• Quý khách có thể thanh toán trực tiếp bằng tiền mặt khi mua hàng tại chi nhánh liên danh của Huy
            Phát Electronics hoặc lựa chọn phương thức thanh toán COD (Cash on delivery) khi mua hàng
            online qua website Hiếu Store và thanh toán tiền mặt cho nhân viên giao hàng.
            </p>
    </section>


    <section id="terms-2" class="policy-section">
        <h2>2. Thanh toán quét mã chuyển khoản:</h2>
        <h5>Quý khách có thể thanh toán qua phương thức quét mã tài khoản hiển thị trong phần xác nhận Đơn
            hàng hoặc trong email xác nhận đơn hàng. Số tài khoản duy nhất được Hiếu Store sử
            dụng là:</h5>
        <p> CÔNG TY TNHH Hiếu Store</p>
        <p> Số tài khoản: 112002951204        </p>
        <p> Vietinbank CN6 – TP.HCM – PGD NGUYỄN TRI PHƯƠNG</p>
        <h5> *** Lưu ý quan trọng: Hiếu Store chỉ chấp nhận thanh toán chuyển khoản qua tài khoản công ty đã được cung cấp bên trên.
            Mọi khoản thanh toán không chuyển vào tài khoản này sẽ không được coi là hợp lệ.
            Hiếu Store không chịu trách nhiệm đối với bất kỳ khoản thanh toán nào được thực hiện ngoài tài khoản chính thức của công ty.
            Vui lòng kiểm tra kỹ thông tin trước khi thanh toán để đảm bảo an toàn cho giao dịch của quý khách.
        </h5>
    </section>

    <!-- Thêm các mục còn lại... -->
</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



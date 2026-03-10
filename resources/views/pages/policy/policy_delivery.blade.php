@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Chính Sách Vận Chuyển & Nhận Hàng </h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. PHƯƠNG THỨC: GIAO HÀNG</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. PHƯƠNG THỨC: NHẬN HÀNG TẠI CÁC CHI NHÁNH</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <section id="terms-1" class="policy-section">
        <h2>1. PHƯƠNG THỨC: GIAO HÀNG</h2>
        <h5>• Toàn bộ đơn sẽ được giao thông qua đơn vị vận chuyển do phía Hiếu Store chọn lựa.</h5>
        <h5>• Tất cả đơn hàng sẽ được tiến hành giao khi đã xác nhận thanh toán.</h5>
        <h5>• Thời gian dự kiến giao không tính những ngày Chủ Nhật hoặc các ngày nghỉ lễ.</h5>
        <h5>* Đối với Quý khách hàng trong địa bàn TP. Hồ Chí Minh & Hà Nội: </h5>
        <p> Đơn hàng của Quý khách sẽ được tiến hành đóng gói và giao đến Quý khách trong
            vòng 48 tiếng kể từ thời điểm chúng tôi nhận thanh toán cho đơn hàng.</p>
        <p> Phí ship căn bản 25.000 VND sẽ được áp dụng cho tất cả đơn hàng.</p>
        <p> MIỄN PHÍ SHIP đối với tất cả đơn với giá trị từ 300.000 VND trở lên.</p>
        <h5>* Đối với Quý khách hàng ở các tỉnh thành còn lại:</h5>
        <p> Đơn hàng sẽ được tiến hành giao trong vòng từ 1-6 ngày (có thể sớm hơn tùy vào địa
            chỉ giao), kể từ thời điểm thanh toán của đơn hàng.</p>
        <p> Phí ship căn bản 30.000 VND sẽ được áp dụng cho tất cả đơn hàng.</p>
        <p> MIỄN PHÍ SHIP đối với tất cả đơn hàng có trị giá từ 450.000 VND trở lên.</p>
		<p> <strong>Lưu ý:</strong> Đối với hình thức Ship COD chỉ áp dụng với đơn hàng dưới 1.000.000 VND </p>
    </section>


    <section id="terms-2" class="policy-section">
        <h2> PHƯƠNG THỨC: NHẬN HÀNG TẠI CÁC CHI NHÁNH</h2>
        <h5> -Thanh toán chuyển khoản sau đó nhận hàng tại 2 địa điểm: </h5>
		<p> - 102 Phan Văn Hớn, Phường Đông Hưng Thuận, TP. Hồ Chí Minhđối với khách hàng tại HCM.</p>
		
        <h5> -Quý khách vui lòng cho nhân viên tại chi nhánh xem email xác nhận đơn đặt hàng của Quý
            khách.</h5>

        <h5> -Thành phố Hồ Chí Minh:</h5>

        <p> ▪ Hiếu Store:
            • 102 Phan Văn Hớn, Phường Đông Hưng Thuận, TP. Hồ Chí Minh</p>

    </section>

    <!-- Thêm các mục còn lại... -->
</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Thông Tin Sản Phẩm Dịch Vụ & Chủ Sở Hửu Website </h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. THÔNG TIN VỀ CÔNG TY TNHH Hiếu Store</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. THÔNG TIN SẢN PHẨM Hiếu Store</a></li>
                    <li><a href="#" data-target="terms-3" class="mucluc">3. THÔNG TIN THƯƠNG HIỆU Hiếu Store</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>


<main>
    <section id="terms-1" class="policy-section">
        <h2>1. THÔNG TIN VỀ CÔNG TY TNHH Hiếu Store</h2>
        <p>Tên quốc tế: Hiếu Store LIMITED COMPANY</p>
        <p>Tên viết tắt: Hiếu Store CO., LTD.</p>
        <p>Địa chỉ: 102 Phan Văn Hớn, Phường Đông Hưng Thuận, TP. Hồ Chí Minh, Việt Nam</p>
    </section>

    <section id="terms-2" class="policy-section">
        <h2>2. THÔNG TIN SẢN PHẨM Hiếu Store</h2>
        <p>  * Thiết bị linh phụ kiện </p>
        <p>  * Các sản phẩm như: Bàn phím, Chuột, Cáp, Loa, Đầu đổi, TV Box, Hub Switch, Card, Camera,
            Gaming, Phụ kiện PC Mobile, Tablet, ...
        </p>

    </section>

    <section id="terms-3" class="policy-section">
        <h2>3. THÔNG TIN THƯƠNG HIỆU Hiếu Store</h2>
        <h5>Trong Chính sách này, các từ ngữ dưới đây được hiểu như sau: </h5>
        <p>• Thương hiệu Hiếu Store của Hiếu Store chuyên cung cấp thiết bị linh phụ
            kiện như: Thiết bị mạng, Loa, Camera, Phụ kiện máy tính, Phụ kiện điện thoại, Gaming, ... trên
            toàn quốc.</p>
        <p>• Bạn muốn sở hữu những thiết bị linh phụ kiện mới nhất, chính hãng với giá thành phải chăng và
            phù hợp với các thiết bị cũng như tài chính của mình thì Hiếu Store sẽ đáp ứng cho bạn.
            Dịch vụ chăm sóc khách hàng vượt trội: tư vấn sử dụng sản phẩm; tư vấn chọn mua hàng; chính
            sách giao hàng; hoàn tiền, đổi - trả hàng dễ dàng. </p>
        <p>• Sứ mệnh của Thương hiệu King-Master là giúp bạn chọn được và sở hữu thiết bị linh phụ kiện
            phù hợp nhất với các thiết bị của bạn</p>
        <p>• Hãy liên hệ ngay với Thương hiệu Hiếu Store để được tư vấn những sản phẩm
            tốt nhất với bạn!</p>
    </section>

</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Chính Sách Bảo Hành </h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. Chính sách bảo hành</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. Điều kiện bảo hành</a></li>
                    <li><a href="#" data-target="terms-3" class="mucluc">3. Từ chối bảo hành</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<main>
    <section id="terms-1" class="policy-section">
        <h2>1. Chính sách bảo hành</h2>
        <p>• Toàn bộ sản phẩm Hiếu Store như cáp bàn phím , chuột, tai nghe, micro đều được
            bảo hành 24 tháng lỗi nhà sản xuất. </p>
        <p>• Đổi mới hoàn toàn cho tất cả sản phẩm Hiếu Store có tem của nhà cung cấp (Công Ty
            TNHH Hiếu Store) và còn thời hạn bảo hành.</p>
        <p>• Phí ship gửi đến trung tâm bảo hành sẽ do Quý khách hàng thanh toán, và phí ship
            trả hàng đến Quý khách sẽ do trung tâm bảo hành đảm nhận.</p>
        <p>• Đối với tất cả sản phẩm Hiếu Store do CÔNG TY Hiếu Store bán ra cần bảo
            hành vui lòng gửi về địa chỉ sau: </p>
        <p>Khu vực Miền Nam</p>
        <p>Thành phố Hồ Chí Minh</p>
        <a href="https://khotoolsocial.click/" target="_blank" style="font-weight: 500;">Công Ty TNHH Hiếu Store</a>
                                    </br>
        <a>Số điện thoại bảo hành:</a><a href="tel:02866830388" style="font-weight: 500;">0903390721</a>
    </section>

    <section id="terms-2" class="policy-section">
        <h2>2. Điều kiện Bảo hành</h2>
        <p>Sản phẩm phải đáp ứng các điều kiện sau đây:</p>
        <p>• Sản phẩm còn trong thời hạn bảo hành. (Thời hạn bảo hành được tính căn cứ theo
            hóa đơn bán hàng của CÔNG TY Hiếu Store, có thể cộng thêm 30 ngày).</p>
        <p>• Sản phẩm bị lỗi kỹ thuật hoặc khiếm khuyết thuộc trách nhiệm Nhà sản xuất và Nhà
            phân phối.</p>
        <p>• Sản phẩm phải có tem bảo hành của nhà cung cấp (tem bảo hành của CÔNG TY Hiếu Store
            ELECTRONICS).</p>
        <p>• Số Serial/Imei/Service Tag trên sản phẩm phải còn nguyên vẹn và rõ nét. (Chỉ áp
            dụng nếu sản phẩm có dán đầy đủ thông tin trên).</p>
        <p>• Tem bảo hành của nhà cung cấp (Hiếu Store) phải còn nguyên vẹn (không
            rách, trầy, hoặc không có tem bảo hành của nhà cung cấp).</p>
    </section>

    <section id="terms-3" class="policy-section">
        <h2>3. Từ chối Bảo hành</h2>
        <p>Các trường hợp không bảo hành:</p>
        <p>• Bên bán có quyền từ chối bảo hành nếu sản phẩm không đáp ứng các tiêu chí về điều
            kiện bảo hành thuộc Mục 2.</p>
        <p>• Khiếm khuyết mà bên mua đã biết hoặc phải biết khi mua;</p>
        <p>• Bên mua có lỗi gây ra khuyết tật của sản phẩm.</p>
        <p>• Sản phẩm, linh kiện, phụ kiện bị hư hỏng do rơi vỡ, cháy nỗ, đứt dây, trầy xước,
            sử dụng sai, hoặc sửa chữa, tháo lắp trái phép sản phẩm.</p>
        <p>• Hao mòn thông thường. Trong bất kỳ trường hợp nào, việc bảo hành này sẽ không bao
            gồm việc thay thế hoặc bồi thường cho các sản phẩm Hiếu Store do CÔNG TY Hiếu Store
            ELECTRONICS được chứng nhận phân phối bán hàng.</p>
        <p>• Sản phẩm không đủ điều kiện bảo hành hoặc vi phạm điều kiện bảo hành của nhà sản
            xuất như được điều cập ở Mục 2 và 3.</p>
    </section>
    <!-- Thêm các mục còn lại... -->
</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



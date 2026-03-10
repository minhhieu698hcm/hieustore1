@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Chính sách đổi trả hàng và hoàn tiền </h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. Kiểm tra sản phẩm khi nhận hàng</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. Chính sách đổi trả hàng</a></li>
                    <li><a href="#" data-target="terms-3" class="mucluc">3. Sản phẩm lỗi do Nhà sản xuất</a></li>
                    <li><a href="#" data-target="terms-4" class="mucluc">4. Sản phẩm lỗi do vận chuyển</a></li>
                    <li><a href="#" data-target="terms-5" class="mucluc">5. Từ chối đổi trả đối với những thiết bị sau</a></li>
                    <li><a href="#" data-target="terms-6" class="mucluc">6. Chính sách hoàn tiền</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<main>
    <section id="terms-1" class="policy-section">
        <h2>1. Kiểm tra sản phẩm khi nhận hàng</h2>
        <p>Hiếu Store khuyến khích khách hàng kiểm tra tình trạng của sản phẩm trước khi thanh toán để đảm bảo rằng hàng hóa được giao đúng chủng loại, số lượng theo đơn đặt hàng và tình trạng không bị lỗi, hỏng. Trong trường hợp khách hàng ký xác nhận biên lai giao hàng tại nhà đồng nghĩa là sản phẩm mà khách hàng đã nhận tại thời điểm đó không có bất cứ vấn đề gì. Chúng tôi sẽ không giải quyết bất kỳ khiếu nại của khách hàng sau đó.</p>
    </section>
    
    <section id="terms-2" class="policy-section">
        <h2>2. Chính sách đổi trả hàng</h2>
        <p>Đổi trả hàng là đổi sản phẩm đã mua với sản phẩm cùng loại, cùng model, cùng màu sắc. Trong trường hợp sản phẩm Quý khách muốn đổi trả không còn tồn, Hiếu Store sẽ đổi sang một sản phẩm khác với giá trị tương đương hoặc cao hơn sản phẩm Quý khách muốn đổi trả.</p>
        <h5>Điều kiện để được đổi trả hàng:</h5>
    </section>
    
    <section id="terms-3" class="policy-section">
        <h2>3. Sản phẩm lỗi do Nhà sản xuất</h2>
        <p>• Yêu cầu đổi trả hàng phải được gửi trong vòng 7 ngày kể từ ngày Quý khách nhận được hàng từ Hiếu Store.</p>
        <p>• Yêu cầu đổi trả hàng phải bao gồm những thông tin và tài liệu như sau:</p>
        <ul>
            <li>Sản phẩm dự kiến đổi trả.</li>
            <li>- Copy xác nhận đơn hàng gửi qua email.</li>
            <li>- Sản phẩm của Quý khách phải đảm bảo còn mới, giữ nguyên 100% tình trạng như ban đầu khi Quý khách nhận sản phẩm từ Hiếu Store, không có dấu hiệu va chạm, trầy xước, cấn, móp,… Sản phẩm được gửi về cho Hiếu Store phải bao gồm bao bì, phụ kiện, văn bản hướng dẫn sử dụng, và sản phẩm tặng kèm (nếu có).</li>
        </ul>
    </section>
    
    <section id="terms-4" class="policy-section">
        <h2>4. Sản phẩm lỗi do vận chuyển</h2>
        <p>• Yêu cầu đổi trả hàng phải được gửi trong vòng 7 ngày kể từ ngày Quý khách nhận được hàng từ Hiếu Store.</p>
        <p>• Yêu cầu đổi trả hàng phải bao gồm những thông tin và tài liệu như sau:</p>
        <ul>
            <li>Sản phẩm dự kiến đổi trả.</li>
            <li>Copy xác nhận đơn hàng gửi qua email.</li>
            <li>Hình ảnh cụ thể về tình trạng hàng hóa, bao bì, hộp, video mở hộp.</li>
            <li>Sản phẩm được gửi về cho Hiếu Store phải bao gồm bao bì, phụ kiện, văn bản hướng dẫn sử dụng, và sản phẩm tặng kèm (nếu có)… vào hộp/bao bì của nhà sản xuất.</li>
        </ul>
    </section>
    
    <section id="terms-5" class="policy-section">
        <h2>5. Từ chối đổi trả đối với những thiết bị sau</h2>
        <p>• Những thiết bị không bảo hành và không có tem</p>
        <p>• Thiết bị biến dạng, trầy xướt hoặc va chạm</p>
        <p>• Thiết bị có dấu hiệu cháy nổ</p>
        <p>• Quà tặng.</p>
    </section>
    
    <section id="terms-6" class="policy-section">
        <h2>6. Chính sách hoàn tiền</h2>
        <p>• <strong>Thời hạn hoàn trả:</strong> Hiếu Store sẽ chỉ hoàn tiền cho Khách hàng khi Hiếu Store xác nhận đã nhận được Yêu cầu trả hàng, Hàng trả lại và không có nhu cầu đổi hàng với giá trị tương đương.</p>
        <p>• <strong>Cách thức lấy lại tiền:</strong> Tùy từng trường hợp, tiền hoàn trả sẽ được chuyển vào tài khoản ngân hàng hoặc theo phương thức tiền mặt được chỉ định của Người mua hoặc bằng phương thức do thỏa thuận của 02 bên.</p>
    </section>
    <!-- Thêm các mục còn lại... -->
</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



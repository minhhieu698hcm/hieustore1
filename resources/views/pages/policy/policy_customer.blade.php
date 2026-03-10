@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush

<header id="header_chinhsach">
    <div class="container">
        <div class="header-columns">
            <h1>Chính Sách Bảo Vệ </h1>
            <h1>Thông Tin Cá Nhân Của Người Tiêu Dùng</h1>
            <nav id="policy-nav">
                <ul>
                    <li><a href="#" id="show-all" class="mucluc">Tất cả</a></li>
                    <li><a href="#" data-target="terms-1" class="mucluc">1. Mục Đích</a></li>
                    <li><a href="#" data-target="terms-2" class="mucluc">2. Phạm vi áp dụng</a></li>
                    <li><a href="#" data-target="terms-3" class="mucluc">3. Giải thích từ ngữ</a></li>
                    <li><a href="#" data-target="terms-4" class="mucluc">4. Các loại thông tin cá nhân thu thập từ người tiêu dùng</a></li>
                    <li><a href="#" data-target="terms-5" class="mucluc">5. Mục đích, phạm vi sử dụng thông tin cá nhân</a></li>
                    <li><a href="#"  data-target="terms-6" class="mucluc">6. Cơ chế thu thập, sử dụng, chia sẻ thông tin cá nhân</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<main>
    <section id="terms-1" class="policy-section">
        <h2>1. Mục Đích</h2>
        <h5>Chính sách bảo vệ thông tin cá nhân của người tiêu dùng (sau đây được gọi là "Chính sách") này được ban hành nhằm mục đích:</h5>
        <p>• Bảo đảm quyền, lợi ích hợp pháp của người tiêu dùng trong việc bảo vệ thông tin cá nhân; </p>
        <p>• Bảo đảm sự minh bạch,công khai trong việc thu thập, sử dụng, chia sẻ thông tin cá nhân của người tiêu dùng; </p>
        <p>• Tuân thủ pháp luật Việt Nam và các điều ước quốc tế mà Việt Nam là thành viên; </p>
        <p>• Tuân thủ các tiêu chuẩn, quy chuẩn kỹ thuật về bảo vệ thông tin cá nhân. </p>
    </section>

    <section id="terms-2" class="policy-section">
        <h2>2. Phạm vi áp dụng</h2>
        <p>
            • Chính sách này áp dụng đối với tất cả các thông tin cá nhân của người tiêu dùng mà Công ty TNHH
            Hiếu Store thu thập, sử dụng, chia sẻ trong quá trình cung cấp các sản phẩm, dịch vụ
            cho người tiêu dùng.
        </p>
    </section>

    <section id="terms-3" class="policy-section">
        <h2>3. Giải thích từ ngữ</h2>
        <h5>Trong Chính sách này, các từ ngữ dưới đây được hiểu như sau: </h5>
        <p>• Thông tin cá nhân: Là thông tin liên quan đến một cá nhân, bao gồm nhưng không giới hạn
            tên, tuổi, giới tính, địa chỉ, số điện thoại, email, tài khoản ngân hàng,... </p>
        <p>• Thương nhân: Là Công ty TNHH Hiếu Store, là tổ chức, cá nhân kinh doanh
            hàng hóa, dịch vụ. </p>
        <p>• Người tiêu dùng: Là cá nhân, tổ chức sử dụng hàng hóa, dịch vụ của thương nhân. </p>
        <p>• Thu thập thông tin cá nhân: Là việc thương nhân thu thập các thông tin cá nhân của người
            tiêu dùng. </p>
        <p>• Sử dụng thông tin cá nhân: Là việc thương nhân khai thác, xử lý các thông tin cá nhân của
            người tiêu dùng. </p>
        <p>• Chia sẻ thông tin cá nhân: Là việc thương nhân cung cấp thông tin cá nhân của người tiêu
            dùng cho bên thứ ba. </p>
    </section>
<section id="terms-4" class="policy-section">
        <h2>4. Các loại thông tin cá nhân thu thập từ người tiêu dùng</h2>
        <h5>Công ty TNHH Hiếu Store có thể thu thập các loại thông tin cá nhân của người tiêu
            dùng bao gồm: </h5>
        <p>• Thông tin cá nhân do người tiêu dùng cung cấp: bao gồm thông tin cá nhân mà người tiêu
            dùng cung cấp cho Công ty TNHH Hiếu Store khi đăng ký sử dụng sản phẩm, dịch
            vụ, tham gia các hoạt động khuyến mại,... </p>
        <p>• Thông tin cá nhân được thu thập tự động: bao gồm thông tin cá nhân mà Công ty TNHH
            Hiếu Store thu thập tự động từ người tiêu dùng khi người tiêu dùng truy cập vào
            website, ứng dụng của Công ty TNHH Hiếu Store. </p>
    </section>

    <section id="terms-5" class="policy-section">
        <h2>5. Mục đích, phạm vi sử dụng thông tin cá nhân</h2>
        <h5>Công ty TNHH Hiếu Store sử dụng thông tin cá nhân của người tiêu dùng cho các mục
            đích sau: </h5>
        <p>• Cung cấp sản phẩm, dịch vụ cho người tiêu dùng: Công ty TNHH Hiếu Store
            sử dụng thông tin cá nhân của người tiêu dùng để xác thực danh tính, thực hiện giao dịch,
            cung cấp dịch vụ cho người tiêu dùng. </p>
        <p>• Tiếp thị, quảng cáo: Công ty TNHH Hiếu Store sử dụng thông tin cá nhân của
            người tiêu dùng để gửi các thông tin về sản phẩm, dịch vụ, khuyến mại,... cho người tiêu
            dùng. </p>
        <p>• Xử lý khiếu nại, tố cáo: Công ty TNHH Hiếu Store sử dụng thông tin cá nhân
            của người tiêu dùng để giải quyết các khiếu nại, tố cáo của người tiêu dùng. </p>
        <p>• Các mục đích khác: Công ty TNHH Hiếu Store có thể sử dụng thông tin cá nhân
            của người tiêu dùng cho các mục đích khác phù hợp với quy định của pháp luật. </p>
    </section>

    <section id="terms-6" class="policy-section">
        <h2>6. Cơ chế thu thập, sử dụng, chia sẻ thông tin cá nhân</h2>
        <p>• Thu thập thông tin cá nhân: Công ty TNHH Hiếu Store sẽ thu thập thông tin cá
            nhân của người tiêu dùng khi người tiêu dùng đăng ký sử dụng sản phẩm, dịch vụ, tham gia
            các hoạt động khuyến mại,... hoặc khi người tiêu dùng truy cập vào website, ứng dụng của
            Công ty TNHH Hiếu Store. </p>
        <p>• Sử dụng thông tin cá nhân: Công ty TNHH Hiếu Store chỉ sử dụng thông tin cá
            nhân của người tiêu dùng cho các mục đích đã được nêu tại mục 5 của Chính sách này. </p>
        <p>• Chia sẻ thông tin cá nhân: Công ty TNHH Hiếu Store có thể chia sẻ thông tin cá
            nhân của người tiêu dùng với các bên thứ ba sau: </p>
        <p>- Các đối tác cung cấp dịch vụ cho Công ty TNHH Hiếu Store, bao gồm các
            đối tác cung cấp dịch vụ vận chuyển, thanh toán, marketing,... </p>
    </section>
    <!-- Thêm các mục còn lại... -->
</main>

 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection



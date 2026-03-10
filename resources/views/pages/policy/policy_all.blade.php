@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/style-policy.css') }}">
@endpush
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap">
                
                <!-- Breadcrumb list -->
                <div class="tf-breadcrumb-list">
                    <a href="{{ URL::to('/trang-chu') }}" class="text text-caption-1">
                        Trang chủ
                    </a>
                    <i class="icon icon-arrRight"></i>

                    <span class="text text-caption-1">
                        Tất cả các chính sách Hiếu Store
                    </span>
                </div>

                <!-- Breadcrumb actions (prev / back / next) -->
                <div class="tf-breadcrumb-prev-next">
                    <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                        <i class="icon icon-arrLeft"></i>
                    </a>

                    <a href="{{ URL::to('/trang-chu') }}" class="tf-breadcrumb-back" title="Trang chủ">
                        <i class="icon icon-squares-four"></i>
                    </a>

                    <a href="{{ URL::to('/san-pham') }}" class="tf-breadcrumb-next d-none d-md-flex" title="Xem sản phẩm">
                        <i class="icon icon-arrRight"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

<!-- ...::::Start About Us Center Section:::... -->
<div class="faq-section">
    <div class="container">
        <h1 style="text-align: center">Tất cả các chính sách Hiếu Store</h1>
        <div class="row">
            <div class="col-12">
                <div class="faq-content" data-aos="fade-up"  data-aos-delay="0"  data-aos-duration="300">
                    <h5>Các chính sách này được ban hành nhằm mục đích:</h5>
                    <p>Bảo đảm quyền, lợi ích hợp pháp của người tiêu dùng trong việc bảo vệ thông tin cá nhân. Bảo đảm sự minh bạch, công khai trong việc thu thập, sử dụng, chia sẻ thông tin cá nhân của 
                        người tiêu dùng. Tuân thủ pháp luật Việt Nam và các điều ước quốc tế mà Việt Nam là thành viên. Tuân thủ các tiêu chuẩn, quy chuẩn kỹ thuật về bảo vệ thông tin cá nhân.</p>
                </div>
            </div>
        </div>
        <div class="policy-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="policy-accordian">
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="0" data-aos-duration="300">
                            <input id="item-1" name="policy-item" type="radio" checked="">
                            <label for="item-1"><a  href="{{ URL::to('/policy-company') }}">CHÍNH SÁCH HOẠT ĐỘNG VÀ QUY ĐỊNH CHUNG TẠI WEBSITE Hiếu Store</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="10" data-aos-duration="300">
                            <input id="item-2" name="policy-item" type="radio">
                            <label for="item-2"><a  href="{{ URL::to('/policy-customer') }}">CHÍNH SÁCH BẢO VỆ THÔNG TIN CÁ NHÂN NGƯỜI DÙNG</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="20" data-aos-duration="300">
                            <input id="item-3" name="policy-item" type="radio">
                            <label for="item-3"><a  href="{{ URL::to('/policy-privacy') }}">CHÍNH SÁCH BẢO MẬT</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="30" data-aos-duration="300">
                            <input id="item-4" name="policy-item" type="radio">
                            <label for="item-4"><a  href="{{ URL::to('/policy-warranty') }}">CHÍNH SÁCH BẢO HÀNH</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="40" data-aos-duration="300">
                            <input id="item-5" name="policy-item" type="radio">
                            <label for="item-5"><a  href="{{ URL::to('/policy-return-and-refund') }}">CHÍNH SÁCH ĐỔI TRẢ HÀNG VÀ HOÀN TIỀN</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="50" data-aos-duration="300">
                            <input id="item-6" name="policy-item" type="radio">
                            <label for="item-6"><a  href="{{ URL::to('/policy-payment') }}">CHÍNH SÁCH THANH TOÁN</a></label>
                        </div>
                        <div class="policy-accordian-single-item" data-aos="fade-up"  data-aos-delay="60" data-aos-duration="300">
                            <input id="item-7" name="policy-item" type="radio">
                            <label for="item-7"><a  href="{{ URL::to('/policy-delivery') }}">CHÍNH SÁCH VẬN CHUYỂN VÀ NHẬN HÀNG</a></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...::::End  About Us Center Section:::... -->
 @push('scripts')
  <script src="{{ asset('public/frontend/js/main-policy.js') }}" defer></script>
@endpush
@endsection
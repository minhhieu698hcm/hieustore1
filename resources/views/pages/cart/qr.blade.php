@extends('layout')

@section('content')
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

                <a href="{{ URL::to('/thanh-toan') }}" class="text text-caption-1">
                    Thanh toán
                </a>
                <i class="icon icon-arrRight"></i>
            </div>

            <!-- Breadcrumb actions (prev / back / next) -->
            <div class="tf-breadcrumb-prev-next">
                <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                    <i class="icon icon-arrLeft"></i>
                </a>

                <a href="{{ URL::to('/gio-hang') }}" class="tf-breadcrumb-back" title="Giỏ hàng">
                    <i class="icon icon-squares-four"></i>
                </a>

                <a href="{{ URL::to('/san-pham') }}" class="tf-breadcrumb-next d-none d-md-flex" title="Tiếp tục mua hàng">
                    <i class="icon icon-arrRight"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
<div class="qr-section" style="padding: 40px 0; background: #ffffff; min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h3 style="text-align: center; color: #2b2b2b; padding-bottom: 10px;">Mã QR chuyển khoản ngân hàng</h3>
                <div class="qr-code-container">
                    <div id="qrSection" style="text-align: center;">
                        <img id="qrImage" src="" alt="QR Code thanh toán" style="max-width: 300px;">
                        <p style="font-size: 18px;font-weight: 700;color:#ff0000;padding-top: 10px;">Quét mã QR  phía trên để thanh toán.</p>
                    </div>    
                </div>
                <!-- Start Coupon Start -->
                <div class="coupon_area" style="padding-top: 15px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="coupon_code" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 16px;">
                                    <h3 style="text-align: center; color: #2b2b2b;">Thông tin chuyển khoản ngân hàng</h3>
                                    <div class="coupon_inner" style="padding-top: 15px;">
                                        <div class="qr_content">
                                            <p style="color: #2b2b2b;">Vui lòng chuyển đúng nội dung: <strong style="color:#ff0000">{{ $order->first_name }} {{ $order->last_name }}, {{ $order->order_number }}</strong></p>
                                        </div>
                                        <div class="qr_content">
                                            <p style="color: #2b2b2b;">Để chúng tôi có thể xác nhận thanh toán một cách nhanh chóng.</p>
                                        </div>
                                        <hr style="margin-bottom: 5px; border-color: #333;opacity:1">
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                                            <p style="color: #2b2b2b;">Tên tài khoản:</p><p style="color: #2b2b2b;">CONG TY TNHH HUY PHAT ELECTRONICS</p>
                                        </div>
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                                            <p style="color: #2b2b2b;">Chi nhánh:</p><p style="color: #2b2b2b;">Chi nhánh 6 - PGD: NGUYEN TRI PHUONG</p>
                                        </div>
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                                            <p style="color: #2b2b2b;">Số tài khoản:</p><p style="color: #2b2b2b;">112002951204</p>
                                        </div>
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                                            <p style="color: #2b2b2b;">Ngân hàng:</p><p style="color: #2b2b2b;">Ngân hàng TMCP Công thương Việt Nam</p>
                                        </div>
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                                            <p style="color: #2b2b2b;">Số tiền:</p><p style="color: #ff0000; font-weight: 600;">{{ number_format($order->total_price ?? 0, 0, ',', '.') }} ₫</p>
                                        </div>
                                        <div class="bank_info" style="display: flex; justify-content: space-between; padding: 12px 0;">
                                            <p style="color: #2b2b2b;">Nội dung:</p><p style="color: #ff0000; font-weight: 600;">{{ $order->first_name }} {{ $order->last_name }}, {{ $order->order_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Coupon Start -->
            </div>
            <div class="col-4">
                <div class="coupon_code" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 16px;">
                    <h3 style="text-align: center; color: #2b2b2b;">ĐƠN HÀNG</h3>
                    <div class="coupon_inner">
                        <div class="qr_content" style="padding-top: 5px;margin-bottom:10px">
                            <p style="color: #ff0000; font-weight: 600; text-align: center;font-size:18px"><strong>{{ $order->order_number }}</strong></p>
                        </div>
                        <hr style="margin: 0px; border-color: #2b2b2b;opacity: 1;">
                        <div class="bill_info_mini" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                            <p style="color: #2b2b2b;">Tên:</p><p style="color: #2b2b2b;">{{ $order->first_name }} {{ $order->last_name }}</p>
                        </div>
                        <div class="bill_info_mini" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                            <p style="color: #2b2b2b;">Ngày đặt:</p><p style="color: #2b2b2b;">{{ $order->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="bill_info_mini" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                            <p style="color: #2b2b2b;">Email:</p><p style="color: #2b2b2b;">{{ $order->customer_email }}</p>
                        </div>
                        <div class="bill_info_mini" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #333;">
                            <p style="color: #2b2b2b;">Tổng cộng:</p><p style="color: #ff0000; font-weight: 600;">{{ number_format($order->total_price ?? 0, 0, ',', '.') }} ₫</p>
                        </div>
                        <div class="bill_info_mini" style=" justify-content: space-between; padding: 12px 0;border-bottom: 1px solid #333;">
                            <p style="color: #2b2b2b;">Phương thức thanh toán</p>
                            <p style="color: #ff0000; font-weight:600; font-size: 16px;">
                                @if($order->payment_method == 'COD')
                            Thanh toán khi nhận hàng (COD)
                        @elseif($order->payment_method == 'Store-Cash')
                            Thanh toán tiền mặt và nhận tại cửa hàng
                        @elseif($order->payment_method == 'Store')
                            Thanh toán Ngân Hàng và nhận tại cửa hàng
                        @elseif($order->payment_method == 'NH')
                            Thanh toán Ngân Hàng và chuyển phát
                        @else
                            Không xác định
                        @endif
                            </p>
                        </div>
                        <div class="bill_info_mini" style=" justify-content: space-between; padding: 12px 0;">
                            <div class="xacnhan" style="padding-left: 10%; display:inline-block">
                        <p  style="font-size:18px; color:#ff0000;margin-bottom:0px; text-align:center; margin-top: 5px;">Sau khi thanh toán thành công.</p><p style="font-size:18px; color:#ff0000;text-align:center;margin-bottom:15px">Vui lòng nhấn  <strong style="color:#ff0000">XÁC NHẬN</strong> để đặt hàng</p>
                                <form action="{{ route('checkout.success', ['orderNumber' => $order->order_number]) }}" method="GET">
                                    @csrf
                                    <button id="xacnhan_btn" type="submit" class="btn btn-danger" style="position: relative;overflow: hidden;">Xác nhận đã thanh toán</button>
                                </form>
                    </div>
                        </div>
                        
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>
<div class="qr-section" style="padding: 40px 0; background: #fff;    ">
    <div class="container" >
            <!-- Thông tin liên hệ -->
            <div id="HEADLINE41" class="ladi-element">
                <p class="ladi-headline1 ladi-transition" style="margin-top: 10px;text-align:center; color: #2b2b2b;">
                    Quý khách hàng có thể thanh toán đơn hàng bằng cách chuyển khoản qua tài khoản của 
                    <span class="font-bold text-underline" style="color: #ff0000;font-weight:600">Huy Phát Electronics</span> tại ngân hàng bên trên và liên hệ 
                    <span class="font-bold text-underline" style="color: #ff0000;font-weight:600"><span>Hotline </span><span>0989188768</span></span>
                    để xác nhận thông tin.
                </p>
                <a href="https://zalo.me/0989188768" class="call-to-action" style="margin-top: 5px!important; display: flex; justify-content: center;">
                    <button class="cta-button" style="background: #ff0000; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; font-size: 16px;">Liên hệ ngay</button>
                </a>
            </div>
    </div>
    </div>

<script>
        function generateQR() {
            let accountNo = "112002951204"; // Số tài khoản công ty
            let bankCode = "ICB"; // Mã ngân hàng VietinBank (ICB)
            let amount = "{{ $order->total_price ?? 0 }}"; 
            let content = encodeURIComponent("{{ $order->first_name }} {{ $order->last_name }}, {{ $order->order_number }}");
            // Link ảnh QR từ VietQR
            let qrData = `https://img.vietqr.io/image/${bankCode}-${accountNo}-compact.png?amount=${amount}&addInfo=${content}`;
            // Cập nhật ảnh QR
            document.getElementById("qrImage").src = qrData;
        }
        document.addEventListener("DOMContentLoaded", generateQR);
    </script>
@endsection





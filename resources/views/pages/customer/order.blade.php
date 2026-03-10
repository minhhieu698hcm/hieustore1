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

                <a href="{{ URL::to('/don-hang') }}" class="text text-caption-1">
                    Đơn hàng
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
    <div class="container mt-3">
        <h1 class="title-cart" style="line-height: 68px;text-align: center; color:#2b2b2b;margin-bottom:20px">Đơn hàng <strong style="color:red;">{{ $order->order_number }}</strong></h1>
        @if($order)
            <!-- Order Summary -->
            <div class="col-lg-12 col-md-12 ">
                <div class="table_desc">
                    <div class="table_page table-responsive" style="overflow-y: auto; max-height: 260px;">
                        <table>
                            <!-- Start Cart Table Head -->
                            <thead>
                                <tr>
                                    <th class="product_name">Sản phẩm</th>
                                    <th class="product_quantity">SL</th>
                                    <th class="product_total">Tổng</th>
                                </tr>
                            </thead> <!-- End Cart Table Head -->

                            <tbody id="cart-items">
    @foreach($order->items as $item)
        <tr>
            {{-- Cột Sản phẩm (ảnh + tên + mã/thuộc tính) --}}
             <td class="product_name align-middle text-center">
                <div class="d-inline-flex align-items-center justify-content-center">
                    {{-- Ảnh sản phẩm --}}
                    @if(!empty($item->productData) && $item->productData->product_image)
                        <img src="{{ asset('public/upload/product/' . $item->productData->product_image) }}"
                             alt="{{ $item->product_name }}"
                             class="me-2"
                             style="width: 60px; height: 60px; object-fit: cover; border-radius:6px;">
                    @endif

                    {{-- Thông tin sản phẩm --}}
                    <div style="line-height: 1.4;">
                        <div style="font-size: 14px; font-weight: 600;">
                            {{ $item->product_name }}
                        </div>

                        <hr style="margin: 4px 0px;background:rgb(255, 0, 4);border:none;height:2px;opacity:1">

                        <div style="font-size: 13px; color:#2b2b2b;">
                            @php $attributeParts = explode(':', $item->attribute); @endphp

                            @if(!empty($item->attribute))
                                {{ trim($attributeParts[0] ?? '') }}:
                                <span style="color: red;">{{ trim($attributeParts[1] ?? '') }}</span>
                                @if(!empty($item->productAttributeCode))
                                    - Mã phân loại:
                                    <span style="color: red;">{{ $item->productAttributeCode }}</span>
                                @endif
                            @elseif(!empty($item->product_code))
                                Mã sản phẩm:
                                <span style="color: red;">{{ $item->product_code }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </td>

            {{-- Cột số lượng --}}
            <td class="align-middle text-center">
                <span style="color: red; font-weight:600;">{{ $item->quantity }}</span>
            </td>

            {{-- Cột thành tiền --}}
            <td class="align-middle text-center" style="font-weight:600;">
                {{ number_format((int) $item['quantity'] * (float) $item['price'], 0, ',', '.') }} ₫
            </td>
        </tr>
    @endforeach
</tbody>
                        </table>
                    </div>
                </div>
                @if(isset($promotions) && count($promotions))
                    <div class="mt-4">
                        <div class="table_desc">
                            <div class="table_page table-responsive" style="overflow-y: auto; max-height: 260px;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_name">Chương trình khuyến mãi</th>
                                            <th class="product_total">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td class="product_name">
                                                    <strong>{{ $promotion->title }}</strong>
                                                </td>
                                                <td class="product_name align-middle" style="padding-left: 12%">

                                                    <div class="d-flex align-items-center mt-2">
                                                        {{-- Ảnh sản phẩm --}}
                                                        @php
                                                            $displayProduct = $promotion->giftProduct ?: $promotion->product;
                                                        @endphp

                                                        @if($displayProduct && $displayProduct->product_image)
                                                            <img src="{{ asset('public/upload/product/' . $displayProduct->product_image) }}"
                                                                alt="{{ $displayProduct->product_name }}" class="promo-img me-2"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif

                                                        <div style="line-height: 1.4;">
                                                            {{-- Tên sản phẩm --}}
                                                            <div style="font-size: 14px; font-weight: 500;">
                                                                @if($displayProduct && $displayProduct->product_Slug)
                                                                    <a
                                                                        href="{{ URL::to('chi-tiet-san-pham/' . $displayProduct->product_Slug) }}">
                                                                        {{ $displayProduct->product_name }}
                                                                    </a>
                                                                @else
                                                                    {{ $displayProduct->product_name ?? '' }}
                                                                @endif
                                                            </div>

                                                            <hr style="margin: 2px 0px;background:rgb(255, 0, 4);border:none;height:2px;opacity:1">

                                                            {{-- Giá --}}
                                                            @php
                                                                $originalPrice = $displayProduct->product_price ?? $promotion->price_old;
                                                            @endphp
                                                            <div style="font-size: 14px;">
                                                                @if($originalPrice)
                                                                    <span style="text-decoration: line-through; color: #2b2b2b;">
                                                                        {{ number_format($originalPrice, 0, ',', '.') }}₫
                                                                    </span>
                                                                @endif
                                                                <span style="color: red; font-weight: 600; margin-left: 10px;">0₫</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row"
                    style="padding-right: calc(var(--bs-gutter-x)* 0.5);padding-left: calc(var(--bs-gutter-x)* 0.5);padding-bottom:20px;">
                    <div class="col-lg-7 col-md-7 coupon_code left" style="padding:0;width:65%;margin-right:10px;border: 1px solid rgba(255, 77, 79, 0.4);">
                        <h3>Thông tin thêm</h3>
                        <div class="coupon_inner">
                            @php
                                $statusMap = [
                                    'waiting' => ['text' => 'Chưa thanh toán', 'color' => 'Cyan'],
                                    'pending' => ['text' => 'Chờ xác nhận', 'color' => 'orange'],
                                    'confirmed' => ['text' => 'Đã xác nhận', 'color' => 'green'],
                                    'shipped' => ['text' => 'Đang vận chuyển', 'color' => 'blue'],
                                    'delivered' => ['text' => 'Đã giao hàng', 'color' => 'red'],
                                ];

                                $status = $order->status ?? '';
                                $statusText = $statusMap[$status]['text'] ?? 'Chưa xác định';
                                $statusColor = $statusMap[$status]['color'] ?? 'gray';
                            @endphp
                            <div class="status_bill">
                                <p id="status_bill">Trạng thái: <strong
                                        style="color: {{ $statusColor }};">{{ $statusText }}</strong></p>
                            </div>
                            <div class="payment_method">
                                <p id="payment_method">
                                    Hình thức giao nhận:
                                    <strong style="color:red">
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
                                    </strong>
                                </p>
                            </div>
                            <div class="invoice_status">
                                @if($order)
                                    <p id="invoice_status">Xuất hoá đơn:
                                        @if($order->invoice_required == 1)
                                            <strong style="color: green;">Có</strong>
                                        @else
                                            <strong style="color: red;">Không</strong>
                                        @endif
                                @endif
                                </p>
                            </div>
                            <div class="customer_email">
                                <p id="customer_email">Email của bạn: <strong
                                        style="color:red">{{ $order->customer_email }}</strong></p>
                            </div>
                            <hr style="margin: 8px 0px;background:rgb(255, 0, 4);border:none;height:2px">
                            <div class="customer_email">
                                <p style="font-size: 15px;">Thông tin đơn hàng của bạn sẽ được gửi về mail. Chúng tôi sẽ liên hệ
                                    qua số điện thoại để xác nhận.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-4 coupon_code right" style="padding:0;width:34%;border: 1px solid rgba(255, 77, 79, 0.4);">
                        <h3>Tổng giỏ hàng</h3>
                        <div class="coupon_inner">

                            @php
                                // Tính tổng tiền hàng

                                $subtotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
                                $discount = 0;
                                if (!empty($order->voucher)) {
                                    [$voucherId, $condition, $voucherNumber] = explode('-', $order->voucher);

                                    if ($condition == 1) {
                                        // Giảm phần trăm
                                        $discount = min(($subtotal * $voucherNumber / 100), $order->discount_max ?? $subtotal);
                                    } elseif ($condition == 2) {
                                        // Giảm tiền mặt
                                        $discount = min($voucherNumber, $subtotal);
                                    }
                                }
                                $saving = max(0, ($order->original_total ?? 0) - $subtotal + $discount);
                             @endphp
                            <div class="cart_subtotal">
                                <p>Giá gốc:</p>
                                <p style="color: #ef2c2c;">
                                    {{ number_format($order->original_total ?? 0, 0, ',', '.') }} ₫
                                </p>
                            </div>
							<div class="cart_subtotal">
                                <p>Tiết kiệm:</p>
                                <p id="saving" style="color: green">- 
                                    {{ number_format($saving ?? 0, 0, ',', '.') }} ₫
                                </p>
                            </div>
                            <div class="cart_subtotal">
                                <p>Tạm tính:</p>
                                <p id="subtotal" style="color: green">
                                    {{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫
                                </p>
                            </div>
                            
                            <div class="shipping-fee-1">
                                <p>Phí ship:</p>
                                <p>
                                    {{ number_format($order->shipping_fee ?? 0, 0, ',', '.') }} ₫
                                </p>
                            </div>
                            <div class="discount-amount">
                                <p>Giảm giá:</p>
                                <p id="discount-amount">
                                    - {{ number_format($discount, 0, ',', '.') }} ₫
                                </p>
                            </div>
                            <hr style="margin: 0px;background:rgb(255, 0, 4);border:none;height:2px">
                            <div class="total-amount">
                                <p>Tổng cộng:</p>
                                <p id="total-amount">
                                    {{ number_format($order->total_price, 0, ',', '.') }} ₫
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
        @else
                <p class="title-cart2">Không tìm thấy thông tin đơn hàng.</p>
                <a href="{{ route('checkout.page') }}">Quay lại trang thanh toán</a>
            @endif
        </div>
    </div>
@endsection
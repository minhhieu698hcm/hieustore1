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

                <a  class="text text-caption-1">
                    Thanh toán thành công
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

    <!-- Start Order Success Section -->
    <div class="order-success-section" style="background: #fff; padding: 40px 0; min-height: 100vh;">
        <div class="container">
            @if($order)
                <!-- Success Message -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="success-message" style="text-align: center; padding: 15px; background: #fbfbfb; border: 2px solid #22c55e; border-radius: 12px;">
                            <h2 class="text-success" style="margin-bottom: 10px; font-size: 26px; font-weight: 600; color: #22c55e;">✓ Thanh toán thành công!</h2>
                            <p style="font-size: 16px; color: #2b2b2b; margin: 0;">Cảm ơn bạn đã tin tưởng và đặt hàng. Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
                        </div>
                    </div>
                </div>

                <!-- Order Number & Items -->
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <!-- Order Items -->
                        <div class="order-items-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                            <div class="order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #333;">
                                <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: #2b2b2b;">Sản phẩm đã đặt</h4>
                                <span class="order-number" style="font-size: 14px; font-weight: 500; color: #2b2b2b;">Đơn hàng: <strong style="color: #ff0000;">{{ $order->order_number }}</strong></span>
                            </div>

                            <div class="order-items-table" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #333;">
                                            <th style="text-align: left; padding: 12px; font-weight: 600; font-size: 14px; color: #2b2b2b;">Sản phẩm</th>
                                            <th style="text-align: center; padding: 12px; font-weight: 600; font-size: 14px; width: 80px; color: #2b2b2b;">SL</th>
                                            <th style="text-align: right; padding: 12px; font-weight: 600; font-size: 14px; width: 120px; color: #2b2b2b;">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr style="border-bottom: 1px solid #2a2a2a;">
                                                <td style="padding: 16px 12px;">
                                                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                                                        @php
                                                            $productImage = null;
                                                            if(!empty($item->getAttribute('productData'))) {
                                                                $productData = $item->getAttribute('productData');
                                                                $productImage = $productData->product_image ?? null;
                                                            }
                                                        @endphp
                                                        @if($productImage)
                                                            <img src="{{ asset('public/upload/product/' . $productImage) }}"
                                                                 alt="{{ $item->product_name }}"
                                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; flex-shrink: 0;">
                                                        @endif
                                                        <div style="flex: 1; min-width: 0;">
                                                            <div style="font-weight: 500; margin-bottom: 4px; color: #2b2b2b;">{{ $item->product_name }}</div>
                                                            @php $attributeParts = explode(':', $item->attribute); @endphp
                                                            @if(!empty($item->attribute))
                                                                <div style="font-size: 13px; color: #2b2b2b; margin-bottom: 2px;">
                                                                    {{ trim($attributeParts[0] ?? '') }}: <span style="color: #ff0000; font-weight: 500;">{{ trim($attributeParts[1] ?? '') }}</span>
                                                                </div>
                                                            @elseif(!empty($item->product_code))
                                                                <div style="font-size: 13px; color: #2b2b2b;">
                                                                    Mã: <span style="color: #ff0000; font-weight: 500;">{{ $item->product_code }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="padding: 16px 12px; text-align: center; font-weight: 500; color: #2b2b2b;">{{ $item->quantity }}</td>
                                                <td style="padding: 16px 12px; text-align: right; font-weight: 600; color: #ff0000;">
                                                    {{ number_format((int) $item->quantity * (float) $item->price, 0, ',', '.') }} ₫
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Promotions/Gifts -->
                        @if(isset($promotions) && count($promotions) > 0)
                            <div class="order-promotions-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                                <h4 style="margin-top: 0; margin-bottom: 20px; font-size: 18px; font-weight: 600; color: #2b2b2b;">Quà tặng từ chương trình khuyến mãi</h4>
                                
                                <div style="display: grid; gap: 16px;">
                                    @foreach($promotions as $promotion)
                                        @php 
                                            $displayProduct = $promotion->giftProduct ?: ($promotion->product ?? null);
                                            $productImage = null;
                                            $productName = 'Sản phẩm quà tặng';
                                            $productSlug = null;
                                            $productPrice = $promotion->price_old ?? 0;
                                            
                                            if($displayProduct) {
                                                $productImage = $displayProduct->product_image ?? null;
                                                $productName = $displayProduct->product_name ?? 'Sản phẩm quà tặng';
                                                $productSlug = $displayProduct->product_Slug ?? null;
                                                $productPrice = $displayProduct->product_price ?? $promotion->price_old ?? 0;
                                            }
                                        @endphp
                                        <div style="display: flex; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid #2a2a2a;">
                                            @if($productImage)
                                                <img src="{{ asset('public/upload/product/' . $productImage) }}"
                                                     alt="{{ $productName }}"
                                                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; flex-shrink: 0;">
                                            @endif
                                            <div style="flex: 1; min-width: 0;">
                                                <div style="font-weight: 600; margin-bottom: 4px; color: #2b2b2b;">{{ $promotion->title ?? 'Chương trình khuyến mãi' }}</div>
                                                <div style="font-size: 14px; margin-bottom: 4px;">
                                                    @if($productSlug)
                                                        <a href="{{ URL::to('chi-tiet-san-pham/' . $productSlug) }}" style="color: #ff0000; text-decoration: none;">
                                                            {{ $productName }}
                                                        </a>
                                                    @else
                                                        <span style="color: #2b2b2b;">{{ $productName }}</span>
                                                    @endif
                                                </div>
                                                <div style="font-size: 14px;">
                                                    @if($productPrice)
                                                        <span style="text-decoration: line-through; color: #666;">{{ number_format($productPrice, 0, ',', '.') }}₫</span>
                                                    @endif
                                                    <span style="color: #22c55e; font-weight: 600; margin-left: 8px;">Miễn phí</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Order Info -->
                        <div class="order-info-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px;">
                            <h4 style="margin-top: 0; margin-bottom: 20px; font-size: 18px; font-weight: 600; color: #2b2b2b;">Thông tin đơn hàng</h4>
                            
                            @php
                                $statusMap = [
                                    'waitting' => ['text' => 'Chưa thanh toán', 'color' => '#06b6d4'],
                                    'pending' => ['text' => 'Chờ xác nhận', 'color' => '#f97316'],
                                    'confirmed' => ['text' => 'Đã xác nhận', 'color' => '#22c55e'],
                                    'shipped' => ['text' => 'Đang vận chuyển', 'color' => '#3b82f6'],
                                    'delivered' => ['text' => 'Đã giao hàng', 'color' => '#22c55e'],
                                ];
                                $status = $order->status ?? '';
                                $statusText = $statusMap[$status]['text'] ?? 'Chưa xác định';
                                $statusColor = $statusMap[$status]['color'] ?? '#2b2b2b';
                            @endphp

                            <div style="display: grid; gap: 16px;">
                                <div style="display: flex; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid #2a2a2a;">
                                    <span style="color: #2b2b2b; font-weight: 500;">Trạng thái:</span>
                                    <span style="color: {{ $statusColor }}; font-weight: 600;">{{ $statusText }}</span>
                                </div>

                                <div style="display: flex; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid #2a2a2a;">
                                    <span style="color: #2b2b2b; font-weight: 500;">Phương thức:</span>
                                    <span style="font-weight: 500; color: #2b2b2b;">
                                        @if($order->payment_method == 'COD')
                                            Thanh toán khi nhận hàng (COD)
                                        @elseif($order->payment_method == 'Store-Cash')
                                            Tiền mặt tại cửa hàng
                                        @elseif($order->payment_method == 'Store')
                                            Ngân hàng - Nhận tại cửa hàng
                                        @elseif($order->payment_method == 'NH')
                                            Ngân hàng - Chuyển phát
                                        @else
                                            Không xác định
                                        @endif
                                    </span>
                                </div>

                                <div style="display: flex; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid #2a2a2a;">
                                    <span style="color: #2b2b2b; font-weight: 500;">Xuất hoá đơn:</span>
                                    <span style="color: {{ $order->invoice_required == 1 ? '#22c55e' : '#ff0000' }}; font-weight: 600;">
                                        {{ $order->invoice_required == 1 ? 'Có' : 'Không' }}
                                    </span>
                                </div>

                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b; font-weight: 500;">Email:</span>
                                    <span style="font-weight: 500; color: #2b2b2b;">{{ $order->customer_email }}</span>
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #2a2a2a; font-size: 14px; color: #2b2b2b; line-height: 1.6;">
                                <p style="margin: 0;">Thông tin đơn hàng của bạn sẽ được gửi qua email. Chúng tôi sẽ liên hệ qua số điện thoại để xác nhận chi tiết đơn hàng.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Sidebar -->
                    <div class="col-lg-4 col-md-12">
                        <div class="order-summary-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; position: sticky; top: 20px;">
                            <h4 style="margin-top: 0; margin-bottom: 20px; font-size: 18px; font-weight: 600; color: #2b2b2b;">Tóm tắt đơn hàng</h4>

                            @php
                                $subtotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
                                $discount = 0;
                                if (!empty($order->voucher)) {
                                    [$voucherId, $condition, $voucherNumber] = explode('-', $order->voucher);
                                    if ($condition == 1) {
                                        $discount = min(($subtotal * $voucherNumber / 100), $order->discount_max ?? $subtotal);
                                    } elseif ($condition == 2) {
                                        $discount = min($voucherNumber, $subtotal);
                                    }
                                }
                                $saving = max(0, ($order->original_total ?? 0) - $subtotal + $discount);
                            @endphp

                            <div style="display: grid; gap: 12px; margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b;">Giá gốc</span>
                                    <span style="color: #ff0000; font-weight: 500;">{{ number_format($order->original_total ?? 0, 0, ',', '.') }} ₫</span>
                                </div>

                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b;">Tiết kiệm</span>
                                    <span style="color: #22c55e; font-weight: 500;">- {{ number_format($saving ?? 0, 0, ',', '.') }} ₫</span>
                                </div>

                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b;">Tạm tính</span>
                                    <span style="color: #22c55e; font-weight: 500;">{{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫</span>
                                </div>

                                <hr style="margin: 8px 0; border: none; border-top: 1px solid #333;">

                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b;">Phí ship</span>
                                    <span style="font-weight: 500; color: #2b2b2b;">{{ number_format($order->shipping_fee ?? 0, 0, ',', '.') }} ₫</span>
                                </div>

                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #2b2b2b;">Giảm giá</span>
                                    <span style="color: #22c55e; font-weight: 500;">- {{ number_format($discount, 0, ',', '.') }} ₫</span>
                                </div>
                            </div>

                            <hr style="margin: 16px 0; border: none; border-top: 2px solid #333;">

                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                                <span style="font-weight: 600; font-size: 16px; color: #2b2b2b;">Tổng cộng</span>
                                <span style="color: #ff0000; font-weight: 700; font-size: 20px;">{{ number_format($order->total_price, 0, ',', '.') }} ₫</span>
                            </div>

                            <div style="display: grid; gap: 10px;">
                                <a href="{{ url('/') }}" class="btn btn-outline-primary w-100" style="padding: 12px; border: 1px solid #ff0000; color: #ff0000; text-decoration: none; border-radius: 6px; text-align: center; font-weight: 500; transition: all 0.3s; background: transparent;">
                                    ← Tiếp tục mua sắm
                                </a>
                                <a href="{{ route('checkout.page') }}" class="btn btn-primary w-100" style="padding: 12px; background: #ff0000; color: white; text-decoration: none; border-radius: 6px; text-align: center; font-weight: 500; transition: all 0.3s;">
                                    Xem tất cả đơn hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div style="background: #fbfbfb; border: 2px solid #ff0000; border-radius: 12px; padding: 40px; text-align: center;">
                            <h3 style="color: #ff0000; margin-bottom: 10px; font-size: 24px; font-weight: 600;">Không tìm thấy đơn hàng</h3>
                            <p style="color: #2b2b2b; margin-bottom: 20px;">Vui lòng kiểm tra lại thông tin đơn hàng của bạn.</p>
                            <a href="{{ route('checkout.page') }}" class="btn btn-primary" style="padding: 12px 24px; background: #ff0000; color: #2b2b2b; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: 500;">
                                Quay lại thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- End Order Success Section -->
@endsection
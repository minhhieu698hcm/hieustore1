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

                <a href="{{ URL::to('/gio-hang') }}" class="text text-caption-1">
                    Giỏ hàng
                </a>
                <i class="icon icon-arrRight"></i>

                <span class="text text-caption-1">
                    Thanh toán
                </span>
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

<!-- Start Checkout Section -->
<div class="checkout-section" style="padding: 40px 0; min-height: 100vh;">
    <div class="container">
        <!-- Free Shipping Progress Bar -->
        <div class="row align-items-center" style="margin-bottom: 24px;">
            <div class="col-lg-7 col-md-12">
                <div class="meter red">
                    <span style="width: 0%;" id="free-ship-info"></span>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <p id="free-ship-text" style="margin: 0; font-size: 13px; color: #2b2b2b;">0%</p>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Form -->
            <div class="col-lg-7 col-md-12">
                <form id="checkout-form" action="{{route('checkout.create')}}" method="POST" style="margin-bottom: 24px;">
                    @csrf
                    
                    <!-- Hidden Inputs for Cart Data -->
                    <input type="hidden" name="cart" id="cart-input" value="">
                    <input type="hidden" name="voucher" class="voucher" value="">  
                    <input type="hidden" name="total_price" id="total-price-input" value="0">
                    <input type="hidden" name="original_total" id="original-total-input" value="0">
                    <input type="hidden" id="original-total-value" value="0">
                    <input type="hidden" id="discount-amount-value" value="0">
                    
                    <!-- Customer Information Card -->
                    <div class="checkout-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                        <div class="card-header" style="display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #333;">
                            <h4 style="margin: 0; font-size: 18px; font-weight: 600;">Thông tin cá nhân</h4>
                        </div>
                        <div class="row">
                            <!-- Name Fields -->
                            <div class="col-lg-6 mb-20">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; color:#2b2b2b; font-weight: 500; display: block;margin-bottom: 2px;">Họ <span style="color: #ff0000;">*</span></label>
                                    <input type="text" name="first_name" required value="{{ old('first_name') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; font-weight: 500; color:#2b2b2b; display: block;margin-bottom: 2px;">Tên <span style="color: #ff0000;">*</span></label>
                                    <input type="text" name="last_name" required value="{{ old('last_name') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="col-12 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; font-weight: 500;color:#2b2b2b; display: block;margin-bottom: 2px;">Tên công ty</label>
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Card -->
                    <div class="checkout-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                        <div class="card-header" style="display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #333;">
                            <h4 style="margin: 0; font-size: 18px; font-weight: 600; ">Địa chỉ giao hàng</h4>
                        </div>
                        <div class="row">
                            <!-- Country -->
                            <div class="col-12 mb-20">
                                <div class="default-form-box">
                                    <label for="country" style="font-size:14px;color:#2b2b2b; font-weight:500;margin-bottom: 2px;display:block;">
                                        Quốc gia <span style="color:#ff0000;">*</span>
                                    </label>
                                    <select id="country" name="country" class="form-control select2" required style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; background: #fbfbfb; ">
                                        <option value="">Chọn quốc gia</option>
                                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Việt Nam</option>
                                        <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>Trung Quốc</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Street Address -->
                            <div class="col-12 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; font-weight: 500; color:#2b2b2b;  margin-bottom: 2px; display: block;">Địa chỉ <span style="color: #ff0000;">*</span></label>
                                    <input type="text" name="address" placeholder="Số nhà và tên đường" required value="{{ old('address') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            
                            <!-- Apartment -->
                            <div class="col-12 mb-20" style="margin-top:5px;">
                                <div class="default-form-box">
                                    <input type="text" name="apartment" placeholder="Căn hộ, toà nhà, lầu (tuỳ chọn)" value="{{ old('apartment') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            
                            <!-- City & District -->
                            <div class="col-lg-6 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label for="city" style="font-size: 14px; font-weight: 500; color:#2b2b2b;  margin-bottom: 2px; display: block;">Tỉnh/Thành phố <span style="color: #ff0000;">*</span></label>
                                    <select id="city" name="city" class="form-control" required style="width: 100%; padding: 10px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b;">
                                        <option value="" style="background: #fbfbfb; color:#2b2b2b; ">Chọn tỉnh/thành phố</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label for="district" style="font-size: 14px; font-weight: 500; color:#2b2b2b;  margin-bottom: 2px; display: block;">Quận/Huyện <span style="color: #ff0000;">*</span></label>
                                    <select id="district" name="district" class="form-control" required style="width: 100%; padding: 10px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b;">
                                        <option value="" style="background: #fbfbfb; color:#2b2b2b; ">Chọn quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="checkout-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                        <div class="card-header" style="display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #333;">
                            <h4 style="margin: 0; font-size: 18px; font-weight: 600;color:#2b2b2b; ">Thông tin liên hệ</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; font-weight: 500; color:#2b2b2b; margin-bottom: 2px; display: block;">Số điện thoại <span style="color: #ff0000;">*</span></label>
                                    <input type="text" name="customer_phone" required value="{{ old('customer_phone') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20 mt-3">
                                <div class="default-form-box">
                                    <label style="font-size: 14px; font-weight: 500;color:#2b2b2b; margin-bottom: 2px; display: block;">Email <span style="color: #ff0000;">*</span></label>
                                    <input type="email" name="customer_email" required value="{{ old('customer_email') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                </div>
                            </div>
                            <div class="col-12 mb-20 mt-3">
                                <div class="order-notes">
                                    <label for="order_note" style="font-size: 14px; font-weight: 500;color:#2b2b2b;  margin-bottom: 2px; display: block;">Ghi chú đặt hàng</label>
                                    <textarea id="order_note" name="order_note" placeholder="Ghi chú về đơn đặt hàng, ví dụ: giao tận cửa." style="width: 100%; padding: 10px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; resize: vertical; min-height: 80px; font-family: inherit; color: #2b2b2b;">{{ old('order_note') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Information Card -->
                    <div class="checkout-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                        <div class="card-header" style="display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #333;">
                            <h4 style="margin: 0; font-size: 18px; font-weight: 600; color:#2b2b2b; ">Hóa đơn</h4>
                        </div>
                        <div class="invoice-required-section" style="margin-bottom: 20px;">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="invoice_required" name="invoice_required" value="1" onchange="toggleInvoiceDetails()" style="width: 18px; height: 18px; margin-top: 4px;">
                                <label for="invoice_required" class="form-check-label" style="font-size: 14px;color:#2b2b2b; margin-left: 8px;">Tôi muốn xuất hóa đơn</label>
                            </div>
                        </div>
                        
                        <!-- Invoice Details (Hidden by default) -->
                        <div id="invoiceDetails" style="display: none;">
                            <div class="row">
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label for="invoice_company_name" style="font-size: 14px; font-weight: 500; color:#2b2b2b;  margin-bottom: 2px; display: block;">Tên công ty <span style="color: #ff0000;">*</span></label>
                                        <input type="text" id="invoice_company_name" name="invoice_company_name" placeholder="Tên công ty" value="{{ old('invoice_company_name') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px;  color:#2b2b2b;  transition: border-color 0.2s;">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label for="invoice_tax_code" style="font-size: 14px; font-weight: 500; color:#2b2b2b;  margin-bottom: 2px; display: block;">Mã số thuế <span style="color: #ff0000;">*</span></label>
                                        <input type="text" id="invoice_tax_code" name="invoice_tax_code" placeholder="Mã số thuế" value="{{ old('invoice_tax_code') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color:#2b2b2b;  transition: border-color 0.2s;">
                                    </div>
                                </div>
                                <div class="col-12 mb-20 mt-3">
                                    <div class="default-form-box">
                                        <label for="invoice_address" style="font-size: 14px; font-weight: 500; color:#2b2b2b; margin-bottom: 2px; display: block;">Địa chỉ <span style="color: #ff0000;">*</span></label>
                                        <input type="text" id="invoice_address" name="invoice_address" placeholder="Địa chỉ công ty" value="{{ old('invoice_address') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                    </div>
                                </div>
                                <div class="col-12 mb-20 mt-3">
                                    <div class="default-form-box">
                                        <label for="invoice_email" style="font-size: 14px; font-weight: 500; color:#2b2b2b; margin-bottom: 2px; display: block;">Email nhận hóa đơn <span style="color: #ff0000;">*</span></label>
                                        <input type="email" id="invoice_email" name="invoice_email" placeholder="Email nhận hóa đơn" value="{{ old('invoice_email') }}" style="width: 100%; padding: 6px 12px; border: 1px solid #333; border-radius: 8px; font-size: 14px; color: #2b2b2b; transition: border-color 0.2s;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="checkout-card" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px;">
                        <div class="card-header" style="display: flex; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #333;">
                            <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: #2b2b2b;">Phương thức thanh toán</h4>
                        </div>
                        <div class="payment-methods">
                            <div class="payment-option" style="margin-bottom: 12px;">
                                <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="radio" class="form-check-input" id="COD-payment" name="payment_method" value="COD" style="width: 18px; height: 18px; margin-top: 0;">
                                    <label for="COD-payment" class="form-check-label" style="font-size: 14px; color:#2b2b2b; margin-left: 10px; cursor: pointer;">Thanh toán khi nhận hàng (COD)</label>
                                </div>
                            </div>
                            <div class="payment-option" style="margin-bottom: 12px;">
                                <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="radio" class="form-check-input" id="store-cash" name="payment_method" value="Store-Cash" style="width: 18px; height: 18px; margin-top: 0;">
                                    <label for="store-cash" class="form-check-label" style="font-size: 14px; color:#2b2b2b; margin-left: 10px; cursor: pointer;">Thanh toán tiền mặt tại cửa hàng</label>
                                </div>
                            </div>
                            <div class="payment-option" style="margin-bottom: 12px;">
                                <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="radio" class="form-check-input" id="store-payment" name="payment_method" value="Store" style="width: 18px; height: 18px; margin-top: 0;">
                                    <label for="store-payment" class="form-check-label" style="font-size: 14px; color:#2b2b2b; margin-left: 10px; cursor: pointer;">Thanh toán ngân hàng tại cửa hàng</label>
                                </div>
                            </div>
                            <div class="payment-option">
                                <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="radio" class="form-check-input" id="qr-payment" name="payment_method" value="NH" style="width: 18px; height: 18px; margin-top: 0;">
                                    <label for="qr-payment" class="form-check-label" style="font-size: 14px; color:#2b2b2b; margin-left: 10px; cursor: pointer;">Thanh toán ngân hàng và chuyển phát</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="cart" value="{{ json_encode(session('cart', [])) }}">
                
            </div>

            <!-- Right Column: Order Summary Sidebar -->
            <div class="col-lg-5 col-md-12">
                <!-- Order Summary Card (Sticky) -->
                <div class="order-summary-card sidebar-checkout-content" style="background: #fbfbfb; border: 1px solid #333; border-radius: 12px; padding: 24px; position: sticky; top: 82px;margin-bottom: 24px;">
                    <div class="card-header" style="display: flex; align-items: center; border-bottom: 1px solid #333;">
                        <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: #2b2b2b;">Đơn hàng của bạn</h4>
                    </div>

                    <!-- Cart Items List -->
                    <div class="cart-items-summary" style="max-height: 320px; overflow-y: auto; margin-bottom: 20px;">
                        <div id="cart-items">
                            @foreach(session('cart', []) as $item)
                                @php
                                    $productImage = $item['image'] ?? null;
                                    if (empty($productImage) && !empty($item['product_code'])) {
                                        $product = \App\Models\Product::where('product_code', $item['product_code'])->first();
                                        $productImage = $product ? $product->image : null;
                                    }
                                @endphp
                            <div style="display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #2a2a2a;">
                                <!-- Product Image -->
                                <div style="flex-shrink: 0; width: 70px; height: 70px; border-radius: 8px; overflow: hidden; border: 1px solid #ff0000; {{ empty($productImage) ? 'display:none;' : '' }}">
                                    @if(!empty($productImage))
                                        <img src="{{ asset('/public/upload/product/' . ltrim($productImage, '/')) }}" alt="{{ $item['name'] }}" style="width:100%;height:100%;object-fit:cover;">

                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666;">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                               <div style="flex:1;display:flex;flex-direction:column;gap:4px;">
    <!-- Tên sản phẩm -->
    <a href="{{ URL::to('chi-tiet-san-pham/' . $item['product_slug']) }}"
   style="color:#2b2b2b;text-decoration:none;font-weight:500;font-size:13px;
          display:-webkit-box;
          -webkit-line-clamp:2;
          -webkit-box-orient:vertical;
          overflow:hidden;
          line-height:1.35;
          max-height:2.7em;">
    {{ $item['name'] }}
</a>


    <!-- Thuộc tính / mã + số lượng -->
    <div style="display:flex;justify-content:space-between;align-items:center;
                font-size:12px;color:#ff0000;">
        <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            @php
                $attributeParts = explode(':', $item['attribute'] ?? '');
            @endphp

            @if(!empty($item['attribute']))
                {{ trim($attributeParts[0] ?? '') }}:
                <span style="color:#ff0000;;font-weight:600;">
                    {{ trim($attributeParts[1] ?? '') }}
                </span>
                @if(!empty($item['productAttributeCode']))
                    | {{ $item['productAttributeCode'] }}
                @endif
            @elseif(!empty($item['product_code']))
                {{ $item['product_code'] }}
            @endif
        </div>

        <span style="color:#ff0000;flex-shrink:0;">x{{ $item['quantity'] }}</span>
    </div>
</div>


                                <!-- Product Price -->
                                <div style="flex-shrink: 0; text-align: right; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div style="font-size: 12px; font-weight: 600; color: #ff0000;">
                                        {{ number_format((int)$item['quantity'] * (float)$item['price'], 0, ',', '.') }} ₫
                                    </div>
                                    <div style="font-size: 10px; color: #666;">
                                        @if(!empty($item['original_price']) && $item['original_price'] > $item['price'])
                                            <span style="text-decoration: line-through;">{{ number_format((float)$item['original_price'], 0, ',', '.') }} ₫</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Promotions Section -->
                    <div id="promotion-table-container" style="margin-bottom: 20px;"></div>

                    <div class="sec-discount">
                        <div dir="ltr" class="swiper tf-sw-categories"  data-preview="2" data-tablet="2" data-mobile-sm="2" data-mobile="1.2" data-space-lg="20" data-space-md="20" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                @foreach($vouchers as $voucher)
                                @php
                                    $isEligible = $subTotal >= $voucher->bill_price_min;
                                @endphp
                                <div class="swiper-slide">
                                    <div class="box-discount {{ $isEligible ? 'eligible' : '' }}">
                                        <div class="discount-top">
                                            <div class="discount-off">
                                                <button type="button" class="voucher-info-btn" aria-label="Thông tin voucher">
                                                    <i class="fa-solid fa-exclamation"></i>
                                                </button>
                                                <span class="sale-off text-btn-uppercase">Giảm {{ $voucher->VoucherNumber }}%</span>
                                            </div>

                                            <div class="discount-from">
                                                <p class="text-caption-1">{{ $voucher->VoucherName }}</p>
                                            </div>
                                        </div>

                                        <div class="discount-bot">
                                            <span class="text-btn-uppercase">{{ $voucher->VoucherCode }}</span>
                                            <button type="button" class="tf-btn"><span class="text">Nhận mã</span></button>
                                        </div>

                                        <!-- POPUP đặt ở đây -->
                                        <div class="voucher-info-popup" data-popup>
                                            <strong>Điều kiện áp dụng</strong>
											<ul>
    {!! $voucher->description !!}
</ul>


                                            <strong>Thời hạn</strong>
                                            {{ \Carbon\Carbon::parse($voucher->VoucherStart)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($voucher->VoucherEnd)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach 
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                        <div class="ip-discount-code">
                            <input type="text" id="discount-code" placeholder="Nhập mã giảm giá ở đây...">
                            
                            <button type="button"class="tf-btn" id="apply-discount"><span class="text">Áp dụng mã</span></button>
                            <button type="button" class="tf-btn" id="remove-discount" style="display:none;"><span class="text">Huỷ mã</span></button>
                        </div>
						<div id="voucher-login-required" class="voucher-login-required"></div>
                        <div id="discount-message" class="text-danger mt-2"></div>
                        <p class="voucher-note" ><button class="voucher-info-btn" aria-label="Thông tin voucher">
                                                    <i class="fa-solid fa-exclamation"></i>
                                                </button> Nhấn vào nút này để xem điều kiện mã khuyến mãi</p>  
                    </div>
                    <!-- Price Summary -->
                    <div class="price-summary" style="border-top: 1px solid #333; padding-top: 16px;">
                        @php
                            $cart = session('cart', []);
                            $subTotal = array_sum(array_map(fn($item) => $item['quantity'] * (float)$item['price'], $cart));
                            $originalTotal = array_sum(array_map(fn($item) => $item['quantity'] * (float)($item['original_price'] ?? $item['price']), $cart));
                            $saving = max(0, $originalTotal - $subTotal);
                            $total_amount = $subTotal;
                        @endphp

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span style="font-size: 14px; color: #2b2b2b;">Giá gốc:</span>
                            <span id="original-total" style="font-size: 14px; font-weight: 600; color: #ff0000;">{{ number_format($originalTotal, 0, ',', '.') }} ₫</span>
                            <input type="hidden" name="original_total" id="original-total-value" value="{{ $originalTotal }}">
                        </div>

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span style="font-size: 14px; color: #2b2b2b;">Tiết kiệm:</span>
                            <span id="saving" style="font-size: 14px; font-weight: 600; color: #22c55e;">- {{ number_format($saving, 0, ',', '.') }} ₫</span>
                        </div>

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span style="font-size: 14px; color: #2b2b2b;">Tạm tính:</span>
                            <span id="total-bill" data-value="{{ $subTotal }}" style="font-size: 14px; font-weight: 600; color: #2b2b2b;">{{ number_format($subTotal, 0, ',', '.') }} ₫</span>
                        </div>

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span style="font-size: 14px; color: #2b2b2b;">Phí ship:</span>
                            <span id="shipping-fee" style="font-size: 14px; font-weight: 600; color: #2b2b2b;">0 ₫</span>
                            <input type="hidden" id="shipping-fee-value" name="shipping_fee" value="">
                        </div>

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <span style="font-size: 14px; color: #2b2b2b;">Giảm giá:</span>
                            <span id="discount-amount" style="font-size: 14px; font-weight: 600; color: #22c55e;">- 0 ₫</span>
                            <input type="hidden" id="discount-amount-value" name="discount-amount" value="">
                        </div>

                        <hr style="margin: 10px 0; border: none; border-top: 2px solid #2b2b2b;">

                        <div class="price-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <span style="font-size: 16px; font-weight: 600; color: #2b2b2b;">Tổng cộng:</span>
                            <span id="total-amount" data-value="{{ $total_amount }}" style="font-size: 18px; font-weight: 700; color: #ff0000;">{{ number_format($total_amount, 0, ',', '.') }} ₫</span>
                            <input type="hidden" id="final-total-price" name="total_price" value="{{ $total_amount }}">
                        </div>
                    </div>


                    <!-- Checkout Button -->
                    <button type="submit" form="checkout-form" class="btn btn-checkout" id="checkout-button" disabled style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Thanh toán</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout Section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script>
$(document).ready(function () {

    const $applyBtn = $('#apply-discount');
    const $removeBtn = $('#remove-discount');
    const $discountCode = $('#discount-code');

    // Viết hoa mã
    $discountCode.on('input', function () {
        this.value = this.value.toUpperCase();
    });

    function formatCurrency(amount) {
        return amount.toLocaleString('vi-VN');
    }

    // ================= ÁP DỤNG MÃ =================
    $(document).on('click', '#apply-discount', function (event) {
        event.preventDefault();

        let voucherCode = $discountCode.val().trim();
        let _token = $('input[name="_token"]').val();
        let subtotal = parseFloat($('#total-bill').attr('data-value'));

        if (!voucherCode) {
            $('#discount-message').html('<span class="text-danger">Vui lòng nhập mã giảm giá</span>');
            return;
        }

        $.ajax({
            url: "{{ url('/check-voucher') }}",
            type: 'POST',
            data: {
                VoucherCode: voucherCode,
                _token: _token,
                cartTotal: subtotal
            },
            beforeSend: function () {
                $('#discount-message').html('<span class="text-info">Đang kiểm tra...</span>');
            },
            success: function (response) {
                $('#discount-message').html('<span class="text-success">Áp dụng mã giảm giá thành công</span>');

                let discount = parseFloat(response.discount);
                let condition = response.condition;
                let voucherId = response.voucher_id;
                let voucherNumber = response.voucher_number;

                if (discount > 0) {
                    $('#discount-amount').text('- ' + formatCurrency(discount) + ' ₫');
                    $('#discount-amount-value').val(discount);
                } else {
                    $('#discount-amount').text('0 ₫');
                    $('#discount-amount-value').val(0);
                }

                // Lưu voucher vào input hidden
                $('.voucher').val(`${voucherId}-${condition}-${voucherNumber}`);

                // Khóa input + đổi nút
                $discountCode.prop('readonly', true);
                $applyBtn.hide();
                $removeBtn.show();
            },
            error: function (xhr) {
                if (xhr.status === 400) {
                    $('#discount-message').html('<span class="text-danger">' + xhr.responseText + '</span>');
                } else {
                    $('#discount-message').html('<span class="text-danger">Có lỗi xảy ra, vui lòng thử lại</span>');
                }
            }
        });
    });

    // ================= HỦY MÃ =================
    $(document).on('click', '#remove-discount', function (event) {
        event.preventDefault();

        $('#discount-amount').text('0 ₫');
        $('#discount-amount-value').val(0);
        $('.voucher').val('');
        $('#discount-message').html('');

        $discountCode.prop('readonly', false).val('');
        $removeBtn.hide();
        $applyBtn.show();
         $('.box-discount.active').removeClass('active');
    });

});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("checkout-form");
    const checkoutButton = document.getElementById("checkout-button");
    const requiredFields = form.querySelectorAll("input[required], select[required]");
    const paymentRadios = document.querySelectorAll("input[name='payment_method']");
    const invoiceCheckbox = document.getElementById("invoice_required");
    const invoiceDetails = document.getElementById("invoiceDetails");
    const invoiceFields = invoiceDetails.querySelectorAll("input");
    const phoneField = form.querySelector("input[name='customer_phone']");
    const taxCodeField = form.querySelector("input[name='invoice_tax_code']");
	const codRadio = document.getElementById("COD-payment");
    const codLabel = codRadio.nextElementSibling;
    const selectedCity = document.querySelector("#city option:checked")?.textContent.trim();
    const isHCM = selectedCity === "Thành phố Hồ Chí Minh";

    function toggleInvoiceDetails() {
        if (invoiceCheckbox.checked) {
            invoiceDetails.style.display = "block";
            invoiceFields.forEach(input => input.required = true);
        } else {
            invoiceDetails.style.display = "none";
            invoiceFields.forEach(input => input.required = false);
        }
        validateForm();
    }

    function validateForm() {
		let subTotal = parseFloat(document.getElementById("total-amount").dataset.value) || 0;
        let isValid = true;

        requiredFields.forEach(field => {
            if (field.value.trim() === "") {
                isValid = false;
            }
        });

        if (invoiceCheckbox.checked) {
            invoiceFields.forEach(field => {
                if (field.value.trim() === "") {
                    isValid = false;
                }
            });

            const taxCodePattern = /^[a-zA-Z0-9]{10,15}$/;
            if (!taxCodePattern.test(taxCodeField.value) && taxCodeField.value.trim() !== "") {
                isValid = false;
            }
        }

        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneField.value) && phoneField.value.trim() !== "") {
            isValid = false;
        }
		
		let oldWarning = codLabel.parentElement.querySelector(".cod-warning");
        if (oldWarning) oldWarning.remove();

        if (isHCM) {
    if (subTotal > 1000000) {
        codRadio.disabled = true;
        codRadio.checked = false;
        const warning = document.createElement("div");
        warning.className = "text-danger mt-1 cod-warning";
        warning.textContent = "COD chỉ áp dụng cho đơn hàng dưới 1,000,000 ₫";
        codLabel.insertAdjacentElement("afterend", warning);
    } else {
        codRadio.disabled = false;
    }
}

        // Kiểm tra xem có radio nào được chọn không
        const isRadioChecked = Array.from(paymentRadios).some(radio => radio.checked);

        // Đặt radio thành readonly nếu form chưa hợp lệ
        paymentRadios.forEach(radio => {
            radio.readOnly = !isValid;
            if (!isValid) radio.checked = false; // Hủy chọn radio nếu form chưa hợp lệ
        });

        // Bật nút thanh toán khi form hợp lệ và radio được chọn
        checkoutButton.disabled = !(isValid && isRadioChecked);
    }

    phoneField.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "").slice(0, 10);
        validateForm();
    });

    taxCodeField.addEventListener("input", function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, "").slice(0, 15);
        validateForm();
    });

    requiredFields.forEach(field => {
        field.addEventListener("input", validateForm);
        field.addEventListener("change", validateForm);
        field.addEventListener("blur", validateForm);
    });

    invoiceFields.forEach(field => {
        field.addEventListener("input", validateForm);
        field.addEventListener("change", validateForm);
        field.addEventListener("blur", validateForm);
    });

    invoiceCheckbox.addEventListener("change", function () {
        toggleInvoiceDetails();
        validateForm();
    });

    paymentRadios.forEach(radio => {
        radio.addEventListener("change", validateForm);
    });

    // Lắng nghe thay đổi giá trị trên input (auto-fill)
    const observer = new MutationObserver(() => validateForm());
    requiredFields.forEach(field => observer.observe(field, { attributes: true, attributeFilter: ["value"] }));
    invoiceFields.forEach(field => observer.observe(field, { attributes: true, attributeFilter: ["value"] }));

    // Đảm bảo auto-fill được nhận diện ngay khi trang load
    window.addEventListener("load", function () {
        requiredFields.forEach(field => field.dispatchEvent(new Event("input", { bubbles: true })));
        invoiceFields.forEach(field => field.dispatchEvent(new Event("input", { bubbles: true })));
        validateForm();
    });

    window.addEventListener("pageshow", function () {
        setTimeout(validateForm, 100);
    });

    toggleInvoiceDetails();
    setTimeout(validateForm, 100);
    validateForm();
});

</script>
<script>
 document.addEventListener("DOMContentLoaded", function () {
    function updateTotalAmount() {
        let subTotal = parseFloat(document.getElementById("total-bill").dataset.value) || 0;
        let shippingFee = parseFloat(document.getElementById("shipping-fee-value").value) || 0;
        let discount = parseFloat(document.getElementById("discount-amount-value").value) || 0;

        let finalTotal = subTotal + shippingFee - discount;
        finalTotal = Math.max(finalTotal, 0); // Đảm bảo tổng không âm

        // Cập nhật lại giá trị hiển thị
        document.getElementById("total-amount").dataset.value = finalTotal;
        document.getElementById("total-amount").innerText = finalTotal.toLocaleString("vi-VN") + " ₫";
        document.getElementById("final-total-price").value = finalTotal;
    }

    // Lắng nghe sự kiện khi phí ship và giảm giá thay đổi qua JS
    let shippingFeeInput = document.getElementById("shipping-fee-value");
    let discountInput = document.getElementById("discount-amount-value");

    let observer = new MutationObserver(updateTotalAmount);
    observer.observe(shippingFeeInput, { attributes: true, attributeFilter: ["value"] });
    observer.observe(discountInput, { attributes: true, attributeFilter: ["value"] });

    // Gọi hàm tính tổng ban đầu
    updateTotalAmount();
});

</script>

{{-- <script>
    $(".meter > span").each(function () {
  $(this)
    .data("origWidth", $(this).width())
    .width(0)
    .animate(
      {
        width: $(this).data("origWidth")
      },
      1200
    );
});
</script> --}}
<!-- Load city-district trong account -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let citySelect = $("#city");
        let districtSelect = $("#district");
        let storePayment = $("#store-payment");
        let qrPayment = $("#qr-payment");
        let storeCash = $("#store-cash");
        let codPayment = $("#COD-payment");
        let shippingFeeValue = $("#shipping-fee-value");
        let shippingFeeText = $("#shipping-fee");
        let freeShipInfo = $("#free-ship-info");
        let freeShipText = $("#free-ship-text");
        let selectedCityName = $("#selected_city").val();
        let selectedDistrict = $("#selected_district").val();
        
        if ($.fn.niceSelect) {
        citySelect.niceSelect("destroy");
        districtSelect.niceSelect("destroy");
        }
        districtSelect.prop("disabled", true);
    
        // Load danh sách tỉnh/thành phố
        fetch("https://provinces.open-api.vn/api/p/")
            .then(response => response.json())
            .then(data => {
                citySelect.html('<option value="">Chọn tỉnh/thành phố</option>');
                let matchedCityCode = "";
    
                data.forEach(province => {
                    let selected = "";
                    if (selectedCityName === province.name) {
                        matchedCityCode = province.code;
                        selected = "selected";
                    }
                    citySelect.append(`<option value="${province.code}" ${selected} data-name="${province.name}">${province.name}</option>`);
                });
    
                citySelect.select2({ placeholder: "Chọn tỉnh/thành phố", allowClear: true, width: "100%" });
                districtSelect.select2({ placeholder: "Chọn quận/huyện", allowClear: true, width: "100%" });
    
                if (matchedCityCode) {
                    loadDistricts(matchedCityCode, selectedDistrict);
                    updatePaymentMethods();
                }
            })
            .catch(error => console.error("Lỗi khi lấy dữ liệu tỉnh/thành phố:", error));
    
        // Khi chọn tỉnh/thành phố
        citySelect.on("change", function () {
            let provinceCode = $(this).val();
            if (!provinceCode) {
                districtSelect.html('<option value="">Chọn quận/huyện</option>').prop("disabled", true).trigger("change");
                return;
            }
            loadDistricts(provinceCode, null);
            updatePaymentMethods();
            calculateShippingFee();
        });
    
        // Load danh sách quận/huyện
        function loadDistricts(provinceCode, selectedDistrict) {
            fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.html('<option value="">Chọn quận/huyện</option>');
    
                    data.districts.forEach(district => {
                        let selected = (selectedDistrict == district.name) ? "selected" : "";
                        districtSelect.append(`<option value="${district.name}" ${selected}>${district.name}</option>`);
                    });
    
                    districtSelect.prop("disabled", false).trigger("change");
                })
                .catch(error => console.error("Lỗi khi lấy dữ liệu quận/huyện:", error));
        }
    
        // Cập nhật phương thức thanh toán dựa vào thành phố được chọn
        function updatePaymentMethods() {
            const selectedCity = $("#city option:selected").text().trim();
            const isHCM = selectedCity === "Thành phố Hồ Chí Minh";
    
            // Nếu không phải HCM & HN => Chỉ cho phép QR Payment
             if (!isHCM) {
                storePayment.prop("disabled", true).prop("checked", false);
                storeCash.prop("disabled", true).prop("checked", false);
                codPayment.prop("disabled", true).prop("checked", false);
                qrPayment.prop("disabled", false).prop("checked", true);
            } else {
                storePayment.prop("disabled", false);
                storeCash.prop("disabled", false);
                codPayment.prop("disabled", false);
            }
    
            updateShippingFee();
        }
    
        // Hàm tính phí ship
        function calculateShippingFee() {
            const subTotal = parseFloat($("#total-bill").data("value")) || 0;
            const selectedCity = $("#city option:selected").text().trim(); 
            
            // Nếu chưa chọn thành phố thì ship = 0
    if (!selectedCity) {
        $("#shipping-fee").text("0 ₫");
        $("#shipping-fee-value").val(0);
        $("#free-ship-info").css("width", "0%");
        $("#free-ship-text").html("");
        return;
    }
    
            let ship = 0;
            let freeShipThreshold = 0;
            if (["Thành phố Hồ Chí Minh", "Thành phố Hà Nội"].includes(selectedCity)) {
                freeShipThreshold = 300000;
                ship = subTotal >= freeShipThreshold ? 0 : 25000;
            } else {
                freeShipThreshold = 450000;
                ship = subTotal >= freeShipThreshold ? 0 : 30000;
            }
    
            shippingFeeText.text(new Intl.NumberFormat("vi-VN").format(ship) + " ₫");
            shippingFeeValue.val(ship);
    
            // Tính toán tiến trình miễn phí vận chuyển
            let percentageAchieved = Math.min((subTotal / freeShipThreshold) * 100, 100).toFixed(1);
            $("#free-ship-info")
    .stop(true)
    .animate(
        { width: percentageAchieved + "%" },
        {
            duration: 900,
            easing: "swing"
        }
    );
    
            if (subTotal < freeShipThreshold) {
                let amountRemaining = freeShipThreshold - subTotal;
                $("#free-ship-text")
  .removeClass("is-freeship")
  .addClass("not-freeship")
  .html(`Bạn cần mua thêm <strong>${new Intl.NumberFormat("vi-VN").format(amountRemaining)} ₫</strong> để miễn phí vận chuyển`);

            } else {
                $("#free-ship-text")
  .removeClass("not-freeship")
  .addClass("is-freeship")
  .html(`Chúc mừng Bạn được <strong class="free-highlight">miễn phí</strong> vận chuyển!`);

            }
        }
    
        // Cập nhật phí ship khi chọn phương thức thanh toán
        function updateShippingFee() {
            if (storePayment.is(":checked") || storeCash.is(":checked")) {
                shippingFeeValue.val(0);
                shippingFeeText.text("0 ₫");
                $("#free-ship-info").css("width", "100%");
                $("#free-ship-text")
  .removeClass("not-freeship")
  .addClass("is-freeship")
  .html(`Chúc mừng Bạn được <strong class="free-highlight">miễn phí</strong> vận chuyển!`);

            } else {
                calculateShippingFee();
            }
        }
    
        // Lắng nghe sự kiện click trên radio buttons
        storePayment.on("click", updateShippingFee);
        storeCash.on("click", updateShippingFee);
        qrPayment.on("click", updateShippingFee);
        codPayment.on("click", updateShippingFee);
    
        // Khi submit form => Lưu tên tỉnh/thành phố thay vì mã code
        $("form").on("submit", function () {
            let selectedCityCode = citySelect.val();
            let selectedCityName = citySelect.find(":selected").data("name");
    
            if (selectedCityCode && selectedCityName) {
                $("<input>").attr({
                    type: "hidden",
                    name: "city",
                    value: selectedCityName
                }).appendTo(this);
            }
    
            districtSelect.prop("disabled", false);
        });
    
        // Tính phí ship ngay khi load trang
        calculateShippingFee();
    });
    
    </script>
    
             <!-- load city-district trong account -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Khi người dùng chọn hoặc bỏ chọn checkbox quà tặng
        document.querySelectorAll('.gift-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const productId = this.dataset.productId;
                const promotionId = this.dataset.promotionId;
                if (this.checked) {
                    // Gọi AJAX để thêm quà vào giỏ
                    fetch("{{ url('/promotions/add-gift-to-cart') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ product_id: productId, promotion_id: promotionId })
                    }).then(res => res.json()).then(data => {
                        // Có thể reload lại trang hoặc cập nhật giỏ hàng nếu cần
                    });
                } else {
                    // Gọi AJAX để xóa quà khỏi giỏ
                    fetch("{{ url('/cart/remove-from-cart') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ product_id: productId, is_gift: true })
                    }).then(res => res.json()).then(data => {
                        // Có thể reload lại trang hoặc cập nhật giỏ hàng nếu cần
                    });
                }
            });
        });
    });
    </script>
<script>
$(document).on('click', 'button.combo-toggle-btn', function (e) {
    e.preventDefault();

    let btn         = $(this);
    let promotionId = btn.data('promotion-id');
    let productId   = btn.data('product-id');
    let comboPrice  = btn.data('price');
    let checkbox    = $('#combo-' + promotionId);

    let state = btn.data('state') || 'add';

    if (state === 'add') {
        addComboToCart(promotionId, productId, comboPrice, function(success, cart, totals) {
            if (success) {
                checkbox.prop('checked', true);
                btn.text('Bỏ mua kèm')
                   .removeClass('btn-primary')
                   .addClass('btn-danger')
                   .data('state', 'remove');

                renderCheckoutItems(cart);
                renderTotals(totals);
            }
        });
    } else {
        removeComboFromCart(promotionId, function(success, cart, totals) {
            if (success) {
                checkbox.prop('checked', false);
                btn.text('Mua kèm')
                   .removeClass('btn-danger')
                   .addClass('btn-primary')
                   .data('state', 'add');

                renderCheckoutItems(cart);
                renderTotals(totals);
            }
        });
    }
});

function addComboToCart(promotionId, productId, comboPrice, callback) {
    $.post("{{ url('/promotions/add-combo-to-cart') }}", {
        promotion_id: promotionId,
        product_id: productId,
        price: comboPrice,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function(res) {
        if (res.success) {
            renderCheckoutItems(res.cart);
            renderTotals(res.totals);
            renderPromotions(); // 🔑 reload lại khuyến mãi để đồng bộ trạng thái
            callback(true, res.cart, res.totals);
        } else {
            alert(res.message);
            callback(false, [], {});
        }
    });
}

function removeComboFromCart(promotionId, callback) {
    $.post("{{ url('/promotions/remove-combo-from-cart') }}", {
        promotion_id: promotionId,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function(res) {
        if (res.success) {
            renderCheckoutItems(res.cart);
            renderTotals(res.totals);
            renderPromotions(); // 🔑 reload lại khuyến mãi để đồng bộ trạng thái
            callback(true, res.cart, res.totals);
        } else {
            alert(res.message);
            callback(false, [], {});
        }
    });
}

function renderCheckoutItems(cart) {
    let html = '';
    cart.forEach(item => {
        html += `
            <tr>
                <td class="product_name">
                    <a href="/chi-tiet-san-pham/${item.product_slug}">
                        ${item.name}
                    </a>
                    <div style="font-size: 14px; margin-top: 4px;">
                        ${item.product_code 
                            ? `Mã sản phẩm: <span style="color: red;">${item.product_code}</span> - SL: <span style="color: red;">${item.quantity}</span>`
                            : `SL: <span style="color: red;">${item.quantity}</span>`
                        }
                    </div>
                </td>
                <td style="font-weight:600;">
                    ${(item.quantity * item.price).toLocaleString('vi-VN')} ₫
                </td>
            </tr>
        `;
    });

    $('#cart-items').html(html);
    $('input[name="cart"]').val(JSON.stringify(cart)); // ✅ đồng bộ input hidden
}

function renderTotals(totals) {
    $('#original-total').text(totals.originalTotal.toLocaleString('vi-VN') + ' ₫');
    $('#saving').text('- ' + totals.saving.toLocaleString('vi-VN') + ' ₫');
    $('#total-bill')
        .text(totals.subTotal.toLocaleString('vi-VN') + ' ₫')
        .attr('data-value', totals.subTotal);

    $('#total-amount')
        .text(totals.totalAmount.toLocaleString('vi-VN') + ' ₫')
        .attr('data-value', totals.totalAmount);

    $('#original-total-value').val(totals.originalTotal);
    $('#final-total-price').val(totals.totalAmount);
    $('#discount-amount-value').val($('#discount-amount-value').val() || 0);
    $('#shipping-fee-value').val($('#shipping-fee-value').val() || 0);

    if (typeof updateTotalAmount === 'function') {
        updateTotalAmount();
    }

    if (window._giftPromotions) {
        updateGiftProgress(totals.subTotal, window._giftPromotions);
    }
}

function updateGiftProgress(subTotal, giftPromotions) {
    giftPromotions.forEach(promotion => {
        let eligible = subTotal >= promotion.min_total_for_gift;
        let needMore = promotion.min_total_for_gift - subTotal;
        let cell = $(`#gift-progress-${promotion.id}`);

        if (eligible) {
            cell.html(`
                <input type="checkbox" class="form-check-input gift-checkbox" 
                    id="gift-checkbox-${promotion.id}" data-product-id="${promotion.gift_product_id}" data-promotion-id="${promotion.id}" checked>
                <label for="gift-checkbox-${promotion.id}"><strong style="color:red">NHẬN QUÀ</strong></label>
                <div style="font-size:16px;color:green;font-weight:600;">🎉 Chúc mừng bạn đạt điều kiện nhận quà</div>
            `);
        } else {
            cell.html(`
                <div style="font-size:14px;color:#555;">
                    Bạn cần mua thêm <span style="color:red;font-weight:bold;">${Number(needMore).toLocaleString('vi-VN')}₫</span> để nhận quà
                </div>
            `);
        }
    });

    // 🔑 gắn lại event cho checkbox gift sau khi render
    bindGiftCheckboxEvents();
}

// ================== RENDER PROMOTIONS ==================
function renderPromotions() {
    $.get("{{ url('/promotions/valid') }}", function(res) {
        let html = '';

        if(res.comboPromotions.length || res.giftPromotions.length) {
            html += `<div class="table_desc mt-3">
                        <div class="table_page table-responsive" style="overflow-y:auto; max-height:315px;">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_name">Chương trình khuyến mãi</th>
                                    <th class="product_total">Tiến độ</th>
                                </tr>
                            </thead>
                            <tbody>`;

            // Combo
            res.comboPromotions.forEach(promotion => {
                let inCart = res.comboInCart.includes(String(promotion.id));
                let displayProduct = promotion.gift_product || promotion.product;
                let originalPrice = displayProduct.product_price || promotion.price_old;
    
                html += `<tr>
                    <td class="product_name">
                        <strong>${promotion.title}</strong>
                        <div class="d-flex align-items-center mt-2">
                            ${displayProduct.product_image ? `<img src="/public/upload/product/${displayProduct.product_image}" class="promo-img me-2" style="width:60px;height:60px;object-fit:cover;">` : ''}
                            <div>
                                <div><a href="/chi-tiet-san-pham/${displayProduct.product_slug}">${displayProduct.product_name}</a></div>
                                <div style="font-size:14px;margin-top:4px;">
                                    ${originalPrice ? `<span style="text-decoration:line-through;">${Number(originalPrice).toLocaleString('vi-VN')}₫</span>` : ''}
                                    <span style="color:red;font-weight:600;margin-left:10px;">${Number(promotion.combo_price).toLocaleString('vi-VN')} ₫</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="checkbox" id="combo-${promotion.id}" disabled ${inCart ? 'checked' : ''}>
                        <button class="btn btn-sm combo-toggle-btn ${inCart ? 'btn-danger' : 'btn-primary'}"
                            data-promotion-id="${promotion.id}"
                            data-product-id="${promotion.gift_product_id}"
                            data-price="${promotion.combo_price}"
                            data-state="${inCart ? 'remove' : 'add'}">
                            ${inCart ? 'Bỏ mua kèm' : 'Mua kèm'}
                        </button>
                    </td>
                </tr>`;
            });

            // Gift
            res.giftPromotions.forEach(promotion => {
                let displayProduct = promotion.gift_product || promotion.product;
                let originalPrice = displayProduct.product_price || promotion.price_old;
                let eligible = res.subTotal >= promotion.min_total_for_gift;

                html += `<tr>
                    <td class="product_name align-middle">
                        <strong>${promotion.title}</strong>
                        <div class="d-flex align-items-center mt-2">
                            ${displayProduct.product_image ? `<img src="/public/upload/product/${displayProduct.product_image}" class="promo-img me-2" style="width:60px;height:60px;object-fit:cover;">` : ''}
                            <div>
                                <div><a href="/chi-tiet-san-pham/${displayProduct.product_slug}">${displayProduct.product_name}</a></div>
                                <div style="font-size:14px;">
                                    ${originalPrice ? `<span style="text-decoration:line-through;">${Number(originalPrice).toLocaleString('vi-VN')}₫</span>` : ''}
                                    <span style="color:red;font-weight:600;margin-left:10px;">0₫</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td id="gift-progress-${promotion.id}">
                        ${eligible ? `
                            <input type="checkbox" class="form-check-input gift-checkbox"
                                id="gift-checkbox-${promotion.id}" data-product-id="${promotion.gift_product_id}" data-promotion-id="${promotion.id}" checked>
                            <label for="gift-checkbox-${promotion.id}"><strong style="color:red">NHẬN QUÀ</strong></label>
                        ` : `
                            <div style="font-size:14px;color:#555;">
                                Bạn cần mua thêm <span style="color:red;font-weight:bold;">${Number(promotion.min_total_for_gift - res.subTotal).toLocaleString('vi-VN')}₫</span> để nhận quà
                            </div>
                        `}
                    </td>
                </tr>`;
            });

            html += `</tbody></table></div></div>`;
        }

        $('#promotion-table-container').html(html);
        window._giftPromotions = res.giftPromotions || [];

        // 🔑 gắn lại event cho checkbox gift
        bindGiftCheckboxEvents();
    });
}

// ================== GIFT CHECKBOX EVENT ==================
function bindGiftCheckboxEvents() {
    $('.gift-checkbox').off('change').on('change', function() {
        const productId = $(this).data('product-id');
        const promotionId = $(this).data('promotion-id');

        if ($(this).is(':checked')) {
            $.post("{{ url('/promotions/add-gift-to-cart') }}", {
                product_id: productId,
                promotion_id: promotionId,
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function(res) {
                if(res.success) {
                    renderCheckoutItems(res.cart);
                    renderTotals(res.totals);
                }
            });
        } else {
            $.post("{{ url('/cart/remove-from-cart') }}", {
                product_id: productId,
                is_gift: true,
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function(res) {
                if(res.success) {
                    renderCheckoutItems(res.cart);
                    renderTotals(res.totals);
                }
            });
        }
    });
}

// Load promotions khi page ready
$(document).ready(function(){
    renderPromotions();
    
    // Xử lý submit form - cập nhật dữ liệu cart
    $('#checkout-form').on('submit', function(e) {
        // Lấy dữ liệu giỏ hàng từ session
        const cart = {!! json_encode(session('cart', [])) !!};
        const cartJSON = JSON.stringify(cart);
        
        // Lấy giá trị từ các input
        const totalPrice = parseFloat($('#final-total-price').val()) || 0;
        const originalTotal = parseFloat($('#original-total-value').val()) || 0;
        const shippingFee = parseFloat($('#shipping-fee-value').val()) || 0;
        const voucher = $('.voucher').val() || '';

        
        // Cập nhật hidden inputs
        $('#cart-input').val(cartJSON);
        $('#total-price-input').val(totalPrice);
        $('#original-total-input').val(originalTotal);
        $('#shipping-fee-input').val(shippingFee);
        $('#voucher-input').val(voucher);
        
        // Cho phép submit
        return true;
    });
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    $('#country').select2({
        placeholder: "Chọn quốc gia",
        allowClear: true,
        width: "100%",
        minimumResultsForSearch: Infinity
    });
});

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.querySelector('.tf-sw-categories');
    if (!el) return;

    new Swiper(el, {
        slidesPerView: "auto",
        spaceBetween: 20,
        freeMode: true,              // trượt mượt
        grabCursor: true,            // icon bàn tay
        mousewheel: {
            forceToAxis: true
        },
        scrollbar: {
            el: el.querySelector('.swiper-scrollbar'),
            draggable: true,         // KÉO thanh scroll được
            hide: false              // luôn hiển thị
        }
    });
});
</script>
<script>
const POPUP_WIDTH = 240;

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.voucher-info-btn');
    const popupClicked = e.target.closest('.voucher-info-popup');

    // Click ra ngoài popup + nút → đóng hết
    if (!btn && !popupClicked) {
        closeAllPopups();
        return;
    }

    // Click trong popup → không làm gì
    if (popupClicked && !btn) return;

    if (!btn) return;

    e.stopPropagation(); // NGĂN bubble gây mở lại

    const box = btn.closest('.box-discount');
    const popup = box.querySelector('.voucher-info-popup');
    if (!popup) return;

    const isOpen = popup.classList.contains('showing');

    // Đóng hết trước
    closeAllPopups();

    // Nếu trước đó đang mở → chỉ đóng (toggle off)
    if (isOpen) return;

    // Mở popup
    openPopup(btn, popup);
});


function openPopup(btn, popup) {
    popup._parentBox = btn.closest('.box-discount');
    document.body.appendChild(popup);

    const rect = btn.getBoundingClientRect();

    let left = rect.left;
    if (left + POPUP_WIDTH > window.innerWidth - 10) {
        left = window.innerWidth - POPUP_WIDTH - 10;
    }

    popup.style.top = rect.bottom + 8 + 'px';
    popup.style.left = left + 'px';
    popup.style.display = 'block';
    popup.classList.add('showing');
}

function closePopup(popup) {
    popup.style.display = 'none';
    popup.classList.remove('showing');

    if (popup._parentBox) {
        popup._parentBox.appendChild(popup);
    }
}

function closeAllPopups() {
    document.querySelectorAll('.voucher-info-popup.showing').forEach(closePopup);
}
// Đóng popup khi scroll (bất kỳ scroll nào)
window.addEventListener('scroll', closeAllPopups, true);

// Đóng khi resize luôn cho gọn
window.addEventListener('resize', closeAllPopups);

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;
    const voucherInput = document.querySelector('#discount-code');
    const applyBtn = document.getElementById('apply-discount');
    const loginBox = document.getElementById('voucher-login-required');

    // Disable voucher không đủ điều kiện
    document.querySelectorAll('.box-discount').forEach(box => {
        const btn = box.querySelector('.discount-bot .tf-btn');
        if (!box.classList.contains('eligible')) {
            btn.classList.add('disabled');
            btn.disabled = true;
        }
    });

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.box-discount .discount-bot .tf-btn');
        if (!btn || btn.classList.contains('disabled')) return;

        const box = btn.closest('.box-discount');
        const code = box.querySelector('.discount-bot span').innerText.trim();

        // ❌ CHƯA LOGIN
        if (!body.classList.contains('logged-in')) {
            loginBox.innerHTML = `
                <div class="voucher-login-warning">
                    <span>Vui lòng đăng nhập để sử dụng mã giảm giá này</span>
                    <a href="{{ URL::to('/login') }}" class="tf-btn login-now">Đăng nhập</a>
                </div>
            `;
            return;
        }

        // ✅ ĐÃ LOGIN → tiếp tục apply
        loginBox.innerHTML = '';

        if (voucherInput) voucherInput.value = code;

        document.querySelectorAll('.box-discount.active')
            .forEach(b => b.classList.remove('active'));

        box.classList.add('active');

        if (applyBtn) applyBtn.click();
    });

});
</script>


<!--Chuan-->
@endsection


@extends('layout')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div
                        class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Giỏ hàng</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{ URL::to('https://khotoolsocial.click/') }}">Trang chủ</a></li>
                                    <li class="active" aria-current="page">Giỏ hàng</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section" style="background: #0a0a0a; padding: 40px 0; min-height: 100vh;">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0"  data-aos-duration="300">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc" style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; padding: 24px;">
                            <h3 style="color: #fff; margin-bottom: 20px;">Giỏ hàng của bạn</h3>
                            <div class="table_page table-responsive" style="overflow-y: auto; max-height: 400px;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr style="border-bottom: 1px solid #333;">
                                            <th class="product_remove" style="color: #aaa; padding: 12px 0;">Xoá</th>
                                            <th class="product_thumb" style="color: #aaa; padding: 12px 0;">Hình</th>
                                            <th class="product_name" style="color: #aaa; padding: 12px 0;">Sản phẩm</th>
                                            <th class="product-price" style="color: #aaa; padding: 12px 0;">Giá</th>
                                            <th class="product_quantity" style="color: #aaa; padding: 12px 0;">Số lượng</th>
                                            <th class="product_total" style="color: #aaa; padding: 12px 0;">Tổng</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody id="cart-items">
                                        <!-- Start Cart Single Item-->
                                        @foreach($cart as $key => $item)
                                            <tr style="border-bottom: 1px solid #333;">
                                                <td class="product_remove" style="padding: 12px 0;"><a href="#" class="remove-item"
                                                        data-product-id="{{ $key }}" style="color: #ff6b6b;"><i class="fa-regular fa-trash-can"></i></a>
                                                </td>
                                                <td class="product_thumb" style="padding: 12px 0;"> <a
                                                        href="{{ URL::to('chi-tiet-san-pham/' . $item['product_slug'])}}"><img
                                                            src="{{ URL::to('public/upload/product/' . $item['image']) }}"
                                                            alt="" style="max-width: 60px; border-radius: 8px;"></a></td>
                                                @php
                                                    $attributeParts = explode(':', $item['attribute'], 2);
                                                @endphp

                                                <td class="product_name" style="padding: 12px 0;">
                                                    <a href="{{ URL::to('chi-tiet-san-pham/' . $item['product_slug']) }}" style="color: #4a9eff;">
                                                        {{ $item['name'] }}
                                                    </a>
                                                    <div style="font-size: 13px; margin-top: 4px; color: #888;">
                                                        @if(!empty($item['attribute']))
                                                            {{ $attributeParts[0] ?? '' }}: <span
                                                                style="color: #ff6b6b;">{{ trim($attributeParts[1] ?? '') }}</span>
                                                            @if(!empty($item['productAttributeCode']))
                                                                - Mã phân loại: <span
                                                                    style="color: #ff6b6b;">{{ $item['productAttributeCode'] }}</span>
                                                            @endif
                                                        @elseif(!empty($item['product_code']))
                                                            Mã sản phẩm: <span
                                                                style="color: #ff6b6b;">{{ $item['product_code'] }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="product-price" style="padding: 12px 0;">
                                                    @if(!empty($item['original_price']) && $item['original_price'] > $item['price'])
                                                        <span style="color: #ff6b6b; font-weight: bold;">
                                                            {{ number_format((float) $item['price'], 0, ',', '.') }} ₫
                                                        </span><br>
                                                        <span style="text-decoration: line-through;font-size:14px; color: #666;">
                                                            {{ number_format((float) $item['original_price'], 0, ',', '.') }} ₫
                                                        </span>
                                                    @else
                                                        <span style="color: #ff6b6b; font-weight: bold;">
                                                            {{ number_format((float) $item['price'], 0, ',', '.') }} ₫
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="product_quantity" style="padding: 12px 0;">
                                                    <label style="color: #ddd;">Số lượng</label>
                                                    <input min="1" max="100" value="{{ $item['quantity'] }}" type="number"
                                                        data-product-id="{{ $key }}" class="update-quantity" style="width: 60px; padding: 6px; background: #0f0f0f; border: 1px solid #333; border-radius: 6px; color: #fff;">
                                                </td>
                                                <td class="product_total" style="padding: 12px 0; color: #ff6b6b; font-weight: 600;">
                                                    {{ number_format((int) $item['quantity'] * (float) $item['price'], 0, ',', '.') }}
                                                    ₫</td>
                                            </tr> <!-- End Cart Single Item-->
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="cart_submit" style="margin-top: 20px;">
                                <button class="animated-button1" type="submit" id="clear-cart1" style="background: #ff6b6b; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
                                    <span></span><span></span><span></span><span></span>Xoá giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

        <!-- Start Coupon Start -->
        <div class="coupon_area" style="padding: 40px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="coupon_code right" style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; padding: 24px;">
                            <h3 style="color: #fff;">Tổng giỏ hàng</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal" style="padding: 12px 0; border-bottom: 1px solid #333;">
                                    <p style="color: #aaa;">Tạm tính</p>
                                    <p id="tamtinh" class="cart_amount" style="color: #ff6b6b; font-weight: 600;">0 ₫</p>
                                </div>
                                <div class="checkout_btn mt-3">
                                    <a href="{{ route('checkout.page') }}" class="animated-button1" style="display: block; background: #0066cc; color: #fff; padding: 12px 24px; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 500; margin-top: 16px;">
                                        Tiến hành thanh toán
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->

    </div> <!-- ...:::: End Cart Section:::... -->
    <script>
        $(document).on('change', '.update-quantity', function () {
            var productId = $(this).data('product-id');
            var newQuantity = $(this).val(); // Lấy số lượng mới từ input
            var row = $(this).closest('tr'); // Dòng chứa sản phẩm

            if (newQuantity < 1 || newQuantity > 100) {
                alert('Số lượng phải nằm trong khoảng từ 1 đến 100.');
                return;
            }

            $.ajax({
                url: "{{ url('/update-cart-quantity') }}",
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: newQuantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        // Cập nhật giá tiền của sản phẩm
                        row.find('.product_total').text(response.product_total + ' ₫');

                        // Cập nhật tổng số lượng và giỏ hàng
                        renderCartItems(response.cart);

                        // Tùy chọn: Cập nhật tổng giá trị giỏ hàng (nếu có)
                        if (response.cart_total) {
                            $('#cart-total').text(response.cart_total + ' ₫');
                        }
                    } else {
                        alert(response.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        });
    </script>
@endsection
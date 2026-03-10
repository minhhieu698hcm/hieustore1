@component('mail::message')
# Xin chào {{$order->first_name}} {{$order->last_name}},

<span style="color:#2b2b2b">Cảm ơn bạn đã tin tưởng và đặt hàng tại **Unitek Việt Nam**! Dưới đây là chi tiết đơn hàng của bạn:</span>

---

## **<span style="color:#2b2b2b">Thông tin đơn hàng</span>**
- **<span style="color:#2b2b2b">Mã đơn hàng**: **{{ $order->order_number }}**</span>
- **<span style="color:#2b2b2b">Địa chỉ giao hàng**<span style="color:#2b2b2b">: {{ $order->address }}, {{ $order->district }}, {{ $order->city }}</span>
- **<span style="color:#2b2b2b">Số điện thoại**<span style="color:#2b2b2b">: {{ $order->customer_phone }}</span>
- **<span style="color:#2b2b2b">Ngày đặt hàng**<span style="color:#2b2b2b">: {{ $order->created_at->format('d/m/Y') }}</span>
- **<span style="color:#2b2b2b">Xuất hoá đơn**<span style="color:#2b2b2b">: {{ $order->invoice_required == 1 ? 'Có' : 'Không' }}</span>

---

## **<span style="color:#2b2b2b">Chi tiết sản phẩm</span>**
<table width="100%" style="font-size: 13px; border-collapse: collapse; margin-bottom: 20px;">
    <thead style="background-color: #f5f5f5;">
        <tr>
            <th align="left" style="padding: 8px; border-bottom: 1px solid #ddd;">Sản phẩm</th>
            <th align="center" style="padding: 8px; border-bottom: 1px solid #ddd;">Số lượng</th>
            <th align="right" style="padding: 8px; border-bottom: 1px solid #ddd;">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($order->items as $item)
        @php
            $attributeParts = explode(':', $item->attribute);
        @endphp
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #eee; font-weight: 600; color: #2b2b2b;">
                {{ $item->product_name }}
                <div style="font-size: 13px; margin-top: 4px; font-weight: normal;">
                    @if (!empty($item->attribute))
                        {{ trim($attributeParts[0] ?? '') }}:
                        <span style="color: red;">{{ trim($attributeParts[1] ?? '') }}</span>
                        @if (!empty($item->productAttributeCode))
                            - Mã phân loại: <span style="color: red;">{{ $item->productAttributeCode }}</span>
                        @endif
                    @elseif (!empty($item->product_code))
                        Mã sản phẩm: <span style="color: red;">{{ $item->product_code }}</span>
                    @endif
                </div>
            </td>
            <td align="center" style="padding: 8px; border-bottom: 1px solid #eee;">{{ $item->quantity }}</td>
            <td align="right" style="padding: 8px; border-bottom: 1px solid #eee;">
                {{ number_format($item->quantity * $item->price, 0, ',', '.') }} ₫
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


---

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
    $total = $subtotal + ($order->shipping_fee ?? 0) - $discount;
@endphp

## **<span style="color:#2b2b2b">Phí và tổng cộng</span>**
<table width="100%" style="font-size: 13px; border-collapse: collapse; margin-top: 10px;">
    <tbody>
        <tr>
            <td style="padding: 8px;">Giá gốc</td>
            <td align="right" style="padding: 8px;">{{ number_format($order->original_total ?? 0, 0, ',', '.') }} ₫</td>
        </tr>
		<tr>
            <td style="padding: 8px;">Tiết kiệm</td>
            <td align="right" style="padding: 8px;">- {{ number_format($saving ?? 0, 0, ',', '.') }} ₫</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Tạm tính</td>
            <td align="right" style="padding: 8px;">{{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Phí ship</td>
            <td align="right" style="padding: 8px;">{{ number_format($order->shipping_fee ?? 0, 0, ',', '.') }} ₫</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Giảm giá</td>
            <td align="right" style="padding: 8px;">- {{ number_format($discount ?? 0, 0, ',', '.') }} ₫</td>
        </tr>
        <tr style="background-color: #f5f5f5;">
            <td style="padding: 8px;"><strong>Tổng cộng</strong></td>
            <td align="right" style="padding: 8px;"><strong>{{ number_format($total ?? 0, 0, ',', '.') }} ₫</strong></td>
        </tr>
    </tbody>
</table>
@php
    $showPromotionTitle = false;
    $orderTotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
@endphp

@if(isset($promotions) && count($promotions))
    @foreach($promotions as $promotion)
        @if(
            ($promotion->promotion_type == 'gift' && isset($promotion->min_total_for_gift) && $orderTotal >= $promotion->min_total_for_gift)
            || $promotion->promotion_type == 'combo'
        )
            @php $showPromotionTitle = true; @endphp
        @endif
    @endforeach
@endif

@if($showPromotionTitle)
<div style="background: #fffbe6; border-radius: 8px; border: 1px solid #ffe58f; padding: 18px 20px; margin: 24px 0;">
    <ul style="padding-left: 18px; margin: 0;">
        @foreach($promotions as $promotion)
            @if($promotion->promotion_type == 'gift' && isset($promotion->min_total_for_gift) && $orderTotal >= $promotion->min_total_for_gift)
                <li style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #faad14;">{{ $promotion->title }}</span><br>
                    <span style="color: #333;">🎁 Quà tặng: <span style="color: #e74c3c;">{{ $promotion->giftProduct->product_name ?? '' }}</span></span><br>
                    @php
                    $originalPrice = $promotion->giftProduct
                        ? $promotion->giftProduct->product_price
                        : ($promotion->product->product_price ?? $promotion->price_old);
                    @endphp
                    <div style="font-size: 14px;">
                        @if($originalPrice)
                            <span style="text-decoration: line-through; color: #2b2b2b;">Giá gốc: 
                                {{ number_format($originalPrice, 0, ',', '.') }}₫
                            </span>
                        @endif
                        <span style="color: red; font-weight: 600; margin-left: 10px;">0₫</span>
                    </div>
                </li>
            @elseif($promotion->promotion_type == 'combo')
                <li style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #faad14;">{{ $promotion->title }}</span><br>
                    <span style="color: #333;">🛒 Mua kèm: <span style="color: #e67e22;">{{ $promotion->giftProduct->product_name ?? '' }}</span></span><br>
                    <span style="color: #888;">Giá mua kèm: {{ number_format($promotion->combo_price, 0, ',', '.') }} ₫</span>
                </li>
            @endif
        @endforeach
    </ul>
</div>
@endif
---

@component('mail::button', ['url' => route('order.details', ['orderNumber' => $order->order_number])])
Xem đơn hàng của bạn
@endcomponent

<span style="color:#2b2b2b">Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email **{{ config('mail.from.address') }}** hoặc hotline **0963 620 629**.</span>

<span style="color:#2b2b2b">Trân trọng,  
**Unitek Việt Nam**</span>
@endcomponent
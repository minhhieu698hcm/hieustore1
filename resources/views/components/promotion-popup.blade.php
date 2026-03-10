<style>
    #promotion-popup {
        position: fixed;
        left: 24px;
        bottom: 24px;
        z-index: 2147483647 !important;
        max-width: 370px;
        width: 95%;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        display: none;
        animation: fadeInUp 0.4s;
        padding: 0;
        overflow: hidden;
        border: 1.5px solid #e74c3c;
    }
    #promotion-popup .popup-header {
        background: linear-gradient(90deg, #ff1900 60%, #f04843 100%);
        color: #fff;
        padding: 14px 18px 10px 18px;
        position: relative;
    }
    #promotion-popup .btn-close {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
        background: #0d0d0d;
        border-radius: 15%;
        padding: 4px 8px;
        opacity: 1;
        transition: background 0.2s;
        border: none;
        color: #fff;
        font-size: 20px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #promotion-popup .btn-close:hover {
        background: #222;
        color: #fff;
        opacity: 1;
    }
    #promotion-popup .popup-body {
        padding: 10px;
    }
    #promotion-popup .promo-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 14px;
        border: 1px solid #eee;
        background: #fafafa;
    }
    #promotion-popup .promo-title {
        font-size: 15px;
        font-weight: 600;
        color: #ff0000;
        margin-bottom: 4px;
    }
    #promotion-popup .promo-price {
        font-size: 18px;
        font-weight: 700;
        color: #27ae60;
		margin-left: 8px;
    }
    #promotion-popup .promo-old {
        font-size: 0.95rem;
        color: #2b2b2b;
		font-weight:600;
        text-decoration: line-through;
    }
    #promotion-popup .promo-desc {
        font-size: 0.97rem;
        color: #444;
        margin-bottom: 10px;
        margin-top: 4px;
        line-height: 1.5;
    }
    #promotion-popup .promo-btn {
        display: block;
        width: 100%;
        background: linear-gradient(90deg, #ff1900 60%, #f04843 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        text-align: center;
        font-size: 1rem;
        margin-top: 8px;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(231,76,60,0.08);
        text-decoration: none;
    }
    #promotion-popup .promo-btn:hover {
        background: linear-gradient(90deg, #ff1900 60%, #f04843 100%);
        color: #fff;
        text-decoration: none;
    }
    #promotion-popup-toggle {
        position: fixed;
        left: 24px;
        bottom: 24px;
        z-index: 1051;
        background: #ff0000;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        font-size: 22px;
        cursor: pointer;
        transition: background 0.2s;
        padding: 0;
        animation: bell-shake 1.1s ease-in-out infinite;
    transform-origin: 50% 0; /* Tâm xoay ở trên để giống chuông */
    }
    #promotion-popup-toggle i {
        margin: 0;
        padding: 0;
        font-size: 22px;
        line-height: 1;
        display: block;
    }
    #promotion-popup-toggle:hover {
        background: #ff2727;
    }
    @keyframes fadeInUp {
        from { transform: translateY(40px); opacity: 0;}
        to { transform: translateY(0); opacity: 1;}
    }
    @keyframes bell-shake {
    0%, 100% { transform: rotate(0); }
    10% { transform: rotate(15deg); }
    20% { transform: rotate(-15deg); }
    30% { transform: rotate(10deg); }
    40% { transform: rotate(-10deg); }
    50% { transform: rotate(5deg); }
    60% { transform: rotate(-5deg); }
    70%, 90% { transform: rotate(0deg); }
    }
</style>

<div id="promotion-popup">
    <div class="popup-header">
        <span class="popup-header-title" id="popupHeaderTitle" style="font-size: 18px; font-weight: 800;">{{ 'ƯU ĐÃI HÔM NAY!' ?? $promotion->title}}</span>
        <button type="button" class="btn-close" aria-label="Close" onclick="hidePromotionPopup()">
            &times;
        </button>
    </div>
    <div class="popup-body">
    <div class="d-flex align-items-center mb-2">
        {{-- Ảnh sản phẩm quà tặng/mua kèm --}}
        @if($promotion->giftProduct && $promotion->giftProduct->product_image)
            <img src="{{ asset('public/upload/product/' . $promotion->giftProduct->product_image) }}" alt="Sản phẩm khuyến mãi" class="promo-img">
        @endif

        {{-- Ảnh sản phẩm chính nếu có --}}
        @if($promotion->promotion_type == 'combo' && $promotion->product && $promotion->product->product_image)
            <img src="{{ asset('public/upload/product/' . $promotion->product->product_image) }}" alt="Sản phẩm chính" class="promo-img" style="border:2px solid #f7b267;">
        @endif

        <div>
            {{-- Lấy tên sản phẩm từ bảng product --}}
            <div class="promo-title">
                <a href="{{ URL::to('chi-tiet-san-pham/' . $promotion->giftProduct->product_Slug) }}">
                                                                    {{ $promotion->giftProduct->product_name }}
                </a>
                {{-- {{ $promotion->giftProduct ? $promotion->giftProduct->product_name : ($promotion->product->product_name ?? $promotion->title) }} --}}
            </div>

            <div>
                {{-- Giá gốc lấy từ bảng product --}}
                @php
                    $originalPrice = $promotion->giftProduct
                        ? $promotion->giftProduct->product_price
                        : ($promotion->product->product_price ?? $promotion->price_old);
                @endphp
                @if($originalPrice)
                    <span class="promo-old">{{ number_format($originalPrice, 0, ',', '.') }}₫</span>
                @endif
				 {{-- Giá giảm = 0₫ --}}
                <span class="promo-price">0₫</span>
            </div>
        </div>
    </div>

    <div class="promo-desc">{!! nl2br(e($promotion->description)) !!}</div>
</div>

</div>
<button id="promotion-popup-toggle" title="Xem khuyến mãi" onclick="showPromotionPopup()" style="display:none;">
    <i class="fa-solid fa-gift" style="margin-bottom: 10px; font-size: 35px;"></i>
</button>

<script>
    // Ẩn popup body ngay khi load
    window.addEventListener('DOMContentLoaded', function() {
        document.getElementById('promotion-popup').style.display = 'none';
        document.getElementById('promotion-popup-toggle').style.display = 'flex';
    });

    function hidePromotionPopup() {
        document.getElementById('promotion-popup').style.display = 'none';
        document.getElementById('promotion-popup-toggle').style.display = 'flex';
    }
    function showPromotionPopup() {
        document.getElementById('promotion-popup').style.display = 'block';
        document.getElementById('promotion-popup-toggle').style.display = 'none';
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleEl = document.getElementById('popupHeaderTitle');
        const titles = [
            'ƯU ĐÃI HÔM NAY!',
            @json($promotion->title ?? 'ƯU ĐÃI HÔM NAY!')
        ];

        let index = 0;
        setInterval(() => {
            index = (index + 1) % titles.length;
            titleEl.textContent = titles[index];
        }, 2000); // đổi mỗi 2 giây
    });
</script>
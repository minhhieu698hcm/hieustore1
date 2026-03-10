@extends('layout')
@section('content')

        <!-- Slider -->
        <section class="tf-slideshow slider-style2 slider-effect-fade hero-area">
            <div dir="ltr"
                class="swiper tf-sw-slideshow hero-area-wrapper"
                data-preview="1"
                data-tablet="1"
                data-mobile="1"
                data-centered="false"
                data-space="0"
                data-space-mb="0"
                data-loop="true"
                data-auto-play="true"
                data-delay="4000"
                data-speed="1000">

                <div class="swiper-wrapper slide-banner-hero">
                    @foreach($banner_hero as $index => $banner)
                        <div class="swiper-slide hero-area-single">
                            <div class="wrap-slider hero-area-bg">
                                <a href="{{ $banner->link ?? '#' }}">
                                    <img
                                        class="hero-img lazyload"
                                        data-src="{{ asset('public/upload/banner_hero/' . $banner->image_url) }}"
                                        src="{{ asset('public/upload/banner_hero/' . $banner->image_url) }}"
                                        alt="Banner {{ $index + 1 }}"
                                        @if($index === 0)
                                            loading="eager"
                                            fetchpriority="high"
                                        @else
                                            loading="lazy"
                                        @endif
                                        decoding="async"
                                    >
                                </a>

                                {{-- Nếu sau này cần text + button thì mở block này --}}
                                {{--
                                <div class="box-content type-3">
                                    <div class="container">
                                        <div class="content-slider">
                                            <div class="box-title-slider">
                                                <div class="fade-item fade-item-1 text-btn-uppercase text-primary">
                                                    Tiêu đề phụ
                                                </div>
                                                <div class="fade-item fade-item-2 heading title-display font-5 fw-7">
                                                    Tiêu đề chính
                                                </div>
                                                <p class="fade-item fade-item-3 body-text-1">
                                                    Mô tả ngắn banner
                                                </p>
                                            </div>
                                            <div class="fade-item fade-item-4 box-btn-slider">
                                                <a href="{{ $banner->link ?? '#' }}" class="tf-btn btn-fill">
                                                    <span class="text">Xem ngay</span>
                                                    <i class="icon icon-arrowUpRight"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                --}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="wrap-pagination d-block stype-space-3">
                    <div class="container">
                        <div class="sw-dots sw-pagination-slider type-square justify-content-center"></div>
                    </div>
                </div>
            </div>
        </section>
    
    <!-- Banner Highlight -->
    <section class="flat-spacing pt-3" >
        <div class="container">
            <div class="tf-grid-layout md-col-3">
                @forelse($banner_highlight->take(3) as $index => $banner)
                    <div class="collection-position-2 style-7 hover-img">
                        <a href="{{ $banner->link ?? '#' }}" class="img-style" target="_blank">
                            <img class="lazyload" 
                                data-src="{{ asset('public/upload/3_banner_highlight/' . $banner->image_url) }}"
                                src="{{ asset('public/upload/3_banner_highlight/' . $banner->image_url) }}"
                                alt="{{ $banner->title ?? 'Ưu đãi' }}"
                                width="588" height="400" loading="lazy">
                        </a>
                        <div class="content space-lg align-items-center d-flex flex-column gap-12" style="left: 210px;">
                            {{-- <h4 class="title fw-7 font-5 category-title" style="color: #ffffff;">
                                <a href="{{ $banner->link ?? '#' }}" class="link" target="_blank" style="color: #ffffff;">
                                    {{ $banner->title ?? 'Ưu đãi' }}
                                </a>
                            </h4> --}}
                            <a href="{{ $banner->link ?? '#' }}" class="tf-btn btn-fill btn-md wmax" target="_blank">
                                <span class="text">Mua ngay</span>
                                <i class="icon icon-arrowUpRight"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Không có ưu đãi nổi bật</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sản phẩm mới -->
    <section style="padding: 20px 0; margin: 0;background-color: #fbfbfb;">
        <div class="container">
            <div style="margin-bottom: 15px;">
                <h3 class="fw-7 font-5 tektur-title" style="margin: 0; color: #ff0000; min-height: 2em; display: flex; align-items: center;">
                    <span id="typing-text" style="display: inline-block; min-width: 200px;"></span>
                </h3>
            </div>

                        <div id="product_new" dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2"
                            data-space-lg="12" data-space-md="8" data-space="5" data-pagination="1"
                            data-pagination-md="0" data-pagination-lg="0">
                            <div class="swiper-wrapper">
                                @forelse($product_new as $product)
                                    <div class="swiper-slide">
                                        <div class="card-product" style="padding: 0;">
                                            <div class="card-product-wrapper aspect-ratio-1">
                                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="product-img">
                                                    <img class="lazyload img-product"
                                                        data-src="{{ URL::to('public/upload/product/' . $product->product_image) }}"
                                                        src="{{ URL::to('public/upload/product/' . $product->product_image) }}"
                                                        alt="{{ $product->product_name }}" loading="lazy">
                                                    @if($product->product_image_hover)
                                                        <img class="lazyload img-hover"
                                                            data-src="{{ URL::to('public/upload/product/' . $product->product_image_hover) }}"
                                                            src="{{ URL::to('public/upload/product/' . $product->product_image_hover) }}"
                                                            alt="{{ $product->product_name }}" loading="lazy">
                                                    @endif
                                                </a>
                                               @if(isset($product->discount_percent) && $product->discount_percent > 0)
                                                    @if(isset($product->discount_percent) && $product->discount_percent > 0)
                                                                <div class="badge badge-discount">- {{ $product->discount_percent }}%</div>
                                                            @else
                                                                <div class="badge badge-discount invisible">- 0%</div>
                                                            @endif
                                                   @php
                                                        $marqueeItems = [
                                                            [
                                                                'type' => 'text',
                                                                'value' => 'Ưu đãi nóng – Giảm ' . $product->discount_percent . '%'
                                                            ],
                                                            [
                                                                'type' => 'icon',
                                                                'value' => 'icon-lightning'
                                                            ],
                                                        ];
                                                    @endphp

                                                    <div class="marquee-product bg-main">
                                                        @for ($j = 0; $j < 2; $j++)
                                                            <div class="marquee-wrapper">
                                                                <div class="initial-child-container">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @foreach ($marqueeItems as $item)
                                                                            <div class="marquee-child-item">
                                                                                @if ($item['type'] === 'text')
                                                                                    <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                                                        {{ $item['value'] }}
                                                                                    </p>
                                                                                @else
                                                                                    <span class="icon {{ $item['value'] }} text-critical"></span>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                @endif
                                                <div class="list-product-btn">
                                                    <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading quick-view-btn" data-product-id="{{ $product->product_id }}">
                                                        <span class="icon icon-eye"></span>
                                                        <span class="tooltip">Xem nhanh</span>
                                                    </a>
                                                </div>
                                                <div class="list-btn-main">
                                                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="btn-main-product">Xem chi tiết</a>
                                                </div>
                                            </div>
                                            <div class="card-product-info" style="padding: 8px 5px;">
                                              <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="title link" style="font-size: 13px;">{{ $product->product_name }}</a>
                                                <div class="price" style="margin-top: 5px; font-size: 12px;">
                                                    @if ($product->product_price === 'LIÊN HỆ' || $product->product_price == 0)
                                                        <span class="current-price" style="color: #ffffff;">LIÊN HỆ</span>
                                                    @elseif (!empty($product->original_price))
                                                        <span class="old-price" style="font-size: 12px;">{{ number_format($product->original_price, 0, ',', '.') }} đ</span><br>
                                                        <span class="current-price" style="color: #ff0000;">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                                    @else
                                                        <span class="current-price" style="color: #ff0000;">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="swiper-slide">
                                        <p class="text-center text-muted">Không có sản phẩm mới</p>
                                    </div>
                                @endforelse
                            </div>
                            <div class="swiper-pagination"></div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev d-lg-flex nav-sw style-line nav-sw-right space-2"></div>
                            <div class="swiper-button-next d-lg-flex nav-sw style-line nav-sw-left space-2"></div>
                        </div>
        </div>
    </section>

  
     <!-- Banner Middle -->
    <section class="section-top-gap-100" >
        <div class="container">
            <div class="row">
                        <div class="col-12">
                            <div class="banner-single" data-aos="fade-up" data-aos-delay="0" data-aos-duration="300">
                                <a href="{{ $banner_middle->link ?? '#' }}" class="banner-img-link" target="_blank">
                                    <img class="banner-img banner-img-big"
                                        src="{{ asset('public/upload/banner_middle/' . $banner_middle->image_url) }}"
                                        alt="Banner middle" width="1176" height="506" loading="lazy">
                                </a>
                            </div>
                        </div>
                    </div>
        </div>
    </section>

    <!-- Ưu đãi hấp dẫn -->


    <section class="flat-spacing section-top-gap-100" style="padding: 20px 0;background-color: #fbfbfb;">
    <div class="container">

        <div class="heading-section-4 wow fadeInUp">
            <h3 class="fw-7 font-5 tektur-title" style="margin:0;color:#ff0000;min-height:2.5em;">
                <span id="typing-text-sale"></span>
            </h3>
            <a href="{{ URL::to('/san-pham?sort_by=on_sale&page=1') }}" class="btn-line style-white">
                Xem tất cả sản phẩm
            </a>
        </div>

        @if($product_sale->count())
        <div id="product_sale"
             class="swiper tf-sw-latest"
             data-preview="4"
             data-tablet="3"
             data-mobile="2"
             data-space-lg="12"
             data-space-md="8"
             data-space="5"
             data-pagination="1">

            <div class="swiper-wrapper">
                @foreach($product_sale as $product)
                    <div class="swiper-slide">
                                        <div class="card-product" style="padding: 0;">
                                            <div class="card-product-wrapper aspect-ratio-1">
                                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="product-img">
                                                    <img class="lazyload img-product"
                                                        data-src="{{ URL::to('public/upload/product/' . $product->product_image) }}"
                                                        src="{{ URL::to('public/upload/product/' . $product->product_image) }}"
                                                        alt="{{ $product->product_name }}" loading="lazy">
                                                    @if($product->product_image_hover)
                                                        <img class="lazyload img-hover"
                                                            data-src="{{ URL::to('public/upload/product/' . $product->product_image_hover) }}"
                                                            src="{{ URL::to('public/upload/product/' . $product->product_image_hover) }}"
                                                            alt="{{ $product->product_name }}" loading="lazy">
                                                    @endif
                                                </a>
                                               @if(isset($product->discount_percent) && $product->discount_percent > 0)
                                                    @if(isset($product->discount_percent) && $product->discount_percent > 0)
                                                                <div class="badge badge-discount">- {{ $product->discount_percent }}%</div>
                                                            @else
                                                                <div class="badge badge-discount invisible">- 0%</div>
                                                            @endif
                                                   @php
                                                        $marqueeItems = [
                                                            [
                                                                'type' => 'text',
                                                                'value' => 'Ưu đãi nóng – Giảm ' . $product->discount_percent . '%'
                                                            ],
                                                            [
                                                                'type' => 'icon',
                                                                'value' => 'icon-lightning'
                                                            ],
                                                        ];
                                                    @endphp

                                                    <div class="marquee-product bg-main">
                                                        @for ($j = 0; $j < 2; $j++)
                                                            <div class="marquee-wrapper">
                                                                <div class="initial-child-container">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @foreach ($marqueeItems as $item)
                                                                            <div class="marquee-child-item">
                                                                                @if ($item['type'] === 'text')
                                                                                    <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                                                        {{ $item['value'] }}
                                                                                    </p>
                                                                                @else
                                                                                    <span class="icon {{ $item['value'] }} text-critical"></span>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                @endif
                                                <div class="list-product-btn">
                                                    <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading quick-view-btn" data-product-id="{{ $product->product_id }}">
                                                        <span class="icon icon-eye"></span>
                                                        <span class="tooltip">Xem nhanh</span>
                                                    </a>
                                                </div>
                                                <div class="list-btn-main">
                                                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="btn-main-product">Xem chi tiết</a>
                                                </div>
                                            </div>
                                            <div class="card-product-info" style="padding: 8px 5px;">
                                              <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="title link" style="font-size: 13px;">{{ $product->product_name }}</a>
                                                <div class="price" style="margin-top: 5px; font-size: 12px;">
                                                    @if ($product->product_price === 'LIÊN HỆ' || $product->product_price == 0)
                                                        <span class="current-price" style="color: #ffffff;">LIÊN HỆ</span>
                                                    @elseif (!empty($product->original_price))
                                                        <span class="old-price" style="font-size: 12px;">{{ number_format($product->original_price, 0, ',', '.') }} đ</span><br>
                                                        <span class="current-price" style="color: #ff0000;">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                                    @else
                                                        <span class="current-price" style="color: #ff0000;">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation -->
            <div class="swiper-button-prev nav-sw"></div>
            <div class="swiper-button-next nav-sw"></div>
        </div>
        @else
            <div class="text-center text-muted py-5">
                Hiện chưa có sản phẩm giảm giá
            </div>
        @endif

    </div>
</section>

<style>
    /* ===== BACKGROUND & HEADING ===== */
    .section-top-gap-100 {
        margin-top:30px;
    }

    .heading-section .heading {
        color: #000000;
        text-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
        letter-spacing: 1px;
    }

    .heading-section .subheading {
        color: #2b2b2b;
    }

    /* ===== SCROLL CONTAINER ===== */
    .youtube-scroll-container {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding: 10px 0;
    }

    .youtube-scroll-wrapper {
        display: flex;
        gap: 22px;
        will-change: transform;
        transition: transform 0.05s linear;
    }

    /* ===== VIDEO CARD ===== */
    .youtube-scroll-item {
        flex: 0 0 calc(25% - 17px);
        min-width: calc(25% - 17px);
        cursor: pointer;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        aspect-ratio: 16 / 9;
        background: #111;
        border: 1px solid rgba(255, 0, 0, 0.15);
        box-shadow: 0 0 0 rgba(255, 0, 0, 0);
        transition: all 0.35s ease;
    }

    .youtube-scroll-item img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.6s ease, filter 0.4s ease;
        filter: brightness(0.85) contrast(1.05);
    }

    /* Glow đỏ khi hover */
    .youtube-scroll-item:hover {
        transform: translateY(-6px) scale(1.02);
        border: 1px solid rgba(255, 0, 0, 0.6);
        box-shadow: 0 0 18px rgba(255, 0, 0, 0.35),
                    0 0 35px rgba(255, 0, 0, 0.15);
    }

    .youtube-scroll-item:hover img {
        transform: scale(1.08);
        filter: brightness(1) contrast(1.1);
    }

    /* ===== PLAY BUTTON STYLE GAMING ===== */
    .youtube-scroll-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle, rgba(255,0,0,0.15) 0%, rgba(0,0,0,0.6) 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .youtube-scroll-item::before {
        content: '▶';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 28px;
        color: #ff2a2a;
        background: rgba(0,0,0,0.75);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 12px rgba(255, 0, 0, 0.7);
        z-index: 2;
        transition: all 0.3s ease;
    }

    .youtube-scroll-item:hover::before {
        transform: translate(-50%, -50%) scale(1.15);
        box-shadow: 0 0 20px rgba(255, 0, 0, 1);
    }

    .youtube-scroll-item:hover::after {
        opacity: 1;
    }

    /* ===== MODAL GAMING STYLE ===== */
    .youtube-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(40,0,0,0.95), rgba(0,0,0,0.98));
        backdrop-filter: blur(6px);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .youtube-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .youtube-modal-content {
        position: relative;
        width: 90%;
        max-width: 920px;
        aspect-ratio: 16 / 9;
        border-radius: 14px;
        box-shadow: 0 0 30px rgba(255, 0, 0, 0.4);
    }

    .youtube-modal-content iframe {
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 14px;
    }

    .youtube-modal-close {
        position: absolute;
        top: -45px;
        right: 0;
        color: #fff;
        font-size: 34px;
        font-weight: bold;
        cursor: pointer;
        text-shadow: 0 0 10px red;
        transition: all 0.3s ease;
    }

    .youtube-modal-close:hover {
        color: #ff2a2a;
        transform: scale(1.2);
    }

    /* ===== MOBILE ===== */
    @media (max-width: 768px) {
        .youtube-scroll-item {
            flex: 0 0 calc(50% - 12px);
            min-width: calc(50% - 12px);
        }
    }
    
</style>
    {{-- <!-- YouTube Reviews -->
    <section class="section-top-gap-100" style="background-color: #1a1a1a; padding: 60px 0;">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp" style="margin-bottom: 40px;">
                <h3 class="heading font-5 fw-bold" style="margin-bottom: 15px; color: #ffffff;">Đánh giá từ YouTube</h3>
                <p class="subheading" style="color: #b0b0b0;">Xem những đánh giá chi tiết từ các YouTuber hàng đầu</p>
            </div>
            
            <div class="youtube-scroll-container">
                <div class="youtube-scroll-wrapper">
                    <!-- First set -->
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('PoOdMZPmTfQ')">
                        <img src="https://img.youtube.com/vi/PoOdMZPmTfQ/maxresdefault.jpg" alt="YouTube Video 1">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('76kM_UXrATc')">
                        <img src="https://img.youtube.com/vi/76kM_UXrATc/maxresdefault.jpg" alt="YouTube Video 2">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('f4ZiyOanhHE')">
                        <img src="https://img.youtube.com/vi/f4ZiyOanhHE/maxresdefault.jpg" alt="YouTube Video 3">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('76kM_UXrATc')">
                        <img src="https://img.youtube.com/vi/76kM_UXrATc/maxresdefault.jpg" alt="YouTube Video 4">
                    </div>
                    <!-- Duplicate set for seamless loop -->
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('PoOdMZPmTfQ')">
                        <img src="https://img.youtube.com/vi/PoOdMZPmTfQ/maxresdefault.jpg" alt="YouTube Video 1">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('76kM_UXrATc')">
                        <img src="https://img.youtube.com/vi/76kM_UXrATc/maxresdefault.jpg" alt="YouTube Video 2">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('f4ZiyOanhHE')">
                        <img src="https://img.youtube.com/vi/f4ZiyOanhHE/maxresdefault.jpg" alt="YouTube Video 3">
                    </div>
                    <div class="youtube-scroll-item" onclick="openYoutubeModal('76kM_UXrATc')">
                        <img src="https://img.youtube.com/vi/76kM_UXrATc/maxresdefault.jpg" alt="YouTube Video 4">
                    </div>
                </div>
            </div>

            <!-- YouTube Modal -->
            <div id="youtubeModal" class="youtube-modal" onclick="if(event.target === this) closeYoutubeModal()">
                <div class="youtube-modal-content">
                    <span class="youtube-modal-close" onclick="closeYoutubeModal()">&times;</span>
                    <iframe id="youtubeIframe" src="" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Logo đối tác -->
    <section class="flat-spacing" style="padding: 40px 0; background-color: #fbfbfb;">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp" style="margin-bottom: 60px;">
                <h3 class="heading font-5 fw-bold partner-title" style="margin-bottom: 15px; color: #000000cf;">Đối tác tin cậy</h3>
                <p class="subheading" style="margin: 0; color: #2b2b2b;">Chúng tôi tự hào kết hợp với những thương hiệu hàng đầu trên thế giới</p>
            </div>
            <div id="logo_partner" dir="ltr" class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="3"
                data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="20" data-space="15"
                data-pagination="1" data-pagination-md="1" data-pagination-lg="1" style="margin: 0 -15px;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="padding: 0 15px;">
                        <div style="background: white; padding: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; min-height: 280px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                            <a href="https://khotoolsocial.click/" target="_blank" rel="nofollow noopener" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                <img src="{{ asset('public/frontend/images/logo/logo.webp') }}"
                                    alt="Hiếu Store" class="img-fluid" style="max-height: 120px; object-fit: contain;" loading="lazy">
                            </a>
                        </div>
                    </div>
                     {{-- <div class="swiper-slide" style="padding: 0 15px;">
                        <div style="background: white; padding: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; min-height: 280px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                            <a href="" target="_blank" rel="nofollow noopener" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                <img src="{{ asset('public/frontend/images/company_logo/logoCertificate.webp') }}"
                                    alt="Chứng nhận Hiếu Store" style="max-height: 120px; object-fit: contain;" loading="lazy">
                            </a>
                        </div>
                    </div>  --}}
                    {{-- <div class="swiper-slide" style="padding: 0 15px;">
                        <div style="background: white; padding: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; min-height: 280px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                            <a href="" target="_blank" rel="nofollow noopener" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                <img src="{{ asset('public/frontend/images/company_logo/company_logo_2.webp') }}"
                                    alt="Hiếu Store" class="img-fluid" style="max-height: 120px; object-fit: contain;" loading="lazy">
                            </a>
                        </div>
                    </div> --}}
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Blog mới nhất -->
    <section class="flat-spacing">
        <div class="container">
            <div class="heading-section-4 style-2 wow fadeInUp">
               <h3 class="fw-7 font-5 tektur-title" style="margin:0;color:#ff0000;min-height:2.5em;">
                <span id="typing-text-blog"></span>
            </h3>
                <a href="{{ URL::to('/tin-tuc') }}" class="btn-line style-white">Xem tất cả bài viết</a>
            </div>
            <div dir="ltr" class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile-sm="1.7"
                data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                data-pagination-md="1" data-pagination-lg="1">
                <div class="swiper-wrapper">
                    @forelse ($blog_index as $index => $blog)
                        <div class="swiper-slide">
                            <div class="collection-position-2 style-5 has-overlay hover-img wow fadeInUp"
                                data-wow-delay="{{ ($index * 0.1) }}s">
                                <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="img-style">
                                    <img class="lazyload" data-src="{{ asset('public/upload/blog/' . $blog->blog_image) }}"
                                        src="{{ asset('public/upload/blog/' . $blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                                </a>
                                <div class="content text-start">
                                    <span class="text-btn-uppercase text-white">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->locale('vi')->translatedFormat('d F') }}
                                    </span>
                                    <h4 class="title"><a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="link text-white">{{ $blog->blog_title }}</a></h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-center text-muted">Không có bài viết nào</p>
                        </div>
                    @endforelse
                </div>
                <div class="sw-pagination-collection sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>

    <!-- Modal popup -->
    @if(session('success'))
        <div class="modal" id="successModal" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông báo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="document.getElementById('successModal').style.display='none';">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a class="animated-button1" data-dismiss="modal"
                            onclick="document.getElementById('successModal').style.display='none';">
                            <span></span><span></span><span></span><span></span>Đóng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
    const typingText = document.getElementById('typing-text');
    const text = 'Sản phẩm mới';
    let index = 0;
    let isDeleting = false;
    let showCursor = true;

    // Cursor nhấp nháy
    setInterval(() => {
        showCursor = !showCursor;
        renderText();
    }, 500);

    function renderText() {
        const cursor = showCursor ? ' |' : '';
        typingText.textContent = text.substring(0, index) + cursor;
    }

    function typeWriter() {
        if (!isDeleting && index < text.length) {
            index++;
            renderText();
            setTimeout(typeWriter, 100);
        } 
        else if (isDeleting && index > 0) {
            index--;
            renderText();
            setTimeout(typeWriter, 50);
        } 
        else if (index === text.length) {
            isDeleting = true;
            setTimeout(typeWriter, 2000);
        } 
        else if (index === 0) {
            isDeleting = false;
            setTimeout(typeWriter, 500);
        }
    }

    typeWriter();
</script>
            
<script>
    const typingTextSale = document.getElementById('typing-text-sale');
    const textSale = 'Ưu đãi hấp dẫn';
    let indexSale = 0;
    let isDeletingSale = false;
    let showCursorSale = true;

    // Nhấp nháy cursor |
    setInterval(() => {
        showCursorSale = !showCursorSale;
        renderTextSale();
    }, 500);

    function renderTextSale() {
        const cursor = showCursorSale ? ' |' : '';
        typingTextSale.textContent = textSale.substring(0, indexSale) + cursor;
    }

    function typeWriterSale() {
        if (!isDeletingSale && indexSale < textSale.length) {
            indexSale++;
            renderTextSale();
            setTimeout(typeWriterSale, 100);
        } 
        else if (isDeletingSale && indexSale > 0) {
            indexSale--;
            renderTextSale();
            setTimeout(typeWriterSale, 50);
        } 
        else if (indexSale === textSale.length) {
            isDeletingSale = true;
            setTimeout(typeWriterSale, 2000);
        } 
        else if (indexSale === 0) {
            isDeletingSale = false;
            setTimeout(typeWriterSale, 500);
        }
    }

    typeWriterSale();
</script>
<script>
    const typingTextBlog = document.getElementById('typing-text-blog');
    const textBlog = 'Tin tức mới nhất';
    let indexBlog = 0;
    let isDeletingBlog = false;
    let showCursorBlog = true;

    // Nhấp nháy cursor |
    setInterval(() => {
        showCursorBlog = !showCursorBlog;
        renderTextBlog();
    }, 500);

    function renderTextBlog() {
        const cursor = showCursorBlog ? ' |' : '';
        typingTextBlog.textContent = textBlog.substring(0, indexBlog) + cursor;
    }

    function typeWriterBlog() {
        if (!isDeletingBlog && indexBlog < textBlog.length) {
            indexBlog++;
            renderTextBlog();
            setTimeout(typeWriterBlog, 100);
        } 
        else if (isDeletingBlog && indexBlog > 0) {
            indexBlog--;
            renderTextBlog();
            setTimeout(typeWriterBlog, 50);
        } 
        else if (indexBlog === textBlog.length) {
            isDeletingBlog = true;
            setTimeout(typeWriterBlog, 2000);
        } 
        else if (indexBlog === 0) {
            isDeletingBlog = false;
            setTimeout(typeWriterBlog, 500);
        }
    }

    typeWriterBlog();
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.media-scroll-wrapper');
    const container = document.querySelector('.media-scroll-container');
    if (!wrapper || !container) return;

    let isPaused = false;
    let position = 0;
    let lastTime = performance.now();
    const speed = 80; // px/giây

    const originalItems = Array.from(wrapper.children);

    // Clone đúng 1 bộ để loop
    if (!wrapper.dataset.looped) {
        originalItems.forEach(item => wrapper.appendChild(item.cloneNode(true)));
        wrapper.dataset.looped = "true";
    }

    function getOriginalWidth() {
        return originalItems.reduce((w, el) => w + el.offsetWidth, 0);
    }

    let originalWidth = getOriginalWidth();
    window.addEventListener('resize', () => originalWidth = getOriginalWidth());

    function animate(now) {
        const delta = (now - lastTime) / 1000;
        lastTime = now;

        if (!isPaused) {
            position -= speed * delta;

            // Reset mượt, không nhảy về 0
            if (Math.abs(position) >= originalWidth) {
                position += originalWidth;
            }

            wrapper.style.transform = `translate3d(${position}px,0,0)`;
        }

        requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);

    container.addEventListener('mouseenter', () => isPaused = true);
    container.addEventListener('mouseleave', () => isPaused = false);
});


// ================= YOUTUBE SCROLL =================
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.youtube-scroll-wrapper');
    const container = document.querySelector('.youtube-scroll-container');
    if (!wrapper || !container) return;

    let isPaused = false;
    let position = 0;
    let lastTime = performance.now();
    const speed = 120;

    const originalItems = Array.from(wrapper.children);

    if (!wrapper.dataset.looped) {
        originalItems.forEach(item => wrapper.appendChild(item.cloneNode(true)));
        wrapper.dataset.looped = "true";
    }

    function getOriginalWidth() {
        return originalItems.reduce((w, el) => w + el.offsetWidth, 0);
    }

    let originalWidth = getOriginalWidth();
    window.addEventListener('resize', () => originalWidth = getOriginalWidth());

    function animate(now) {
        const delta = (now - lastTime) / 1000;
        lastTime = now;

        if (!isPaused) {
            position -= speed * delta;

            if (Math.abs(position) >= originalWidth) {
                position += originalWidth;
            }

            wrapper.style.transform = `translate3d(${position}px,0,0)`;
        }

        requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);

    container.addEventListener('mouseenter', () => isPaused = true);
    container.addEventListener('mouseleave', () => isPaused = false);
});


// ================= YOUTUBE MODAL =================
function openYoutubeModal(videoId) {
    const modal = document.getElementById('youtubeModal');
    const iframe = document.getElementById('youtubeIframe');
    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeYoutubeModal() {
    const modal = document.getElementById('youtubeModal');
    const iframe = document.getElementById('youtubeIframe');
    iframe.src = '';
    modal.classList.remove('show');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeYoutubeModal();
});
</script>

@endsection

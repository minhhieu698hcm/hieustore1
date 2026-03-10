@extends('layout')
@section('title', $title ?? '')
@section('description', $description ?? '')
@section('keywords', $keywords ?? '')
@section('og_title', $og_title ?? '')
@section('og_description', $og_description ?? '')
@section('og_image', $og_image ?? '')
@section('og_url', $og_url ?? '')
@section('twitter_title', $title ?? '')
@section('twitter_description', $description ?? '')
@section('twitter_image', $og_image ?? '')
@section('canonical', $canonical ?? '')
@section('content')
<style>
  /* ===== BLOG DARK GAMING STYLE ===== */

.para-content {
    line-height: 1.8;
    color: #cfcfcf;
    font-size: 15px;
}

.para-content p {
    margin-bottom: 14px;
}

.para-content ul,
.para-content ol {
    margin: 18px 0;
    padding-left: 28px;
}

.para-content li {
    margin-bottom: 8px;
}

.para-content strong,
.para-content b {
    font-weight: 600;
    color: #ff3c3c;
}

.para-content em { font-style: italic; }
.para-content u { text-decoration: underline; }

.para-content h2 {
    font-size: 22px;
    font-weight: 700;
    margin: 28px 0 12px;
    color: #ff3c3c;
    text-shadow: 0 0 8px rgba(255,60,60,.4);
}

.para-content h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 22px 0 10px;
    color: #ff5757;
}

.para-content a {
    color: #4da6ff;
    text-decoration: none;
    transition: .3s;
}

.para-content a:hover {
    color: #ff3c3c;
}

/* TABLE */
.para-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: #fff;
}

.para-content td,
.para-content th {
    border: 1px solid #2b2b2b;
    padding: 10px;
}

.para-content th {
    background: #181818;
    color: #ff3c3c;
}

/* SECTION DIVIDER */
.related-products-section,
.related-blogs-section {
    padding: 30px 0;
    border-top: 1px solid #222;
    margin-top: 50px;
}

.section-title {
    font-size: 26px;
    font-weight: 700;
    color: #2b2b2b;
	margin-bottom:15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #ff3c3c;
    display: inline-block;
}

/* CARDS */
.product-card,
.blog-card {
    border: 1px solid #1f1f1f;
    border-radius: 10px;
    background: #141414;
    transition: all .3s ease;
}

.product-card:hover,
.blog-card:hover {
    box-shadow: 0 0 18px rgba(255, 60, 60, .25);
    transform: translateY(-6px);
}

.product-img-wrapper,
.blog-img-wrapper {
    height: 200px;
    overflow: hidden;
    background: #0d0d0d;
}

.product-name,
.blog-title {
    font-size: 16px;
    font-weight: 500;
    color: #eee;
}

/* PRICE */
.discount-price,
.price,
.ref-discount-price,
.ref-price {
    color: #ff3c3c;
    font-size: 18px;
    font-weight: 600;
}

.original-price,
.ref-original-price {
    color: #777;
    text-decoration: line-through;
}

/* BUTTONS */
.btn-primary,
.btn-danger {
    background: linear-gradient(90deg, #ff3c3c, #ff0000);
    border: none;
    color: #2b2b2b;
    font-weight: 600;
    padding: 9px 18px;
    border-radius: 5px;
    transition: .3s;
}

.btn-primary:hover,
.btn-danger:hover {
    box-shadow: 0 0 12px rgba(255,0,0,.6);
}

.btn-outline-primary {
    color: #ff3c3c;
    border: 1px solid #ff3c3c;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #ff3c3c;
    color: #2b2b2b;
}
/* Khung recent post có scroll */
.recent-post {
    max-height: 300px; /* ~3 bài, có thể chỉnh 250–300 tùy kích thước thực tế */
    overflow-y: auto;
    padding-right: 6px; /* tránh chữ sát scrollbar */
}

/* Thanh scroll gaming dark */
.recent-post::-webkit-scrollbar {
    width: 6px;
}

.recent-post::-webkit-scrollbar-track {
    background: #c7c7c7;
    border-radius: 10px;

}

.recent-post::-webkit-scrollbar-thumb {
    background: linear-gradient(#ff2e2e, #ff0101bd);
    border-radius: 10px;
}

.recent-post::-webkit-scrollbar-thumb:hover {
    background: #ff3c3c;
}

/* BLOG META */
.blog-date {
    color: #888;
}

.blog-excerpt {
    color: #2b2b2b;
}

/* RELATED BLOG LIST */
.related-blogs-list {
    list-style: disc;
    padding-top: 8px;
    padding-left: 15px;
}

.related-blogs-list a {
    color: #2b2b2b;
}

.related-blogs-list a:hover {
    color: #ff0000;
}

/* PRODUCT REFERENCE BOX */
.product-reference-item {
    border: 1px solid #2b2b2b;
    padding: 22px;
    border-radius: 10px;
    background: #fff;
}

.product-ref-title {
    color: #2b2b2b;
    font-weight: 600;
}

/* HIGHLIGHTS */
.highlights-title {
    color: #ff3c3c;
    font-size: 13px;
    font-weight: 600;
}

.highlights-content {
    font-size: 13px;
    color: #2b2b2b;
}

/* PURCHASE INFO */
.purchase-info-section {
    background: #fff;
    border-left: 4px solid #ff3c3c;
    border-right: 1px solid #2b2b2b;
    border-top: 1px solid #2b2b2b;
    border-bottom: 1px solid #2b2b2b;
    padding: 22px;
    border-radius: 6px;
}

.purchase-title {
    color: #ff3c3c;
    font-weight: 600;
}

.purchase-content {
    color: #2b2b2b;
}

.purchase-phone a {
    color: #ff3c3c;
    font-weight: 700;
}

/* MOBILE */
@media (max-width: 768px) {
    .section-title { font-size: 20px; }
    .product-card, .blog-card { margin-bottom: 20px; }
}

	/* ===== BLOG SINGLE WRAPPER ===== */
.blog-single-section {
    background: #fff;
    color: #2b2b2b;
    padding: 80px 0;
}

/* ===== SIDEBAR ===== */
.sidebar-single-widget {
    background: #fbfbfb;
    border: 1px solid rgba(255, 0, 0, 0.842);
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.438);
}

.sidebar-title {
    color: #ff3c3c;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ===== SEARCH BOX ===== */
.default-search-style-input-box {
    background: #11161d;
    border: 1px solid #000000!important;
    color: #2b2b2b;
    padding: 10px 14px;
    border-radius: 8px 0 0 8px;
}

.default-search-style-input-box:focus {
    border-color: #ff0000!important;
    box-shadow: 0 0 8px rgba(255, 46, 46, 0.5);
    outline: none;
}
.default-search-style-input-box:hover {
    border-color: #ff0000!important;
    box-shadow: 0 0 8px rgba(255, 46, 46, 0.5);
    outline: none;
}

/* ===== RECENT POSTS ===== */
.recent-post ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.recent-post-list {
    display: flex;
    gap: 14px;
    padding-top: 10px;
    padding-bottom: 6px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.747);
    transition: all .25s ease;
}
.recent-post-list .post-image {
    flex-shrink: 0;
    width: 84px;
    height: 64px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(255, 0, 0, 0.459);
}
.product-ref-image {
    border: 1px solid rgba(255, 0, 0, 0.534);
}
.recent-post-list .post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
}
.recent-post-list:hover .post-image img {
    transform: scale(1.08);
}
/* Nội dung */
.post-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Tiêu đề */
.post-link {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.4;
    color: #e6e6e6;
    text-decoration: none;

    display: -webkit-box;
    -webkit-line-clamp: 2; /* Giới hạn 2 dòng */
    -webkit-box-orient: vertical;
    overflow: hidden;

    transition: color .25s ease;
}

.post-link:hover {
    color: #ff3c3c;
}

/* Ngày đăng */
.post-date {
    margin-top: 6px;
    font-size: 12px;
    color: #2b2b2b;
    letter-spacing: .3px;
}
.recent-post-list:last-child {
    border-bottom: none;
}
.recent-post-list:hover {
    transform: translateX(6px);
}

.recent-post-list img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}

.post-link {
    color: #2b2b2b;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s;
}

.post-link:hover {
    color: #ff2e2e;
}

.post-date {
    font-size: 12px;
    color: #2b2b2b;
}

/* ===== TAGS ===== */
.tag-link a {
    display: inline-block;
    background: #12161c;
    border: 1px solid #ff0000;
    padding: 6px 12px;
    margin: 5px 5px 0 0;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #fff;
    transition: 0.3s;
}

.tag-link a:hover {
    background: #ff2e2ee3;
    color: #2b2b2b;
    font-weight: 500;
    font-size: 13px;
    box-shadow: 0 0 10px rgba(255, 46, 46, 0.6);
}

/* ===== BLOG CONTENT ===== */
.blog-single-wrapper {
    background: #fbfbfb;
    border-radius: 16px;
    padding: 35px;
    border: 1px solid rgba(255, 0, 0, 0.842);
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.438);
    backdrop-filter: blur(8px);
}

.blog-single-img img {
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.432);
}

/* META */
.blog-feed-post-meta {
    color: #2b2b2b;
    font-size: 14px;
    margin-bottom: 10px;
}

.blog-feed-post-meta a {
    color: #ff4d4d;
    font-weight: 600;
}

.blog-feed-post-meta a:hover {
    text-decoration: underline;
}

/* TITLE */
.post-title {
    font-size: 32px;
    color: #2b2b2b;
    margin: 15px 0 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 0 0 10px rgba(255, 46, 46, 0.4);
}

/* CONTENT TEXT */
.para-content {
    line-height: 1.9;
    font-size: 16px;
    color: #2b2b2b;
    margin-bottom: 18px;
}

.para-content p {
    margin-bottom: 16px;
}

/* LINKS IN CONTENT */
.para-content a {
    color: #ff0000;
}

.para-content a:hover {
    color: #2b2b2b;
}

/* TAGS BOTTOM */
.para-tags {
    margin-top: 30px;
    padding-top: 15px;
    border-top: 1px solid #2a2f38;
}

.para-tags span {
    color: #ff0000;
    font-weight: 600;
}

.para-tags ul {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}

.para-tags ul li {
    display: inline-block;
    margin-right: 10px;
}

.para-tags ul li a {
    background: #12161c;
    border: 1px solid #ff0000;
    padding: 6px 12px;
    border-radius: 6px;
    color: #fff;
    font-weight: 500;
    font-size: 13px;
    transition: 0.3s;
}

.para-tags ul li a:hover {
    background: #ff2e2e;
    color: #2b2b2b;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 500;
    box-shadow: 0 0 10px rgba(255, 46, 46, 0.6);
}
@media (min-width: 992px) {
    .siderbar-section {
        position: sticky;
        top: 120px; /* khoảng cách từ top khi dính lại (tránh đè header) */
    }
}
/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .blog-single-wrapper {
        padding: 20px;
    }

    .post-title {
        font-size: 24px;
    }
}
.default-search-style-input-btn {
    width: 48px !important;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(145deg, #ff2e2e, #b30000);
    border: 1px solid rgba(255, 0, 0, 0.5);
    border-radius: 8px;
    color: #2b2b2b;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

/* Icon */
.default-search-style-input-btn i {
    font-size: 16px;
    position: relative;
    z-index: 2;
}

/* Glow effect */
.default-search-style-input-btn::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.25), transparent 60%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Hover */
.default-search-style-input-btn:hover {
    transform: translateY(-2px);
    box-shadow:
        0 0 12px rgba(255, 0, 0, 0.7),
        0 0 25px rgba(255, 0, 0, 0.4);
}

.default-search-style-input-btn:hover::before {
    opacity: 1;
}

/* Click */
.default-search-style-input-btn:active {
    transform: scale(0.95);
    box-shadow: 0 0 6px rgba(255, 0, 0, 0.6);
}
.product-ref-price {
    font-family: 'Orbitron', sans-serif; /* nếu có font gaming */
    line-height: 1.4;
}

/* Giá hiện tại */
.price-current {
    color: #ff0000;
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    display: inline-block;
}

/* Giá cũ */
.price-old {
    color: #777;
    font-size: 13px;
    text-decoration: line-through;
    display: block;
    margin-bottom: 4px;
}

/* Liên hệ */
.price-contact {
    color: #ffffff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #ff3c3c, #ff0000);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Hiệu ứng hover toàn khối giá */
.product-reference-item:hover .price-current {
    text-shadow: 0 0 14px rgba(255, 0, 0, 0.8);
    transform: scale(1.05);
    transition: 0.3s ease;
}

</style>
<!-- Structured Data - JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BlogPosting",
  "headline": "{{ $details_blog->blog_title }}",
  "image": "{{ asset('public/upload/blog/' . $details_blog->blog_image) }}",
  "datePublished": "{{ $details_blog->created_at->toIso8601String() }}",
  "dateModified": "{{ $details_blog->updated_at->toIso8601String() }}",
  "author": {
    "@type": "Organization",
    "name": "Hiếu Store",
    "url": "https://khotoolsocial.click/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Hiếu Store",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('public/frontend/images/logo/logo.webp') }}"
    }
  },
  "description": "{{ strip_tags(Str::limit($details_blog->blog_desc ?? $details_blog->blog_content, 200)) }}"
}
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Trang chủ",
      "item": "{{ url('/trang-chu') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "{{ url('/tin-tuc') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $details_blog->blog_title }}",
      "item": "{{ url('/tin-tuc-chi-tiet/' . $details_blog->blog_slug) }}"
    }
  ]
}
</script>
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

                <a href="{{ URL::to('/tin-tuc') }}" class="text text-caption-1">
                    Tin tức
                </a>
                <i class="icon icon-arrRight"></i>

                <span class="text text-caption-1">
                    Chi tiết tin tức
                </span>
            </div>

            <!-- Breadcrumb actions (prev / back / next) -->
            <div class="tf-breadcrumb-prev-next">
                <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                    <i class="icon icon-arrLeft"></i>
                </a>

                <a href="{{ URL::to('/tin-tuc') }}" class="tf-breadcrumb-back" title="Giỏ hàng">
                    <i class="icon icon-squares-four"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /breadcrumb -->

<!-- ...:::: Start Blog Single Section:::... -->
<div class="blog-single-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row-reverse">
            <div class="col-lg-3">
                <!-- Start Sidebar Area -->
                <div class="siderbar-section" data-aos="fade-up"  data-aos-delay="0">

                   <!-- Start Single Sidebar Widget -->
                   <div class="sidebar-single-widget">
                    <h6 class="sidebar-title">Tìm kiếm</h6>
                    <div class="sidebar-content">
                        <div class="search-bar">
                            <div class="default-search-style d-flex">
                                <input class="default-search-style-input-box border-around border-right-none" stype="padding: 9px 9px!important;" type="search" placeholder="Tìm kiếm..." required>
                                <button class="default-search-style-input-btn" type="submit" style="width: 10px;display: flex;align-items: center;justify-content: center;margin-left: 10px!important;"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Bài viết gần đây</h6>
                        <div class="sidebar-content">
                            <div class="recent-post">
                                <ul>
                                    @foreach ($all_blog as $blog)
                                    <!-- Start Single Recent Post Item -->
                                    <li class="recent-post-list">
                                        <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="post-image">
                                            <img src="{{ asset('public/upload/blog/' . $blog->blog_image) }}" alt="">
                                        </a>
                                        <div class="post-content">
                                            <a class="post-link" href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}">{{ $blog->blog_title }}</a>
                                            <span class="post-date"> {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</span>
                                        </div>
                                    </li> <!-- End Single Recent Post Item -->
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tag sản phẩm</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                <a href="https://www.redragon.vn/san-pham/ban-phim">Bàn phím</a>
                                <a href="https://www.redragon.vn/san-pham/chuot">Chuột</a>
                                <a href="https://www.redragon.vn/san-pham/ban-phim?layout=layout-96">Layout 96%</a>
                                <a href="https://www.redragon.vn/san-pham/ban-phim?connection=ba-che-do">Bàn phím ba chế độ</a>
                                <a href="https://www.redragon.vn/san-pham/ban-phim?switch=linear">Linear Switch</a>
                                <a href="https://www.redragon.vn/san-pham/tai-nghe">Tai nghe</a>
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                </div> <!-- End Sidebar Area -->
            </div>
            <div class="col-lg-9">
                <!-- Start Blog Single Content Area -->
                <div class="blog-single-wrapper">
                    <div class="blog-single-img" data-aos="fade-up"  data-aos-delay="0">
                        <img class="img-fluid" src="{{ asset('public/upload/blog/' . $details_blog->blog_image) }}" alt="">
                    </div>
                    <div class="blog-feed-post-meta" data-aos="fade-up"  data-aos-delay="200">
                        <span>Đăng bởi:</span>
                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                        <a href="" class="blog-feed-post-meta-date"> {{ \Carbon\Carbon::parse($details_blog->created_at)->format('d/m/Y') }}</a>
                    </div>
                    <h4 class="post-title" data-aos="fade-up"  data-aos-delay="400">{{ $details_blog->blog_title }}</h4>
                    <div class="para-content" data-aos="fade-up"  data-aos-delay="600">{!! $details_blog->blog_desc !!}
                    </div>
					<div class="para-content" data-aos="fade-up"  data-aos-delay="600">{!! $details_blog->blog_content !!}
                    </div>
					<div class="para-content" data-aos="fade-up"  data-aos-delay="600">{!! $details_blog->blog_content2 !!}
                    </div>
                     <!-- Thông tin mua hàng -->
                    <div class="purchase-info-section" data-aos="fade-up" data-aos-delay="0">
                        <h6 class="purchase-title">Mua hàng tại :</h6>
                        <div class="purchase-content">
                            <div class="purchase-item">
                                <strong>Showroom:</strong> 444 Nguyễn Tri Phương, Phường Vườn Lài, TP. Hồ Chí Minh, Việt Nam.
                            </div>
                            <div class="purchase-item">
                                <strong>Showroom:</strong> 11 Sư Vạn Hạnh, Phường 12, Quận 10, TP. Hồ Chí Minh.
                            </div>
                            <div class="purchase-item purchase-phone">
                                <strong>Số điện thoại liên hệ:</strong> <a href="tel:0866638328">0866 638 328</a>
                            </div>
                        </div>
                    </div>  

                    <!-- Sản phẩm tham khảo -->
                    @if($related_products && count($related_products) > 0)
                    <div class="related-products-section" data-aos="fade-up" data-aos-delay="0">
                        <h6 class="section-title mb-30">Sản phẩm tham khảo</h6>
                        @foreach($related_products as $product)
                        <div class="product-reference-item mb-40">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-ref-image">
                                        <img src="{{ asset('public/upload/product/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="product-ref-content">
                                        <h6 class="product-ref-title">{{ $product->product_name }}</h6>
                                        
                                        <!-- Đặc điểm nổi bật -->
                                        @if($product->product_desc)
                                        <div class="product-highlights mt-3 mb-3" style="height: 80px;
    overflow: hidden;">
                                            <div class="highlights-content">
                                                {!! $product->product_desc !!}
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Giá -->
                                        <div class="product-ref-price mt-3 mb-3">
    @if ($product->product_price === 'LIÊN HỆ' || $product->product_price == 0)
        <span class="price-contact">LIÊN HỆ</span>
    @elseif (!empty($product->original_price))
        <span class="price-old">{{ number_format($product->original_price, 0, ',', '.') }} đ</span>
        <span class="price-current">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
    @else
        <span class="price-current">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
    @endif
</div>


                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_slug) }}" class="btn btn-sm btn-danger">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                  
                    
                    <!-- Bài viết tương tự -->
                    @if($related_blogs && count($related_blogs) > 0)
                    <div class="related-blogs-section mt-5" data-aos="fade-up" data-aos-delay="200">
                        <h6 class="see-more-title" style="color:#ff3c3c;">Bài viết khác:</h6>
                        <ul class="related-blogs-list" style="color:white;text-decoration:none;">
                            @foreach($related_blogs as $blog_item)
                            <li>
                                <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog_item->blog_slug) }}">
                                    {{ $blog_item->blog_title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                     <div class="para-tags" data-aos="fade-up"  data-aos-delay="0">
                        <span>Tags: </span>
                        <ul>
                            <li><a href="https://www.redragon.vn/san-pham/ban-phim?layout=layout-75">Layout 75%</a></li>
                            <li><a href="https://www.redragon.vn/san-pham/tai-nghe?connection=co-day">Tai nghe có dây</a></li>
                            <li><a href="https://www.redragon.vn/san-pham/chuot?connection=24ghz">Chuột không dây</a></li>
							<li><a href="https://www.redragon.vn/san-pham/ban-phim?connection=co-day">Bàn phím có dây</a></li>
                        </ul>
                    </div>
                </div> <!-- End Blog Single Content Area -->
                {{-- <div class="comment-area">
                    <div class="comment-box" data-aos="fade-up"  data-aos-delay="0">
                        <h4 class="mb-30">3 Bình luận</h4>
                        <!-- Start - Review Comment -->
                        <ul class="comment">
                            <!-- Start - Review Comment list-->
                            <li class="comment-list">
                                <div class="comment-wrapper">
                                    <div class="comment-img">
                                        <img src="assets/images/user/image-1.png" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-content-top">
                                            <div class="comment-content-left">
                                                <h6 class="comment-name">Kaedyn Fraser</h6>
                                            </div>
                                            <div class="comment-content-right">
                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                            </div>
                                        </div>

                                        <div class="para-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start - Review Comment Reply-->
                                <ul class="comment-reply">
                                    <li class="comment-reply-list">
                                        <div class="comment-wrapper">
                                            <div class="comment-img">
                                                <img src="assets/images/user/image-2.png" alt="">
                                            </div>
                                            <div class="comment-content">
                                                <div class="comment-content-top">
                                                    <div class="comment-content-left">
                                                        <h6 class="comment-name">Oaklee Odom</h6>
                                                    </div>
                                                    <div class="comment-content-right">
                                                        <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                    </div>
                                                </div>

                                                <div class="para-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul> <!-- End - Review Comment Reply-->
                            </li> <!-- End - Review Comment list-->
                            <!-- Start - Review Comment list-->
                            <li class="comment-list">
                                <div class="comment-wrapper">
                                    <div class="comment-img">
                                        <img src="assets/images/user/image-3.png" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-content-top">
                                            <div class="comment-content-left">
                                                <h6 class="comment-name">Jaydin Jones</h6>
                                            </div>
                                            <div class="comment-content-right">
                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                            </div>
                                        </div>

                                        <div class="para-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                        </div>
                                    </div>
                                </div>
                            </li> <!-- End - Review Comment list-->
                        </ul> <!-- End - Review Comment -->
                    </div>

                    <!-- Start comment Form -->
                    <div class="comment-form" data-aos="fade-up"  data-aos-delay="0">
                        <div class="coment-form-text-top mt-30">
                            <h4>Leave a Reply</h4>
                            <p>Your email address will not be published. Required fields are marked *</p>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="default-form-box mb-20">
                                        <label for="comment-name">Your name <span>*</span></label>
                                        <input id="comment-name" type="text" placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="default-form-box mb-20">
                                        <label for="comment-email">Your Email <span>*</span></label>
                                        <input id="comment-email" type="email" placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box mb-20">
                                        <label for="comment-review-text">Your review <span>*</span></label>
                                        <textarea id="comment-review-text" placeholder="Write a review" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="form-submit-btn" type="submit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- End comment Form -->
                </div> --}}


            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Blog Single Section:::... -->


@endsection
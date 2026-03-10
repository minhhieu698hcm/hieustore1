@extends('layout')
@section('title', $title ?? '')
@section('description', $description ?? '')
@section('keywords', $keywords ?? '')
@section('og_title', $og_title ?? '')
@section('og_description', $og_description ?? '')
@section('og_image', $og_image ?? '')
@section('og_url', $og_url ?? '')
@section('canonical', $canonical ?? '')
@section('content')

<!-- Structured Data - Breadcrumb Schema -->
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
      "name": "Tin Tức & Blog",
      "item": "{{ url('/tin-tuc') }}"
    }
  ]
}
</script>

<!-- Structured Data - Blog Listing Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Blog Hiếu Store",
  "description": "Khám phá blog Hiếu Store với các bài viết về cáp HDMI, USB, hub, bộ chia, phụ kiện công nghệ chính hãng",
  "url": "{{ url('/tin-tuc') }}",
  "mainEntity": [
    @php $first = true; @endphp
    @foreach($all_blog as $blog)
    @php
      $publishedDate = $blog->created_at ? $blog->created_at->toIso8601String() : now()->toIso8601String();
      $modifiedDate = $blog->updated_at ? $blog->updated_at->toIso8601String() : $publishedDate;
    @endphp
    @if(!$first),@endif
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "{{ $blog->blog_title }}",
      "description": "{{ Str::limit(strip_tags($blog->blog_desc ?? ''), 160, '...') }}",
      "image": "{{ asset('public/upload/blog/' . $blog->blog_image) }}",
      "author": {
        "@type": "Organization",
        "name": "Hiếu Store"
      },
      "datePublished": "{{ $publishedDate }}",
      "dateModified": "{{ $modifiedDate }}",
      "url": "{{ url('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}"
    }
    @php $first = false; @endphp
    @endforeach
  ]
}
</script>
<style>
    /* ===== BLOG SECTION ===== */
.blog-section {
    padding: 80px 0;
    background: #fff;
    color: #2b2b2b;
}

/* ===== SIDEBAR ===== */
.siderbar-section {
    position: sticky;
    top: 120px;
}

/* Widget Box */
.sidebar-single-widget {
    background: #fbfbfb;
    border: 1px solid rgba(255, 0, 0, 0.15);
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 30px;
    backdrop-filter: blur(6px);
    box-shadow: 0 0 25px rgba(255, 0, 0, 0.08);
}

/* Widget Title */
.sidebar-title {
    font-family: "Tektur", sans-serif;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #ff2e2e;
    margin-bottom: 18px;
    text-shadow: 0 0 8px rgba(255, 46, 46, 0.6);
}

/* ===== SEARCH BOX ===== */
.default-search-style-input-box {
    background: #0f1116;
    border: 1px solid #222;
    color: #2b2b2b;
    padding: 10px 14px;
}

.default-search-style-input-box:focus {
    border-color: #ff2e2e;
    box-shadow: 0 0 8px rgba(255, 46, 46, 0.5);
    outline: none;
}

.default-search-style-input-btn {
    background: #ff2e2e;
    border: none;
    color: #2b2b2b;
    padding: 0 16px;
    transition: 0.3s;
}

.default-search-style-input-btn:hover {
    background: #ff0000;
    box-shadow: 0 0 12px rgba(255, 0, 0, 0.6);
}

/* Khung recent post có scroll */
.recent-post {
    max-height: 300px; /* ~3 bài, có thể chỉnh 250–300 tùy kích thước thực tế */
    overflow-y: auto;
    padding-right: 4px; /* tránh chữ sát scrollbar */
}

/* Thanh scroll gaming dark */
.recent-post::-webkit-scrollbar {
    width: 6px;
}

.recent-post::-webkit-scrollbar-track {
    background: #0f0f0f;
    border-radius: 10px;
}

.recent-post::-webkit-scrollbar-thumb {
    background: linear-gradient(#ff2a2a, #990000);
    border-radius: 10px;
}

.recent-post::-webkit-scrollbar-thumb:hover {
    background: #ff3c3c;
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
    padding: 14px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    transition: all .25s ease;
}
.recent-post-list .post-image {
    flex-shrink: 0;
    width: 84px;
    height: 64px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(255,0,0,0.25);
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
    color: #2b2b2b;
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
/* ===== TAGS ===== */
.tag-link a {
    display: inline-block;
    margin: 6px 6px 0 0;
    padding: 6px 12px;
    border-radius: 30px;
    background: rgba(255, 0, 0, 0.08);
    border: 1px solid rgba(255, 0, 0, 0.2);
    color: #ff0000;
    font-size: 13px;
    transition: 0.3s;
}

.tag-link a:hover {
    background: #ff2e2e;
    color: #2b2b2b;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
}

/* ===== BLOG GRID ===== */
.blog-feed-single {
    background: #fbfbfb;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(255, 0, 0, 0.65);
    transition: 0.35s ease;
    box-shadow: 0 0 20px rgba(255, 0, 0, 0.05);
	margin-bottom: 20px;
}

.blog-feed-single:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 30px rgba(255, 0, 0, 0.575);
    border-color: rgba(255, 0, 0, 0.863);
}
.blog-feed-img-link{
    display:block;
    width:100%;
    aspect-ratio: 16/9;
    overflow:hidden;
}
/* Blog Image */
.blog-feed-img{
    width:100%;
    height:100%;
}



.blog-feed-single:hover .blog-feed-img {
    transform: scale(1.05);
}

/* Content */
.blog-feed-content {
    padding: 20px;
}

.blog-feed-post-meta {
    font-size: 13px;
    color: #2b2b2b;
    margin-bottom: 10px;
}

.blog-feed-post-meta a {
    color: #ff4d4d;
}

.blog-feed-link a {
    color: #2b2b2b;
    font-family: "Tektur", sans-serif;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
    transition: 0.3s;
}

.blog-feed-link a:hover {
    color: #ff2e2e;
    text-shadow: 0 0 8px rgba(255, 46, 46, 0.6);
}

/* ===== PAGINATION ===== */
.page-pagination ul {
    margin-top: 50px;
    padding: 0;
}

.page-pagination ul li {
    display: inline-block;
    margin: 0 6px;
}

.page-pagination ul li a {
    display: block;
    padding: 10px 16px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: #2b2b2b;
    border: 1px solid rgba(255, 0, 0, 0.15);
    transition: 0.3s;
}

.page-pagination ul li a:hover,
.page-pagination ul li a.active {
    background: #ff2e2e;
    box-shadow: 0 0 12px rgba(255, 0, 0, 0.6);
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

</style>
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
                    Tin tức
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


<!-- ...:::: Start Blog Section:::... -->
<div class="blog-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row-reverse">
            <div class="col-lg-3">
                <!-- Start Sidebar Area -->
                <div class="siderbar-section" data-aos="fade-up"  data-aos-delay="0"  data-aos-duration="300">

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tìm kiếm</h6>
                        <div class="sidebar-content">
                            <div class="search-bar">
                                <div class="default-search-style d-flex">
                                    <input class="default-search-style-input-box border-around border-right-none" style="padding: 9px 9px; margin-right: 10px;" type="search" placeholder="Tìm kiếm..." required>
                                    <button class="default-search-style-input-btn" type="submit" style="width: 10px;display: flex;align-items: center;justify-content: center;"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                                            <span class="post-date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</span>

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

                <div class="blog-grid-wrapper">
                    <div class="row">
                        @foreach ($all_blog as $blog)
                        <div class="col-md-6 col-12">
                            <!-- Start Blog Grid Single -->
                            <div class="blog-feed-single" data-aos="fade-up"  data-aos-delay="0"  data-aos-duration="300">
                                <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="blog-feed-img-link">
                                    <img src="{{ asset('public/upload/blog/' . $blog->blog_image) }}" alt="" class="blog-feed-img">
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>Đăng bởi:</span>
                                        <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}" class="blog-feed-post-meta-date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="{{ URL::to('/tin-tuc-chi-tiet/' . $blog->blog_slug) }}">{{ $blog->blog_title }}</a></h5>
                                </div>
                            </div><!-- End Blog Grid Single -->
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Start Pagination -->
                <div class="page-pagination text-center" data-aos="fade-up"  data-aos-delay="0"  data-aos-duration="300">
                    <ul>
                        <li><a href="#">Previous</a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Blog Section:::... -->

@endsection
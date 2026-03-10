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
@section('pagination_prev')
    @if ($currentPage > 1)
        <link rel="prev" href="{{ url('/san-pham?page=' . ($currentPage - 1)) }}" />
    @endif
@endsection

@section('pagination_next')
    @if ($currentPage < $totalPages)
        <link rel="next" href="{{ url('/san-pham?page=' . ($currentPage + 1)) }}" />
    @endif
@endsection
@section('content')

<!-- Structured Data - JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "CollectionPage",
  "name": "Danh sách sản phẩm Hiếu Store",
  "description": "Danh sách tất cả các sản phẩm Hiếu Store: cáp HDMI, USB, phụ kiện công nghệ và linh kiện máy tính chính hãng",
  "url": "{{ url('/san-pham') }}",
  "image": "{{ asset('public/frontend/images/default-og-image.jpg') }}",
  "publisher": {
    "@type": "Organization",
    "name": "Hiếu Store",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('public/frontend/images/logo/logo.webp') }}"
    }
  }
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
      "name": "Sản phẩm",
      "item": "{{ url('/san-pham') }}"
    }
  ]
}
</script>

<!-- ItemList Schema - Danh sách sản phẩm -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    @foreach ($all_product as $index => $product)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "url": "{{ url('/chi-tiet-san-pham/' . $product->product_Slug) }}",
      "name": "{{ $product->product_name }}",
      "image": "{{ asset('public/upload/product/' . $product->product_image) }}"
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
    
    <!-- Breadcrumb -->
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
                        Sản phẩm
                    </span>
                </div>
                <!-- Breadcrumb actions (prev / back / next) -->
                <div class="tf-breadcrumb-prev-next">
                    <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                        <i class="icon icon-arrLeft"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- ...:::: Start Shop Section:::... -->
    <section class="flat-spacing">
        <div class="container">
            <div class="tf-shop-control">
                <div class="tf-control-filter">
                    <button id="filterShop" class="filterShop tf-btn-filter" style="background-color: #fbfbfb; color: #2b2b2b; border: 1px solid #333; padding: 10px 16px; border-radius: 4px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; font-weight: 500;"><span class="icon icon-filter" style="color: #2b2b2b;"></span><span class="text" style="color: #2b2b2b;">Lọc</span></button>
                </div>
                <ul class="tf-control-layout">
                  <li class="meta-filter-shop page-amount">
                    <span class="count-text">Hiển thị {{ $start }}–{{ $end }} trên {{ $total }} kết quả</span>
                </li>
                </ul>
                <div class="tf-control-sorting">
                    <p class="d-none d-lg-block text-caption-1">Sắp xếp:</p>

                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Sản phẩm mới nhất</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>

                        <div class="dropdown-menu">
                            <div class="select-item" data-sort-value="newest">
                                <span class="text-value-item">Sản phẩm mới nhất</span>
                            </div>

                            <div class="select-item" data-sort-value="best_selling">
                                <span class="text-value-item">Sản phẩm bán chạy</span>
                            </div>

                            <div class="select-item" data-sort-value="price_asc">
                                <span class="text-value-item">Giá thấp - cao</span>
                            </div>

                            <div class="select-item" data-sort-value="price_desc">
                                <span class="text-value-item">Giá cao - thấp</span>
                            </div>
                        </div>
                    </div>
                    <select name="sort_by" id="sort_by" hidden>
                        <option value="newest" selected>Sản phẩm mới nhất</option>
                        <option value="best_selling">Sản phẩm bán chạy</option>
                        <option value="price_asc">Giá thấp - cao</option>
                        <option value="price_desc">Giá cao - thấp</option>
                    </select>
                </div>
            </div>
            <div class="wrapper-control-shop">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="sidebar-filter canvas-filter left">
                            <div class="canvas-wrapper">
                                <div class="canvas-header d-flex d-xl-none">
                                    <h5>Lọc</h5>
                                    <span class="icon-close close-filter"></span>
                                </div>
                                <div class="canvas-body" style="background-color: #fbfbfb; padding: 20px;">
                                    <!-- Dynamic Attribute Filters from Database -->
                                            <div class="widget-facet facet-attribute- d-none d-xl-block" style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #333;">
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                                    <h6 class="facet-title" style=" margin: 0; font-weight: 600; font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px;">DANH MỤC</h6>
                                                    <button class="reset-attribute-filter" data-attribute-id="" style="background: none; border: none; color: #ff0000; cursor: pointer; font-size: 13px; padding: 0; transition: color 0.3s ease;">Reset</button>
                                                </div>
                                                <ul class="facet-content" style="list-style: none; padding: 0; margin: 0;">
                                                  @foreach ($category as $key => $cate)
                                                        <li style="align-items: center;">
                                                            <label class="checkbox-default" for="{{ $cate->category_id }}">
                                                                <input type="checkbox" name="category"
                                                                    class="filter-checkbox" 
                                                                    id="{{ $cate->category_id }}"
                                                                    data-slug="{{ $cate->category_slug }}" style="width: 16px; height: 16px; cursor: pointer; margin-right: 8px; accent-color: #ff4444;">
                                                                <span style="color: #2b2b2b;cursor: pointer;font-size: 14px;margin: 0;flex: 1;">{{ $cate->category_name }}&ensp;({{ $cate->products_count }})</span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                </div>
                                <div class="canvas-bottom d-block d-xl-none">
                                    <button id="reset-filter" class="tf-btn btn-reset">Đặt lại bộ lọc</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="tab-content tab-animate-zoom product-filter">  
                        <div class="tf-grid-layout wrapper-shop sort-layout-single tf-col-3" id="gridLayout">
                            <!-- Grid view items -->
                            @foreach ($all_product as $key => $product)
                                <div class="card-product grid" style="padding: 0;" 
                                    data-category-id="{{ $product->category_id }}" 
                                    data-subcategory-id="{{ $product->subcategory_id ?? '' }}"
                                    @if(isset($product->attributeValues) && is_array($product->attributeValues))
                                        @foreach($product->attributeValues as $attrId => $attrValues)
                                            data-attr-{{ $attrId }}="{{ implode(',', $attrValues) }}"
                                        @endforeach
                                    @else
                                        data-attr-default="none"
                                    @endif
                                    >
                                    
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
                                    <div class="card-product-info">
                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="title link">{{ $product->product_name }}</a>
                                        <div class="price">
                                            @if ($product->product_price === 'LIÊN HỆ' || $product->product_price == 0)
                                                <span class="current-price">LIÊN HỆ</span>
                                            @elseif (!empty($product->original_price))
                                                <span class="old-price">{{ number_format($product->original_price, 0, ',', '.') }} đ</span>
                                                <span class="current-price">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                            @else
                                                <span class="current-price">{{ number_format($product->product_price, 0, ',', '.') }} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                        <!-- Start Pagination -->
                    <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0" data-aos-duration="300">
                        <ul>
                            <!-- Previous Button -->
                            @if ($currentPage > 1)
                                <li><a href="javascript:void(0);" class="pagination-link"
                                        data-page="{{ $currentPage - 1 }}">Previous</a></li>
                            @endif

                            <!-- Page Links -->
                            @foreach ($pagination as $page)
                                @if (is_numeric($page))
                                    <li><a href="javascript:void(0);"
                                            class="pagination-link {{ $page == $currentPage ? 'active' : '' }}"
                                            data-page="{{ $page }}">{{ $page }}</a></li>
                                @else
                                    <li><span>{{ $page }}</span></li>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if ($currentPage < $totalPages)
                                <li><a href="javascript:void(0);" class="pagination-link"
                                        data-page="{{ $currentPage + 1 }}">Next</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- End Pagination -->

                    </div>
                </div>
            </div>
        </div>
    </section> 
<!-- ...:::: End Shop Section:::... -->
<script>
    $(document).on('click', '.tf-dropdown-sort .select-item', function () {

    let value = $(this).data('sort-value');
    let text = $(this).find('.text-value-item').text();

    // update text UI
    $('.text-sort-value').text(text);

    // update select thật
    $('#sort_by').val(value).trigger('change');
});

</script>
@endsection
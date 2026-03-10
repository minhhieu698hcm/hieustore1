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
@push('styles')
        <link rel="stylesheet" href="{{ asset('public/frontend/css/drift-basic.min.css') }}">
@endpush
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

                        <a href="{{ URL::to('/san-pham') }}" class="text text-caption-1">
                            Sản phẩm
                        </a>
                        <i class="icon icon-arrRight"></i>

                        <span class="text text-caption-1">
                            Chi tiết sản phẩm
                        </span>
                    </div>

                    <!-- Breadcrumb actions (prev / back / next) -->
                    <div class="tf-breadcrumb-prev-next">
                        <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                            <i class="icon icon-arrLeft"></i>
                        </a>

                        <a href="{{ URL::to('/san-pham') }}" class="tf-breadcrumb-back" title="Danh sách sản phẩm">
                            <i class="icon icon-squares-four"></i>
                        </a>

                        {{-- Có thể thay bằng link sản phẩm trước / sau nếu có --}}
                        <a href="#" class="tf-breadcrumb-next d-none d-md-flex" title="Sản phẩm tiếp theo">
                            <i class="icon icon-arrRight"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /breadcrumb -->


        <!-- Product_Main -->
        <section class="flat-spacing">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <!-- Product default -->
                        <div class="col-md-6">
                            <div class="product-details-gallery-area d-flex align-items-stretch gap-3" data-aos="fade-up" data-aos-delay="0"  data-aos-duration="300">
                                <!-- Gallery Thumbnails Left -->
                                <div class="thumbnail-scroll-wrapper">
                                    <!-- Thumbnails Container -->
                                    <div class="product-image-thumb product-image-thumb-vertical pos-relative order-1" style="width: 100px; height:445px; overflow-y: scroll; overflow-x: hidden; padding: 8px 3px; display: flex; flex-direction: column; gap: 8px;">
                                       <div class="product-image-thumb-single active" data-index="0">
                                            <img class="img-fluid"
                                                src="{{ asset('public/upload/product/' . $product_details->product_image) }}"
                                                loading="lazy">
                                        </div>

                                        <div class="product-image-thumb-single" data-index="1">
                                            <img class="img-fluid"
                                                src="{{ asset('public/upload/product/' . $product_details->product_image_hover) }}"
                                                loading="lazy">
                                        </div>

                                        @foreach ($gallery as $key => $image)
                                        <div class="product-image-thumb-single" data-index="{{ $key + 2 }}">
                                            <img class="img-fluid"
                                                src="{{ asset('public/upload/gallery/' . $image->gallery_image) }}"
                                                loading="lazy">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Main Image Right -->
                                <div class="product-large-image product-large-image-vertical order-2" style="flex: 1;">
                                    <div class="product-image-large-single active" data-index="0">
                                        <img class="img-fluid drift-zoom" src="{{ asset('public/upload/product/' . $product_details->product_image) }}" alt="Product Image" loading="lazy">
                                    </div>
                                    <div class="product-image-large-single" data-index="1">
                                        <img class="img-fluid"
                                            src="{{ asset('public/upload/product/' . $product_details->product_image_hover) }}"
                                            alt="{{ $product_details->product_name }} Hover" loading="lazy">
                                    </div>
                                    @foreach ($gallery as $key => $image)
                                    <div class="product-image-large-single" data-index="{{ $key + 2 }}">
                                        <img class="img-fluid" src="{{ asset('public/upload/gallery/' . $image->gallery_image) }}" alt="" loading="lazy">
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                        </div>
                        <!-- /Product default -->
                        <!-- tf-product-info-list -->
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-heading">
                                        <div class="tf-product-info-name">
                                            <div class="text text-btn-uppercase">{{ $product_details->category->category_name ?? 'Sản phẩm' }}</div>
                                            <h4 class="name">{{ $product_details->product_name }}</h4>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                                            <p class="text-caption-1 text-1 product-default-code" id="product-code-display" style="margin: 0; color: #999;font-size: 15px;">{{ $product_details->product_code }}</p>
                                            @if($product_details->product_stock_status == 1)
                                                <span style="display: inline-block; background-color: #28a745; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Còn hàng</span>
                                            @elseif($product_details->product_stock_status == 0)
                                                <span style="display: inline-block; background-color: #dc3545; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Hết hàng</span>
                                            @else
                                                <span style="display: inline-block; background-color: #ffc107; color: #333; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Liên hệ</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tf-product-info-price" id="attribute-price">
                                                @if($product_details->final_price == 0)
                                                    <h5 class="price-on-sale font-2" style="color: #ff6b6b; font-size: 24px; font-weight: 700;">LIÊN HỆ</h5>
                                                @elseif($product_details->final_price !== $product_details->original_price)
                                                    <span class="text-danger fw-bold"style="font-size: 26px;">{{ number_format($product_details->final_price, 0, ',', '.') }} đ</span>
                                                    <span class="old-price text-muted" style="text-decoration: line-through; margin-left: 6px; font-weight: 500; font-size: 20px;">{{ number_format($product_details->original_price, 0, ',', '.') }} đ</span>
                                                    <span class="badge bg-danger" style="margin-left: 6px;">
                                                        -{{ $product_details->discount_percent }}%
                                                    </span>
                                                @else
                                                    @if($product_details->product_price == 0)
                                                        <h5 class="price-on-sale font-2" style="color: #ff6b6b; font-size: 24px; font-weight: 700;">LIÊN HỆ</h5>
                                                    @else
                                                        <h5 class="price-on-sale font-2" style="color: #ff6b6b; font-size: 24px; font-weight: 700; margin: 0;">{{ number_format($product_details->product_price, 0, ',', '.') }}<span style="font-size: 18px; margin-left: 4px;">đ</span></h5>
                                                    @endif
                                                @endif
                                            </div>
                                    
                                    <!-- Hiển thị giá khi chọn phân loại -->
                                    <div class="tf-product-info-price" id="variant-price-display" style="display: none;"></div>
                                    <div class="tf-product-info-desc">
                                            <div class="d-flex align-items-center" style="margin-top: 8px;gap:20px;">
                                                <span class="badge rounded-pill bg-danger" 
                                                    style="font-size: 13px; color:#fff; display:flex; align-items:center; justify-content:center; gap:5px; min-width: 80px; height: 32px;">
                                                    <span>Full VAT</span>
                                                </span>

                                                @if($product_details->warranty_period == 0)
                                                    <span class="badge rounded-pill bg-danger" 
                                                        style="font-size: 13px; color: #fff; display: flex; align-items: center; justify-content: center; gap: 5px; min-width: 160px; height: 32px;">
                                                        <span style="padding-bottom: 0px; display: flex; align-items: center; gap: 4px;">
                                                            
                                                            <span style="padding-bottom: 3px;"><i class="fa-solid fa-shield"></i> Không bảo hành</span>
                                                        </span>
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger" 
                                                        style="font-size: 13px; color: #fff; display: flex; align-items: center; justify-content: center; gap: 5px; min-width: 160px; height: 32px;">
                                                        <span style="padding-bottom: 0px; display: flex; align-items: center; gap: 4px;">
                                                    
                                                            <span style="padding-bottom: 3px;"><i class="fa-solid fa-shield"></i> Bảo hành {{ $product_details->warranty_period ?? 24 }} tháng</span>
                                                        </span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="border-bottom: 1px solid var(--line);margin: 12px 0px!important;border-top:none;opacity: inherit;">
                                    <div class="tf-product-info-choose-option">
                                    
                                        @if($attributes->count() > 0)
                                        <div id="product_details" class="attributes">
                                            <label style="font-weight: 600; font-size: 15px; color:#2b2b2b">Phân loại:</label>
                                            <div class="dropdown-attribute mt-1">
                                                <h1 class="animated-button1">
                                                Chọn phân loại
                                                </h1>
                                                <ul>
                                                    @foreach ($attributes as $index => $attribute)
                                                        <li
                                                            class="attribute-option{{ $index === 0 ? ' selected' : '' }}"
                                                            style="cursor: pointer; list-style: none;"
                                                            data-value="{{ $attribute->product_attribute_code }}"
                                                            data-price="{{ $attribute->product_price }}"
                                                            data-original="{{ $attribute->original_price ?? $attribute->product_price }}"
                                                            data-percent="{{ $attribute->discount_percent ?? 0 }}"
                                                            data-stock="{{ $attribute->stock_status }}"
                                                            data-image="{{ asset('public/upload/product/' . $attribute->attribute_image) }}"
                                                        >
                                                            <strong>{{ $attribute->AttributeName }}:</strong> {{ $attribute->AttrValName }}  &nbsp;
                            <span style="color:red; font-weight:600;">({{ $attribute->product_attribute_code }})</span>
                            </span>
                                                        </li>
                                                    @endforeach
                </ul>
            </div>

                                <!-- Hidden inputs -->
                                        <input type="hidden" id="selected-attribute" name="product_attribute_code" value="{{ $selected_code ?? '' }}">
                                        <input type="hidden" id="selected-price" name="product_price" value="">
                                        <input type="hidden" id="product-default-code" value="{{ $product_details->product_code }}">
                                        <input type="hidden" id="product-default-price" value="{{ $product_details->product_price }}">
                                        </div>
                                        @endif


                                        <div class="buy-box" style="display: flex; gap: 12px; align-items: stretch;">
                                            <div class="tf-product-info-quantity" style="flex-shrink: 0;">
                                                <div class="wg-quantity">
                                                    <span class="btn-quantity btn-decrease">-</span>
                                                    <input id="details-quantity" class="quantity-product" type="text" name="number" value="1">
                                                    <span class="btn-quantity btn-increase">+</span>
                                                </div>
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="tf-product-info-by-btn">
                                                    @if(!empty($product_details->final_price) && $product_details->final_price > 0)
                                                        <a href="javascript:void(0);" 
                                                           id="add-to-cart-button"
                                                           data-product-id="{{ $product_details->product_id }}"
                                                           class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart add-to-cart"
                                                           style="display: flex !important;align-items: center;justify-content: center;flex-wrap: nowrap !important;white-space: nowrap;"
                                                           onclick="return false;">
                                                            <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" 
                                                           class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 disabled"
                                                           style="display: flex !important;align-items: center;justify-content: center;flex-wrap: nowrap !important;white-space: nowrap; pointer-events: none; opacity: 0.6;">
                                                            <i class="fa-solid fa-ban"></i>&nbsp; Vui lòng liên hệ Kinh Doanh - 0866638328
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tf-product-info-list -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Main -->
        <!-- Product_Description_Tabs -->
        <section class="bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-1 dark-section">
                            @php
                                $hasOverview = !empty(trim($product_details->product_gale_desc ?? ''));
                            @endphp
                            <ul class="widget-menu-tab">
                                @if($hasOverview)
                                    <li class="item-title active">
                                        <span class="inner">Tổng quan</span>
                                    </li>
                                @endif
                                <li class="item-title {{ !$hasOverview ? 'active' : '' }}">
                                    <span class="inner">Thông số</span>
                                </li>                 
                                <li class="item-title">
                                    <span class="inner">FAQ</span>
                                </li>
                            </ul>
                            <div class="widget-content-tab">
								@if($hasOverview)
                                    <div class="widget-content-inner active">
                                        {!! $product_details->product_gale_desc !!}
                                    </div>
                                @endif
                                <div class="widget-content-inner {{ !$hasOverview ? 'active' : '' }}">
                                    <div class="tab-description">
                                        <div class="right">
                                            <div class="letter-1 text-btn-uppercase mb_12">Mô tả sản phẩm</div>
                                            <div class="text-secondary">
                                                {!! $product_details->product_desc !!}
                                            </div>
                                        </div>
                                        <div class="left">
                                            <div class="letter-1 text-btn-uppercase mb_12">Thông số sản phẩm</div>
                                            <div class="text-secondary">
                                                {!! $product_details->product_content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="widget-content-inner">
                                      <section class="flat-spacing" id="FAQ">
            <div class="container" >
                <div class="page-faqs-wrap">
                    <div class="list-faqs">
                        <div>
                            <h5 class="faqs-title">Câu hỏi thường gặp (FAQ)</h5>
                            <ul class="accordion-product-wrap style-faqs" id="accordion-faq-1">
                                <li class="accordion-product-item">
                                    <a href="#accordion-1" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-1">
                                        <h6>Sản phẩm có giống hình không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-1" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Có. Hình ảnh sản phẩm được chụp thực tế tại shop. Màu sắc có thể chênh lệch rất nhẹ do ánh sáng và màn hình hiển thị.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-2" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-2">
                                        <h6>Tôi có thể kiểm tra hàng trước khi thanh toán không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-2" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Bạn được kiểm tra ngoại quan, mẫu mã, số lượng trước khi thanh toán. Không hỗ trợ dùng thử sản phẩm.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-3" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-3">
                                        <h6>Thời gian giao hàng mất bao lâu?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-3" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Nội thành: 1–2 ngày</p>
                                            <p class="text-secondary">- Ngoại tỉnh: 2–5 ngày</p>
                                            <p class="text-secondary">Lưu ý: Thời gian có thể thay đổi do thời tiết hoặc đơn vị vận chuyển.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-4" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-4">
                                        <h6>Shop có hỗ trợ đổi trả không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-4" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Có. Hỗ trợ đổi trả trong 7 ngày nếu:</p>
                                            <p class="text-secondary">- Sản phẩm lỗi do nhà sản xuất</p>
                                            <p class="text-secondary">- Giao sai mẫu / sai số lượng</p>
                                            <p class="text-secondary">- Không áp dụng đổi trả với lỗi do người sử dụng.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-5" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-5">
                                        <h6>Tôi đặt nhầm sản phẩm, có hủy được không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-5" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Bạn có thể hủy hoặc chỉnh sửa đơn trước khi shop đóng gói gửi đi. Hãy liên hệ shop sớm nhất có thể.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-6" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-5">
                                        <h6>Sản phẩm có bảo hành không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-6" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Sản phẩm được bảo hành 12 tháng</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion-product-item">
                                    <a href="#accordion-7" class="accordion-title collapsed current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-5">
                                        <h6>Có hỗ trợ xuất hóa đơn không?</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-7" class="collapse" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">- Shop có hỗ trợ xuất hóa đơn điện tử theo yêu cầu. Vui lòng cung cấp thông tin xuất hóa đơn trong khi đặt hàng.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ask-question sticky-top">
                        <div class="ask-question-wrap">
                            <h5 class="mb_4">Câu hỏi của bạn</h5>
                            <p class="mb_20 text-secondary">Hãy hỏi bất cứ điều gì, chúng tôi luôn sẵn sàng giúp đỡ.</p>
                            <form  class="form-leave-comment">
                                <fieldset class="mb_20"> 
                                    <div class="text-caption-1 mb_8">Tên</div>
                                    <input class="" type="text" placeholder="Họ và tên*" name="text" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="mb_20"> 
                                    <div class="text-caption-1 mb_8">Chúng tôi có thể giúp gì cho bạn?</div>
                                    <div class="tf-select" id="support_topic">
                                        <select name="support_topic" required>
                                            <option value="">-- Chọn vấn đề bạn cần hỗ trợ --</option>
                                            <option value="product_consult">Tư vấn chọn sản phẩm</option>
                                            <option value="compatibility">Tương thích thiết bị (PC, Console...)</option>
                                            <option value="order_status">Kiểm tra tình trạng đơn hàng</option>
                                            <option value="shipping">Vấn đề vận chuyển / giao hàng</option>
                                            <option value="warranty">Bảo hành sản phẩm</option>
                                            <option value="technical_support">Hỗ trợ kỹ thuật / lỗi sử dụng</option>
                                            <option value="returns">Đổi trả sản phẩm</option>
                                            <option value="bulk_order">Mua số lượng lớn / phòng net / phòng game</option>
                                            <option value="collab">Hợp tác / Review / KOLs</option>
                                            <option value="other">Vấn đề khác</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="mb_20"> 
                                    <div class="text-caption-1 mb_8">Nội dung</div>
                                    <textarea class="" rows="4" placeholder="Nội dung câu hỏi...*" tabindex="2" aria-required="true" required=""></textarea>
                                </fieldset>
                                <div class="button-submit">
                                    <button class="btn-style-2 w-100" type="submit">
                                        <span class="text text-button">Gửi câu hỏi</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Description_Tabs -->

        <!-- Ralated Products -->
        <section class="flat-spacing">
            <div class="container flat-animate-tab">
                <ul class="tab-product justify-content-sm-center wow fadeInUp" data-wow-delay="0s" role="tablist">
                    <li class="nav-tab-item" role="presentation">
                        <a href="#ralatedProducts" class="active" data-bs-toggle="tab" style=" font-weight: 600;">Sản phẩm liên quan</a>
                    </li>
                    <li class="nav-tab-item" role="presentation">
                        <a href="#recentlyViewed" data-bs-toggle="tab" style=" font-weight: 600;">Sản phẩm cao cấp</a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active show" id="ralatedProducts" role="tabpanel">
                        <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                @if(isset($related_product) && count($related_product) > 0)
                                    @foreach ($related_product as $product)
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
                                                   <div class="on-sale-wrap"><span class="on-sale-item">-{{ $product->discount_percent }}%</span></div>
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
                                @endif
                            </div>
                            <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="recentlyViewed" role="tabpanel">
                        <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                @if(isset($upsell_product) && count($upsell_product) > 0)
                                    @foreach ($upsell_product as $product)
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
                                                  <div class="on-sale-wrap"><span class="on-sale-item">-{{ $product->discount_percent }}%</span></div>
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
                                @endif
                            </div>
                            
                        </div>
                        <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /Ralated Products -->
    </div>
    <!-- /wrapper -->


    
 @push('scripts')
   <script src="{{ asset('public/frontend/js/drift.min.js') }}"></script>
@endpush

<script>
document.addEventListener("DOMContentLoaded", function () {

    const thumbs = document.querySelectorAll(".product-image-thumb-single");
    const largeItems = document.querySelectorAll(".product-image-large-single");
    const zoomPane = document.querySelector(".tf-zoom-main");

    let driftInstance = null;

    /* Destroy zoom cũ */
    function destroyDrift() {
        if (driftInstance) {
            driftInstance.destroy();
            driftInstance = null;
        }
    }

    /* Init zoom */
    function initDrift(img) {
        if (!img || !zoomPane) return;

        destroyDrift();

        driftInstance = new Drift(img, {
            paneContainer: zoomPane,
            inlinePane: false,
            hoverBoundingBox: true,
            sourceAttribute: "src",
            zoomFactor: 2.5
        });
    }

    /* Đổi slide */
    function switchSlide(index) {

        // Ẩn toàn bộ ảnh lớn
        largeItems.forEach(item => {
            item.style.display = "none";
            item.classList.remove("active");
        });

        // bỏ active thumb
        thumbs.forEach(t => t.classList.remove("active"));

        // tìm ảnh cần hiển thị
        const activeLarge = document.querySelector(
            '.product-image-large-single[data-index="' + index + '"]'
        );

        const activeThumb = document.querySelector(
            '.product-image-thumb-single[data-index="' + index + '"]'
        );

        if (activeLarge) {
            activeLarge.style.display = "block";
            activeLarge.classList.add("active");

            const img = activeLarge.querySelector("img");
            initDrift(img);
        }

        if (activeThumb) activeThumb.classList.add("active");
    }

    /* Click thumbnail */
    thumbs.forEach(thumb => {
        thumb.addEventListener("click", function () {
            switchSlide(this.dataset.index);
        });
    });

    /* Init zoom ảnh đầu */
    const firstActive = document.querySelector(
        ".product-image-large-single.active img"
    );

    if (firstActive) initDrift(firstActive);

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.querySelector('.dropdown-attribute');
    if (!dropdown) return;

    const h1 = dropdown.querySelector('h1.animated-button1');
    const lis = dropdown.querySelectorAll('ul li');

    const selectedInput = document.querySelector('#selected-attribute');
    const priceInput = document.querySelector('#selected-price');
    const attributePrice = document.querySelector('#attribute-price');
    const addToCartBtn = document.querySelector('#add-to-cart-button');
    const productCodeSpan = document.querySelector('.product-default-code');

    const defaultCode = document.querySelector('#product-default-code')?.value || '';
    const defaultPrice = document.querySelector('#product-default-price')?.value || '';
    const defaultOriginal = document.querySelector('#product-default-original')?.value || '';
    const defaultPercent = document.querySelector('#product-default-percent')?.value || '';

    function updateAddToCartBtn(code, price, hasVariant, stockStatus) {
        const priceNum = parseFloat(price);
        if (hasVariant && !code) {
            disableAddToCart('&nbsp;Vui lòng chọn phân loại ở trên', 'fa-ban');
            return;
        }
        if (stockStatus == 0 || stockStatus == 2) {
            disableAddToCart('&nbsp;Vui lòng liên hệ Kinh Doanh - 0866638328', 'fa-phone');
            return;
        }
        if (!price || isNaN(priceNum) || priceNum <= 0) {
            disableAddToCart('&nbsp;Vui lòng liên hệ Kinh Doanh - 0866638328', 'fa-phone');
            return;
        }
        enableAddToCart();
    }

    function disableAddToCart(text, iconClass) {
        addToCartBtn.classList.add('disabled');
        addToCartBtn.style.pointerEvents = 'none';
        addToCartBtn.style.opacity = '0.6';
        addToCartBtn.classList.remove('add-to-cart');
        addToCartBtn.innerHTML = `
            <i class="fa-solid ${iconClass}"></i> ${text}
        `;
    }

    function enableAddToCart() {
        addToCartBtn.classList.remove('disabled');
        addToCartBtn.style.pointerEvents = 'auto';
        addToCartBtn.style.opacity = '1';
        addToCartBtn.classList.add('add-to-cart');
        addToCartBtn.innerHTML = `
            <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng
        `;
    }

    function updateSelectedAttribute(code, price, original, percent, li) {
        selectedInput.value = code || '';
        priceInput.value = price || '';

        // Cập nhật input ẩn
        const hiddenOriginal = document.querySelector('#product-default-original');
        const hiddenPercent = document.querySelector('#product-default-percent');
        if (hiddenOriginal) hiddenOriginal.value = original || '';
        if (hiddenPercent) hiddenPercent.value = percent || '0';

        lis.forEach(el => el.classList.remove('selected'));
        if (li) li.classList.add('selected');

        const p = parseFloat(price || 0);
        const o = parseFloat(original || 0);
        const percentText = percent ? `-${percent}%` : '';

        if (p > 0) {
            if (o > p) {
                attributePrice.innerHTML = `
                    <span class="text-danger fw-bold"style="font-size: 26px;">${p.toLocaleString('vi-VN')} đ</span>
                    <span class="old-price text-muted" style="text-decoration: line-through; margin-left: 6px; font-weight: 500; font-size: 20px;">${o.toLocaleString('vi-VN')} đ</span>
                    <span class="badge bg-danger" style="margin-left: 6px;">${percentText}</span>
                `;
            } else {
                attributePrice.innerHTML = `
                    <span class="text-danger fw-bold">${p.toLocaleString('vi-VN')} đ</span>
                `;
            }
        } else {
            attributePrice.innerHTML = `<span class="text-danger fw-bold" style="font-size: 26px;">LIÊN HỆ</span>`;
        }

        if (productCodeSpan) {
            productCodeSpan.textContent = `(${code || ''})`;
        }

        // Update tiêu đề phân loại
        if (li) {
            const strongHTML = li.querySelector('strong')?.outerHTML || '';
            const afterStrongText = li.innerHTML.replace(strongHTML, '').trim();
            h1.classList.add('selected-2');
            h1.innerHTML = `${strongHTML}${afterStrongText}`;
        } else {
            h1.classList.remove('selected-2');
            h1.innerHTML = `Chọn phân loại`;
        }

        // Cập nhật trạng thái tổng khi chọn phân loại
        const mainStockStatus = document.querySelector('.product-details-text .badge');
        if (li && mainStockStatus) {
            const stock = li.getAttribute('data-stock');
            let color = 'green', text = 'Còn hàng', badgeClass = 'bg-success text-white';
            if (stock == '0') { color = 'red'; text = 'Hết hàng'; badgeClass = 'bg-danger text-white'; }
            else if (stock == '2') { color = 'orange'; text = 'Sắp về hàng'; badgeClass = 'bg-warning text-dark'; }
            mainStockStatus.textContent = text;
            mainStockStatus.className = `badge rounded-pill ${badgeClass}`;
        }

        let stockStatus = li ? parseInt(li.getAttribute('data-stock')) : 1;
        updateAddToCartBtn(code, price, lis.length > 0, stockStatus);
    }

    // Bắt sự kiện click
    lis.forEach(li => {
        li.addEventListener('click', () => {
            const code = li.getAttribute('data-value');
            const price = li.getAttribute('data-price');
            const original = li.getAttribute('data-original');
            const percent = li.getAttribute('data-percent');
            updateSelectedAttribute(code, price, original, percent, li);
        });
    });

    // Khởi tạo giá trị ban đầu
    const initialCode = selectedInput.value || defaultCode;
    const initialLi = Array.from(lis).find(li => li.getAttribute('data-value') === initialCode);
    if (initialLi) {
        updateSelectedAttribute(
            initialLi.getAttribute('data-value'),
            initialLi.getAttribute('data-price'),
            initialLi.getAttribute('data-original'),
            initialLi.getAttribute('data-percent'),
            initialLi
        );
    } else {
        updateSelectedAttribute(defaultCode, defaultPrice, defaultOriginal, defaultPercent, null);
    }
});
$(document).on('click', '#product_details .dropdown-attribute h1', function (e) {
    e.stopPropagation();

    let dropdown = $(this).closest('.dropdown-attribute');

    // đóng dropdown khác
    $('#product_details .dropdown-attribute').not(dropdown).removeClass('open');

    dropdown.toggleClass('open');
});

// click item
$(document).on('click', '#product_details .dropdown-attribute li', function () {

    let dropdown = $(this).closest('.dropdown-attribute');

    // đóng dropdown sau khi chọn
    dropdown.removeClass('open');

});

// click ngoài đóng dropdown
$(document).on('click', function () {
    $('#product_details .dropdown-attribute').removeClass('open');
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form-leave-comment");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // chặn submit mặc định

        const name = form.querySelector('input[name="text"]').value.trim();
        const topic = form.querySelector('select[name="support_topic"] option:checked').textContent.trim();
        const message = form.querySelector('textarea').value.trim();

        if (!name || !topic || !message) {
            alert("Vui lòng điền đầy đủ thông tin.");
            return;
        }

        const to = "minhhieu698hcm@gmail.com";
        const subject = `FAQ - ${topic}`;
        const body =
`Xin chào RedragonVN,

Tôi là: ${name}

Nội dung cần hỗ trợ:
${message}

Trân trọng.`;

        const gmailURL = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(to)}&su=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

        window.open(gmailURL, "_blank");
    });
});
</script>

@endsection
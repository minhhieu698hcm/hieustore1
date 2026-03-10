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
                    </div> <!-- End Grid View Product -->
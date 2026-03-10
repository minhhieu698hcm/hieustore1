@extends('layout')
@section('content')

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Yêu thích</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{ URL::to('/trang-chu') }}">Trang chủ</a></li>
                                <li class="active" aria-current="page">Yêu thích</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Wishlist Section:::... -->
<div class="wishlist-section">
    <!-- Start Cart Table -->
    <div class="wishlish-table-wrapper"  data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table id="wishlist-table">
                                <!-- Start Wishlist Table Head -->
                                <thead>
                                    <tr>
                                        <th class="product_remove">Xoá</th>
                                        <th class="product_thumb">Hình ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product_stock">Tình trạng hàng</th>
                                        <th class="product_addcart">Thêm vào giỏ hàng</th>
                                    </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody id="wishlist-items">
                                    <!-- Start Wishlist Single Item-->
                                    @foreach($wishlist as $key => $item)
                                    <tr>
                                        <td class="product_remove"><a href="#" class="remove-wishlist-item" data-product-id="{{ $key }}"><i class="fa-regular fa-trash-can"></i></a></td>
                                        <td class="product_thumb"><a href=""><img src="{{ URL::to('public/upload/product/' . $item['image']) }}" alt=""></a></td>
                                        <td class="product_name"><a href="">{{ $item['name'] }}</a></td>
                                        <td class="product-price">{{ $item['price'] }}</td>
                                        <td class="product_stock">Còn hàng</td>
                                        {{-- <td class="product_stock">{{ $item['stock'] ? 'Còn hàng' : 'Hết hàng' }}</td> --}}
                                        <td class="product_addcart"><a class="animated-button1" href="" class="add-to-cart" data-bs-toggle="modal" data-bs-target="#modalAddcart" data-product-id="{{ $key }}">
                                            <span></span><span></span><span></span><span></span>Thêm vào giỏ hàng</a></td>
                                    </tr> <!-- End Wishlist Single Item-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->
</div> <!-- ...:::: End Wishlist Section:::... -->

@endsection
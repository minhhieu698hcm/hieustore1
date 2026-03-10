@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">thương hiệu sản phẩm</h2>

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                @foreach ( $brand_by_id as $key =>$product )
                    
                
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
                        <h2>{{$product->product_price}}</h2>
                        <p>{{$product->product_name}}</p>
                        <p>{{$product->product_code}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
@endsection
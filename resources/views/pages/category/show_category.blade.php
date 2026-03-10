<!--Trang sản phẩm từng mục của trang sản phẩm (layoutpro)-->
@extends('layoutpro')
@section('content')
<style>
    @media (max-width: 1500px) {
        .col-md-3 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    } 
    @media (max-width: 1200px) {
    .col-md-3 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
}
    </style>
    <h3 class=" justify-content-centers text-bold text-center" style="color:red;">DANH MỤC SẢN PHẨM </h3>
    <div class="container product-container" style="padding:20px;">
        <div class="row d-flex ">
            @foreach ($all_product as $key => $product)
                <div class="col-md-3 mt-2 mb-2">
                    <div class="card mb-4" style="width: 19rem; height= 526px;">
                        <div class="container-hover">
                                <img src="{{ URL::to('public/upload/product/' . $product->product_image) }}"
                                class="card-img-top" alt="...">
                            <div class="overlay">
                                <img src="{{ URL::to('public/upload/product/' . $product->product_image_hover) }}"
                                class="card-img-top" alt="..."> 
                            </div>
                        </div>
                        
                        <div class="card-body mx-auto" style="height: 88px;">
                            <h5><a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class=""
                                    style="text-decoration: none;color:rgb(0, 0, 0);">{{ $product->product_name }}</a>
                            </h5>
                        </div>
                        <p class="card-text mx-auto" style="color: red">Mã SP: {{ $product->product_code }}</p>
                        <ul class="list-group list-group-flush">
                            <a href="tel:0989188768" class="list-group-item" style="text-align: center;">{{ $product->product_price }}</a>
                        </ul>
                        <div class="card-body mx-auto">
                            <button type="button" class="btn btn-danger btn-block">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_Slug) }}" class="" style="text-decoration: none;color:rgb(255, 255, 255);">
                                    <small>XEM THÊM</small>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('admin_layout')
@section('admin_content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Cập nhật danh mục sản phẩm</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex"
                                        href="{{ URL::to('/dashboard') }}">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Cập nhật danh mục sản phẩm
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- start Basic Area Chart -->
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    @foreach ( $edit_category_product as $key => $edit_value )
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên danh mục<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="category_product_name" class="form-control"
                                    placeholder="Tên danh mục" value="{{ $edit_value->category_name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả danh mục
                                </label>
                                <textarea style="resize: none; row:8;" class="form-control" name="category_product_desc" id="category_product_desc" placeholder="Mô tả danh mục">{{ $edit_value->category_desc}}</textarea>
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="update_category_product" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Cập nhật danh mục</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    </form>
</div>
@endforeach
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Thêm phân loại</h4>
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
                                        Thêm phân loại
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
                    <div class="card-body">
                        <form action="{{URL::to('/submit-add-attr-value')}}" method="POST" data-toggle="validator">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nhóm phân loại<span class="text-danger"> *</span></label>
                                <select name="idAttribute" class="form-select"
                                    data-placeholder="Chọn danh mục sản phẩm" tabindex="1">
                                    @foreach($list_attribute as $key => $attribute)
                                    <option value="{{$attribute->idAttribute}}">{{$attribute->AttributeName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên phân loại<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="AttrValName" class="form-control"
                                    placeholder="Tên nhóm phân loại">
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="add_attribute" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Thêm phân loại</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    </form>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="card card-body py-3">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-sm-flex align-items-center justify-space-between">
                            <h4 class="mb-4 mb-sm-0 card-title">Sửa sản phẩm</h4>
                            <nav aria-label="breadcrumb" class="ms-auto">
                                <ol class="breadcrumb d-flex align-items-center">

                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex"
                                            href="{{ URL::to('/dashboard') }}">
                                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex"
                                            href="{{URL::to('/all-product')}}">
                                            <span
                                                class="badge fw-medium fs-2 bg-danger-subtle text-danger d-flex align-items-center">
                                                Quay lại &nbsp;<iconify-icon icon="solar:multiple-forward-left-line-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </span>

                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start Basic Area Chart -->
            <div class="row">
                <div class="col-lg-7 ">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($edit_product as $key =>$pro)
                            <form id="form-edit-product" role="form" action="{{URL::to('/update-product/' . $pro->product_id)}}" method="post"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm<span class="text-danger"> *</span></label>
                                    <input type="text" name="product_name" class="form-control" id="edit-product-name" value="{{$pro->product_name}}"
                                        onkeyup="ChangeToSlug('edit-product-name', 'edit-convert-slug');"
                                        placeholder="Tên sản phẩm">
                                </div>
                                <div class="mb-3" style="display:none">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="product_Slug" class="form-control" id="edit-convert-slug" value="{{$pro->product_Slug}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mã sản phẩm<span class="text-danger"> *</span>
                                    </label>
                                    <input type="hidden" name="product_code" id="product_code" value="{{$pro->product_code}}" class="form-control">
                                    <input type="text" name="product_code_display" id="product_code_display"
                                        class="form-control" value="{{$pro->product_code}}" placeholder="Mã sản phẩm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá sản phẩm<span class="text-danger"> *</span>
                                    </label>
                                    <input type="hidden" name="product_price" id="product_price" value="{{$pro->product_price}}" class="form-control">
                                    <input type="text" name="product_price_display" value="{{$pro->product_price}}" id="product_price_display"
                                        class="form-control" value="" placeholder="Giá sản phẩm">
                                </div>
								<div class="mb-3">
                                    <label class="form-label">Thời hạn bảo hành (tháng)</label>
                                    <select name="warranty_period" class="form-select">
                                        <option value="0" {{ $pro->warranty_period == 0 ? 'selected' : '' }}>Không bảo hành</option>
                                        <option value="1" {{ $pro->warranty_period == 1 ? 'selected' : '' }}>1 tháng</option>
                                        <option value="3" {{ $pro->warranty_period == 3 ? 'selected' : '' }}>3 tháng</option>
                                        <option value="6" {{ $pro->warranty_period == 6 ? 'selected' : '' }}>6 tháng</option>
                                        <option value="12" {{ $pro->warranty_period == 12 ? 'selected' : '' }}>12 tháng</option>
                                        <option value="24" {{ $pro->warranty_period == 24 ? 'selected' : '' }}>24 tháng</option>
                                        <option value="36" {{ $pro->warranty_period == 36 ? 'selected' : '' }}>36 tháng</option>
                                        <option value="48" {{ $pro->warranty_period == 48 ? 'selected' : '' }}>48 tháng</option>
                                        <option value="60" {{ $pro->warranty_period == 60 ? 'selected' : '' }}>60 tháng</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="button"
                                        class="btn mb-1 bg-success-subtle text-success px-4 fs-4 col-md-12"
                                        data-bs-toggle="modal" data-bs-target="#modal-attributes">
                                        Chọn phân loại
                                    </button>
                                </div>
                                <div class="col-md-12 d-flex flex-wrap input-attrs">
                                    <div class="col-md-12 d-flex flex-wrap attr-title" style="margin-bottom: 10px;">
                                        @if($name_attribute)
                                        <div class="attr-title-1 col-md-3 text-center">{{$name_attribute->AttributeName}}
                                        </div>
                                        <div class="attr-title-2 col-md-4 text-center">Mã SP phân loại</div>
                                        <div class="attr-title-2 col-md-4 text-center">Giá SP phân loại</div>
                                    @else
                                        <div class="attr-title-1 col-md-3 text-center d-none"></div>
                                        <div class="attr-title-2 col-md-4 text-center d-none">Mã SP phân loại</div>
                                        <div class="attr-title-2 col-md-4 text-center d-none">Giá SP phân loại</div>
                                    @endif
                                    </div>
                                    @foreach($list_pd_attr as $key => $pd_attr)
                                        <div id="input-attrs-item-{{$pd_attr->idAttrValue}}"
                                            class="col-md-12 mb-2 d-flex flex-wrap input_attrs_items">

                                            <div class="col-md-3">
                                                <input class="form-control text-center btn btn-rounded bg-warning-subtle text-danger" 
                                                    type="text" style="width:90%; font-weight: 900;" 
                                                    value="{{$pd_attr->AttrValName}}" disabled>
                                            </div>

                                            <div class="form-group col-md-9 d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <input class="chk_attr" name="chk_attr[]" data-id="{{$pd_attr->idAttrValue}}" 
                                                        value="{{$pd_attr->idAttrValue}}" type="hidden">

                                                    <input id="product_attribute_code_{{$pd_attr->idAttrValue}}" 
                                                        value="{{$pd_attr->product_attribute_code}}" 
                                                        class="form-control text-center product_attribute_code" 
                                                        name="product_attribute_code[]" type="text" required>

                                                    <input style="margin-left: 10px;" 
                                                    id="attribute_price_display_{{$pd_attr->idAttrValue}}" 
                                                    value="{{ number_format($pd_attr->product_price, 0, ',', ',') }}" 
                                                    class="form-control text-center attribute_price_display" 
                                                    type="text" required>

                                                    <input id="attribute_price_{{$pd_attr->idAttrValue}}" 
                                                    value="{{$pd_attr->product_price}}" 
                                                    class="attribute_price" 
                                                    name="attribute_price[]" 
                                                    type="hidden">

                                                    <button style="margin-left: 10px;" type="button" 
                                                            class="justify-content-center btn btn-rounded btn-danger mb-1 d-flex align-items-center remove-attr" 
                                                            data-id="{{$pd_attr->idAttrValue}}">
                                                            <i class="ti ti-trash fs-4"></i>
                                                    </button>
                                                </div>

                                                <!-- Phần trạng thái đưa xuống dưới với style btn-check -->
                                                <div class="mt-2 d-flex w-100 gap-2" role="group" aria-label="Trạng thái kho">
                                                <input type="radio" class="btn-check" name="attribute_stock_status[{{$key}}]"
                                                    id="stock_{{$pd_attr->idAttrValue}}_1" value="1"
                                                    {{ $pd_attr->stock_status == 1 ? 'checked' : '' }} autocomplete="off">
                                                <label class="btn btn-outline-success flex-fill" for="stock_{{$pd_attr->idAttrValue}}_1">Còn hàng</label>

                                                <input type="radio" class="btn-check" name="attribute_stock_status[{{$key}}]"
                                                    id="stock_{{$pd_attr->idAttrValue}}_0" value="0"
                                                    {{ $pd_attr->stock_status == 0 ? 'checked' : '' }} autocomplete="off">
                                                <label class="btn btn-outline-danger flex-fill" for="stock_{{$pd_attr->idAttrValue}}_0">Hết hàng</label>

                                                <input type="radio" class="btn-check" name="attribute_stock_status[{{$key}}]"
                                                    id="stock_{{$pd_attr->idAttrValue}}_2" value="2"
                                                    {{ $pd_attr->stock_status == 2 ? 'checked' : '' }} autocomplete="off">
                                                <label class="btn btn-outline-info flex-fill" for="stock_{{$pd_attr->idAttrValue}}_2">Sắp về</label>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="form-group col-lg-6">
                                        <label for="formFile" class="form-label">Ảnh sản phẩm (1000x1000px)<span
                                                class="text-danger"> *</span></label>
                                        <input type="file" name="product_image" class="form-control" id="product-image">
                                        <div id="edit-product-image-preview">
                                            <div class="image-wrapper"
                                                style="position:relative; display:inline-block; margin:5px;">
                                                <img src="{{ URL::to('public/upload/product/' . $pro->product_image) }}"
                                                    alt="" width="100" height="100" id="edit-product-image-current"
                                                    data-original="{{ URL::to('public/upload/product/' . $pro->product_image) }}">
                                                <button type="button" class="btn btn-danger image-delete-btn"
                                                    data-target="edit-product-image-current"
                                                    style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                                            </div>
                                        </div>
                                        <div id="edit-product-image-message" style="color:red; display:none;">Chưa có hình
                                            ảnh nào được chọn</div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="formFile" class="form-label">Ảnh chuyển đổi (1000x1000px)<span
                                                class="text-danger"> *</span></label>
                                                <input type="file" name="product_image_hover" class="form-control"
                                                id="edit-product-image-hover">
                                                <div id="edit-product-image-hover-preview">
                                                    <div class="image-wrapper" style="position:relative; display:inline-block; margin:5px;">
                                                        <img src="{{ URL::to('public/upload/product/' . $pro->product_image_hover) }}" alt="" width="100" height="100" id="edit-product-image-hover-current" data-original="{{ URL::to('public/upload/product/' . $pro->product_image_hover) }}">
                                                        <button type="button" class="btn btn-danger image-delete-btn" data-target="edit-product-image-hover-current" style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                                                    </div>
                                                </div>
                                                <div id="edit-product-image-hover-message" style="color:red; display:none;">Chưa có hình ảnh nào được chọn</div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="formFileMultiple" class="form-label">Gallery ảnh sản phẩm<span
                                            class="text-danger"> *</span></label>
                                            <input class="form-control" type="file" id="gallery-photo-add" name="gallery_images[]"  value="{{ implode(',', $gallery_images->pluck('gallery_image')->toArray()) }}" multiple />
                                            <input  class="form-control" type="hidden" id="old-gallery-input" name="old_images" value="{{ implode(',', $gallery_images->pluck('gallery_image')->toArray()) }}" />
                                    <span id="error_gallery"></span>
                                    <div id="gallery-preview">
                                        <!-- Các hình ảnh từ CSDL sẽ được load vào đây -->
                                        @foreach($gallery_images as $index => $image)
                                        <div class="image-wrapper" style="position:relative; display:inline-block; margin:5px;">
                                            @foreach($gallery_images as $index => $image)
                                            <img src="{{ URL::to('public/upload/gallery/' . $image->gallery_image) }}" alt="" width="100" height="100" id="gallery-image-{{ $index }}">
                                            @endforeach
                                            <button type="button" class="btn btn-danger gallery-image-delete-btn" data-index="{{ $index }}" style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh mục<span class="text-danger"> *</span></label>
                                    <select name="product_cate" class="form-select"
                                        data-placeholder="Chọn danh mục sản phẩm" tabindex="1">
                                        @foreach($cate_product as $key =>$cate)
                                        @if ($cate->category_id == $pro->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @else
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group " style="display:none">
                                    <label>Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key =>$brand)
                                @if ($brand->brand_id == $pro->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-12 w-100 border rounded"
                                    style="margin-right: 20px; padding: 6px 20px 6px 20px;">
                                    <label class="form-label w-100">Trạng thái sản phẩm<span class="text-danger">
                                            *</span></label>

                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <input type="radio" class="btn-check" name="product_stock_status" value="1"
                                                id="stock_1" autocomplete="off" {{ isset($edit_product[0]) && $edit_product[0]->product_stock_status == 1 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success" for="stock_1">Còn hàng</label>
                                        </div>
                                        <div>
                                            <input type="radio" class="btn-check" name="product_stock_status" value="0"
                                                id="stock_0" autocomplete="off" {{ isset($edit_product[0]) && $edit_product[0]->product_stock_status == 0 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger" for="stock_0">Hết hàng</label>
                                        </div>
                                        <div>
                                            <input type="radio" class="btn-check" name="product_stock_status" value="2"
                                                id="stock_2" autocomplete="off" {{ isset($edit_product[0]) && $edit_product[0]->product_stock_status == 2 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-info" for="stock_2">Sắp về hàng</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 w-100" style="margin-left: 0px; padding-right:0px">
                                    <div class="form-group col-lg-4 border rounded"
                                        style=" display: flex;flex-direction: column;align-items: center; text-align: center; padding-top: 4px;">
                                        <label class="form-label">Hiển thị</label>
                                        <div class="form-check form-switch d-flex" style="justify-content: center;">
                                            <input type="hidden" name="product_status" value="0">
                                            <input class="form-check-input success mb-2" style="font-size: 20px"
                                                name="product_status" type="checkbox" id="product_status" value="1" {{ isset($edit_product[0]) && $edit_product[0]->product_status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 border rounded"
                                        style=" display: flex;flex-direction: column;align-items: center; text-align: center; padding-top: 4px;">
                                        <label class="form-label">SP Yêu thích</label>
                                        <div class="form-check form-switch d-flex" style="justify-content: center;">
                                            <input type="hidden" name="favorite_product" value="0">
                                            <input class="form-check-input danger mb-2" style="font-size: 20px"
                                                name="favorite_product" type="checkbox" id="favorite_product" value="1" {{ isset($edit_product[0]) && $edit_product[0]->favorite_product == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 border rounded"
                                        style=" display: flex;flex-direction: column;align-items: center; text-align: center; padding-top: 4px;">
                                        <label class="form-label">SP Sale</label>
                                        <div class="form-check form-switch d-flex" style="justify-content: center;">
                                            <input type="hidden" name="product_sale" value="0">
                                            <input class="form-check-input warning mb-2" style="font-size: 20px"
                                                name="product_sale" type="checkbox" id="product_sale" value="1" {{ isset($edit_product[0]) && $edit_product[0]->product_sale == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-actions" style="text-align: center;">
                            <button type="submit" name="update_product" class="btn btn-primary"
                                style="padding: 20px; width:100%">Sửa sản phẩm</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="offcanvas-md offcanvas-end overflow-auto" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" style="width:90%">Mô tả sản phẩm</label>
                                    <textarea style=" height: 150px; row:8;" class="form-control" name="product_desc"
                                        placeholder="Mô tả sản phẩm">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="width:90%">Thông số cơ bản</label>
                                    <textarea style=" height: 150px; row:8;" class="form-control" name="product_content"
                                        placeholder="Thông số cơ bản">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="width:90%">Ảnh hiển thị trang dưới</label>
                                    <textarea style=" height: 150px; row:8;" class="form-control" name="product_gale_desc"
                                        placeholder="Ảnh hiển thị trang dưới">{{$pro->product_gale_desc}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Basic Area Chart -->
        </div>
        <div id="modal-attributes" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-success text-white">
                        <h4 class="modal-title text-white" id="success-header-modalLabel">
                            Thêm phân loại
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="mb-1">Nhóm phân loại</label>
                        <select name="idAttribute" id="attribute" class="selectpicker form-control choose-attr" data-style="py-0">
                            @if($name_attribute) <option class="option-default" value="{{$name_attribute->idAttribute}}" id="attr-group-{{$name_attribute->idAttribute}}" data-attr-group-name="{{$name_attribute->AttributeName}}">{{$name_attribute->AttributeName}}</option>
                            @else <option style="background-color: rgba(0, 0, 0, 0.75);" value="">Chọn nhóm phân loại</option> @endif
                            @foreach($list_attribute as $key => $attribute)
                            <option id="attr-group-{{$attribute->idAttribute}}" data-attr-group-name="{{$attribute->AttributeName}}" value="{{$attribute->idAttribute}}">{{$attribute->AttributeName}}</option>
                            @endforeach
                        </select>
                        <div class="pb-3 d-flex flex-wrap" id="attribute_value"
                            style="align-items: center;text-align: center;">
                            @foreach($list_pd_attr as $key => $pd_attr)
                            <label for="chk-attr-{{$pd_attr->idAttrValue}}" class="d-block col-lg-3 p-0 m-0"><div id="attr-name-{{$pd_attr->idAttrValue}}" class="select-attr text-center mr-2 mt-2 btn btn-outline-danger active">{{$pd_attr->AttrValName}}</div></label>
                            <input type="checkbox" class="checkstatus d-none chk_attr" id="chk-attr-{{$pd_attr->idAttrValue}}" data-id="{{$pd_attr->idAttrValue}}" data-name = "{{$pd_attr->AttrValName}}" name="chk_attr[]" value="{{$pd_attr->idAttrValue}}">
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button type="button" id="confirm-attrs" data-bs-dismiss="modal"
                            class="btn bg-success-subtle text-success ">
                            Xác nhận
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
    </form>
    @endforeach




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
   $(document).ready(function () {
    // Đánh dấu checkbox và kích hoạt class active nếu thuộc tính đã chọn
    $(".input_attrs_items").each(function () {
        var attr_id = $(this).attr("id").replace("input-attrs-item-", "");
        var checkbox = $('input[type=checkbox][data-id="' + attr_id + '"]');
        checkbox.prop("checked", true);
        $("#attr-name-" + attr_id).addClass("active");
    });

    $('.choose-attr').on('change', function () {
        var idAttribute = $(this).val();
        var checked_attrs = [];

        // Lấy danh sách thuộc tính đang được chọn
        $("input[type=checkbox]:checked").each(function () {
            checked_attrs.push($(this).data("id"));
        });

        $.ajax({
            url: '{{url("/select-attribute")}}',
            method: 'POST',
            data: {
                action: "attribute",
                idAttribute: idAttribute,
                _token: $('input[name="_token"]').val()
            },
            success: function (data) {
                $('#attribute_value').html(data);

                // Đánh dấu lại các checkbox đã chọn sau khi load lại dữ liệu
                checked_attrs.forEach(function (id) {
                    var checkbox = $('input[type=checkbox][data-id="' + id + '"]');
                    checkbox.prop("checked", true);
                    $("#attr-name-" + id).addClass("active");
                });
            },
            error: function (xhr) {
                console.error("Lỗi AJAX:", xhr.responseText);
            }
        });
    });

    // Xử lý khi click checkbox chọn phân loại
    $(document).on("click", "input[type=checkbox].chk_attr", function () {
        var attr_id = $(this).data("id");
        var attr_name = $(this).data("name");

        if (!attr_id) return;

        if ($(this).is(":checked")) {
            $("#attr-name-" + attr_id).addClass("active");

            // Tạo input nếu chưa tồn tại
            if ($('#input-attrs-item-' + attr_id).length < 1) {
                var input_attrs_item = `
                     <div id="input-attrs-item-${attr_id}" class="col-md-12 mb-2 d-flex flex-wrap input_attrs_items">
                                    <div class="col-md-3">
                                        <input class="form-control text-center bg-warning-subtle text-danger" type="text" style="width:90%; font-weight: 900;" value="${attr_name}" disabled>
                                    </div>
                                    <div class="form-group col-md-9 d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <input class="chk_attr" name="chk_attr[]" data-id="${attr_id}" value="${attr_id}" type="hidden">
                                            <input id="product_attribute_code_${attr_id}" class="form-control text-center product_attribute_code" name="product_attribute_code[]" placeholder="Mã phân loại" type="text" required>
                                           <input style="margin-left: 10px;" id="attribute_price_display_${attr_id}" class="form-control text-center attribute_price_display" placeholder="Nhập giá phân loại" type="text" required>
                                           <input id="attribute_price_${attr_id}" class="attribute_price" name="attribute_price[]" type="hidden">
                                            <button style="margin-left: 10px;" type="button" class="btn btn-danger remove-attr-btn" data-attr-id="${attr_id}">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button>
                                        </div>
                                        <!-- Trạng thái phân loại dạng btn-check giống edit -->
                                        <div class="mt-2 d-flex w-100 gap-2" role="group" aria-label="Trạng thái kho">
                                            <input type="radio" class="btn-check" name="attribute_stock_status[${attr_id}]" id="stock_${attr_id}_1" value="1" checked autocomplete="off">
                                            <label class="btn btn-outline-success flex-fill" for="stock_${attr_id}_1">Còn hàng</label>
                                            <input type="radio" class="btn-check" name="attribute_stock_status[${attr_id}]" id="stock_${attr_id}_0" value="0" autocomplete="off">
                                            <label class="btn btn-outline-danger flex-fill" for="stock_${attr_id}_0">Hết hàng</label>
                                            <input type="radio" class="btn-check" name="attribute_stock_status[${attr_id}]" id="stock_${attr_id}_2" value="2" autocomplete="off">
                                            <label class="btn btn-outline-info flex-fill" for="stock_${attr_id}_2">Sắp về</label>
                                        </div>
                                    </div>
                                </div>`;
                $('.input-attrs').append(input_attrs_item);
            }
        } else {
            $("#attr-name-" + attr_id).removeClass("active");
            $('#input-attrs-item-' + attr_id).remove();
        }
    });

    // Xử lý khi bấm nút xóa thuộc tính
    $(document).on('click', '.remove-attr', function () {
        var attrId = $(this).data('id');

        if (!attrId) return;

        $('#input-attrs-item-' + attrId).remove();
        $('input[type=checkbox][data-id="' + attrId + '"]').prop('checked', false);
        $("#attr-name-" + attrId).removeClass("active");
    });

    // Xác nhận phân loại
    $("#confirm-attrs").click(function () {
        if ($('[name="chk_attr[]"]:checked').length >= 1) {
            $('.attr-title-1, .attr-title-2').removeClass('d-none');
            $('#Quantity').addClass('disabled-input');
            $('#edit-product_code').prop('disabled', true);
        } else {
            $('.attr-title-1, .attr-title-2').addClass('d-none');
            $('#Quantity').removeClass('disabled-input');
            $('#edit-product_code').prop('disabled', false);
        }
    });
});

    </script>
    <!-- Check trùng mã sản phẩm -->

 <script>
     // Format và đồng bộ attribute_price_display <-> attribute_price (hidden)
$(document).on("input", ".attribute_price_display", function () {
    let rawNumber = $(this).val().replace(/\D/g, ""); 
    let formatted = rawNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $(this).val(formatted);

    let attrId = $(this).attr("id").replace("attribute_price_display_", "");
    $("#attribute_price_" + attrId).val(rawNumber);
});

// Khi load trang: format lại toàn bộ giá trị display
$(document).ready(function () {
    $(".attribute_price_display").each(function () {
        let rawNumber = $(this).val().replace(/\D/g, "");
        if (rawNumber) {
            $(this).val(rawNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            let attrId = $(this).attr("id").replace("attribute_price_display_", "");
            $("#attribute_price_" + attrId).val(rawNumber);
        }
    });
});

    </script>
<script>
    $(document).on("input", ".product_attribute_code", function () {
    $(this).val($(this).val().toUpperCase());
});
</script>

    <script>
        function showError(input, message) {
            let errorElement = input.nextElementSibling;
            if (!errorElement || !errorElement.classList.contains("text-danger")) {
                errorElement = document.createElement("div");
                errorElement.classList.add("text-danger", "mt-1");
                input.parentNode.appendChild(errorElement);
            }
            errorElement.textContent = message;
            input.classList.add("is-invalid");
        }

        function clearError(input) {
            let errorElement = input.nextElementSibling;
            if (errorElement && errorElement.classList.contains("text-danger")) {
                errorElement.remove();
            }
            input.classList.remove("is-invalid");
        }

        $(document).ready(function () {
            $('#product_code_display').on('blur', function () {
                var productCode = $(this).val();
                var inputField = this; // Tham chiếu đến input hiện tại
                $.ajax({
                    url: '{{ url('/check-product-code') }}',
                    method: 'POST',
                    data: {
                        product_code: productCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.exists) {
                            showError(inputField, 'Mã sản phẩm đã tồn tại!');
                        } else {
                            clearError(inputField);
                        }
                    }
                });
            });
        });
    </script>

    <!-- Check trùng mã sản phẩm -->


<script>
$(document).ready(function () {
    // Bỏ dấu tiếng Việt và in hoa
    function removeDiacritics(str) {
        var map = {
            'à': 'a', 'á': 'a', 'ạ': 'a', 'ả': 'a', 'ã': 'a', 'â': 'a', 'ấ': 'a', 'ầ': 'a', 'ẩ': 'a', 'ẫ': 'a', 'ă': 'a', 'ắ': 'a', 'ằ': 'a', 'ẳ': 'a', 'ẵ': 'a', 'ặ': 'a',
            'è': 'e', 'é': 'e', 'ẹ': 'e', 'ẻ': 'e', 'ẽ': 'e', 'ê': 'e', 'ế': 'e', 'ề': 'e', 'ể': 'e', 'ễ': 'e', 'ệ': 'e',
            'ì': 'i', 'í': 'i', 'ị': 'i', 'ỉ': 'i', 'ĩ': 'i',
            'ò': 'o', 'ó': 'o', 'ọ': 'o', 'ỏ': 'o', 'õ': 'o', 'ô': 'o', 'ố': 'o', 'ồ': 'o', 'ổ': 'o', 'ỗ': 'o', 'ơ': 'o', 'ớ': 'o', 'ờ': 'o', 'ở': 'o', 'ỡ': 'o', 'ợ': 'o',
            'ù': 'u', 'ú': 'u', 'ụ': 'u', 'ủ': 'u', 'ũ': 'u', 'ư': 'u', 'ứ': 'u', 'ừ': 'u', 'ử': 'u', 'ữ': 'u', 'ự': 'u',
            'ỳ': 'y', 'ý': 'y', 'ỵ': 'y', 'ỷ': 'y', 'ỹ': 'y',
            'đ': 'd', 'Đ': 'D'
        };
        return str.replace(/[àáạảãâấầẩẫăắằẳẵặèéẹẻẽêếềệểễíìịỉĩòóọỏõôốồộổỗơớờợởỡúùụủũưứừửữựỳýỵỷỹđĐ]/g, function (match) {
            return map[match];
        }).toUpperCase();
    }

    // Format số có dấu phẩy
    function formatNumber(num) {
        num = num.toString().replace(/\D/g, "");
        return num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Cập nhật hidden product_code & product_price từ phân loại
    function updateProductDetails() {
        let productCode = '';
        let productPrice = '';

        const selectedAttr = $('.input_attrs_items');
        if (selectedAttr.length > 0) {
            const firstSelectedAttr = selectedAttr.first();
            productCode = firstSelectedAttr.find('.product_attribute_code').val()?.trim() || '';
            productPrice = firstSelectedAttr.find('.attribute_price').val()?.replace(/\D/g, '') || '';
        }

        // Nếu chưa có phân loại, dùng giá trị gốc
        if (!productCode) {
            productCode = $('#product_code_display').val().trim();
        }
        if (!productPrice) {
            productPrice = $('#product_price_display').val().replace(/\D/g, '');
        }

        $('#product_code').val(removeDiacritics(productCode));
        $('#product_price').val(productPrice);
        $('#product_code_display').val(removeDiacritics(productCode));
        $('#product_price_display').val(formatNumber(productPrice));
    }

    // --- LẮNG NGHE SỰ KIỆN NHẬP DỮ LIỆU ---
    // Khi người dùng nhập giá hiển thị của phân loại
    $(document).on('input', '.attribute_price_display', function () {
        let rawNumber = $(this).val().replace(/\D/g, '');
        let formatted = formatNumber(rawNumber);
        $(this).val(formatted);

        let attrId = $(this).attr("id").replace("attribute_price_display_", "");
        $("#attribute_price_" + attrId).val(rawNumber);

        // Cập nhật lại product_price tổng thể
        updateProductDetails();
    });

    // Khi người dùng sửa mã phân loại hoặc mã/gía chính
    $(document).on('input', '.product_attribute_code, #product_code_display, #product_price_display', function () {
        updateProductDetails();
    });

    // Khi xóa phân loại
    $(document).on('click', '.remove-attr', function () {
        $(this).closest('.input_attrs_items').remove();
        setTimeout(updateProductDetails, 100);
    });

    // Khởi tạo khi tải trang
    updateProductDetails();
});
</script>

    

    <!-- giao diện và check input -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var priceInput = document.getElementById("product_price");
            var priceDisplayInput = document.getElementById("product_price_display");

            priceDisplayInput.addEventListener("input", function (event) {
                var enteredValue = event.target.value;

                // Loại bỏ ký tự không phải số
                var rawNumber = enteredValue.replace(/\D/g, "");

                // Định dạng số hàng nghìn
                var formattedValue = formatNumber(rawNumber);

                // Gán lại giá trị hiển thị và giá trị thô
                priceDisplayInput.value = formattedValue;
                priceInput.value = rawNumber;
            });

            // Hàm định dạng số hàng nghìn (thêm dấu ",")
            function formatNumber(number) {
                return number.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let productCodeDisplay = document.getElementById("product_code_display");
            let productCode = document.getElementById("product_code");

            productCodeDisplay.addEventListener("input", function () {
                let uppercaseValue = this.value.toUpperCase();
                this.value = uppercaseValue;
                productCode.value = uppercaseValue;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("form-edit-product");

            const fields = [
                { name: "product_name", message: "Nhập tên sản phẩm" },
                { name: "product_price_display", message: "Nhập giá sản phẩm" },
                { name: "product_code_display", message: "Nhập mã sản phẩm" },
            ];

            function showError(input, message) {
                let errorElement = input.nextElementSibling;
                if (!errorElement || !errorElement.classList.contains("text-danger")) {
                    errorElement = document.createElement("div");
                    errorElement.classList.add("text-danger", "mt-1");
                    input.parentNode.appendChild(errorElement);
                }
                errorElement.textContent = message;
                input.classList.add("is-invalid");
            }

            function clearError(input) {
                let errorElement = input.nextElementSibling;
                if (errorElement && errorElement.classList.contains("text-danger")) {
                    errorElement.textContent = "";
                }
                input.classList.remove("is-invalid");
            }

            form.addEventListener("submit", function (event) {
                let isValid = true;

                fields.forEach(field => {
                    const input = field.name ? document.querySelector(`[name="${field.name}"]`) : document.getElementById(field.id);

                    if (input) {
                        let value = input.value.trim();
                        if (field.type === "file") {
                            value = input.files.length > 0;
                        }

                        if (!value) {
                            showError(input, field.message);
                            isValid = false;
                        } else {
                            clearError(input);
                        }
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });

    </script>
    <!-- giao diện và check input -->

    <!-- Xu-ly-hinh-gallery -->

    <script>
    $(document).ready(function () {
        let originalImageSrcs = {}; // lưu lại ảnh gốc theo ID để khôi phục

        // Xử lý ảnh sản phẩm chính
        $('#product-image').on('change', function (event) {
            const previewId = 'edit-product-image-preview';
            const currentImageId = 'edit-product-image-current';
            const inputId = 'product-image';
            const messageId = 'edit-product-image-message';
            saveOriginalImage(currentImageId);
            handleFileSelect(event, previewId, currentImageId, inputId, messageId);
        });

        // Xử lý ảnh hover
        $('#edit-product-image-hover').on('change', function (event) {
            const previewId = 'edit-product-image-hover-preview';
            const currentImageId = 'edit-product-image-hover-current';
            const inputId = 'edit-product-image-hover';
            const messageId = 'edit-product-image-hover-message';
            saveOriginalImage(currentImageId);
            handleFileSelect(event, previewId, currentImageId, inputId, messageId);
        });

        // Lưu ảnh gốc ban đầu từ DB
        function saveOriginalImage(currentImageId) {
            const currentImage = $(`#${currentImageId}`);
            if (currentImage.length) {
                originalImageSrcs[currentImageId] = currentImage.attr('src');
            }
        }

        // Hiển thị ảnh preview khi chọn ảnh mới
        function handleFileSelect(event, previewId, currentImageId, inputId, messageId) {
            const file = event.target.files[0];
            const preview = $(`#${previewId}`);
            const currentImage = $(`#${currentImageId}`);
            const message = $(`#${messageId}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const $image = $('<img>').attr('src', e.target.result).css({ width: '100px', height: '100px', margin: '5px' });

                    // nút X cho ảnh mới chọn
                    const $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>')
                        .css({ position: 'absolute', top: '5px', right: '-13px', fontSize: '10px', height: '18px', width: '18px', padding: '0px' })
                        .on('click', function () {
                            restoreOriginalImage(previewId, currentImageId, inputId, messageId);
                        });

                    const $wrapper = $('<div>').addClass('image-wrapper').css({ position: 'relative', display: 'inline-block', margin: '5px' });
                    $wrapper.append($image).append($deleteBtn);

                    preview.html($wrapper); // hiển thị ảnh mới
                    currentImage.hide(); // ẩn ảnh cũ từ DB
                    message.hide();
                };
                reader.readAsDataURL(file);
            }
        }

        // Khôi phục lại hình cũ từ DB nếu người dùng xoá ảnh mới chọn
        function restoreOriginalImage(previewId, currentImageId, inputId, messageId) {
            const originalSrc = originalImageSrcs[currentImageId];
            const preview = $(`#${previewId}`);
            const message = $(`#${messageId}`);

            if (originalSrc) {
                const restored = `
                    <div class="image-wrapper" style="position:relative; display:inline-block; margin:5px;">
                        <img src="${originalSrc}" alt="" width="100" height="100" id="${currentImageId}" data-original="${originalSrc}">
                        <button type="button" class="btn btn-danger image-delete-btn" data-target="${currentImageId}" style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                    </div>
                `;
                preview.html(restored);
                $(`#${inputId}`).val('');
                message.hide();
            } else {
                preview.html('');
                $(`#${inputId}`).val('');
                message.text('Chưa có hình ảnh nào được chọn').show();
            }
        }

        // Nút X xoá ảnh từ DB (ẩn luôn wrapper)
        $(document).on('click', '.image-delete-btn', function () {
            const targetImageId = $(this).data('target');
            const previewId = $(this).closest('div[id$="-preview"]').attr('id');
            const inputId = previewId.replace('-preview', '');
            const messageId = previewId.replace('-preview', '-message');

            $(this).closest('.image-wrapper').remove(); // xoá luôn khối ảnh
            $(`#${inputId}`).val('');
            $(`#${messageId}`).text('Chưa có hình ảnh nào được chọn').show();
        });
    });
</script>


    <script>
        $(document).ready(function () {
            var allFiles = []; // Mảng chứa tất cả các file (bao gồm file từ CSDL và file mới)
            var initialGalleryImages = @json($gallery_images); // Lấy hình ảnh từ CSDL

            // Hàm khởi tạo preview hình ảnh từ CSDL
            function loadInitialGalleryImages() {
                initialGalleryImages.forEach(function (image) {
                    allFiles.push({
                        url: "{{ URL::to('public/upload/gallery/') }}/" + image.gallery_image,
                        file: null,
                        type: 'old',
                        deleted: false
                    });
                });
                previewImages();
            }

            // Hàm hiển thị preview hình ảnh
            function previewImages() {
                var $preview = $('#gallery-preview');
                $preview.empty(); // Xóa nội dung hiện tại

                if (allFiles.length === 0 || allFiles.every(fileObj => fileObj.deleted)) {
                    $preview.append('<p style="color:red">Chưa có hình ảnh nào được chọn.</p>');
                    return;
                }

                allFiles.forEach(function (fileObj, index) {
                    if (fileObj.deleted) return; // Không hiển thị hình ảnh đã bị xóa

                    if (fileObj.type === 'old') {
                        appendImageToPreview(fileObj.url, index, true);
                    } else if (fileObj.file) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            appendImageToPreview(e.target.result, index, false);
                        };
                        reader.readAsDataURL(fileObj.file);
                    }
                });
            }

            // Hàm thêm hình ảnh vào preview
            function appendImageToPreview(src, index, isOldImage) {
                var $image = $('<img>')
                    .attr('src', src)
                    .css({ width: '100px', height: '100px', margin: '5px' });

                var $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>')
                    .css({
                        position: 'absolute',
                        top: '5px',
                        right: '-13px',
                        fontSize: '10px',
                        height: '18px',
                        width: '18px',
                        padding: '0px'
                    })
                    .on('click', function () {
                        removeGalleryImage(index);
                    });

                var $wrapper = $('<div>')
                    .css({ position: 'relative', display: 'inline-block', margin: '5px' })
                    .append($image)
                    .append($deleteBtn);

                $('#gallery-preview').append($wrapper);
            }

            // Hàm xóa hình ảnh khỏi mảng
            function removeGalleryImage(indexToRemove) {
                allFiles[indexToRemove].deleted = true; // Đánh dấu hình ảnh đã xóa
                previewImages(); // Hiển thị lại hình ảnh sau khi xóa
                updateInputFiles(); // Cập nhật lại input
            }

            // Hàm cập nhật input file để truyền lên server
            function updateInputFiles() {
                var dataTransfer = new DataTransfer();
                var remainingOldImages = [];

                allFiles.forEach(function (fileObj) {
                    if (!fileObj.deleted) {
                        if (fileObj.type === 'new') {
                            dataTransfer.items.add(fileObj.file);
                        } else if (fileObj.type === 'old') {
                            remainingOldImages.push(fileObj.url.split('/').pop());
                        }
                    }
                });

                $('#gallery-photo-add')[0].files = dataTransfer.files; // Cập nhật lại giá trị của input file
                $('#old-gallery-input').val(remainingOldImages.join(',')); // Cập nhật danh sách hình ảnh cũ
            }

            // Xử lý khi người dùng chọn ảnh mới
            $('#gallery-photo-add').on('change', function (event) {
                var files = event.target.files;
                for (var i = 0; i < files.length; i++) {
                    allFiles.push({
                        url: URL.createObjectURL(files[i]),
                        file: files[i],
                        type: 'new',
                        deleted: false
                    });
                }
                previewImages();
                updateInputFiles();
            });

            // Khởi tạo hình ảnh gallery cũ khi tải trang
            loadInitialGalleryImages();
        });
    </script>
    <!-- Xu-ly-hinh-gallery -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let productAttributeCode = document.getElementById("product_attribute_code");

    productAttributeCode.addEventListener("input", function () {
        let uppercaseValue = this.value.toUpperCase(); // Chuyển giá trị thành chữ in hoa
        this.value = uppercaseValue;  // Cập nhật giá trị trong input với chữ in hoa
    });
});

    </script>
    <script>
document.querySelector('form').addEventListener('submit', function (event) {
    let isValid = true;
    let attributePrices = document.querySelectorAll('.attribute_price');
    let attributeCodes = document.querySelectorAll('.product_attribute_code');
    
    // Kiểm tra giá trị của attribute_price có phải là số nguyên hợp lệ không
    for (let i = 0; i < attributePrices.length; i++) {
        let priceInput = attributePrices[i];
        let priceValue = priceInput.value.trim();
        
        // Loại bỏ tất cả các ký tự không phải số, bao gồm dấu phẩy và dấu chấm
        priceValue = priceValue.replace(/[^\d]/g, ''); // Loại bỏ tất cả các ký tự không phải số

        // Kiểm tra nếu giá trị không phải số nguyên hợp lệ
        if (priceValue === "" || !/^\d+$/.test(priceValue)) {
            isValid = false;
            addError(priceInput);
        } else {
            // Cập nhật lại giá trị của input thành số nguyên hợp lệ (không có dấu, .)
            priceInput.value = priceValue;
            removeError(priceInput); // Nếu hợp lệ, xóa thông báo lỗi cũ (nếu có)
        }
    }

    // Kiểm tra và chuyển đổi giá trị của product_attribute_code
    for (let i = 0; i < attributeCodes.length; i++) {
        let codeInput = attributeCodes[i];
        let codeValue = codeInput.value.trim();

        // Kiểm tra nếu trường product_attribute_code để trống
        if (codeValue === "") {
            isValid = false;
            addError(codeInput); // Thêm lỗi nếu trường trống
        } else {
            removeError(codeInput); // Nếu hợp lệ, xóa thông báo lỗi cũ (nếu có)
            let formattedCode = removeAccents(codeValue).toUpperCase();
            codeInput.value = formattedCode;
        }
    }

    // Ngừng submit form nếu có lỗi
    if (!isValid) {
        event.preventDefault();
    }
});

// Hàm thêm lỗi (thêm lớp text-danger và style="padding-right: 0;" vào trường input)
function addError(input) {
    input.classList.add("is-invalid", "text-danger");
    input.style.paddingRight = "0";  // Thêm style padding-right: 0
}

// Hàm xóa lỗi (xóa lớp is-invalid và text-danger)
function removeError(input) {
    input.classList.remove("is-invalid", "text-danger");
    input.style.paddingRight = "";  // Xóa style padding-right
}

// Hàm xóa dấu của các ký tự tiếng Việt
function removeAccents(str) {
    const accents = 'áàạảãâấầậẩẫăắằặẳẵđéèẹẻẽêếềệểễíìịỉĩóòọỏõôốồộổỗơớờợởỡúùụủũưứừựửữýỳỵỷỹ';
    const accentsOut = 'aaaaaaadaeeeeeiiiooooooooouuuuuuuyyyy';
    
    str = str.split('').map(function (char) {
        const index = accents.indexOf(char);
        return index !== -1 ? accentsOut.charAt(index) : char;
    }).join('');
    
    return str;
}

    </script>
<script>
$(document).ready(function () {
    // Khi click vào các ô nhập giá -> tự động select toàn bộ nội dung
    $(document).on('click', '.attribute_price_display, #product_price_display', function () {
        $(this).select();
    });
});
</script>
@endsection
@extends('admin_layout')
@section('admin_content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="card card-body py-3">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-sm-flex align-items-center justify-space-between">
                            <h4 class="mb-4 mb-sm-0 card-title">Thêm sản phẩm</h4>
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
                            <form id="form-add-product" action="{{URL::to('/save-product')}}" method="post"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm<span class="text-danger"> *</span></label>
                                    <input type="text" name="product_name" class="form-control" id="add-product-name"
                                        onkeyup="ChangeToSlug('add-product-name', 'add-convert-slug');"
                                        placeholder="Tên sản phẩm">
                                </div>
                                <div class="mb-3" style="display:none">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="product_Slug" class="form-control" id="add-convert-slug">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mã sản phẩm<span class="text-danger"> *</span>
                                    </label>
                                    <input type="hidden" name="product_code" id="product_code" class="form-control">
                                    <input type="text" name="product_code_display" id="product_code_display"
                                        class="form-control" value="" placeholder="Mã sản phẩm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá sản phẩm<span class="text-danger"> *</span>
                                    </label>
                                    <input type="hidden" name="product_price" id="product_price" class="form-control">
                                    <input type="text" name="product_price_display" id="product_price_display"
                                        class="form-control" value="" placeholder="Giá sản phẩm">
                                </div>
								<div class="mb-3">
                                    <label class="form-label">Thời hạn bảo hành (tháng)</label>
                                    <select name="warranty_period" class="form-select">
                                        <option value="0">Không bảo hành</option>
                                        <option value="1">1 tháng</option>
                                        <option value="3">3 tháng</option>
                                        <option value="6">6 tháng</option>
                                        <option value="12">12 tháng</option>
                                        <option value="24" selected>24 tháng</option>
                                        <option value="36">36 tháng</option>
                                        <option value="48">48 tháng</option>
                                        <option value="60">60 tháng</option>
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
                                        <div class="attr-title-1 col-md-3 text-center d-none"></div>
                                        <div class="attr-title-2 col-md-4 text-center d-none">Mã SP phân loại</div>
                                        <div class="attr-title-2 col-md-4 text-center d-none">Giá SP phân loại</div>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="form-group col-lg-6">
                                        <label for="formFile" class="form-label">Ảnh sản phẩm (1000x1000px)<span
                                                class="text-danger"> *</span></label>
                                        <input type="file" name="product_image" class="form-control" id="product-image">
                                        <div id="product-image-preview"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="formFile" class="form-label">Ảnh chuyển đổi (1000x1000px)<span
                                                class="text-danger"> *</span></label>
                                        <input type="file" name="product_image_hover" class="form-control"
                                            id="product-image-hover">
                                        <div id="product-image-hover-preview"></div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="formFileMultiple" class="form-label">Gallery ảnh sản phẩm<span
                                            class="text-danger"> *</span></label>
                                    <input type="file" class="form-control" name="file[]" accept="image/*" multiple
                                        id="gallery-photo-add">
                                    <div id="gallery-preview"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh mục<span class="text-danger"> *</span></label>
                                    <select name="product_cate" class="form-select"
                                        data-placeholder="Chọn danh mục sản phẩm" tabindex="1">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group " style="display:none">
                                    <label>Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                                                id="stock_1" autocomplete="off" checked>
                                            <label class="btn btn-outline-success" for="stock_1">Còn hàng</label>
                                        </div>
                                        <div>
                                            <input type="radio" class="btn-check" name="product_stock_status" value="0"
                                                id="stock_0" autocomplete="off">
                                            <label class="btn btn-outline-danger" for="stock_0">Hết hàng</label>
                                        </div>
                                        <div>
                                            <input type="radio" class="btn-check" name="product_stock_status" value="2"
                                                id="stock_2" autocomplete="off">
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
                                                name="product_status" type="checkbox" id="product_status" checked value="1">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 border rounded"
                                        style=" display: flex;flex-direction: column;align-items: center; text-align: center; padding-top: 4px;">
                                        <label class="form-label">SP Yêu thích</label>
                                        <div class="form-check form-switch d-flex" style="justify-content: center;">
                                            <input type="hidden" name="favorite_product" value="0">
                                            <input class="form-check-input danger mb-2" style="font-size: 20px"
                                                name="favorite_product" type="checkbox" id="favorite_product" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 border rounded"
                                        style=" display: flex;flex-direction: column;align-items: center; text-align: center; padding-top: 4px;">
                                        <label class="form-label">SP Sale</label>
                                        <div class="form-check form-switch d-flex" style="justify-content: center;">
                                            <input type="hidden" name="product_sale" value="0">
                                            <input class="form-check-input warning mb-2" style="font-size: 20px"
                                                name="product_sale" type="checkbox" id="product_sale" value="1">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-actions" style="text-align: center;">
                            <button type="submit" name="save_product" class="btn btn-primary"
                                style="padding: 20px; width:100%">Thêm sản phẩm</button>
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
                                        placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="width:90%">Thông số cơ bản</label>
                                    <textarea style=" height: 150px; row:8;" class="form-control" name="product_content"
                                        placeholder="Thông số cơ bản"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="width:90%">Ảnh hiển thị trang dưới</label>
                                    <textarea style=" height: 150px; row:8;" class="form-control" name="product_gale_desc"
                                        placeholder="Ảnh hiển thị trang dưới"></textarea>
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
                        <select name="idAttribute" id="attribute" class="selectpicker form-control choose-attr"
                            data-style="py-0">
                            <option style="background-color: rgba(0, 0, 0, 0.75);" value="">Chọn nhóm phân loại</option>
                            @foreach($list_attribute as $key => $attribute)
                                <option id="attr-group-{{$attribute->idAttribute}}"
                                    data-attr-group-name="{{$attribute->AttributeName}}" value="{{$attribute->idAttribute}}">
                                    {{$attribute->AttributeName}}</option>
                            @endforeach
                        </select>
                        <div class="pb-3 d-flex flex-wrap" id="attribute_value"
                            style="align-items: center;text-align: center;">

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
    $(document).ready(function () {
        $('.choose-attr').on('change', function () {
            var action = $(this).attr('id');
            var idAttribute = $(this).val();
            var attr_group_name = $("#attr-group-" + idAttribute).data("attr-group-name");
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'attribute') result = 'attribute_value';

            $.ajax({
                url: '{{url("/select-attribute")}}',
                method: 'POST',
                data: { action: action, idAttribute: idAttribute, _token: _token },
                success: function (data) {
                    $('#' + result).html(data);

                    // Gán sự kiện click cho checkbox trong modal sau khi Ajax trả về
                    $(document).on('click', "input[type=checkbox].chk_attr", function () {
                        var attr_id = $(this).data("id");
                        var attr_name = $(this).data("name");

                        if (!attr_id) return;

                        // Kiểm tra trạng thái checkbox
                        if ($(this).is(":checked")) {
                            // Thêm class active vào phần tử trong modal
                            $("#attr-name-" + attr_id).addClass("active");

                            // Tạo phần tử input ngoài giao diện nếu chưa có
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

                            // Kiểm tra nếu chưa có phần tử này trong giao diện thì thêm vào
                            if ($('#input-attrs-item-' + attr_id).length < 1) {
                                $('.input-attrs').append(input_attrs_item);
                            }

                        } else {
                            // Nếu bỏ chọn checkbox thì loại bỏ class active trong modal
                            $("#attr-name-" + attr_id).removeClass("active");

                            // Xóa input ngoài giao diện khi bỏ chọn
                            $('#input-attrs-item-' + attr_id).remove();
                        }
                    });

                    // Xử lý sự kiện xóa phân loại
                    $(document).on('click', '.remove-attr-btn', function () {
                        var attrId = $(this).data('attr-id');
                        // Loại bỏ phần tử input ngoài giao diện
                        $('#input-attrs-item-' + attrId).remove();
                        // Loại bỏ class active trong modal
                        $("#attr-name-" + attrId).removeClass("active");

                        // Bỏ chọn checkbox khi xóa
                        $("#chk-attr-" + attrId).prop('checked', false);
                    });

                    // Xử lý khi xác nhận
                    $("#confirm-attrs").click(function () {
                        if ($('[name="chk_attr[]"]:checked').length >= 1) {
                            $('.attr-title-1').html(attr_group_name).removeClass('d-none');
                            $('.attr-title-2').removeClass('d-none');
                        } else {
                            $('.attr-title-1, .attr-title-2').addClass('d-none');
                        }
                    });
                }
            });
        });
    });

    </script>
    <!-- Check trùng mã sản phẩm -->
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
    $(document).on("input", ".attribute_price_display", function () {
    let rawNumber = $(this).val().replace(/\D/g, ""); // chỉ lấy số
    let formatted = rawNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ","); // thêm dấu ,
    $(this).val(formatted);

    // Gán vào input hidden tương ứng
    let attrId = $(this).attr("id").replace("attribute_price_display_", "");
    $("#attribute_price_" + attrId).val(rawNumber);
});
</script>
<script>
    $(document).on("input", ".product_attribute_code", function () {
    $(this).val($(this).val().toUpperCase());
});
</script>
    <script>
        $(document).ready(function () {
            // Hàm để chuyển đổi chữ có dấu thành không dấu và chữ hoa
            function removeDiacritics(str) {
                var map = {
                    'à': 'a', 'á': 'a', 'ạ': 'a', 'ả': 'a', 'ã': 'a', 'à': 'a', 'â': 'a', 'ấ': 'a', 'ầ': 'a', 'ẩ': 'a', 'ẫ': 'a', 'ă': 'a', 'ắ': 'a', 'ằ': 'a', 'ẳ': 'a', 'ẵ': 'a', 'ặ': 'a',
                    'è': 'e', 'é': 'e', 'ẹ': 'e', 'ẻ': 'e', 'ẽ': 'e', 'ê': 'e', 'ế': 'e', 'ề': 'e', 'ể': 'e', 'ễ': 'e', 'ệ': 'e',
                    'ì': 'i', 'í': 'i', 'ị': 'i', 'ỉ': 'i', 'ĩ': 'i',
                    'ò': 'o', 'ó': 'o', 'ọ': 'o', 'ỏ': 'o', 'õ': 'o', 'ô': 'o', 'ố': 'o', 'ồ': 'o', 'ổ': 'o', 'ỗ': 'o', 'ơ': 'o', 'ớ': 'o', 'ờ': 'o', 'ở': 'o', 'ỡ': 'o', 'ợ': 'o',
                    'ù': 'u', 'ú': 'u', 'ụ': 'u', 'ủ': 'u', 'ũ': 'u', 'ư': 'u', 'ứ': 'u', 'ừ': 'u', 'ử': 'u', 'ữ': 'u', 'ự': 'u',
                    'ỳ': 'y', 'ý': 'y', 'ỵ': 'y', 'ỷ': 'y', 'ỹ': 'y',
                    'đ': 'd', 'Đ': 'd'
                };
                return str.replace(/[àáạảãàâấầẩẫăắằẳẵặèéẹẻẽêếềểễệìíịỉĩòóọỏõôốồộổỗơớờợởỡúùụủũưứừửữựỳýỵỷỹđĐ]/g, function(match) { return map[match]; }).toUpperCase();
            }
    
            // Hàm cập nhật giá trị của product_code và product_price
            function updateProductDetails() {
                var productCode = '';
                var productPrice = '';
    
                // Kiểm tra nếu có phân loại, lấy giá trị của phân loại đầu tiên
                var selectedAttr = $('.input_attrs_items');
                if (selectedAttr.length > 0) {
                    // Lấy giá trị của phân loại đầu tiên
                    var firstSelectedAttr = selectedAttr.first();
                    productCode = firstSelectedAttr.find('.product_attribute_code').val();
                    productPrice = firstSelectedAttr.find('.attribute_price').val();
                }
    
                // Nếu không có phân loại, lấy giá trị bình thường từ input
                if (!productCode && !productPrice) {
                    productCode = $('#product_code_display').val(); // Lấy giá trị từ input hiển thị
                    productPrice = $('#product_price_display').val(); // Lấy giá trị từ input hiển thị
                }
    
                // Chuyển đổi productCode thành chữ hoa và không dấu
                productCode = removeDiacritics(productCode);
    
                // Cập nhật lại giá trị cho product_code và product_price (input ẩn)
                $('#product_code').val(productCode);
                $('#product_price').val(productPrice.replace(/[^0-9]/g, ''));  // Loại bỏ tất cả ký tự không phải số
    
                // Cập nhật lại giá trị cho input hiển thị
                $('#product_code_display').val(productCode);
    
                // Cập nhật lại giá trị cho product_price_display với dấu phẩy (hiển thị số)
                $('#product_price_display').val(formatNumberWithCommas(productPrice));
            }
    
            // Hàm để format giá trị với dấu phẩy
            function formatNumberWithCommas(num) {
                if (num === "") return "";
                return num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
    
            // Lắng nghe sự kiện thay đổi giá trị của product_attribute_code và attribute_price
            $(document).on('input', '.product_attribute_code, .attribute_price, .attribute_price_display', function () {
                // Nếu là trường hiển thị, đồng bộ giá trị về input ẩn
                if ($(this).hasClass('attribute_price_display')) {
                    let attrId = $(this).attr('id').replace('attribute_price_display_', '');
                    let rawNumber = $(this).val().replace(/\D/g, ''); // bỏ dấu phẩy
                    $('#attribute_price_' + attrId).val(rawNumber);
                }
                updateProductDetails();
            });
    
            // Lắng nghe sự kiện xóa phân loại
            $(document).on('click', '.remove-attr-btn', function () {
                var attrId = $(this).data('attr-id');
                $('#input-attrs-item-' + attrId).remove();
    
                // Cập nhật lại product_code và product_price sau khi xóa phân loại
                updateProductDetails();
            });
    
            // Khởi tạo cập nhật giá trị ngay khi trang tải xong
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
            const form = document.getElementById("form-add-product");

            const fields = [
                { name: "product_name", message: "Nhập tên sản phẩm" },
                { name: "product_price_display", message: "Nhập giá sản phẩm" },
                { name: "product_code_display", message: "Nhập mã sản phẩm" },
                { id: "product-image", message: "Chọn hình sản phẩm", type: "file" },
                { id: "product-image-hover", message: "Chọn hình sản phẩm", type: "file" },
                { id: "gallery-photo-add", message: "Chọn hình sản phẩm", type: "file" }
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
            var allFiles = []; // Mảng chứa tất cả các file đã chọn

            function previewImages() {
                var $preview = $('#gallery-preview');
                $preview.empty(); // Xóa nội dung hiện tại

                if (allFiles.length === 0) {
                    $preview.append('<p style="color:red">Chưa có hình ảnh nào được chọn.</p>');
                    return;
                }

                allFiles.forEach(function (file, index) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var $image = $('<img>').attr('src', e.target.result).css({
                            'width': '100px',
                            'height': '100px',
                            'margin-top': '10px',
                            'border': '1px solid #ddd',
                            'padding': '5px',
                            'margin-right': '20px',
                            'border-radius': '5px'
                        });
                        var $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>')
                            .css('position', 'absolute')
                            .css('top', '10px')
                            .css('left', '102px')
                            .css('font-size', '10px')
                            .css('height', '18px')
                            .css('width', '18px')
                            .css('padding', '0px')
                            .on('click', function () {
                                removeGalleryImage(index);
                            });

                        var $wrapper = $('<div>').css('position', 'relative').css('display', 'inline-block').css('margin', '5px');
                        $wrapper.append($image).append($deleteBtn);

                        $preview.append($wrapper);
                    };

                    reader.readAsDataURL(file);
                });
            }

            function removeGalleryImage(indexToRemove) {
                allFiles.splice(indexToRemove, 1); // Xóa file khỏi mảng
                updateInputFiles(); // Cập nhật lại input
                previewImages(); // Hiển thị lại hình
            }

            function updateInputFiles() {
                var dataTransfer = new DataTransfer();
                allFiles.forEach(function (file) {
                    dataTransfer.items.add(file);
                });
                $('#gallery-photo-add')[0].files = dataTransfer.files; // Cập nhật lại giá trị của input file
            }

            // Xử lý khi thay đổi file trong input
            $('#gallery-photo-add').on('change', function () {
                var newFiles = this.files;
                for (var i = 0; i < newFiles.length; i++) {
                    allFiles.push(newFiles[i]); // Thêm các file mới vào mảng allFiles
                }
                updateInputFiles(); // Cập nhật lại input
                previewImages(); // Hiển thị lại hình
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            function previewSingleImage(input, previewId, messageId) {
                var $preview = $('#' + previewId);
                var $message = $('#' + messageId);

                $preview.empty();

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var $image = $('<img>').attr('src', e.target.result).css({
                            'width': '100px',
                            'height': '100px',
                            'margin-top': '10px',
                            'border': '1px solid #ddd',
                            'padding': '5px',
                            'margin-right': '20px',
                            'border-radius': '5px'
                        });

                        var $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>')
                            .css('position', 'absolute')
                            .css('top', '10px')
                            .css('left', '102px')
                            .css('font-size', '10px')
                            .css('height', '18px')
                            .css('width', '18px')
                            .css('padding', '0px')
                            .on('click', function () {
                                input.value = ""; // Xóa giá trị của input file
                                $preview.empty();
                                $message.show();
                            });

                        var $wrapper = $('<div>').css({
                            'position': 'relative',
                            'display': 'inline-block'
                        });

                        $wrapper.append($image).append($deleteBtn);
                        $preview.append($wrapper);
                        $message.hide();
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $message.show();
                }
            }

            $('#product-image').on('change', function () {
                previewSingleImage(this, 'product-image-preview', 'product-image-message');
            });

            $('#product-image-hover').on('change', function () {
                previewSingleImage(this, 'product-image-hover-preview', 'product-image-hover-message');
            });
        });
    </script>
    <!-- Xu-ly-hinh-gallery -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let productAttributeCode = document.getElementById("product_attribute_code");
    
            if (productAttributeCode) {
                productAttributeCode.addEventListener("input", function () {
                    this.value = this.value.toUpperCase(); // Chuyển giá trị thành chữ in hoa
                });
            }
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
@endsection
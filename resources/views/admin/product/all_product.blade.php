@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="table-responsive" >
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    title: "Thành công!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            @endif
        });
    </script>
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH SẢN PHẨM</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    DANH SÁCH SẢN PHẨM
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
	  
	

    <div class="product-list">
      <div class="card">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-center gap-6 mb-9">
            <div>
              <button id="bulkUpdateStock" class="btn btn-info" style="margin-right: 10px">Chuyển trạng thái nhiều sản phẩm</button>
              <button id="bulkUpdateStatus" class="btn btn-danger" style="margin-right: 10px">Ẩn/Hiện nhiều sản phẩm</button>
              <button type="button" onclick="window.location.href='{{URL::to('/add-product')}}'" class="btn btn-success" title="Tiếp nhận đơn hàng">Thêm sản phẩm<i class="ti ti-circle-plus ms-1 fs-5"></i>
              </button>
            </div>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm sản phẩm">
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
          </div>
	  <!-- Thêm vào phần buttons trên đầu table -->
                                <div class="d-flex gap-2 mb-3">
                                    <!-- Nút Import -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importModal">
                                        <i class="ti ti-file-upload me-1"></i> Nhập danh sách sản phẩm
                                    </button>
                                    
                                    <!-- Nút Export -->
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exportModal">
                                        <i class="ti ti-file-download me-1"></i> Xuất danh sách sản phẩm
                                    </button>
                                </div>

                                <!-- Modal Import -->
                                <div class="modal fade" id="importModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Import giá sản phẩm</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form id="importForm" action="{{ route('import.product.prices') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Chọn file Excel</label>
                                                        <input type="file" name="price_file" class="form-control" accept=".xlsx,.xls,.csv" required>
                                                    </div>
                                                    <div class="alert alert-info">
                                                        <strong>Lưu ý:</strong>
                                                        <ul class="mb-0">
                                                            <li>File Excel phải có các cột: ID, Mã sản phẩm, Mã phân loại, Giá</li>
                                                            <li>Download file mẫu bằng nút Export</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Export -->
                                <!-- Modal Export -->
                                <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exportModalLabel">Xuất danh sách - Chọn cột</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form id="exportForm" method="GET" action="{{ route('export.product.prices') }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <p class="mb-0"><strong>Lưu ý:</strong> Vui lòng chọn ít nhất một cột để xuất</p>
                                                    </div>
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="selectAllColumns">
                                                                <label class="form-check-label fw-bold" for="selectAllColumns">
                                                                    Chọn/Bỏ chọn tất cả
                                                                </label>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="id" id="col_id" checked>
                                                                <label class="form-check-label" for="col_id">ID</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="ma_san_pham" id="col_ma_san_pham" checked>
                                                                <label class="form-check-label" for="col_ma_san_pham">Mã sản phẩm</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="ma_phan_loai" id="col_ma_phan_loai" checked>
                                                                <label class="form-check-label" for="col_ma_phan_loai">Mã phân loại</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="ten_san_pham" id="col_ten_san_pham" checked>
                                                                <label class="form-check-label" for="col_ten_san_pham">Tên sản phẩm</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="gia" id="col_gia" checked>
                                                                <label class="form-check-label" for="col_gia">Giá</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="mo_ta" id="col_mo_ta" checked>
                                                                <label class="form-check-label" for="col_mo_ta">Mô tả</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="thong_so" id="col_thong_so" checked>
                                                                <label class="form-check-label" for="col_thong_so">Thông số</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="mo_ta_gallery" id="col_mo_ta_gallery" checked>
                                                                <label class="form-check-label" for="col_mo_ta_gallery">Mô tả gallery</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input export-col" type="checkbox" name="columns[]" value="attr_id" id="col_attr_id" checked>
                                                                <label class="form-check-label" for="col_attr_id">Attr ID</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" id="confirmExportBtn">
                                                        <i class="ti ti-file-download me-1"></i> Xuất file
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
          <div class="table-responsive border rounded">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="selectAll">
                    </div>
                  </th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col">Hiển thị</th>
                  <th scope="col">Chỉnh sửa</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($all_product as $key => $pro )
                <tr>
                  <td>
                    <div class="form-check mb-0">
                      <input type="checkbox" class="form-check-input product-checkbox" id="product-checkbox-{{ $pro->product_id }}" value="{{ $pro->product_id }}">
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="public/upload/product/{{ $pro->product_image }}" class="rounded-circle" alt="matdash-img" width="56" height="56">
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-0 fs-4">{{ $pro->product_name }}</h6>
                        <p class="mb-0" style="color:red">{{ $pro->product_code }}</p>
                      </div>
                    </div>
                  </td>
<td>
  
    <button type="button"
      class="btn btn-sm bg-primary-subtle text-primary d-flex justify-content-center align-items-center edit-price-btn"
      data-product-id="{{ $pro->product_id }}" style=" padding: 6px 10px !important; font-weight: 700;">Giá</button>

<template id="popover-content-{{ $pro->product_id }}">
  <div style="min-width:260px;">
    @php
      $sortedAttrs = $pro->attributes->sortBy(function($a) {
          return preg_replace('/[^0-9.]/', '', $a->attributeValue->AttrValName ?? '');
      })->values();
      $firstAttr = $sortedAttrs->first();
      $hasAttrs = $sortedAttrs->count() > 0;
    @endphp

    <div class="mb-2">
      <label class="fw-bold d-block mb-2" style="font-size: 15px; color: #2b2b2b;">Giá sản phẩm:</label>
      <div class="d-flex align-items-center mb-2">
        <span class="fw-semibold text-center px-2 py-1 me-2 border rounded-3 bg-light">
          {{ strtoupper($firstAttr->product_attribute_code ?? $pro->product_code ?? 'SP'.$pro->product_id) }}
        </span>

        <input type="text"
               class="form-control text-end product-price-input rounded-3 {{ $hasAttrs ? 'bg-light' : '' }}"
               data-id="{{ $pro->product_id }}"
               {{ $hasAttrs ? 'readonly' : '' }}
               value="{{ number_format($firstAttr->product_price ?? $pro->product_price, 0, ',', ',') }}">
      </div>
      @if($hasAttrs)
        <small class="text-muted fst-italic ms-1">(*) Tự động cập nhật theo giá phân loại đầu tiên</small>
      @endif
    </div>

    @if($hasAttrs)
      <hr>
      <div class="fw-bold mb-2" style="font-size: 15px; color: #2b2b2b;">Giá phân loại:</div>

      @foreach($sortedAttrs as $attr)
        <div class="d-flex align-items-center mb-2">
          <span class="fw-semibold text-center px-2 py-1 me-2 border rounded-3 bg-light">
            {{ strtoupper($attr->product_attribute_code ?? 'M'.$attr->idAttrValue) }}
          </span>
          <input type="text"
                 class="form-control text-end attr-price-input rounded-3"
                 data-id="{{ $attr->idAttrValue }}"
                 value="{{ number_format($attr->product_price, 0, ',', ',') }}">
        </div>
      @endforeach
    @endif

    <button class="btn btn-success btn-sm w-100 mt-2 save-price-btn"
            data-id="{{ $pro->product_id }}" style="font-size:15px">Lưu</button>
  </div>
</template>





</td>
                  <td>
                    <p class="mb-0">
                      <button class="btn toggle-stock-btn d-flex justify-content-center align-items-center w-100 
                          {{ $pro->product_stock_status == 1 ? 'bg-success-subtle text-success' : ($pro->product_stock_status == 0 ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }}"
                          data-id="{{ $pro->product_id }}" 
                          style="margin-right: 18px; padding: 6px 10px !important; font-weight: 700;" 
                          id="toggle-stock-{{ $pro->product_id }}"> 
                          {{ $pro->product_stock_status == 1 ? 'Còn hàng' : ($pro->product_stock_status == 0 ? 'Hết hàng' : 'Sắp về hàng') }}
                      </button>
                  </p>       
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                      <a href="javascript:void(0);" class="toggle-status" data-id="{{ $pro->product_id }}" style="margin: 0 10px;">
                        <iconify-icon icon="{{ $pro->product_status == 1 ? 'iconamoon:eye' : 'iconamoon:eye-off' }}" 
                            width="35" height="35"
                            style="color: {{ $pro->product_status == 1 ? '#24b301' : '#f40000' }};">
                        </iconify-icon>
                      </a>
                    </h6>
                  </td>
                  <td>
                    <div class="d-flex gap-6">
                      <!-- Nút sửa -->
                      <a href="{{ URL::to('/edit-product/'.$pro->product_id) }}" class="dropdown-item">
                          <iconify-icon icon="iconamoon:edit" width="35" height="35" style="color: #24b301; margin-right: 10px;"></iconify-icon>
                      </a>
                  
                      <!-- Nút xóa -->
                      <a href="javascript:void(0);" class="dropdown-item delete-product" data-id="{{ $pro->product_id }}">
                          <iconify-icon icon="iconamoon:sign-times-circle" width="35" height="35" style="color: #f00"></iconify-icon>
                      </a>
                  </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-center py-1">
              <!-- Hiển thị phân trang -->
              <div class="d-flex justify-content-center mt-3">
                {{ $all_product->links() }}
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<!-- JS cập nhật trạng thái còn hàng - hết hàng -->
<script>
  function formatPrice(price) {
    if (!price) return '0';
    return Number(price).toLocaleString('vi-VN').replace(/\./g, ',');
}
$(document).on('click', '.toggle-stock-btn', function () {
    let button = $(this);
    let product_id = button.data('id');

    $.ajax({
        url: "{{ url('/product/toggle-stock') }}/" + product_id,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                let newStatus;
                let newClass;

                // Xác định trạng thái mới
                if (response.new_status == 1) {
                    newStatus = 'Còn hàng';
                    newClass = 'bg-success-subtle text-success';
                } else if (response.new_status == 0) {
                    newStatus = 'Hết hàng';
                    newClass = 'bg-danger-subtle text-danger';
                } else {
                    newStatus = 'Sắp về hàng';
                    newClass = 'bg-warning-subtle text-warning';
                }

                // Cập nhật giao diện
                button.text(newStatus);
                button.removeClass('bg-success-subtle text-success bg-danger-subtle text-danger bg-warning-subtle text-warning')
                      .addClass(newClass);

                // Hiển thị thông báo SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thành công!',
                    html: 'Sản phẩm đã được cập nhật thành <strong>' + newStatus + '</strong>',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi cập nhật trạng thái sản phẩm.',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>
<!-- JS cập nhật trạng thái còn hàng - hết hàng -->

<!-- JS cập nhật trạng thái còn hàng - hết hàng nhiều sp-->
<script>
$(document).ready(function () {
    // Chọn / bỏ chọn tất cả checkbox
    $("#selectAll").on("change", function () {
        $(".product-checkbox").prop("checked", $(this).prop("checked"));
    });

    // Cập nhật trạng thái "Chọn tất cả" khi bỏ chọn checkbox bất kỳ
    $(".product-checkbox").on("change", function () {
        $("#selectAll").prop("checked", $(".product-checkbox:checked").length === $(".product-checkbox").length);
    });

    // Xử lý cập nhật trạng thái hàng loạt
    $("#bulkUpdateStock").on("click", function () {
        let selectedIds = $(".product-checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Chưa chọn sản phẩm!",
                text: "Vui lòng chọn ít nhất một sản phẩm.",
                confirmButtonText: "OK"
            });
            return;
        }

        $.ajax({
            url: "{{ url('/product/bulk-toggle-stock') }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { product_ids: selectedIds },
            success: function (response) {
                if (response.success) {
                    response.updated_products.forEach(product => {
                        let button = $("#toggle-stock-" + product.id);
                        let newStatus, newClass;

                        // Cập nhật giao diện theo trạng thái
                        if (product.new_status == 1) {
                            newStatus = "Còn hàng";
                            newClass = "bg-success-subtle text-success";
                        } else if (product.new_status == 0) {
                            newStatus = "Hết hàng";
                            newClass = "bg-danger-subtle text-danger";
                        } else {
                            newStatus = "Sắp về hàng";
                            newClass = "bg-warning-subtle text-warning";
                        }

                        // Cập nhật nội dung và màu sắc nút
                        button.text(newStatus);
                        button.removeClass("bg-success-subtle text-success bg-danger-subtle text-danger bg-warning-subtle text-warning")
                              .addClass(newClass);
                    });

                    Swal.fire({
                        icon: "success",
                        title: "Cập nhật thành công!",
                        text: "Trạng thái sản phẩm đã được thay đổi.",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Bỏ chọn checkbox sau khi cập nhật
                    $(".product-checkbox").prop("checked", false);
                    $("#selectAll").prop("checked", false);
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra khi cập nhật trạng thái.",
                    confirmButtonText: "OK"
                });
            }
        });
    });
});


</script>
<!-- JS cập nhật trạng thái còn hàng - hết hàng nhiều sp-->

<!-- JS cập nhật trạng thái ẩn hiện -->
<script>
  $(document).on('click', '.toggle-status', function () {
    let icon = $(this).find("iconify-icon"); // Lấy icon
    let product_id = $(this).data('id');

    $.ajax({
        url: "{{ url('/product/toggle-status') }}/" + product_id,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                let newIcon = response.new_status == 1 ? 'iconamoon:eye' : 'iconamoon:eye-off';
                let newColor = response.new_status == 1 ? '#24b301' : '#f40000';

                icon.attr("icon", newIcon).css("color", newColor);

                Swal.fire({
                  icon: 'success',
                  title: 'Cập nhật thành <strong style="color:' + (response.new_status == 1 ? '#24b301' : '#ff0000') + ';">' 
                        + (response.new_status == 1 ? 'Hiện' : 'Ẩn') + 
                        '</strong>',
                  timer: 1500,
                  showConfirmButton: false
              });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi cập nhật trạng thái hiển thị.',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
<!-- JS cập nhật trạng thái ẩn hiện -->

<!-- JS cập nhật trạng thái ẩn hiện nhiều sp-->
<script>
  $(document).ready(function () {
      // Chọn / bỏ chọn tất cả checkbox
      $("#selectAll").on("change", function () {
          $(".product-checkbox").prop("checked", $(this).prop("checked"));
      });
  
      // Cập nhật "Chọn tất cả" khi bỏ chọn checkbox
      $(".product-checkbox").on("change", function () {
          $("#selectAll").prop("checked", $(".product-checkbox:checked").length === $(".product-checkbox").length);
      });
  
      // Cập nhật trạng thái ẩn/hiện hàng loạt
      $("#bulkUpdateStatus").on("click", function () {
          let selectedIds = $(".product-checkbox:checked").map(function () {
              return $(this).val(); // Lấy product_id từ checkbox
          }).get();
  
          if (selectedIds.length === 0) {
              Swal.fire({
                  icon: "warning",
                  title: "Chưa chọn sản phẩm!",
                  text: "Vui lòng chọn ít nhất một sản phẩm.",
                  confirmButtonText: "OK"
              });
              return;
          }
  
          $.ajax({
              url: "{{ url('/product/bulk-toggle-status') }}",
              type: "POST",
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
              },
              data: { product_ids: selectedIds },
              success: function (response) {
                  if (response.success) {
                      response.updated_products.forEach(product => {
                          let iconElement = $(`.toggle-status[data-id='${product.id}'] iconify-icon`);
  
                          if (product.new_status == 1) {
                              iconElement.attr("icon", "iconamoon:eye").css("color", "#24b301");
                          } else {
                              iconElement.attr("icon", "iconamoon:eye-off").css("color", "#f40000");
                          }
                      });
  
                      Swal.fire({
                          icon: "success",
                          title: "Cập nhật thành công!",
                          timer: 1500,
                          showConfirmButton: false
                      });
  
                      // Bỏ chọn checkbox sau khi cập nhật
                      $(".product-checkbox").prop("checked", false);
                      $("#selectAll").prop("checked", false);
                  }
              },
              error: function () {
                  Swal.fire({
                      icon: "error",
                      title: "Lỗi!",
                      text: "Có lỗi xảy ra khi cập nhật trạng thái.",
                      confirmButtonText: "OK"
                  });
              }
          });
      });
  });
  </script>
  
<!-- JS cập nhật trạng thái ẩn hiện nhiều sp-->

<!-- JS xoá sản phẩm -->
<script>
  $(document).on('click', '.delete-product', function () {
    let product_id = $(this).data('id'); // Lấy ID sản phẩm
    let deleteUrl = "{{ url('/delete-product') }}/" + product_id; // Tạo URL xóa

    Swal.fire({
        title: "Xác nhận xóa?",
        text: "Bạn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff0000",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa ngay!",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            // Chuyển hướng đến URL xóa
            window.location.href = deleteUrl;
        }
    });
});
</script>
<!-- JS xoá sản phẩm -->

<script>
              $(document).ready(function () {
                  let typingTimer;
                  let lastSearchKeyword = '';
                  const debounceTime = 300;
                  const $input = $("#text-srh");
                  const $form = $input.closest("form");

                  // Chặn submit form khi nhấn Enter
                  $form.on("submit", function(e) {
                      e.preventDefault();
                      return false;
                  });

                  // Gõ phím với delay
                  $input.on("keyup", function(e) {
                      clearTimeout(typingTimer);
                      const keyword = $(this).val().trim();

                      // Nếu nhấn Escape hoặc xóa hết text -> quay về danh sách đầy đủ
                      if (e.key === "Escape" || keyword === '') {
                          e.preventDefault();
                          if (lastSearchKeyword !== '') {
                              // Chỉ reload nếu trước đó có search
                              location.reload();
                          }
                          return;
                      }

                      // Tránh search lại nếu keyword không thay đổi
                      if (keyword === lastSearchKeyword) {
                          return;
                      }

                      typingTimer = setTimeout(() => {
                          searchProduct(keyword);
                          lastSearchKeyword = keyword;
                      }, debounceTime);
                  });

                  // Reset khi focus vào input
                  $input.on("focus", function() {
                      lastSearchKeyword = '';
                  });

                  function searchProduct(keyword) {
                      $.ajax({
                          url: "{{ route('product.search') }}",
                          type: "GET",
                          data: { keyword: keyword },
                          success: function (response) {
                              const tbody = $("tbody");
                              tbody.empty();

                              if (!response.products.length) {
                                  tbody.append(`
                                      <tr>
                                          <td colspan="6" class="text-center">Không tìm thấy sản phẩm</td>
                                      </tr>
                                  `);
                                  return;
                              }

                              response.products.forEach(pro => {
                                  // Stock & status
                                  const stockClass = pro.product_stock_status == 1 ? 'bg-success-subtle text-success' :
                                                    pro.product_stock_status == 0 ? 'bg-danger-subtle text-danger' :
                                                    'bg-warning-subtle text-warning';
                                  const stockText = pro.product_stock_status == 1 ? 'Còn hàng' :
                                                    pro.product_stock_status == 0 ? 'Hết hàng' : 'Sắp về hàng';
                                  const productStatus = pro.product_status == 1 ? 'iconamoon:eye' : 'iconamoon:eye-off';
                                  const productStatusColor = pro.product_status == 1 ? '#24b301' : '#f40000';

                                  // Sắp xếp attributes theo AttrValName
                                  let attrHTML = '';
                                  let firstAttr = null;
                                  if (pro.attributes && pro.attributes.length) {
                                      const sortedAttrs = pro.attributes.sort((a, b) => {
                                          const aVal = parseFloat((a.attributeValue?.AttrValName ?? '').replace(/[^\d.]/g, '')) || 0;
                                          const bVal = parseFloat((b.attributeValue?.AttrValName ?? '').replace(/[^\d.]/g, '')) || 0;
                                          return aVal - bVal;
                                      });
                                      firstAttr = sortedAttrs[0];
                                      sortedAttrs.forEach(attr => {
                                          const attrPrice = Number(attr.product_price ?? 0);
                                          attrHTML += `
                                              <div class="d-flex align-items-center mb-2">
                                                  <span class="fw-semibold text-center px-2 py-1 me-2 border rounded-3 bg-light">
                                                      ${attr.product_attribute_code?.toUpperCase() ?? 'M'+attr.idAttrValue}
                                                  </span>
                                                  <input type="text"
                                                        class="form-control text-end attr-price-input rounded-3"
                                                        data-id="${attr.idAttrValue}"
                                                        value="${formatPrice(attrPrice)}">
                                              </div>
                                          `;
                                      });
                                  }

                                  const displayPrice = Number(firstAttr?.product_price ?? pro.product_price ?? 0);

                                  // Render row
                                  const row = `
                                      <tr>
                                          <td>
                                              <div class="form-check mb-0">
                                                  <input type="checkbox" class="form-check-input product-checkbox" id="product-checkbox-${pro.product_id}" value="${pro.product_id}">
                                              </div>
                                          </td>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <img src="public/upload/product/${pro.product_image}" class="rounded-circle" alt="Product Image" width="56" height="56">
                                                  <div class="ms-3">
                                                      <h6 class="fw-semibold mb-0 fs-4">${pro.product_name}</h6>
                                                      <p class="mb-0" style="color:red">${pro.product_code}</p>
                                                  </div>
                                              </div>
                                          </td>
                                          <td>
                                              <button type="button"
                                                  class="btn btn-sm bg-primary-subtle text-primary d-flex justify-content-center align-items-center edit-price-btn"
                                                  data-product-id="${pro.product_id}" style="padding: 6px 10px !important; font-weight: 700;">Giá
                                              </button>
                                              <template id="popover-content-${pro.product_id}">
                                                  <div style="min-width:260px;">
                                                      <div class="mb-2">
                                                          <label class="fw-bold d-block mb-2" style="font-size: 15px; color: #2b2b2b;">Giá sản phẩm:</label>
                                                          <div class="d-flex align-items-center mb-2">
                                                              <span class="fw-semibold text-center px-2 py-1 me-2 border rounded-3 bg-light">
                                                                  ${firstAttr ? firstAttr.product_attribute_code.toUpperCase() : pro.product_code}
                                                              </span>
                                                              <input type="text"
                                                                    class="form-control text-end product-price-input rounded-3 ${firstAttr ? 'bg-light' : ''}"
                                                                    data-id="${pro.product_id}"
                                                                    ${firstAttr ? 'readonly' : ''}
                                                                    value="${formatPrice(displayPrice)}">
                                                          </div>
                                                          ${firstAttr ? '<small class="text-muted fst-italic ms-1">(*) Tự động cập nhật theo giá phân loại đầu tiên</small>' : ''}
                                                      </div>
                                                      ${attrHTML ? '<hr><div class="fw-bold mb-2" style="font-size: 15px; color: #2b2b2b;">Giá phân loại:</div>' + attrHTML : ''}
                                                      <button class="btn btn-success btn-sm w-100 mt-2 save-price-btn" data-id="${pro.product_id}" style="font-size:15px">Lưu</button>
                                                  </div>
                                              </template>
                                          </td>
                                          <td>
                                              <p class="mb-0">
                                                  <button class="btn toggle-stock-btn d-flex justify-content-center align-items-center w-100 ${stockClass}"
                                                          data-id="${pro.product_id}" style="margin-right: 18px; padding: 6px 10px !important; font-weight: 700;" 
                                                          id="toggle-stock-${pro.product_id}">${stockText}</button>
                                              </p>
                                          </td>
                                          <td>
                                              <h6 class="mb-0 fs-4">
                                                  <a href="javascript:void(0);" class="toggle-status" data-id="${pro.product_id}" style="margin: 0 10px;">
                                                      <iconify-icon icon="${productStatus}" width="35" height="35" style="color: ${productStatusColor};"></iconify-icon>
                                                  </a>
                                              </h6>
                                          </td>
                                          <td>
                                              <div class="d-flex gap-6">
                                                  <a href="{{ URL::to('/edit-product') }}/${pro.product_id}" class="dropdown-item">
                                                      <iconify-icon icon="iconamoon:edit" width="35" height="35" 
                                                          style="color: #24b301; margin-right: 10px;"></iconify-icon>
                                                  </a>
                                                  <a href="javascript:void(0);" class="dropdown-item delete-product" 
                                                      data-id="${pro.product_id}">
                                                      <iconify-icon icon="iconamoon:sign-times-circle" width="35" height="35" 
                                                          style="color: #f00;"></iconify-icon>
                                                  </a>
                                              </div>
                                          </td>
                                      </tr>
                                  `;
                                  tbody.append(row);
                              });

                              // Khởi tạo popover cho nút Giá SP
                              $('.edit-price-btn').popover({
                                  html: true,
                                  trigger: 'click',
                                  content: function() {
                                      const productId = $(this).data('product-id');
                                      return $(`#popover-content-${productId}`).html();
                                  },
                                  placement: 'bottom'
                              });
                          },
                          error: function () {
                              console.error("Lỗi khi gửi yêu cầu AJAX.");
                          }
                      });
                  }
              });
              </script>



<script>
document.addEventListener("DOMContentLoaded", function () {
  let activePopover = null;

  document.body.addEventListener("click", async function (e) {
    // Khi click nút "Giá"
    if (e.target.closest(".edit-price-btn")) {
      const btn = e.target.closest(".edit-price-btn");
      const productId = btn.dataset.productId;
      const template = document.querySelector(`#popover-content-${productId}`);

      if (activePopover) {
        activePopover.dispose();
        activePopover = null;
      }

      activePopover = new bootstrap.Popover(btn, {
        html: true,
        sanitize: false,
        placement: "right",
        trigger: "manual",
        title: "Chỉnh sửa nhanh giá sản phẩm",
        content: template.innerHTML
      });
      activePopover.show();

      // Style + format giá
      setTimeout(() => {
        const popoverEl = document.querySelector('.popover.show');
        if (!popoverEl) return;

        popoverEl.style.minWidth = "400px";
        const codeBoxes = popoverEl.querySelectorAll('.fw-semibold.text-center');
        let maxWidth = 0;
        codeBoxes.forEach(el => {
          el.style.whiteSpace = "nowrap";
          el.style.display = "inline-block";
          el.style.textAlign = "center";
          el.style.color = "red";
          el.style.fontSize = "15px";
          el.style.fontWeight = "700";
          if (el.offsetWidth > maxWidth) maxWidth = el.offsetWidth;
        });
        codeBoxes.forEach(el => (el.style.minWidth = maxWidth + "px"));

        const priceInputs = popoverEl.querySelectorAll('.product-price-input, .attr-price-input');
        priceInputs.forEach(input => {
  input.addEventListener("input", function () {
    let val = this.value.replace(/[^0-9]/g, "");
    this.value = val ? val.replace(/\B(?=(\d{3})+(?!\d))/g, ",") : "";

    // ✅ Nếu input là phân loại đầu tiên → cập nhật giá sản phẩm luôn
    if (this.classList.contains("attr-price-input")) {
      const allAttrs = popoverEl.querySelectorAll(".attr-price-input");
      const firstAttr = allAttrs[0];
      if (firstAttr === this) {
        const productPriceInput = popoverEl.querySelector(".product-price-input");
        if (productPriceInput) productPriceInput.value = this.value;
      }
    }
  });
});
      }, 100);
      e.stopPropagation();
    }

    // Khi click nút "Lưu"
    else if (e.target.classList.contains("save-price-btn")) {
  const popoverEl = e.target.closest(".popover");
  const productId = e.target.dataset.id;
  const attrInputs = [...popoverEl.querySelectorAll(".attr-price-input")];
  const hasAttrs = attrInputs.length > 0;

  let price;
  if (hasAttrs) {
    // ✅ Nếu có phân loại → dùng giá của phân loại đầu tiên
    const firstAttrVal = attrInputs[0].value.replace(/[^0-9]/g, "") || 0;
    price = firstAttrVal;
  } else {
    // ✅ Nếu không có phân loại → lấy giá từ input chính
    price = popoverEl.querySelector(".product-price-input")?.value.replace(/[^0-9]/g, "") || 0;
  }

  const attrs = attrInputs.map(inp => ({
    idAttrValue: inp.dataset.id,
    price: inp.value.replace(/[^0-9]/g, "")
  }));

  try {
    const res = await fetch(`{{ url('/product/update-price') }}/${productId}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ price, attributes: attrs })
    });

    const data = await res.json();

    if (activePopover) {
      activePopover.dispose();
      activePopover = null;
    }

    Swal.fire({
      title: "Thành công!",
      text: "Cập nhật giá thành công!",
      icon: "success",
      confirmButtonText: "OK"
    }).then(() => location.reload());

  } catch (err) {
    console.error(err);
    Swal.fire({
      title: "Lỗi!",
      text: "Có lỗi xảy ra khi cập nhật giá!",
      icon: "error",
      confirmButtonText: "Thử lại"
    });
  }
}
  });

  // Ẩn popover khi click ra ngoài
  document.addEventListener("click", function (e) {
    if (activePopover && !e.target.closest(".popover") && !e.target.closest(".edit-price-btn")) {
      activePopover.dispose();
      activePopover = null;
    }
  });
});

// ✅ Auto select khi focus
document.addEventListener("focusin", function (e) {
  if (e.target.classList.contains("product-price-input") || e.target.classList.contains("attr-price-input")) {
    e.target.select();
  }
});
</script>

  <script>
                $(document).ready(function() {
                    // Xử lý Export Modal
                    var $exportForm = $('#exportForm');
                    var $exportModal = $('#exportModal');
                    var $confirmExportBtn = $('#confirmExportBtn');
                    var $selectAllColumns = $('#selectAllColumns');
                    var $exportCols = $('.export-col');

                    // Xử lý checkbox chọn tất cả
                    $selectAllColumns.on('change', function() {
                        $exportCols.prop('checked', $(this).prop('checked'));
                    });

                    // Cập nhật trạng thái "Chọn tất cả" khi thay đổi các checkbox khác
                    $exportCols.on('change', function() {
                        $selectAllColumns.prop('checked', $exportCols.length === $exportCols.filter(':checked').length);
                    });

                    $exportForm.on('submit', function(e) {
                        e.preventDefault();
                        
                        // Kiểm tra chọn ít nhất 1 cột
                        var selectedColumns = $('.export-col:checked').length;
                        if (selectedColumns === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Lỗi!',
                                text: 'Vui lòng chọn ít nhất một cột để xuất',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        
                        // Hiển thị loading
                        Swal.fire({
                            title: 'Đang xuất file...',
                            text: 'Vui lòng chờ trong giây lát',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Thu thập dữ liệu từ form
                        var formData = $exportForm.serializeArray();
                        var columns = formData.filter(item => item.name === 'columns[]').map(item => item.value);
                        
                        // Tạo form ẩn để submit
                        var form = document.createElement('form');
                        form.method = 'GET';
                        form.action = '{{ route("export.product.prices") }}';

                        // Thêm các columns đã chọn vào form
                        columns.forEach(function(col) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'columns[]';
                            input.value = col;
                            form.appendChild(input);
                        });
                        
                        document.body.appendChild(form);
                        form.submit();
                        
                        // Ẩn modal và loading sau 2 giây
                        $exportModal.modal('hide');
                        setTimeout(() => {
                            Swal.close();
                        }, 2000);
                    });

                    // Xử lý Import 
                    $('#importForm').on('submit', function(e) {
                        e.preventDefault();
                        
                        Swal.fire({
                            title: 'Đang xử lý...',
                            text: 'Vui lòng chờ trong giây lát',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        var formData = new FormData(this);
                        
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#importModal').modal('hide');
                                
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Import thành công!',
                                        text: response.message,
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if(result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                let errorMessage = 'Có lỗi xảy ra';
                                if(xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi Import!',
                                    text: errorMessage,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Đóng'
                                });
                            }
                        });
                    });
                });
            </script>




@endsection

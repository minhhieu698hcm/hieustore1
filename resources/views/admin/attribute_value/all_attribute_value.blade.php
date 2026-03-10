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
          <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH PHÂN LOẠI</h4>
          <nav aria-label="breadcrumb" class="ms-auto">
            <ol class="breadcrumb">
              <li class="breadcrumb-item d-flex align-items-center">
                <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                  <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                </a>
              </li>
              <li class="breadcrumb-item" aria-current="page">
                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                  DANH SÁCH PHÂN LOẠI
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
            <button onclick="window.location.href='{{URL::to('/add-attr-value')}}'" class="btn btn-primary" style="margin-right: 10px">Thêm Phân Loại</button>
          </div>
          <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm phân loại">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form>

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
                <th scope="col">Mã phân loại</th>
                <th scope="col">Nhóm phân loại</th>
                <th scope="col">Tên phân loại</th>
                <th scope="col">Chỉnh sửa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list_attr_value as $key => $attr_value)
              <tr>
                <td>
                  <div class="form-check mb-0">
                    <input type="checkbox" class="form-check-input attribute-checkbox" id="attribute-value-checkbox-{{ $attr_value->idAttrValue }}" value="{{ $attr_value->idAttrValue }}">
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$attr_value->idAttrValue}}
                  </div>
                </td>
                <td>
                  <h6 class="mb-0 fs-4">
                    {{$attr_value->AttributeName}}
                  </h6>
                </td>
                <td>
                  <h6 class="mb-0 fs-4">
                    {{$attr_value->AttrValName}}
                  </h6>
                </td>
                <td>
                  <div class="d-flex gap-6">
                    <!-- Nút sửa -->
                    <a href="{{URL::to('/edit-attr-value/'.$attr_value->idAttrValue)}}" class="dropdown-item">
                        <iconify-icon icon="iconamoon:edit" width="35" height="35" style="color: #24b301; margin-right: 10px;"></iconify-icon>
                    </a>
                
                    <!-- Nút xóa -->
                    <a href="javascript:void(0);" class="dropdown-item delete-attribute" data-id="{{ $attr_value->idAttrValue }}">
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
              {{  $list_attr_value->links() }}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>


    <!-- JS xoá sản phẩm -->
<script>
  $(document).on('click', '.delete-attribute', function () {
    let idAttrValue = $(this).data('id'); // Lấy ID sản phẩm
    let deleteUrl = "{{ url('/delete-attr-value/') }}/" + $attr_value->idAttrValue; // Tạo URL xóa

    Swal.fire({
        title: "Xác nhận xóa?",
        text: "Bạn muốn xóa nhóm phân loại này? Hành động này không thể hoàn tác!",
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
@endsection
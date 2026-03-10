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
            <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH MÃ KHUYẾN MÃI</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    DANH SÁCH MÃ KHUYẾN MÃI
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
                <h4 class="row" style="margin-left: 0.5em">Danh Sách Mã Giảm Giá ( Tổng: {{$count_voucher}} )</h4>
            </div>
            <button onclick="window.location.href='{{URL::to('/add-voucher')}}'" class="btn btn-primary" style="margin-right: 10px">Thêm Mã Khuyến Mãi</button>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm mã khuyến mãi">
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
                  <th scope="col">Tên mã giảm giá</th>
                  <th scope="col">Phần trăm/Số tiền</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Bắt đầu - Kết thúc</th>
                  <th scope="col">Chỉnh sửa</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list_voucher as $key => $voucher)
                <tr>
                  <td>
                    <div class="form-check mb-0">
                      <input type="checkbox" class="form-check-input attribute-checkbox" id="voucher-checkbox-{{ $voucher->idVoucher }}" value="{{ $voucher->idVoucher }}">
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                          <h6 class="fw-semibold mb-0 fs-4">{{ $voucher->VoucherName }}</h6>
                          <p class="mb-0" style="color:red; font-weight: 700;">{{ $voucher->VoucherCode }}</p>
                        </div>
                      </div>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                        @if($voucher->VoucherCondition == 1 ) {{$voucher->VoucherNumber}}%
                        @else {{number_format($voucher->VoucherNumber,0,',','.')}}đ@endif
                    </h6>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                        {{$voucher->VoucherQuantity}}
                    </h6>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                        {{ \Carbon\Carbon::parse($voucher->VoucherStart)->format('d/m/y') }} - {{ \Carbon\Carbon::parse($voucher->VoucherEnd)->format('d/m/y') }}
                    </h6>
                  </td>
                  <td>
                    <div class="d-flex gap-6">
                      <!-- Nút sửa -->
                      <a href="{{URL::to('/edit-voucher/'.$voucher->idVoucher)}}" class="dropdown-item">
                          <iconify-icon icon="iconamoon:edit" width="35" height="35" style="color: #24b301; margin-right: 10px;"></iconify-icon>
                      </a>
                  
                      <!-- Nút xóa -->
                      <a href="javascript:void(0);" class="dropdown-item delete-voucher" data-id="{{ $voucher->idVoucher }}">
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
                {{  $list_voucher->links() }}
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
    $(document).on('click', '.delete-voucher', function () {
      let idVoucher = $(this).data('id'); // Lấy ID sản phẩm
      let deleteUrl = "{{ url('/delete-voucher/') }}/" + idVoucher; // Tạo URL xóa
  
      Swal.fire({
          title: "Xác nhận xóa?",
          text: "Bạn muốn xóa voucher này? Hành động này không thể hoàn tác!",
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

<!-- Page end  -->
@endsection
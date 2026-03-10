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
            <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH ĐƠN HÀNG CHƯA THANH TOÁN</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    DANH SÁCH ĐƠN HÀNG CHƯA THANH TOÁN
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
            <h4 class="row" style="margin-left: 0.5em;color: red;">Danh Sách Đơn hàng ( Tổng: {{$list_bill->count()}} )</h4>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm đơn hàng">
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
  
          </div>
          <div class="table-responsive border rounded">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">Mã ĐH</th>
				  <th scope="col">Email</th>
                  <th scope="col">Ngày Đặt Hàng</th>
                  <th scope="col">Điện thoại</th>
                  <th scope="col">Trạng Thái</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list_bill as $key => $bill)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <strong style="color:red">{{$bill->order_number}}</strong>
                    </div>
                  </td>
                  <td>
                  <h6 class="mb-0 fs-4">
                    {{ $bill->customer_email}}
                  </h6>
                </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                      {{$bill->created_at->format('d/m/Y')}}
                    </h6>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                      {{$bill->customer_phone}}
                    </h6>
                  </td>
                  <td>
                    @php
                    $statusMap = [
                        'waiting'   => ['text' => 'Chưa thanh toán', 'class' => 'mb-1 badge text-bg-primary'],
                        'pending'   => ['text' => 'Chờ xác nhận', 'class' => 'mb-1 badge text-bg-warning'],
                        'confirmed' => ['text' => 'Đã xác nhận', 'class' => 'mb-1 badge text-bg-success'],
                        'shipped'   => ['text' => 'Đang vận chuyển', 'class' => 'mb-1 badge text-bg-info'],
                        'delivered' => ['text' => 'Đã giao hàng', 'class' => 'mb-1 badge text-bg-danger'],
                    ];
                
                    $status = $bill->status ?? '';
                    $statusText = $statusMap[$status]['text'] ?? 'Chưa xác định';
                    $statusClass = $statusMap[$status]['class'] ?? 'mb-1 badge text-bg-light';
                    @endphp
                    <h6 class="{{ $statusClass }}">
                        {{ $statusText }}
                    </h6>
                </td>
                  <td>
                    <div class="d-flex gap-6">
                      <div class="d-flex align-items-center list-action">
                        <!-- Nút Xem Chi Tiết (Luôn hiển thị) -->
            <button type="button" onclick="window.location.href='{{ URL::to('/bill-info/' . $bill->order_number) }}'" class="btn mb-1 btn-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center" title="Xem chi tiết" style="margin-right: 5px">
              <iconify-icon icon="solar:eye-broken" width="30" height="30"  style="color: #fff"></iconify-icon>
            </button>
            <!-- Hiển thị nút dựa trên trạng thái đơn hàng -->
            @if ($bill->status == 'waiting')
                <!-- Nút Xác Nhận Đơn Hàng -->
                <button type="button" onclick="window.location.href='{{ route('order.updateStatus', ['order_number' => $bill->order_number, 'status' => 'pending']) }}'" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center" title="Tiếp nhận đơn hàng" style="margin-right: 5px">
                  <iconify-icon icon="solar:phone-calling-rounded-linear" width="30" height="30"  style="color: #fff"></iconify-icon>
              </button>
            @elseif ($bill->status == 'pending')
                <!-- Nút Xác Nhận Đơn Hàng -->
                <button type="button" onclick="window.location.href='{{ route('order.updateStatus', ['order_number' => $bill->order_number, 'status' => 'confirmed']) }}'" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center" title="Xác nhận đơn hàng" style="margin-right: 5px">
                  <iconify-icon icon="solar:check-circle-broken" width="30" height="30"  style="color: #fff"></iconify-icon>
              </button>
            @elseif ($bill->status == 'confirmed')
                <!-- Nút Chuyển Sang Đang Giao -->
                <button type="button" onclick="window.location.href='{{ route('order.updateStatus', ['order_number' => $bill->order_number, 'status' => 'shipped']) }}'" class="btn mb-1 btn-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center" title="Chuyển sang vận chuyển" style="margin-right: 5px">
                  <iconify-icon icon="fluent:vehicle-truck-cube-20-regular" width="30" height="30"  style="color: #fff"></iconify-icon>
              </button>
            @elseif ($bill->status == 'shipped')
                <!-- Nút Đánh Dấu Đã Giao -->
                <button type="button" onclick="window.location.href='{{ route('order.updateStatus', ['order_number' => $bill->order_number, 'status' => 'delivered']) }}'" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center" title="Hoàn thành đơn hàng" style="margin-right: 5px">
                  <iconify-icon icon="solar:dollar-broken" width="30" height="30"  style="color: #fff"></iconify-icon>
              </button>
            @endif
            @if (Auth::check() && in_array(Auth::user()->position, ['admin', 'dev']) && $bill->status != 'delivered')
            <!-- Nút xóa đơn hàng (chỉ hiển thị nếu là admin) -->
            <button type="button" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center delete-bill" data-id="{{$bill->order_number}}" title="Xóa đơn hàng">
              <iconify-icon icon="solar:bill-cross-broken" width="30" height="30"  style="color: #fff"></iconify-icon>
          </button>
            @endif
                      </div>
                  </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-center py-1">
              <!-- Hiển thị phân trang -->
              <div class="d-flex justify-content-center mt-3">
                {{  $list_bill->links() }}
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
    $(document).on('click', '.delete-bill', function () {
      let idbill = $(this).data('id'); // Lấy ID đơn hàng
  
      let deleteUrl = "{{ route('order.delete', ':order_number') }}".replace(':order_number', idbill);
  
      Swal.fire({
          title: "Xác nhận xóa?",
          text: "Bạn muốn xóa đơn hàng này? Hành động này không thể hoàn tác!",
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
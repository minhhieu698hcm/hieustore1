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
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          @if(session('error'))
              Swal.fire({
                  title: "Xóa nhân viên thất bại",
                  text: "{{ session('error') }}",
                  icon: "error",
                  confirmButtonText: "Thử lại"
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
            <h4 class="mb-4 mb-sm-0 card-title">Danh Sách Nhân Viên</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Danh Sách Nhân Viên
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
            <h4 class="row" style="margin-left: 0.5em">Danh Sách Nhân Viên ( Tổng: {{$count_staff}} )</h4>
            <div>
              <button onclick="window.location.href='{{URL::to('/add-staffs')}}'" class="btn btn-primary" style="margin-right: 10px">Thêm nhân viên mới</button>
            </div>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm nhân viên">
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
  
          </div>
          <div class="table-responsive border rounded">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">Tên Tài Khoản</th>
                  <th scope="col">Họ và Tên</th>
                  <th scope="col">Chức Vụ</th>
                  <th scope="col">Chỉnh sửa</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list_staff as $key => $staff)
                <tr>
                  <td>
                    <div class="d-flex align-items-center ">
                      <img src="{{ $staff->admin_avt ? asset('public/backend/images/profile/' . $staff->admin_avt) : asset('public/backend/images/profile/avt_default.webp') }}" class="img-fluid rounded-circle avatar-preview" alt="matdash-img" width="60" height="60" style="border: 2px solid #ddd;">
                      
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-0 fs-4">{{$staff->admin_email}}</h6>
                        <p class="mb-0" style="color:red"> {{$staff->admin_name}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                        {{$staff->admin_name}}
                    </h6>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">
                        @if ($staff->position)
                            @switch($staff->position)
                                @case('dev')
                                    <span class="mb-1 badge rounded-pill text-bg-danger d-inline-flex align-items-center">
                                        Lập trình viên &nbsp;
                                        <iconify-icon icon="solar:crown-star-broken" width="24" height="24"></iconify-icon>
                                    </span>
                                    @break
                
                                @case('admin')
                                    <span class="mb-1 badge rounded-pill text-bg-warning d-inline-flex align-items-center">
                                        Quản trị viên &nbsp;
                                        <iconify-icon icon="solar:laptop-minimalistic-broken" width="24" height="24"></iconify-icon>
                                    </span>
                                    @break
                
                                @case('sale')
                                    <span class="mb-1 badge rounded-pill text-bg-success d-inline-flex align-items-center">
                                        Kinh doanh &nbsp;
                                        <iconify-icon icon="solar:sale-broken" width="24" height="24"></iconify-icon>
                                    </span>
                                    @break
                
                                @default
                                    <span class="mb-1 badge rounded-pill text-bg-secondary">Không rõ</span>
                            @endswitch
                        @endif
                    </h6>
                </td>
                  <td>
                    <div class="d-flex gap-6">
                    
                      <!-- Nút xóa -->
                      <a href="javascript:void(0);" class="dropdown-item delete-staff" data-id="{{ $staff->admin_id }}">
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
                {{ $list_staff->links() }}
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
    $(document).on('click', '.delete-staff', function () {
      let idadmin = $(this).data('id'); // Lấy ID sản phẩm
      let deleteUrl = "{{ url('/delete-staff/') }}/" + idadmin; // Tạo URL xóa
  
      Swal.fire({
          title: "Xác nhận xóa?",
          text: "Bạn muốn xóa staff này? Hành động này không thể hoàn tác!",
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

                            </table>
                        </div>
                    </div>
                </div>
    </div>
@endsection
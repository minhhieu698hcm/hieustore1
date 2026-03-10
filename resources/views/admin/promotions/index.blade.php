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
            <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH QUÀ KHUYẾN MÃI</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    DANH SÁCH QUÀ KHUYẾN MÃI
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
            <button onclick="window.location.href='{{URL::to('/add-promotion')}}'" class="btn btn-primary" style="margin-right: 10px">Thêm Mã Khuyến Mãi</button>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm mã khuyến mãi">
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
  
          </div>
          <div class="table-responsive border rounded">
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Loại KM</th>
                <th>Sản phẩm chính</th>
                <th>Sản phẩm tặng/mua kèm</th>
                <th>Giá trị tối thiểu</th>
                <th>Giá mua kèm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->title }}</td>
                <td>
                    @if($promotion->promotion_type == 'gift')
                        <span class="badge bg-success">Tặng</span>
                    @elseif($promotion->promotion_type == 'combo')
                        <span class="badge bg-info">Mua kèm</span>
                    @endif
                </td>
                <td>
                    @if($promotion->product)
                        {{ $promotion->product->product_name }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($promotion->giftProduct)
                        {{ $promotion->giftProduct->product_name }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ number_format($promotion->min_total_for_gift, 0, ',', '.') }}</td>
                <td>
                    @if($promotion->promotion_type == 'combo')
                        {{ number_format($promotion->combo_price, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $promotion->start_date }}</td>
                <td>{{ $promotion->end_date }}</td>
                <td>{{ $promotion->is_active ? 'Hiện' : 'Ẩn' }}</td>
                <td>
                    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-primary btn-sm mb-3">Sửa</a>
                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa khuyến mãi này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
   
            <div class="d-flex align-items-center justify-content-center py-1">
              <!-- Hiển thị phân trang -->
              <div class="d-flex justify-content-center mt-3">
                 {{ $promotions->links() }}
              </div>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
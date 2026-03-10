@extends('admin_layout')
@section('admin_content')
  <div class="body-wrapper">
    <div class="container-fluid">
    <div class="col-12">
      <div class="card">
      <div class="card-body p-4 pb-0" data-simplebar="">
        <div class="row">
        <div class="col">
          <div class="card primary-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="solar:bag-5-outline" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Tổng đơn hàng</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($totalOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/all-bill')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem thêm</a>
          </div>
          </div>
        </div>
        <div class="col">
          <div class="card danger-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="solar:clock-circle-broken" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Đơn chờ xác nhận</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($pendingOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/bill-pending')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem thêm</a>
          </div>
          </div>
        </div>
        <div class="col">
          <div class="card success-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="solar:bill-check-broken" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Đơn đã xác nhận</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($confirmedOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/bill-confirmed')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem
            thêm</a>
          </div>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col">
          <div class="card secondary-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="fluent:vehicle-truck-cube-20-regular" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Đơn đang vận chuyển</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($shippedOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/bill-shipped')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem thêm</a>
          </div>
          </div>
        </div>
        <div class="col">
          <div class="card warning-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="solar:dollar-broken" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Đơn đã giao</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($deliveredOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/bill-delivered')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem
            thêm</a>
          </div>
          </div>
        </div>
        <div class="col">
          <div class="card warning-gradient">
          <div class="card-body text-center px-9 pb-4">
            <div
            class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
            <iconify-icon icon="solar:phone-calling-rounded-linear" class="fs-7 text-white"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1"><strong>Đơn chưa thanh toán</strong></h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" style="color:red">
            {{ number_format($waitingOrders, 0, ',', '.') }}
            </h4>
            <a href="{{URL::to('/bill-waiting')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">Xem thêm</a>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
      
      <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-body p-4">
        <div class="d-flex align-items-center gap-6 mb-4">
          <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
            <iconify-icon icon="solar:dollar-broken" class="fs-7 text-danger"></iconify-icon>
          </span>
          <h6 class="mb-0 fs-4 fw-medium"><strong style="font-size:20px;">Doanh số tổng thể: </strong></h6>
        </div>
        <div class="row">
          <div class="col-12">
          <h4 class="fs-7"><strong style="color:red">{{ number_format($totalRevenue, 0, ',', '.') }} </strong>VNĐ
          </h4>
          </div>
        </div>
        </div>
      </div>
      </div>

      <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-body p-4">
        <div class="d-flex align-items-center gap-6 mb-4">
          <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
            <iconify-icon icon="solar:dollar-broken" class="fs-7 text-danger"></iconify-icon>
          </span>
          <h6 class="mb-0 fs-4 fw-medium"><strong style="font-size:20px;">Doanh số năm {{ $currentYear }}:</strong>
          </h6>
        </div>
        <div class="row">
          <div class="col-12">
          <h4 class="fs-7"><strong style="color:red">{{ number_format($yearlyRevenue, 0, ',', '.') }} </strong>VNĐ
          </h4>
          </div>
        </div>
        </div>
      </div>
      </div>

      <div class="col-md-4 col-lg-4">
      <div class="card">
        <div class="card-body p-4">
        <div class="d-flex align-items-center gap-6 mb-4">
          <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
            <iconify-icon icon="solar:dollar-broken" class="fs-7 text-danger"></iconify-icon>
          </span>
          <h6 class="mb-0 fs-4 fw-medium"><strong style="font-size:20px;">Doanh số {{ $monthName }}: </strong></h6>
        </div>
        <div class="row">
          <div class="col-12">
          <h4 class="fs-7"><strong style="color:red">{{ number_format($monthlyRevenue, 0, ',', '.') }} </strong>VNĐ</h4>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  </div>
  </div>
@endsection
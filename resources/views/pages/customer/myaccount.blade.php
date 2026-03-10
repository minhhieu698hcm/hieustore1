@extends('account_layout')
@section('account-content')
<style>
.member-card {
  display: flex;
  align-items: center;
  background: #fff8f2;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  gap: 16px;
  max-width: 500px;
}

.progress-circle {
  --size: 120px;
  --thickness: 15px;
  width: 160px;
  height: var(--size);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 20px;
  color: #333;
  position: relative;
}

/* tạo viền trong */
.progress-circle::before {
  content: '';
  position: absolute;
  inset: calc(var(--thickness) / 2);
  border-radius: 50%;
  background: #fff;
  z-index: 0;
}

.progress-circle > span {
  position: relative;
  z-index: 1;
  font-weight: 600;
  color: #333;
}

/* hiển thị % động từ data-progress */
.progress-circle[data-progress] {
  --percent: attr(data-progress number);
}

/* thông tin hạng */
.member-info h6 {
  margin: 0;
  font-size: 1rem;
  font-weight: 600;
  color: #333;
}

.badge-rank {
  display: inline-block;
  font-size: 0.85rem;
  font-weight: 500;
  color: #fff;
  padding: 6px 12px;
  border-radius: 20px;
}

.next-rank {
  font-size: 0.85rem;
  color: #444;
}

.text-highlight {
  color: #2575fc;
  font-weight: 600;
}

.icon-circle {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-circle.bg-primary {
  background-color: #6a11cb !important; /* màu nổi bật cho icon đơn hàng */
}

.icon-circle.bg-danger {
  background-color: #ff4d4f !important; /* màu nổi bật cho icon tiền */
}

.card-body .h2 {
  font-size: 1.8rem;
  font-weight: 700;
}

.card-body .text-muted {
  font-size: 0.875rem;
}
@media (max-width: 767px) {

    /* Khối chứa ảnh */
    .col-sm-4.col-md-3 > a {
        min-height: 120px !important;
        padding: 12px;
        border-radius: 10px;
    }

    /* Logo */
    .col-sm-4.col-md-3 img {
        max-width: 50%!important;
        max-height: 90px!important;
        object-fit: contain;
        padding: 0 !important;
    }
}
/* ===============================
   ORDER CARD – GAMING DARK
================================ */

.order-card .card-body {
    background: linear-gradient(180deg, #1e1e1e, #141414);
    border-radius: 8px;
    color: #e6e6e6;
}

/* ===== Thông tin bên trái ===== */
.order-card .h5,
.order-card .h6 {
    color: #f1f1f1;
    letter-spacing: .3px;
    border-bottom: 1px solid rgba(255,255,255,.15) !important;
    padding-bottom: 6px;
}

.order-card .h5 strong,
.order-card .h6 strong {
    color: #ff2e2e;
    text-shadow: 0 0 8px rgba(255,46,46,.55);
}

/* Địa chỉ */
.order-card .fs-sm strong {
    color: #ff6a6a;
    font-weight: 600;
}

/* ===== Cột phải ===== */
.order-card .text-end .fs-xs strong {
    color: #d6d6d6;
}

/* ===== Badge trạng thái ===== */
.order-card .badge {
    background: linear-gradient(135deg, #ff9f1a, #ff6a00);
    box-shadow: 0 0 14px rgba(255,159,26,.55);
    border-radius: 999px;
    font-weight: 600;
}


/* ===============================
   ICON BUTTON – CÓ VIỀN GAMING
================================ */

.order-card .btn-outline-secondary {
    background: transparent !important;

    border: 1.5px solid rgba(255, 46, 46, 0.55) !important;
    border-radius: 8px;

    padding: 6px 8px;
    min-width: auto;
    min-height: auto;

    color: #ff3b3b !important;
    opacity: 1 !important;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        transform .15s ease;
}

/* Icon */
.order-card .btn-outline-secondary i,
.order-card .btn-outline-secondary i::before {
    color: #ff3b3b !important;
    opacity: 1 !important;

    text-shadow:
        0 0 8px rgba(255,59,59,.75),
        0 0 18px rgba(255,46,46,.6);
}

/* Hover PC */
@media (hover: hover) {
    .order-card .btn-outline-secondary:hover {
        border-color: #ff6a6a !important;
        box-shadow:
            0 0 0 1px rgba(255, 46, 46, 0.45),
            0 0 14px rgba(255, 46, 46, 0.55);
        transform: scale(1.08);
    }

    .order-card .btn-outline-secondary:hover i,
    .order-card .btn-outline-secondary:hover i::before {
        color: #ff6a6a !important;
    }
}

/* Mobile touch */
.order-card .btn-outline-secondary:active {
    border-color: #ff9a9a !important;
    box-shadow:
        0 0 10px rgba(255, 90, 90, 0.7);
    transform: scale(.94);
}

/* Tooltip không làm chìm */
.order-card .tooltip-btn,
.order-card .tooltip-btn * {
    opacity: 1 !important;
}

/* ===============================
   MOBILE
================================ */

@media (max-width: 767px) {

    .order-card .card-body {
        flex-direction: column;
        gap: 14px;
    }

    .order-card .text-end {
        text-align: left !important;
    }

    .order-card .d-flex.justify-content-end {
        justify-content: flex-start !important;
    }
}
/* ===============================
   MOBILE: 1 DÒNG – NGÀY + STATUS + ACTION
================================ */
@media (max-width: 767px) {

    /* Cột phải */
    .order-card .text-end {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;

        text-align: left !important;
        flex-wrap: nowrap;
    }

    /* Ngày mua */
    .order-card .text-end .fs-xs {
        margin: 0 !important;
        white-space: nowrap;
        font-size: 13px;
    }

    /* Badge trạng thái */
    .order-card .text-end .badge {
        margin: 0 !important;
        font-size: 12px;
        padding: 4px 10px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* Wrapper nút */
    .order-card .text-end .d-flex {
        margin: 0 !important;
        gap: 6px;
        flex-shrink: 0;
    }

    /* Nút icon nhỏ gọn cho mobile */
    .order-card .btn-outline-secondary {
        padding: 5px 6px;
        border-radius: 6px;
    }

    .order-card .btn-outline-secondary i {
        font-size: 16px;
    }

    /* Ẩn tooltip text mobile (tránh vỡ layout) */
    .order-card .tooltip-text {
        display: none !important;
    }
}


</style>
          <!-- Account profile content -->
          <div class="col-lg-9">
            <h1 class="h2 pb-2 pb-lg-3">Thông tin cá nhân</h1>

            <!-- Wallet + Account progress -->
            <section class="row g-3 g-xl-4 pb-5 mb-md-3">
             <div class="col-md-6 col-lg-5 col-xl-6">
  <div class="card bg-success-subtle border-0 h-100">
    <div class="card-body">

      <!-- Row 1: Số đơn hàng -->
      <div class="d-flex align-items-center" >
        <div class="icon-circle bg-primary text-white me-3">
          <i class="fi-shopping-cart fs-4"></i>
        </div>
        <div>
          <div class="h2 mb-1" style="color:#2b2b2b">{{ $orders->count() }}</div>
          <div class="text-muted small">Tổng số đơn hàng đã mua</div>
        </div>
      </div>
      <hr style="margin-top: 10px;margin-bottom: 10px;color: #2b2b2b;">
      <!-- Row 2: Tổng tiền tích lũy -->
      <div class="d-flex align-items-center">
        <div class="icon-circle bg-danger text-white me-3">
          <i class="fi-dollar-sign fs-4"></i>
        </div>
        <div>
          <div class="h2 mb-1" style="color:#2b2b2b">{{ number_format($totalSpent, 0, ',', '.') }} đ</div>
          <div class="text-muted small">Tổng tiền tích lũy</div>
        </div>
      </div>

    </div>

    <div class="card-footer bg-transparent border-0 pt-0">
      <a class="d-inline-flex align-items-center fs-sm fw-medium text-success text-decoration-none" href="{{ URL::to('/list-order') }}">
        Xem đơn hàng
        <i class="fi-chevron-right fs-base ms-1"></i>
      </a>
    </div>
  </div>
</div>


              <div class="col-md-6 col-lg-7 col-xl-6">
                <div class="card bg-warning-subtle border-0 h-100">
                  <div class="card-body d-flex align-items-center">
                     <!-- Vòng progress -->
                    <div class="progress-circle" 
                        data-progress="{{ $progressPercent }}" 
                        style="--percent: {{ $progressPercent }};
                                background: conic-gradient({{ $nextRankStart }}, {{ $nextRankEnd }} {{ $progressPercent }}%, #eee 0);">
                      <span>{{ $progressPercent }}%</span>
                    </div>
                    <div class="ps-3 ps-sm-4">
                      <h5 class="h3 mb-1" style="color:#2b2b2b">Hạng thành viên</h5>
					<hr style="margin-top: 0px;margin-bottom: 20px;color: #2b2b2b;">
                      <ul class="list-unstyled fs-sm mb-0">
                        <li class="d-flex align-items-center">
                          <i class="fi-award me-2 fs-base text-warning"></i>
                          <span class="badge-rank" style="background: {{ $rankColor }};">{{ $rank }}</span>
                        </li>
                        <li class="d-flex align-items-center mt-2">
                          <i class="fi-plus fs-base me-2" style="margin-top: .1875rem"></i>
                          @if($nextRank)
                            <p class="next-rank mb-0">
                              Để lên cấp <strong>{{ $nextRank }}</strong>, bạn cần chi tiêu thêm 
                              <strong class="text-highlight">{{ number_format($remaining, 0, ',', '.') }} đ</strong>
                            </p>
                          @else
                            <p class="text-success fw-bold mb-0">Bạn đã đạt hạng cao nhất 🎉</p>
                          @endif
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>


            <!-- User info -->
            <section class="pb-5 mb-md-3">
              <div class="card bg-warning-subtle border-0 mb-2" style="display: flex;justify-content: center;padding: 1rem;">
              <div class="ratio ratio-1x1 bg-body-tertiary border rounded-circle overflow-hidden mb-3 mb-md-4" style="width: 124px">
                <img src="{{ Auth::user()->avatar ? asset('public/upload/customer/' . Auth::user()->avatar) : asset('public/frontend/images/customer/avt_default.webp') }}" class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Avatar">
              </div>
              <h2 class="h5 pb-1 pb-sm-0 mb-2 mb-sm-3" style="color:#000">{{ Auth::user()->last_name . ' ' . Auth::user()->first_name }}</h2>
              <ul class="list-unstyled flex-row flex-wrap gap-sm-3 fs-sm mb-3">
                <li class="d-flex align-items-center me-2">
                  <i class="fi-mail fs-base me-2"></i>
                  {{ Auth::user()->username }}
                </li>
                <li class="d-flex align-items-center me-2">
                  <i class="fi-phone fs-base me-2"></i>
                  {{ Auth::user()->phone }}
                </li>
                <li class="d-flex align-items-center">
                  <i class="fi-map-pin fs-base me-2"></i>
                  {{ Auth::user()->address. ', ' .Auth::user()->district.', '.Auth::user()->city }}
                </li>
              </ul>
              <a class="btn btn-outline-secondary" href="{{ URL::to('/setting-account') }}" style="border-color:red">Chỉnh sửa thông tin</a>
              </div>
            </section>


            <!-- User listings -->
            <section class="pb-5 mb-md-3">
              <div class="d-flex align-items-center justify-content-between pb-1 pb-sm-0 mb-3 mb-sm-4">
                <h2 class="h4 mb-0 me-3" style="color:#fff">Đơn hàng</h2>
                <div class="nav">
                  <a class="nav-link position-relative px-0" href="{{ URL::to('/list-order') }}">
                    <span class="hover-effect-underline stretched-link me-1" style="color:#ff0000">Xem tất cả</span>
                    <i class="fi-chevron-right fs-base" style="color:#ff0000"></i>
                  </a>
                </div>
              </div>
              <div class="vstack gap-3">

                @forelse($orders as $order)
                    <div class="d-sm-flex align-items-center">
                        <article class="card w-100">
                            <div class="row g-0">
                                <!-- Hình ảnh -->
                                <div class="col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2">
                                    <a class="position-relative d-flex justify-content-center align-items-center bg-body-tertiary" 
                                      href="{{ route('order.details', $order->order_number) }}" style="min-height: 191px;">
                                        <img id="img-order" src="{{ asset('public/frontend/images/logo/logo.webp') }}"
                                            alt="Image" 
                                            style="max-width: 80%; max-height: 100%;padding: 0px 20px 0px 20px;">
                                    </a>
                                </div>

                                <!-- Nội dung đơn hàng -->
                                <div class="col-sm-8 col-md-9 align-self-center order-card">
                                    <div class="card-body d-flex justify-content-between p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0">
                                        <div class="position-relative pe-3">
                                            <div class="h5 mb-1" style="border-bottom: 1px solid #c4c4c4;">Mã ĐH: <strong style="color:red">{{ $order->order_number }}</strong></div>
                                            <div class="h6 mb-2 mt-2" style="border-bottom: 1px solid #c4c4c4;">Tổng: <strong style="color:red;font-size: 16px;">{{ number_format($order->total_price, 0, ',', '.') }} ₫</strong></div>
                                            <div class="d-block h6 fs-sm mb-2">Địa chỉ: <strong style="color:red;font-size: 15px;">{{ $order->address }}</strong></div>
                                            <div class="h6 fs-sm mb-0"><strong style="color:red;font-size: 15px;">{{ $order->district ?? '' }} - {{ $order->city ?? '' }}</strong></div>
                                        </div>

                                        <div class="text-end">
                                            @php
                                                $statusMap = [
                                                    'waiting'   => ['text' => 'Chưa thanh toán', 'color' => 'cyan'],
                                                    'pending'   => ['text' => 'Chờ xác nhận', 'color' => 'orange'],
                                                    'confirmed' => ['text' => 'Đã xác nhận', 'color' => 'green'],
                                                    'shipped'   => ['text' => 'Đang vận chuyển', 'color' => 'blue'],
                                                    'delivered' => ['text' => 'Đã giao hàng', 'color' => 'red'],
                                                ];

                                                $status = $order->status ?? '';
                                                $statusText = $statusMap[$status]['text'] ?? 'Chưa xác định';
                                                $statusColor = $statusMap[$status]['color'] ?? 'gray';
                                            @endphp

                                            <div class="fs-xs text-body-secondary mb-1" style="color: #2b2b2b!important;"><strong style="font-size: 15px;">Ngày mua: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</strong></div>
                                            <span class="badge mb-3" style="background-color: {{ $statusColor }}; color: #fff;font-size: 15px;">
                                                {{ $statusText }}
                                            </span>

                                            <div class="d-flex justify-content-end gap-2 mb-3">
                                                <!-- Xem chi tiết theo order_number -->
                                                <a href="{{ route('order.details', $order->order_number) }}"
                                                  class="btn btn-icon btn-outline-secondary tooltip-btn"
                                                  aria-label="Xem chi tiết">
                                                    <i class="fi-eye fs-base"></i>
                                                    <span class="tooltip-text">Xem chi tiết</span>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @empty
                    <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
                    @endforelse
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
@endsection
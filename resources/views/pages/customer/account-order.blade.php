@extends('account_layout')
@section('account-content')

          <!-- Account listings content -->
          <div class="col-lg-9">
            <h1 class="h2 pb-2 pb-lg-3">Đơn hàng</h1>

            <!-- Nav pills -->
            <div class="nav overflow-x-auto mb-2">
              <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
                <li class="nav-item me-1" role="presentation">
                  <button type="button" class="nav-link text-nowrap active" id="published-tab" data-bs-toggle="pill" data-bs-target="#published" role="tab" aria-controls="published" aria-selected="true">
                    Tất cả đơn hàng
                  </button>
                </li>
              </ul>
            </div>

            <div class="tab-content">

              <!-- Published tab -->
              <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">

                <!-- Published listings -->
                <div class="vstack gap-4" id="publishedSelection">
    @forelse($orders as $order)
    <div class="d-sm-flex align-items-center">
        <article class="card w-100">
            <div class="row g-0">
                <!-- Hình ảnh -->
                <div class="col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2">
                    <a class="position-relative d-flex justify-content-center align-items-center bg-body-tertiary" 
                      href="{{ route('order.details', $order->order_number) }}" style="min-height: 174px;">
                        <img src="http://localhost/unitekver3/public/frontend/images/logo/logo-footer-unitek.webp" 
                            alt="Image" 
                            style="max-width: 100%; max-height: 100%;padding: 0px 20px 0px 20px;">
                    </a>
                </div>

                <!-- Nội dung đơn hàng -->
                <div class="col-sm-8 col-md-9 align-self-center">
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
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
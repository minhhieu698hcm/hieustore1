@extends('admin_layout')
@section('admin_content')
<div class="body-wrapper">
    <div class="container-fluid">
      <div class="card card-body py-3">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
              <h4 class="mb-4 mb-sm-0 card-title">Chi tiết đơn hàng</h4>
              <nav aria-label="breadcrumb" class="ms-auto">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                      <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                      Chi tiết đơn hàng
                    </span>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="card overflow-hidden invoice-application">
        <div class="d-flex">
          <div class="w-100 w-xs-100 chat-container">
            <div class="invoice-inner-part h-100">
              <div class="invoiceing-box">
                <div class="invoice-header d-flex align-items-center border-bottom p-3">
                @if($list_bill)
                  <h4 class=" text-uppercase mb-0">Chi tiết hoá đơn</h4>
                  <div class="ms-auto">
                    <h4 class="invoice-number" style="color:red">#{{ $list_bill->order_number }}</h4>
                  </div>
                @endif
                </div>
                <div class="p-3">
                    <div class="row">
                      <div class="col-md-6 order-summary border rounded p-4 my-4" style="margin-top: 0px!important">
                        <div>
                            <h4 class=" text-uppercase mb-2">Thông tin cá nhân</h4>
                          <address>
                            <h6>&nbsp;Họ tên: <strong style="color:red">{{ $list_bill->first_name }} {{ $list_bill->last_name }}</strong></h6>
                            <h6 class="fw-bold">&nbsp;Số điện thoại: <strong style="color:red">{{ $list_bill->customer_phone }}</strong></h6>
                            <h6 class="fw-bold">&nbsp;Địa chỉ: <strong style="color:red">{{ $list_bill->address }}, {{ $list_bill->district }}, {{ $list_bill->city }}</strong></h6>
                            <h6 class="fw-bold">&nbsp;Ghi chú: <strong style="color:red"><iconify-icon icon="solar:notebook-broken"></iconify-icon> {{ $list_bill->order_note ? $list_bill->order_note : 'Không có ghi chú' }}</strong></h6>
                            @if($list_bill)
                            @php
                                $invoiceMap = [
                                    '1' => ['text' => 'Có', 'class' => 'mb-1 badge text-bg-success'],
                                    '0' => ['text' => 'Không', 'class' => 'mb-1 badge text-bg-danger'],
                                ];

                                $invoice = $list_bill->invoice_required ?? '';
                                $invoiceText = $invoiceMap[$invoice]['text'] ?? 'Chưa xác định';
                                $invoiceClass = $invoiceMap[$invoice]['class'] ?? 'mb-1 badge text-bg-light';
                            @endphp
                            <div class="d-flex">
                                <h6 class="fw-bold d-flex align-items-center" style="margin-top: 2px;">&nbsp;Xuất hoá đơn: &nbsp;</h6>
                            <h6 class="{{ $invoiceClass }} d-flex align-items-center" style="margin-right: 5px;" >
                                {{ $invoiceText }}
                            </h6>
                                @if($invoice == '1') 
                                    <button class="btn me-1 mb-1 bg-success-subtle text-success px-4 fs-4 justify-content-center d-flex align-items-center " data-bs-toggle="modal" data-bs-target="#modal-invoice">
                                    <iconify-icon icon="solar:clipboard-check-broken" width="24" height="24"></iconify-icon>&nbsp;  Mở xuất hoá đơn
                                    </button>
                                @endif
                            </div>
                        @endif           
                        </address>
                        </div>
                      </div>
                      <div class="col-md-6 order-summary border rounded p-4 my-4" style="margin-top: 0px!important">
                        <div>
                            <h4 class=" text-uppercase mb-2">Thông tin đơn hàng</h4>
                          <address>
                            <h6>&nbsp;Đơn hàng: <strong style="color:red">#{{ $list_bill->order_number }}</strong></h6>
                            <h6 class="fw-bold">&nbsp;Ngày đặt: <strong style="color:red"><iconify-icon icon="solar:calendar-broken"></iconify-icon> {{ $list_bill->created_at }}</strong></h6>
                            @if($list_bill)
                            @php
                            $statusMap = [
                                'waiting'   => ['text' => 'Chưa thanh toán', 'class' => 'mb-1 badge text-bg-primary'],
                                'pending'   => ['text' => 'Chờ xác nhận', 'class' => 'mb-1 badge text-bg-warning'],
                                'confirmed' => ['text' => 'Đã xác nhận', 'class' => 'mb-1 badge text-bg-success'],
                                'shipped'   => ['text' => 'Đang vận chuyển', 'class' => 'mb-1 badge text-bg-info'],
                                'delivered' => ['text' => 'Đã giao hàng', 'class' => 'mb-1 badge text-bg-danger'],
                            ];
                        
                            $status = $list_bill->status ?? '';
                            $statusText = $statusMap[$status]['text'] ?? 'Chưa xác định';
                            $statusClass = $statusMap[$status]['class'] ?? 'mb-1 badge text-bg-light';
                            @endphp
                            <div class="d-flex">
                                <h6 class="fw-bold d-flex align-items-center" style="margin-top: 2px;font-size: 16x">&nbsp;Tình trạng: &nbsp;</h6>
                            <h6 class="{{ $statusClass }}" style="font-size: 16px">
                                {{ $statusText }}
                            </h6>
                            </div>
                            @php
                            $methodMap = [
                                'COD'   => ['text' => 'Thanh toán khi nhận hàng (COD)', 'class' => 'mb-1 badge text-bg-danger'],
                                'Store-Cash'   => ['text' => ' Thanh toán tiền mặt và nhận tại cửa hàng', 'class' => 'mb-1 badge text-bg-success'],
                                'Store' => ['text' => 'Thanh toán Ngân Hàng và nhận tại cửa hàng', 'class' => 'mb-1 badge text-bg-warning'],
                                'NH'   => ['text' => 'Thanh toán Ngân Hàng và chuyển phát', 'class' => 'mb-1 badge text-bg-info'],
                            ];
                        
                            $method = $list_bill->payment_method ?? '';
                            $methodText = $methodMap[$method]['text'] ?? 'Chưa xác định';
                            $methodClass = $methodMap[$method]['class'] ?? 'mb-1 badge text-bg-light';
                            @endphp
                            <div class="d-flex">
                                <h6 class="fw-bold d-flex align-items-center" style="margin-top: 2px;font-size: 186x">&nbsp;Vận chuyển: &nbsp;</h6>
                            <h6 class="{{ $methodClass }}" style="font-size: 16px">
                                {{ $methodText }}
                            </h6>
                            </div>
                            @endif
                        </address>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <!-- start row -->
                              <tr>
                                <th class="fs-4 fw-semibold">Tên sản phẩm</th>
                                <th class="text-end fs-4 fw-semibold">Số lượng</th>
                                <th class="text-end fs-4 fw-semibold">Giá</th>
                              </tr>
                              
                              <!-- end row -->
                            </thead>
                            <tbody>
                            @foreach($list_bill->items as $item)
                              <!-- start row -->
                              <tr>
                                <td class="product_name" style="font-weight:600;color:#2b2b2b">
                            {{ $item->product_name }}
                            <div style="font-size: 13px; margin-top: 4px;">
                                @php
                                    $attributeParts = explode(':', $item->attribute);
                                @endphp

                                @if(!empty($item->attribute))
                                    {{ trim($attributeParts[0] ?? '') }}:
                                    <span style="color: red;">{{ trim($attributeParts[1] ?? '') }}</span>
                                    @if(!empty($item->productAttributeCode))
                                        - Mã phân loại: <span style="color: red;">{{ $item->productAttributeCode }}</span>
                                    @endif
                                @elseif(!empty($item->product_code))
                                    Mã sản phẩm: <span style="color: red;">{{ $item->product_code }}</span>
                                @endif
                            </div>
                        </td>
                                <td class="text-end fs-4 fw-semibold"><h6>{{ $item->quantity }}</h6></td>
                                <td class="text-end fs-4 fw-semibold"><h6>{{ number_format($item->price, 0, ',', '.') }} ₫</h6></td>
                              </tr>
                              
                              <!-- end row -->
                              @endforeach
                              <tr>
                                   <!-- Hiển thị chương trình khuyến mãi áp dụng cho đơn hàng -->
                                  @if(isset($promotions) && count($promotions))
                                      <td colspan="3" style="background: #f6fafd;">
                                          <div style="padding: 10px 0;">
                                              <strong style="font-size: 16px; color: #0a58ca;">Chương trình khuyến mãi áp dụng:</strong>
                                              <ul style="margin-bottom: 0;">
                                                  @foreach($promotions as $promotion)
                                                      <li style="margin-bottom: 4px;">
                                                          <span style="font-weight:600;">{{ $promotion->title }}</span>
                                                          @if($promotion->promotion_type == 'gift')
                                                              <span class="badge bg-success">Quà tặng</span>
                                                              @if($promotion->giftProduct)
                                                                  - <span style="color: #e74c3c;">{{ $promotion->giftProduct->product_name }}</span>
                                                              @endif
                                                              (Đơn từ: {{ number_format($promotion->min_total_for_gift, 0, ',', '.') }} ₫)
                                                          @elseif($promotion->promotion_type == 'combo')
                                                              <span class="badge bg-primary">Mua kèm</span>
                                                              @if($promotion->giftProduct)
                                                                  - <span style="color: #e67e22;">{{ $promotion->giftProduct->product_name }}</span>
                                                              @endif
                                                              (Giá mua kèm: {{ number_format($promotion->combo_price, 0, ',', '.') }} ₫)
                                                          @endif
                                                      </li>
                                                  @endforeach
                                              </ul>
                                          </div>
                                      </td>
                                  @endif
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                        <div class="col-md-12 order-summary border rounded p-4 my-4" style="margin-top: 0px!important">
                            <div class="p-3">
                                @php
                                    // Tính tổng tiền hàng
                                    $subtotal = $list_bill->items->sum(fn($item) => $item->price * $item->quantity);
                            
                                    // Lấy dữ liệu từ voucher
                                    $discount = 0;
                                    if (!empty($list_bill->voucher)) {
                                        [$voucherId, $condition, $voucherNumber] = explode('-', $list_bill->voucher);
                            
                                        if ($condition == 1) {
                                            // Giảm phần trăm
                                            $discount = min(($subtotal * $voucherNumber / 100), $list_bill->discount_max ?? $subtotal);
                                        } elseif ($condition == 2) {
                                            // Giảm tiền mặt
                                            $discount = min($voucherNumber, $subtotal);
                                        }
                                    }
                            
                                    // Tính tổng tiền sau giảm giá
                                    $total = $subtotal + ($list_bill->shipping_fee ?? 0) - $discount;
                                @endphp
                              <div class="d-flex justify-content-between mb-4">
                                <h6 class="mb-0 fs-4 fw-semibold">Tạm tính</h6>
                                <h6 class="mb-0 fs-4 fw-semibold">{{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫</h6>
                              </div>
                              <div class="d-flex justify-content-between mb-4">
                                <h6 class="mb-0 fs-4 fw-semibold" >Phí ship</h6>
                                <h6 class="mb-0 fs-4 fw-semibold">{{ number_format($list_bill->shipping_fee ?? 0, 0, ',', '.') }} ₫</h6>
                              </div>
                              <div class="d-flex justify-content-between mb-4">
                                <h6 class="mb-0 fs-4 fw-semibold" >Giảm giá:</h6>
                                <h6 class="mb-0 fs-4 fw-semibold " style="color:red">- {{ number_format($discount, 0, ',', '.') }} ₫</h6>
                              </div>
                              <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                <h6 class="mb-0 fs-4 fw-semibold">Tổng cộng:</h6>
                                <h6 class="mb-0 fs-5 fw-semibold" style="color:red"> {{ number_format($total, 0, ',', '.') }} ₫</h6>
                              </div>
                            </div>
                          </div>
                        <div class="clearfix"></div>                      
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-invoice" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success text-white">
                <h4 class="modal-title text-white" id="success-header-modalLabel">
                  Thông tin xuất hoá đơn
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <div class="modal-body">
                <div class="col-md-12 order-summary border rounded p-4" style="margin-top: 0px!important">
                    <div>
                        <h4 class=" text-uppercase mb-2">Thông tin xuất hoá đơn</h4>
                      <address>
                        <h6>&nbsp;Mã số thuế: <strong style="color:red">{{ $list_bill->invoice_tax_code }}</strong></h6>
                        <h6 class="fw-bold">&nbsp;Tên công ty: <strong style="color:red">{{ $list_bill->invoice_company_name }}</strong></h6>
                        <h6 class="fw-bold">&nbsp;Địa chỉ: <strong style="color:red">{{ $list_bill->invoice_address }}</strong></h6>
                        <h6 class="fw-bold">&nbsp;Email: <strong style="color:red">{{ $list_bill->invoice_email }}</strong></h6>
                    </address>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                  Đóng
                </button>
              </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection

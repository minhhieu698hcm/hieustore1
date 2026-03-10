@extends('admin_layout')
@section('admin_content')


<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Sửa Mã Khuyến Mãi</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex"
                                        href="{{ URL::to('/dashboard') }}">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Sửa Mã Khuyến Mãi
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- start Basic Area Chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-voucher/' . $voucher->idVoucher)}}" method="POST"
                            id="form-edit-voucher" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên mã giảm giá<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="VoucherName" name="VoucherName" class="form-control" 
                                    placeholder="Tên mã giảm giá" value="{{$voucher->VoucherName}}" required>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã giảm giá<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="VoucherCode" name="VoucherCode" class="form-control"
                                    placeholder="Mã giảm giá" value="{{$voucher->VoucherCode}}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng<span class="text-danger"> *</span>
                                </label>
                                <input type="number" id="VoucherQuantity" name="VoucherQuantity" min="0" class="form-control" value="{{$voucher->VoucherQuantity}}" required  placeholder="Số lượng">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hình thức<span class="text-danger"> *</span>
                                </label>
                                <select id="VoucherCondition" name="VoucherCondition"
                                class="selectpicker form-control" data-style="py-0"  required>
                                <option value="{{$voucher->VoucherCondition}}">
                                    @if($voucher->VoucherCondition == 1) Phần trăm
                                    @else
                                    Tiền mặt @endif
                                </option>   
                            <option value="1">Phần trăm</option>
                            <option value="2">Tiền mặt</option>
                            </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phần trăm/Số tiền giảm<span class="text-danger"> *</span>
                                </label>
                                <input id="VoucherNumber" name="VoucherNumber" type="hidden" class="form-control"  placeholder="Vui lòng nhập phần trăm hoặc số tiền giảm" value="{{ $voucher->VoucherNumber }}" required>
                                <input id="VoucherNumberDisplay" name="VoucherNumberDisplay" type="text"
                                                class="form-control" placeholder="Vui lòng nhập phần trăm hoặc số tiền giảm" data-hidden-target="VoucherNumber">
                                <span class="text-danger" id="voucherNumberError"></span>
                            </div>
                            </div>
                            <div class="row">
                            <div id="bill_price_min_container" class="col-md-12 mb-3">
                                <label class="form-label">Điều kiện áp dụng: (Giá tối thiểu)<span class="text-danger"> *</span>
                                </label>
                                <input id="bill_price_min" name="bill_price_min" type="hidden" class="form-control"
                                                placeholder="Nhập giá tối thiểu của đơn" value="{{ $voucher->bill_price_min }}" required>
                                            <input id="bill_price_min_display" name="bill_price_min_display" type="text"
                                                class="form-control" placeholder="Vui lòng nhập giá tối thiếu áp dụng mã"
                                             data-hidden-target="bill_price_min">
                                            <span class="text-danger"></span>
                            </div>
                            <div id="discount_max_container" class="col-md-6" style="display: none;">
                                <label class="form-label">Giảm tối đa:<span class="text-danger"> *</span></label>  
                                <input id="discount_max" name="discount_max" type="hidden" class="form-control"
                                    placeholder="Nhập giá giảm tối đa" value="{{ $voucher->discount_max }}" required>
                                <input id="discount_max_display" name="discount_max_display" type="text"
                                class="form-control" placeholder="Vui lòng nhập giá giảm tối đa"
                                required required data-hidden-target="discount_max">
                                <span class="text-danger"></span>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian bắt đầu<span class="text-danger"> *</span> </label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datetimepicker" name="VoucherStart" id='VoucherStart' placeholder="Nhập thời gian bắt đầu" value="{{ !empty($voucher->VoucherStart) ? \Carbon\Carbon::parse($voucher->VoucherStart)->format('d/m/Y') : '' }}">
                                    <span class="input-group-addon input-group-text">
                                      <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian kết thúc<span class="text-danger"> *</span> </label> 
                                <div class="input-group date">    
                                    <input type="text" class="form-control datetimepicker" name="VoucherEnd" id='VoucherEnd' placeholder="Nhập thời gian kết thúc" value="{{ !empty($voucher->VoucherEnd) ? \Carbon\Carbon::parse($voucher->VoucherEnd)->format('d/m/Y') : '' }}">
                                    <span class="input-group-addon input-group-text">
                                      <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                            </div>
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_voucher" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Sửa mã khuyến mãi</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    </form>
</div>         

<script>
    $(document).ready(function(){
        $('.datetimepicker').datepicker({
            format: 'dd/mm/yyyy',  // Hiển thị ngày theo d/m/Y
            todayBtn: true,
            autoclose: true,
            todayHighlight: true,
            language: "vi"
        });
    
        // Xử lý chuyển đổi ngày trước khi submit
        $('form').on('submit', function(e){
            e.preventDefault();
    
            let startDate = $('#VoucherStart').val();
            let endDate = $('#VoucherEnd').val();
    
            // Chuyển từ dd/mm/yyyy sang yyyy-mm-dd
            startDate = convertToSQLFormat(startDate);
            endDate = convertToSQLFormat(endDate);
    
            // Tạo input hidden để gửi dữ liệu chuẩn lên server
            $('<input>').attr({type: 'hidden', name: 'VoucherStart', value: startDate}).appendTo(this);
            $('<input>').attr({type: 'hidden', name: 'VoucherEnd', value: endDate}).appendTo(this);
    
            this.submit();
        });
    
        function convertToSQLFormat(dateStr) {
            if (!dateStr) return '';
            let parts = dateStr.split('/');
            return parts[2] + '-' + parts[1] + '-' + parts[0];  // yyyy-mm-dd
        }
    });
    </script>
    

      <!-- Validate thời gian voucher -->
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            let voucherData = {
                VoucherName: "{{ $voucher->VoucherName }}",
                VoucherCode: "{{ $voucher->VoucherCode }}",
                VoucherQuantity: "{{ $voucher->VoucherQuantity }}",
                VoucherCondition: "{{ $voucher->VoucherCondition }}",
                VoucherNumber: "{{ $voucher->VoucherNumber }}",
                bill_price_min: "{{ $voucher->bill_price_min }}",
                discount_max: "{{ $voucher->discount_max }}",
                VoucherStart: "{{ \Carbon\Carbon::parse($voucher->VoucherStart)->format('Y-m-d') }}",
                VoucherEnd: "{{ \Carbon\Carbon::parse($voucher->VoucherEnd)->format('Y-m-d') }}"
            };
        
            function formatNumber(value) {
                return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        
            function loadVoucherData() {
                document.querySelectorAll("[data-hidden-target]").forEach(inputDisplay => {
                    let key = inputDisplay.dataset.hiddenTarget;
                    let inputHidden = document.getElementById(key);
        
                    if (inputHidden) inputHidden.value = voucherData[key] || "";
                    inputDisplay.value = formatNumber(voucherData[key] || "");
                });
            }
        
            function handleNumberInput(event) {
                let rawValue = event.target.value.replace(/\D/g, '');
                event.target.value = formatNumber(rawValue);
                
                let hiddenInput = document.getElementById(event.target.dataset.hiddenTarget);
                if (hiddenInput) hiddenInput.value = rawValue;
            }
        
            document.querySelectorAll("[data-hidden-target]").forEach(input => {
                input.addEventListener("input", handleNumberInput);
            });
        
            let voucherCondition = document.getElementById("VoucherCondition");
            let discountMaxContainer = document.getElementById("discount_max_container");
            let discountMaxDisplay = document.getElementById("discount_max_display");
            let billPriceMinContainer = document.getElementById("bill_price_min_container");
        
            function updateFields() {
                let isPercentage = voucherCondition.value === "1";
        
                billPriceMinContainer.classList.toggle("col-md-6", isPercentage);
                billPriceMinContainer.classList.toggle("col-md-12", !isPercentage);
                discountMaxContainer.style.display = isPercentage ? "block" : "none";
                discountMaxDisplay.required = isPercentage;
        
                if (!isPercentage) discountMaxDisplay.value = "";
            }
        
            voucherCondition.addEventListener("change", updateFields);
        
            let voucherNumberInput = document.getElementById("VoucherNumber");
            let voucherNumberDisplayInput = document.getElementById("VoucherNumberDisplay");
        
            function handleVoucherNumberInput(event) {
                let rawValue = event.target.value.replace(/\D/g, '');
                let isPercentage = voucherCondition.value === "1";
        
                if (isPercentage) {
                    rawValue = Math.min(parseInt(rawValue || "0"), 100).toString();
                }
        
                event.target.value = formatNumber(rawValue);
                voucherNumberInput.value = rawValue;
            }
        
            voucherNumberDisplayInput.addEventListener("input", handleVoucherNumberInput);
        
            let voucherCodeInput = document.getElementById("VoucherCode");
            voucherCodeInput.addEventListener("input", function () {
                this.value = this.value.toUpperCase();
            });
        
            loadVoucherData();
            updateFields();
        });
        </script>
@endsection
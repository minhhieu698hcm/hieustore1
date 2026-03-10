@extends('admin_layout')
@section('admin_content')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Thêm Mã Khuyến Mãi</h4>
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
                                        Thêm Mã Khuyến Mãi
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
                        <form action="{{URL::to('/submit-add-voucher')}}" method="POST" id="form-add-voucher"
                            data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên mã giảm giá<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="VoucherName" name="VoucherName" class="form-control" 
                                    placeholder="Tên mã giảm giá">
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã giảm giá<span class="text-danger"> *</span>
                                </label>
                                <input type="text" id="VoucherCode" name="VoucherCode" class="form-control"
                                    placeholder="Mã giảm giá">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng<span class="text-danger"> *</span>
                                </label>
                                <input type="number" id="VoucherQuantity" name="VoucherQuantity" min="0" class="form-control"  placeholder="Số lượng">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hình thức<span class="text-danger"> *</span>
                                </label>
                                <select id="VoucherCondition" name="VoucherCondition"
                                class="selectpicker form-control" data-style="py-0" required>
                                <option value="">Chọn hình thức giảm giá</option>
                                <option value="1">Phần trăm</option>
                                <option value="2">Tiền mặt</option>
                            </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phần trăm/Số tiền giảm<span class="text-danger"> *</span>
                                </label>
                                <input id="VoucherNumber" name="VoucherNumber" type="hidden" class="form-control"  placeholder="Số lượng">
                                <input id="VoucherNumberDisplay" name="VoucherNumberDisplay" type="text"
                                                class="form-control" placeholder="Vui lòng nhập phần trăm hoặc số tiền giảm"
                                                required>
                                <span class="text-danger" id="voucherNumberError"></span>
                            </div>
                            </div>
                            <div class="row">
                            <div id="bill_price_min_container" class="col-md-12 mb-3">
                                <label class="form-label">Điều kiện áp dụng: (Giá tối thiểu)<span class="text-danger"> *</span>
                                </label>
                                <input id="bill_price_min" name="bill_price_min" type="hidden" class="form-control"
                                                placeholder="Nhập giá tối thiểu của đơn">
                                            <input id="bill_price_min_display" name="bill_price_min_display" type="text"
                                                class="form-control" placeholder="Vui lòng nhập giá tối thiếu áp dụng mã"
                                                required>
                                            <span class="text-danger"></span>
                            </div>
                            <div id="discount_max_container" class="col-md-6" style="display: none;">
                                <label class="form-label">Giảm tối đa:<span class="text-danger"> *</span></label>  
                                <input id="discount_max" name="discount_max" type="hidden" class="form-control"
                                    placeholder="Nhập giá giảm tối đa">
                                <input id="discount_max_display" name="discount_max_display" type="text"
                                class="form-control" placeholder="Vui lòng nhập giá giảm tối đa"
                                required>
                                <span class="text-danger"></span>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian bắt đầu<span class="text-danger"> *</span> </label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datetimepicker" name="VoucherStart" id='VoucherStart' placeholder="Nhập thời gian bắt đầu">
                                    <span class="input-group-addon input-group-text">
                                      <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian kết thúc<span class="text-danger"> *</span> </label> 
                                <div class="input-group date">    
                                    <input type="text" class="form-control datetimepicker" name="VoucherEnd" id='VoucherEnd' placeholder="Nhập thời gian kết thúc">
                                    <span class="input-group-addon input-group-text">
                                      <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                            </div>
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_voucher" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Thêm mã khuyến mãi</button>
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
            format: 'dd/mm/yyyy',  // Hiển thị theo định dạng d/m/y
            todayBtn: true,
            autoclose: true,
            todayHighlight: true,
            startDate: new Date(),
            language: "vi"
        });
    
        // Chuyển đổi khi submit form
        $('form').on('submit', function(e){
            e.preventDefault(); // Ngăn chặn submit mặc định để xử lý trước khi gửi
    
            let startDate = $('#VoucherStart').val();
            let endDate = $('#VoucherEnd').val();
    
            // Chuyển từ dd/mm/yyyy thành yyyy-mm-dd để lưu vào CSDL
            startDate = formatDateToYMD(startDate);
            endDate = formatDateToYMD(endDate);
    
            // Tạo input hidden để gửi dữ liệu chuẩn về server
            $('<input>').attr({type: 'hidden', name: 'VoucherStart', value: startDate}).appendTo(this);
            $('<input>').attr({type: 'hidden', name: 'VoucherEnd', value: endDate}).appendTo(this);
    
            this.submit(); // Gửi form sau khi xử lý xong
        });
    
        function formatDateToYMD(dateStr) {
            if (!dateStr) return '';
            let parts = dateStr.split('/');
            return parts[2] + '-' + parts[1] + '-' + parts[0]; // yyyy-mm-dd
        }
    });
    </script>
    

        <!-- Validate thời gian voucher -->
        <script>
            $(document).ready(function () {
                Validator({
                    form: "#form-add-voucher",
                    errorSelector: ".text-danger",
                    parentSelector: ".form-group",
                    rules: [
                        Validator.isRequired("#VoucherStart"),
                        Validator.isRequired("#VoucherEnd"),
                        Validator.isRequired("#VoucherCode"),
                        Validator.isCode("#VoucherCode"),
                        Validator.isSaleEndTimeSysdate("#VoucherEnd"),
                        Validator.isSaleEndTime("#VoucherEnd", function () {
                            return document.querySelector("#form-add-voucher #VoucherStart").value;
                        }),
                        Validator.isSaleStartTime("#VoucherStart", function () {
                            return document.querySelector("#form-add-voucher #VoucherEnd").value;
                        }),
                        Validator.isCodeNumber("#VoucherNumber", function () {
                            return document.querySelector("#form-add-voucher #VoucherCondition").value;
                        })
                    ]
                })
            });
        </script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    function formatNumber(number) {
        return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function setupInputFormatting(displayInputId, hiddenInputId) {
        let displayInput = document.getElementById(displayInputId);
        let hiddenInput = document.getElementById(hiddenInputId);

        if (displayInput && hiddenInput) {
            displayInput.addEventListener("input", function (event) {
                let rawValue = event.target.value.replace(/\D/g, ""); // Chỉ giữ số
                let formattedValue = formatNumber(rawValue); // Định dạng hàng nghìn

                displayInput.value = formattedValue; // Hiển thị số có dấu `.`
                hiddenInput.value = rawValue; // Lưu số thực (không có dấu `.`)
            });
        }
    }

    // Áp dụng cho các input cần định dạng số
    setupInputFormatting("bill_price_min_display", "bill_price_min");
    setupInputFormatting("discount_max_display", "discount_max");
    setupInputFormatting("VoucherNumberDisplay", "VoucherNumber");

    // Xử lý kiểm tra dữ liệu khi submit form
    document.querySelector("form").addEventListener("submit", function (event) {
        let voucherCondition = document.getElementById("VoucherCondition").value; // Lấy giá trị VoucherCondition
        let inputs = [
            { display: "bill_price_min_display", hidden: "bill_price_min" },
            { display: "VoucherNumberDisplay", hidden: "VoucherNumber" }
        ];

        // Chỉ kiểm tra discount_max nếu VoucherCondition = 1 (Phần trăm)
        if (voucherCondition === "1") {
            inputs.push({ display: "discount_max_display", hidden: "discount_max" });
        }

        for (let input of inputs) {
            let displayInput = document.getElementById(input.display);
            let hiddenInput = document.getElementById(input.hidden);

            if (displayInput && hiddenInput) {
                let rawValue = displayInput.value.replace(/\./g, "");

                if (!/^\d+$/.test(rawValue)) {
                    event.preventDefault();
                    alert("Vui lòng nhập số hợp lệ cho " + displayInput.getAttribute("placeholder"));
                    return;
                }

                hiddenInput.value = rawValue;
            }
        }
    });
});

    </script>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let voucherCondition = document.getElementById("VoucherCondition");
            let discountMaxContainer = document.getElementById("discount_max_container");
            let discountMaxDisplay = document.getElementById("discount_max_display");
            let billPriceMinContainer = document.getElementById("bill_price_min_container");
        
            function updateFields() {
                let value = voucherCondition.value;
        
                if (value === "1") {
                    billPriceMinContainer.classList.remove("col-md-12");
                    billPriceMinContainer.classList.add("col-md-6"); // Đổi sang col-md-6
                    discountMaxContainer.style.display = "block"; // Hiện "Giảm tối đa"
                    discountMaxDisplay.required = true; // Bắt buộc nhập khi hiện
                } else {
                    billPriceMinContainer.classList.remove("col-md-6");
                    billPriceMinContainer.classList.add("col-md-12"); // Giữ col-md-12 khi chưa chọn hoặc chọn "Tiền mặt"
                    discountMaxContainer.style.display = "none"; // Ẩn "Giảm tối đa"
                    discountMaxDisplay.value = ""; // Xóa giá trị nhập trước đó
                    discountMaxDisplay.required = false; // Không bắt buộc nhập khi ẩn
                }
            }
        
            voucherCondition.addEventListener("change", updateFields);
            updateFields(); // Gọi khi load trang (nếu có giá trị sẵn)
        });
        </script>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let voucherCondition = document.getElementById("VoucherCondition");
                let voucherNumberInput = document.getElementById("VoucherNumber");
                let voucherNumberDisplayInput = document.getElementById("VoucherNumberDisplay");
            
                function formatNumber(number) {
                    return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            
                function handleVoucherNumberInput(event) {
                    let rawValue = event.target.value.replace(/\D/g, ''); // Chỉ giữ lại số
            
                    if (voucherCondition.value === "1") { // Nếu chọn "Phần trăm"
                        if (rawValue.length > 3) rawValue = rawValue.slice(0, 3); // Giới hạn tối đa 3 số
                        if (parseInt(rawValue) > 100) rawValue = "100"; // Không cho nhập quá 100
                    }
            
                    event.target.value = formatNumber(rawValue);
                    voucherNumberInput.value = rawValue.replace(/\./g, ''); // Lưu vào input ẩn không có dấu chấm
                }
            
                voucherNumberDisplayInput.addEventListener("input", handleVoucherNumberInput);
            });
            document.addEventListener("DOMContentLoaded", function () {
                let voucherCodeInput = document.getElementById("VoucherCode");

                voucherCodeInput.addEventListener("input", function () {
                    this.value = this.value.toUpperCase(); // Chuyển thành chữ in hoa
                });
            });
            </script>
    

@endsection
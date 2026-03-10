@extends('admin_layout')
@section('admin_content')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Thêm quà tặng khuyến mãi</h4>
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
                                        Thêm quà tặng khuyến mãi
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

                        <form action="{{ route('promotions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề khuyến mãi</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại khuyến mãi<span class="text-danger"> *</span></label>
                                <select id="promotion-type-select" name="promotion_type"
                                class="selectpicker form-control" data-style="py-0" required>
                                <option value="">-- Chọn loại khuyến mãi --</option>
                                <option value="gift">Quà tặng</option>
                                <option value="combo">Mua kèm giá ưu đãi</option>
                            </select>
                        </div>
                        {{-- Quà tặng --}}
                        <div id="gift-section" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Giá trị đơn hàng tối thiểu để nhận quà<span class="text-danger"> *</span></label>
                                <input type="number" step="0.01" name="min_total_for_gift" class="form-control" placeholder="Vui lòng nhập giá trị đơn hàng tối thiểu" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn sản phẩm tặng<span class="text-danger"> *</span></label>
                                <select name="gift_product_id" class="select2 form-control" required>
                                    <option value="">-- Chọn sản phẩm --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}">
                                            {{ $product->product_name }} ({{ $product->product_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Mua kèm --}}
                        <div id="combo-section" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Chọn sản phẩm chính</label>
                                <select name="product_id" class="select2 form-control">
                                    <option value="">-- Chọn sản phẩm --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}">
                                            {{ $product->product_name }} ({{ $product->product_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn sản phẩm mua kèm</label>
                                <select name="gift_product_id_combo" class="select2 form-control" required>
                                    <option value="">-- Chọn sản phẩm --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}">
                                            {{ $product->product_name }} ({{ $product->product_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá mua kèm (VNĐ)</label>
                                <input type="number" step="0.01" name="combo_price" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
									<label class="form-label">Ngày bắt đầu</label>
									<input type="date" name="start_date" class="form-control">
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Ngày kết thúc</label>
									<input type="date" name="end_date" class="form-control">
								</div>
                            </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    
</div>         

<script>
    document.getElementById('promotion-type-select').addEventListener('change', function() {
    const type = this.value;
    const giftSection = document.getElementById('gift-section');
    const comboSection = document.getElementById('combo-section');
    const selectGift = document.querySelector('select[name="gift_product_id"]');
    const selectCombo = document.querySelector('select[name="gift_product_id_combo"]');
    const minTotalInput = document.querySelector('input[name="min_total_for_gift"]');

    giftSection.style.display = type === 'gift' ? 'block' : 'none';
    comboSection.style.display = type === 'combo' ? 'block' : 'none';

    // Xử lý required/disabled
    if(type === 'gift') {
        if (selectGift) { selectGift.required = true; selectGift.disabled = false; }
        if (selectCombo) { selectCombo.required = false; selectCombo.disabled = true; }
        if (minTotalInput) { minTotalInput.required = true; minTotalInput.disabled = false; }
    } else if(type === 'combo') {
        if (selectGift) { selectGift.required = false; selectGift.disabled = true; }
        if (selectCombo) { selectCombo.required = true; selectCombo.disabled = false; }
        if (minTotalInput) { minTotalInput.required = false; minTotalInput.disabled = true; }
    }

    // Xóa input hidden gift_product_id nếu có (tránh trùng name)
    let hiddenInput = document.querySelector('input[name="gift_product_id"][type="hidden"]');
    if (hiddenInput) hiddenInput.remove();
});
    document.querySelector('form').addEventListener('submit', function(e) {
        const type = document.getElementById('promotion-type-select').value;
        const selectGift = document.querySelector('select[name="gift_product_id"]');
        const selectCombo = document.querySelector('select[name="gift_product_id_combo"]');
        // Luôn đảm bảo có input name="gift_product_id"
        if(type === 'combo') {
            let comboGift = selectCombo.value;
            if (!comboGift) {
                alert('Vui lòng chọn sản phẩm mua kèm!');
                e.preventDefault();
                return false;
            }
            // Tạo input hidden gift_product_id
            let hiddenInput = document.querySelector('input[name="gift_product_id"][type="hidden"]');
            if(!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'gift_product_id';
                this.appendChild(hiddenInput);
            }
            hiddenInput.value = comboGift;
        } else {
            if (selectGift && !selectGift.value) {
                alert('Vui lòng chọn sản phẩm tặng!');
                e.preventDefault();
                return false;
            }
            let hiddenInput = document.querySelector('input[name="gift_product_id"][type="hidden"]');
            if (hiddenInput) hiddenInput.remove();
        }
    });
</script>
@endsection
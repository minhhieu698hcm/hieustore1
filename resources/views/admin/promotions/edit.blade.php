@extends('admin_layout')
@section('admin_content')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Sửa quà tặng khuyến mãi</h4>
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
                                        Sửa quà tặng khuyến mãi
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

                        <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Tiêu đề --}}
    <div class="mb-3">
        <label class="form-label">Tiêu đề khuyến mãi</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $promotion->title) }}" required>
    </div>

    {{-- Mô tả chi tiết --}}
    <div class="mb-3">
        <label class="form-label">Mô tả chi tiết</label>
        <textarea name="description" class="form-control">{{ old('description', $promotion->description) }}</textarea>
    </div>

    {{-- Loại khuyến mãi --}}
    <div class="mb-3">
        <label class="form-label">Loại khuyến mãi<span class="text-danger"> *</span></label>
        <select id="promotion-type-select" name="promotion_type" class="select2 form-control" required>
            <option value="">-- Chọn loại khuyến mãi --</option>
            <option value="gift" {{ old('promotion_type', $promotion->promotion_type) == 'gift' ? 'selected' : '' }}>Quà tặng</option>
            <option value="combo" {{ old('promotion_type', $promotion->promotion_type) == 'combo' ? 'selected' : '' }}>Mua kèm giá ưu đãi</option>
        </select>
    </div>

    {{-- Quà tặng --}}
    <div id="gift-section" style="display: {{ $promotion->promotion_type == 'gift' ? 'block' : 'none' }};">
        <div class="mb-3">
            <label class="form-label">Giá trị đơn hàng tối thiểu để nhận quà<span class="text-danger"> *</span></label>
            <input type="number" step="0.01" name="min_total_for_gift" class="form-control"
                   value="{{ old('min_total_for_gift', $promotion->min_total_for_gift) }}"
                   placeholder="Vui lòng nhập giá trị đơn hàng tối thiểu">
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn sản phẩm tặng<span class="text-danger"> *</span></label>
            <select name="gift_product_id" class="select2 form-control">
                <option value="">-- Chọn sản phẩm --</option>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}"
                        {{ old('gift_product_id', $promotion->gift_product_id) == $product->product_id ? 'selected' : '' }}>
                        {{ $product->product_name }} ({{ $product->product_code }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Mua kèm --}}
    <div id="combo-section" style="display: {{ $promotion->promotion_type == 'combo' ? 'block' : 'none' }};">
        <div class="mb-3">
            <label class="form-label">Chọn sản phẩm chính</label>
            <select name="product_id" class="select2 form-control">
                <option value="">-- Chọn sản phẩm --</option>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}"
                        {{ old('product_id', $promotion->product_id) == $product->product_id ? 'selected' : '' }}>
                        {{ $product->product_name }} ({{ $product->product_code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn sản phẩm mua kèm</label>
            <select name="gift_product_id_combo" class="select2 form-control">
                <option value="">-- Chọn sản phẩm --</option>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}"
                        {{ old('gift_product_id_combo', $promotion->gift_product_id) == $product->product_id ? 'selected' : '' }}>
                        {{ $product->product_name }} ({{ $product->product_code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá mua kèm (VNĐ)</label>
            <input type="number" step="0.01" name="combo_price" class="form-control"
                   value="{{ old('combo_price', $promotion->combo_price) }}">
        </div>
    </div>

    {{-- Ngày bắt đầu & kết thúc --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', $promotion->start_date ? date('Y-m-d', strtotime($promotion->start_date)) : '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', $promotion->end_date ? date('Y-m-d', strtotime($promotion->end_date)) : '') }}">
        </div>
    </div>

    {{-- Trạng thái --}}
    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $promotion->is_active) == 1 ? 'selected' : '' }}>Hiện</option>
            <option value="0" {{ old('is_active', $promotion->is_active) == 0 ? 'selected' : '' }}>Ẩn</option>
        </select>
    </div>

    {{-- Submit --}}
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
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect   = document.getElementById('promotion-type-select');
    const giftSection  = document.getElementById('gift-section');
    const comboSection = document.getElementById('combo-section');
    const selectGift   = document.querySelector('select[name="gift_product_id"]');
    const selectCombo  = document.querySelector('select[name="gift_product_id_combo"]');
    const form         = document.querySelector('form');

    function toggleSections(type) {
        giftSection.style.display  = (type === 'gift')  ? 'block' : 'none';
        comboSection.style.display = (type === 'combo') ? 'block' : 'none';

        if (selectGift) {
            selectGift.required = (type === 'gift');
            selectGift.disabled = (type !== 'gift');
        }
        if (selectCombo) {
            selectCombo.required = (type === 'combo');
            selectCombo.disabled = (type !== 'combo');
        }

        // Xóa hidden input trùng name nếu có
        let hiddenInput = document.querySelector('input[name="gift_product_id"][type="hidden"]');
        if (hiddenInput) hiddenInput.remove();
    }

    // Gọi khi load trang (để show đúng dữ liệu DB)
    toggleSections(typeSelect.value);

    // Gọi khi user thay đổi
    typeSelect.addEventListener('change', function() {
        toggleSections(this.value);
    });

    // Validate khi submit
    form.addEventListener('submit', function(e) {
        const type = typeSelect.value;

        if (type === 'combo') {
            if (!selectCombo.value) {
                alert('Vui lòng chọn sản phẩm mua kèm!');
                e.preventDefault();
                return false;
            }
            // Luôn gửi gift_product_id = gift_product_id_combo
            let hiddenInput = document.querySelector('input[name="gift_product_id"][type="hidden"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'gift_product_id';
                form.appendChild(hiddenInput);
            }
            hiddenInput.value = selectCombo.value;
        } else if (type === 'gift') {
            if (!selectGift.value) {
                alert('Vui lòng chọn sản phẩm tặng!');
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>

@endsection

@extends('admin_layout')
@section('admin_content')
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
                            <h4 class="mb-4 mb-sm-0 card-title">Điều chỉnh giảm giá</h4>
                            <nav aria-label="breadcrumb" class="ms-auto">
                                <ol class="breadcrumb d-flex align-items-center">

                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex"
                                            href="{{ URL::to('/dashboard') }}">
                                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex"
                                            href="">
                                            <span
                                                class="badge fw-medium fs-2 bg-danger-subtle text-danger d-flex align-items-center">
                                                Quay lại &nbsp;<iconify-icon icon="solar:multiple-forward-left-line-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </span>

                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start Basic Area Chart -->
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="card">
                        <div class="card-body">

                <form action="{{ route('admin.discount.update') }}" method="POST">
                    @csrf
                    <div class="mb-3" style="display: grid;">
                        <h6 class="mb-2 badge text-bg-danger" style="font-size: 16px">
                            Giảm tất cả sản phẩm (%)
                        </h6>
                        <div class="d-flex align-items-center">
                        <input type="text" name="discount_all" class="form-control me-2" placeholder="Nhập % giảm giá toàn bộ (vd: 10)" value="{{ old('discount_all', $discountAll ?? '') }}">
                        <a href="javascript:void(0);" class="delete-discount" data-type="all">
                            <iconify-icon icon="iconamoon:sign-times-circle" width="30" height="30" style="color: #f00"></iconify-icon>
                        </a>
                        </div>
                    </div>
                    <hr>
                    <h2 class="mb-2 badge text-bg-success" style="display: grid;font-size:18px">Giảm theo danh mục</h2>
                    <div class="container">
                        @foreach ($categories->chunk(2) as $categoryChunk)
                            <div class="row">
                                @foreach ($categoryChunk as $cat)
                                    <div class="col-md-6 mb-3 mt-3" style="display:grid">
                                        <h6 class="mb-2 badge text-bg-danger" style="font-size: 15px">
                                            {{ $cat->category_name }}
                                        </h6>
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="discount[{{ $cat->category_id }}]" class="form-control me-2 discount-category" placeholder="Nhập % giảm giá"value="{{ old('discount_.' . $cat->category_id, $discounts[$cat->category_id] ?? '') }}">
                                            <a href="javascript:void(0);" class="delete-discount btn-delete-category" data-type="category" data-id="{{ $cat->category_id }}">
                                                <iconify-icon icon="iconamoon:sign-times-circle" width="30" height="30" style="color: #f00"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div id="remove-discounts-container"></div>
                    <button class="btn btn-primary mt-3 w-100" style="font-size: 20px">Áp dụng</button>
                </form>
            
                    </div>
                </div>
            </div>
            <!-- end Basic Area Chart -->
        </div>
        

    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const discountAllInput = document.querySelector('input[name="discount_all"]');
    const categoryInputs = document.querySelectorAll('.discount-category');
    const deleteCategoryBtns = document.querySelectorAll('.btn-delete-category');
    const deleteAllBtn = document.querySelector('.delete-discount[data-type="all"]');

    function toggleCategoryInputs(disabled) {
        categoryInputs.forEach(input => input.disabled = disabled);
        deleteCategoryBtns.forEach(btn => btn.style.display = disabled ? 'none' : 'inline-block');
    }

    function toggleDiscountAllInput(disabled) {
        discountAllInput.disabled = disabled;
        if (deleteAllBtn) {
            deleteAllBtn.style.display = disabled ? 'none' : 'inline-block';
        }
    }

    function checkCategoryState() {
        let hasCategoryValue = false;
        categoryInputs.forEach(input => {
            if (input.value.trim() !== '') {
                hasCategoryValue = true;
            }
        });

        if (hasCategoryValue) {
            // Nếu có nhập category → disable discount_all
            toggleDiscountAllInput(true);
        } else {
            // Nếu không còn input nào → mở lại discount_all
            toggleDiscountAllInput(false);
        }

        // Nếu discount_all rỗng và không có input category → mở lại
        if (discountAllInput.value.trim() === '' && !hasCategoryValue) {
            toggleCategoryInputs(false);
        }
    }

    // Khi load trang
    if (discountAllInput.value.trim() !== '') {
        toggleCategoryInputs(true);
        toggleDiscountAllInput(false); // Có thể xóa discount_all
    } else {
        checkCategoryState();
    }

    // Khi nhập discount_all
    discountAllInput.addEventListener('input', function () {
        if (this.value.trim() !== '') {
            toggleCategoryInputs(true);          // Khoá input category
        } else {
            toggleCategoryInputs(false);         // Mở lại input category
        }
    });

    // Xử lý xoá
    const deleteButtons = document.querySelectorAll('.delete-discount');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const type = this.dataset.type;
            const id = this.dataset.id;

            if (type === 'all') {
                // Không cho xoá nếu đang bị disable (bị khóa bởi nhập category)
                if (discountAllInput.disabled) return;

                discountAllInput.value = '';
                toggleCategoryInputs(false);
                categoryInputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const match = name.match(/discount\[(\d+)\]/);
                    if (match) {
                        const catId = match[1];
                        input.value = '';
                        addRemoveDiscount(catId);
                    }
                });
            } else if (type === 'category') {
                const input = document.querySelector(`input[name="discount[${id}]"]`);
                if (input) {
                    input.value = '';
                    addRemoveDiscount(id);
                    checkCategoryState(); // Kiểm tra sau khi xoá
                }
            }
        });
    });

    // Khi gõ vào input danh mục
    categoryInputs.forEach(input => {
        input.addEventListener('input', function () {
            checkCategoryState();
        });
    });

    function addRemoveDiscount(categoryId) {
        const container = document.getElementById('remove-discounts-container');
        if (!document.querySelector(`input[name="remove_discounts[]"][value="${categoryId}"]`)) {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'remove_discounts[]';
            hidden.value = categoryId;
            container.appendChild(hidden);
        }
    }
});
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Chọn tất cả input giảm giá: discount_all + các discount_[category_id]
        const discountInputs = document.querySelectorAll('input[name^="discount_"]');

        discountInputs.forEach(input => {
            input.addEventListener('input', function () {
                let value = this.value.replace(/[^\d.]/g, ''); // Chỉ cho số và dấu .
                let floatValue = parseFloat(value);

                // Giới hạn từ 1 đến 100
                if (floatValue > 100) floatValue = 100;
                if (floatValue < 1 && value !== '') floatValue = 1;

                // Làm tròn 1 số thập phân nếu cần
                this.value = floatValue ? floatValue.toString().replace(/^(\d+)(\.\d{0,1})?.*$/, '$1$2') : '';
            });
        });
    });
</script>


@endsection
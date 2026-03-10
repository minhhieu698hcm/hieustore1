@extends('admin_layout')
@section('admin_content')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
                            <h4 class="mb-4 mb-sm-0 card-title">Điều chỉnh thông tin</h4>
                            <nav aria-label="breadcrumb" class="ms-auto">
                                <ol class="breadcrumb d-flex align-items-center">
                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex"
                                            href="{{ URL::to('/dashboard') }}">
                                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex" href="">
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
            <style>
                .label-fixed {
                    min-width: 70px;
                    /* hoặc 100px tùy nội dung */
                    text-align: right;
                }
            </style>
            <!-- start Banner Chính -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion accordion-flush" id="accordion_banner_text">
                        <div class="card accordion-item" style="border-radius: 12px;">
                           <div class="accordion-header d-flex justify-content-between align-items-center" id="heading_banner_text">
                                <!-- Accordion toggle area -->
                                <div class="border-bottom title-part-padding flex-grow-1"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse_banner_text"
                                    aria-expanded="true"
                                    aria-controls="collapse_banner_text"
                                    style="cursor: pointer;">
                                    <h4 class="card-title mb-0">Banner Chữ Khuyến Mãi</h4>
                                </div>

                                <!-- Buttons -->
                                <div class="border-bottom title-part-padding" style="padding-top: 9px; padding-bottom: 9px; margin-bottom: 4px;">
                                    <button type="button" onclick="submitBannerText()" class="btn btn-primary me-2">
                                        Lưu Banner Chữ
                                    </button>
                                    <button type="button" onclick="banner_fields()" class="btn btn-success fw-medium">
                                        <i class="ti ti-circle-plus fs-5 d-flex"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="collapse_banner_text" class="accordion-collapse collapse"
                                aria-labelledby="heading_banner_text" data-bs-parent="#accordion_banner_text">
                                <div class="accordion-body">
                                    <form id="banner_text" enctype="multipart/form-data">
                                        <div id="banner_fields" class="my-1"></div>
                                        @foreach ($banners as $i => $banner)
                                            <div class="row banner-form mt-3" id="banner_text">

                                                <!-- Cột thông tin -->
                                                <div class="col-sm-7">
                                                    <input type="hidden" name="id[]" value="{{ $banner->id ?? '' }}">

                                                    <!-- Title -->
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="form-label mb-0 label-fixed">Title</label>
                                                        <div class="flex-grow-1 ms-3">
                                                            <input type="text" class="form-control" name="title[]"
                                                                value="{{ $banner->title }}" placeholder="Title Banner">
                                                        </div>
                                                    </div>
                                                    <!-- STT và Active -->
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-3 d-flex align-items-center">
                                                            <label class="form-label mb-0 label-fixed">STT</label>
                                                            <div class="flex-grow-1 ms-3">
                                                                <input type="text" class="form-control" name="order[]"
                                                                    value="{{ $banner->order }}" placeholder="Thứ tự banner">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 d-flex align-items-center">
                                                            <label class="form-label mb-0 label-fixed">Hiện / Ẩn</label>
                                                            <div class="form-check form-switch flex-grow-1 ms-3">
                                                                <input type="hidden" name="active[{{ $i }}]" value="0">
                                                                <input class="form-check-input success" type="checkbox" name="active[{{ $i }}]" value="1" {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Nút xóa -->
                                                <div class="col-sm-1 d-flex align-items-start">
                                                    <button type="button" class="btn btn-danger" onclick="deleteBannerText(this)">
                                                        <i class="ti ti-trash fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
                                        @endforeach
                                        <button type="button" onclick="submitBannerText()" class="btn btn-primary">Lưu Banner Chữ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<script>
let bannerIndex = 0;

function banner_fields() {
    bannerIndex++;

    const html = `
        <div class="row banner-form mt-3" id="banner_text_${bannerIndex}">
            <!-- Cột thông tin -->
            <div class="col-sm-7">
                <input type="hidden" name="id[]" value="">

                <!-- Title -->
                <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Title</label>
                    <div class="flex-grow-1 ms-3">
                        <input type="text" class="form-control" name="title[]" placeholder="Title Banner">
                    </div>
                </div>

                <!-- STT và Active -->
                <div class="row">
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                        <label class="form-label mb-0 label-fixed">STT</label>
                        <div class="flex-grow-1 ms-3">
                            <input type="text" class="form-control" name="order[]" placeholder="Thứ tự banner">
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                        <label class="form-label mb-0 label-fixed">Hiện / Ẩn</label>
                        <div class="form-check form-switch flex-grow-1 ms-3">
                            <input type="hidden" name="active[${bannerIndex}]" value="0">
                            <input class="form-check-input success" type="checkbox" name="active[${bannerIndex}]" value="1" checked style="font-size: 30px;margin-left: 0%;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút xóa -->
            <div class="col-sm-1 d-flex align-items-start">
                <button type="button" class="btn btn-danger" onclick="deleteBannerText(null, this)">
                    <i class="ti ti-trash fs-5"></i>
                </button>
            </div>
        </div>

        <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
    `;

    document.getElementById('banner_fields').insertAdjacentHTML('beforeend', html);
}
</script>


<script>
function submitBannerText() {
    const form = document.getElementById('banner_text');
    const formData = new FormData();

    const titles = [];
    const orders = [];
    const ids = [];
    const actives = [];

    // Duyệt từng dòng banner
    const rows = form.querySelectorAll('.banner-form');
    rows.forEach((row) => {
        const title = row.querySelector('input[name="title[]"]')?.value.trim() || '';
        const order = row.querySelector('input[name="order[]"]')?.value.trim() || '';
        const id = row.querySelector('input[name="id[]"]')?.value || '';
        const isActive = row.querySelector('.form-check-input')?.checked ? 1 : 0;

        titles.push(title);
        orders.push(order);
        ids.push(id);
        actives.push(isActive);
    });

    // Thêm mảng vào formData
    formData.append('title', JSON.stringify(titles));
    formData.append('order', JSON.stringify(orders));
    formData.append('id', JSON.stringify(ids));
    formData.append('active', JSON.stringify(actives));

    fetch('{{ route("admin.info.banner_text.save") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.status === 'success') {
            Swal.fire({
                title: "Thành công!",
                text: res.message,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => location.reload());
        } else {
            Swal.fire("Lỗi", res.message || "Không thể lưu dữ liệu", "error");
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire("Lỗi", "Không thể kết nối máy chủ", "error");
    });
}
</script>


<script>
function deleteBannerText(element) {
    const wrapper = element.closest('.banner-form');
    const idInput = wrapper.querySelector('input[name="id[]"]');
    const id = idInput?.value || null;

    if (!id) {
        wrapper.remove();
        return;
    }

    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Thao tác này sẽ xóa banner chữ và không thể hoàn tác.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.info.banner_text.delete") }}',
                type: 'POST',
                data: { id: id },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
    if (response.status === 'success') {
        Swal.fire("Đã xóa!", response.message || "Banner đã bị xóa.", "success").then(() => {
            location.reload(); // ✅ Reload lại trang sau khi xác nhận OK
        });
    } else {
        Swal.fire("Lỗi!", response.message || "Không thể xóa banner.", "error");
    }
},
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire("Lỗi!", "Không thể kết nối đến máy chủ.", "error");
                }
            });
        }
    });
}

</script>

@endsection
@extends('admin_layout')
@section('admin_content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Bảo trì website</h4>
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
                                        Bật tắt trạng thái Website
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
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                      <div class="form-check form-switch" style="font-size:20px">
    <input class="form-check-input" type="checkbox" id="toggleSuspended" {{ $suspended ? 'checked' : '' }}>

    <label class="form-check-label" for="toggleSuspended">Chế độ tạm ngưng website</label>
</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('toggleSuspended').addEventListener('change', function() {
    fetch('{{ route('admin.toggleSuspended') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ status: this.checked })
    })
    .then(res => {
        if (!res.ok) throw new Error('Không thể cập nhật trạng thái!');
        return res.json();
    })
    .then(data => {
        if (data.suspended) {
            Swal.fire({
                icon: 'warning',
                title: 'Đã bật chế độ bảo trì',
                text: 'Khách truy cập sẽ thấy trang 503.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Đã tắt chế độ bảo trì',
                text: 'Website đã mở lại cho người dùng.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745',
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: error.message || 'Có lỗi xảy ra khi cập nhật trạng thái.',
            confirmButtonText: 'Đóng',
            confirmButtonColor: '#d33'
        });
        this.checked = !this.checked; // hoàn tác lại switch nếu lỗi
    });
});
</script>
@endsection

@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
  <div class="table-responsive" >
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
          <h4 class="mb-4 mb-sm-0 card-title">DANH SÁCH BLOG</h4>
          <nav aria-label="breadcrumb" class="ms-auto">
            <ol class="breadcrumb">
              <li class="breadcrumb-item d-flex align-items-center">
                <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                  <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                </a>
              </li>
              <li class="breadcrumb-item" aria-current="page">
                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                  DANH SÁCH BLOG
                </span>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="product-list">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center gap-6 mb-9">
          <div>
            <button onclick="window.location.href='{{URL::to('/add-blog')}}'" class="btn btn-primary" style="margin-right: 10px">Thêm Blog mới</button>
          </div>
          <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm blog">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form>

        </div>
        <div class="table-responsive border rounded">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th scope="col">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="selectAll">
                  </div>
                </th>
                <th scope="col">Tiêu đề blog</th>
                <th>Hiển thị</th>
                <th scope="col">Chỉnh sửa</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($all_blog as $key => $blog )
              <tr>
                <td>
                  <div class="form-check mb-0">
                    <input type="checkbox" class="form-check-input blog-checkbox" id="blog-checkbox-{{ $blog->blog_id }}" value="{{ $blog->blog_id }}">
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="public/upload/blog/{{ $blog->blog_image }}" class="rounded-circle" alt="matdash-img" width="56" height="56">
                    <div class="ms-3">
                      <h6 class="fw-semibold mb-0 fs-4">{{ $blog->blog_title }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <h6 class="mb-0 fs-4">
                    <a href="javascript:void(0);" class="toggle-status" data-id="{{ $blog->blog_id }}" style="margin: 0 10px;">
                      <iconify-icon icon="{{ $blog->blog_status == 1 ? 'iconamoon:eye' : 'iconamoon:eye-off' }}" 
                          width="35" height="35"
                          style="color: {{ $blog->blog_status == 1 ? '#24b301' : '#f40000' }};">
                      </iconify-icon>
                    </a>
                  </h6>
                </td>
                <td>
                  <div class="d-flex gap-6">
                    <!-- Nút sửa -->
                    <a href="{{URL::to('/edit-blog/'.$blog->blog_id)}}" class="dropdown-item">
                        <iconify-icon icon="iconamoon:edit" width="35" height="35" style="color: #24b301; margin-right: 10px;"></iconify-icon>
                    </a>
                
                    <!-- Nút xóa -->
                    <a href="javascript:void(0);" class="dropdown-item delete-blog" data-id="{{ $blog->blog_id }}">
                        <iconify-icon icon="iconamoon:sign-times-circle" width="35" height="35" style="color: #f00"></iconify-icon>
                    </a>
                </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex align-items-center justify-content-center py-1">
            <!-- Hiển thị phân trang -->
            <div class="d-flex justify-content-center mt-3">
              {{ $all_blog->links() }}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>


    <!-- JS xoá sản phẩm -->
<script>
  $(document).on('click', '.delete-blog', function () {
    let idblog = $(this).data('id'); // Lấy ID sản phẩm
    let deleteUrl = "{{ url('/delete-blog') }}/" + idblog; // Tạo URL xóa

    Swal.fire({
        title: "Xác nhận xóa?",
        text: "Bạn muốn xóa blog này? Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff0000",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa ngay!",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            // Chuyển hướng đến URL xóa
            window.location.href = deleteUrl;
        }
    });
});
</script>
<!-- JS xoá sản phẩm -->
<!-- JS cập nhật trạng thái ẩn hiện -->
<script>
  $(document).on('click', '.toggle-status', function () {
    let icon = $(this).find("iconify-icon"); // Lấy icon
    let blog_id = $(this).data('id');

    $.ajax({
        url: "{{ url('/blog/toggle-status') }}/" + blog_id,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                let newIcon = response.new_status == 1 ? 'iconamoon:eye' : 'iconamoon:eye-off';
                let newColor = response.new_status == 1 ? '#24b301' : '#f40000';

                icon.attr("icon", newIcon).css("color", newColor);

                Swal.fire({
                  icon: 'success',
                  title: 'Cập nhật thành <strong style="color:' + (response.new_status == 1 ? '#24b301' : '#ff0000') + ';">' 
                        + (response.new_status == 1 ? 'Hiện' : 'Ẩn') + 
                        '</strong>',
                  timer: 1500,
                  showConfirmButton: false
              });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi cập nhật trạng thái hiển thị.',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
<!-- JS cập nhật trạng thái ẩn hiện -->
@endsection
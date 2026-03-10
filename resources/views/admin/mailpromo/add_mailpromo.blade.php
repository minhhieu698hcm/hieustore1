@extends('admin_layout')
@section('admin_content')

<!-- Custom Style cho CKEditor -->
<style>
    .ck.ck-editor {
        max-width: 555px;
        margin: auto;
    }

    .ck-editor__editable_inline {
        min-height: 300px;
        box-sizing: border-box;
    }
</style>

<div class="body-wrapper">
    <div class="container-fluid">

        <!-- Header -->
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Thêm Mail Promo</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">Thêm Mail Promo</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Thêm Mail Promo -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ URL::to('/save-mailpromo') }}" method="post" enctype="multipart/form-data">
                            @csrf
							<!-- Tên Form -->
                            <div class="mb-3">
                                <label class="form-label">Tên form Mail Promo<span class="text-danger"> *</span></label>
                                <input type="text" name="form_name" class="form-control" 
                                    placeholder="Tên From Mail Promo">
                            </div>

                            <!-- Tiêu đề -->
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề<span class="text-danger"> *</span></label>
                                <input type="text" name="mailpromo_title" class="form-control" 
                                    placeholder="Tiêu đề">
                            </div>

                            <!-- Ảnh -->
                            <div class="mb-3">
                                <label for="mailpromo_image" class="form-label">Ảnh Mail Promo (1000x1000px)<span class="text-danger"> *</span></label>
                                <input type="file" name="mailpromo_image" class="form-control" id="mailpromo_image">
                                <div id="mailpromo_image-preview"></div>
                                <p id="mailpromo_image-message" style="color: red; display: none;">Chưa có hình ảnh nào được chọn</p>
                            </div>

                            <!-- Nội dung Mail Promo -->
                            <div class="mb-3">
                                <label class="form-label">Nội dung Mail Promo</label>
                                <textarea name="mailpromo_content" id="mailpromo_content" class="form-control" rows="8" placeholder="Nội dung bài viết"></textarea>
                            </div>

                            <!-- Nút Submit -->
                            <div class="form-actions text-center">
                                <button type="submit" name="save_blog" class="btn btn-primary mt-3 px-4 py-3 w-100">Thêm Mail Promo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Preview Hình -->
<script>
    $(document).ready(function () {
        function previewSingleImage(input, previewId, messageId) {
            var $preview = $('#' + previewId);
            var $message = $('#' + messageId);

            $preview.empty();

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var $image = $('<img>').attr('src', e.target.result).css({
                        width: '100px',
                        height: '100px',
                        marginTop: '10px',
                        border: '1px solid #ddd',
                        padding: '5px',
                        marginRight: '20px',
                        borderRadius: '5px'
                    });

                    var $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>').css({
                        position: 'absolute',
                        top: '10px',
                        left: '102px',
                        fontSize: '10px',
                        height: '18px',
                        width: '18px',
                        padding: '0px'
                    }).on('click', function () {
                        input.value = "";
                        $preview.empty();
                        $message.show();
                    });

                    var $wrapper = $('<div>').css({
                        position: 'relative',
                        display: 'inline-block'
                    });

                    $wrapper.append($image).append($deleteBtn);
                    $preview.append($wrapper);
                    $message.hide();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $message.show();
            }
        }

        $('#mailpromo_image').on('change', function () {
            previewSingleImage(this, 'mailpromo_image-preview', 'mailpromo_image-message');
        });
    });
</script>




@endsection

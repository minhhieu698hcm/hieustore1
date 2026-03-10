@extends('admin_layout')
@section('admin_content')
<style>
    /* Áp dụng cho toàn bộ khung CKEditor, bao gồm cả toolbar và nội dung */
    .ck.ck-editor {
        max-width: 555px;
        margin: auto;
    }

    /* Áp dụng cho vùng nội dung nội bộ của CKEditor */
    .ck-editor__editable_inline {
        min-height: 300px;
        max-width: 100%;
        box-sizing: border-box;
    }
</style>
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Sửa Mail Promo</h4>
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
                                        Sửa Mail Promo
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
                        <form role="form" action="{{ url('/submit-edit-mailpromo') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="mailpromo_id" value="{{ $mailpromo->mailpromo_id }}">
							<div class="mb-3">
                                <label class="form-label">Tên Form Mail Promo<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="form_name" class="form-control"
                                    placeholder="Tên Form Mail Promo" value="{{ $mailpromo->form_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="mailpromo_title" class="form-control"
                                    placeholder="Tên Mail Promo" value="{{ $mailpromo->mailpromo_title }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="formFile" class="form-label">Ảnh Mail Promo (1000x1000px)<span class="text-danger"> *</span></label>
                                <input type="file" name="mailpromo_image" class="form-control" id="mailpromo-image">
                                
                                <div id="mailpromo-image-preview">
                                    @if(isset($mailpromo->mailpromo_image))
                                        <div class="image-wrapper" style="position:relative; display:inline-block; margin:5px;">
                                            <img src="{{ URL::to('public/upload/mailpromo/' . $mailpromo->mailpromo_id . '/' . $mailpromo->mailpromo_image) }}" alt="" width="100" height="100" id="current-mailpromo-image" data-original="{{ URL::to('public/upload/mailpromo/' . $mailpromo->mailpromo_id . '/' . $mailpromo->mailpromo_image) }}">

                                            <button type="button" class="btn btn-danger image-delete-btn"
                                                    data-target="current-blog-image"
                                                    style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                                        </div>
                                    @endif
                                </div>
                            
                                <p id="mailpromo-image-message" style="color: red; display: none;">Chưa có hình ảnh nào được chọn</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Nội dung Mail Promo</label>
                                <textarea style=" height: 150px; row:8;" class="form-control"
                                name="mailpromo_content" placeholder="Nội dung bài viết">{!! $mailpromo->mailpromo_content !!}</textarea>
                            </div>
                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_mailpromo" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Sửa Mail Promo</button>
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
        $(document).ready(function () {
            function previewSingleImage(input, previewId, messageId) {
                var $preview = $('#' + previewId);
                var $message = $('#' + messageId);

                $preview.empty();

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var $image = $('<img>').attr('src', e.target.result).css({
                            'width': '100px',
                            'height': '100px',
                            'margin-top': '10px',
                            'border': '1px solid #ddd',
                            'padding': '5px',
                            'margin-right': '20px',
                            'border-radius': '5px'
                        });

                        var $deleteBtn = $('<button type="button" class="btn btn-danger">X</button>')
                            .css('position', 'absolute')
                            .css('top', '10px')
                            .css('left', '102px')
                            .css('font-size', '10px')
                            .css('height', '18px')
                            .css('width', '18px')
                            .css('padding', '0px')
                            .on('click', function () {
                                input.value = ""; // Xóa giá trị của input file
                                $preview.empty();
                                $message.show();
                            });

                        var $wrapper = $('<div>').css({
                            'position': 'relative',
                            'display': 'inline-block'
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

            $('#mailpromo-image').on('change', function () {
                previewSingleImage(this, 'mailpromo-image-preview', 'mailpromo-image-message');
            });
        });
    </script>
    <!-- Xu-ly-hinh-gallery -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const deleteBtns = document.querySelectorAll('.image-delete-btn');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const img = document.getElementById(targetId);

            if (img) {
                img.parentElement.remove(); // remove .image-wrapper
                document.getElementById('mailpromo-image-message').style.display = 'block';

                // Optional: set input file to empty if needed
                const fileInput = document.getElementById('mailpromo-image');
                if (fileInput) fileInput.value = '';
            }
        });
    });
});

    </script>
@endsection
@extends('admin_layout')
@section('admin_content')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Thêm tin tức</h4>
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
                                        Thêm tin tức
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
                        <form role="form" action="{{URL::to('/save-blog')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="blog_title" class="form-control" id="slug"
                                    placeholder="Tên blog" onkeyup="ChangeToSlug('slug', 'convert_slug');">
                            </div>
                            <div class="mb-3" style="display:none">
                                <label class="form-label">Slug
                                </label>
                                <input type="text" name="blog_slug" class="form-control" id="convert_slug"
                                    placeholder="Slug Seo">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh blog (376x260px)<span
                                        class="text-danger"> *</span></label>
                                <input type="file" name="blog_image" class="form-control" id="blog-image">
                                <div id="blog-image-preview"></div>
                                <p id="blog-image-message" style="color: red; display: none;">Chưa có hình ảnh
                                    nào được chọn</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Mô tả ngắn (hiển thị trên trang danh sách)<span class="text-danger"> *</span></label>
                                <textarea style="height: 100px;" class="form-control"
                                    id="blog_desc" name="blog_desc" placeholder="Tóm tắt 1-2 dòng cho trang danh sách blog"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Nội dung bài viết (full content)<span class="text-danger"> *</span></label>
                                <textarea style="height: 400px;" class="form-control"
                                id="blog_content" name="blog_content" placeholder="Viết toàn bộ nội dung bài viết tại đây (HTML được hỗ trợ)"></textarea>
                                <small class="text-muted">Hỗ trợ HTML: &lt;p&gt;, &lt;h2&gt;, &lt;h3&gt;, &lt;strong&gt;, &lt;a href=""&gt;, &lt;table&gt;, etc.</small>
                            </div>
                            <div class="mb-3" style="display:none">
                                <label class="form-label" style="width:90%">Ảnh hiển thị trang dưới (không dùng)</label>
                                <textarea style="height: 150px;" class="form-control"
                                name="blog_content2" placeholder="(không dùng - giữ cho tương thích với dữ liệu cũ)"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hiển thị<span class="text-danger"> *</span></label>
                                <select name="blog_status" class="form-select"
                                    data-placeholder="Chọn Hiển thị / Ẩn" tabindex="1">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            
                            <!-- Chọn sản phẩm tham khảo -->
                            <div class="mb-3">
                                <label class="form-label">Sản phẩm tham khảo (tương tự)</label>
                                <select name="related_product_ids[]" id="related_products" class="form-select select2-multiple" multiple 
                                    data-placeholder="Nhập để tìm kiếm sản phẩm...">
                                    @if(isset($products))
                                        @foreach($products as $product)
                                            <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Chọn bài viết tương tự -->
                            <div class="mb-3">
                                <label class="form-label">Bài viết tương tự (liên quan)</label>
                                <select name="related_blog_ids[]" id="related_blogs" class="form-select select2-multiple" multiple 
                                    data-placeholder="Nhập để tìm kiếm bài viết...">
                                    @if(isset($all_blogs))
                                        @foreach($all_blogs as $blog_item)
                                            <option value="{{ $blog_item->blog_id }}">{{ $blog_item->blog_title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_blog" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Thêm blog</button>
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
            // ===== Initialize Select2 =====
            $('.select2-multiple').select2({
                placeholder: $(this).data('placeholder'),
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Không tìm thấy kết quả";
                    },
                    searching: function() {
                        return "Đang tìm kiếm...";
                    }
                }
            });

            // ===== Initialize CKEditor =====
            if (typeof CKEDITOR !== 'undefined') {
                // Replace CKEditor for blog_desc
                if (document.querySelector('[name="blog_desc"]')) {
                    if (CKEDITOR.instances['blog_desc']) {
                        CKEDITOR.instances['blog_desc'].destroy(true);
                    }
                    CKEDITOR.replace('blog_desc', {
                        height: 100,
                        allowedContent: true,
                        removePlugins: 'easyimage, cloudservices',
                        toolbar: [
                            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                            { name: 'links', items: ['Link', 'Unlink'] },
                            { name: 'insert', items: ['Image'] },
                        ]
                    });
                }

                // Replace CKEditor for blog_content
                if (document.querySelector('[name="blog_content"]')) {
                    if (CKEDITOR.instances['blog_content']) {
                        CKEDITOR.instances['blog_content'].destroy(true);
                    }
                    CKEDITOR.replace('blog_content', {
                        height: 400,
                        allowedContent: true,
                        removePlugins: 'easyimage, cloudservices',
                        toolbar: [
                            { name: 'document', items: ['Source', '-', 'Preview'] },
                            { name: 'clipboard', items: ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText'] },
                            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                            { name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                            { name: 'links', items: ['Link', 'Unlink'] },
                            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                            { name: 'colors', items: ['TextColor', 'BGColor'] },
                            { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                        ]
                    });
                }
            }

            // ===== Image Preview =====
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

            $('#blog-image').on('change', function () {
                previewSingleImage(this, 'blog-image-preview', 'blog-image-message');
            });
        });
    </script>
    <!-- Xu-ly-hinh-gallery -->
@endsection
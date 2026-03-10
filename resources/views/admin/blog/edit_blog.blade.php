@extends('admin_layout')
@section('admin_content')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Sửa tin tức</h4>
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
                                        Sửa tin tức
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
                        <form role="form" action="{{ url('/submit-edit-blog') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->blog_id }}">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề<span class="text-danger"> *</span>
                                </label>
                                <input type="text" name="blog_title" class="form-control" id="slug"
                                    placeholder="Tên blog" onkeyup="ChangeToSlug('slug', 'convert_slug');" value="{{ $blog->blog_title }}">
                            </div>
                            <div class="mb-3" style="display:none">
                                <label class="form-label">Slug
                                </label>
                                <input type="text" name="blog_slug" class="form-control" id="convert_slug"
                                    placeholder="Slug Seo" value="{{ $blog->blog_slug }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="formFile" class="form-label">Ảnh blog (376x260px)<span class="text-danger"> *</span></label>
                                <input type="file" name="blog_image" class="form-control" id="blog-image">
                                
                                <div id="blog-image-preview">
                                    @if(isset($blog->blog_image))
                                        <div class="image-wrapper" style="position:relative; display:inline-block; margin:5px;">
                                            <img src="{{ URL::to('public/upload/blog/' . $blog->blog_image) }}"
                                                 alt="" width="100" height="100" id="current-blog-image"
                                                 data-original="{{ URL::to('public/upload/blog/' . $blog->blog_image) }}">
                                            <button type="button" class="btn btn-danger image-delete-btn"
                                                    data-target="current-blog-image"
                                                    style="position:absolute; top:10px; left:102px; font-size:10px; height:18px; width:18px; padding:0;">X</button>
                                        </div>
                                    @endif
                                </div>
                            
                                <p id="blog-image-message" style="color: red; display: none;">Chưa có hình ảnh nào được chọn</p>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Mô tả tin tức ngắn</label>
                                <textarea style=" height: 150px; row:8;" class="form-control"
                                    id="blog_desc" name="blog_desc" placeholder="Mô tả tin tức ngắn">{{ $blog->blog_desc }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Nội dung bài viết</label>
                                <textarea style=" height: 150px; row:8;" class="form-control"
                                id="blog_content" name="blog_content" placeholder="Nội dung bài viết">{{ $blog->blog_content }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="width:90%">Ảnh hiển thị trang dưới</label>
                                <textarea style=" height: 150px; row:8;" class="form-control"
                                name="blog_content2" placeholder="Ảnh hiển thị trang dưới">{{ $blog->blog_content2 }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hiển thị<span class="text-danger"> *</span></label>
                                <select name="blog_status" class="form-select"
                                    data-placeholder="Chọn Hiển thị / Ẩn" tabindex="1">        
                                        <option value="1" {{ $blog->blog_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="0" {{ $blog->blog_status == 0 ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                            
                            <!-- Chọn sản phẩm tham khảo -->
                            <div class="mb-3">
                                <label class="form-label">Sản phẩm tham khảo (tương tự)</label>
                                <select name="related_product_ids[]" id="related_products" class="form-select select2-multiple" multiple 
                                    data-placeholder="Nhập để tìm kiếm sản phẩm...">
                                    @if(isset($products))
                                        @php
                                            $selected_products = json_decode($blog->related_product_ids ?? '[]', true);
                                        @endphp
                                        @foreach($products as $product)
                                            <option value="{{ $product->product_id }}" 
                                                {{ in_array($product->product_id, $selected_products) ? 'selected' : '' }}>
                                                {{ $product->product_name }}
                                            </option>
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
                                        @php
                                            $selected_blogs = json_decode($blog->related_blog_ids ?? '[]', true);
                                        @endphp
                                        @foreach($all_blogs as $blog_item)
                                            <option value="{{ $blog_item->blog_id }}" 
                                                {{ in_array($blog_item->blog_id, $selected_blogs) ? 'selected' : '' }}>
                                                {{ $blog_item->blog_title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-actions" style="text-align: center;">
                                <button type="submit" name="save_blog" class="btn btn-primary"
                                    style="margin-top: 20px; padding: 20px; width:100%">Sửa blog</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const deleteBtns = document.querySelectorAll('.image-delete-btn');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const img = document.getElementById(targetId);

            if (img) {
                img.parentElement.remove(); // remove .image-wrapper
                document.getElementById('blog-image-message').style.display = 'block';

                // Optional: set input file to empty if needed
                const fileInput = document.getElementById('blog-image');
                if (fileInput) fileInput.value = '';
            }
        });
    });
});

    </script>
@endsection
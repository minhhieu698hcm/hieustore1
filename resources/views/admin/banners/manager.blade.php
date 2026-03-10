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
                            <h4 class="mb-4 mb-sm-0 card-title">Điều chỉnh giao diện</h4>
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
                    <div class="accordion accordion-flush" id="accordion_banner_main">
                        <div class="card accordion-item" style="border-radius: 12px;">
                            <div class="accordion-header d-flex justify-content-between align-items-center" id="heading_banner_main">
                                <div class="border-bottom title-part-padding flex-grow-1"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_banner_main" aria-expanded="true"
                                    aria-controls="collapse_banner_main" style="cursor: pointer;">
                                    <h4 class="card-title mb-0">Banner Chính (Slider)</h4>
                                </div>
                                <div class="border-bottom title-part-padding" style="padding-top: 9px; padding-bottom: 9px; margin-bottom: 4px;">
                                    <button onclick="banner_fields();" class="btn btn-success fw-medium" type="button" style="margin-right: 20px;">
                                            <i class="ti ti-circle-plus fs-5 d-flex"></i>
                                        </button>    
                                    <button type="button" onclick="submitBannerHero()" class="btn btn-primary"
                                            style="margin-right: 10px;">
                                            Lưu Banner Hero
                                        </button>
                                        
                                    </div>
                            </div>
                            <div id="collapse_banner_main" class="accordion-collapse collapse"
                                aria-labelledby="heading_banner_main" data-bs-parent="#accordion_banner_main">
                                <div class="accordion-body">
                                    <form id="banner_hero" enctype="multipart/form-data">
                                        <div id="banner_fields" class="my-1"></div>
                                        @foreach ($banners as $i => $banner)
                                            <div class="row banner-form mt-3" id="banner_form_{{ $i }}">
                                                <!-- Cột ảnh -->
                                                <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                                    <div class="mb-3 text-center">
                                                        <label for="image_hero_{{ $i }}">
                                                            <div class="border p-1 rounded" style="cursor:pointer; display: inline-block;">
                                                                <img id="preview_hero_{{ $i }}"
                                                                    src="{{ asset('public/upload/banner_hero/' . $banner->image_url) }}"
                                                                    alt="Ảnh" width="270">
                                                            </div>
                                                        </label>
                                                        <input type="file" accept=".webp,image/webp"
                                                            onchange="previewImage(this, {{ $i }}, 'hero')" id="image_hero_{{ $i }}"
                                                            name="image[]" style="display:none;">
                                                    </div>
                                                </div>

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

                                                    <!-- Link -->
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="form-label mb-0 label-fixed">Link</label>
                                                        <div class="flex-grow-1 ms-3">
                                                            <input type="text" class="form-control" name="link[]"
                                                                value="{{ $banner->link }}" placeholder="Link dẫn đến SP...">
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
                                                                <input class="form-check-input success" type="checkbox" name="active[{{ $i }}]" value="1" {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Nút xóa -->
                                                <div class="col-sm-1 d-flex align-items-start">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="this.closest('.banner-form').remove()">
                                                        <i class="ti ti-trash fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
                                        @endforeach
                                        <button type="button" onclick="submitBannerHero()" class="btn btn-primary">Lưu Banner Hero</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start 3 Banner Khuyến mãi -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion accordion-flush" id="accordion_3_banner_promo">
                        <div class="card accordion-item" style="border-radius: 12px;">
                            <div class="accordion-header d-flex justify-content-between align-items-center" id="heading_3_banner_promo">
                                <div class="border-bottom title-part-padding flex-grow-1"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_3_banner_promo" aria-expanded="false"
                                    aria-controls="collapse_3_banner_promo" style="cursor: pointer;">
                                    <h4 class="card-title mb-0">3 Banner Khuyến Mãi</h4>
                                </div>
                                <div class="border-bottom title-part-padding" style="padding-top: 9px; padding-bottom: 9px; margin-bottom: 4px;">
                                        <button type="button" onclick="submitBannerHighlight()" class="btn btn-primary"
                                            style="margin-right: 10px;">
                                            Lưu Banner Highlight
                                        </button>
                                    </div>
                            </div>
                            <div id="collapse_3_banner_promo" class="accordion-collapse collapse"
                                aria-labelledby="heading_3_banner_promo" data-bs-parent="#accordion_3_banner_promo">
                                <div class="accordion-body">
                                    <form id="3_banner_highlight" enctype="multipart/form-data">
                                        @foreach ($banners_highlight as $i => $banner)
                                            <div class="row banner-form mt-3" id="banner_form_{{ $i }}">
                                                <!-- Cột ảnh -->
                                                <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                                    <div class="mb-3 text-center">
                                                        <label for="image_highlight_{{ $i }}">
                                                            <div class="border p-1 rounded" style="cursor:pointer; display: inline-block;">
                                                                <img id="preview_highlight_{{ $i }}"
                                                                    src="{{ asset('public/upload/3_banner_highlight/' . $banner->image_url) }}"
                                                                    alt="Ảnh" width="200">
                                                            </div>
                                                        </label>
                                                        <input type="file" accept=".webp,image/webp"
                                                            onchange="previewImage(this, {{ $i }}, 'highlight')" id="image_highlight_{{ $i }}"
                                                            name="image[]" style="display:none;">
                                                    </div>
                                                </div>

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

                                                    <!-- Link -->
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="form-label mb-0 label-fixed">Link</label>
                                                        <div class="flex-grow-1 ms-3">
                                                            <input type="text" class="form-control" name="link[]"
                                                                value="{{ $banner->link }}" placeholder="Link dẫn đến SP...">
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
                                                            <input class="form-check-input success" type="checkbox" name="active[{{ $i }}]" value="1" {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
                                        @endforeach
                                        <button type="button" onclick="submitBannerHighlight()" class="btn btn-primary">Lưu Banner Highlight</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start Banner Middle -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion accordion-flush" id="accordion_banner_middle">
                        <div class="card accordion-item" style="border-radius: 12px;">
                            <div class="accordion-header d-flex justify-content-between align-items-center" id="heading_banner_middle">
                                <div class="border-bottom title-part-padding flex-grow-1"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_banner_middle" aria-expanded="false"
                                    aria-controls="collapse_banner_middle" style="cursor: pointer;">
                                    <h4 class="card-title mb-0">1 Banner Middle</h4>
                                    
                                </div>
                                <div class="border-bottom title-part-padding" style="padding-top: 9px; padding-bottom: 9px; margin-bottom: 4px;">
                                        <button type="button" onclick="submitBannerMiddle()" class="btn btn-primary"
                                            style="margin-right: 10px;">
                                            Lưu Banner Middle
                                        </button>
                                    </div>
                            </div>
                            <div id="collapse_banner_middle" class="accordion-collapse collapse"
                                aria-labelledby="heading_banner_middle" data-bs-parent="#accordion_banner_middle">
                                <div class="accordion-body">
                                    <form id="banner_middle" enctype="multipart/form-data">
                                        @foreach ($banners_middle as $i => $banner)
                                            <div class="row banner-form mt-3" id="banner_form_{{ $i }}">
                                                <!-- Cột ảnh -->
                                                <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                                    <div class="mb-3 text-center">
                                                        <label for="image_middle_{{ $i }}">
                                                            <div class="border p-1 rounded" style="cursor:pointer; display: inline-block;">
                                                                <img id="preview_middle_{{ $i }}"
                                                                    src="{{ asset('public/upload/banner_middle/' . $banner->image_url) }}"
                                                                    alt="Ảnh" width="200">
                                                            </div>
                                                        </label>
                                                        <input type="file" accept=".webp,image/webp"
                                                            onchange="previewImage(this, {{ $i }}, 'middle')" id="image_middle_{{ $i }}"
                                                            name="image[]" style="display:none;">
                                                    </div>
                                                </div>

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

                                                    <!-- Link -->
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <label class="form-label mb-0 label-fixed">Link</label>
                                                        <div class="flex-grow-1 ms-3">
                                                            <input type="text" class="form-control" name="link[]"
                                                                value="{{ $banner->link }}" placeholder="Link dẫn đến SP...">
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
                                                                <input class="form-check-input success" type="checkbox" name="active[{{ $i }}]" value="1" {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
                                        @endforeach
                                        <button type="button" onclick="submitBannerMiddle()" class="btn btn-primary">Lưu Banner Middle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
  <div class="col-lg-12">
    <div class="accordion accordion-flush" id="accordion_logo_group">
      <div class="card accordion-item" style="border-radius: 12px;">
        <div class="accordion-header d-flex justify-content-between align-items-center" id="heading_logo_group">
          <div class="border-bottom title-part-padding flex-grow-1"
            data-bs-toggle="collapse" data-bs-target="#collapse_logo_group" aria-expanded="false"
            aria-controls="collapse_logo_group" style="cursor: pointer;">
            <h4 class="card-title mb-0">Logo Website (Main & Footer)</h4>
          </div>
          <div class="border-bottom title-part-padding" style="padding-top: 9px; padding-bottom: 9px; margin-bottom: 4px;">
            <button type="button" onclick="submitLogo()" class="btn btn-primary" style="margin-right: 10px;">Lưu Logo</button>
          </div>
        </div>

        <div id="collapse_logo_group" class="accordion-collapse collapse"
          aria-labelledby="heading_logo_group" data-bs-parent="#accordion_logo_group">
          <div class="accordion-body">

            <form id="form_logo" enctype="multipart/form-data">

              {{-- LOGO MAIN --}}
              <h5 class="mt-3 mb-2 fw-bold">Logo Main</h5>
              @foreach ($logo_main as $i => $banner)
              <div class="row banner-form mt-3">
                <div class="col-sm-4 text-center">
                  <label for="image_logo_main_{{ $i }}">
                    <div class="border p-1 rounded" style="cursor:pointer;">
                      <img id="preview_logo_main_{{ $i }}"
                        src="{{ asset('public/frontend/images/logo/' . $banner->image_url) }}" alt="Logo Main" width="200">
                    </div>
                  </label>
                  <input type="file" accept=".webp,image/webp"
                    onchange="previewImage(this, {{ $i }}, 'logo_main')"
                    id="image_logo_main_{{ $i }}" name="image_logo_main[]" style="display:none;">
                </div>
                <div class="col-sm-7">
                  <input type="hidden" name="id_logo_main[]" value="{{ $banner->id ?? '' }}">
                  <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Title</label>
                    <div class="flex-grow-1 ms-3">
                      <input type="text" class="form-control" name="title_logo_main[]"
                        value="{{ $banner->title }}" placeholder="Tiêu đề logo">
                    </div>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Link</label>
                    <div class="flex-grow-1 ms-3">
                      <input type="text" class="form-control" name="link_logo_main[]"
                        value="{{ $banner->link }}" placeholder="Liên kết logo">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                      <label class="form-label mb-0 label-fixed">STT</label>
                      <div class="flex-grow-1 ms-3">
                        <input type="text" class="form-control" name="order_logo_main[]"
                          value="{{ $banner->order }}" placeholder="Thứ tự">
                      </div>
                    </div>
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                      <label class="form-label mb-0 label-fixed">Hiện / Ẩn</label>
                      <div class="form-check form-switch flex-grow-1 ms-3">
                        <input class="form-check-input success" type="checkbox"
                          name="active_logo_main[{{ $i }}]" value="1"
                          {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
              @endforeach

              {{-- LOGO FOOTER --}}
              <h5 class="mt-4 mb-2 fw-bold">Logo Footer</h5>
              @foreach ($logo_footer as $i => $banner)
              <div class="row banner-form mt-3">
                <div class="col-sm-4 text-center">
                  <label for="image_logo_footer_{{ $i }}">
                    <div class="border p-1 rounded" style="cursor:pointer;">
                      <img id="preview_logo_footer_{{ $i }}"
                        src="{{ asset('public/frontend/images/logo/' . $banner->image_url) }}" alt="Logo Footer" width="200">
                    </div>
                  </label>
                  <input type="file" accept=".webp,image/webp"
                    onchange="previewImage(this, {{ $i }}, 'logo_footer')"
                    id="image_logo_footer_{{ $i }}" name="image_logo_footer[]" style="display:none;">
                </div>
                <div class="col-sm-7">
                  <input type="hidden" name="id_logo_footer[]" value="{{ $banner->id ?? '' }}">
                  <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Title</label>
                    <div class="flex-grow-1 ms-3">
                      <input type="text" class="form-control" name="title_logo_footer[]"
                        value="{{ $banner->title }}" placeholder="Tiêu đề logo">
                    </div>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Link</label>
                    <div class="flex-grow-1 ms-3">
                      <input type="text" class="form-control" name="link_logo_footer[]"
                        value="{{ $banner->link }}" placeholder="Liên kết logo">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                      <label class="form-label mb-0 label-fixed">STT</label>
                      <div class="flex-grow-1 ms-3">
                        <input type="text" class="form-control" name="order_logo_footer[]"
                          value="{{ $banner->order }}" placeholder="Thứ tự">
                      </div>
                    </div>
                    <div class="col-sm-6 mb-3 d-flex align-items-center">
                      <label class="form-label mb-0 label-fixed">Hiện / Ẩn</label>
                      <div class="form-check form-switch flex-grow-1 ms-3">
                        <input class="form-check-input success" type="checkbox"
                          name="active_logo_footer[{{ $i }}]" value="1"
                          {{ $banner->active ? 'checked' : '' }} style="font-size: 30px;margin-left: 0%;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr style="margin: 10px 0; border-top: 1px solid #000000!important; opacity: 0.75;">
              @endforeach

              <button type="button" onclick="submitLogo()" class="btn btn-primary">Lưu Tất Cả Logo</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


        </div>

        <script>
    // Lấy số banner hiện có từ backend
    let bannerIndex = {{ count($banners) }};

    // Thêm banner mới
    function banner_fields() {
        bannerIndex++;

        const html = `
        <div class="row banner-form mt-3" id="banner_form_${bannerIndex}">
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <div class="mb-3 text-center">
                    <label for="image_hero_${bannerIndex}">
                        <div class="border p-1 rounded" style="cursor:pointer; display:inline-block;">
                            <img id="preview_hero_${bannerIndex}" src="" alt="Ảnh" width="270">
                        </div>
                    </label>

                    <input type="file" accept="image/*"
                        onchange="previewImage(this, ${bannerIndex}, 'hero')" 
                        id="image_hero_${bannerIndex}"
                        name="image[]" style="display:none;">
                </div>
            </div>

            <div class="col-sm-7">
                <input type="hidden" name="id[]" value="">

                <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Title</label>
                    <div class="flex-grow-1 ms-3">
                        <input type="text" class="form-control" name="title[]" placeholder="Title Banner">
                    </div>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label class="form-label mb-0 label-fixed">Link</label>
                    <div class="flex-grow-1 ms-3">
                        <input type="text" class="form-control" name="link[]" placeholder="Link dẫn đến SP...">
                    </div>
                </div>

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
                            <input class="form-check-input success" type="checkbox"
                                name="active[${bannerIndex}]"
                                value="1" checked>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-1 d-flex align-items-start">
                <button type="button" class="btn btn-danger"
                    onclick="this.closest('.banner-form').remove()">
                    <i class="ti ti-trash fs-5"></i>
                </button>
            </div>
        </div>

        <hr style="margin:10px 0; border-top:1px solid #000; opacity:0.75;">
        `;

        document.getElementById('banner_fields').insertAdjacentHTML('beforeend', html);
    }

    // Xem trước ảnh khi upload
    function previewImage(input, index, type = 'hero') {
        const file = input.files[0];
        if (!file) return;

        const preview = document.getElementById(`preview_${type}_${index}`);
        if (preview) {
            preview.src = URL.createObjectURL(file);
        }
    }
</script>

        <script>
            function submitBannerHero() {
                const formElement = document.querySelector('#banner_hero');
                const formData = new FormData(formElement);

                const titles = formData.getAll('title[]');
                const links = formData.getAll('link[]');
                const orders = formData.getAll('order[]');
                const files = formData.getAll('image[]');
                const ids = formElement.querySelectorAll('input[name="id[]"]');

                for (let i = 0; i < titles.length; i++) {
                    const title = titles[i]?.trim();
                    const link = links[i]?.trim();
                    const order = orders[i]?.trim();
                    const file = files[i];
                    const id = ids[i]?.value;
                    const isNew = !id;

                    // Kiểm tra thiếu trường
                    if (!title || !link || !order) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Thiếu thông tin',
                            text: `Vui lòng điền đầy đủ Title, Link, STT cho banner thứ ${i + 1}.`
                        });
                        return;
                    }

                    // Kiểm tra bắt buộc có ảnh nếu là banner mới
                    if (isNew && (!file || file.size === 0)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Thiếu ảnh',
                            text: `Vui lòng chọn ảnh .webp cho banner mới thứ ${i + 1}.`
                        });
                        return;
                    }

                    // Kiểm tra định dạng ảnh nếu có file
                    if (file && file.size > 0 && file.type !== 'image/webp') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Sai định dạng ảnh',
                            text: `Banner thứ ${i + 1} chỉ chấp nhận ảnh .webp.`
                        });
                        return;
                    }
                }

                // Gửi nếu hợp lệ
                fetch("{{ route('admin.banner.hero.update') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(res => {
                        if (res.success) {
                            Swal.fire('Thành công', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Lỗi', res.message ?? 'Không thể lưu banner', 'error');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Lỗi', 'Có lỗi xảy ra khi gửi dữ liệu.', 'error');
                    });
            }
        </script>
        <script>
         function submitBannerHighlight() {
    let form = document.getElementById('3_banner_highlight');
    let formData = new FormData(form);

    fetch("{{ route('admin.banner.highlight.update') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            location.reload(); // Reload lại trang để thấy ảnh mới
        } else {
            alert('Có lỗi xảy ra!');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Lỗi khi gửi dữ liệu!');
    });
}

        </script>

<script>
function submitBannerMiddle() {
    let form = document.getElementById('banner_middle');
    let formData = new FormData(form);

    fetch("{{ route('admin.banners.middle.update') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(res => {
        if (res.success) {
            alert(res.message || 'Cập nhật thành công!');
            location.reload(); // Reload để cập nhật ảnh mới
        } else {
            alert(res.message || 'Có lỗi xảy ra!');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Lỗi khi gửi dữ liệu!');
    });
}
</script>

<script>
function submitLogo() {
  const form = document.getElementById('form_logo');
  const formData = new FormData(form);

  fetch("{{ route('admin.logo.update') }}", {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: formData
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    if (res.success) location.reload();
  })
  .catch(err => {
    console.error(err);
    alert('Lỗi khi cập nhật logo!');
  });
}
</script>


@endsection
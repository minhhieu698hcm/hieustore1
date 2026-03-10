@extends('account_layout')
@section('account-content')
@push('styles')
<link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backend/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backend/libs/select2/dist/css/select2.min.css') }}">
@endpush
<style>
 .gender-box {
  display: flex;
  gap: 60px; /* khoảng cách giữa các dòng */
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 10px 25px;
  background-color: #fff;
  width: 100%;
}

.custom-radio {
  display: flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  font-size: 17px;
}

.gender-box input[type="radio"] {
  accent-color: #ff0000; /* màu chọn */
  cursor: pointer;
}
/* Giao diện chung cho select2 */
.select2-container--default .select2-selection--single {
    height: 48px; /* khớp với .form-control-lg */
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    padding: 12px 25px;
    background-color: #fff;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
}

/* Khi focus */
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default .select2-selection--single:focus {
    border-color: #212529; /* màu đậm khi focus */
    box-shadow: 0 0 0 0.2rem rgba(33, 37, 41, 0.1);
}

/* Chữ hiển thị */
.select2-selection__rendered {
    font-size: 16px;
    color: #212529;
    line-height: 1.5;
}
/* Mũi tên xổ xuống */
.select2-container--default .select2-selection--single .select2-selection__arrow b {
  border-color: #888 transparent transparent transparent;
  border-style: solid;
  border-width: 8px 6px 0 6px!important;
  height: 0;
  left: 40%!important;
  margin-left: -12px!important;
  margin-top: 6px!important;
  position: absolute;
  top: 50%;
  width: 0;
}

/* Khoảng cách dropdown */
.select2-dropdown {
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

/* Item trong dropdown */
.select2-results__option {
    padding: 10px 15px;
    font-size: 15px;
}

/* Hover & chọn */
.select2-results__option--highlighted {
    background-color: #212529;
    color: #fff;
}

/* Placeholder */
.select2-selection__placeholder {
    color: #6c757d;
}

/* Khi disabled */
.select2-container--default.select2-container--disabled .select2-selection--single {
    background-color: #e9ecef;
    cursor: not-allowed;
}

/* Căn đều hai select trong hàng (city - district) */
/* #city, #district {
    width: 100% !important;
} */
.upload-container {
    position: relative;
    display: inline-block;
}

.upload-button {
    font-size: 24px; /* Kích thước icon */
    cursor: pointer;
    position: absolute;
    top: 70px;
    left: -50px;
    color: #fb0000;
    background: white;
    border: 2px solid #ddd;
    padding: 6px;
    border-radius: 50%;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    
}

.upload-button:hover {
    color: #0056b3;
}

.file-upload {
    display: none;
}

.avatar-preview {
    width: 180px;
    height: 180px;
    object-fit: cover; /* Cắt ảnh vừa khung */
    border-radius: 50%; /* Giữ hình tròn */
    border: 3px solid #ddd; /* Viền cho đẹp */
    margin-bottom: 2.0em;
}
@media (max-width: 575px) {
  .avatar-preview {
    width: 95px;
    height: 95px;
  }
  #avatar{
    width: 70%;
  }
  #khung_avatar{
    margin-right: 0px!important;
  }
  .upload-button {
    top: 32px;
    left: -105px;
  }
  .fade:not(.show) {
    display: none;
  }

  .nav-pills .nav-link.show, .nav-pills .nav-link:focus-visible, .nav-pills .nav-link:hover {
    color: #2b2b2b!important;
  }
}
</style>
<!-- Account settings content -->
          <div class="col-lg-9">
            <h1 class="h2 pb-2 pb-lg-3">Cài đặt tài khoản</h1>

            <!-- Nav pills -->
            <div class="nav overflow-x-auto mb-3">
              <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
                <li class="nav-item me-1" role="presentation">
                  <button type="button" class="nav-link text-nowrap active" id="personal-info-tab" data-bs-toggle="pill" data-bs-target="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">
                    Thông tin cá nhân
                  </button>
                </li>
                <li class="nav-item me-1" role="presentation">
                  <button class="nav-link text-nowrap" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">
                    Mật khẩu và bảo mật
                  </button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link text-nowrap" id="notifications-tab" data-bs-toggle="pill" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">
                    Cài đặt thông báo
                  </button>
                </li> --}}
              </ul>
            </div>

            <div class="tab-content">

              <!-- Personal info tab -->
              <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                <div class="vstack gap-4">

                  <!-- Profile completeness info card -->
                  <div class="card bg-warning-subtle border-0 mb-2">
                    <div class="card-body d-flex align-items-center">
                      <div class="text-center me-4" id="khung_avatar">
                        <img id="preview-image"
                            src="{{ Auth::user()->avatar ? asset('public/upload/customer/' . Auth::user()->avatar) : asset('public/frontend/images/customer/avt_default.webp') }}"
                            alt="avatar"
                            class="img-fluid rounded-circle avatar-preview">
                        
                        <div class="upload-container mt-2">
                          <i class="fi-image fs-base opacity-75 me-2 upload-button" 
                            onclick="triggerUpload()" 
                            title="Chọn hình ở đây" 
                            style="font-size: 20px !important;"></i>

                          <form id="upload-form" action="{{ route('customer.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input id="image" name="avatar" type="file" accept="image/*" onchange="loadPreview(this)" class="d-none">
                          </form>
                        </div>
                      </div>

                      <div class="ps-3" id="avatar">
                        <p class="fs-sm" style="max-width: 440px">
                          Ảnh hồ sơ của bạn sẽ xuất hiện trên hồ sơ và danh sách liên hệ. PNG hoặc JPG (1000x1000px).
                        </p>
                        <div class="d-flex gap-2">
                          <button class="btn bg-danger-subtle text-danger" onclick="deleteAvatar()">Xóa ảnh</button>
                          <button class="btn btn-primary" onclick="submitForm()">
                            <i class="fi-refresh-ccw fs-sm ms-n1 me-2"></i>Cập nhật ảnh
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>

                  <!-- Settings form -->
                  <form action="{{URL::to('/updateprofile')}}" method="POST">
                    @csrf
                    <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                      <div class="col position-relative">
                        <label for="fn" class="form-label fs-base">Họ *</label>
                        <input type="text" class="form-control form-control-lg" id="fn" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="Nhập họ của bạn" required>
                        <div class="invalid-tooltip bg-transparent p-0">Nhập họ của bạn!</div>
                      </div>
                      <div class="col position-relative">
                        <label for="ln" class="form-label fs-base">Tên *</label>
                        <input type="text" class="form-control form-control-lg" id="ln" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Nhập tên của bạn" required>
                        <div class="invalid-tooltip bg-transparent p-0">Nhập tên của bạn!</div>
                      </div>
                      <div class="col position-relative">
                        <label for="email" class="form-label d-flex align-items-center fs-base">Email * <span class="badge text-danger bg-danger-subtle ms-2">Xác minh Email</span></label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ Auth::user()->username }}" readonly>
                      </div>
                      <div class="col position-relative">
                        <label for="phone" class="form-label d-flex align-items-center fs-base">Số điện thoại * <span class="badge bg-success ms-2">Xác minh</span></label>
                        <input type="tel" class="form-control form-control-lg" id="phone" name="phone" value="{{ Auth::user()->phone }}" data-input-format='{"numericOnly": true, "delimiters": [" ", " "], "blocks": [4, 3, 3]}' placeholder="0xxx xxx xxx" required>
                        <div class="invalid-tooltip bg-transparent p-0">Nhập số điện thoại!</div>
                      </div>
                      <div class="col">
                        <label class="form-label fs-base d-block mb-2">Giới tính</label>

                        <div class="gender-box">
                          <label class="custom-radio">
                            <input type="radio" value="1" name="id_gender" {{ Auth::user()->sex == 1 ? 'checked' : '' }}> Nam
                          </label>
                          <label class="custom-radio">
                            <input type="radio" value="0" name="id_gender" {{ Auth::user()->sex == 0 ? 'checked' : '' }}> Nữ
                          </label>
                        </div>
                      </div>

                      <div class="col">
                        <label for="birth-date" class="form-label fs-base">Ngày sinh</label>
                        <div class="position-relative">
                          <input type="date" class="form-control form-control-lg form-icon-end pe-5" id="birth-date" name="birthday" value="{{ Auth::user()->birthday }}" data-datepicker='{"dateFormat": "F j, Y"}' placeholder="Chọn ngày">
                          <i class="fi-calendar fs-lg position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" id="calendar-icon"></i>
                        </div>
                      </div>
                    </div>
                    <div class="position-relative mb-4">
                      <label for="address" class="form-label fs-base">Địa chỉ *</label>
                      <input type="text" class="form-control form-control-lg" id="address" name="address" value="{{ Auth::user()->address }}" placeholder="Số nhà - đường" required>
                      <div class="invalid-tooltip bg-transparent p-0">Nhập địa chỉ nhà !</div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                    <div class="col position-relative">
                      <label for="city" class="form-label fs-base">Tỉnh/Thành phố *</label>
                      <select id="city" name="city" class="form-control" style="padding: 12px 25px;" required>
                          <option value="">Chọn tỉnh/thành phố</option>
                      </select>
                    </div>
                    <div class="col position-relative">
                      <label for="district" class="form-label fs-base">Quận/Huyện *</label>
                      <select id="district" name="district" class="form-control" style="padding: 12px 25px;" required>
                          <option value="">Chọn quận/huyện</option>
                      </select>
                    </div>
                    </div>
                    <div class="d-flex gap-3" style="margin-bottom: 100px;">
                      <button type="button" class="btn btn-secondary" onclick="reloadCurrentTab()">Huỷ</button>
                      <button type="submit" id="updateprofile" class="btn btn-lg btn-dark" >Lưu thay đổi</button>
                    </div>
                  </form>
                </div>
              </div>


              <!-- Password and security tab -->
              <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <div class="card bg-warning-subtle border-0 mb-2" style="display: flex;justify-content: center;padding: 1rem;">
                <p class="email-main" style="margin:0">Địa chỉ Email hiện tại của bạn là: <span class="fw-medium text-primary">{{ Auth::user()->username }}</span></p>
                </div>
                <!-- Change password form -->
                <form action="{{URL::to('/change-password')}}" method="POST">
                                        @csrf
                  <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                    <div class="col">
                      <label for="current-password" class="form-label fs-base">Mật khẩu hiện tại</label>
                      <div class="password-toggle">
                        <input type="password" class="form-control form-control-lg" id="current-password" name="password_old" required>
                        <div class="invalid-tooltip bg-transparent p-0">Sai mật khẩu hiện tại. Vui lòng thử lại.</div>
                      </div>
                    </div>
                  </div>
                  <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                    <div class="col">
                      <label for="new-password" class="form-label fs-base">Mật khẩu mới <span class="fs-sm fw-normal text-body-secondary">(Tối thiểu 8 ký tự)</span></label>
                      <div class="password-toggle">
                        <input type="password" class="form-control form-control-lg" minlength="8" id="new-password" name="password_new" required>
                        <div class="invalid-tooltip bg-transparent p-0">Mật khẩu tối thiểu 8 ký tự</div>
                      </div>
                    </div>
                    <div class="col">
                      <label for="confirm-new-password" class="form-label fs-base">Nhập lại mật khẩu</label>
                      <div class="password-toggle">
                        <input type="password" class="form-control form-control-lg" minlength="8" id="confirm-new-password" name="password_new_again" required>
                        <div class="invalid-tooltip bg-transparent p-0">Mật khẩu không trùng khớp</div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <button type="button" class="btn btn-secondary" onclick="reloadCurrentTab()">Huỷ</button>
                    <button type="submit" id="changepassword" class="btn btn-lg btn-dark">Cập nhật mật khẩu</button>
                  </div>
                </form>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection

@push('scripts')
  <script src="{{ asset('public/backend/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('public/backend/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js') }}"></script>
  <script src="{{ asset('public/backend/js/forms/datepicker-init.js') }}"></script>
   <script src="{{ asset('public/backend/js/forms/select2.init.js') }}"></script>
@endpush
<script>
document.addEventListener("DOMContentLoaded", function () {
    const calendarIcon = document.querySelector('.fi-calendar');
    const dateInput = document.getElementById('birth-date');

    calendarIcon.addEventListener('click', function () {
        dateInput.showPicker ? dateInput.showPicker() : dateInput.focus();
    });
});
</script>
<!-- Load city-district trong account -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const citySelect = $("#city");
    const districtSelect = $("#district");

    // Giá trị đã lưu từ DB
    const selectedCityName = "{{ Auth::user()->city ?? '' }}";
    const selectedDistrict = "{{ Auth::user()->district ?? '' }}";

    // Load danh sách tỉnh/thành phố
    fetch("https://provinces.open-api.vn/api/p/")
        .then(res => res.json())
        .then(data => {
            citySelect.html('<option value="">Chọn tỉnh/thành phố</option>');
            let matchedCityCode = "";

            data.forEach(province => {
                const isSelected = selectedCityName === province.name ? "selected" : "";
                if (isSelected) matchedCityCode = province.code;

                citySelect.append(
                    `<option value="${province.name}" ${isSelected}>${province.name}</option>`
                );
            });

            // Load quận/huyện nếu đã có sẵn
            if (matchedCityCode) {
                loadDistricts(matchedCityCode, selectedDistrict);
            }

            // Gắn select2
            if ($.fn.select2) {
                citySelect.select2({ placeholder: "Chọn tỉnh/thành phố", width: "100%" });
                districtSelect.select2({ placeholder: "Chọn quận/huyện", width: "100%" });
            }
        })
        .catch(err => console.error("Lỗi tải tỉnh/thành:", err));

    // Khi chọn tỉnh
    citySelect.on("change", function () {
        const provinceName = $(this).val();
        if (!provinceName) {
            districtSelect.html('<option value="">Chọn quận/huyện</option>').prop("disabled", true);
            return;
        }

        // Lấy code tỉnh từ API
        fetch("https://provinces.open-api.vn/api/p/")
            .then(res => res.json())
            .then(data => {
                const province = data.find(p => p.name === provinceName);
                if (province) loadDistricts(province.code, null);
            });
    });

    // Hàm load quận/huyện
    function loadDistricts(provinceCode, selectedDistrictName) {
        fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
            .then(res => res.json())
            .then(data => {
                districtSelect.html('<option value="">Chọn quận/huyện</option>');
                data.districts.forEach(d => {
                    const selected = d.name === selectedDistrictName ? "selected" : "";
                    districtSelect.append(`<option value="${d.name}" ${selected}>${d.name}</option>`);
                });
                districtSelect.prop("disabled", false).trigger("change");
            })
            .catch(err => console.error("Lỗi tải quận/huyện:", err));
    }

    // Khi submit form => lưu tên thành phố/quận
    $("form").on("submit", function () {
        // Xóa các input ẩn cũ trước khi thêm
        $(this).find('input[name="city"]').remove();
        $(this).find('input[name="district"]').remove();

        // Thêm input ẩn lưu tên thành phố
        const cityName = citySelect.val();
        const districtName = districtSelect.val();
        if (cityName) $("<input>").attr({ type: "hidden", name: "city", value: cityName }).appendTo(this);
        if (districtName) $("<input>").attr({ type: "hidden", name: "district", value: districtName }).appendTo(this);
    });
});
</script>
<script>
  // Gọi input file khi click vào icon
  function triggerUpload() {
      document.getElementById('image').click();
  }

  // Hiển thị preview ảnh khi chọn file
  function loadPreview(input) {
      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
              document.getElementById('preview-image').src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
      }
  }

  // Gửi form tải ảnh lên server
  function submitForm() {
      document.getElementById('upload-form').submit();
  }

  // Xóa ảnh đại diện của customer
  function deleteAvatar() {
      Swal.fire({
          title: "Bạn có chắc muốn xóa ảnh đại diện?",
          text: "Hành động này không thể hoàn tác!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Xóa ngay",
          cancelButtonText: "Hủy"
      }).then((result) => {
          if (result.isConfirmed) {
              fetch("{{ route('customer.deleteAvatar') }}", {
                  method: "POST",
                  headers: {
                      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      "Content-Type": "application/json"
                  },
                  body: JSON.stringify({})
              })
              .then(res => res.json())
              .then(data => {
                  if (data.success) {
                      // Reset ảnh về mặc định
                      document.getElementById('preview-image').src = "{{ asset('public/frontend/images/customer/avt_default.webp') }}";
                      Swal.fire("Đã xóa!", "Ảnh đại diện của bạn đã được xóa.", "success");
                  } else {
                      Swal.fire("Lỗi!", "Không thể xóa ảnh, vui lòng thử lại.", "error");
                  }
              })
              .catch(() => {
                  Swal.fire("Lỗi mạng", "Không thể kết nối với máy chủ", "error");
              });
          }
      });
  }
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const tabGroupId = 'accountTabs'; // ID của cụm tab
  const storageKey = `${tabGroupId}_activeTab`;

  // Khi chuyển tab → lưu ID tab đang hiển thị
  document.querySelectorAll(`#${tabGroupId} [data-bs-toggle="pill"]`).forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (e) {
      const activeTarget = e.target.getAttribute('data-bs-target');
      localStorage.setItem(storageKey, activeTarget);
    });
  });

  // Khi reload trang → mở lại tab đã lưu
  const activeTab = localStorage.getItem(storageKey);
  if (activeTab) {
    setTimeout(() => {
      const tabTrigger = document.querySelector(`#${tabGroupId} [data-bs-target="${activeTab}"]`);
      if (tabTrigger) new bootstrap.Tab(tabTrigger).show();
      localStorage.removeItem(storageKey); // Xóa sau khi dùng để tránh dính tab cũ
    }, 100);
  }
});

// Khi bấm "Huỷ" → reload lại tab hiện tại
function reloadCurrentTab() {
  const tabGroupId = 'accountTabs';
  const storageKey = `${tabGroupId}_activeTab`;
  const activePane = document.querySelector('.tab-pane.active.show');
  if (activePane) {
    const tabId = '#' + activePane.id;
    localStorage.setItem(storageKey, tabId);
  }
  location.reload();
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form[action="{{URL::to('/change-password')}}"]');
    const currentPassword = document.getElementById('current-password');
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-new-password');

    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Reset trạng thái lỗi
        document.querySelectorAll('.invalid-tooltip').forEach(t => t.style.display = 'none');

        // Kiểm tra mật khẩu hiện tại
        if (!currentPassword.value.trim()) {
            currentPassword.nextElementSibling.style.display = 'block';
            isValid = false;
        }

        // Kiểm tra mật khẩu mới >= 8 ký tự
        if (newPassword.value.length < 8) {
            newPassword.nextElementSibling.style.display = 'block';
            isValid = false;
        }

        // Kiểm tra nhập lại mật khẩu trùng khớp
        if (confirmPassword.value !== newPassword.value) {
            confirmPassword.nextElementSibling.style.display = 'block';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // ngăn submit form nếu có lỗi
        }
    });

    // Ẩn tooltip khi focus vào input
    [currentPassword, newPassword, confirmPassword].forEach(input => {
        input.addEventListener('input', () => {
            input.nextElementSibling.style.display = 'none';
        });
    });
});
</script>

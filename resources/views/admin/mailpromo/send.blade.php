@extends('admin_layout')
@section('admin_content')

  <div class="body-wrapper">
    <div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
      <div class="col-12">
        <div class="d-sm-flex align-items-center justify-space-between">
        <h4 class="mb-4 mb-sm-0 card-title">Gửi Mail Promo</h4>
        <nav aria-label="breadcrumb" class="ms-auto">
          <ol class="breadcrumb">
          <li class="breadcrumb-item d-flex align-items-center">
            <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
            </a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
            Gửi Mail Promo
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
        <div class="container mt-4">
          <form action="{{ url('/send-mailpromo/' . $promo->mailpromo_id) }}" method="POST" id="email-form">
          @csrf

          <div class="row">
            <!-- Cột nhập email và thao tác -->
            <div class="col-md-6">
            <div class="form-group mb-3">
              <label>Nhập email (nhấn Enter hoặc dấu ","  ";" để thêm):</label>
              <textarea id="email-input" class="form-control" rows="2"
              placeholder="Nhập nhiều email, ngăn cách bởi Enter, dấu , hoặc ;"></textarea>
            </div>
            <div class="form-group">
              <label>Tệp danh sách email (.txt mỗi dòng 1 email):</label>
              <input type="file" id="email-file" class="form-control" accept=".txt">
              <button type="button" id="load-file-emails" class="btn btn-secondary mt-2" style="margin-right:10px">Load từ file</button>
            
              <label >Hoặc:</label>
              <button type="button" id="load-order-emails" class="btn btn-primary mt-3" style="margin-left:10px">Lấy tất cả email từ bảng
              Order</button>
            </div>


            <div class="text-center mt-5">
              <button type="submit" class="btn btn-danger" style="width:100%">Gửi Email</button>
            </div>
            </div>

            <!-- Cột danh sách email -->
            <div class="col-md-6">
            <label>Danh sách email đã thêm:</label>
            <ul class="list-group" id="email-list" style="max-height: 300px; overflow-y: auto;"></ul>
            </div>
          </div>

          <!-- Input ẩn để gửi mảng email -->
          <input type="hidden" name="emails" id="emails-hidden">
          </form>
        </div>



        </div>
      </div>
      </div>
    </div>
    <!-- end Basic Area Chart -->
    </div>
  </div>
  <!-- JavaScript xử lý thêm / xoá email -->
  <script>
    const emailInput = document.getElementById('email-input');
    const emailList = document.getElementById('email-list');
    const emailsHidden = document.getElementById('emails-hidden');

    let emailSet = new Set();

    function renderEmailList() {
    emailList.innerHTML = '';
    emailSet.forEach(email => {
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.innerHTML = `
      <span>${email}</span>
      <button type="button" class="btn btn-sm btn-danger" onclick="removeEmail('${email}')">x</button>
      `;
      emailList.appendChild(li);
    });
    emailsHidden.value = Array.from(emailSet).join('\n');
    }

    function removeEmail(email) {
    emailSet.delete(email);
    renderEmailList();
    }

    function addEmailsFromText(text) {
    const parts = text.split(/[\n,;]+/).map(e => e.trim()).filter(e => e.includes('@'));
    for (const email of parts) {
      emailSet.add(email);
    }
    renderEmailList();
    }

    // Xử lý khi ấn Enter hoặc dán
    emailInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      addEmailsFromText(emailInput.value);
      emailInput.value = '';
    }
    });

    emailInput.addEventListener('paste', (e) => {
    setTimeout(() => {
      addEmailsFromText(emailInput.value);
      emailInput.value = '';
    }, 100);
    });

    document.getElementById('email-form').addEventListener('submit', function () {
    emailsHidden.value = Array.from(emailSet).join('\n');
    });
  </script>
  <script>
    document.getElementById('load-order-emails').addEventListener('click', function () {
    fetch("{{ url('/get-order-emails') }}")
      .then(response => response.json())
      .then(emails => {
      if (Array.isArray(emails)) {
        emails.forEach(email => emailSet.add(email));
        renderEmailList();
      } else {
        alert("Lỗi: Không lấy được email từ server");
      }
      })
      .catch(err => {
      console.error(err);
      alert("Đã xảy ra lỗi khi lấy email từ bảng Order.");
      });
    });
  </script>
  <script>
  document.getElementById('load-file-emails').addEventListener('click', function () {
    const fileInput = document.getElementById('email-file');
    const file = fileInput.files[0];
    if (!file) {
      alert("Vui lòng chọn một file .txt trước.");
      return;
    }

    if (!file.name.endsWith('.txt')) {
      alert("Chỉ chấp nhận file .txt");
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      const content = e.target.result;
      addEmailsFromText(content);
    };
    reader.onerror = function () {
      alert("Không thể đọc file.");
    };
    reader.readAsText(file);
  });
</script>
@endsection
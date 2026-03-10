@extends('admin_layout')

@section('admin_content')
<!-- CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<audio id="chat-sound" src="{{ asset('public/sounds/new-message.mp3') }}" preload="auto"></audio>

<style>
#chat-header-content,
#chat-header-text {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s;
}

#current-chat-header.active #chat-header-content,
#current-chat-header.active #chat-header-text {
    opacity: 1;
    pointer-events: auto;
}
.chat-user.unread {
    background: rgba(255, 0, 0, 0.08) !important;
    border-left: 4px solid #dc3545;
}
.customer-online-indicator {
    width: 12px;
    height: 12px;
    border: 2px solid #fff;
    display: inline-block;
}
/* CSS cho list hình canh giữa */
.offcanvas-body .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* canh giữa */
    gap: 8px;
}

.offcanvas-body .row .col-6 {
    flex: 0 0 calc(50% - 8px); /* mỗi cột chiếm 50% trừ gap */
    max-width: calc(50% - 8px);
    box-sizing: border-box;
}

.offcanvas-body .row img {
    width: 100%;  /* fill col-6 */
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s;
}

.offcanvas-body .row img:hover {
    transform: scale(1.05);
}


</style>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <h4 class="mb-4 mb-sm-0 card-title">Trò chuyện</h4>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="{{ URL::to('/dashboard') }}">
                          <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                        </a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                          Trò chuyện
                        </span>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="card overflow-hidden chat-application" style="height: 660px; margin-bottom: 0px;">
            <div class="d-flex align-items-center justify-content-between gap-6 m-3 d-lg-none">
              <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
                <i class="ti ti-menu-2 fs-5"></i>
              </button>
              <form class="position-relative w-100">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm kiếm trò chuyện" />
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
            </div>
            <div class="d-flex">
              <div class="w-30 d-none d-lg-block border-end user-chat-box">
                <div class="px-4 pt-9 pb-2">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                      <div class="position-relative">
                        <?php
                            $admin = Auth::guard('admin')->user();
                            $adminAvatar = $admin ? $admin->admin_avt : null;
                            $avatarPath = $adminAvatar ? asset('public/backend/images/profile/' . $adminAvatar) : asset('public/backend/images/profile/avt_default.webp');
                        ?>
                        <img id="admin-header-avatar" src="{{ $avatarPath }}" alt="admin" width="54" height="54" class="rounded-circle" style="border: 2px solid #ddd; object-fit:cover;" />
                        <span class="customer-online-indicator position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                        </span>
                      </div>
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-2">{{ $admin ? $admin->admin_name : 'Admin' }}</h6>
                        <?php
                            $position = Session::get('position');
                            if ($position) {           
                                if ($position == 'dev') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-danger d-flex align-items-center">Lập trình viên &nbsp;<iconify-icon icon="solar:crown-star-broken" width="14" height="14"></iconify-icon></span>';
                                } elseif ($position == 'admin') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-warning d-flex align-items-center">Quản trị viên &nbsp;<iconify-icon icon="solar:laptop-minimalistic-broken" width="14" height="14"></iconify-icon></span>';
                                } elseif ($position == 'sale') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-success d-flex align-items-center">Kinh doanh &nbsp;<iconify-icon icon="solar:sale-broken" width="14" height="14"></iconify-icon></span>';
                                }
                            }
                            ?>
                      </div>
                    </div>
                    <div class="dropdown">
                      <a class="text-dark fs-6 nav-icon-hover" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-filter" style="font-size: 35px;"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2 border-bottom">
                            <span>
                                Lọc cuộc trò chuyện
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)">
                            <span>
                              Lọc theo thời gian
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)">
                            <span>
                              Lọc theo chưa xem
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <form class="position-relative">
                    <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm kiếm trò chuyện" />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </form> 
                </div>
                <hr style="margin: 5px 0; border-top: 2px solid #3b3b3b; opacity: 0.5;">

                <div class="app-chat" >
                  <ul class="chat-users mb-0 mh-n100" data-simplebar style="height: 508px;">
                    @if(count($sessions) == 0)
                        <li class="px-4 py-3 text-muted">Chưa có phiên chat nào</li>
                    @else
                    @foreach($sessions as $s)
                    <li>
                      <a href="javascript:void(0)" 
                        class="px-4 bg-hover-light-black d-flex align-items-start justify-content-between chat-user"
                        data-session-id="{{ $s['chat_session_id'] }}"
                        data-unread="{{ $s['unread'] }}"
                        style="padding:14px!important">

                          <div class="d-flex align-items-center">
                            <span class="position-relative">
                              <img src="https://ui-avatars.com/api/?name={{ urlencode($s['customer_name'] ?? 'Khách') }}&background=random&size=48" 
                                  alt="user" width="48" height="48" class="rounded-circle" 
                                  style="border: 2px solid #ddd; object-fit:cover;" />
                              <span class="customer-online-indicator position-absolute bottom-0 end-0 rounded-pill {{ $s['is_customer_online'] ? 'bg-success' : 'bg-secondary' }}"></span>
                            </span>

                            <div class="ms-3 d-inline-block w-75">
                              <h6 class="mb-1 fw-semibold chat-title">{{ $s['customer_name'] ?? 'Khách' }}</h6>
                              <span class="fs-3 text-truncate text-body-color d-block" style="width: 145px;">{{ \Illuminate\Support\Str::limit($s['last_message'] ?? 'Ảnh', 50) }}</span>
                            </div>
                          </div>

                          <div class="d-flex flex-column align-items-end">
                              <p class="fs-2 mb-0 text-muted">
                                  {{ isset($s['last_at']) ? $s['last_at']->format('H:i d/m/y') : '' }}
                              </p>

                              <!-- 🔥 Badge số chưa đọc -->
                              <span class="chat-unread-badge" style="background:#dc3545; color:#fff; padding:2px 8px; border-radius:12px; font-size:12px; font-weight:600; margin-top:6px;">
                          {{ $s['unread'] }}
                        </span>

                          </div>

                      </a>
                      </li>
                    @endforeach
                    @endif
                  </ul>
                </div>
              </div>
              <div class="w-70 w-xs-100 chat-container">
                <div class="chat-box-inner-part h-100">
                  <div class="chat-not-selected h-100 d-none">
                    <div class="d-flex align-items-center justify-content-center h-100 p-5">
                      <div class="text-center">
                        <span class="text-primary">
                          <i class="ti ti-message-dots fs-10"></i>
                        </span>
                        <h6 class="mt-2">Mở trò chuyện từ danh sách</h6>
                      </div>
                    </div>
                  </div>
                  <div class="chatting-box d-block">
                    <div class="p-2 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
    <div id="current-chat-header" class="hstack gap-3 current-chat-user-name" style="padding-left: 10px; width: 400px;">
    <div class="position-relative" id="chat-header-content">
        <img id="customer-avatar-header" 
             src="{{ asset('public/backend/images/profile/avt_default.webp') }}" 
             alt="user1" width="48" height="48" 
             class="rounded-circle" style="border: 2px solid #ddd; object-fit:cover;" />
        <span id="customer-online-indicator" 
              class="position-absolute bottom-0 end-0 p-1 badge rounded-pill" 
              style="display:none;width: 12px;height: 12px;border: 2px solid #fff;display: inline-block;"></span>
    </div>
    <div id="chat-header-text" class="d-flex flex-column justify-content-center">
        <h6 class="mb-1 name fw-semibold" id="current-chat-name"></h6>
        <div class="d-flex align-items-center gap-2">
            <p class="mb-0 text-muted" id="customer-status" style="font-size:0.85rem;"></p>
            <small class="text-muted" id="assigned-admin-name" style="display:none; font-size:0.85rem;"></small>
        </div>
    </div>
</div>


    <ul class="list-unstyled mb-0 d-flex align-items-center">
        {{-- <li>
          <a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
            <i class="ti ti-phone"></i>
          </a>
        </li>
        <li>
          <a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
            <i class="ti ti-video"></i>
          </a>
        </li> --}}
        <li>
          <a class="chat-menu text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
    </ul>
</div>

                    <div class="d-flex parent-chat-box">
                      <div class="chat-box w-xs-100 position-relative">
                        <div class="chat-box-inner px-4 py-3" id="admin-chat-body" style="flex:1; overflow-y:auto; border-bottom:1px solid #e5e5e5; background:#f8f9fa;height: 535px;">
                            <div class="text-center text-muted p-5" id="no-chat-selected">Chọn một phiên chat để xem tin nhắn</div>
                        </div>
                        <!-- POPUP PREVIEW ẢNH -->
<div id="chat-image-popup"
     style="
        position:absolute;
        bottom:80px;
        left:50%;
        transform:translateX(-50%);
        background:#fff;
        padding:10px;
        border-radius:8px;
        box-shadow:0 4px 10px rgba(0,0,0,0.15);
        display:none;
        z-index:9999;
        text-align:center;
     ">
    <img id="chat-image-popup-preview" src="" style="max-width:220px; max-height:220px; border-radius:6px;" />

    <div class="mt-2 d-flex justify-content-center gap-2">
        <button id="chat-image-send" class="btn btn-primary btn-sm">Gửi</button>
        <button id="chat-image-cancel" class="btn btn-danger btn-sm">Xoá</button>
    </div>
</div>

                        <div class="px-9 py-6 border-top chat-send-message-footer" style="padding-top: 6px !important;">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 w-85">
                              <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)">
                                <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i>
                              </a>
                              <input type="text" id="admin-chat-input" class="form-control text-muted border-0 rounded-0 p-0 ms-2" placeholder="Nhập tin nhắn..." />
                            <img id="admin-chat-image-preview" src="" style="max-width:100px; max-height:100px; display:none; margin-left:10px;" />
                            </div>
                            <ul class="list-unstyledn mb-0 d-flex align-items-center">
                              <li>
                                  <a id="admin-chat-add-image" class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" title="Thêm ảnh" href="javascript:void(0)">
                                      <i class="ti ti-photo-plus"></i>
                                  </a>
                                  <input type="file" id="admin-chat-file" class="d-none" accept="image/*" />
                              </li>
                              <button id="admin-chat-send" class="btn btn-sm text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" >
                                    <i class="ti ti-send"></i>
                                </button>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="app-chat-offcanvas border-start">
                        <div class="custom-app-scroll mh-n100" data-simplebar style="height: 590px;">
                          <div class="d-flex align-items-center justify-content-between" style="padding-top:16px;padding-left:16px">
                            <h6 class="fw-semibold mb-0 text-nowrap">
                              Hình ảnh <span class="text-muted"></span>
                            </h6>
                            <a class="chat-menu d-lg-none d-block text-dark fs-6 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
                              <i class="ti ti-x"></i>
                            </a>
                          </div>
                          <div class="offcanvas-body p-9">

                            <div class="row mb-7 text-nowrap">
                              

                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>

                  </div>
                </div>
              </div>
              <div class="offcanvas offcanvas-start user-chat-box chat-offcanvas" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Trò chuyện
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="px-4 pt-9 pb-6">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                      <div class="position-relative">
                         <?php
                            $admin = Auth::guard('admin')->user();
                            $adminAvatar = $admin ? $admin->admin_avt : null;
                            $avatarPath = $adminAvatar ? asset('public/backend/images/profile/' . $adminAvatar) : asset('public/backend/images/profile/avt_default.webp');
                        ?>
                        <img id="admin-header-avatar" src="{{ $avatarPath }}" alt="admin" width="54" height="54" class="rounded-circle" style="border: 2px solid #ddd; object-fit:cover;" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                        </span>
                      </div>
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-2">{{ $admin ? $admin->admin_name : 'Admin' }}</h6>
                        <?php
                            $position = Session::get('position');
                            if ($position) {           
                                if ($position == 'dev') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-danger d-flex align-items-center">Lập trình viên &nbsp;<iconify-icon icon="solar:crown-star-broken" width="14" height="14"></iconify-icon></span>';
                                } elseif ($position == 'admin') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-warning d-flex align-items-center">Quản trị viên &nbsp;<iconify-icon icon="solar:laptop-minimalistic-broken" width="14" height="14"></iconify-icon></span>';
                                } elseif ($position == 'sale') {
                                    echo '<span class="mb-1 badge rounded-pill text-bg-success d-flex align-items-center">Kinh doanh &nbsp;<iconify-icon icon="solar:sale-broken" width="14" height="14"></iconify-icon></span>';
                                }
                            }
                            ?>
                      </div>
                    </div>
                    <div class="dropdown">
                      <a class="text-dark fs-6 nav-icon-hover" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-filter" style="font-size: 35px;"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2 border-bottom">
                            <span>
                                Lọc cuộc trò chuyện
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)">
                            <span>
                              Lọc theo thời gian
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)">
                            <span>
                              Lọc theo chưa xem
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <form class="position-relative">
                    <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Tìm kiếm trò chuyện" />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </form>
                </div>
                <hr style="margin: 5px 0; border-top: 2px solid #3b3b3b; opacity: 0.5;">
                <div class="app-chat">
                  <ul class="chat-users mb-0 mh-n100" data-simplebar>
                    @if(count($sessions) == 0)
                        <li class="px-4 py-3 text-muted">Chưa có phiên chat nào</li>
                    @else
                    @foreach($sessions as $s)
                    <li>
                      <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light-subtle" data-session-id="{{ $s['chat_session_id'] }}" data-total="{{ $s['total_messages'] ?? 0 }}">
                        <div class="d-flex align-items-center">
                          <span class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($s['customer_name'] ?? 'Khách') }}&background=random&size=48" alt="user" width="48" height="48" class="rounded-circle" style="border: 2px solid #ddd; object-fit:cover;" />
                            <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                            </span>
                          </span>
                          <div class="ms-3 d-inline-block w-75">
                            <h6 class="mb-1 fw-semibold chat-title">{{ $s['customer_name'] ?? 'Khách' }}</h6>
                            <span class="fs-3 text-truncate text-body-color d-block">{{ \Illuminate\Support\Str::limit($s['last_message'] ?? '-', 50) }}</span>
                          </div>
                        </div>
                        <p class="fs-2 mb-0 text-muted">{{ isset($s['last_at']) ? $s['last_at']->format('H:i d/m/y') : '' }}</p>
                      </a>
                    </li>
                    @endforeach
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- Overlay preview ảnh toàn màn hình (list ảnh) -->
<div id="image-preview-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background: rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:1050;">
    <button id="image-preview-close" style="position:absolute; top:30px; right:30px; font-size:40px; 
          background:none; border:none; color:white; cursor:pointer;">&times;</button>
    <img id="image-preview-img" src="" style="max-width:90%; max-height:90%; border-radius:8px;" />
</div>

<!-- Overlay zoom ảnh chat message / gửi ảnh -->
<div id="chat-image-zoom" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100vw;
    height:100vh;
    background:rgba(0,0,0,0.8);
    z-index:99999;
    justify-content:center;
    align-items:center;
">
    <img id="chat-image-zoom-img" src="" style="max-width:90%; max-height:90%; border-radius:8px;" />
    <button id="chat-image-zoom-close" style="
        position:absolute;
        top:20px;
        right:20px;
        background:#fff;
        border:none;
        padding:6px 10px;
        border-radius:4px;
        cursor:pointer;
        font-weight:bold;
    ">X</button>
</div>

@push('scripts')
<script src="{{ asset('public/backend/js/chat/chat.js') }}"></script>

<script>
$(function(){
    console.log('MatDash-style chat view loaded');

    const baseUrl = "{{ url('') }}";
    let currentSession = null;

    /* =====================================
       MARK READ API
    ===================================== */
    function markRead(sessionId){
        if(!sessionId) return;

        $.ajax({
            url: baseUrl + '/chat/mark-read',
            method: 'POST',
            data: { chat_session_id: sessionId },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function(){
            const item = $('.chat-user[data-session-id="'+ sessionId +'"]');
            item.data('unread', 0);
            item.find('.chat-unread-badge').hide();
            item.removeClass('unread');
        }).fail(function(err){ console.error("❌ markRead fail", err); });
    }

    /* =====================================
       BIND CLICK USER
    ===================================== */
    function bindUserClicks() {
        $('.chat-user').off('click').on('click', function(e){
            e.preventDefault();
            openSession($(this).data('session-id'), $(this));
        });

        $('.chat-user-mobile').off('click').on('click', function(e){
            e.preventDefault();
            const sid = $(this).data('session-id');
            try { bootstrap.Offcanvas.getInstance($('#chat-sidebar')[0])?.hide(); } catch(e){}
            openSession(sid, $(this));
        });
    }

    function getMessageContainer() { 
        return $('#admin-chat-body'); 
    }

    /* =====================================
       OPEN SESSION
    ===================================== */
    $('#admin-chat-input').prop('readonly', true);

    function openSession(sessionId, $el, markReadOnOpen = true){
        if(markReadOnOpen){
            markRead(sessionId);
            $el.data('unread', 0);
            $el.find('.chat-unread-badge').hide();
            $el.removeClass('unread');
        }
        if(!sessionId) return;

        $('.chat-user, .chat-user-mobile').removeClass('active');
        $el.addClass('active');
        currentSession = sessionId;

        $('#admin-chat-input')
            .prop('readonly', false)
            .attr('placeholder', 'Nhập tin nhắn...')
            .focus();

        let chatName = $el.find('.chat-title').text().trim() 
                        || $el.find('h6').first().text().trim() 
                        || 'Khách';

        $('#current-chat-name').text(chatName);
        $('#no-chat-selected').hide();
        getMessageContainer().html('<div class="text-center text-muted p-4">Đang tải...</div>');

        loadMessages(sessionId);
        loadSessionImages(sessionId);
        markChatViewed(sessionId);
    }

    /* =====================================
       LOAD MESSAGES
    ===================================== */
    function loadMessages(sessionId){
    if(!sessionId) return;

    const container = getMessageContainer();
    // Kiểm tra xem user có đang ở gần cuối hay không
    const isNearBottom = (container[0].scrollHeight - container.scrollTop - container.outerHeight()) < 100;

    $.ajax({
        url: baseUrl + '/admin/chats/' + sessionId + '/messages',
        method: 'GET',
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    }).done(function(res){

        /* ==== HEADER ==== */
        if(res.session){
            const s = res.session;

            $('#current-chat-header').addClass('active');

            const customerName = s.customer_name || 'Khách';
            $('#customer-avatar-header').attr(
                'src',
                'https://ui-avatars.com/api/?name=' 
                    + encodeURIComponent(customerName) 
                    + '&background=random&size=48'
            );
            $('#current-chat-name').text(customerName);

            const statusEl = $('#customer-status');
            const indicatorEl = $('#customer-online-indicator').show();

            if(s.is_customer_online){
                statusEl.text('Đang hoạt động');
                indicatorEl.removeClass('bg-secondary').addClass('bg-success');
            } else {
                statusEl.text('Ngoại tuyến');
                indicatorEl.removeClass('bg-success').addClass('bg-secondary');
            }

            updateOnlineStatus(sessionId, s.is_customer_online);

            /* Admin hỗ trợ */
            if(s.assigned_admin_id){
                const ids = s.assigned_admin_id.split(',').map(id => parseInt(id.trim()));
                const names = [];

                ids.forEach(id =>{
                    const ad = res.admins.find(a=>a.admin_id===id);
                    if(ad) names.push(ad.admin_name);
                });

                if(names.length)
                    $('#assigned-admin-name').html('|&nbsp; &nbsp; Hỗ trợ bởi: ' + names.join(', ')).show();
                else
                    $('#assigned-admin-name').hide();
            } else {
                $('#assigned-admin-name').hide();
            }
        }

        /* ==== RENDER MESSAGES ==== */
        const previousScrollTop = container.scrollTop();
        const previousScrollHeight = container[0].scrollHeight;

        container.empty();

        if(!res.messages.length){
            container.html('<div class="text-center text-muted p-4">Chưa có tin nhắn</div>');
            return;
        }

        res.messages.forEach(m=>{
            const sideClass = m.is_admin ? 'justify-content-end' : 'justify-content-start';
            const bubbleClass = m.is_admin 
                ? 'p-2 bg-primary text-white rounded-2 d-inline-block'
                : 'p-2 bg-light rounded-2 d-inline-block text-dark';

            const $row = $('<div>').addClass('d-flex gap-3 mb-3 ' + sideClass);

            const d = new Date(m.created_at);
            const created = 
                d.toLocaleTimeString('vi-VN', {hour:'2-digit',minute:'2-digit',hour12:false})
                + ' ' +
                d.toLocaleDateString('vi-VN',{day:'2-digit',month:'2-digit',year:'2-digit'});

            let sender = m.is_admin 
                ? (m.admin_info?.admin_name || 'Admin') 
                : (res.session?.customer_name || 'Khách');

            let avatar = m.is_admin
                ? (
                    m.admin_info?.admin_avt && m.admin_info.admin_avt !== 'default-avatar.png'
                        ? (m.admin_info.admin_avt.startsWith('http')
                            ? m.admin_info.admin_avt
                            : baseUrl + '/public/backend/images/profile/' + m.admin_info.admin_avt
                          )
                        : baseUrl + '/public/backend/images/profile/avt_default.webp'
                )
                : 'https://ui-avatars.com/api/?name=' + sender + '&background=random&size=48';

            let contentHtml = '';
            if(m.message){
                contentHtml = escapeHtml(m.message);
            } else if(m.file_path){
                contentHtml = `
                    <img src="${baseUrl + '/public/chat/images/' + m.file_path}" 
                         style="max-width:180px;border-radius:8px;" />
                `;
            }

            const $msg = $('<div>').addClass('d-flex gap-2');

            if(!m.is_admin)
                $msg.append(`<img src="${avatar}" width="40" height="40" class="rounded-circle" />`);

            $msg.append(`
                <div class="d-flex flex-column gap-1">
                    <small class="text-muted" style="font-size:12px;">${sender} • ${created}</small>
                    <div class="${bubbleClass}" style="max-width:200px;">${contentHtml}</div>
                </div>
            `);

            if(m.is_admin)
                $msg.append(`<img src="${avatar}" width="40" height="40" class="rounded-circle" />`);

            $row.append($msg);
            container.append($row);
        });

        /* Cuộn xuống nếu user đang gần cuối */
        setTimeout(()=>{
            if(isNearBottom){
                container[0].scrollTop = container[0].scrollHeight;
            } else {
                // Giữ vị trí scroll cũ nếu đang đọc tin nhắn cũ
                const newScrollHeight = container[0].scrollHeight;
                container[0].scrollTop = previousScrollTop + (newScrollHeight - previousScrollHeight);
            }
        }, 50);

        /* Cập nhật sidebar */
        if(res.sessions){
            res.sessions.forEach(s=>{
                updateOnlineStatus(s.chat_session_id, s.is_customer_online);
                updateUnreadBadge(s.chat_session_id, s.unread || 0);
            });
        }

    });
}


    /* =====================================
        SEND MESSAGE
    ===================================== */
    function sendMessage(){
        const msg = $('#admin-chat-input').val().trim();
        if(!msg || !currentSession) return;

        $.ajax({
            url: baseUrl + '/admin/chats/' + currentSession + '/reply',
            method: 'POST',
            data: { message: msg },
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(()=>{
            $('#admin-chat-input').val('');
            loadMessages(currentSession);
        });
    }

    $('#admin-chat-send').on('click', sendMessage);

    $('#admin-chat-input').on('keydown', function(e){
        if(e.key === 'Enter' && !e.shiftKey){
            e.preventDefault();
            sendMessage();
        }
    });

    $('#admin-chat-input')
        .prop('readonly', true)
        .attr('placeholder','Chọn cuộc trò chuyện để nhập tin nhắn');

    /* =====================================
       AUTO REFRESH MESSAGES
    ===================================== */
    setInterval(()=>{
        if(currentSession) loadMessages(currentSession);
    }, 5000);

    /* =====================================
       INIT
    ===================================== */
    bindUserClicks();
    updateUnreadUI();

    const $first = $('#sessions-list').find('.chat-user').first();
    if($first.length) openSession($first.data('session-id'), $first, false);

    /* =====================================
       HELPERS
    ===================================== */
    function escapeHtml(text){
        return String(text).replace(/[&"'<>]/g, c=>({
            '&':'&amp;','"':'&quot;',"'":'&#39;','<':'&lt;','>':'&gt;'
        })[c]);
    }

    function updateUnreadUI(){
        $('.chat-user').each(function(){
            const unread = parseInt($(this).data('unread')) || 0;
            const badge = $(this).find('.chat-unread-badge');
            if(unread>0){
                badge.text(unread).show();
                $(this).addClass('unread');
            } else {
                badge.hide();
                $(this).removeClass('unread');
            }
        });
    }

    function updateUnreadBadge(sessionId, unread){
        const item = $('.chat-user[data-session-id="'+sessionId+'"]');
        item.data('unread', unread);
        const badge = item.find('.chat-unread-badge');

        if(unread>0){
            badge.text(unread).show();
            item.addClass('unread');
        } else {
            badge.hide();
            item.removeClass('unread');
        }
    }

    function updateOnlineStatus(sessionId, isOnline){
        const item = $('.chat-user[data-session-id="'+sessionId+'"]');
        const indicator = item.find('.customer-online-indicator');
        indicator.toggleClass('bg-success', !!isOnline);
        indicator.toggleClass('bg-secondary', !isOnline);
    }
    function markChatViewed(sessionId) {
    delete unreadToNotify[sessionId];
}
    /* =====================================
       SIDEBAR REFRESH + SOUND + NOTIFY
    ===================================== */
    let chatSound = document.getElementById('chat-sound');
    if(!chatSound){
        chatSound = new Audio('{{ asset("/sounds/new-message.mp3") }}');
        chatSound.preload = 'auto';
    }

    let lastUnreadCounts = {};

    // GLOBAL an toàn
    window.unreadToNotify = window.unreadToNotify || {};

    let originalTitle = document.title;
    let titleInterval = null;
    const desktopNotifyInterval = 15000;

    function unlockInteraction(){
        chatSound.play()
            .then(()=> {
                chatSound.pause();
                chatSound.currentTime = 0;
            })
            .catch(()=>{});

        document.removeEventListener('click', unlockInteraction);
        document.removeEventListener('keydown', unlockInteraction);
        document.removeEventListener('scroll', unlockInteraction);

        if(Notification.permission === "default"){
            try {
                Notification.requestPermission().catch(()=>{});
            } catch(e){}
        }
    }

    document.addEventListener('click', unlockInteraction);
    document.addEventListener('keydown', unlockInteraction);
    document.addEventListener('scroll', unlockInteraction);

    function startTitleBlink(unread){
        if(titleInterval) clearInterval(titleInterval);
        let show = true;
        titleInterval = setInterval(()=>{
            document.title = show ? `(${unread}) ${originalTitle}` : originalTitle;
            show = !show;
        }, 1000);
    }
    function stopTitleBlink(){
        if(titleInterval) clearInterval(titleInterval);
        titleInterval = null;
        document.title = originalTitle;
    }

    function showDesktopNotification(sessionId, title, message, icon){
        if(Notification.permission !== "granted") return;

        const n = new Notification(title,{
            body:message,
            icon:icon || '{{ asset("public/frontend/images/favicon.ico") }}',
            tag:'chat-'+sessionId,
            renotify:true
        });
        n.onclick = ()=> window.focus();
    }

    /* =====================================
       SIDEBAR REFRESH
    ===================================== */
    setInterval(()=>{
        $.ajax({
            url: baseUrl + '/admin/chats/sidebar',
            method:'GET',
            dataType:'json'
        }).done(res=>{
            if(!res.sessions) return;

            let totalUnread = 0;
            const now = Date.now();

            res.sessions.forEach(s=>{
                const item = $('.chat-user[data-session-id="'+s.chat_session_id+'"]');
                if(!item.length) return;

                let lastMsg = s.last_message || (s.last_file_path ? 'Ảnh' : '-');
                item.find('.text-truncate').text(lastMsg);
                item.find('.fs-2').text(s.last_at);

                const ind = item.find('.customer-online-indicator');
                ind.toggleClass('bg-success', !!s.is_customer_online);
                ind.toggleClass('bg-secondary', !s.is_customer_online);

                const badge = item.find('.chat-unread-badge');
                const prevUnread = lastUnreadCounts[s.chat_session_id] || 0;

                if(s.unread > 0){
                    badge.text(s.unread).show();
                    item.addClass('unread');
                    totalUnread += s.unread;

                    if(!window.unreadToNotify[s.chat_session_id]){
                        window.unreadToNotify[s.chat_session_id] = {
                            count:s.unread,
                            message:lastMsg,
                            icon:item.find('img').attr('src'),
                            lastNotify:0
                        };
                    } else {
                        window.unreadToNotify[s.chat_session_id].count = s.unread;
                        window.unreadToNotify[s.chat_session_id].message = lastMsg;
                    }
                }
                else {
                    badge.hide();
                    item.removeClass('unread');
                    delete window.unreadToNotify[s.chat_session_id];
                }

                lastUnreadCounts[s.chat_session_id] = s.unread;
            });

            if(totalUnread > 0) startTitleBlink(totalUnread);
            else stopTitleBlink();

            /* Lặp âm thanh + desktop notify */
            Object.keys(window.unreadToNotify).forEach(id=>{
                chatSound.currentTime = 0;
                chatSound.play().catch(()=>{});

                const info = window.unreadToNotify[id];
                if(now - info.lastNotify > desktopNotifyInterval){
                    showDesktopNotification(id, 'Tin nhắn mới', info.message, info.icon);
                    info.lastNotify = now;
                }
            });
             if (currentSession) {
                loadSessionImages(currentSession);
            }
        }).fail(err=> console.error("Sidebar refresh error", err));
    }, 5000);

    // Khi admin mở session
    $(document).on('click','.chat-user',function(){
        const id = $(this).data('session-id');
        if(window.unreadToNotify[id]) delete window.unreadToNotify[id];
    });

    /* =====================================
       IMAGE PREVIEW + SEND
    ===================================== */
    let selectedImageFile = null;

    $('#admin-chat-add-image').on('click', function(e){
        e.preventDefault();
        $('#admin-chat-file').trigger('click');
    });

    $('#admin-chat-file').on('change', function(){
        const f = this.files[0];
        if(!f) return;

        selectedImageFile = f;

        const r = new FileReader();
        r.onload = e=>{
            $('#chat-image-popup-preview').attr('src', e.target.result);
            $('#chat-image-popup').show();
        };
        r.readAsDataURL(f);
    });

    $('#chat-image-send').on('click', function(){
        if(!selectedImageFile || !currentSession) return;

        const fd = new FormData();
        fd.append('image', selectedImageFile);
        fd.append('chat_session_id', currentSession);

        $.ajax({
            url: baseUrl + '/admin/chats/' + currentSession + '/send-image',
            method:'POST',
            data:fd,
            processData:false,
            contentType:false,
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
        }).done(()=>{
            selectedImageFile = null;
            $('#chat-image-popup').hide();
            $('#admin-chat-file').val('');
            loadMessages(currentSession);
        });
    });

    $('#chat-image-cancel').on('click', function(){
        selectedImageFile = null;
        $('#admin-chat-file').val('');
        $('#chat-image-popup').hide();
    });

    /* Ảnh trong chat -> zoom */
    $('#admin-chat-body').on('click','img',function(){
        const src = $(this).attr('src');
        if(!src) return;

        $('#chat-image-zoom-img').attr('src', src);
        $('#chat-image-zoom').css('display','flex');
    });

    $('#chat-image-zoom-close, #chat-image-zoom').on('click', function(e){
        if(e.target.id === 'chat-image-zoom' || e.target.id === 'chat-image-zoom-close'){
            $('#chat-image-zoom').hide();
            $('#chat-image-zoom-img').attr('src','');
        }
    });

    function loadSessionImages(sessionId){
        if(!sessionId) return;

        $.ajax({
            url: baseUrl + '/admin/chats/' + sessionId + '/messages',
            method:'GET',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
        }).done(res=>{
            const container = $('.offcanvas-body .row');
            container.empty();

            if(!res.images.length){
                container.html('<div class="text-muted p-2">Chưa có hình ảnh nào</div>');
                $('.fw-semibold span').text('(0)');
                return;
            }

            res.images.forEach(img=>{
                const col = $(`
                    <div class="col-6 px-1 mb-2">
                        <img src="${baseUrl + '/public/chat/images/' + img.file_path}" 
                             width="88" 
                             height="65" 
                             class="rounded cursor-pointer" />
                    </div>
                `);
                container.append(col);
            });

            $('.fw-semibold span').text(`(${res.images.length})`);

            container.find('img').off('click').on('click', function(){
                $('#image-preview-img').attr('src', $(this).attr('src'));
                $('#image-preview-overlay').css('display','flex');
            });
        });
    }

    $('#image-preview-close, #image-preview-overlay').on('click', function(e){
        if(e.target.id === 'image-preview-overlay' || e.target.id === 'image-preview-close'){
            $('#image-preview-overlay').hide();
            $('#image-preview-img').attr('src','');
        }
    });

}); // END $(function)
</script>



@endpush

@endsection

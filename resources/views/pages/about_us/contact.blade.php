@extends('layout')
@section('content')
<!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIRVRmGEqK5o0DEjK_5jGzN-x8iEMwHGo&libraries=marker" defer></script>
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap">

                <!-- Breadcrumb list -->
                <div class="tf-breadcrumb-list">
                    <a href="{{ URL::to('/trang-chu') }}" class="text text-caption-1">
                        Trang chủ
                    </a>
                    <i class="icon icon-arrRight"></i>

                    <span class="text text-caption-1">
                        Liên hệ
                    </span>
                </div>

                <!-- Breadcrumb actions (prev / back / next) -->
                <div class="tf-breadcrumb-prev-next">
                    <a href="{{ url()->previous() }}" class="tf-breadcrumb-prev" title="Quay lại">
                        <i class="icon icon-arrLeft"></i>
                    </a>

                    <a href="{{ URL::to('/trang-chu') }}" class="tf-breadcrumb-back" title="Trang chủ">
                        <i class="icon icon-squares-four"></i>
                    </a>

                    <a href="{{ URL::to('/san-pham') }}" class="tf-breadcrumb-next d-none d-md-flex" title="Xem sản phẩm">
                        <i class="icon icon-arrRight"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
    <style>
        .map-section {
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
           
            padding: 15px;
        }

        .mapouter,
        .gmap_canvas,
        .map-section iframe {
            width: 100%;
            max-width: 100%;
            height: 500px;
            border: 0;
            display: block;
        }

        .contact-us-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: stretch;
            /* QUAN TRỌNG: kéo 2 cột bằng chiều cao */
        }

        .contact-us-content>.left,
        .contact-us-content>.right {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .contact-us-content {
                grid-template-columns: 1fr!important;
            }
            .form-leave-comment>.wrap {
                margin-bottom: 0px!important;
            }
            .send-wrap {
                margin-top: 0px!important;
                padding-bottom: 20px;
        border-bottom: 1px solid var(--line);
            }
			 .map-section {
            width: 100%;
            max-width: 100vw;
			    height: 38vh;
            overflow: hidden;
            background: #e3e3e3;
            padding: 15px;
        }

        .mapouter,
        .gmap_canvas,
        .map-section iframe {
            width: 100%;
            max-width: 100%;
                height: 36vh;
            border: 0;
            display: block;
        }
        }

        .opening-hours {
            display: grid;
            grid-template-columns: max-content max-content;
            /* không kéo giãn */
            column-gap: 40px;
            /* khoảng cách giữa thứ và giờ */
            row-gap: 8px;
            align-items: center;
        }

        .opening-hours .day {
            color: #2b2b2b;
            font-weight: 700;
            font-size: 16px;
            white-space: nowrap;
        }

        .opening-hours .time {
            color: #2b2b2b;
            font-size: 16px;
            white-space: nowrap;
        }
    </style>
    <!-- ...::::Start Map Section:::... -->
    <div class="map-section">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.79834787987!2d106.66668267858839!3d10.7655331981231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ee6f6b820fb%3A0x1b5c7e7f61f3d3b7!2sHuy%20Ph%C3%A1t%20Electronics!5e0!3m2!1svi!2s!4v1727427848955!5m2!1svi!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div> <!-- ...::::End  Map Section:::... -->
    <!-- contact-us -->
    <div class="flat-spacing" style=" padding: 60px 0;">
        <div class="container">
            <div class="contact-us-content"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
                <div class="left">
                    <h4 style="color: #2b2b2b; font-size: 36px; font-weight: 700; margin-bottom: 15px;">Liên hệ với chúng tôi
                    </h4>
                    <p class="text-secondary-2" style="color: #2b2b2b; font-size: 16px; margin-bottom: 30px;">Sử dụng biểu
                        mẫu bên dưới để liên hệ với đội bán hàng</p>
                    <form id="contactform"
                        action="https://script.google.com/macros/s/AKfycbygkRrCZtb4u8LKMyF-kBXDFXpDvvUyBj0CMxsxVoHJ9l2YQ_a_0SxIQFXwedcv7Zg/exec"
                        method="POST" class="form-leave-comment" onsubmit="return handleSubmit(event)">
                        <div class="wrap">
                            <div class="cols">
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Tên của bạn*" name="name" id="name"
                                        tabindex="2" value="" aria-required="true" required=""
                                        style=" color: #2b2b2b; border: 1px solid #444; padding: 12px 15px; font-size: 16px;">
                                </fieldset>
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Email của bạn*" name="email" id="email"
                                        tabindex="2" value="" aria-required="true" required=""
                                        style=" color: #2b2b2b; border: 1px solid #444; padding: 12px 15px; font-size: 16px;">
                                </fieldset>
                            </div>
                            <fieldset class="">
                                <textarea name="message" id="message" rows="5" placeholder="Tin nhắn của bạn*" tabindex="2"
                                    aria-required="true" required=""
                                    style="color: #2b2b2b; border: 1px solid #444; padding: 12px 15px; font-size: 16px;"></textarea>
                            </fieldset>
                        </div>
                        <div class="button-submit send-wrap">
                            <button class="tf-btn btn-fill" type="submit"
                                style="padding: 14px 40px; font-size: 16px; font-weight: 600;">
                                <span class="text text-button">Gửi tin nhắn</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="right" style="padding-top: 0;">
                    <h4 style="color: #2b2b2b; font-size: 36px; font-weight: 700; margin-bottom: 30px;">Thông tin</h4>
                    <div class="mb_20">
                        <div class="text-title mb_8"
                            style="color: #2b2b2b; font-weight: 700; font-size: 18px; margin-bottom: 12px;">Điện thoại:</div>
                        <p class="text-secondary" style="color: #2b2b2b; font-size: 16px; margin-bottom: 8px;">
                            <a href="zalo://conversation?phone=0963620629"
                                style="color: #64b5f6; text-decoration: none;">0963 620 629 (Ms. Trang)</a>
                        </p>
                        <p class="text-secondary" style="color: #2b2b2b; font-size: 16px; margin-bottom: 8px;">
                            <a href="zalo://conversation?phone=0975999628"
                                style="color: #64b5f6; text-decoration: none;">0866 638 328 (Ms. Thúy)</a>
                        </p>
                        <p class="text-secondary" style="color: #2b2b2b; font-size: 16px;">
                            <a href="tel:02866830388" style="color: #64b5f6; text-decoration: none;">(028) 6683 0388 (Ms.
                                Chi)</a>
                        </p>
                    </div>
                    <div class="mb_20">
                        <div class="text-title mb_8"
                            style="color: #2b2b2b; font-weight: 700; font-size: 18px; margin-bottom: 12px;">Email:</div>
                        <p class="text-secondary" style="font-size: 16px;"><a
                                href="https://mail.google.com/mail/?view=cm&to=hotro@huyphatelectronics.com" target="_blank"
                                style="color: #64b5f6; text-decoration: none;">hotro@huyphatelectronics.com</a></p>
                    </div>
                    <div class="mb_20">
                        <div class="text-title mb_8"
                            style="color: #2b2b2b; font-weight: 700; font-size: 18px; margin-bottom: 12px;">Địa chỉ:</div>
                        <p class="text-secondary" style="font-size: 16px;"><a
                                href="https://maps.app.goo.gl/WJgHzY75Ni3DRrcZA" target="_blank"
                                style="color: #64b5f6; text-decoration: none;">444 Nguyễn Tri Phương, Phường Vườn Lài, TP. Hồ Chí Minh, Việt Nam.</a></p>
                    </div>
                    <div>
                        <div>
                            <div class="text-title mb_8"
                                style="color: #2b2b2b; font-weight: 700; font-size: 18px; margin-bottom: 12px;">Giờ hoạt động:
                            </div>

                            <div class="opening-hours">
                                <div class="day">Thứ 2 - Thứ 7</div>
                                <div class="time">8:00am - 6:00pm</div>

                                <div class="day">Chủ nhật</div>
                                <div class="time">9:00am - 5:00pm</div>
                            </div>
                        </div>

                        <!-- Start Contact Social Link -->
                        <div class="contact-social" style="margin-top: 30px;">
                            <h5 style="color: #2b2b2b; font-size: 18px; font-weight: 700; margin-bottom: 15px;">Theo dõi chúng
                                tôi</h5>
                            <ul class="tf-social-icon style-fill style-fill-2 justify-content-start" style="gap:24px">
                                <li><a href="https://www.facebook.com/unitekvn/" class="social-facebook"
                                        style="width:42px;height:42px"><i class="icon icon-fb"
                                            style="color: #2b2b2b; font-size: 24px;"></i></a></li>
                                <li><a href="https://www.instagram.com/unitek_official" class="social-instagram"
                                        style="width:42px;height:42px"><i class="icon icon-instagram"
                                            style="color: #2b2b2b; font-size: 24px;"></i></a></li>
                                <li><a href="https://www.tiktok.com" class="social-tiktok" style="width:42px;height:42px"><i
                                            class="icon icon-tiktok" style="color: #2b2b2b; font-size: 24px;"></i></a></li>
                            </ul>
                        </div> <!-- End Contact Social Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- /contact-us -->

@endsection
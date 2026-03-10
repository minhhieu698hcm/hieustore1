@extends('layout')
@section('content')
@push('styles')
      <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins.css') }}">
      <link rel="stylesheet" href="{{ asset('public/frontend/css/about-us.css') }}">
@endpush
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
                        Giới thiệu
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
    <!-- HERO -->
	<div class="grax_tm_hero" id="home">
		<div class="bg">
			<div class="image" data-img-url="{{ asset('public/upload/banner_hero/background-about-us.png') }}"></div>
			<div class="particle_wrapper">
				<div id="particles-js"></div>
			</div>
			<div class="overlay"></div>
		</div>
		<div class="content">
			<div class="container">
				<div class="details" data-animation="scale"> <!-- Animation Values: toTop, toRight, scale, rotate -->
					<h3 class="fn_animation name">UNITEK Việt Nam</h3>
					<span class="fn_animation job">Về chúng tôi</span>
				</div>
			</div>
		</div>
	</div>
	<!-- /HERO -->
    <!-- ...::::Start About Us Top Section:::... -->
    <div class="about-us-top-area section-top-gap-100" style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-12" style="display: inline-block;text-align: center;">
                    <div class="about-us-top-img" data-aos="fade-up" data-aos-delay="0"  data-aos-duration="300">
                        <img class="img-fluid" src="{{ asset('public/frontend/images/logo/unitek.webp') }}" alt=""
                            style="width:250px">
                    </div>
                </div>
                <div class="about-us-top-content text-center" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="300">
                    <p style="font-size: 18px;color:#2b2b2b;padding: 0 60px !important;text-align: justify;">Unitek tạo nên sự đa dạng của
                        các sản phẩm, từ cáp và bộ chia USB đến các giải pháp lưu trữ , chuyển đổi hình ảnh, âm thanh và
                        sạc. Unitek mang đến cho người dùng một trải nghiệm mua sắm đa dạng và thuận tiện. Đặt mục tiêu tạo
                        ra công nghệ thông minh, linh hoạt và an toàn để đáp ứng những nhu cầu phức tạp của bạn, giúp bạn
                        vượt qua giới hạn và thỏa mãn ham muốn và tham vọng của mình mỗi ngày.
                        Từ năm 2001, Unitek đã cam kết phát triển các sản phẩm mang tính thân thiện với con người, giúp mọi
                        người khai thác tối đa tiềm năng của bản thân. Khách hàng của Unitek bao gồm doanh nghiệp, chính
                        phủ, trường học và người dùng cá nhân sử dụng các sản phẩm công nghệ của Unitek tại hơn 70 quốc gia
                        trên toàn thế giới.
                        Unitek mong muốn hướng tới một mục tiêu đơn giản: tạo ra công nghệ hữu ích và nhận thức, giải quyết
                        trực tiếp những vấn đề phức tạp của con người, để họ có thể phát triển và trở thành phiên bản tốt
                        nhất của chính mình.</p>
                </div>
            </div>
        </div>
    </div> <!-- End About Us Top Section:::... -->
    <!-- ...::::Start About Us Center Section:::... -->
    <div class="about-us-center-area section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-center-content text-center">
                        <h4 data-aos="fade-up" data-aos-delay="0" data-aos-duration="300" style="font-size: 42px; font-weight: 700; color: #2b2b2b; margin-bottom: 50px;">Tại sao nên chọn chúng tôi?</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col-lg-3 col-md-3 about-us-4-items">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item text-center" data-aos="fade-up" data-aos-delay="0" data-aos-duration="300" style="padding: 40px 30px; border-radius: 16px; transition: all 0.3s ease; border: 1px solid #444; height: 100%; margin-bottom: 20px;">
                        <i class="fa-solid fa-truck-fast" style="font-size: 60px; color: #ff6b6b; margin-bottom: 25px; display: block;"></i>
                        <h6 style="font-size: 18px; font-weight: 700; color: #2b2b2b; margin-bottom: 12px; line-height: 1.4;">Giao hàng nhanh chóng</h6>
                        <p style="font-size: 15px; color: #424242; margin: 0; line-height: 1.6;">Luôn giao đến cho bạn một cách nhanh nhất</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
                <div class="col-lg-3 col-md-3 about-us-4-items">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item text-center" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="300" style="padding: 40px 30px; border-radius: 16px; transition: all 0.3s ease; border: 1px solid #444; height: 100%; margin-bottom: 20px;">
                        <i class="fa-solid fa-users-gear" style="font-size: 60px; color: #4ecdc4; margin-bottom: 25px; display: block;"></i>
                        <h6 style="font-size: 18px; font-weight: 700; color: #2b2b2b; margin-bottom: 12px; line-height: 1.4;">Hỗ trợ khách hàng</h6>
                        <p style="font-size: 15px; color: #424242; margin: 0; line-height: 1.6;">Đội ngũ hỗ trợ trực tuyến chuyên nghiệp</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
                <div class="col-lg-3 col-md-3 about-us-4-items">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item text-center" data-aos="fade-up" data-aos-delay="100"  data-aos-duration="300" style="padding: 40px 30px;border-radius: 16px; transition: all 0.3s ease; border: 1px solid #444; height: 100%; margin-bottom: 20px;">
                        <i class="fa-solid fa-gifts" style="font-size: 60px; color: #ffe66d; margin-bottom: 25px; display: block;"></i>
                        <h6 style="font-size: 18px; font-weight: 700; color: #2b2b2b; margin-bottom: 12px; line-height: 1.4;">Ưu đãi mua sắm</h6>
                        <p style="font-size: 15px; color: #424242; margin: 0; line-height: 1.6;">Luôn có chương trình ưu đãi hàng tháng</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
                <div class="col-lg-3 col-md-3 about-us-4-items">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item text-center" data-aos="fade-up" data-aos-delay="150"  data-aos-duration="300" style="padding: 40px 30px;  border-radius: 16px; transition: all 0.3s ease; border: 1px solid #444; height: 100%; margin-bottom: 20px;">
                        <i class="fa-solid fa-award" style="font-size: 60px; color: #a8e6cf; margin-bottom: 25px; display: block;"></i>
                        <h6 style="font-size: 18px; font-weight: 700; color: #2b2b2b; margin-bottom: 12px; line-height: 1.4;">Chứng nhận chất lượng</h6>
                        <p style="font-size: 15px; color: #424242; margin: 0; line-height: 1.6;">Luôn mang đến cho bạn nhưng món hàng chất lượng nhất</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
            </div>
        </div>
    </div> <!-- ...::::End  About Us Center Section -->

    <!-- ...::::Start About Us Bottom Section:::... -->
    <div class="about-us-bottom-area section-top-gap-100" style="padding: 80px 0;">
        <section class="about-container">
        <div class="about-grid">
            
            <div class="about-item aa">
                <div class="about-item-info ">
                    <div class="about-item-title c-48 red" _msttexthash="2584231" _msthash="183">Chúng tôi làm gì?</div>
                    <div style="white-space: pre-wrap;" class="about-item-desc c-inter-regu-21" _msttexthash="450830848" _msthash="184"><p style="font-size:18px"><strong>Unitek</strong> mang đến cho người dùng một trải nghiệm mua sắm đa dạng và thuận tiện. Đặt mục tiêu tạo ra công nghệ thông minh, linh hoạt và an toàn để đáp ứng những nhu cầu phức tạp của bạn, giúp bạn vượt qua giới hạn và thỏa mãn ham muốn và tham vọng của mình mỗi ngày.</p></div>
                </div>
            </div>
            <div class="about-item bb about-type-img">
                <div class="about-item-img flex-end">
                    <img 
                        src="{{ asset('public/frontend/images/banner/about_1.webp') }}" 
                        alt="UNITEK About Us"
                    >
                </div>
            </div>

            
            <div class="about-item aa">
                <div class="about-item-info ">
                    <div class="about-item-title c-48 red" _msttexthash="2912546" _msthash="185">Sứ mệnh của chúng tôi</div>
                    <div style="white-space: pre-wrap;" class="about-item-desc c-inter-regu-21" _msttexthash="1445816203" _msthash="186"><p style="font-size:18px"><strong>Unitek</strong> mong muốn hướng tới một mục tiêu đơn giản: tạo ra công nghệ hữu ích và nhận thức, giải quyết trực tiếp những vấn đề phức tạp của con người, để họ có thể phát triển và trở thành phiên bản tốt nhất của chính mình.</p></div>
                </div>
            </div>
            <div class="about-item bb about-type-img reverse">
                <div class="about-item-img flex-end">
                    <img 
                        src="{{ asset('public/frontend/images/banner/about_2.webp') }}" 
                        alt="UNITEK About Us"
                    >
                </div>
            </div>
            
            <div class="about-item aa">
                <div class="about-item-info ">
                    <div class="about-item-title c-48 red" _msttexthash="6487754" _msthash="187">Lịch sử của chúng tôi</div>
                    <div style="white-space: pre-wrap;" class="about-item-desc c-inter-regu-21" _msttexthash="2761754060" _msthash="188"><p style="font-size:18px">Từ năm 2001, <strong>Unitek</strong> đã cam kết phát triển các sản phẩm mang tính thân thiện với con người, giúp mọi người khai thác tối đa tiềm năng của bản thân. Khách hàng của Unitek bao gồm doanh nghiệp, chính phủ, trường học và người dùng cá nhân sử dụng các sản phẩm công nghệ của Unitek tại hơn 70 quốc gia trên toàn thế giới.</p></div>
                </div>
            </div>
            <div class="about-item bb about-type-img">
                <div class="about-item-img flex-end">
                   <img 
                        src="{{ asset('public/frontend/images/banner/about_3.webp') }}" 
                        alt="UNITEK About Us"
                    >
                </div>
            </div>
            
        </div>
        
        <!--Giới thiệu huy phát electronics-->
    <div class="container" style="background-color: rgb(233, 230, 230); border-radius: 30px;margin-top:50px">
        <div class="row">
            <div class="col-md-6" style="text-align: justify;padding-right:30px">
                <p class="text-bold mb-0" style="font-size: 30px; padding-top: 30px;color:#2b2b2b">GIỚI THIỆU VỀ UNITEK VIỆT NAM</p>
                <img src="public/frontend/images/home/gach.ngang.png" alt="" class="mb-3">
                <p style="font-size: 20px;color:#2b2b2b"><strong class="text-bold">Huy Phát Electronics</strong> là nhà phân phối độc
                    quyền các sản phẩm Unitek tại Việt Nam, mang đến cho khách hàng đa dạng giải pháp kết nối và truyền dữ
                    liệu tiên tiến.</p>
                <p style="font-size: 20px;color:#2b2b2b">Với hơn 20 năm kinh nghiệm tại thị trường Việt Nam, <strong
                        class="text-bold">Huy Phát Electronics</strong> cam kết cung cấp các sản phẩm Unitek chính hãng,
                    chất lượng cao</p>
                <p style="font-size: 20px;color:#2b2b2b"><strong class="text-bold">Huy Phát Electronics</strong> cùng dịch vụ khách
                    hàng chuyên nghiệp, tận tâm. Mong muốn sẽ đem đến trải nghiệm mua hàng cho khách hàng tốt nhất có thể
                </p>
        <p class="text-center text-bold" style="font-size: 28px; color: red;padding-top:20px;">HUY PHÁT ELECTRONICS</p>
        <p class="text-center text-bold mt-3" style="font-size: 25px;color:#2b2b2b">450 NGUYỄN TRI PHƯƠNG PHƯỜNG 4 QUẬN 10</p>
            </div>
			
            <div class="col-md-6 position-relative">
                <img src="{{ asset('public/frontend/images/banner/congty.webp') }}" height="500"
                    style="border-radius: 20px;" alt="">
            </div>
        </div>
		
    </div>
    
    <!--Giới thiệu huy phát electronics-->
    <hr style="color:#2b2b2b">
    <div class="container mb-5">
        <p class="text-bold text-center" style="font-size: 40px;color:#2b2b2b">Trải nghiệm mua sắm </p>
        <div class="row justify-content-center" style="">
            <div class="col-md-5">
                <img class="img-zoom" src="{{ asset('public/frontend/images/banner/maphuyphat.webp') }}" height="500"
                    width="70%" style="padding-left: 120px;padding-top:50px;" alt="">
                <div class="row mt-4" style="background-color: rgb(238, 238, 238);border-radius:10px;">
                    <p style="font-size:40px;padding-top:30px;color:rgb(253, 7, 7);" class="text-bold bold">MUA TRỰC TIẾP
                        TẠI</p>
                    <hr style="color:#ff0000;width:100%;margin-top:10px">
                    <div class="row mb-4">
                        <p class="text-bold mt-3" style="font-size: 30px;padding-left:40px;color:#2b2b2b">HUY PHÁT ELECTRONICS</p>
                    </div>
                    <div class="col-md-2 mb-4" style="padding-left:40px;"> <i class="fa-solid fa-map-location-dot"
                            style="padding-top: 20px;font-size: 30px;color:#2b2b2b"></i></div>
                    <div class="col-md-9 mb-4">
                        <p class="text-bold mt-2" style="font-size: 20px;color:#2b2b2b">
                            <a href="https://maps.app.goo.gl/RQNcBJSZim1AiBR78" target="_blank"
                                style="text-decoration: none;color:#2b2b2b">
                                444 Nguyễn Tri Phương, Phường Vườn Lài, TP. Hồ Chí Minh, Việt Nam.
                            </a>
                        </p>
                    </div>
                    <a href="{{ URL::to('/lien-he') }}" class="mb-3 mt-3">
                        <img src="{{ asset('public/frontend/images/banner/vitri.webp') }}"
                            style="height: 90px;width:80%;padding-left:90px;" class="mb-4 blinking" alt="">
                    </a>
                </div>
            </div>

            <div class="col-md-5" style="padding-left: 50px;">
                <img class="img-zoom" src="{{ asset('public/frontend/images/banner/phoneweb.webp') }}" height="500"
                    width="100%" style=";padding-top:50px;" alt="">
                <div class="row" style="background-color: rgb(238, 238, 238);border-radius:10px;margin-top: 33px !important;">
                    <p style="font-size:40px;padding-top:30px;color:red;" class="text-bold">LIÊN HỆ MUA ONLINE</p>
                    <hr style="color:#ff0000;width:100%;margin-top:10px">
                    <div class="row" style="margin-bottom: 10px;">
                        <p class="text-bold mt-3" style="font-size: 30px;padding-left:40px;color:#2b2b2b">WEBSITE</p>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 2px;">
                        <i class="fa-solid fa-earth-americas"
                            style="font-size: 30px;padding-left:40px;padding-top: 10px;color:#2b2b2b"></i>
                    </div>
                    <div class="col-md-9" style="margin-bottom: 2px;">
                        <p class="text-bold mt-2" style="font-size: 20px;">
                            <a href="https://unitekvn.com" target="_blank" style="text-decoration: none;color:#2b2b2b">
                                unitekvn.com
                            </a>
                        </p>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 2px;">
                        <i class="fa-solid fa-earth-americas"
                            style="font-size: 30px;padding-left:40px;padding-top: 10px;color:#2b2b2b"></i>
                    </div>
                    <div class="col-md-9" style="margin-bottom: 2px;">
                        <p class="text-bold mt-2" style="font-size: 20px;">
                            <a href="https://huyphatelectronics.com" target="_blank" style="text-decoration: none;color:#2b2b2b">
                                huyphatelectronics.com
                            </a>
                        </p>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 2px;">
                        <i class="fa-solid fa-phone"style="font-size: 30px;padding-left:40px;padding-top: 10px;color:#2b2b2b"></i>
                    </div>
                    <div class="col-md-9" style="margin-bottom: 2px;">
                        <p class="text-bold mt-2" style="font-size: 20px;">
                            <a href="zalo://conversation?phone=0926148168" style="text-decoration: none;color:#2b2b2b">0926.148.168</a>
                        </p>
                    </div>
                    <a href="" class="" style="margin-bottom: 2px;">
                        <img src="{{ asset('public/frontend/images/banner/phone-call.webp') }}"
                            style="height: 90px;width:80%;padding-left:90px;" class="mb-4 blinking" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    </section>
    </div> <!-- ...::::End  About Us Bottom Section:::... -->
    <section class="bottom-bg" style="margin-top:30px">
            <img 
                        src="{{ asset('public/upload/banner_hero/banner-1.webp') }}" 
                        alt="UNITEK About Us"
                    >
        </section>
 @push('scripts')
  <script src="{{ asset('public/frontend/js/plugins.js') }}" defer></script>
@endpush
    <script>
document.querySelectorAll('[data-img-url]').forEach(el => {
    el.style.backgroundImage = `url(${el.getAttribute('data-img-url')})`;
});
</script>


@endsection

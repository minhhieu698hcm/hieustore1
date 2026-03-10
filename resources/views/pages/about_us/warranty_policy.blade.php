@extends('layout')
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div
                        class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">CHÍNH SÁCH BẢO HÀNH</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{URL::to('https://unitekvn.com/')}}">Trang chủ</a></li>
                                    <li class="active" aria-current="page">Chính sách bảo hành</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...::::Start Privacy Policy  Section:::... -->
    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="faq-content" data-aos="fade-up" data-aos-delay="0">
                    </div>
                </div>
            </div>
            <div class="faq-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="faq-accordian">
                            <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="0">
                                <input id="item-1" name="accordian-item" type="checkbox" >
                                <label for="item-1">1. Chính sách Bảo hành</label>
                                <div class="item-content">
                                    <p>1.1 Toàn bộ sản phẩm Unitek như cáp HDMI, Hub, Switch, Bộ chuyển, vv. chuột đều được
                                        bảo hành 18 tháng lỗi nhà sản xuất.</p>
                                    <p>1.2 Đổi mới hoàn toàn cho tất cả sản phẩm Unitek có tem của nhà cung cấp (Công Ty
                                        TNHH Huy Phát Electronics) và còn thời hạn bảo hành.</p>
                                    <p>1.3 Phí ship gửi đến trung tâm bảo hành sẽ do Quý khách hàng thanh toán, và phí ship
                                        trả hàng đến Quý khách sẽ do trung tâm bảo hành đảm nhận.</p>
                                    <p>1.4 Đối với tất cả sản phẩm Unitek do CÔNG TY HUY PHÁT ELECTRONICS bán ra cần bảo
                                        hành vui lòng gửi về địa chỉ sau:</p>
                                    <p>Khu vực Miền Nam</p>
                                    <p>Thành phố Hồ Chí Minh</p>
                                    <a href="https://www.huyphatelectronics.com" target="_blank" style="font-weight: 500;">Công Ty TNHH Huy Phát Electronics</a>
                                    </br>
                                    <a>Số điện thoại bảo hành:</a><a href="tel:02866830388" style="font-weight: 500;">(028)
                                        6683 0388</a>
                                </div>
                            </div>
                            <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                <input id="item-2" name="accordian-item" type="checkbox" >
                                <label for="item-2">2. Điều kiện Bảo hành</label>
                                <div class="item-content">
                                    <p>Sản phẩm phải đáp ứng các điều kiện sau đây:</p>
                                    <p>2.1 Sản phẩm còn trong thời hạn bảo hành. (Thời hạn bảo hành được tính căn cứ theo
                                        hóa đơn bán hàng của CÔNG TY HUY PHÁT ELECTRONICS, có thể cộng thêm 30 ngày)</p>
                                    <p>2.2 Sản phẩm bị lỗi kỹ thuật hoặc khiếm khuyết thuộc trách nhiệm Nhà sản xuất và Nhà
                                        phân phối.</p>
                                    <p>2.3 Sản phẩm phải có tem bảo hành của nhà cung cấp (tem bảo hành của CÔNG TY HUY PHÁT
                                        ELECTRONICS)</p>
                                    <p>2.4 Số Serial/Imei/Service Tag trên sản phẩm phải còn nguyên vẹn và rõ nét. (Chỉ áp
                                        dụng nếu sản phẩm có dán đầy đủ thông tin trên)</p>
                                    <p>2.5 Tem bảo hành của nhà cung cấp (HUY PHÁT ELECTRONICS) phải còn nguyên vẹn (không
                                        rách, trầy, hoặc không có tem bảo hành của nhà cung cấp).</p>
                                </div>
                            </div>
                            <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="200">
                                <input id="item-3" name="accordian-item" type="checkbox" >
                                <label for="item-3">3. Từ chối Bảo hành</label>
                                <div class="item-content">
                                    <p>Các trường hợp không bảo hành:</p>
                                    <p>3.1 Bên bán có quyền từ chối bảo hành nếu sản phẩm không đáp ứng các tiêu chí về điều
                                        kiện bảo hành thuộc Mục 2.</p>
                                    <p>3.2 Khiếm khuyết mà bên mua đã biết hoặc phải biết khi mua;</p>
                                    <p>3.3 Bên mua có lỗi gây ra khuyết tật của sản phẩm.</p>
                                    <p>3.4 Sản phẩm, linh kiện, phụ kiện bị hư hỏng do rơi vỡ, cháy nỗ, đứt dây, trầy xước,
                                        sử dụng sai, hoặc sửa chữa, tháo lắp trái phép sản phẩm.</p>
                                    <p>3.5 Hao mòn thông thường. Trong bất kỳ trường hợp nào, việc bảo hành này sẽ không bao
                                        gồm việc thay thế hoặc bồi thường cho các sản phẩm Unitek do CÔNG TY HUY PHÁT
                                        ELECTRONICS được chứng nhận phân phối bán hàng.</p>
                                    <p>3.6 Sản phẩm không đủ điều kiện bảo hành hoặc vi phạm điều kiện bảo hành của nhà sản
                                        xuất như được điều cập ở Mục 2 và 3.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

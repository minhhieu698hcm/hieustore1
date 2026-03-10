<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>{{ $promo->mailpromo_title }}</title>
  <style>
  img {
    max-width: 100% !important;
    height: auto !important;
  }
  table {
    width: 100% !important;
    table-layout: fixed !important;
    word-break: break-word;
  }
</style>
</head>
<body style="margin:0;padding:0;font-family:Roboto;background-color:#f5f5f5;line-height:1.6;">
  <center>
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;background-color:#e4e4e4">
      <tr>
        <td align="center">
          <div style="max-width:600px;margin:0 auto;box-shadow:0 4px 12px rgba(0,0,0,0.4);border-radius:12px;overflow:hidden;background-color:#ffffff;">
  <table cellpadding="0" cellspacing="0" width="100%" style="border-radius:12px;">
            
            <!-- Header -->
            <tr>
              <td style="background-color:#f8f8f8;padding:30px;text-align:center;">
                <img src="https://www.unitek-products.com/cdn/shop/files/NEW-UNITEK_4369df3b-078d-4253-8f57-3dad519b30df.png?v=1629164690" class="logo" alt="Unitek Việt Nam" width="250" style="max-width:100%;height:auto;">
                <hr>
                <!--<p style="font-size:26px;margin:0;color:#ff0000;font-weight:bold;">{{$promo->mailpromo_title}}</p>-->
              </td>
            </tr>

            <!-- Nội dung chính -->
            <tr>
              <td style="padding:25px 30px 15px;text-align:left;color:#333;">
                <div style="max-width:600px; width:100%; overflow-wrap:break-word; word-break:break-word; font-size:15px; line-height:1.6;">
                  {!! $promo->mailpromo_content !!}
                </div>
              </td>
            </tr>

           <!-- Footer -->
		<tr>
			<td style="background-color:#f8f8f8; padding:20px; text-align:center; font-size:13px; color:#888; border-top:1px solid #ddd; line-height:1.5;">

				<!-- Social icons centered with tighter spacing -->
<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:15px; width: 250px!important;">
  <tr>
    <td align="right" style="padding: 0 4px;">
      <a href="https://www.facebook.com/kingmaster.vn" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook" width="24" height="24" style="display:block;">
      </a>
    </td>
    <td align="center" style="padding: 0 4px;">
      <a href="https://www.tiktok.com/@huyphatelectronics.ltd" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/24/3046/3046120.png" alt="TikTok" width="24" height="24" style="display:block;">
      </a>
    </td>
    <td align="left" style="padding: 0 4px;">
      <a href="https://www.instagram.com/huyphat_electronics_vn" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/24/733/733558.png" alt="Instagram" width="24" height="24" style="display:block;">
      </a>
    </td>
  </tr>
</table>

				<!-- Nội dung footer -->
				<div style="margin-bottom:10px; color:#2b2b2b; font-size:13px; line-height:1.5;">
    &copy; 2024 - All Rights Reserved. 
    <strong style="margin-bottom: 5px">
        <a href="https://www.huyphatelectronics.com/" target="_blank" style="color:#D32F2F; text-decoration:none;">
            CÔNG TY TNHH HUY PHÁT ELECTRONICS
        </a>
    </strong><br>

    <div style="margin-top: 5px">
        <strong>
            <a href="https://maps.app.goo.gl/fm9RGhv55WLrVMhNA" target="_blank" style="color:#D32F2F; text-decoration:none;">
                Showroom miền Nam:
            </a>
        </strong>
    </div>
    <div style="margin-bottom: 5px">444 Nguyễn Tri Phương, Phường 4, Quận 10, TP. Hồ Chí Minh, Việt Nam.</div>
	<div style="margin-top: 5px">
		<strong>
			<a href="https://maps.app.goo.gl/nsYm6Dn4nPC2gUUA7" target="_blank" style="color:#D32F2F; text-decoration:none;">
				Showroom miền Nam:
			</a>
		</strong>
	</div>
	<div style="margin-bottom: 5px">
		Tầng 3 Vạn Hạnh Mall, 11 Sư Vạn Hạnh, Phường Hòa Hưng, TP.HCM
	</div>
    <div>
        <strong>
            <a href="https://maps.app.goo.gl/XTbP1kB4ii2YSjte6" target="_blank" style="color:#D32F2F; text-decoration:none;">
                Đại lý bán hàng: Khu vực miền Bắc
            </a>
        </strong>
    </div>
    <div>Công ty Cổ Phần Minh Chính: 95 Hàng Bông, Quận Hoàn Kiếm, TP. Hà Nội, Việt Nam.</div>

    <br>
    Nhập mã <strong style="color:#D32F2F;">UNITEKVN</strong> để giảm 15% cho mọi đơn hàng<br>
    Nhận thêm thông tin hoặc liên hệ trực tiếp với chúng tôi để nhận giá tốt:<br>
    <a href="tel:0989188768" style="color:#D32F2F; text-decoration:none; font-weight:bold;">0989 188 768</a> · 
    <a href="mailto:hotro@huyphatelectronics.com" style="color:#D32F2F; text-decoration:none; font-weight:bold;">hotro@huyphatelectronics.com</a>
</div>
			</td>
		</tr>

			  
          </table>
			</div>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Services\GenerateSitemapService;

/*
|----------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/run-sitemap', function (GenerateSitemapService $sitemap) {
    $sitemap->generate();
    return "✅ Đã cập nhật sitemap.xml thủ công!";
});

Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');

    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'application/xml',
        ]);
    }

    abort(404, 'Sitemap not found.');
});



//Home

Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/lien-he','HomeController@lienhe');
Route::get('/gioi-thieu','HomeController@gioithieu');
Route::get('/tim-kiem','HomeController@search');
Route::post('/login', 'HomeController@login');
Route::get('/login', 'HomeController@showLoginForm')->name('login');
Route::get('/register', 'HomeController@showRegisterForm')->name('register');
Route::post('/register', 'HomeController@register')->middleware('throttle:5,1');
Route::post('/logout', 'HomeController@logout');
Route::get('/thanh-toan', 'HomeController@checkout');
Route::get('/chinh-sach-bao-hanh','HomeController@baohanh');
Route::get('/faq','HomeController@faq');
Route::post('/updateprofile','HomeController@updateProfile');
Route::get('/setting-account','HomeController@AccountSetting');
Route::post('/check-username','HomeController@checkUsername');
Route::POST('/updateaddress','HomeController@updateAddress');
Route::POST('/change-password','HomeController@changePassword');
Route::post('/forgot-password', 'HomeController@forgotPassword');
Route::get('/reset-password', 'HomeController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'HomeController@resetPassword')->name('password.update');
Route::GET('/don-hang/{orderNumber}','HomeController@Order')->name('order.details');
Route::get('/search-order', 'OrderController@searchOrder');


//Auth Customer
Route::group(['middleware' => 'auth'], function () {
    Route::get('/myaccount', 'HomeController@myAccount');
    Route::post('/customer/update-avatar', 'HomeController@updateAvatar')->name('customer.updateAvatar');
    Route::post('/customer/delete-avatar', 'HomeController@deleteAvatar')->name('customer.deleteAvatar');
    Route::get('/list-order', 'HomeController@listOrder')->name('customer.orders');
});



    //Roles
        Route::get('/admin', 'AdminController@index')->name('admin.login');
        Route::post('/admin-dashboard', 'AdminController@dashboard')->name('admin.dashboard');
		Route::post('/theme/update', 'AdminController@updateTheme')->name('theme.update');
        Route::post('/admin/update-theme-session', 'AdminController@updateThemeSession')->name('admin.update-theme-session');
    // Nhóm route cần xác thực admin
        Route::middleware(['auth:admin', 'admin_role:admin,sale,dev'])->group(function () {
        // Chat routes for admin
        Route::get('/admin/chats', 'AdminChatController@index')->name('admin.chats.index');
        Route::get('/admin/chats/{sessionId}/messages', 'AdminChatController@messages')->name('admin.chats.messages');
        Route::post('/admin/chats/{sessionId}/reply', 'AdminChatController@reply')->name('admin.chats.reply'); 



        Route::get('/dashboard', 'AdminController@show_dashboard')->name('admin.home');
        Route::get('/logout', 'AdminController@logout')->name('admin.logout');
        Route::get('/account-setting','AdminController@account_setting');
        Route::post('/admin/update-profile', 'AdminController@updateProfile')->name('admin.updateProfile');
        Route::post('/admin/update-password', 'AdminController@updatePassword')->name('admin.updatePassword');
        Route::post('/admin/update-avatar', 'AdminController@updateAvatar')->name('admin.updateAvatar');
        Route::post('/admin/delete-avatar', 'AdminController@deleteAvatar')->name('admin.deleteAvatar');

        //product
        Route::get('/add-product', 'ProductController@add_product');
        Route::get('/all-product', 'ProductController@all_product');
        Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
        Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
        Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
        Route::get('/active-product/{product_id}', 'ProductController@active_product');
        Route::post('/save-product', 'ProductController@save_product')->name('save_product');;
        Route::post('/update-product/{product_id}', 'ProductController@update_product');
        Route::post('/product/toggle-stock/{product_id}', 'ProductController@toggleStockStatus')->name('product.toggleStock');
        Route::post('/product/toggle-status/{product_id}', 'ProductController@toggleProductStatus')->name('product.toggleStatus');
        Route::post('/product/bulk-toggle-stock', 'ProductController@bulkToggleStock');
        Route::post('/product/bulk-toggle-status', 'ProductController@bulkToggleStatus');
        Route::get('/product/search', 'ProductController@searchProduct')->name('product.search');
        Route::post('/check-product-code', 'ProductController@checkProductCode');
        Route::post('/get-product-attributes', 'ProductController@getProductAttributes');
        Route::post('/product/update-price/{product_id}', 'ProductController@update_product_price');

		Route::get('/admin/notifications/orders', 'OrderNotificationController@getNewOrders');
    

    //Attribute
        Route::get('/manage-attribute','AttributeController@manage_attribute');
        Route::get('/add-attribute','AttributeController@add_attribute');
        Route::get('/edit-attribute/{idAttribute}','AttributeController@edit_attribute');
        Route::get('/delete-attribute/{idAttribute}','AttributeController@delete_attribute');
        Route::post('/submit-add-attribute','AttributeController@submit_add_attribute');
        Route::post('/submit-edit-attribute/{idAttribute}','AttributeController@submit_edit_attribute');

    //AttributeValue
        Route::get('/manage-attr-value','AttributeValueController@manage_attr_value');
        Route::get('/add-attr-value','AttributeValueController@add_attr_value');
        Route::get('/edit-attr-value/{idAttrValue}','AttributeValueController@edit_attr_value');
        Route::get('/delete-attr-value/{idAttrValue}','AttributeValueController@delete_attr_value');
        Route::post('/submit-add-attr-value','AttributeValueController@submit_add_attr_value');
        Route::post('/submit-edit-attr-value/{idAttrValue}','AttributeValueController@submit_edit_attr_value');

    //category product
        Route::get('/add-category-product', 'CategoryProduct@add_category_product');
        Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
        Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
        Route::get('/all-category-product', 'CategoryProduct@all_category_product');
        Route::post('/save-category-product', 'CategoryProduct@save_category_product');
        Route::post('/category/toggle-status/{category_id}', 'CategoryProduct@toggleCategoryStatus')->name('category.toggleStatus');
        Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

    //Blog
        Route::get('/add-blog','BlogController@add_blog');
        Route::get('/all-blog','BlogController@all_blog');
        Route::post('/save-blog', 'BlogController@save_blog');
        Route::post('/blog/toggle-status/{blog_id}', 'BlogController@toggleBlogStatus')->name('blog.toggleStatus');
        Route::get('/delete-blog/{blog_id}','BlogController@delete_blog');
        Route::get('/edit-blog/{blog_id}','BlogController@edit_blog');
        Route::post('/submit-edit-blog','BlogController@submit_edit_blog');
        Route::get('/active-blog/{blog_id}', 'BlogController@active_blog');
        Route::get('/tin-tuc-chi-tiet/{blog_slug}', 'BlogController@details_blog');
        Route::get('/tin-tuc','BlogController@blog');
		
	//MailPromo
        Route::get('/add-mailpromo','MailPromoController@add_mailpromo');
        Route::get('/all-mailpromo','MailPromoController@all_mailpromo');
        Route::post('/save-mailpromo', 'MailPromoController@save_mailpromo');
        Route::get('/delete-mailpromo/{mailpromo_id}','MailPromoController@delete_mailpromo');
        Route::get('/edit-mailpromo/{mailpromo_id}','MailPromoController@edit_mailpromo');
        Route::post('/submit-edit-mailpromo','MailPromoController@submit_edit_mailpromo');
        Route::get('/send-mailpromo/{id}', 'MailPromoController@showSendForm');
        Route::post('/send-mailpromo/{id}', 'MailPromoController@sendMailPromo');
        Route::get('/get-order-emails', 'MailPromoController@getEmailsFromOrders');
        Route::get('/preview-mailpromo/{id}', function ($id) {
            $promo = \App\Models\MailPromo::findOrFail($id);
            return new \App\Mail\PromoMail($promo); // tự preview trong browser
        });

    //Bill
        Route::get('/all-bill', 'OrderController@all_bill')->name('order.allBill');
        Route::get('/update-status/{order_number}/{status}', 'OrderController@updateStatus')->name('order.updateStatus');
        Route::get('/bill-info/{order_number}', 'OrderController@showBillInfo')->name('order.showBillInfo');
        Route::get('/bill-waiting', 'OrderController@showBillWaiting')->name('order.showBillWaiting');
		Route::get('/bill-pending', 'OrderController@showBillPending')->name('order.showBillPending');
        Route::get('/bill-confirmed', 'OrderController@showBillConfirmed')->name('order.showBillConfirmed');
        Route::get('/bill-shipped', 'OrderController@showBillShipped')->name('order.showBillShipped');
        Route::get('/bill-delivered', 'OrderController@showBillDelivered')->name('order.showBillDelivered');
        Route::get('/order/delete/{order_number}', 'OrderController@delete')->name('order.delete');
    });

    Route::middleware(['auth:admin', 'admin_role:dev,admin'])->group(function () {
    //Sale
        Route::get('/manage-voucher','ProductController@manage_voucher')->name('admin.manage_voucher');
        Route::get('/add-voucher','ProductController@add_voucher');
        Route::get('/edit-voucher/{idVoucher}','ProductController@edit_voucher');
        Route::get('/delete-voucher/{idVoucher}','ProductController@delete_voucher');
        Route::post('/submit-add-voucher','ProductController@submit_add_voucher');
        Route::post('/submit-edit-voucher/{idVoucher}','ProductController@submit_edit_voucher');

    //Discount
        Route::get('/add-discount','ProductController@add_discount');
        Route::post('/admin/discount/update', 'ProductController@updateDiscounts')->name('admin.discount.update');


    //Manage ADMIN
        Route::get('/manage-staffs','AdminController@manage_staffs');
        Route::get('/add-staffs','AdminController@add_staffs');
        Route::get('/delete-staff/{idAdmin}','AdminController@delete_staff');
        Route::get('/delete-customer/{idCustomer}','AdminController@delete_customer');
        Route::get('/manage-customers','AdminController@manage_customers');
        Route::post('/submit-add-staffs','AdminController@submit_add_staffs');
		
		//Manage Gift
		Route::get('/add-promotion', 'PromotionController@create')->name('promotions.create');
		Route::get('/all-promotion', 'PromotionController@index')->name('promotions.index');
		Route::post('/add-promotion', 'PromotionController@store')->name('promotions.store');
		Route::get('/edit-promotion/{promotion}', 'PromotionController@edit')->name('promotions.edit');
Route::put('/update-promotion/{promotion}', [App\Http\Controllers\PromotionController::class, 'update'])->name('promotions.update');		Route::delete('/delete-promotion/{promotion}', 'PromotionController@destroy')->name('promotions.destroy');
       
		//Manage View
        Route::get('/banner-manager', 'BannerController@manager')->name('admin.banner.manager');
        Route::post('/banner-hero-update', 'BannerController@heroUpdate')->name('admin.banner.hero.update');
        Route::post('/banner-highlight-update', 'BannerController@highlightUpdate')->name('admin.banner.highlight.update');
        Route::post('/banners-middle-update', 'BannerController@updateMiddle')->name('admin.banners.middle.update');
		Route::post('/logo-update', 'BannerController@updateLogo')->name('admin.logo.update');
		
		//Manage Info View
        Route::get('/info-manager', 'InfoController@manager')->name('admin.info.manager');
        Route::post('/banner-text-save', 'InfoController@saveBannerText')->name('admin.info.banner_text.save');
        Route::post('/banner-text-delete', 'InfoController@deleteBannerText')->name('admin.info.banner_text.delete');
		
        //Baotriwebsite
        Route::get('/admin/suspended', 'AdminController@Suspended')->name('admin.suspended');
        Route::post('/admin/toggle-suspended', 'AdminController@toggleSuspended')->name('admin.toggleSuspended');

        Route::get('/product-feed.xml', 'ProductController@productFeed');
        Route::post('/import-product-prices', 'ProductController@importProductPrices')->name('import.product.prices');
        Route::get('/export-product-prices', 'ProductController@exportProductPrices')->name('export.product.prices');



    });



 //Blog
Route::get('/tin-tuc-chi-tiet/{blog_slug}', 'BlogController@details_blog');
Route::get('/tin-tuc','BlogController@blog');

//Product
Route::get('/san-pham', 'ProductController@product');
Route::get('/san-pham/{categorySlug}', 'ProductController@productByCategory')->name('product.byCategory')->where('categorySlug', '[a-z0-9\-]+');
Route::get('/product/{id}/quickview', 'ProductController@Quickview');
Route::get('chi-tiet-san-pham/{product_Slug}/{attribute_code?}', 'ProductController@product_details');

Route::get('/search', 'ProductController@search')->name('search');
Route::get('/autocomplete-ajax', 'ProductController@autocomplete_ajax');

// Google Merchant Center Feed
Route::get('/google-merchant-feed.xml', 'ProductController@googleMerchantFeed');
Route::get('/google-merchant-feed', 'ProductController@googleMerchantFeed');


//Cart
Route::get('/cart-all', 'CartController@showCart');
Route::get('/cart', 'CartController@getCart');
Route::post('/add-to-cart', 'CartController@addToCart');
Route::post('/remove-from-cart', 'CartController@removeFromCart');
Route::post('/clear-cart', 'CartController@clearCart');
Route::post('/update-cart-quantity', 'CartController@updateCartQuantity');
Route::post('/check-voucher','CartController@check_voucher');

//Wishlist
Route::get('/wishlist-all', 'WishlistController@getWishlistall');
Route::get('/wishlist', 'WishlistController@getWishlist');
Route::post('/add-to-wishlist', 'WishlistController@addToWishlist');
Route::post('/remove-from-wishlist', 'WishlistController@removeFromWishlist');
Route::post('/clear-wishlist', 'WishlistController@clearWishlist');

//Attribute
Route::post('/select-attribute','AttributeController@select_attribute');

//Policy
Route::get('/policy-all','HomeController@policy_all');
Route::get('/policy-customer','HomeController@policy_customer');
Route::get('/service-information-and-website','HomeController@service_information_and_website');
Route::get('/policy-delivery','HomeController@policy_delivery');
Route::get('/policy-payment','HomeController@policy_payment');
Route::get('/policy-company','HomeController@policy_company');
Route::get('/policy-warranty','HomeController@policy_warranty');
Route::get('/faq','HomeController@faq');
Route::get('/return-policy','HomeController@policy_return_and_refund');
Route::get('/policy-privacy','HomeController@policy_privacy');
Route::get('/blog','HomeController@blog');

//Checkout
Route::get('/thanh-toan', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.page');

Route::post('/thanh-toan/new', 'CheckoutController@createOrder')->name('checkout.create');
Route::get('/thanh-toan/qr/{orderNumber}', 'CheckoutController@showQrPage')->name('checkout.qr');
Route::get('/thanh-toan/success/{orderNumber}', 'CheckoutController@success')->name('checkout.success');


// Frontend chat
Route::post('/chat/create-session', [App\Http\Controllers\ChatController::class, 'createSession'])->name('chat.createSession');
Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');
Route::get('/chat/messages', [App\Http\Controllers\ChatController::class, 'messages'])->name('chat.messages');
Route::post('/chat/update-status', [App\Http\Controllers\ChatController::class, 'updateStatus'])->name('chat.updateStatus');
Route::post('/chat/check-session', [App\Http\Controllers\ChatController::class, 'checkSession'])->name('chat.checkSession');
Route::post('/chat/find-by-phone', [App\Http\Controllers\ChatCleanupController::class, 'findByPhone'])->name('chat.findByPhone');
Route::post('/chat/get-recent-chats', [App\Http\Controllers\ChatCleanupController::class, 'getRecentChats'])->name('chat.getRecentChats');
Route::get('/chat/cleanup-old', [App\Http\Controllers\ChatCleanupController::class, 'cleanupOldMessages'])->name('chat.cleanup');
Route::post('/chat/mark-read', [App\Http\Controllers\AdminChatController::class, 'markRead']);
Route::post('/chat/mark-read-customer', [App\Http\Controllers\ChatController::class, 'markReadCustomer'])->name('chat.markReadCustomer');
Route::get('/admin/chats/sidebar', [App\Http\Controllers\AdminChatController::class,'sidebar']);
Route::post('/admin/chats/{session}/send-image', [App\Http\Controllers\AdminChatController::class, 'sendImage']);
Route::get('/admin/notifications/chat', [App\Http\Controllers\AdminChatController::class, 'notifications']);













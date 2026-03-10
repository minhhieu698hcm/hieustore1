<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class CheckSuspended
{
    public function handle(Request $request, Closure $next)
    {
        // Cho phép admin đã login (guard admin)
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Danh sách tất cả route admin (bỏ qua bảo trì)
        $adminRoutes = [
            // Roles / login / dashboard
            'admin',
            'admin-dashboard',
            'theme/update',
            'admin/update-theme-session',
            'dashboard',
            'logout',
            'account-setting',
            'admin/update-profile',
            'admin/update-password',
            'admin/update-avatar',
            'admin/delete-avatar',

            // Product
            'add-product',
            'all-product',
            'edit-product/*',
            'delete-product/*',
            'unactive-product/*',
            'active-product/*',
            'save-product',
            'update-product/*',
            'product/toggle-stock/*',
            'product/toggle-status/*',
            'product/bulk-toggle-stock',
            'product/bulk-toggle-status',
            'product/search',
            'check-product-code',
            'get-product-attributes',
            'product/update-price/*',

            'admin/notifications/orders',

            // Attribute
            'manage-attribute',
            'add-attribute',
            'edit-attribute/*',
            'delete-attribute/*',
            'submit-add-attribute',
            'submit-edit-attribute/*',

            // AttributeValue
            'manage-attr-value',
            'add-attr-value',
            'edit-attr-value/*',
            'delete-attr-value/*',
            'submit-add-attr-value',
            'submit-edit-attr-value/*',

            // Category
            'add-category-product',
            'edit-category-product/*',
            'delete-category-product/*',
            'all-category-product',
            'save-category-product',
            'category/toggle-status/*',
            'update-category-product/*',

            // Blog
            'add-blog',
            'all-blog',
            'save-blog',
            'blog/toggle-status/*',
            'delete-blog/*',
            'edit-blog/*',
            'submit-edit-blog',
            'active-blog/*',
            'tin-tuc-chi-tiet/*',
            'tin-tuc',

            // MailPromo
            'add-mailpromo',
            'all-mailpromo',
            'save-mailpromo',
            'delete-mailpromo/*',
            'edit-mailpromo/*',
            'submit-edit-mailpromo',
            'send-mailpromo/*',
            'get-order-emails',
            'preview-mailpromo/*',

            // Bill / Order
            'all-bill',
            'update-status/*/*',
            'bill-info/*',
            'bill-waiting',
            'bill-pending',
            'bill-confirmed',
            'bill-shipped',
            'bill-delivered',
            'order/delete/*',

            // Voucher / Discount
            'manage-voucher',
            'add-voucher',
            'edit-voucher/*',
            'delete-voucher/*',
            'submit-add-voucher',
            'submit-edit-voucher/*',
            'add-discount',
            'admin/discount/update',

            // Staff / Customer
            'manage-staffs',
            'add-staffs',
            'delete-staff/*',
            'delete-customer/*',
            'manage-customers',
            'submit-add-staffs',

            // Promotion
            'add-promotion',
            'all-promotion',
            'edit-promotion/*',
            'update-promotion/*',
            'delete-promotion/*',

            // Banner / Logo / Info
            'banner-manager',
            'banner-hero-update',
            'banner-highlight-update',
            'banners-middle-update',
            'logo-update',
            'info-manager',
            'banner-text-save',
            'banner-text-delete',

            // Bảo trì admin
            'admin/suspended',
            'admin/toggle-suspended',
        ];

        foreach ($adminRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        // Kiểm tra trạng thái Suspended từ DB cho client
        $suspended = Setting::where('key', 'suspended')->first();
        if ($suspended && $suspended->value == '1') {
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}

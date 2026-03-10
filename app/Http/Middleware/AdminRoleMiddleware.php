<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::guard('admin')->check()) {
        return redirect('/admin')->with('error', 'Vui lòng đăng nhập');
    }

    $admin = Auth::guard('admin')->user();

    // Kiểm tra nếu role của admin có trong danh sách roles được phép
    if (!$admin || !in_array($admin->position, $roles)) {
        return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập.');
    }

    return $next($request);
}


}


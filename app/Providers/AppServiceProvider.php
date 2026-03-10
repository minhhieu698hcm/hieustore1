<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Info;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Đảm bảo rằng bạn đã thay 'package-name' bằng tên thực tế của package hoặc bỏ qua nếu không sử dụng package
        Blade::component('components.chat-box', 'chat-box');
        Paginator::useBootstrap();
		$banner_text = Info::where('position', 'bannertext')->where('active', 1)->orderBy('order')->get();
        View::share('banner_text', $banner_text);

		 $promotion = Promotion::where('is_active', 1)
            ->where('promotion_type', 'gift') // ✅ chỉ lấy loại gift
            ->where(function ($q) {
                $now = now();
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) {
                $now = now();
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->latest()
            ->first();

        View::share('promotion', $promotion);
	 // 🔹 Logo main & footer chia sẻ cho toàn bộ view
        $logo_main = Banner::where('position', 'logo_main')
            ->where('active', 1)
            ->orderBy('order')
            ->first(); // lấy 1 logo chính
        $logo_footer = Banner::where('position', 'logo_footer')
            ->where('active', 1)
            ->orderBy('order')
            ->first(); // lấy 1 logo footer

        View::share('logo_main', $logo_main);
        View::share('logo_footer', $logo_footer);
		 View::composer('*', function ($view) {
        $categories = Category::where('category_status', 1)
            ->orderBy('category_name', 'asc')
            ->get();

        $total = $categories->count();
        $half  = ceil($total / 2);

        $view->with([
            'categories_col_1' => $categories->slice(0, $half),
            'categories_col_2' => $categories->slice($half),
        ]);
    });
    }
}
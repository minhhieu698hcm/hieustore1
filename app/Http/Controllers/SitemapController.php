<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use App\Models\Product;
use App\Models\Blog;

class SitemapController extends Controller
{
    protected int $perPage = 9; // số sản phẩm mỗi trang

    public function index()
    {
        $urls = array_merge(
            $this->staticPages(),
            $this->productListPages(),
            $this->productDetailPages(),
            $this->blogDetailPages()
        );

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Trang tĩnh
     */
    protected function staticPages(): array
    {
        return [
            [
                'loc' => URL::to('/'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
        ];
    }

    /**
     * Danh sách sản phẩm phân trang
     */
    protected function productListPages(): array
    {
        $totalProducts = Product::count();
        $totalPages = (int) ceil($totalProducts / $this->perPage);

        $pages = [];
        for ($page = 1; $page <= $totalPages; $page++) {
            $pages[] = [
                'loc' => URL::to("/san-pham?sort_by=newest&page={$page}"),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ];
        }
        return $pages;
    }

    /**
     * Chi tiết sản phẩm
     */
    protected function productDetailPages(): array
    {
        $items = [];
        foreach (Product::cursor() as $product) {
            $items[] = [
                'loc' => URL::to("/chi-tiet-san-pham/{$product->product_Slug}"),
                'lastmod' => optional($product->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];
        }
        return $items;
    }

    /**
     * Chi tiết blog
     */
    protected function blogDetailPages(): array
    {
        $items = [];
        foreach (Blog::cursor() as $blog) {
            $items[] = [
                'loc' => URL::to("/tin-tuc-chi-tiet/{$blog->blog_slug}"),
                'lastmod' => optional($blog->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }
        return $items;
    }
}

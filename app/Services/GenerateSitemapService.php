<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateSitemapService
{
    private $baseUrl = 'https://unitekvn.com';
    private $xmlContent = '';

    /**
     * Generate sitemap XML từ database
     */
    public function generate()
    {
        $this->xmlContent = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $this->xmlContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Add static pages
        $this->addStaticPages();

        // Add product category pages with pagination
        $this->addCategoryPages();

        // Add all product detail pages
        $this->addProductPages();

        // Add blog pages
        $this->addBlogPages();

        $this->xmlContent .= '</urlset>';

        return $this->xmlContent;
    }

    /**
     * Add static pages
     */
    private function addStaticPages()
    {
        $pages = [
            ['url' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => '/trang-chu', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/san-pham', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/gioi-thieu', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/lien-he', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/tin-tuc', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/policy-all', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/policy-privacy', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/policy-warranty', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/policy-delivery', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/policy-payment', 'priority' => '0.5', 'changefreq' => 'yearly'],
        ];

        foreach ($pages as $page) {
            $this->addUrl(
                $this->baseUrl . $page['url'],
                now()->toAtomString(),
                $page['changefreq'],
                $page['priority']
            );
        }
    }

    /**
     * Add category pages with pagination
     */
    private function addCategoryPages()
    {
        try {
            $categories = DB::table('tbl_category_product')->get();

            foreach ($categories as $category) {
                // Count products in category
                $productCount = DB::table('tbl_product')
                    ->join('tbl_category_product_product', 'tbl_product.product_id', '=', 'tbl_category_product_product.product_id')
                    ->where('tbl_category_product_product.category_id', $category->category_id)
                    ->where('tbl_product.product_status', 1)
                    ->count();

                // Calculate pages (9 items per page)
                $totalPages = ceil($productCount / 9);

                // Add category page
                $this->addUrl(
                    $this->baseUrl . "/san-pham?filter_category=" . $category->category_id . "&sort_by=newest&page=1",
                    $category->updated_at ?? now()->toAtomString(),
                    'daily',
                    '0.9'
                );

                // Add pagination pages
                for ($page = 2; $page <= $totalPages; $page++) {
                    $this->addUrl(
                        $this->baseUrl . "/san-pham?filter_category=" . $category->category_id . "&sort_by=newest&page=" . $page,
                        $category->updated_at ?? now()->toAtomString(),
                        'daily',
                        '0.8'
                    );
                }
            }
        } catch (\Exception $e) {
            // Handle error gracefully
        }
    }

    /**
     * Add all product detail pages
     */
    private function addProductPages()
    {
        try {
            $products = DB::table('tbl_product')
                ->where('product_status', 1)
                ->select('product_id', 'product_slug', 'updated_at')
                ->orderBy('updated_at', 'desc')
                ->chunk(100, function ($products) {
                    foreach ($products as $product) {
                        $this->addUrl(
                            $this->baseUrl . '/chi-tiet-san-pham/' . $product->product_slug,
                            $product->updated_at,
                            'weekly',
                            '0.9'
                        );
                    }
                });
        } catch (\Exception $e) {
            // Handle error gracefully
        }
    }

    /**
     * Add blog pages
     */
    private function addBlogPages()
    {
        try {
            $blogs = DB::table('tbl_blog')
                ->where('blog_status', 1)
                ->select('blog_id', 'blog_slug', 'updated_at')
                ->orderBy('updated_at', 'desc')
                ->chunk(50, function ($blogs) {
                    foreach ($blogs as $blog) {
                        $this->addUrl(
                            $this->baseUrl . '/tin-tuc/' . $blog->blog_slug,
                            $blog->updated_at,
                            'weekly',
                            '0.8'
                        );
                    }
                });
        } catch (\Exception $e) {
            // Handle error gracefully
        }
    }

    /**
     * Add single URL to sitemap
     */
    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        $this->xmlContent .= "    <url>\n";
        $this->xmlContent .= "        <loc>" . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>\n";

        if ($lastmod) {
            $this->xmlContent .= "        <lastmod>" . Carbon::parse($lastmod)->toAtomString() . "</lastmod>\n";
        }

        $this->xmlContent .= "        <changefreq>" . $changefreq . "</changefreq>\n";
        $this->xmlContent .= "        <priority>" . $priority . "</priority>\n";
        $this->xmlContent .= "    </url>\n";
    }

    /**
     * Save sitemap to public folder
     */
    public function save()
    {
        $sitemapPath = public_path('sitemap.xml');
        $content = $this->generate();
        file_put_contents($sitemapPath, $content);

        return $sitemapPath;
    }
}

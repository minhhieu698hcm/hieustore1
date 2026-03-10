<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Models\Product;
use App\Models\Blog;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Tự động tạo sitemap.xml';

    public function handle()
    {
        app(\App\Services\GenerateSitemapService::class)->generate();
        $this->info("✅ sitemap.xml generated successfully!");
    }
}

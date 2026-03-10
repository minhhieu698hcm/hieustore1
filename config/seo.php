<?php

return [
    'site_name' => 'Unitek Việt Nam',
    'site_url' => env('APP_URL', 'https://unitekvn.com'),
    
    'defaults' => [
        'meta_title' => 'Unitek | Cáp HDMI, USB, Phụ Kiện Công Nghệ Chính Hãng',
        'meta_description' => 'Unitek - Nhà phân phối chính hãng cáp HDMI, USB, dock sạc, bộ chuyển đổi và phụ kiện công nghệ. Giao hàng toàn quốc, hỗ trợ 24/7.',
        'meta_keywords' => 'unitek, cáp HDMI, cáp USB, dock sạc, bộ chuyển đổi, phụ kiện máy tính, linh kiện công nghệ, sản phẩm chính hãng',
        'og_image' => 'https://unitekvn.com/public/frontend/images/default-og-image.jpg',
    ],

    'pagination' => [
        'items_per_page' => 9,
        'max_pages' => 5, // Limit pagination depth for SEO
    ],

    'sitemaps' => [
        'enabled' => true,
        'products_per_file' => 50000,
        'update_frequency' => 'weekly',
    ],

    'og_tags' => [
        'enabled' => true,
        'type' => 'website',
        'locale' => 'vi_VN',
    ],

    'structured_data' => [
        'enabled' => true,
        'organization' => [
            'name' => 'Unitek Vietnam',
            'url' => 'https://unitekvn.com',
            'email' => 'support@unitekvn.com',
            'phone' => '+84-xxx-xxxx-xxx',
        ],
    ],
];

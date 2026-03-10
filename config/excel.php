<?php
return [
    'exports' => [
        'chunk_size' => 1000,
        'temp_path' => sys_get_temp_dir(),
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => PHP_EOL,
            'use_bom' => false,
            'include_separator_line' => false,
            'excel_compatibility' => false,
        ],
    ],
];
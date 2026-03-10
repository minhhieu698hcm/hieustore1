<?php

namespace App\Http\Exports;

use App\Models\Product;
use App\Models\ProductAttribute;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class ProductPriceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $columns;

    public function __construct(array $columns = null)
    {
        // default columns
        $default = [
            'id',
            'ma_san_pham',
            'ma_phan_loai',
            'ten_san_pham',
            'gia',
            'mo_ta',
            'thong_so',
            'mo_ta_gallery',
            'attr_id'
        ];

        $this->columns = $columns && count($columns) ? $columns : $default;
    }

    public function collection()
    {
        try {
            // Lấy sản phẩm chính
            $mainProducts = Product::select(
                'product_id',
                'product_code', 
                'product_name',
                'product_price',
                'product_desc',
                'product_content',
                'product_gale_desc'
            )
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->product_id,
                    'ma_san_pham' => $product->product_code,
                    'ma_phan_loai' => '',
                    'ten_san_pham' => $product->product_name,
                    'gia' => $product->product_price,
                    'mo_ta' => $product->product_desc,
                    'thong_so' => $product->product_content,
                    'mo_ta_gallery' => $product->product_gale_desc
                ];
            });

            // Lấy phân loại sản phẩm
            $variants = ProductAttribute::join('tbl_product', 'product_attribute.product_id', '=', 'tbl_product.product_id')
                ->select(
                    'tbl_product.product_id',
                    'tbl_product.product_code',
                    'product_attribute.idProAttr',
                    'product_attribute.product_attribute_code',
                    'tbl_product.product_name',
                    'product_attribute.product_price',
                    'tbl_product.product_desc',
                    'tbl_product.product_content',
                    'tbl_product.product_gale_desc'
                )
                ->get()
                ->map(function($variant) {
                    return [
                        'id' => $variant->product_id,
                        'ma_san_pham' => $variant->product_code,
                        'ma_phan_loai' => $variant->product_attribute_code,
                        'ten_san_pham' => $variant->product_name,
                        'gia' => $variant->product_price,
                        'mo_ta' => $variant->product_desc,
                        'thong_so' => $variant->product_content,
                        'mo_ta_gallery' => $variant->product_gale_desc,
                        'attr_id' => $variant->idProAttr
                    ];
                });

            return $mainProducts->concat($variants);

        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function headings(): array
    {
        // map column keys to human readable headings
        $labels = [
            'id' => 'ID',
            'ma_san_pham' => 'Mã sản phẩm',
            'ma_phan_loai' => 'Mã phân loại',
            'ten_san_pham' => 'Tên sản phẩm',
            'gia' => 'Giá',
            'mo_ta' => 'Mô tả sản phẩm',
            'thong_so' => 'Thông số kỹ thuật',
            'mo_ta_gallery' => 'Mô tả gallery',
            'attr_id' => 'Attr ID'
        ];

        $out = [];
        foreach ($this->columns as $col) {
            $out[] = $labels[$col] ?? $col;
        }
        return $out;
    }

    public function map($row): array 
    {
        $out = [];
        foreach ($this->columns as $col) {
            $out[] = $row[$col] ?? '';
        }
        return $out;
    }

    public function styles(Worksheet $sheet)
    {
        // Auto size columns based on selected columns count
        $colCount = count($this->columns);
        $lastCol = chr(ord('A') + max(0, $colCount - 1));
        foreach(range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4B5563']
                ]
            ]
        ];
    }
}
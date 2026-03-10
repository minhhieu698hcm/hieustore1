<?php

namespace App\Http\Imports;

use App\Models\Product;
use App\Models\ProductAttribute;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductPriceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        DB::beginTransaction();
        try {
            $product = null;

            // Tìm sản phẩm theo ID hoặc mã sản phẩm
            if (!empty($row['id'])) {
                $product = Product::find((int)$row['id']);
            } elseif (!empty($row['ma_san_pham'])) {
                $product = Product::where('product_code', trim($row['ma_san_pham']))->first();
            }

            // Cập nhật thông tin sản phẩm chính nếu tìm thấy
            if ($product) {
                $updateData = [];

                if (isset($row['gia']) && $row['gia'] !== '') {
                    $cleanPrice = preg_replace('/[^0-9.]/', '', $row['gia']);
                    if (is_numeric($cleanPrice)) {
                        $updateData['product_price'] = (float)$cleanPrice;
                    }
                }

                if (isset($row['mo_ta_san_pham'])) {
                    $updateData['product_desc'] = html_entity_decode($row['mo_ta_san_pham']);
                }

                if (isset($row['thong_so_ky_thuat'])) {
                    $updateData['product_content'] = html_entity_decode($row['thong_so_ky_thuat']);
                }

                if (isset($row['mo_ta_gallery'])) {
                    $updateData['product_gale_desc'] = html_entity_decode($row['mo_ta_gallery']);
                }

                if (!empty($updateData)) {
                    DB::table('tbl_product')
                        ->where('product_id', $product->product_id)
                        ->update($updateData);

                    Log::info('Cập nhật sản phẩm ' . $product->product_id, ['update' => $updateData]);
                }
            }

            // Cập nhật phân loại (nếu có)
            if (!empty($row['attr_id']) || (!empty($row['ma_phan_loai']) && $product)) {
                $attribute = null;

                if (!empty($row['attr_id'])) {
                    $attribute = ProductAttribute::find((int)$row['attr_id']);
                } elseif (!empty($row['ma_phan_loai']) && $product) {
                    $attribute = ProductAttribute::where('product_id', $product->product_id)
                        ->where('product_attribute_code', $row['ma_phan_loai'])
                        ->first();
                }

                if ($attribute && isset($row['gia'])) {
                    $cleanPrice = preg_replace('/[^0-9.]/', '', $row['gia']);
                    if (is_numeric($cleanPrice)) {
                        $attribute->update([
                            'product_price' => (float)$cleanPrice
                        ]);
                    }
                }
            }

            DB::commit();
            return null;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Lỗi import: ' . $e->getMessage());
            throw $e;
        }
    }

}
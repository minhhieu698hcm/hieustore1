<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute; // Đảm bảo lớp được import chính xác
use App\Models\Voucher;
use App\Models\Discount;
use Illuminate\Support\Facades\Redirect;
use App\Http\Imports\ProductPriceImport;
use App\Http\Exports\ProductPriceExport;
use Maatwebsite\Excel\Facades\Excel;

session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
            }else
            {
                return Redirect::to('/admin')->send();
            }
        }
   public function add_product() {
            $this->AuthLogin();
            $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'asc')->get();
            $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'asc')->get();
            $list_attribute = Attribute::orderByRaw("CAST(REGEXP_REPLACE(AttributeName, '[^0-9.]', '') AS FLOAT) ASC")->get();
            
            // $existingAttributes mặc định rỗng cho thêm mới
            $existingAttributes = []; 
            
            return view('admin.product.add_product')
                ->with('cate_product', $cate_product)
                ->with('brand_product', $brand_product)
                ->with('list_attribute', $list_attribute)
                ->with('existingAttributes', $existingAttributes);
        }
        public function all_product()
{
    $this->AuthLogin();
    $perPage = 10;

    // Lấy danh sách sản phẩm
    $all_product = Product::with(['category', 'attributes.attributeValue'])
    ->orderBy('product_id', 'desc')
    ->paginate($perPage);

    // Lấy tất cả phân loại (attribute) theo sản phẩm để hiển thị giá nhanh
    $product_ids = $all_product->pluck('product_id'); // lấy danh sách id sản phẩm trong trang này

    $list_pd_attr = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
        ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
        ->whereIn('product_attribute.product_id', $product_ids)
        ->select(
            'product_attribute.product_id',
            'product_attribute.idAttrValue',
            'product_attribute.product_attribute_code',
            'product_attribute.product_price'
        )
        ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC")
        ->get()
        ->groupBy('product_id'); // nhóm theo product_id để dùng trong foreach

    return view('admin.product.all_product', compact('all_product', 'list_pd_attr'));
}

        
        
        public function checkProductCode(Request $request) {
            $product_code = $request->input('product_code');
            $exists = DB::table('tbl_product')->where('product_code', $product_code)->exists();
            
            return response()->json(['exists' => $exists]);
        }
        
        public function save_product(Request $request)
{
    $this->AuthLogin();
    $product_code = $request->product_code;
    // Kiểm tra mã sản phẩm
    if (DB::table('tbl_product')->where('product_code', $product_code)->exists()) {
        session()->put('message', 'Mã sản phẩm đã tồn tại. Vui lòng sử dụng mã khác.');
        return Redirect::back()->withInput();
    }

    // Chuẩn bị dữ liệu sản phẩm
    $data = [
        'product_name' => $request->product_name,
        'product_Slug' => $request->product_Slug,
        'product_code' => $product_code,
        'product_price' => $request->product_price,
        'product_desc' => $request->product_desc,
        'product_content' => $request->product_content,
        'product_gale_desc' => $request->product_gale_desc,
        'category_id' => $request->product_cate,
        'brand_id' => $request->product_brand,
        'product_status' => $request->product_status,
        'favorite_product' => $request->favorite_product,
        'product_sale' => $request->product_sale,
        'product_stock_status' => $request->product_stock_status,
		'warranty_period' => $request->warranty_period ?? 24,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $path = 'public/upload/product/';
    $path_gallery = 'public/upload/gallery/';

    // Xử lý ảnh chính (product_image)
    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $extension = $image->getClientOriginalExtension();
        $new_image = $product_code . "_" . uniqid() . "." . $extension;
        $image->move($path, $new_image);
        $data['product_image'] = $new_image;
    }

    // Xử lý ảnh hover (product_image_hover)
    if ($request->hasFile('product_image_hover')) {
        $image_hover = $request->file('product_image_hover');
        $extension_hover = $image_hover->getClientOriginalExtension();
        $new_image_hover = $product_code . "_hover_" . uniqid() . "." . $extension_hover;
        $image_hover->move($path, $new_image_hover);
        $data['product_image_hover'] = $new_image_hover;
    }

    // Lưu sản phẩm vào bảng `tbl_product`
    $pro_id = DB::table('tbl_product')->insertGetId($data);

    // Xử lý ảnh gallery
    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $index => $image) {
            $extension = $image->getClientOriginalExtension();
            $new_image = $product_code . "_gallery_" . $index . "_" . uniqid() . "." . $extension;
            $image->move($path_gallery, $new_image);

            Gallery::create([
                'gallery_name' => $new_image,
                'gallery_image' => $new_image,
                'product_id' => $pro_id,
            ]);
        }
    }

    // Xử lý phân loại sản phẩm (attribute)
    if ($request->has('attribute_price')) {
        $attributes = [];
        foreach ($request->attribute_price as $key => $price) {
            $attributes[] = [
                'product_id' => $pro_id,
                'idAttrValue' => $request->chk_attr[$key] ?? null,
                'product_attribute_code' => $request->product_attribute_code[$key] ?? null,
                'product_price' => is_numeric($price) ? (float)$price : 0,
				'stock_status' => $request->attribute_stock_status[$key] ?? 1, // Lưu trạng thái
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        ProductAttribute::insert($attributes);
    }

    session()->flash('success', 'Thêm sản phẩm thành công!');
    return Redirect::to('all-product');
}

        




    public function toggleProductStatus($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        // Đảo ngược trạng thái: 1 (Hiện) => 0 (Ẩn) và ngược lại
        $product->product_status = $product->product_status ? 0 : 1;
        $product->save();
    
        return response()->json([
            'success' => true,
            'new_status' => $product->product_status
        ]);
    }

    public function toggleStockStatus($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        // Đảo ngược trạng thái, chỉ nhận 1 hoặc 0
        if ($product->product_stock_status == 1) {
            $product->product_stock_status = 0; // Còn hàng → Hết hàng
        } elseif ($product->product_stock_status == 0) {
            $product->product_stock_status = 2; // Hết hàng → Sắp về hàng
        } else {
            $product->product_stock_status = 1; // Sắp về hàng → Còn hàng
        }
        
        $product->save();


        return response()->json([
            'success' => true,
            'new_status' => $product->product_stock_status
        ]);
    }

    public function bulkToggleStock(Request $request)
    {
        $productIds = $request->input('product_ids'); // Nhận danh sách ID từ request
        $updatedProducts = [];

        if (!empty($productIds)) {
            foreach ($productIds as $id) {
                $product = Product::find($id);
                if ($product) {
                    // Cập nhật trạng thái theo chu trình: 1 -> 0 -> 2 -> 1
                    if ($product->product_stock_status == 1) {
                        $product->product_stock_status = 0; // Còn hàng → Hết hàng
                    } elseif ($product->product_stock_status == 0) {
                        $product->product_stock_status = 2; // Hết hàng → Sắp về hàng
                    } elseif ($product->product_stock_status == 2) {
                        $product->product_stock_status = 1; // Sắp về hàng → Còn hàng
                    }

                    $product->save();

                    $updatedProducts[] = [
                        'id' => $product->product_id,
                        'new_status' => $product->product_stock_status
                    ];
                }
            }
        }

        return response()->json([
            'success' => true,
            'updated_products' => $updatedProducts
        ]);
    }
    
    public function bulkToggleStatus(Request $request)
    {
        try {
            if (!$request->has('product_ids')) {
                return response()->json(['success' => false, 'message' => 'Không có sản phẩm nào được chọn!'], 400);
            }

            $productIds = $request->product_ids;

            // Lấy danh sách sản phẩm cần cập nhật
            $products = Product::whereIn('product_id', $productIds)->get();

            $updatedProducts = [];
            foreach ($products as $product) {
                $product->product_status = $product->product_status == 1 ? 0 : 1;
                $product->save();

                $updatedProducts[] = [
                    'id' => $product->product_id,
                    'new_status' => $product->product_status
                ];
            }

            return response()->json(['success' => true, 'updated_products' => $updatedProducts]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại!'], 500);
        }
    }

public function searchProduct(Request $request)
{
    $rawKeyword = $request->input('keyword');
    $keyword = mb_strtolower(trim($rawKeyword), 'UTF-8');

    // Lấy danh sách product trước
    $query = Product::select([
            'tbl_product.product_id', 
            'tbl_product.product_name', 
            'tbl_product.product_code',
            'tbl_product.product_image', 
            'tbl_product.product_slug', 
            'tbl_product.product_status', 
            'tbl_product.product_stock_status',
            DB::raw('COALESCE(tbl_product.product_price, 0) as product_price') // đảm bảo giá luôn có số
        ])
        ->with(['attributes' => function($q) {
            $q->join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
              ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
              ->select(
                  'product_attribute.*',
                  'attribute_value.AttrValName'
              )
              ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC");
        }]);

    if ($keyword !== '') {
        $query->where(function($q) use ($keyword) {
            $q->whereRaw("LOWER(product_name) COLLATE utf8mb4_bin LIKE ?", ["%{$keyword}%"])
              ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_bin LIKE ?", ["%{$keyword}%"]);
        })
        ->orWhereHas('attributes', function($attr) use ($keyword) {
            $attr->where(function($q) use ($keyword) {
                $q->whereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_bin = ?", [$keyword])
                  ->orWhereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_bin LIKE ?", ["%{$keyword}%"]);
            });
        });
    }

    $products = $query
        ->orderByRaw("CASE WHEN LOWER(product_name) COLLATE utf8mb4_bin LIKE CONCAT('{$keyword}', '%') THEN 0 ELSE 1 END")
        ->orderBy('product_id', 'desc')
        ->orderByRaw("LOCATE('{$keyword}', LOWER(product_name) COLLATE utf8mb4_bin) ASC")
        ->get();

    // Sắp xếp lại attributes cho từng product nếu có
    $products->transform(function($product) {
        if ($product->attributes && $product->attributes->count() > 0) {
            $product->attributes = $product->attributes->sortBy(function($a) {
                return preg_replace('/[^0-9.]/', '', $a->AttrValName ?? '');
            })->values();
        }
        return $product;
    });

    return response()->json([
        'products' => $products
    ]);
}
    public function update_product_price(Request $request, $product_id)
{
    $this->AuthLogin();

    // Lưu giá product (nếu người chỉnh riêng product_price)
    $priceFromRequest = $request->input('price', null);

    // Cập nhật giá product_attribute nếu có
    $attributes = $request->input('attributes', []);
    foreach ($attributes as $attr) {
        DB::table('product_attribute')
            ->where('product_id', $product_id)
            ->where('idAttrValue', $attr['idAttrValue'])
            ->update([
                'product_price' => (float) $attr['price'],
                'updated_at' => now(),
            ]);
    }

    // Nếu có attributes gửi lên, cập nhật product_price = giá phân loại đầu tiên theo thứ tự AttrValName
    if (count($attributes) > 0) {
        // Lấy giá phân loại đầu tiên theo thứ tự giống edit_product
        $firstAttrPrice = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
            ->where('product_attribute.product_id', $product_id)
            ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC")
            ->value('product_attribute.product_price');

        if ($firstAttrPrice !== null) {
            DB::table('tbl_product')->where('product_id', $product_id)->update([
                'product_price' => (float) $firstAttrPrice,
                'updated_at' => now(),
            ]);
        }
    } else {
        // Nếu không có attributes, update product_price theo giá gửi (nếu có)
        if (!is_null($priceFromRequest)) {
            DB::table('tbl_product')->where('product_id', $product_id)->update([
                'product_price' => (float) $priceFromRequest,
                'updated_at' => now(),
            ]);
        }
    }

    // Trả về giá mới để frontend cập nhật DOM nếu cần
    $product = DB::table('tbl_product')->where('product_id', $product_id)->first();

    return response()->json([
        'message' => 'Cập nhật giá thành công!',
        'product_price' => $product->product_price,
    ]);
}

    
    public function edit_product($product_id){
        $this->AuthLogin();
		session(['previous_url' => url()->previous()]);
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','asc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $gallery_images = DB::table('tbl_gallery')->where('product_id', $product_id)->get();
    
        // Lấy nhóm phân loại (Attribute)
        $list_attribute = Attribute::orderByRaw("CAST(REGEXP_REPLACE(AttributeName, '[^0-9.]', '') AS FLOAT) DESC")->get(); // Lấy danh sách tất cả các nhóm phân loại
    
        $name_attribute = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
        ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
        ->where('product_attribute.product_id', $product_id)
        ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC")
        ->first();

        $list_pd_attr = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
        ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
        ->where('product_attribute.product_id', $product_id)
        ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC")
        ->get();

            
        $manager_product = view('admin.product.edit_product')
            ->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product)
            ->with('gallery_images', $gallery_images)
            ->with('name_attribute', $name_attribute)
            ->with('list_pd_attr', $list_pd_attr)
            ->with('list_attribute', $list_attribute); // Truyền thêm biến list_attribute vào view
		
        
        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }
    
    public function update_product(Request $request, $product_id)
{
    $this->AuthLogin();

    $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
    if (!$product) {
        session()->put('message', 'Sản phẩm không tồn tại!');
        return Redirect::back();
    }

    $product_code = $request->product_code;

    // Kiểm tra trùng mã sản phẩm
    if ($product->product_code !== $product_code) {
        $existing = DB::table('tbl_product')->where('product_code', $product_code)->first();
        if ($existing) {
            session()->put('message', 'Mã sản phẩm đã tồn tại. Vui lòng nhập mã khác.');
            return Redirect::back()->withInput();
        }
    }

    $data = [
        'product_name' => $request->product_name,
        'product_Slug' => $request->product_Slug,
        'product_code' => $product_code,
        'product_price' => $request->product_price,
        'product_desc' => $request->product_desc,
        'product_content' => $request->product_content,
        'product_gale_desc' => $request->product_gale_desc,
        'category_id' => $request->product_cate,
        'brand_id' => $request->product_brand,
        'product_status' => $request->product_status,
        'favorite_product' => $request->favorite_product,
        'product_sale' => $request->product_sale,
        'product_stock_status' => $request->product_stock_status,
		'warranty_period' => $request->warranty_period ?? 24,
        'updated_at' => now(),
    ];

    $path = 'public/upload/product/';
    $path_gallery = 'public/upload/gallery/';

    // Cập nhật ảnh chính
    if ($request->hasFile('product_image')) {
        if ($product->product_image && file_exists($path . $product->product_image)) {
            unlink($path . $product->product_image);
        }

        $image = $request->file('product_image');
        $new_image = $product_code . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move($path, $new_image);
        $data['product_image'] = $new_image;
    }

    // Cập nhật ảnh hover
    if ($request->hasFile('product_image_hover')) {
        if ($product->product_image_hover && file_exists($path . $product->product_image_hover)) {
            unlink($path . $product->product_image_hover);
        }

        $image_hover = $request->file('product_image_hover');
        $new_image_hover = $product_code . "_hover_" . uniqid() . "." . $image_hover->getClientOriginalExtension();
        $image_hover->move($path, $new_image_hover);
        $data['product_image_hover'] = $new_image_hover;
    }

    // Cập nhật bảng sản phẩm
    DB::table('tbl_product')->where('product_id', $product_id)->update($data);

    // ==== XỬ LÝ GALLERY ====

    // Lấy danh sách ảnh cũ giữ lại từ input hidden
    $oldImages = array_filter(explode(',', $request->input('old_images', '')));

$existingGallery = Gallery::where('product_id', $product_id)->get();

foreach ($existingGallery as $gallery) {
    if (!in_array($gallery->gallery_image, $oldImages)) {
        $galleryPath = $path_gallery . $gallery->gallery_image;
        if (file_exists($galleryPath)) {
            unlink($galleryPath);
        }
        // CHỈ xóa tấm ảnh này
        Gallery::where('gallery_id', $gallery->gallery_id)->delete();
    }
}


    // Thêm ảnh mới
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $index => $image) {
            $extension = $image->getClientOriginalExtension();
            $new_image = $product_code . "_gallery_" . $index . "_" . uniqid() . "." . $extension;
            $image->move($path_gallery, $new_image);

            Gallery::create([
                'gallery_name' => $new_image,
                'gallery_image' => $new_image,
                'product_id' => $product_id,
            ]);
        }
    }

    // ==== XỬ LÝ PHÂN LOẠI ====

    $has_existing_attrs = DB::table('product_attribute')->where('product_id', $product_id)->exists();
    $has_new_attrs = $request->has('attribute_price') && count($request->attribute_price) > 0;

    if ($has_new_attrs) {
        DB::table('product_attribute')->where('product_id', $product_id)->delete();

        $insert_attrs = [];
        foreach ($request->attribute_price as $key => $price) {
            $insert_attrs[] = [
                'product_id' => $product_id,
                'idAttrValue' => $request->chk_attr[$key] ?? null,
                'product_attribute_code' => $request->product_attribute_code[$key] ?? null,
                'product_price' => is_numeric($price) ? (float)$price : 0,
				'stock_status' => $request->attribute_stock_status[$key] ?? 1, // Lưu trạng thái
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        ProductAttribute::insert($insert_attrs);
    } elseif ($has_existing_attrs && !$has_new_attrs) {
        DB::table('product_attribute')->where('product_id', $product_id)->delete();
    }

    session()->flash('success', 'Cập nhật sản phẩm thành công!');
    return redirect()->to(session('previous_url', 'all-product'));
}
    

    public function delete_product($product_id) {
        $this->AuthLogin();
    
        // Lấy thông tin sản phẩm
        $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        if ($product) {
            // Đường dẫn lưu trữ ảnh
            $path = 'public/upload/product/';
            $path_gallery = 'public/upload/gallery/';
            
            // Xóa ảnh sản phẩm chính và ảnh chuyển đổi từ thư mục
            if (file_exists($path . $product->product_image)) {
                unlink($path . $product->product_image);
            }
            
            if (file_exists($path . $product->product_image_hover)) {
                unlink($path . $product->product_image_hover);
            }
            
            // Xóa tất cả ảnh trong gallery liên quan đến sản phẩm
            $gallery_images = DB::table('tbl_gallery')->where('product_id', $product_id)->get();
            foreach ($gallery_images as $gallery_image) {
                $gallery_image_path = $path_gallery . $gallery_image->gallery_image;
                if (file_exists($gallery_image_path)) {
                    unlink($gallery_image_path);
                }
                // Xóa bản ghi gallery
                DB::table('tbl_gallery')->where('gallery_id', $gallery_image->gallery_id)->delete();
            }
            
            // Xóa sản phẩm khỏi bảng
            DB::table('tbl_product')->where('product_id', $product_id)->delete();

            // Xóa phân loại sản phẩm khỏi bảng
            DB::table('product_attribute')->where('product_id', $product_id)->delete();
            
            // Thông báo xóa thành công
            session()->flash('success', 'Xóa sản phẩm và các ảnh liên quan thành công');
        } else {
            session()->flash('message', 'Sản phẩm không tồn tại');
        }
    
        return Redirect::to('all-product');
    }    
    
    public function getProductAttributes(Request $request)
    {
        $product_id = $request->product_id;
        $attributes = DB::table('product_attributes')
            ->join('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')
            ->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->select(
                'product_attributes.*',
                'attribute_values.id as attribute_value_id',
                'attribute_values.name as attribute_value_name',
                'attributes.name as attribute_group_name'
            )
            ->where('product_attributes.product_id', $product_id)
            ->get();

        return response()->json($attributes);
    }


/*===================================================== PAGES ===================================================== */
/*================================================================================================================= */


protected function applyDiscount($products, $discounts)
{
    foreach ($products as $product) {
        $price = floatval($product->product_price);
        if ($price === 0 || $product->product_price === 'LIÊN HỆ') continue;

        $categoryId = $product->category_id;
        $discount = $discounts[$categoryId] ?? $discounts[0] ?? null; // ưu tiên theo category, nếu không có thì dùng discount all

        if ($discount) {
            $product->original_price = $price;
            $product->discount_percent = $discount;
            $product->product_price = round($price * (1 - $discount / 100));
        }
    }

    return $products;
}

    public function product(Request $request)
{
    $cate_product = Category::where('category_status', 1)->withCount(['products' => function($query) {
        $query->where('product_status', '1');
    }])->orderBy('category_name', 'asc')->get();

    $brand_product = Brand::get();
    $attr_length = AttributeValue::where('idAttribute', '1')->orderByRaw("CAST(REGEXP_REPLACE(AttrValName, '[^0-9.]', '') AS DOUBLE) ASC")->get();
    $attr_color = AttributeValue::where('idAttribute', '2')->get();

    $query = Product::where('product_status', '1');

    if ($request->has('category')) {
        $query->whereIn('category_id', $request->category);
    }

    if ($request->has('sort_by')) {
        switch ($request->input('sort_by')) {
            case 'best_selling':
                $query->where('favorite_product', 1)->orderby('product_id', 'desc');
                break;
            case 'on_sale':
                $query->where('product_sale', 1)->orderby('product_id', 'desc');
                break;
            case 'price_asc':
                $query->orderByRaw("CAST(NULLIF(product_price, 'LIÊN HỆ') AS UNSIGNED) ASC, product_id DESC");
                break;
            case 'price_desc':
                $query->orderByRaw("CAST(NULLIF(product_price, 'LIÊN HỆ') AS UNSIGNED) DESC, product_id DESC" );
                break;
            default:
                $query->orderby('product_id', 'desc');
                break;
        }
    } else {
        $query->orderby('product_id', 'desc');
    }

    $perPage = 9;
	$currentPage = (int) $request->input('page', 1); // ép kiểu integer
	if ($currentPage < 1) $currentPage = 1;          // phòng người dùng nhập page=0 hoặc âm

	$length = (int) $query->count();                 // đảm bảo luôn là số
	$totalPages = (int) ceil($length / $perPage);    // ép kiểu tránh lỗi float/string
	$start = ($currentPage - 1) * $perPage + 1;
	$end = min($currentPage * $perPage, $length);

    $all_product = $query->skip(($currentPage - 1) * $perPage)->take($perPage)->get();

    // === Áp dụng giảm giá ===
    $discounts = Discount::pluck('percent', 'category_id')->toArray();
    $all_product = $this->applyDiscount($all_product, $discounts);

    $pagination = pagination($currentPage, $totalPages);
	 // =============== SEO META TAGS ===============
    $metaTitle = 'Sản phẩm Unitek | Mua cáp HDMI, USB, phụ kiện công nghệ chính hãng';
    $metaDescription = 'Danh sách sản phẩm Unitek: cáp HDMI, USB, dock sạc, bộ chuyển đổi và nhiều phụ kiện công nghệ cao cấp. Giao hàng toàn quốc, hỗ trợ 24/7.';
    $metaKeywords = 'Unitek, cáp HDMI, USB, phụ kiện công nghệ, bộ chuyển đổi, dock sạc, linh kiện máy tính, sản phẩm Unitek chính hãng';
    $ogImage = asset('public/frontend/images/default-og-image.jpg');
    $canonicalUrl = url('/san-pham');
	
    if ($request->ajax()) {
        return response()->json([
            'html' => view('pages.product.product_filter', compact('all_product', 'cate_product'))->render(),
            'pagination' => view('pages.product.pagination', compact('pagination', 'currentPage', 'totalPages'))->render(),
            'start' => $start, 
            'end' => $end,     
            'total' => $length
        ]);
    }

    return view('pages.product.product_all')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('attr_length', $attr_length)
        ->with('attr_color', $attr_color)
        ->with('all_product', $all_product)
        ->with('pagination', $pagination)
        ->with('currentPage', $currentPage)
        ->with('totalPages', $totalPages)
        ->with('start', $start)  
        ->with('end', $end)       
        ->with('total', $length)
		  // SEO
        ->with('title', $metaTitle)
        ->with('description', $metaDescription)
        ->with('keywords', $metaKeywords)
        ->with('og_title', $metaTitle)
        ->with('og_description', $metaDescription)
        ->with('og_image', $ogImage)
        ->with('og_url', $canonicalUrl)
        ->with('canonical', $canonicalUrl);
		
		
}

/**
 * Hiển thị sản phẩm theo category slug - SEO Friendly
 * Route: /san-pham/{category_slug}
 */
public function productByCategory(Request $request, $categorySlug)
{
    // Lấy category theo slug
    $category = Category::where('category_slug', $categorySlug)
        ->where('category_status', 1)
        ->firstOrFail();

    $cate_product = Category::where('category_status', 1)->withCount(['products' => function($query) {
        $query->where('product_status', '1');
    }])->orderBy('category_name', 'asc')->get();

    $brand_product = Brand::get();
    $attr_length = AttributeValue::where('idAttribute', '1')->orderByRaw("CAST(REGEXP_REPLACE(AttrValName, '[^0-9.]', '') AS DOUBLE) ASC")->get();
    $attr_color = AttributeValue::where('idAttribute', '2')->get();

    // Query sản phẩm theo category này
    $query = Product::where('product_status', '1')
        ->where('category_id', $category->category_id);

    if ($request->has('sort_by')) {
        switch ($request->input('sort_by')) {
            case 'best_selling':
                $query->where('favorite_product', 1)->orderby('product_id', 'desc');
                break;
            case 'on_sale':
                $query->where('product_sale', 1)->orderby('product_id', 'desc');
                break;
            case 'price_asc':
                $query->orderByRaw("CAST(NULLIF(product_price, 'LIÊN HỆ') AS UNSIGNED) ASC, product_id DESC");
                break;
            case 'price_desc':
                $query->orderByRaw("CAST(NULLIF(product_price, 'LIÊN HỆ') AS UNSIGNED) DESC, product_id DESC");
                break;
            default:
                $query->orderby('product_id', 'desc');
                break;
        }
    } else {
        $query->orderby('product_id', 'desc');
    }

    $perPage = 9;
    $currentPage = (int) $request->input('page', 1);
    if ($currentPage < 1) $currentPage = 1;

    $length = (int) $query->count();
    $totalPages = (int) ceil($length / $perPage);
    $start = ($currentPage - 1) * $perPage + 1;
    $end = min($currentPage * $perPage, $length);

    $all_product = $query->skip(($currentPage - 1) * $perPage)->take($perPage)->get();

    // === Áp dụng giảm giá ===
    $discounts = Discount::pluck('percent', 'category_id')->toArray();
    $all_product = $this->applyDiscount($all_product, $discounts);

    $pagination = pagination($currentPage, $totalPages);

    // =============== SEO META TAGS ===============
    $metaTitle = $category->category_name . ' | Sản phẩm Unitek';
    $metaDescription = $category->category_desc ? Str::limit(strip_tags($category->category_desc), 160, '...') : 'Danh sách sản phẩm ' . $category->category_name . ' Unitek chính hãng.';
    $metaKeywords = 'Unitek, ' . $category->category_name . ', cáp HDMI, USB, phụ kiện công nghệ';
    $ogImage = asset('public/frontend/images/default-og-image.jpg');
    $canonicalUrl = url('/san-pham/' . $categorySlug);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('pages.product.product_filter', compact('all_product', 'cate_product'))->render(),
            'pagination' => view('pages.product.pagination', compact('pagination', 'currentPage', 'totalPages'))->render(),
            'start' => $start,
            'end' => $end,
            'total' => $length
        ]);
    }

    return view('pages.product.product_all')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('attr_length', $attr_length)
        ->with('attr_color', $attr_color)
        ->with('all_product', $all_product)
        ->with('pagination', $pagination)
        ->with('currentPage', $currentPage)
        ->with('totalPages', $totalPages)
        ->with('start', $start)
        ->with('end', $end)
        ->with('total', $length)
        // SEO
        ->with('title', $metaTitle)
        ->with('description', $metaDescription)
        ->with('keywords', $metaKeywords)
        ->with('og_title', $metaTitle)
        ->with('og_description', $metaDescription)
        ->with('og_image', $ogImage)
        ->with('og_url', $canonicalUrl)
        ->with('canonical', $canonicalUrl);
}


public function Quickview($id)
{
    $product = Product::find($id);
    $gallery = Gallery::where('product_id', $id)->get();

    // Lấy discount theo category hoặc default
    $discount = Discount::where('category_id', $product->category_id)->first()
        ?? Discount::where('category_id', 0)->first();

    // Tính giá sau giảm cho sản phẩm không phân loại
    $product->original_price = $product->product_price;
    $product->discount_percent = 0;
    $product->final_price = $product->product_price;

    if ($discount && is_numeric($product->product_price) && $product->product_price > 0) {
        $percent = floatval($discount->percent);
        $product->discount_percent = $percent;
        $product->final_price = round($product->product_price * (1 - $percent / 100), 0);
    }
    // Lấy phân loại và áp dụng giảm giá
    $attributes = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
        ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
        ->where('product_attribute.product_id', $id)
        ->orderByRaw("CAST(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') AS FLOAT) ASC")
        ->get([
            'attribute.AttributeName', 
            'attribute_value.AttrValName', 
            'product_attribute.product_attribute_code', 
            'attribute.idAttribute',
            'product_attribute.product_price',
			'product_attribute.stock_status',
        ])
        ->map(function ($attr) use ($discount) {
            $attr->original = $attr->product_price;
            $attr->percent = 0;
            $attr->final_price = $attr->product_price;

            if ($discount && is_numeric($attr->product_price) && $attr->product_price > 0) {
                $attr->percent = floatval($discount->percent);
                $attr->final_price = round($attr->product_price * (1 - $attr->percent / 100), 0);
            }

            return $attr;
        });

    return response()->json([
        'product' => $product,
        'gallery' => $gallery,
        'attributes' => $attributes,
    ]);
}

/**
 * Hiển thị trang sản phẩm đơn với SEO optimization
 * Route: /san-pham/{slug}
 */
public function show($slug)
{
    $product = Product::where('product_slug', $slug)
        ->where('product_status', '1')
        ->firstOrFail();

    // Lấy ảnh sản phẩm cho OG Image
    $ogImage = $product->product_image 
        ? asset('public/upload/product/' . $product->product_image)
        : asset('public/frontend/images/default-og-image.jpg');

    return view('product_single', [
        'product' => $product,
        'meta_title' => $product->product_name . ' | Unitek Việt Nam',
        'meta_description' => Str::limit(strip_tags($product->product_desc), 160),
        'meta_keywords' => 'Unitek, ' . $product->product_name . ', ' . $product->product_code . ', cáp HDMI, USB, dock sạc',
        'og_image' => $ogImage,
        'og_url' => route('product.show', $product->product_slug),
    ]);
}

public function product_details($product_Slug, $attribute_code = null)
{
    $cate_product = Category::get();
    $brand_product = Brand::get();

    $product_details = Product::where('product_slug', $product_Slug)
        ->where('product_status', '1')
        ->firstOrFail();

    $stock_status = $product_details->product_stock_status == 1 ? 'Còn hàng' : 'Hết hàng';

    $gallery = Gallery::where('product_id', $product_details->product_id)->get();

    $related_product = Product::where('category_id', $product_details->category_id)
        ->where('product_id', '!=', $product_details->product_id)
        ->take(8)->get();

    $upsell_product = Product::where('category_id', '!=', $product_details->category_id)
        ->where('product_id', '!=', $product_details->product_id)
        ->take(8)->get();

    // =============== GIẢM GIÁ CHO SẢN PHẨM KHÔNG PHÂN LOẠI ===============
    $product_details->original_price = $product_details->product_price;
    $discount = Discount::where('category_id', $product_details->category_id)->first()
        ?? Discount::where('category_id', 0)->first();

    if ($discount && is_numeric($product_details->product_price) && $product_details->product_price > 0) {
        $discountPercent = floatval($discount->percent);
        $finalPrice = $product_details->product_price * (1 - $discountPercent / 100);
        $product_details->discount_percent = $discountPercent;
        $product_details->final_price = round($finalPrice, 0);
        $product_details->product_price = $product_details->final_price;
    } else {
        $product_details->discount_percent = 0;
        $product_details->final_price = $product_details->product_price;
    }

    // =============== GIẢM GIÁ CHO SẢN PHẨM PHÂN LOẠI ===============
    $attributes = ProductAttribute::join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
        ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
        ->where('product_attribute.product_id', $product_details->product_id)
        ->orderByRaw("CONVERT(REGEXP_REPLACE(attribute_value.AttrValName, '[^0-9.]', '') , FLOAT) ASC")
        ->get([
            'attribute.AttributeName',
            'attribute_value.AttrValName',
            'product_attribute.product_attribute_code',
            'attribute.idAttribute',
            'product_attribute.product_price as original_price',
			 'product_attribute.stock_status', // Thêm dòng này
        ]);

    foreach ($attributes as $attr) {
        $attr->discount_percent = 0;
        $attr->final_price = $attr->original_price;

        if ($discount && is_numeric($attr->original_price) && $attr->original_price > 0) {
            $attr->discount_percent = floatval($discount->percent);
            $attr->final_price = round($attr->original_price * (1 - $discount->percent / 100), 0);
        }

        $attr->product_price = $attr->final_price;
    }
   // ============================
        // GIẢM GIÁ CHO RELATED PRODUCT
        // ============================
        foreach ($related_product as $product) {

        $relDiscount = Discount::where('category_id', $product->category_id)->first()
            ?? Discount::where('category_id', 0)->first();

        if ($relDiscount && is_numeric($product->product_price) && $product->product_price > 0) {

            $relPercent = floatval($relDiscount->percent);
            $original = $product->product_price;

            $product->original_price = $original; // ✅ chỉ set khi có giảm
            $product->discount_percent = $relPercent;
            $product->final_price = round($original * (1 - $relPercent / 100), 0);
            $product->product_price = $product->final_price;

        } else {
            // ❌ KHÔNG gán original_price
            $product->discount_percent = 0;
            $product->final_price = $product->product_price;
        }
    }

    // ============================
        // GIẢM GIÁ CHO UPSELL PRODUCT
        // ============================
        foreach ($upsell_product as $product) {

        $upDiscount = Discount::where('category_id', $product->category_id)->first()
            ?? Discount::where('category_id', 0)->first();

        if ($upDiscount && is_numeric($product->product_price) && $product->product_price > 0) {

            $upPercent = floatval($upDiscount->percent);
            $original = $product->product_price;

            $product->original_price = $original; // ✅ chỉ khi có giảm
            $product->discount_percent = $upPercent;
            $product->final_price = round($original * (1 - $upPercent / 100), 0);
            $product->product_price = $product->final_price;

        } else {
            // ❌ KHÔNG set original_price
            $product->discount_percent = 0;
            $product->final_price = $product->product_price;
        }
    }
	 // =============== SEO META TAGS ===============
    $metaTitle = $product_details->product_name . ' - Mã: ' . $product_details->product_code . ' | Unitek Việt Nam';
    $metaDescription = Str::limit(strip_tags($product_details->product_desc), 160, '...');
    $metaKeywords = 'Unitek, ' . $product_details->product_name . ', ' . $product_details->product_code . ', ' . ($product_details->category->category_name ?? 'Sản phẩm') . ', cáp HDMI, USB, phụ kiện công nghệ';
    
    // OG Image
    $ogImage = $product_details->product_image 
        ? asset('public/upload/product/' . $product_details->product_image)
        : asset('public/frontend/images/default-og-image.jpg');
    
    // URL canonical
    $canonicalUrl = url('/chi-tiet-san-pham/' . $product_Slug);
	
    return view('pages.product.product_single', [
        'category' => $cate_product,
        'brand' => $brand_product,
        'product_details' => $product_details,
        'gallery' => $gallery,
        'related_product' => $related_product,
        'upsell_product' => $upsell_product,
        'attributes' => $attributes,
        'stock_status' => $stock_status,
        'selected_code' => $attribute_code,
		// SEO
        'title' => $metaTitle,
        'description' => $metaDescription,
        'keywords' => $metaKeywords,
        'og_title' => $metaTitle,
        'og_description' => $metaDescription,
        'og_image' => $ogImage,
        'og_url' => $canonicalUrl,
        'canonical' => $canonicalUrl,
    ]);
}
	
    public function search(Request $request)
    {
        // Nhận query, giải mã, chuyển về chữ thường và loại bỏ khoảng trắng
        $query = mb_strtolower(trim(urldecode($request->input('query', ''))), 'UTF-8');
        $filterCategory = $request->input('filter_category', '');
        $sortBy = $request->input('sort_by', 'newest');
    
        // Lấy danh mục, thương hiệu, attribute (phân loại cũ)
        $brand_product = Brand::get();
        $attr_length   = AttributeValue::where('idAttribute', '1')->get();
        $attr_color    = AttributeValue::where('idAttribute', '2')->get();
    
        // Đếm sản phẩm theo danh mục với điều kiện tìm kiếm: tên, mã sản phẩm và mã thuộc attribute
        $cate_product = Category::where('category_status', 1)->withCount(['products' => function($productQuery) use ($query) {
            $productQuery->where('product_status', '1')
                ->where(function ($q) use ($query) {
                    $q->whereRaw("LOWER(product_name) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"])
                      ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_vietnamese_ci = ?", [$query])
                      ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"])
                      ->orWhereHas('attributes', function($attr) use ($query) {
                          $attr->where(function($q) use ($query) {
                              $q->whereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_vietnamese_ci = ?", [$query])
                                ->orWhereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"]);
                          });
                      });
                });
        }])->get();
    
        $productQuery = Product::where('product_status', 1)
    ->where(function ($q) use ($query) {
        $q->where(function ($q2) use ($query) {
            $q2->whereRaw("LOWER(product_name) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"])
               ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_vietnamese_ci = ?", [$query])
               ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"]);
        })->orWhereHas('attributes', function($attr) use ($query) {
            $attr->where(function($q) use ($query) {
                $q->whereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_vietnamese_ci = ?", [$query])
                  ->orWhereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_vietnamese_ci LIKE ?", ["%{$query}%"]);
            });
        });
    });
    
        // Lọc theo danh mục nếu có
        if ($request->has('category')) {
            $productQuery->whereIn('category_id', $request->category);
        }   
    
        // Sắp xếp theo tiêu chí phụ nếu có
        switch ($request->input('sort_by')) {
        case 'best_selling':
            $productQuery->where('favorite_product', 1)->orderBy('product_id', 'desc');
            break;
        case 'on_sale':
            $productQuery->where('product_sale', 1)->orderBy('product_id', 'desc');
            break;
        case 'price_asc':
            $productQuery->orderByRaw("CAST(NULLIF(product_price, 'Liên hệ') AS UNSIGNED) ASC, product_id DESC");
            break;
        case 'price_desc':
            $productQuery->orderByRaw("CAST(NULLIF(product_price, 'Liên hệ') AS UNSIGNED) DESC, product_id DESC");
            break;
        default:
            $productQuery->orderBy('product_id', 'desc');
            break;
    }
        // Pagination
        $perPage = 9;
        $currentPage = $request->input('page', 1);
        $length = $productQuery->count();
        $totalPages = ceil($length / $perPage);
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($currentPage * $perPage, $length);

        $all_product = $productQuery->skip(($currentPage - 1) * $perPage)->take($perPage)->get();
        $pagination = pagination($currentPage, $totalPages);

        // === Áp dụng giảm giá ===
    $discounts = Discount::pluck('percent', 'category_id')->toArray();
    $all_product = $this->applyDiscount($all_product, $discounts);
	  // =============== SEO META TAGS ===============
    $metaTitle = 'Tìm kiếm: "' . $query . '" | Sản phẩm Unitek';
    $metaDescription = 'Kết quả tìm kiếm cho "' . $query . '": cáp HDMI, USB, phụ kiện công nghệ Unitek chính hãng. Tìm thấy ' . $length . ' sản phẩm phù hợp.';
    $metaKeywords = 'Unitek, ' . $query . ', cáp HDMI, USB, phụ kiện công nghệ, sản phẩm Unitek';
    $ogImage = asset('public/frontend/images/default-og-image.jpg');
    $canonicalUrl = url('/search?query=' . urlencode($query));
		
	
        // Xử lý ajax request
        if ($request->ajax()) {
            return response()->json([
                'html' => view('pages.product.product_filter', compact('all_product'))->render(),
                'pagination' => view('pages.product.pagination', compact('pagination', 'currentPage', 'totalPages'))->render(),
                'start' => $start,
                'end' => $end,
                'total' => $length
            ]);
        }
    
        return view('pages.product.product_all')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('attr_length', $attr_length)
            ->with('attr_color', $attr_color)
            ->with('all_product', $all_product)
            ->with('pagination', $pagination)
            ->with('currentPage', $currentPage)
            ->with('totalPages', $totalPages)
            ->with('start', $start)
            ->with('end', $end)
            ->with('total', $length)
			// SEO
            ->with('title', $metaTitle)
            ->with('description', $metaDescription)
            ->with('keywords', $metaKeywords)
            ->with('og_title', $metaTitle)
            ->with('og_description', $metaDescription)
            ->with('og_image', $ogImage)
            ->with('og_url', $canonicalUrl)
            ->with('canonical', $canonicalUrl);

    }
    

public function autocomplete_ajax(Request $request)
{
    $query = mb_strtolower(trim($request->get('query')), 'UTF-8');

    if ($query !== '') {
         $products = Product::where('product_status', 1) // luôn check sp chính hiển thị
            ->where(function ($q) use ($query) {
                $q->whereRaw("LOWER(product_name) COLLATE utf8mb4_bin LIKE ?", ["%{$query}%"])
                  ->orWhereRaw("LOWER(product_code) COLLATE utf8mb4_bin LIKE ?", ["%{$query}%"])
                  ->orWhereHas('productAttributes', function ($q) use ($query) {
                      $q->whereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_bin LIKE ?", ["%{$query}%"]);
                  });
            })
            ->with(['attributes' => function ($q) use ($query) {
                $q->join('attribute_value', 'attribute_value.idAttrValue', '=', 'product_attribute.idAttrValue')
                  ->join('attribute', 'attribute.idAttribute', '=', 'attribute_value.idAttribute')
                  ->whereRaw("LOWER(product_attribute_code) COLLATE utf8mb4_bin LIKE ?", ["%{$query}%"])
                  ->select(
                      'product_attribute.product_id',
                      'product_attribute.product_attribute_code',
                      'product_attribute.product_price',
                      'attribute.AttributeName',
                      'attribute_value.AttrValName'
                  );
            }])
            ->select('product_id', 'product_name', 'product_code', 'product_price', 'product_image', 'product_slug', 'category_id')
            ->orderByRaw("CASE WHEN LOWER(product_name) COLLATE utf8mb4_bin LIKE CONCAT('{$query}', '%') THEN 0 ELSE 1 END")
            ->orderBy('product_id', 'desc')
            ->orderByRaw("LOCATE('{$query}', LOWER(product_name) COLLATE utf8mb4_bin) ASC")
            ->limit(10)
            ->get();

        $results = [];

        foreach ($products as $product) {
            $discount = Discount::where('category_id', $product->category_id)->first()
                ?? Discount::where('category_id', 0)->first();

            if ($product->attributes->count() > 0) {
                foreach ($product->attributes as $attr) {
                    $originalPrice = $attr->product_price;
                    $finalPrice = $originalPrice;
                    $discountPercent = 0;

                    if ($discount && is_numeric($originalPrice) && $originalPrice > 0) {
                        $discountPercent = floatval($discount->percent);
                        $finalPrice = round($originalPrice * (1 - $discountPercent / 100), 0);
                    }

                    $results[] = [
                        'product_slug'       => $product->product_slug,
                        'product_image'      => $product->product_image,
                        'product_name'       => $product->product_name . ' (' . $attr->AttrValName . ')',
                        'product_code'       => $attr->product_attribute_code,
                        'original_price'     => $originalPrice,
                        'price'              => $finalPrice,
                        'discount_percent'   => $discountPercent,
                        'productAttributeCode' => $attr->product_attribute_code,
                    ];
                }
            } else {
                $originalPrice = $product->product_price;
                $finalPrice = $originalPrice;
                $discountPercent = 0;

                if ($discount && is_numeric($originalPrice) && $originalPrice > 0) {
                    $discountPercent = floatval($discount->percent);
                    $finalPrice = round($originalPrice * (1 - $discountPercent / 100), 0);
                }

                $results[] = [
                    'product_slug'       => $product->product_slug,
                    'product_image'      => $product->product_image,
                    'product_name'       => $product->product_name,
                    'product_code'       => $product->product_code,
                    'original_price'     => $originalPrice,
                    'price'              => $finalPrice,
                    'discount_percent'   => $discountPercent,
                    'productAttributeCode' => null,
                ];
            }
        }

        return response()->json($results);
    }

    return response()->json([
        'message' => 'Không có từ khóa tìm kiếm',
        'data' => []
    ]);
}

	public function add_voucher()
    {
        return view("admin.voucher.add_voucher");
    }

    // Thêm mã giảm giá
    public function submit_add_voucher(Request $request)
    {
        $data = $request->all();

        $select_voucher = Voucher::where('VoucherCode', $data['VoucherCode'])->first();

        if ($select_voucher) {
            return redirect()->back()->with('error', 'Mã giảm giá này đã tồn tại');
        } else {
            $voucher = new Voucher();
            $voucher->VoucherName = $data['VoucherName'];
            $voucher->VoucherQuantity = $data['VoucherQuantity'];
            $voucher->VoucherCondition = $data['VoucherCondition'];
            $voucher->VoucherNumber = $data['VoucherNumber'];
            $voucher->VoucherCode = $data['VoucherCode'];
            $voucher->bill_price_min = $data['bill_price_min'];
            $voucher->discount_max = $data['discount_max'];
            $voucher->VoucherStart = $data['VoucherStart'];
            $voucher->VoucherEnd = $data['VoucherEnd'];
            $voucher->created_at = now();
            $voucher->save();
            session()->flash('success','Thêm mã giảm giá thành công');
            return redirect()->route('admin.manage_voucher');
        }
    }

    // Sửa mã giảm giá
    public function submit_edit_voucher(Request $request, $idVoucher)
    {
        $data = $request->all();
        $select_voucher = Voucher::where('VoucherCode', $data['VoucherCode'])->whereNotIn('idVoucher', [$idVoucher])->first();

        if ($select_voucher) {
            return redirect()->back()->with('error', 'Mã giảm giá này đã tồn tại');
        } else {
            $voucher = Voucher::find($idVoucher);
            $voucher->VoucherName = $data['VoucherName'];
            $voucher->VoucherQuantity = $data['VoucherQuantity'];
            $voucher->VoucherCondition = $data['VoucherCondition'];
            $voucher->VoucherNumber = $data['VoucherNumber'];
            $voucher->VoucherCode = $data['VoucherCode'];
            $voucher->bill_price_min = $data['bill_price_min'];
            $voucher->discount_max = $data['discount_max'];
            $voucher->VoucherStart = $data['VoucherStart'];
            $voucher->VoucherEnd = $data['VoucherEnd'];
            $voucher->created_at = now();
            $voucher->save();
            session()->flash('success','Sửa mã giảm giá thành công');
            return redirect()->route('admin.manage_voucher');
        }
    }

    // Xóa khuyến mãi
    public function delete_voucher($idVoucher)
    {
        Voucher::destroy($idVoucher);
        session()->flash('success','Xoá mã giảm giá thành công');
        return redirect()->back();
    }

    public function manage_voucher()
    {
        $perPage = 10;
        $list_voucher = Voucher::whereNotIn('idVoucher', [0])->paginate($perPage);
        $count_voucher = Voucher::whereNotIn('idVoucher', [0])->count();

        return view("admin.voucher.all_voucher")->with(compact('list_voucher', 'count_voucher'));
    }

    public function edit_voucher($idVoucher)
    {
        $voucher = Voucher::find($idVoucher);
        return view("admin.voucher.edit_voucher")->with(compact('voucher'));
    }

    public function add_discount()
{
    $categories = Category::all();

    // Lấy danh sách discount hiện tại cho từng category (bỏ qua category_id = 0)
    $discounts = Discount::where('category_id', '!=', 0)
        ->pluck('percent', 'category_id')
        ->toArray();

    // Kiểm tra discount_all: chỉ hợp lệ nếu số lượng danh mục có discount = tổng số category và các giá trị giống nhau
    $discountValues = array_values($discounts);
    $discountAll = null;

    if (count($discounts) === $categories->count()) {
        if (count(array_unique($discountValues)) === 1) {
            $discountAll = $discountValues[0];
        }
    }

    return view("admin.discount.add_discount")->with(compact('categories', 'discounts', 'discountAll'));
}


  public function updateDiscounts(Request $request)
{
    $discountAll = $request->input('discount_all');
    $removeDiscounts = $request->input('remove_discounts', []);
    $discounts = $request->input('discount', []); // Đây là mảng [category_id => percent]

    $categories = Category::all();

    foreach ($categories as $category) {
        $categoryId = $category->category_id;

        // Nếu nằm trong danh sách xoá
        if (in_array($categoryId, $removeDiscounts)) {
            Discount::where('category_id', $categoryId)->delete();
            continue;
        }

        $percent = $discounts[$categoryId] ?? null;

        if (($percent === null || $percent === '') && ($discountAll === null || $discountAll === '')) {
            continue;
        }

        if (($percent === null || $percent === '') && $discountAll !== '') {
            $percent = $discountAll;
        }

        if ($percent !== null && $percent !== '') {
            Discount::updateOrCreate(
                ['category_id' => $categoryId],
                ['percent' => $percent]
            );
        }
    }

    session()->flash('success', 'Cập nhật giảm giá thành công!');
    return redirect()->back();
}
	          public function productFeed() {
        $products = Product::where('product_status', 1)
            ->where('product_price', '>', 0)
            ->whereNotNull('product_Slug')
            ->where('product_Slug', '!=', '')
            ->with('brand')
            ->get();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"></rss>');
        $channel = $xml->addChild('channel');
        $channel->addChild('title', htmlspecialchars(config('app.name', 'Unitek'), ENT_XML1, 'UTF-8'));
        $channel->addChild('link', config('app.url'));
        $channel->addChild('description', htmlspecialchars('Danh sách sản phẩm', ENT_XML1, 'UTF-8'));

        foreach ($products as $product) {
            // Đảm bảo slug không rỗng và có giá hợp lệ
            if (empty($product->product_Slug) || empty($product->product_code)) {
                continue;
            }
            
            // Kiểm tra giá hợp lệ
            $price = intval($product->product_price);
            if ($price <= 0) {
                continue;
            }
            
            $item = $channel->addChild('item');
            $item->addChild('g:id', htmlspecialchars(substr(trim($product->product_code), 0, 50), ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');
            $item->addChild('g:title', htmlspecialchars(substr(trim($product->product_name), 0, 150), ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');
            $description = !empty($product->product_desc) ? strip_tags($product->product_desc) : 'Product';
            $item->addChild('g:description', htmlspecialchars(Str::limit($description, 5000, ''), ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');
            $item->addChild('g:link', url('chi-tiet-san-pham/' . $product->product_Slug), 'http://base.google.com/ns/1.0');
            
            // Xử lý hình ảnh - không sử dụng urlencode trong URL
            if ($this->isValidImage($product->product_image)) {
                $imageUrl = rtrim(config('app.url'), '/') . '/public/upload/product/' . $product->product_image;
                $item->addChild('g:image_link', htmlspecialchars($imageUrl, ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');
            }
            
            $item->addChild('g:price', $price . ' VND', 'http://base.google.com/ns/1.0');
            $item->addChild('g:availability', $product->product_stock_status == 1 ? 'in_stock' : 'out_of_stock', 'http://base.google.com/ns/1.0');
            $brandName = htmlspecialchars($product->brand->brand_name ?? 'Unitek', ENT_XML1, 'UTF-8');
            $item->addChild('g:brand', $brandName, 'http://base.google.com/ns/1.0');
            $item->addChild('g:condition', 'new', 'http://base.google.com/ns/1.0');
        }

        // Remove UTF-8 BOM if present
        $xmlString = $xml->asXML();
        if (substr($xmlString, 0, 3) === "\xEF\xBB\xBF") {
            $xmlString = substr($xmlString, 3);
        }

        return response($xmlString, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }

    /**
     * Tạo XML feed chuẩn Google Merchant Center
     * Route: /google-merchant-feed.xml
     */
    public function googleMerchantFeed()
    {
        try {
            $products = Product::where('product_status', 1)
                ->with(['category', 'brand', 'attributes'])
                ->get();

            // Tạo XML root element với encoding rõ ràng
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss version="2.0" xmlns:g="http://base.google.com/ns/1.0"></rss>');
            $channel = $xml->addChild('channel');
            
            // Thông tin channel
            $channel->addChild('title', htmlspecialchars('Unitek Vietnam - Sản phẩm công nghệ', ENT_XML1, 'UTF-8'));
            $channel->addChild('link', config('app.url'));
            $channel->addChild('description', htmlspecialchars('Cáp HDMI, USB, phụ kiện công nghệ chính hãng', ENT_XML1, 'UTF-8'));
            $channel->addChild('language', 'vi');

            $itemCount = 0;
            foreach ($products as $product) {
                try {
                    // Bỏ qua sản phẩm không có giá hoặc không có slug
                    if (empty($product->product_Slug) || empty($product->product_code)) {
                        continue;
                    }

                    // Nếu sản phẩm có phân loại (variants)
                    if (@$product->attributes && $product->attributes->isNotEmpty()) {
                        foreach ($product->attributes as $index => $attr) {
                            if ($this->addItemToXml($channel, $product, $attr, $index)) {
                                $itemCount++;
                            }
                        }
                    } else {
                        // Sản phẩm không phân loại
                        if (!empty($product->product_price) && is_numeric($product->product_price) && $product->product_price > 0) {
                            if ($this->addItemToXml($channel, $product, null, 0)) {
                                $itemCount++;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning('Skipped product ' . @$product->product_id . ': ' . $e->getMessage());
                    continue;
                }
            }

            if ($itemCount == 0) {
                return response('No valid products found in feed', 400)->header('Content-Type', 'text/plain; charset=UTF-8');
            }

            // Get XML string without BOM
            $xmlString = $xml->asXML();
            
            // Remove UTF-8 BOM if present
            if (substr($xmlString, 0, 3) === "\xEF\xBB\xBF") {
                $xmlString = substr($xmlString, 3);
            }
            
            // Fix double slashes in paths only
            $xmlString = str_replace('//upload', '/upload', $xmlString);
            
            // Validate and format XML with proper indentation
            libxml_use_internal_errors(true);
            libxml_clear_errors();
            
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true; // Enable pretty-print formatting
            
            if (!$dom->loadXML($xmlString, LIBXML_NONET | LIBXML_NOWARNING | LIBXML_NOERROR)) {
                $errors = [];
                foreach (libxml_get_errors() as $error) {
                    $errors[] = trim($error->message);
                }
                Log::error('XML Validation Error: ' . json_encode($errors));
                libxml_clear_errors();
                return response('Invalid XML: ' . implode('; ', $errors), 400)
                    ->header('Content-Type', 'text/plain; charset=UTF-8');
            }
            
            // Output formatted XML via DOM with proper indentation
            $dom->encoding = 'UTF-8';
            $cleanXml = $dom->saveXML($dom->documentElement, LIBXML_NOEMPTYTAG);
            
            // Add XML declaration
            $cleanXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $cleanXml;
            
            libxml_clear_errors();

            // Return with proper headers
            return response($cleanXml, 200)
                ->header('Content-Type', 'application/xml; charset=UTF-8')
                ->header('Content-Disposition', 'inline; filename="google-merchant-feed.xml"')
                ->header('Cache-Control', 'no-cache, must-revalidate')
                ->header('Pragma', 'no-cache');
                
        } catch (\Exception $e) {
            Log::error('Google Merchant Feed Error: ' . $e->getMessage() . ' | ' . $e->getTraceAsString());
            return response('Error: ' . $e->getMessage(), 500)
                ->header('Content-Type', 'text/plain; charset=UTF-8');
        }
    }

    /**
     * Helper function để thêm item vào XML
     * Return true if item was added successfully
     */
    private function addItemToXml($channel, $product, $attribute = null, $index = 0)
    {
        try {
            // Kiểm tra required fields
            if (empty($product->product_code) || empty($product->product_Slug)) {
                return false;
            }

            $item = $channel->addChild('item');

            // ========== REQUIRED FIELDS ==========
            
            // id (Bắt buộc) - sử dụng product_code hoặc kết hợp với attribute
            if ($attribute && !empty($attribute->idAttrValue)) {
                $id = $product->product_code . '-' . $attribute->idAttrValue;
            } else {
                $id = $product->product_code;
            }
            $id = htmlspecialchars(substr(trim($id), 0, 50), ENT_XML1, 'UTF-8');
            if (empty($id)) return false;
            $item->addChild('g:id', $id, 'http://base.google.com/ns/1.0');

            // title (Bắt buộc)
            $title = !empty($product->product_name) ? $product->product_name : 'Product';
            if ($attribute && !empty($attribute->AttrValName)) {
                $title .= ' - ' . $attribute->AttrValName;
            }
            $title = htmlspecialchars(substr(trim($title), 0, 150), ENT_XML1, 'UTF-8');
            $item->addChild('g:title', $title, 'http://base.google.com/ns/1.0');

            // description (Bắt buộc)
            $description = !empty($product->product_desc) 
                ? strip_tags($product->product_desc)
                : 'Product Description';
            $description = Str::limit($description, 5000, '');
            $description = htmlspecialchars(trim($description), ENT_XML1, 'UTF-8');
            $item->addChild('g:description', $description, 'http://base.google.com/ns/1.0');

            // link (Bắt buộc)
            $link = url('chi-tiet-san-pham/' . $product->product_Slug);
            if ($attribute && !empty($attribute->product_attribute_code)) {
                $link .= '?variant=' . urlencode($attribute->product_attribute_code);
            }
            $item->addChild('g:link', $link, 'http://base.google.com/ns/1.0');

            // image_link (Bắt buộc) - hỗ trợ JPG, PNG, WEBP, GIF, BMP
            if (!$this->isValidImage($product->product_image)) {
                return false; // Bỏ qua sản phẩm nếu không có hình ảnh hợp lệ
            }
            
            $imageUrl = rtrim(config('app.url'), '/') . '/public/upload/product/' . $product->product_image;
            $item->addChild('g:image_link', htmlspecialchars($imageUrl, ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');

            // additional_image_link (Tùy chọn) - ảnh gallery - hỗ trợ JPG, PNG, WEBP, GIF, BMP
            if (class_exists('App\Models\Gallery')) {
                $gallery = Gallery::where('product_id', $product->product_id)->limit(10)->get();
                foreach ($gallery as $galleryImage) {
                    if ($this->isValidGalleryImage($galleryImage->gallery_image)) {
                        $additionalImageUrl = rtrim(config('app.url'), '/') . '/public/upload/gallery/' . $galleryImage->gallery_image;
                        $item->addChild('g:additional_image_link', htmlspecialchars($additionalImageUrl, ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');
                    }
                }
            }

            // availability (Bắt buộc) - Còn hàng, hết hàng, sắp về
            $availability = 'out_of_stock';
            if ($attribute) {
                if (isset($attribute->stock_status) && $attribute->stock_status == 1) {
                    $availability = 'in_stock';
                } elseif (isset($attribute->stock_status) && $attribute->stock_status == 2) {
                    $availability = 'preorder';
                }
            } else {
                if (!empty($product->product_stock_status) && $product->product_stock_status == 1) {
                    $availability = 'in_stock';
                } elseif (!empty($product->product_stock_status) && $product->product_stock_status == 2) {
                    $availability = 'backorder';
                }
            }
            $item->addChild('g:availability', $availability, 'http://base.google.com/ns/1.0');

            // price (Bắt buộc)
            $price = 0;
            if ($attribute && isset($attribute->product_price)) {
                $price = $attribute->product_price;
            } else if (!empty($product->product_price)) {
                $price = $product->product_price;
            }
            
            $price = intval($price);
            if ($price <= 0) {
                return false; // Không có giá hợp lệ
            }
            $item->addChild('g:price', $price . ' VND', 'http://base.google.com/ns/1.0');

            // ========== OPTIONAL FIELDS ==========

            // sale_price và sale_price_effective_date (Tùy chọn)
            if (class_exists('App\Models\Discount')) {
                $discount = Discount::where('category_id', $product->category_id)->first()
                    ?? Discount::where('category_id', 0)->first();
                
                if ($discount && !empty($discount->percent) && is_numeric($discount->percent) && $price > 0) {
                    $salePrice = round($price * (1 - $discount->percent / 100));
                    if ($salePrice > 0 && $salePrice < $price) {
                        $item->addChild('g:sale_price', intval($salePrice) . ' VND', 'http://base.google.com/ns/1.0');
                        
                        // Ngày hiệu lực giảm giá
                        $now = now();
                        $endDate = $now->copy()->addMonths(1);
                        $dateRange = $now->format('Y-m-d') . 'T00:00:00Z/' . $endDate->format('Y-m-d') . 'T23:59:59Z';
                        $item->addChild('g:sale_price_effective_date', $dateRange, 'http://base.google.com/ns/1.0');
                    }
                }
            }

            // brand (Bắt buộc với một số ngoại lệ)
            $brand = 'Unitek';
            if ($product->brand && !empty($product->brand->brand_name)) {
                $brand = htmlspecialchars(substr(trim($product->brand->brand_name), 0, 70), ENT_XML1, 'UTF-8');
            }
            $item->addChild('g:brand', $brand, 'http://base.google.com/ns/1.0');

            // condition (Tình trạng - new/refurbished/used)
            $item->addChild('g:condition', 'new', 'http://base.google.com/ns/1.0');

            // google_product_category (Tùy chọn nhưng nên có)
            if ($product->category) {
                $item->addChild('g:google_product_category', 'Electronics > Accessories', 'http://base.google.com/ns/1.0');
            }

            // product_type (Tùy chọn)
            if ($product->category && !empty($product->category->category_name)) {
                $productType = htmlspecialchars(substr(trim($product->category->category_name), 0, 100), ENT_XML1, 'UTF-8');
                $item->addChild('g:product_type', $productType, 'http://base.google.com/ns/1.0');
            }

            // mpn (MPN - Tùy chọn)
            if (!empty($product->product_code)) {
                $mpn = htmlspecialchars(substr(trim($product->product_code), 0, 70), ENT_XML1, 'UTF-8');
                $item->addChild('g:mpn', $mpn, 'http://base.google.com/ns/1.0');
            }

            // identifier_exists (Bắt buộc nếu không có brand/GTIN/MPN)
            $item->addChild('g:identifier_exists', 'yes', 'http://base.google.com/ns/1.0');

            // shipping (Tùy chọn - Phí vận chuyển)
            $shipping = $item->addChild('g:shipping', '', 'http://base.google.com/ns/1.0');
            $shipping->addChild('g:country', 'VN', 'http://base.google.com/ns/1.0');
            $shipping->addChild('g:service', 'Standard', 'http://base.google.com/ns/1.0');
            $shipping->addChild('g:price', '0 VND', 'http://base.google.com/ns/1.0');

            return true;
            
        } catch (\Exception $e) {
            Log::error('Error adding item to XML: ' . $e->getMessage() . ' | Product ID: ' . @$product->product_id);
            return false;
        }
    }
	 public function importProductPrices(Request $request)
        {
            try {
                if (!$request->hasFile('price_file')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng chọn file Excel để import'
                    ], 400);
                }

                $file = $request->file('price_file');
                
                // Validate file type
                $validExtensions = ['xlsx', 'xls', 'csv'];
                if (!in_array($file->getClientOriginalExtension(), $validExtensions)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File không đúng định dạng. Vui lòng sử dụng file Excel (.xlsx, .xls) hoặc CSV'
                    ], 400);
                }

            DB::beginTransaction();
            try {
                Excel::import(new ProductPriceImport, $file);
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật giá thành công!'
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            
            foreach ($failures as $failure) {
                $row = $failure->row();
                $error = $failure->errors()[0];
                $errors[] = "Dòng $row: $error";
            }

            return response()->json([
                'success' => false,
                'message' => implode("\n", $errors)
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function exportProductPrices(Request $request)
    {
        try {
            $columns = $request->input('columns', []);
            $fileName = 'danh-sach-san-pham-' . date('Y-m-d-His') . '.xlsx';

            return Excel::download(new ProductPriceExport($columns), $fileName, \Maatwebsite\Excel\Excel::XLSX, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);

        } catch (\Exception $e) {
            \Log::error('Export error: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi khi xuất file: ' . $e->getMessage());
        }
    }
	 /**
     * Kiểm tra hình ảnh sản phẩm có hợp lệ
     * Hỗ trợ: JPG, PNG, WEBP, GIF, BMP
     */
    private function isValidImage($imageName)
    {
        // Kiểm tra tên hình ảnh không rỗng
        if (empty($imageName) || !is_string($imageName)) {
            return false;
        }

        // Danh sách extension hỗ trợ
        $validExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'];
        $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($ext, $validExtensions)) {
            return false;
        }

        // Kiểm tra file thực tế tồn tại
        $imagePath = public_path('upload/product/' . $imageName);
        if (!file_exists($imagePath) || !is_file($imagePath)) {
            return false;
        }

        return true;
    }

    /**
     * Kiểm tra hình ảnh gallery có hợp lệ
     * Hỗ trợ: JPG, PNG, WEBP, GIF, BMP
     */
    private function isValidGalleryImage($imageName)
    {
        // Kiểm tra tên hình ảnh không rỗng
        if (empty($imageName) || !is_string($imageName)) {
            return false;
        }

        // Danh sách extension hỗ trợ
        $validExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'];
        $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($ext, $validExtensions)) {
            return false;
        }

        // Kiểm tra file thực tế tồn tại
        $imagePath = public_path('upload/gallery/' . $imageName);
        if (!file_exists($imagePath) || !is_file($imagePath)) {
            return false;
        }

        return true;
    }
}
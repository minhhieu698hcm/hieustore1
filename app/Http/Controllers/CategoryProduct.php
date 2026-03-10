<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;


class CategoryProduct extends Controller
{
    public function boot(): void
    {
    Paginator::useBootstrapFive();
    Paginator::useBootstrapFour();
    }
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
            }else
            {
                return Redirect::to('/admin')->send();
            }
        }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.category.add_category_product');
    }
    public function all_category_product(){
        $perPage = 10;
        $all_category_product = DB::table('tbl_category_product')->paginate($perPage);
        $manager_category_product = view('admin.category.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.category.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name']= $request->category_product_name;
        $data['category_desc']= $request->category_product_desc;
        $data['category_status']= $request->category_product_status;


        DB::table('tbl_category_product')->insert($data);
        session()->flash('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function toggleCategoryStatus($category_id)
    {
        $category = Category::findOrFail($category_id);
        
        // Đảo ngược trạng thái: 1 (Hiện) => 0 (Ẩn) và ngược lại
        $category->category_status = $category->category_status ? 0 : 1;
        $category->save();
    
        return response()->json([
            'success' => true,
            'new_status' => $category->category_status
        ]);
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.category.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.category.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name']= $request->category_product_name;
        $data['category_desc']= $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        session()->flash('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        session()->flash('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }


    //end function admin page
    public function show_category_home($category_ids) {
        // Chuyển đổi danh sách id danh mục từ chuỗi thành mảng
        $category_ids = explode(',', $category_ids);
    
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'asc')->get();
    
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderBy('brand_id', 'asc')->get();
        
        $product_counts = [];

        foreach ($cate_product as $category) {
        $product_counts[$category->category_id] = DB::table('tbl_product')
            ->where('category_id', $category->category_id)
            ->where('product_status', '1')
            ->count();
    }
    
        // Thực hiện truy vấn với phân trang
        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->whereIn('tbl_product.category_id', $category_ids) // Sử dụng whereIn để truy vấn nhiều id danh mục
            ->where('tbl_product.product_status', '1')
            ->get();
    
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->whereIn('tbl_product.category_id', $category_ids) // Sử dụng whereIn để truy vấn nhiều id danh mục
            ->where('tbl_product.product_status', '1')
            ->paginate(8);
    
        $category_name = DB::table('tbl_category_product')
            ->whereIn('tbl_category_product.category_id', $category_ids)
            ->get();
    
        return view('pages.category.show_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_name', $category_name)
            ->with('category_by_id', $category_by_id)
            ->with('all_product', $all_product)
            ->with('product_counts', $product_counts); // Truyền mảng số lượng sản phẩm sang view
    }
}
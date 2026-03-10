<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use File;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
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
    public function add_blog(){
        $this->AuthLogin();
        
        // Load danh sách sản phẩm và bài viết để hiển thị trong form
        $products = DB::table('tbl_product')->select('product_id', 'product_name')->where('product_status', 1)->get();
        $all_blogs = DB::table('tbl_blog')->select('blog_id', 'blog_title')->where('blog_status', 1)->get();

        return view('admin.blog.add_blog', [
            'products' => $products,
            'all_blogs' => $all_blogs
        ]);
    }
    public function all_blog(){
        $this->AuthLogin();
        $perPage = 10;
        $all_blog = DB::table('tbl_blog')->paginate($perPage);
        $manager_blog = view('admin.blog.all_blog')->with('all_blog',$all_blog);
        return view('admin_layout')->with('admin.blog.all_blog',$manager_blog);
    }

    public function toggleBlogStatus($blog_id)
    {
        $blog = Blog::findOrFail($blog_id);
        
        // Đảo ngược trạng thái: 1 (Hiện) => 0 (Ẩn) và ngược lại
        $blog->blog_status = $blog->blog_status ? 0 : 1;
        $blog->save();
    
        return response()->json([
            'success' => true,
            'new_status' => $blog->blog_status
        ]);
    }

    public function save_blog(Request $request)
    {
        $this->AuthLogin();
    
        $data = [
            'blog_title' => $request->blog_title,
            'blog_slug' => $request->blog_slug,
            'blog_desc' => $request->blog_desc,
            'blog_content' => $request->blog_content,
            'blog_content2' => $request->blog_content2 ?? '',
            'blog_status' => $request->blog_status,
            'related_product_ids' => $request->related_product_ids ? json_encode($request->related_product_ids) : null,
            'related_blog_ids' => $request->related_blog_ids ? json_encode($request->related_blog_ids) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
        $get_image = $request->file('blog_image'); 
    
        if ($get_image) {
            $image_name = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $image_name . '_' . uniqid() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('upload/blog'), $new_image); 
            $data['blog_image'] = $new_image;
        }
    
        DB::table('tbl_blog')->insert($data);
    
        session()->flash('success', 'Thêm blog thành công!');
        return Redirect::to('all-blog');
    }
	
public function delete_blog($blog_id){
    $this->AuthLogin();
    DB::table('tbl_blog')->where('blog_id',$blog_id)->delete();
    session()->flash('success','Xóa blog thành công');
    return Redirect::to('all-blog');
}
public function edit_blog($blog_id)
{
    $this->AuthLogin();
    
    $blog = DB::table('tbl_blog')->where('blog_id', $blog_id)->first();
    if (!$blog) {
        return redirect('all-blog')->with('error', 'Blog không tồn tại.');
    }

    // Load danh sách sản phẩm và bài viết để hiển thị trong form
    $products = DB::table('tbl_product')->select('product_id', 'product_name')->where('product_status', 1)->get();
    $all_blogs = DB::table('tbl_blog')->select('blog_id', 'blog_title')->where('blog_status', 1)->get();

    return view('admin.blog.edit_blog')->with([
        'blog' => $blog,
        'products' => $products,
        'all_blogs' => $all_blogs
    ]);
}

public function submit_edit_blog(Request $request)
{
    $this->AuthLogin();

    $blog_id = $request->blog_id;

    $data = [
        'blog_title' => $request->blog_title,
        'blog_slug' => $request->blog_slug,
        'blog_desc' => $request->blog_desc,
        'blog_content' => $request->blog_content,
        'blog_content2' => $request->blog_content2 ?? '',
        'blog_status' => $request->blog_status,
        'related_product_ids' => $request->related_product_ids ? json_encode($request->related_product_ids) : null,
        'related_blog_ids' => $request->related_blog_ids ? json_encode($request->related_blog_ids) : null,
        'updated_at' => now(),
    ];

    $get_image = $request->file('blog_image');

    if ($get_image) {
        // Xóa ảnh cũ nếu có
        $old_blog = DB::table('tbl_blog')->where('blog_id', $blog_id)->first();
        if ($old_blog && $old_blog->blog_image) {
            $old_path = public_path('upload/blog/' . $old_blog->blog_image);
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }
    
        // Lưu ảnh mới
        $image_name = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
        $new_image = $image_name . '_' . uniqid() . '.' . $get_image->getClientOriginalExtension();
        $get_image->move(public_path('upload/blog'), $new_image); 
        $data['blog_image'] = $new_image;
    }

    DB::table('tbl_blog')->where('blog_id', $blog_id)->update($data);

    session()->flash('success', 'Cập nhật blog thành công!');
    return Redirect::to('all-blog');
}
/*===================================================== PAGES ===================================================== */
/*================================================================================================================= */

    public function blog()
    {
        $all_blog = Blog::orderBy('blog_id', 'desc')->get();
        
        // =============== SEO META TAGS ===============
        $metaTitle = 'Blog & Tin Tức | Unitek Việt Nam - Cáp HDMI, USB, Phụ Kiện Công Nghệ';
        $metaDescription = 'Khám phá blog Unitek Việt Nam với các bài viết về cáp HDMI, USB, hub, bộ chia, phụ kiện công nghệ chính hãng. Mẹo sử dụng, hướng dẫn và thông tin sản phẩm mới nhất.';
        $metaKeywords = 'blog Unitek, tin tức, cáp HDMI, USB, hub, bộ chia, phụ kiện công nghệ, bài viết hướng dẫn, sản phẩm công nghệ';
        
        // OG Image
        $ogImage = asset('public/frontend/images/default-og-image.jpg');
        
        // URL canonical
        $canonicalUrl = url('/tin-tuc');
        
        return view('pages.blog.blog_all', [
            'all_blog' => $all_blog,
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

    public function details_blog($blog_slug){
        $all_blog = Blog::orderBy('blog_id', 'desc')->get();
        $details_blog = Blog::where('blog_slug', $blog_slug)->first();
        if (!$details_blog) {
            return redirect()->back()->with('error', 'Blog không tồn tại.');
        }

        // Lấy sản phẩm tham khảo
        $related_products = [];
        if ($details_blog->related_product_ids) {
            $product_ids = is_array($details_blog->related_product_ids)
                ? $details_blog->related_product_ids
                : json_decode($details_blog->related_product_ids, true);
            if (!empty($product_ids)) {
                $related_products = DB::table('tbl_product')
                    ->select('product_id', 'product_name', 'product_slug', 'product_image', 'product_price', 'product_sale', 'product_desc')
                    ->whereIn('product_id', $product_ids)
                    ->where('product_status', 1)
                    ->limit(4)
                    ->get();
            }
        }

        // Lấy bài viết tương tự
        $related_blogs = [];
        if ($details_blog->related_blog_ids) {
            $blog_ids = is_array($details_blog->related_blog_ids)
                ? $details_blog->related_blog_ids
                : json_decode($details_blog->related_blog_ids, true);
            if (!empty($blog_ids)) {
                $related_blogs = Blog::whereIn('blog_id', $blog_ids)
                    ->where('blog_status', 1)
                    ->limit(3)
                    ->get();
            }
        }

        // =============== SEO META TAGS ===============
        $metaTitle = $details_blog->blog_title . ' | Blog Unitek Việt Nam';
        $metaDescription = Str::limit(strip_tags($details_blog->blog_desc ?? $details_blog->blog_content), 160, '...');
        
        // 🎯 TỪ KHÓA ĐƯỢC TỰ ĐỘNG SINH TỪ TIÊU ĐỀ VÀ NỘI DUNG BLOG
      $blogKeywords = [
        'Unitek',
        'blog',
        'cáp HDMI',
        'USB',
        'bộ thu phát hdmi không dây',
        'hub USB',
        'bộ chia USB',
        'cáp chuyển đổi',
        'cáp USB-C',
        'phụ kiện công nghệ',
        $details_blog->blog_title,
        'Unitek Việt Nam',

        // Thêm từ khóa SEO
        'phụ kiện máy tính',
        'phụ kiện laptop',
        'hub USB',
        'bộ chia USB',
        'cáp chuyển đổi',
        'cáp USB-C',
        'cáp DisplayPort',
        'bộ chuyển đổi HDMI',
        'dock ssd',
        'đầu đọc thẻ',
        'hub type c',
        'phụ kiện Unitek chính hãng',
        'phụ kiện công nghệ giá tốt',
        'đại lý Unitek',
        'mua phụ kiện máy tính',
        'review phụ kiện công nghệ',
        'tin tức công nghệ',
        'đánh giá phụ kiện Unitek'
    ];
        $metaKeywords = implode(', ', $blogKeywords);
        
        // OG Image
        $ogImage = $details_blog->blog_image 
            ? asset('public/upload/blog/' . $details_blog->blog_image)
            : asset('public/frontend/images/default-og-image.jpg');
        
        // URL canonical
        $canonicalUrl = url('/tin-tuc-chi-tiet/' . $blog_slug);

        return view('pages.blog.blog_single', [
            'details_blog' => $details_blog,
            'all_blog' => $all_blog,
            'related_products' => $related_products,
            'related_blogs' => $related_blogs,
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
}

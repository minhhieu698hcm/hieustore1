<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Info;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Discount;
use App\Models\Promotion;
use App\Models\PasswordReset;

use DB;
class HomeController extends Controller
{
    public function index()
{
    $cate_product = Category::where('category_status', 1)->get();
    $brand_product = Brand::get();
    $discounts = Discount::pluck('percent', 'category_id')->toArray();
	
	//Banner
    $banner_hero = Banner::where('position', 'hero')->where('active', 1)->orderBy('order')->get();
    $banner_highlight = Banner::where('position', 'highlight')->where('active', 1)->orderBy('order', 'asc')->get();
    $banner_middle = Banner::where('position', 'middle')->where('active', 1)->orderBy('order', 'asc')->first();
	$banner_text = Info::where('position','bannertext')->where('active',1)->orderBy('order', 'asc')->get();
	$logo_main = Banner::where('position', 'logo_main')->where('active', 1)->orderBy('order', 'asc')->first();
    $logo_footer = Banner::where('position', 'logo_footer')->where('active', 1)->orderBy('order', 'asc')->first();

    // Các danh sách
    $product_new = Product::orderby('product_id', 'desc')->where('product_status', 1)->limit(8)->get();
    $product_sale_home = Product::where('product_sale', 1)->where('product_status', 1)->orderBy('product_sale', 'desc')->limit(8)->get();
    $favorite_product = Product::where('product_status', 1)->where('favorite_product', 1)->orderBy('product_id', 'desc')->limit(8)->get();
    $product_sale = Product::where('product_status', 1)->where('product_sale', 1)->orderBy('product_id', 'desc')->limit(8)->get();
    $blog_index = Blog::orderBy('blog_id', 'desc')->limit(3)->get();

    // Áp dụng giảm giá
    $product_new = $this->applyDiscount($product_new, $discounts);
    $product_sale_home = $this->applyDiscount($product_sale_home, $discounts);
    $favorite_product = $this->applyDiscount($favorite_product, $discounts);
    $product_sale = $this->applyDiscount($product_sale, $discounts);
		
	 $promotion = Promotion::where('is_active', 1)
            ->where('promotion_type', 'gift') // ✅ chỉ lấy loại gift
            ->where(function ($q) {
                $now = now();
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) {
                $now = now();
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->latest()
            ->first();


    return view('pages.home', compact(
        'cate_product', 'brand_product', 'blog_index',
        'product_new', 'product_sale_home', 'favorite_product', 'product_sale','banner_hero','banner_highlight','banner_middle','promotion','banner_text','logo_main','logo_footer'
    ));
}


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


    public function showLoginForm()
    {
        return view('pages.customer.login');
    }

    public function showRegisterForm()
    {
        return view('pages.customer.register');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $remember = $request->has('remember');

    // Đăng nhập
    if (Auth::attempt(['username' => $request->email, 'password' => $request->password], $remember)) {

        // Nếu người dùng chọn "Ghi nhớ tài khoản" → lưu email vào cookie 30 ngày
        if ($remember) {
            cookie()->queue('remember_email', $request->email, 60 * 24 * 30); // 30 ngày
        } else {
            cookie()->queue(cookie()->forget('remember_email'));
        }

        return redirect()->intended('/')->with('login_success', true);
    }

    // Sai tài khoản hoặc mật khẩu
    return back()->with('error', 'Vui lòng kiểm tra lại tài khoản hoặc mật khẩu.');
}

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $customer = Customer::create([
            'username' => $request->username,
            'password' => $request->password,
        ]);
        return redirect()->route('login')->with('success', 'Tạo tài khoản thành công! Bạn có thể đăng nhập ngay.');
    }

	public function checkUsername(Request $request)
	{
		$exists = Customer::where('username', $request->username)->exists();

		return response()->json([
			'exists' => $exists
		]);
	}
	
    public function changePassword(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password_new' => 'required|min:6',
            'password_new_again' => 'required|same:password_new',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_old, $user->password)) {
            return back()->withErrors(['password_old' => 'Mật khẩu cũ không đúng!']);
        }

        // Cập nhật mật khẩu mà không cần Hash::make()
        $user->password = $request->password_new;
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
    
    public function forgotPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $customer = Customer::where('username', $request->email)->first();

    if (!$customer) {
        return response()->json([
            'success' => false,
            'message' => 'Email không tồn tại trong hệ thống.'
        ]);
    }

    $token = Str::random(60);

    PasswordReset::updateOrCreate(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
    );

    $resetUrl = url('/reset-password?token=' . $token);

    // ✅ Gửi mail bằng Mailable Markdown
    Mail::to($request->email)->send(new ResetPasswordMail($request->email, $resetUrl));

    return response()->json([
        'success' => true,
        'message' => 'Link khôi phục mật khẩu đã được gửi đến email của bạn.'
    ]);
}

    public function showResetForm(Request $request)
{
    $token = $request->query('token');

    if (!$token) {
        return redirect('/login')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
    }

    $reset = PasswordReset::where('token', $token)->first();

    if (!$reset) {
        return redirect('/login')->with('error', 'Token không tồn tại hoặc đã được sử dụng.');
    }
    return view('pages.customer.reset-password', [
        'token' => $token,
        'email' => $reset->email,
    ]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $reset = PasswordReset::where('token', $request->token)
                          ->where('email', $request->email)
                          ->first();

    if (!$reset) {
        return back()->withErrors(['email' => 'Token hoặc email không hợp lệ.']);
    }

    $customer = Customer::where('username', $request->email)->first();

    if (!$customer) {
        return back()->withErrors(['email' => 'Không tìm thấy người dùng tương ứng.']);
    }

    // ⚡ Mã hoá tự động nhờ mutator trong model Customer
    $customer->password = $request->password;
    $customer->setRememberToken(Str::random(60));
    $customer->save();

    // Xóa token sau khi sử dụng
    PasswordReset::where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công!');
}

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Đã đăng xuất thành công!');
}

public function myAccount()
{
    $userId = Auth::id();
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem tài khoản.');
    }

    $twoYearsAgo = now()->subYears(1)->startOfYear();

    // Tổng chi tiêu 2 năm gần nhất, không tính đơn hàng B2B
    $totalSpent = Order::where('idCustomer', $userId)
        ->where('payment_method', '!=', 'B2B')
        ->where('created_at', '>=', $twoYearsAgo)
        ->sum('total_price');

     // Xác định hạng, màu, và ngưỡng thăng cấp kế tiếp
    if ($totalSpent < 3_000_000) {
        $rank = 'U-NULL';
        $rankColor = 'linear-gradient(90deg, #9e9e9e, #bdbdbd)';
        $nextRank = 'U-NEW';
        $nextThreshold = 3_000_000;
        $prevThreshold = 0;
    } elseif ($totalSpent < 15_000_000) {
        $rank = 'U-NEW';
        $rankColor = 'linear-gradient(90deg, #6a11cb, #2575fc)';
        $nextRank = 'U-MEM';
        $nextThreshold = 15_000_000;
        $prevThreshold = 3_000_000;
    } elseif ($totalSpent < 50_000_000) {
        $rank = 'U-MEM';
        $rankColor = 'linear-gradient(90deg, #00b894, #00cec9)';
        $nextRank = 'U-VIP';
        $nextThreshold = 50_000_000;
        $prevThreshold = 15_000_000;
    } else {
        $rank = 'U-VIP';
        $rankColor = 'linear-gradient(90deg, #f39c12, #f1c40f)';
        $nextRank = null;
        $nextThreshold = null;
        $prevThreshold = 50_000_000;
    }

    // Màu vòng progress hạng tiếp theo
    if ($nextRank) {
        switch ($nextRank) {
            case 'U-NEW':
                $nextRankStart = '#6a11cb';
                $nextRankEnd = '#2575fc';
                break;
            case 'U-MEM':
                $nextRankStart = '#00b894';
                $nextRankEnd = '#00cec9';
                break;
            case 'U-VIP':
                $nextRankStart = '#f39c12';
                $nextRankEnd = '#f1c40f';
                break;
            default:
                $nextRankStart = '#eee';
                $nextRankEnd = '#ccc';
        }
    } else {
        // nếu đã max hạng thì vòng progress dùng màu hạng hiện tại
        $nextRankStart = $rankColor;
        $nextRankEnd = $rankColor;
    }

    // Số tiền còn thiếu lên hạng tiếp theo
    $remaining = $nextThreshold ? max(0, $nextThreshold - $totalSpent) : 0;

    // % tiến trình trong hạng hiện tại
    if ($nextThreshold) {
        $progressPercent = round((($totalSpent - $prevThreshold) / ($nextThreshold - $prevThreshold)) * 100);
    } else {
        $progressPercent = 100;
    }

    // Lấy 2 đơn hàng mới nhất
    $orders = Order::where('idCustomer', $userId)
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get();

    return view('pages.customer.myaccount', compact(
        'orders',
        'totalSpent',
        'rank',
        'rankColor',
        'nextRank',
        'nextRankStart',
        'nextRankEnd',
        'remaining',
        'progressPercent'
    ));
}


    public function AccountSetting()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để cài đặt tài khoản.');
        }

       return view('pages.customer.account-setting');
    }

    public function updateProfile(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập trước.');
    }

    $customer = Auth::user();

    // ✅ Gộp toàn bộ validate vào chung một lần
    $validatedData = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:50|unique:customer,username,' . $customer->idCustomer . ',idCustomer',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'birthday' => 'nullable|date',
        'id_gender' => 'nullable|in:0,1',
    ]);

    // ✅ Cập nhật thông tin cá nhân
    $customer->first_name = $validatedData['first_name'] ?? $customer->first_name;
    $customer->last_name  = $validatedData['last_name'] ?? $customer->last_name;
    $customer->username   = $validatedData['email'] ?? $customer->username; // email lưu trong username
    $customer->phone      = $validatedData['phone'] ?? $customer->phone;
    $customer->sex        = $validatedData['id_gender'] ?? $customer->sex;
    $customer->birthday   = $validatedData['birthday'] ?? $customer->birthday;

    // ✅ Cập nhật địa chỉ
    $customer->address  = $validatedData['address'] ?? $customer->address;
    $customer->city     = $validatedData['city'] ?? $customer->city;
    $customer->district = $validatedData['district'] ?? $customer->district;

    $customer->updated_at = now();
    $customer->save();

    return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
}


    public function Order($orderNumber)
	{
		if (Auth::check()) {
			// Người dùng đã đăng nhập -> Chỉ lấy đơn hàng của họ
			$order = Order::where('order_number', $orderNumber)
						  ->where('idCustomer', Auth::id()) 
						  ->first();
		} else {
			// Người dùng chưa đăng nhập -> Chỉ tìm đơn hàng theo order_number
			$order = Order::where('order_number', $orderNumber)->first();
		}
		foreach ($order->items as $item) {
            $item->productData = Product::where('product_code', $item->product_code)->first();
        }
		if (!$order) {
			abort(404, 'Đơn hàng không tồn tại hoặc bạn không có quyền truy cập.');
		}
		 // Lấy promotions áp dụng cho đơn hàng này
        $productIds = $order->items->pluck('product_code')->toArray();
        $subTotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
        $now = now();

        $promotions = Promotion::with('giftProduct')
            ->where('is_active', 1)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->where(function($q) use ($productIds, $subTotal) {
                $q->where(function($q2) use ($subTotal) {
                    $q2->where('promotion_type', 'gift')
                       ->where('min_total_for_gift', '<=', $subTotal);
                })
                ->orWhere(function($q2) use ($productIds) {
                    $q2->where('promotion_type', 'combo')
                       ->whereIn('product_id', $productIds);
                });
            })
            ->get();
		return view('pages.customer.order', compact('order','promotions'));
	}

    // Cập nhật avatar cho customer
    public function updateAvatar(Request $request)
{
    $customer = Auth::user();
    $path = public_path('upload/customer/');

    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newName = $originalName . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Xóa avatar cũ nếu có
        if ($customer->avatar && File::exists($path . $customer->avatar)) {
            File::delete($path . $customer->avatar);
        }

        // Lưu ảnh mới
        $file->move($path, $newName);

        // Cập nhật CSDL
        $customer->avatar = $newName;
        $customer->save();

        // Flash thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật ảnh đại diện thành công');
    }

    return redirect()->back()->with('error', 'Vui lòng chọn hình ảnh');
}


    // Xóa avatar cho customer
    public function deleteAvatar(Request $request)
    {
        try {
            $customer = Auth::user();
            $imagePath = public_path('upload/customer/' . $customer->avatar);

            if ($customer->avatar && File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $customer->avatar = null;
            $customer->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Error deleting customer avatar: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa ảnh']);
        }
    }
    public function listOrder()
{
    $customer = Auth::user();

    if (!$customer) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng.');
    }

    // Lấy tất cả đơn hàng của customer, chỉ cần thông tin tổng quát
    $orders = Order::where('idCustomer', $customer->idCustomer)
                   ->latest()
                   ->get(); // không cần with('items')

    return view('pages.customer.account-order', compact('orders'));
}


    public function lienhe()
    {
        return view('pages.about_us.contact');
    }

    public function gioithieu()
    {
        return view('pages.about_us.about');
    }
	
    public function checkout()
    {
        return view('pages.cart.checkout');
    }
	
    public function baohanh()
    {
        return view('pages.about_us.warranty_policy');
    }
	
    public function faq()
    {
        return view('pages.about_us.faq');
    }
	
	 public function policy_customer()
    {
        return view('pages.policy.policy_customer');
    }

    public function service_information_and_website()
    {
        return view('pages.policy.service_information_and_website');
    }

    public function policy_delivery()
    {
        return view('pages.policy.policy_delivery');
    }

    public function policy_payment()
    {
        return view('pages.policy.policy_payment');
    }

    public function policy_company()
    {
        return view('pages.policy.policy_company');
    }
	
	 public function policy_return_and_refund()
    {
        return view('pages.policy.policy_return_and_refund');
    }
	
    public function policy_privacy()
    {
        return view('pages.policy.policy_privacy');
    }

    public function policy_warranty()
    {
        return view('pages.policy.policy_warranty');
    }
    
    public function policy_all()
    {
        return view('pages.policy.policy_all');
    }
	 public function blog()
    {
        return view('pages.policy.blog');
    }
}

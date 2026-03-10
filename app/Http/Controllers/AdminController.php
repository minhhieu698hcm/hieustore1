<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\Theme;
use App\Models\Order;
use App\Models\Customer;

class AdminController extends Controller
{
    // Hiển thị trang đăng nhập
    public function index()
    {
        return view('admin_login');
    }

    // Xử lý đăng nhập
    public function dashboard(Request $request)
{
    $request->validate([
        'admin_email' => 'required|email',
        'admin_password' => 'required',
    ]);

    $admin = Admin::where('admin_email', $request->admin_email)->first();

    if (!$admin || !Hash::check($request->admin_password, $admin->admin_password)) {
        session()->flash('error', 'Email hoặc mật khẩu không đúng!');
        return redirect()->route('admin.login');
    }

    Auth::guard('admin')->login($admin);

    // Kiểm tra nếu admin đã có theme
    $theme = Theme::where('admin_id', $admin->admin_id)->first();

    if ($theme) {
        session([
            'data_bs_theme'     => $theme->{'data-bs-theme'},
            'data_color_theme'  => $theme->{'data-color-theme'},
            'data_layout'       => $theme->{'data-layout'},
            'data_boxed_layout' => $theme->{'data-boxed-layout'},
            'data_card'         => $theme->{'data-card'},
        ]);
    } else {
        session([
            'data_bs_theme'     => 'light',
            'data_color_theme'  => 'Blue_Theme',
            'data_layout'       => 'vertical',
            'data_boxed_layout' => 'boxed',
            'data_card'         => 'shadow',
        ]);
    }

    // Gán thông tin admin vào session
    session([
        'admin_id'    => $admin->admin_id,
        'admin_name'  => $admin->admin_name,
        'admin_email' => $admin->admin_email,
        'admin_role'  => $admin->position,
        'admin_avt'   => $admin->admin_avt,
        'position'    => $admin->position,
    ]);

    return redirect()->route('admin.home');
}




    // Hiển thị trang dashboard
    public function show_dashboard()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Tổng doanh thu (chỉ đơn hàng đã giao)
		$totalRevenue = Order::where('status', 'delivered')
			->sum('total_price');

		// Doanh số của năm hiện tại (chỉ đơn hàng đã giao)
		$yearlyRevenue = Order::whereYear('created_at', $currentYear)
			->where('status', 'delivered')
			->sum('total_price');

        // Lấy tổng doanh số của các đơn hàng đã giao trong tháng hiện tại
        $monthlyRevenue = Order::whereYear('created_at', $currentYear)
                                ->whereMonth('created_at', $currentMonth)
                                ->where('status', 'delivered') // Chỉ tính đơn đã giao
                                ->sum('total_price');

        // Tổng số lượng đơn hàng của tất cả trong bảng (bất kể trạng thái)
        $totalOrders = Order::count();

        // Đếm đơn hàng đang chờ xác nhận (status = 'pending')
        $pendingOrders = Order::where('status', 'pending')->count();

        // Đếm số đơn hàng đã xác nhận (status = 'confirmed')
        $confirmedOrders = Order::where('status', 'confirmed')->count();

        // Đếm số đơn hàng đang giao (status = 'shipped')
        $shippedOrders = Order::where('status', 'shipped')->count();

        // Đếm số đơn hàng đã giao (status = 'delivered')
        $deliveredOrders = Order::where('status', 'delivered')->count();
        
        // Đếm số đơn hàng chưa thanh toán (status = 'waiting')
        $waitingOrders = Order::where('status', 'waiting')->count();

        // Lấy tên tháng hiện tại (Tháng 1, Tháng 2,...)
        $monthName = 'Tháng ' . $currentMonth;

        return view('admin.dashboard', compact('totalRevenue', 'yearlyRevenue', 'monthlyRevenue' , 'currentYear' , 'monthName', 'totalOrders' , 'pendingOrders', 'confirmedOrders', 'shippedOrders', 'deliveredOrders', 'waitingOrders'));
    }

    
    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Đăng xuất admin
    
        // Xóa toàn bộ session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/admin')->with('success', 'Bạn đã đăng xuất thành công!');
    }

    // Chuyển đến trang quản lý nhân viên
    public function manage_staffs(){
        $perPage = 10;
        $list_staff = Admin::whereNotIn('admin_id', [0])->paginate($perPage);
        $count_staff = Admin::whereNotIn('admin_id', [0])->count();
        return view("admin.manage-users.manage-staffs")->with(compact('list_staff','count_staff'));
    }

    // Chuyển đến trang thêm nhân viên
    public function add_staffs(){
        return view("admin.manage-users.add-staffs");
    }

    // Chuyển đến trang quản lý tài khoản khách hàng
public function manage_customers()
{
    // 1️⃣ Thành viên có tài khoản
    $customers = Customer::withSum(['orders as total_spent' => function ($query) {
        $query->where('payment_method', '!=', 'B2B');
    }], 'total_price')
    ->withCount(['orders as order_count' => function ($query) {
        $query->where('payment_method', '!=', 'B2B');
    }])
    ->get()
    ->map(function ($customer) {
        return (object)[
            'idCustomer' => $customer->idCustomer,
            'avatar' => $customer->avatar,
            'username' => $customer->username,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'order_count' => $customer->order_count,
            'total_spent' => $customer->total_spent ?? 0,
            'formatted_total_spent' => number_format($customer->total_spent ?? 0, 0, ',', '.') . ' đ',
            'type' => 'Thành viên'
        ];
    });

    // 2️⃣ Khách vãng lai (email trong order, không có tài khoản)
    $guests = Order::select(
            'customer_email',
            DB::raw('MIN(first_name) as first_name'),
            DB::raw('MIN(last_name) as last_name'),
            DB::raw('COUNT(*) as order_count'),
            DB::raw('SUM(total_price) as total_spent')
        )
        ->where('payment_method', '!=', 'B2B')
        ->whereNull('idCustomer')
        ->groupBy('customer_email')
        ->get()
        ->map(function ($guest) {
            return (object)[
                'idCustomer' => null,
                'avatar' => 'avt_default.webp',
                'username' => $guest->customer_email,
                'first_name' => $guest->first_name ?? '',
                'last_name' => $guest->last_name ?? '',
                'email' => $guest->customer_email,
                'order_count' => $guest->order_count,
                'total_spent' => $guest->total_spent ?? 0,
                'formatted_total_spent' => number_format($guest->total_spent ?? 0, 0, ',', '.') . ' đ',
                'type' => 'Khách'
            ];
        });

    // 3️⃣ Gộp 2 nhóm
    $list_customer = $customers->concat($guests);

    // 4️⃣ Tổng số khách
    $count_customer = $list_customer->count();

    return view('admin.manage-users.manage-customers', compact('list_customer', 'count_customer'));
}





    // Thêm nhân viên
    public function submit_add_staffs(Request $request){
        $data = $request->all();
        $admin = new Admin();
    
        // Kiểm tra email đã tồn tại chưa
        $check_admin_user = Admin::where('admin_email', $data['admin_email'])->first();
    
        if ($check_admin_user) {
            return redirect()->back()->with('error', 'Tài khoản nhân viên này đã tồn tại');
        } else {
            $admin->admin_name = $data['admin_name'];
            $admin->admin_email = $data['admin_email'];
            $admin->admin_password = Hash::make($data['admin_password']); // Mã hóa mật khẩu
            $admin->position = $data['position'];
            $admin->admin_phone = $data['admin_phone'];
            $admin->save();
            session()->flash('success', 'Thêm nhân viên thành công');
            return redirect('/manage-staffs');
        }
    }

    // Xóa nhân viên
    public function delete_staff($admin_id)
    {
        $admin = Admin::find($admin_id);
    
        if (!$admin) {
            return redirect()->back()->with('error', 'Nhân viên không tồn tại');
        }
    
        $currentAdmin = Auth::guard('admin')->user();
    
        // Nếu người đang đăng nhập là admin
        if ($currentAdmin->position === 'admin') {
            // Admin không thể xóa admin khác hoặc dev
            if ($admin->position === 'admin' || $admin->position === 'dev') {
                return redirect()->back()->with('error', 'Bạn không có quyền xóa tài khoản này.');
            }
        }
    
        // Nếu người đang đăng nhập là dev, họ có quyền xóa tất cả
        if ($currentAdmin->position === 'dev' || $admin->position === 'sale') {
            $admin->delete();
            session()->flash('success', 'Xóa nhân viên thành công');
            return redirect()->back();
        }
    
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện hành động này.');
    }

    //Baotriwebsite
    public function Suspended()
{
    $suspended = Setting::where('key', 'suspended')->first();
    return view('admin.suspended.admin-suspended', [
        'suspended' => $suspended ? $suspended->value == '1' : false
    ]);
}


    // AJAX toggle Suspended
    public function toggleSuspended(Request $request)
    {
        try {
            $status = $request->input('status') ? '1' : '0';
            Setting::updateOrCreate(
                ['key' => 'suspended'],
                ['value' => $status]
            );

            return response()->json(['suspended' => $status == '1']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Xóa tài khoản khách hàng
    public function delete_customer($idCustomer){
        Customer::find($idCustomer)->delete();
        session()->flash('success', 'Thêm khách thành công');
        return redirect()->back();
    }
    
    public function account_setting(){
        $account_admin = Auth::guard('admin')->user();
        return view("admin.manage-users.account-setting")->with(compact('account_admin'));;
    }

     // Cập nhật thông tin cá nhân
     public function updateProfile(Request $request)
     {
         $request->validate([
             'admin_name' => 'required|string|max:255',
             'admin_phone' => 'required|string|max:15',
         ]);
 
         $admin = auth()->user();
         $admin->admin_name = $request->admin_name;
         $admin->admin_phone = $request->admin_phone;
         $admin->save();
 
         return back()->with('success', 'Cập nhật thông tin thành công.');
     }
 
     // Đổi mật khẩu
     public function updatePassword(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password_new' => 'required|min:6',
            'password_new_again' => 'required|same:password_new',
        ]);

        $admin = auth()->user(); // Lấy thông tin admin đã đăng nhập

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->password_old, $admin->admin_password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        // Cập nhật mật khẩu mới (NHỚ MÃ HÓA)
        $admin->admin_password = Hash::make($request->password_new);
        $admin->save();

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }

 
     // Cập nhật ảnh đại diện
    public function updateAvatar(Request $request)
    {
        $admin = auth()->user(); // Lấy admin đang đăng nhập
        $path = 'public/backend/images/profile/'; // Đúng đường dẫn storage

        // Kiểm tra có file ảnh được tải lên không
        if ($request->hasFile('Avatar')) {
            $get_image = $request->file('Avatar'); // Lấy file từ form

            // Nếu không có file, trả về lỗi
            if (!$get_image) {
                return redirect()->back()->with('error', 'Vui lòng chọn hình ảnh');
            }

            $get_name_image = $get_image->getClientOriginalName();  // Lấy tên gốc của file
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();

            // Xóa ảnh cũ nếu có
            if ($admin->admin_avt && File::exists($path . $admin->admin_avt)) {
                File::delete($path . $admin->admin_avt);
            }

            // Lưu ảnh mới vào storage
            $get_image->move($path, $new_image);

            // Cập nhật avatar trong database
            $admin->admin_avt = $new_image;
            $admin->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh đại diện thành công');
        }

        return redirect()->back()->with('error', 'Vui lòng chọn hình ảnh');
    }

    public function deleteAvatar(Request $request)
    {
        try {
            $admin = Auth::user();
            $image_path = public_path('backend/images/profile/' . $admin->admin_avt);

            // Kiểm tra xem ảnh có tồn tại không
            if (File::exists($image_path)) {
                // Xóa ảnh trong thư mục
                File::delete($image_path);
            }

            // Cập nhật avatar trong CSDL
            $admin->admin_avt = null;
            $admin->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Ghi lại lỗi để debug
            Log::error("Error deleting avatar: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra trong quá trình xóa ảnh']);
        }
    }

    //////////////////////////////////////////////////////////
    //                   THEME ADMIN  VIEW                 //
    ////////////////////////////////////////////////////////
    public function updateTheme(Request $request)
    {
        // Lấy dữ liệu từ request
        
        $data = $request->only([
            'admin_id',
            'data-bs-theme',
            'data-color-theme',
            'data-layout',
            'data-boxed-layout',
            'data-card',
        ]);
        // Kiểm tra xem admin_id đã có trong bảng chưa
        $theme = Theme::where('admin_id', $data['admin_id'])->first();

        if ($theme) {
            // Nếu đã có thì cập nhật dữ liệu
            $theme->update($data);
        } else {
            // Nếu chưa có thì tạo mới bản ghi
            $theme = Theme::create($data);
        }

        return response()->json([
            'status' => 'success',
            'theme' => $theme
        ]);
    }
    public function updateThemeSession(Request $request)
{
    $adminId = session('admin_id');

    $theme = Theme::where('admin_id', $adminId)->first();

    if ($theme) {
        session([
            'data_bs_theme'     => $theme->{'data-bs-theme'},
            'data_color_theme'  => $theme->{'data-color-theme'},
            'data_layout'       => $theme->{'data-layout'},
            'data_boxed_layout' => $theme->{'data-boxed-layout'},
            'data_card'         => $theme->{'data-card'},
        ]);

        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'error']);
}
}
<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function searchOrder(Request $request)
    {
        $query = trim($request->input('query_order'));
    
        if (empty($query)) {
            return response()->json([]);
        }
    
        try {
            $orders = Order::where('order_number', $query) // Tìm kiếm chính xác
                        ->select('order_number', 'total_price', 'status', 'idCustomer')
                        ->get();
    
            return response()->json([
                'orders' => $orders,
                'currentUserId' => Auth::check() ? Auth::id() : null
            ]);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi tìm kiếm đơn hàng'], 500);
        }
    }

    public function updateStatus($order_number, $status)
    {
        // Danh sách các trạng thái hợp lệ
        $validStatuses = ['pending', 'confirmed', 'shipped', 'delivered'];

        // Kiểm tra nếu status không hợp lệ
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Trạng thái không hợp lệ!');
        }

        // Tìm đơn hàng theo order_number
        $order = Order::where('order_number', $order_number)->first();

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    public function showBillInfo($order_number)
    {
        $list_bill = Order::where('order_number', $order_number)->with('items')->first();

        if (!$list_bill) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        // Lấy danh sách product_code trong đơn hàng
        $productCodes = $list_bill->items->pluck('product_code')->toArray();
        $subTotal = $list_bill->items->sum(fn($item) => $item->price * $item->quantity);
        $now = now();

        // Lấy promotions áp dụng cho đơn hàng này
        $promotions = \App\Models\Promotion::with('giftProduct')
            ->where('is_active', 1)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->where(function($q) use ($productCodes, $subTotal) {
                $q->where(function($q2) use ($subTotal) {
                    $q2->where('promotion_type', 'gift')
                       ->where('min_total_for_gift', '<=', $subTotal);
                })
                ->orWhere(function($q2) use ($productCodes) {
                    $q2->where('promotion_type', 'combo')
                       ->whereIn('product_id', $productCodes);
                });
            })
            ->get();

        return view('admin.bill.bill-info', compact('list_bill', 'promotions'));
    }
   public function all_bill()
    {
        $perPage = 10;
        $list_bill = Order::orderBy('id', 'desc')->paginate($perPage);
        $totalOrders = Order::count();
        return view('admin.bill.list-bill')
        ->with('list_bill', $list_bill,)
        ->with('totalOrders', $totalOrders);
    }

    public function showBillWaiting()
    {
        // Lấy danh sách hóa đơn có trạng thái "pending"
        $perPage = 10;
        $list_bill = Order::where('status', 'waiting')->paginate($perPage);
        $waitingOrders = Order::where('status', 'waiting')->count();
        return view('admin.bill.waiting-bill', compact('list_bill','waitingOrders'));
    }
    public function showBillPending()
    {
        // Lấy danh sách hóa đơn có trạng thái "pending"
        $perPage = 10;
        $list_bill = Order::where('status', 'pending')->paginate($perPage);
        $pendingOrders = Order::where('status', 'pending')->count();
        return view('admin.bill.pending-bill', compact('list_bill','pendingOrders'));
    }

    public function showBillConfirmed()
    {
        // Lấy danh sách hóa đơn có trạng thái "pending"
        $perPage = 10;
        $list_bill = Order::where('status', 'confirmed')->paginate($perPage);
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        return view('admin.bill.confirmed-bill', compact('list_bill','confirmedOrders'));
    }
    public function showBillShipped()
    {
        // Lấy danh sách hóa đơn có trạng thái "pending"
        $perPage = 10;
        $list_bill = Order::where('status', 'shipped')->paginate($perPage);
        $shippedOrders = Order::where('status', 'shipped')->count();
        return view('admin.bill.shipping-bill', compact('list_bill','shippedOrders'));
    }
    public function showBillDelivered()
    {
        // Lấy danh sách hóa đơn có trạng thái "pending"
        $perPage = 10;
        $list_bill = Order::where('status', 'delivered')->paginate($perPage);
        $deliveredOrders = Order::where('status', 'delivered')->count();
        return view('admin.bill.shipped-bill', compact('list_bill','deliveredOrders'));
    }

    public function delete($order_number)
    {
        // Kiểm tra quyền admin và dev
        if (!in_array(Auth::user()->position, ['admin', 'dev'])) {
        return redirect()->back()->with('error', 'Bạn không có quyền xóa đơn hàng này.');
    }

        // Tìm đơn hàng
        $order = Order::where('order_number', $order_number)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        // Xóa đơn hàng
        $order->delete();

        // Chuyển hướng về trang danh sách đơn hàng
        return redirect()->route('order.allBill')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}

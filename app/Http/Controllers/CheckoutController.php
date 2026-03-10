<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Promotion;
use App\Models\Voucher;
use App\Models\Product;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // Hiển thị trang checkout
   public function index()
    {
        $cart = session('cart', []);
        $subTotal = array_sum(array_map(fn($item) => $item['quantity'] * (float)$item['price'], $cart));
        $now = now();

        // Danh sách combo đã có trong giỏ (dùng key combo_{promotion_id})
        $comboInCart = collect($cart)
            ->filter(fn($item) => ($item['promotion_type'] ?? '') === 'combo')
            ->map(fn($item, $key) => str_replace('combo_', '', $key))
            ->values()
            ->toArray();

        $promotions = Promotion::with('giftProduct')
            ->where('is_active', 1)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->get();
        $vouchers = Voucher::where('VoucherStart', '<=', $now)
        ->where('VoucherEnd', '>=', $now)
        ->where('VoucherQuantity', '>', 0)
        ->orderByDesc('VoucherNumber') // ưu tiên giảm nhiều
        ->get();
        $subTotal = array_sum(array_map(fn($item) => $item['quantity'] * (float)$item['price'], $cart));

        return view('pages.cart.checkout', compact('cart', 'promotions', 'comboInCart','vouchers','subTotal'));
    }

    // Xử lý tạo đơn hàng
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'country' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:15|regex:/^\d{10,15}$/',
            'customer_email' => 'required|email|max:100',
            'cart' => 'required|json',
            'payment_method' => 'required|string|max:255',
            'invoice_required' => 'nullable|boolean',
            'invoice_tax_code' => 'nullable|string|max:50',
            'invoice_company_name' => 'nullable|string|max:255',
            'invoice_address' => 'nullable|string|max:255',
            'invoice_email' => 'nullable|email|max:100',
            'voucher' => 'nullable|string|max:50',
            'shipping_fee' => 'nullable|string|max:50',
            'total_price' => 'required|string|min:0',
			'original_total' => 'required|string|min:0',
        ]);

        try {
            $idCustomer = auth()->check() ? auth()->id() : null;
            $cart = json_decode($validated['cart'], true);
            if (json_last_error() !== JSON_ERROR_NONE || empty($cart)) {
                return redirect()->back()->withErrors('Giỏ hàng của bạn không hợp lệ hoặc đang trống!');
            }

            // Tạo mã đơn hàng duy nhất
            do {
                $datePart = now()->format('dmy');
                $randomPart = strtoupper(Str::random(4));
                $orderNumber = "HPE-{$datePart}{$randomPart}";
            } while (Order::where('order_number', $orderNumber)->exists());

            $orderData = [
                'order_number' => $orderNumber,
                'idCustomer' => $idCustomer,
                'status' => 'waiting',
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'country' => $validated['country'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'district' => $validated['district'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'],
                'voucher' => $validated['voucher'],
                'shipping_fee' => $validated['shipping_fee'],
                'payment_method' => $validated['payment_method'],
                'total_price' => $validated['total_price'],
				'original_total' => $validated['original_total'],
            ];

            if (!empty($validated['invoice_required'])) {
                $orderData['invoice_required'] = 1;
                $orderData['invoice_tax_code'] = $validated['invoice_tax_code'] ?? null;
                $orderData['invoice_company_name'] = $validated['invoice_company_name'] ?? null;
                $orderData['invoice_address'] = $validated['invoice_address'] ?? null;
                $orderData['invoice_email'] = $validated['invoice_email'] ?? null;
            } else {
                $orderData['invoice_required'] = 0;
            }

            $order = Order::create($orderData);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_name' => $item['name'],
                    'attribute' => $item['attribute'] ?? null,
                    'productAttributeCode' => $item['productAttributeCode'] ?? null,
                    'product_code' => $item['product_code'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // 🛒 Xóa giỏ hàng sau khi đặt hàng thành công
        Session::forget('cart');
        // Nếu là COD hoặc Store-Cash thì chuyển hướng đến trang thành công
        if (in_array($validated['payment_method'], ['COD', 'Store-Cash'])) {
            $order->update(['status' => 'pending']);
            return redirect()->route('checkout.success', ['orderNumber' => $order->order_number]);
        }

        // Điều hướng đến trang thanh toán QR
        return redirect()->route('checkout.qr', ['orderNumber' => $order->order_number]);

    } catch (\JsonException $e) {
        Log::error('Cart decoding error: ' . $e->getMessage());
        return redirect()->back()->withErrors('Giỏ hàng không hợp lệ. Vui lòng thử lại.');
    } catch (\Exception $e) {
        Log::error('Checkout error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return redirect()->back()->withErrors('Đã xảy ra lỗi trong quá trình tạo đơn hàng. Vui lòng thử lại.');
    }
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->first();
		foreach ($order->items as $item) {
            $item->productData = Product::where('product_code', $item->product_code)->first();
        }
        if (!$order) {
            return redirect()->route('cart')->withErrors('Đơn hàng không tồn tại.');
        }

        // Nếu email đã được gửi, chuyển hướng sang trang chi tiết đơn hàng
        if ($order->email_sent == 1) {
            return redirect()->route('order.details', ['orderNumber' => $orderNumber]);
        }

        // Cập nhật trạng thái đơn hàng
        $order->update(['status' => 'pending']);

        // Giảm số lượng voucher nếu có
        if ($order->voucher) {
            $voucherData = explode('-', $order->voucher);
            $voucherId = $voucherData[0] ?? null;
            if ($voucherId) {
                $voucher = Voucher::find($voucherId);
                if ($voucher && $voucher->VoucherQuantity > 0) {
                    $voucher->decrement('VoucherQuantity', 1);
                }
            }
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

        // Gửi lại mail nếu chưa gửi
        if (!$order->email_sent) {
             try {
                //$promotions = Promotion::with('giftProduct')
                    //->where('is_active', 1)
                    //->where('start_date', '<=', now())
                    //->where('end_date', '>=', now())
                    //->get();
                Mail::to($order->customer_email)->send(new OrderCreatedMail($order, $promotions, 'customer'));
                // Nếu muốn gửi cho admin:
                Mail::to(config('mail.from.address'))->send(new OrderCreatedMail($order, $promotions, 'admin'));
                $order->update(['email_sent' => 1]);
            } catch (\Exception $e) {
                Log::error('Send mail error: ' . $e->getMessage());
            }
        }

        return view('pages.cart.success', compact('order', 'promotions'))
            ->with('success', 'Đơn hàng của bạn đã được đặt thành công.');
    }

    public function showQrPage($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->first();

        if (!$order) {
            return redirect()->route('cart')->withErrors('Không tìm thấy đơn hàng.');
        }

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

        return view('pages.cart.qr', compact('order', 'promotions'));
}    
}

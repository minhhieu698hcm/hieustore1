<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Voucher;
use App\Models\Product;
use App\Models\Discount;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function showCart()
{
    $cart = Session::get('cart', []);
    $subtotal = 0;

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    return view('pages.cart.cart', [
        'cart' => $cart,
        'subtotal' => $subtotal
    ]);
}

    public function getCart()
{
    $cart = Session::get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return response()->json([
        'success' => true,
        'cart' => $cart,
        'total' => $total
    ]);
}


    public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    $productAttributeCode = $request->input('product_attribute_code', '');
    $attributeName = $request->input('attribute_name', '');
    $quantity = (int) $request->input('quantity', 1);
    $product = Product::find($productId);

    if ($product) {
        $cart = Session::get('cart', []);
        $cartKey = $productId . $productAttributeCode;

        $originalPrice = $product->product_price;
        $discountPercent = Discount::where('category_id', $product->category_id)->value('percent');
        if ($discountPercent === null) {
            $discountPercent = Discount::where('category_id', 0)->value('percent');
        }

        // Nếu có phân loại
        if ($productAttributeCode) {
            $productAttribute = DB::table('product_attribute')
                ->where('product_id', $productId)
                ->where('product_attribute_code', $productAttributeCode)
                ->first();

            if ($productAttribute) {
                $originalPrice = floatval($productAttribute->product_price);
            }
        }

        $price = $originalPrice;
        if ($price > 0 && $discountPercent) {
            $price = round($price * (1 - $discountPercent / 100));
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'name' => $product->product_name,
                'price' => $price,
                'original_price' => $originalPrice,
                'discount_percent' => $discountPercent ?? 0,
                'product_code' => $product->product_code,
                'productAttributeCode' => $productAttributeCode,
                'image' => $product->product_image,
                'attribute' => $attributeName,
                'quantity' => $quantity,
                'product_slug' => $product->product_Slug,
            ];
        }

        Session::put('cart', $cart);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'product' => $product,
            'cart' => $cart,
            'total' => $total
        ]);
    }

    return response()->json(['success' => false]);
}





    
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
    }

    public function clearCart(Request $request)
    {
        if (Session::has('cart')) {
            Session::forget('cart');
            return response()->json(['success' => true, 'message' => 'Giỏ hàng đã được xoá thành công!']);
        }
        return response()->json(['success' => false, 'message' => 'Giỏ hàng hiện tại trống.']);
    }

    private function formatCurrency($number)
    {
        return number_format($number, 0, ',', '.'); // Thêm dấu "." phân cách hàng nghìn
    }

    public function updateCartQuantity(Request $request)
{
    $productId = $request->input('product_id');
    $newQuantity = (int) $request->input('quantity');

    if ($newQuantity < 1 || $newQuantity > 100) {
        return response()->json(['success' => false, 'message' => 'Số lượng không hợp lệ.']);
    }

    $cart = Session::get('cart', []);
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] = $newQuantity;

        // Tính lại tổng giá tiền của sản phẩm
        $productTotal = $cart[$productId]['quantity'] * $cart[$productId]['price'];

        // Tính tổng giá trị giỏ hàng
        $cartTotal = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        
        // Lưu lại giỏ hàng trong session
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'product_total' => $this->formatCurrency($productTotal), // Định dạng tiền tệ
            'cart_total' => $this->formatCurrency($cartTotal), // Cập nhật tổng cộng giỏ hàng (bao gồm phí vận chuyển)
            'cart' => $cart
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
}


public function check_voucher(Request $request)
{
    $data = $request->all();
    $cartTotal = (float) $data['cartTotal'];

    $check_voucher = Voucher::whereRaw('BINARY `VoucherCode` = ?', [$data['VoucherCode']])->first();

    if (!$check_voucher) {
        return response('Mã giảm giá không hợp lệ', 400);
    }

    if ($check_voucher->VoucherEnd < now()) {
        return response('Mã giảm giá này đã hết hạn', 400);
    }

    if ($check_voucher->VoucherStart > now()) {
        return response('Chưa đến thời gian áp dụng mã giảm giá này', 400);
    }

    if ($check_voucher->VoucherQuantity <= 0) {
        return response('Mã giảm giá này đã hết số lần sử dụng', 400);
    }

    // Kiểm tra giỏ hàng
    $cart = session('cart', []);
    foreach ($cart as $item) {
        if (!empty($item['discount_percent']) && $item['discount_percent'] > 0) {
            return response('Không thể áp dụng mã giảm giá khi sản phẩm trong giỏ đã có giảm giá', 400);
        }
    }

    // Kiểm tra giá trị tối thiểu của đơn hàng
    if ($cartTotal < $check_voucher->bill_price_min) {
        return response('Đơn hàng phải từ ' . number_format($check_voucher->bill_price_min, 0, ',', '.') . '₫ mới được áp dụng mã giảm giá', 400);
    }

    $discount = $check_voucher->VoucherNumber;
    $condition = $check_voucher->VoucherCondition;
    $voucherNumber = $check_voucher->VoucherNumber;

    if ($check_voucher->VoucherCondition == 1) {
        $discount = ($cartTotal * $discount) / 100;

        if ($check_voucher->discount_max > 0 && $discount > $check_voucher->discount_max) {
            $discount = $check_voucher->discount_max;
        }
    }

    return response()->json([
        'status' => 'success',
        'discount' => $discount,
        'voucher_id' => $check_voucher->idVoucher,
        'condition' => $condition,
        'voucher_number' => $voucherNumber,
    ]);
}

}


<?php
namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Mail\OrderCreatedMail;
use Illuminate\Support\Facades\Mail;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with(['product', 'giftProduct'])->paginate(20);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $products = Product::orderBy('product_name')->get(); // Đúng tên cột
        return view('admin.promotions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'product_id' => 'nullable|integer',
            'gift_product_id' => 'required|integer',
            'image' => 'nullable|string|max:255',
            'price_old' => 'nullable|numeric',
            'price_new' => 'nullable|numeric',
            'promotion_type' => 'required|in:gift,combo',
            'min_total_for_gift' => 'nullable|numeric|min:0',
            'combo_price' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
        ]);

        // Không cần xử lý lại start_date/end_date nếu dùng input type="date"
        // $data['start_date'] và $data['end_date'] sẽ là 'YYYY-MM-DD'

        if ($data['promotion_type'] === 'gift') {
            $data['combo_price'] = null;
        } else {
            $data['min_total_for_gift'] = null;
        }

        if (!isset($data['is_active'])) {
            $data['is_active'] = 0;
        }

        Promotion::create($data);
        return redirect()->route('promotions.index')->with('success', 'Tạo khuyến mãi thành công!');
    }

    public function edit(Promotion $promotion)
    {
        $products = Product::orderBy('product_name')->get();
        return view('admin.promotions.edit', compact('promotion', 'products'));
    }

    public function update(Request $request, Promotion $promotion)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'product_id' => 'nullable|integer',
        'gift_product_id' => 'nullable|integer',
        'image' => 'nullable|string|max:255',
        'price_old' => 'nullable|numeric',
        'price_new' => 'nullable|numeric',
        'promotion_type' => 'required|in:gift,combo',
        'min_total_for_gift' => 'nullable|numeric|min:0',
        'combo_price' => 'nullable|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'is_active' => 'boolean',
        'description' => 'nullable|string',
    ]);

    if ($data['promotion_type'] === 'gift') {
        $data['combo_price'] = null;
    } else {
        $data['min_total_for_gift'] = null;
    }

    // Nếu là combo → map gift_product_id_combo sang gift_product_id
    if ($data['promotion_type'] === 'combo' && $request->filled('gift_product_id_combo')) {
        $data['gift_product_id'] = $request->input('gift_product_id_combo');
    }

    $promotion->update($data);

    return redirect()->route('promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
}

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Xóa khuyến mãi thành công!');
    }

    public function applyPromotion($product)
    {
        $item = [
            'product_id' => $product->id,
            'name' => $product->product_name,
            // ... các trường khác ...
        ];

        // Kiểm tra promotion
        $promotion = Promotion::where('is_active', 1)
            ->where(function($q) use ($product) {
                $q->where('product_id', $product->id)
                  ->orWhere('gift_product_id', $product->id);
            })
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($promotion) {
            $item['promotion_title'] = $promotion->title;
            $item['promotion_type'] = $promotion->promotion_type;
            $item['min_total_for_gift'] = $promotion->min_total_for_gift;
            $item['combo_price'] = $promotion->combo_price;
            $item['gift_product_id'] = $promotion->gift_product_id;
            $item['gift_product_name'] = $promotion->giftProduct ? $promotion->giftProduct->product_name : null;

            // Tạo thông báo
            if ($promotion->promotion_type == 'gift') {
                $item['promotion_message'] = 'Mua đơn từ ' . number_format($promotion->min_total_for_gift, 0, ',', '.') . '₫ để nhận quà: ' . $item['gift_product_name'];
            } elseif ($promotion->promotion_type == 'combo') {
                $item['promotion_message'] = 'Mua kèm sản phẩm ' . $item['gift_product_name'] . ' với giá ' . number_format($promotion->combo_price, 0, ',', '.') . '₫';
            }
        }

        return $item;
    }

    public function addGiftToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $promotion = Promotion::where('gift_product_id', $productId)
            ->where('promotion_type', 'gift')
            ->where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$promotion) {
            return response()->json(['success' => false, 'message' => 'Quà tặng không hợp lệ hoặc đã hết hạn.']);
        }

        $cart = session('cart', []);
        $cart[] = [
            'product_id' => $productId,
            'name' => $promotion->giftProduct->product_name,
            'quantity' => 1,
            'price' => 0,
            'product_code' => $promotion->giftProduct->product_code,
            'product_slug' => $promotion->giftProduct->product_slug,
            'image' => $promotion->giftProduct->product_image,
            'attribute' => 'Quà tặng',
            'promotion_type' => 'gift', // Thêm dòng này
        ];
        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

  public function addComboToCart(Request $request)
{
    $productId  = $request->input('product_id');
    $product = Product::find($productId);
    $comboPrice = $request->input('price');
    $attributeName = $request->input('attribute_name', '');
    $productAttributeCode = $request->input('product_attribute_code', '');
    $promotion = Promotion::where('gift_product_id', $productId)
        ->where('promotion_type', 'combo')
        ->where('is_active', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();
    $discountPercent = Discount::where('category_id', $product->category_id)->value('percent');
    if (!$promotion) {
        return response()->json([
            'success' => false,
            'message' => 'Sản phẩm combo không hợp lệ hoặc đã hết hạn.'
        ]);
    }

    $cart = session('cart', []);

    // key riêng cho combo
    $cartKey = 'combo_' . $promotion->id;

    $cart[$cartKey] = [
        'product_id'     => $productId,
        'name' => $promotion->giftProduct->product_name,
        'price' => $comboPrice,
        'original_price' => $promotion->giftProduct->product_price,
        'discount_percent' => $discountPercent ?? 0,
        'product_code' => $promotion->giftProduct->product_code,
        'productAttributeCode' => $productAttributeCode,
        'image' => $promotion->giftProduct->product_image,
        'attribute' => $attributeName,
        'quantity' => 1,
        'product_slug' => $promotion->giftProduct->product_slug,
        'promotion_type' => 'combo',
   
    ];

    session(['cart' => $cart]);

    return response()->json([
        'success' => true,
        'cart'    => array_values($cart),
        'totals'  => $this->calculateTotals($cart)
    ]);
}

public function removeComboFromCart(Request $request)
{
    $promotionId = $request->input('promotion_id');
    $cart = session('cart', []);
    $cartKey = 'combo_' . $promotionId;

    if (isset($cart[$cartKey])) {
        unset($cart[$cartKey]);
        session(['cart' => $cart]);
    }

    return response()->json([
        'success' => true,
        'cart'    => array_values($cart),
        'totals'  => $this->calculateTotals($cart)
    ]);
}

private function calculateTotals($cart)
{
    $subTotal = collect($cart)->sum(fn($item) => $item['quantity'] * (float)$item['price']);
    $originalTotal = collect($cart)->sum(fn($item) => $item['quantity'] * (float)($item['original_price'] ?? $item['price']));
    $saving = max(0, $originalTotal - $subTotal);

    return [
        'subTotal'      => $subTotal,
        'originalTotal' => $originalTotal,
        'saving'        => $saving,
        'totalAmount'   => $subTotal, // chưa tính phí ship/discount
    ];
}
public function getValidPromotions()
{
    $now = now();
    $cart = session('cart', []);

    // Tính tổng tiền giỏ hàng
    $subTotal = array_sum(array_map(fn($item) => $item['quantity'] * (float)$item['price'], $cart));

    // Chuẩn hóa cart để dễ so sánh
    $cartItems = collect($cart)->map(function ($item) {
        return [
            'product_id'             => $item['product_id'] ?? null,
            'product_code'           => $item['product_code'] ?? null,
            'product_attribute_code' => $item['productAttributeCode'] ?? null,
        ];
    });

    // Các combo đã có trong cart
    $comboInCart = collect($cart)
        ->filter(fn($item) => ($item['promotion_type'] ?? '') === 'combo')
        ->map(fn($item, $key) => str_replace('combo_', '', $key))
        ->values()
        ->toArray();

    // Lấy tất cả promotions còn hiệu lực
    $allPromotions = Promotion::with(['giftProduct', 'product.productAttributes'])
        ->where('is_active', 1)
        ->where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->get();

    // ====== XỬ LÝ COMBO ======
    $comboPromotions = $allPromotions->where('promotion_type', 'combo')->filter(function ($promo) use ($cartItems) {
        $product = $promo->product;
        if (!$product) return false;

        // Tập hợp code + attribute_code trong promotion
        $promoCodes = collect($product->productAttributes)->map(function ($attr) use ($product) {
            return [
                'product_code'           => $product->product_code,
                'product_attribute_code' => $attr->product_attribute_code
            ];
        });

        // Nếu sản phẩm không có phân loại thì chỉ check product_code
        if ($promoCodes->isEmpty()) {
            $promoCodes->push([
                'product_code'           => $product->product_code,
                'product_attribute_code' => null
            ]);
        }

        // So sánh với cart
        return $cartItems->contains(function ($cartItem) use ($promoCodes) {
            return $promoCodes->contains(function ($code) use ($cartItem) {
                return $cartItem['product_code'] === $code['product_code']
                    && (
                        !$code['product_attribute_code'] ||
                        $cartItem['product_attribute_code'] === $code['product_attribute_code']
                    );
            });
        });
    })->values();

    // ====== XỬ LÝ GIFT ======
    // Quà tặng KHÔNG phụ thuộc sản phẩm trong giỏ hàng, chỉ phụ thuộc tổng tiền
    $giftPromotions = $allPromotions->where('promotion_type', 'gift')->values();

    return response()->json([
        'comboPromotions' => $comboPromotions,
        'giftPromotions'  => $giftPromotions,
        'subTotal'        => $subTotal,
        'comboInCart'     => $comboInCart,
        'cartProductIds'  => $cartItems->pluck('product_id')->toArray(),
        'cart'            => array_values($cart),
    ]);
}



    // public function sendOrderEmail($order)
    // {
    //     $promotions = session('cart', []);
    //     Mail::to(...)->send(new OrderCreatedMail($order, $promotions));
    // }
}

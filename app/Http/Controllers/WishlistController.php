<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    public function getWishlistall()
    {
        $wishlist = Session::get('wishlist', []);
        return view('pages.customer.wishlist', compact('wishlist'));
    }

    public function getWishlist()
    {
        $wishlist = Session::get('wishlist', []);
        return response()->json(['success' => true, 'wishlist' => $wishlist]);
    }

    public function addToWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại.']);
        }
        $wishlist = Session::get('wishlist', []);
        if (isset($wishlist[$productId])) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm này đã có trong danh sách yêu thích.']);
        } else {
            $wishlist[$productId] = [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'image' => $product->product_image,
            ];
            Session::put('wishlist', $wishlist);
            return response()->json(['success' => true, 'wishlist' => $wishlist, 'message' => 'Sản phẩm đã được thêm vào danh sách yêu thích.']);
        }
    }

    public function removeFromWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $wishlist = Session::get('wishlist', []);
        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            Session::put('wishlist', $wishlist);
            return response()->json(['success' => true, 'wishlist' => $wishlist]);
        }
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong danh sách yêu thích.']);
    }

    public function clearWishlist(Request $request)
    {
        if (Session::has('wishlist')) {
            Session::forget('wishlist');
            return response()->json(['success' => true, 'message' => 'Danh sách yêu thích đã được xoá thành công!']);
        }
        return response()->json(['success' => false, 'message' => 'Danh sách yêu thích hiện tại trống.']);
    }
}

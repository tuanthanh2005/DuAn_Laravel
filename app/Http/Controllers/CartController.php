<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    public function save_cart(Request $request)
    {
        // 1. Nhận dữ liệu từ form
        $productId = $request->productid_hidden;
        $quantity  = $request->qty;

        // 2. Lấy sản phẩm từ DB
        $product = DB::table('tbl_product')
            ->where('product_id', $productId)
            ->first();

        // 3. Cập nhật session cart
        if ($product) {
            $cart = Session::get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'id'       => $product->product_id,
                    'name'     => $product->product_name,
                    'price'    => $product->product_price,
                    'image'    => $product->product_image,
                    'quantity' => $quantity,
                ];
            }

            Session::put('cart', $cart);
        }

        // 🔥 Tránh lỗi F5 thêm lại sản phẩm
        return redirect()->route('cart.show')->with('success', 'Đã Thêm sản phẩm vào giỏ hàng!');
    }

    public function remove_item($id)
    {
        // Lấy cart từ session
        $cart = Session::get('cart', []);

        // Nếu tồn tại sản phẩm đó trong cart thì xóa
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        // Chuyển về lại trang giỏ hàng thay vì trang chủ
        return redirect()->route('cart.show')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function cart(Request $request)
    {
        // 1. Nếu là POST (thêm sản phẩm)
        if ($request->isMethod('post') && $request->has('productid_hidden')) {
            $id  = $request->productid_hidden;
            $qty = $request->qty;

            $product = DB::table('tbl_product')
                ->where('product_id', $id)
                ->first();

            if ($product) {
                $cart = Session::get('cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] += $qty;
                } else {
                    $cart[$id] = [
                        'id'       => $product->product_id,
                        'name'     => $product->product_name,
                        'price'    => $product->product_price,
                        'image'    => $product->product_image,
                        'quantity' => $qty,
                    ];
                }

                Session::put('cart', $cart);

                // 🔥 Sau khi thêm thì redirect để tránh lỗi reload
                return redirect()->route('cart.show')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
            }
        }

        // 2. Nếu là GET (xem giỏ hàng)
        $category = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'asc')
            ->get();
        $brand = DB::table('tbl_brand_product')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'asc')
            ->get();

        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0);

        // Trả view save_cart
        return view('pages.cart.save_cart', compact('category', 'brand', 'cart', 'total'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {

        return view('frontend.home');
    }

    public function example()
    {
        $numberOfProduct = 10;
        $data = [
            'Cách 1' => 1,
            'Cách 2' => 2,
            'Cách 3' => 3,
        ];
        return view('frontend.ex', compact('numberOfProduct', 'data'));
    }

    public function shopProducts(Request $request)
    {
        $search = $request->get('search');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('TenSP', 'like', '%' . $search . '%');
            })
            ->paginate(6);

        return view('frontend.shop', compact('products'));
    }

    public function productDetails($maSP)
    {
        $product = Product::query()->where("MaSP", "=", $maSP)->first();
        return view('frontend.product_details', compact('product'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', ['cart' => $cart]);
        // return view('frontend.cart');
    }
    
    public function addToCart($maSP)
{
    $product = Product::findOrFail($maSP);

    $cart = session()->get('cart', []);

    if (!array_key_exists($product->MaSP, $cart)) {
        $cart[$product->MaSP] = [
            'quantity' => 1,
            'Gia' => $product->Gia,
            'TenSP' => $product->TenSP,
            'AnhSP' => $product->AnhSP,
        ];
    } else {
        $cart[$product->MaSP]['quantity']++;
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Product added to cart successfully!');
}
    public function remove(Request $request)
    {
        if($request->MaSP) {
            $cart = session()->get('cart');
            if(isset($cart[$request->MaSP])) {
                unset($cart[$request->MaSP]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}

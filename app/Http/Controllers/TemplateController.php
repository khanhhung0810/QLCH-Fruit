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
        $categories = Category::where('status', 0)->get();
        $products = Product::with('categories')->get();
        return view('frontend.home', compact('categories','products'));
        // return view('frontend.home', compact('categories','products'));
    }

   

    public function shopProducts(Request $request)
    {
        $search = $request->get('search');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('TenSP', 'like', '%' . $search . '%');
            })
            ->paginate(6);
        $categories = Category::where('status', 0)->get();

        return view('frontend.shop', compact('products', 'categories'));
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
    public function update(Request $request)
    {
        if ($request->MaSP && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->MaSP]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->MaSP) {
            $cart = session()->get('cart');
            if (isset($cart[$request->MaSP])) {
                unset($cart[$request->MaSP]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
    public function checkCart()
    {
        dd(session('cart'));
    }

    public function chooseCategory(Category $category)
    {
        $products = $category->products()->paginate(6);
        $categories = Category::where('status', 0)->get();

        return view('frontend.shop', compact('products', 'categories'));
    }
}

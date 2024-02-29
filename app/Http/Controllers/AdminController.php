<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductPostRequest;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    public function index(){
        $products = Product::all();
    //     $category = Category::with('products')->find(1);
    //     dd($category->products);
    //     $product = Product::with('category')->find('SP03');
    //     dd($product->category);
        $categories = Category::pluck('name', 'id'); 
        return view('admin.dashboard', compact('products', 'categories'));
    }

    public function create()  {
        $categories = Category::all(); 
        return view('admin.create', compact('categories'));  
    }

    public function store(AddProductPostRequest $request)  {
        if ($request->hasFile('AnhSP')) {
            $path = 'images';
            $name = $request->file('AnhSP')->getClientOriginalName();
            $request->file('AnhSP')->move(public_path($path), $name);
            // dd($request->file('AnhSP'));
            $data = $request->all();
            $data['AnhSP'] = $name; 
            Product::create($data);
            return redirect('dashboard');
        } else {
        
            return back()->withErrors(['message' => 'Vui lòng chọn một file ảnh.']);
        }

    }

    public function destroy($product)  {
        
        Product::query()->find($product)->delete();
        return redirect()->back();
    }

    
    public function edit(String $product)  {
        $products = Product::findOrFail($product);
        $categories = Category::all(); 
        return view('admin.edit_product', compact('products', 'categories'));  
    }
    

    public function show(string $product)
    {
        $products = Product::findOrFail($product);
        $categories = Category::findOrFail($products->LoaiSP);
        return view('admin.show', compact('products', 'categories')); 
    }

    public function update(Request $request, string $product)
    {
        $product = Product::findOrFail($product);
        $product->update($request->all());
    
        if ($request->hasFile('AnhSP')) {
            $path = 'images';
            $name = $request->file('AnhSP')->getClientOriginalName();
            $request->file('AnhSP')->move(public_path($path), $name);
            $product->AnhSP = $name;
            $product->save();
        }
    
        return redirect('dashboard');

     
    }
   
}

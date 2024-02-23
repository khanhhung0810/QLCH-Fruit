<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductPostRequest;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function create()  {
       
        return view('admin.create');  
    }
    public function store(AddProductPostRequest $request)  {
        if ($request->hasFile('AnhSP')) {
            $folder = 'site/img/upload-img-product';
            $name = $request->file('AnhSP')->getClientOriginalName();
            $request->file('AnhSP')->storeAs($folder, $name, 'public');
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
        return view('admin.edit_product', compact('products'));  
    }
    

    public function show(string $product)
    {
        $products = Product::findOrFail($product);
        return view('admin.show', compact('products'));
    }

    public function update(Request $request, string $product)
    {
        $products = Product::findOrFail($product);
        $products->update($request->all());
        return redirect('dashboard');

     
    }
   
}
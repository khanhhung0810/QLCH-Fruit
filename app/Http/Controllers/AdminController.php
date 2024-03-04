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
    public function index()
    {
        $products = Product::all();

        //     $category = Category::with('products')->find(1);
        //     dd($category->products);
        //     $product = Product::with('category')->find('SP03');
        //     dd($product->category);
        return view('admin.dashboard', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function store(AddProductPostRequest $request)
    {   
        try {
                $images = [];
                $path = 'images';
                 //request->files(); lấy hết những file đã được upload.
                // // dd($request->file('AnhSP'));
                foreach ($request->file('AnhSP') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path($path), $name);
                    $images[] = $name;
                    // $images[] = ['img' => $name, 'url' => 'images/' . $name];
                    // Lưu tên tệp ảnh vào mảng
                }
                $data = $request->all();
                if (count($images) > 1) {
                    $data['AnhSP'] = json_encode($images); // Nhiều hình ảnh
                } else {
                    $data['AnhSP'] = json_encode([$images[0]]); // Một hình ảnh
                }        

                $product = Product::create($data);

                $product->category()->sync($data['LoaiSP']);
        

                return response()->json(['message' =>' Thêm sp']);
           
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
       
    }

    public function destroy($product)
    {

        Product::query()->find($product)->delete();
        return redirect()->back();
    }


    public function edit(String $product)
    {
        
        $product = Product::findOrFail($product);
        $categories = Category::all();
        $productCategories = $product->category;
        $productCategoryIds = [];
        foreach ($productCategories as $category){
            $productCategoryIds[]=$category->id;
        }
        return view('admin.edit_product', compact('product', 'categories', 'productCategoryIds'));
    }


    public function show(string $product)
    {
    
        $product = Product::findOrFail($product);
        $categories = Category::all();
        $productCategories = $product->category;
        $productCategoryIds = [];
        foreach ($productCategories as $category){
            $productCategoryIds[]=$category->id;
        }
        // dd($productIds);
        return view('admin.show', compact('product', 'categories','productCategoryIds'));
    }

    public function update(Request $request, string $product)
    {
        $product = Product::findOrFail($product);
        $product->update($request->except('AnhSP', 'LoaiSP'));
        
        if ($request->hasFile('AnhSP')) {
            $path = 'images';
            $name = $request->file('AnhSP')->getClientOriginalName();
            $request->file('AnhSP')->move(public_path($path), $name);
            $product->AnhSP = $name;
        }
        

        if ($request->has('LoaiSP')) {
            $product->category()->sync($request->input('LoaiSP'));
        }
        $product->save();
        return redirect('dashboard');
        
    }
}

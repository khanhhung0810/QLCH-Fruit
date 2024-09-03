<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductPostRequest;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL as FacadesURL;
use Yajra\DataTables\DataTables;
use URL;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('categories')->get();

            return DataTables::of($products)
                ->editColumn('AnhSP', function ($product) {
                    $productImages = json_decode($product->AnhSP);
                    return '<img src="' . url('images/' . Arr::first($productImages)) . '" alt="" width="120">';
                })
                ->editColumn('Gia', function ($product) {
                    return number_format($product->Gia, 0) . '₫';
                })
                ->addColumn('LoaiSP', function ($product) {
                    return $product->categories->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($product) {
                    $editUrl = route('product.edit', ['product' => $product->MaSP]);
                    $showUrl = route('product.show', ['product' => $product->MaSP]);
                    $deleteUrl = route('product.destroy', $product->MaSP);

                    return '<form action="' . $deleteUrl . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field("delete") . '
                            <a href="' . $editUrl . '" class="btn btn-sm btn-primary"><i class="fa fa-solid fa-pen-to-square"></i></a>
                            <a href="' . $showUrl . '" class="btn btn-sm btn-info"><i class="fa-solid fa-circle-info"></i></a>
                            <button type="submit" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></button>
                        </form>';
                })
                ->rawColumns(['AnhSP', 'action', 'LoaiSP'])
                ->make(true);
        }

        return view('admin.dashboard');
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

            $product->categories()->sync($data['LoaiSP']);


            return response()->json(['message' => ' Thêm Sản Phẩm Thành Công']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function destroy($product)
    {
      
        $product = Product::findOrFail($product); // Truy vấn đối tượng Product
        $product->categories()->detach(); // Ngắt liên kết với các danh mục

        $product->delete(); // Xóa sản phẩm
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }


    public function edit(String $product)
    {

        $product = Product::findOrFail($product);
        $categories = Category::all();
        $productCategories = $product->categories;
        $productCategoryIds = [];
        foreach ($productCategories as $category) {
            $productCategoryIds[] = $category->id;
        }
        return view('admin.edit_product', compact('product', 'categories', 'productCategoryIds'));
    }


    public function show(string $product)
    {

        $product = Product::findOrFail($product);
        $categories = Category::all();
        $productCategories = $product->categories;
        $productCategoryIds = [];
        foreach ($productCategories as $categories) {
            $productCategoryIds[] = $categories->id;
        }
        // dd($productIds);
        return view('admin.show', compact('product', 'categories', 'productCategoryIds'));
    }

    public function update(Request $request, string $product)
    {
        $product = Product::findOrFail($product);
        $data = $request->except('LoaiSP');

        try {
            if ($request->hasFile('AnhSP')) {
                $images = [];
                $path = 'images';
                // dd($request->file('AnhSP'));
                foreach ($request->file('AnhSP') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path($path), $name);
                    $images[] = $name;
                }

                if (count($images) > 1) {
                    $data['AnhSP'] = json_encode($images); // Nhiều hình ảnh
                } else {
                    $data['AnhSP'] = json_encode([$images[0]]); // Một hình ảnh
                }

                // Lấy ảnh đầu tiên để hiển thị
            }

            $product->update($data);

            if ($request->has('LoaiSP')) {
                $product->categories()->sync($request->input('LoaiSP'));
            }

            return redirect('dashboard')->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}

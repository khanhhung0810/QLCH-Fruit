<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryProductPostRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt = 1;

        $categories = Category::all();
        return view('admin.category_product', compact('categories','stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryProductPostRequest $request)
    {
        $data = $request->all();
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $categories)
    {
        $categoryEdit = Category::findOrFail($categories);

        return view('admin.category_edit', compact('categoryEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $categories = Category::findOrFail($category);
        $categories->update($request->all());
        return redirect('category');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categories)
    {
        Category::query()->find($categories)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(){
        
        return view('frontend.home');
    }
    
    public function example(){      
        $numberOfProduct = 10;
        $data= [
            'Cách 1' => 1,
            'Cách 2' => 2,
            'Cách 3' => 3    ,
        ]; 
        return view('frontend.ex',compact('numberOfProduct','data'));
    }

    public function shopProducts(){
        $products = Product::query()->get();
        // ->where("MaSP", "=", "SP01")
        // dd($products->AnhSP);
        
        return view('frontend.shop', compact('products'));

    }

    public function productDetails($maSP){
        $product = Product::query()->where("MaSP","=", $maSP)->first();
        return view('frontend.product_details', compact('product'));
    }
}


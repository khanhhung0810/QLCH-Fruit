<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TemplateController::class, 'index'])->name('index');
Route::get('/ex', [TemplateController::class, 'example']);
Route::get('/shop', [TemplateController::class, 'shopProducts'])->name('shop');
Route::get('/shop/product_details/{maSP}', [TemplateController::class, 'productDetails'])->name('productDetails');

// Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::resource('/dashboard', AdminController::class)->parameter('dashboard','product')->names('product');
Route::resource('/category', CategoryController::class)->parameter('category','categories')->names('categories');
Route::resource('/login-page', LoginController::class)->parameter('login','loginPage')->names('loginPage');
// Route::get('/test', [AdminController::class, 'create'])->name('test');

// Route::get('/dashboard/create_product', [AdminController::class, 'create'])->name('createProduct');
// Route::post('/dashboard/create_product', [AdminController::class, 'store'])->name('store');

// Route::get('/dashboard/delete_product', [AdminController::class, 'delete'])->name('deleteProduct');
// Route::post('/dashboard/delete_product', [AdminController::class, 'udelete'])->name('delete');

// Route::get('/dashboard/edit_product', [AdminController::class, 'edit'])->name('editProduct');

//  Route::get('/shop', function () {
//     return view('frontend.shop');
// });
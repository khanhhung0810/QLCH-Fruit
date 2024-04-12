<?php

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Mail\VerifyEmail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Template\Template;

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

Route::get('/cart', [TemplateController::class, 'cart'])->name('cart');
// Route::get('/cart', [TemplateController::class, 'addToCart'])->name('cart.addToCart');
Route::delete('/remove-from-cart', [TemplateController::class, 'remove'])->name('remove_from_cart');

Route::get('/add-to-cart/{maSP}', [TemplateController::class, 'addToCart'])->name('add-to-cart');
Route::get('/shop', [TemplateController::class, 'shopProducts'])->name('shop');
Route::get('/shop/product_details/{maSP}', [TemplateController::class, 'productDetails'])->name('productDetails');

Route::middleware(['auth'])->group(function () {
    Route::resource('/dashboard', AdminController::class)->parameter('dashboard', 'product')->names('product');
    Route::resource('/category', CategoryController::class)->parameter('category', 'categories')->names('categories');
});

Route::get('/login-page', [LoginController::class, 'index'])->name('loginPage');

Route::get('/register', [LoginController::class, 'create'])->name('register');  
Route::post('/register', [LoginController::class, 'store'])->name('register.store');

Route::post('/login-page', [LoginController::class, 'login'])->name('login');
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'correctUser'])->group(function () {
    Route::resource('/profile', ProfileController::class)->parameters(['profile' => 'profilePage'])->names('profilePage');
});

Route::get('/verify',  [EmailController::class, 'verifyEmails'])->name('verify');
Route::get('/verify-email/{id}', [EmailController::class, 'verify'])->name('user.verify')->middleware('signed');
// Route::get('/verify-email/{id}',  [EmailController::class, 'verify'])->name('user.verify');



Route::get('/test', function () {
    $verifyURL= 1;
    $user = User::find(14);
    Mail::to("khanhhung7444@gmail.com")->send(new VerifyEmail($user, $verifyURL));
    return 123;
});
// Route::resource('/login-page', LoginController::class)->parameter('login','loginPage')->names('loginPage');

// Route::get('/dashboard/create_product', [AdminController::class, 'create'])->name('createProduct');
// Route::post('/dashboard/create_product', [AdminController::class, 'store'])->name('store');

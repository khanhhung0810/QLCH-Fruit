<?php

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BlogController;
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
Route::get('/contact', [BlogController::class, 'contact'])->name('contact');

Route::get('/cart', [TemplateController::class, 'cart'])->name('cart');
Route::post('/remove-from-cart', [TemplateController::class, 'remove'])->name('remove_from_cart');
Route::patch('update-cart', [TemplateController::class, 'update'])->name('update_cart');
Route::get('/add-to-cart/{maSP}', [TemplateController::class, 'addToCart'])->name('add-to-cart');

Route::resource('/blog', BlogController::class)->names('blog');

Route::get('/shop', [TemplateController::class, 'shopProducts'])->name('shop');
Route::get('/shop/product_details/{maSP}', [TemplateController::class, 'productDetails'])->name('productDetails');
Route::get('/shop/category/{category}', [TemplateController::class, 'chooseCategory'])->name('shop.category');
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
// ,'verified.email'
Route::get('/verify',  [EmailController::class, 'verifyEmails'])->name('verify');
Route::get('/verify-email/{id}', [EmailController::class, 'verify'])->name('user.verify')->middleware('signed');
// Route::get('/verify-email/{id}',  [EmailController::class, 'verify'])->name('user.verify');

//Cổng thanh toán
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('payment');

// Route::get('/test', function () {
//     $verifyURL= 1;
//     $user = User::find(14);
//     Mail::to("khanhhung7444@gmail.com")->send(new VerifyEmail($user, $verifyURL));
//     return 123;
// });
// Route::resource('/login-page', LoginController::class)->parameter('login','loginPage')->names('loginPage');

// Route::get('/dashboard/create_product', [AdminController::class, 'create'])->name('createProduct');
// Route::post('/dashboard/create_product', [AdminController::class, 'store'])->name('store');

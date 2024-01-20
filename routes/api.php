<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BrandsController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\WishlistItemController;
use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderDetailController;
use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ShopExpenseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//user Authentication Api Controllers
Route::post('/signup', [AuthController::class,'signup']);
Route::post('/login', [AuthController::class,'login']);
//Profile user Api Controllers
Route::get('/profile/{id}', [ProfileController::class, 'index']);

//Product Api Controllers
Route::get('/product', [ProductsController::class, 'index']);
Route::post('/product',[ProductsController::class, 'create']);
Route::put('/product',[ProductsController::class, 'update']);
Route::get('/product/image/{id}', [ProductsController::class, 'imageProductIndex']);
Route::get('/product/{id}',[ProductsController::class, 'show']);
Route::get('/product/article/images', [ProductsController::class, 'ProductArticleImages']);

//brand Controllers
Route::get('/product/brands/index', [BrandsController::class, 'index']);
Route::get('/product/brands/brand-index/{id}',[BrandsController::class,'brand_index']);

// Wishlists Api Controllers
Route::get('/wishlist/show', [WishlistController::class, 'show']);
Route::get('/wishlist/items/index', [WishlistItemController::class, 'index']);
Route::post('/wishlist/items/add', [WishlistItemController::class, 'add']);
Route::get('/wishlist/items/delete/{id}',[WishlistItemController::class, 'delete']);

Route::get('/product/brands/show', [BrandsController::class, 'show']);
Route::post('/admin/brands/create' ,[BrandsController::class, 'create']);
Route::put('/admin/brands/update/{id}' ,[BrandsController::class, 'update']);
Route::delete('/admin/brands/delete/{id}' ,[BrandsController::class, 'delete']);

//Users Api Controllers
Route::get('user/index', [UsersController::class, 'index']);
Route::get('users/{id}', [UsersController::class, 'show'])->name('users.show');
Route::post('users', [UsersController::class, 'store'])->name('users.store');
Route::put('/user/update/{id}', [UsersController::class, 'update']);
Route::delete('/admin/user/delete/{id}', [UsersController::class, 'delete']);
Route::get('/admin/user/delete/{id}', [UsersController::class, 'delete']);

// UsersController
Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::post('/login-user', [UsersController::class, 'login'])->name('users.login');
Route::post('/register', [UsersController::class, 'register'])->name('users.register');
Route::post('/logout-user', [UsersController::class, 'logout'])->name('users.logout');

Route::post('/admin/product/create', [ProductsController::class, 'create']);
Route::get('/admin/product/create', [ProductsController::class, 'create']);

//Admin Authentications Api Controllers
Route::post('/admin/login', [AdminController::class, 'LoginAdmin']);
Route::post('/admin/signup', [AdminController::class, 'SignupAdmin']);

Route::get('/admin/product/category/index', [CategoryController::class, 'index']);
Route::post('/admin/product/category/create', [CategoryController::class, 'create']);

Route::get('/admin/product/category/subCategory', [SubCategoryController::class, 'show']);
Route::get('/admin/product/category/subCategory/{id}', [SubCategoryController::class, 'index']);

// OrderController
Route::get('order', [OrderController::class, 'index']);
Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('show-order-user-id/{id}', [OrderController::class, 'showOrderUserId']);

Route::post('order', [OrderController::class, 'store'])->name('order.store');
Route::put('order', [OrderController::class, 'update'])->name('order.update');
Route::delete('order/{user}', [OrderController::class, 'destroy'])->name('order.destroy');

// OrderDetailController
Route::get('orderdetail', [OrderDetailController::class, 'index']);
Route::get('orderdetail/{id}', [OrderDetailController::class, 'show'])->name('orderdetail.show');
Route::post('orderdetail', [OrderDetailController::class, 'store'])->name('orderdetail.store');
Route::put('orderdetail', [OrderDetailController::class, 'update'])->name('orderdetail.update');
Route::delete('orderdetail/{user}', [OrderDetailController::class, 'destroy'])->name('orderdetail.destroy');

// ShopController
Route::get('shops', [ShopController::class, 'index']);
Route::get('shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::post('shops', [ShopController::class, 'store'])->name('shop.store');
Route::put('shops/{id}', [ShopController::class, 'update'])->name('shop.update');
Route::delete('shops/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');
Route::post('login-shop', [ShopController::class, 'loginShop']);

// CartController
Route::post('cart/add', [CartController::class, 'store']);
Route::get('cart', [CartController::class, 'index']);

Route::post('shop-expense', [ShopExpenseController::class, 'store']);
Route::get('get-shop-expense', [ShopExpenseController::class, 'index']);
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;



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




// đăng nhập đăng kí 
Route::get('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/save-register', [LoginController::class, 'save_register']);
Route::post('/save-login', [LoginController::class, 'save_login']);
Route::get('/log-out', [LoginController::class, 'log_out']);
Route::get('/forgot-password', [LoginController::class, 'forgot_password']);
// frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);

//danh mục sản phẩm trang chủ phần left
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);

//backend
Route::get('/admin', [Admincontroller::class, 'index']); // đường dẫn url /admin
Route::get('/dashboard', [Admincontroller::class, 'show_dashboard']); // đường dẫn url /admin
Route::get('/logout', [Admincontroller::class, 'logout']); // đường dẫn url /admin
Route::post('/admin-dashboard', [Admincontroller::class, 'dashboard']); // đường dẫn url /admin

//category Product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']); // đường dẫn url /admin
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']); // đường dẫn url /admin
Route::get('/edit-category-product/{cate_id}', [CategoryProduct::class, 'edit_category_product']); // đường dẫn url /admin
Route::get('/delete-category-product/{cate_id}', [CategoryProduct::class, 'delete_category_product']); // đường dẫn url /admin

Route::get('/unactive-category-product/{cate_id}', [CategoryProduct::class, 'unactive_category_product']); // đường dẫn url /admin
Route::get('/active-category-product/{cate_id}', [CategoryProduct::class, 'active_category_product']); // đường dẫn url /admin

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']); // đường dẫn url /admin
Route::post('/update-category-product/{cate_id}', [CategoryProduct::class, 'update_category_product']); // đường dẫn url /admin

// Thương hiệu Brand
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']); // đường dẫn url /admin
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']); // đường dẫn url /admin
Route::get('/edit-brand-product/{brand_id}', [BrandProduct::class, 'edit_brand_product']); // đường dẫn url /admin
Route::get('/delete-brand-product/{brand_id}', [BrandProduct::class, 'delete_brand_product']); // đường dẫn url /admin

Route::get('/unactive-brand-product/{brand_id}', [BrandProduct::class, 'unactive_brand_product']); // đường dẫn url /admin
Route::get('/active-brand-product/{brand_id}', [BrandProduct::class, 'active_brand_product']); // đường dẫn url /admin

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']); // đường dẫn url /admin
Route::post('/update-brand-product/{brand_id}', [BrandProduct::class, 'update_brand_product']); // đường dẫn url /admin

//sản phẩm product
Route::get('/add-product', [ProductController::class, 'add_product']); // đường dẫn url /admin
Route::get('/all-product', [ProductController::class, 'all_product']); // đường dẫn url /admin
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']); // đường dẫn url /admin
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']); // đường dẫn url /admin

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']); // đường dẫn url /admin
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']); // đường dẫn url /admin

Route::post('/save-product', [ProductController::class, 'save_product']); // đường dẫn url /admin
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']); // đường dẫn url /admin

//Cart : giỏ hàng

// Route thêm sản phẩm vào giỏ
// Trang hiển thị giỏ hàng
Route::get('/cart', [CartController::class, 'show_cart'])->name('cart.show');

// Route thêm sản phẩm vào giỏ hàng
Route::post('/save-cart', [CartController::class, 'save_cart'])->name('cart.add');


// Trang hiển thị giỏ hàng
// routes/web.php
Route::match(['get','post'], '/cart', [CartController::class, 'cart'])
     ->name('cart.show');
     Route::get('/cart/remove/{id}', [CartController::class, 'remove_item'])
     ->name('cart.remove');


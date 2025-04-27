<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\NewsBlog\BlogController;
use App\Http\Controllers\product\ProductController;
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

Route::get('auth/register' , [AuthController::class , 'register']);
Route::post('auth/submit-register', [AuthController::class , 'createUser']);
Route::get('auth/login', [AuthController::class , 'login'])->name('login');
Route::post('/submit-login', [AuthController::class,'submitLogin']);

Route::get('/dashboard', [AuthController::class, 'dashboard']);


Route::get('/', [HomeController::class , 'index'])->middleware('auth');
Route::get('/auth/logout' , [AuthController::class,'logout'])->middleware('auth');
Route::post('/submit-logout',[AuthController::class , 'submitLogout']);

// logo

Route::get('/add-logo', [HomeController::class, 'addLogo'])->name('logo.add'); 
Route::post('/add-logo', [HomeController::class, 'submitLogo'])->name('logo.submit'); 
Route::get('/list-logo',[Homecontroller::class,"listLogo"])->middleware('auth')->name('list-logo');
Route::get('/update/logo/{id}',[Homecontroller::class,'updateLogo'])->middleware('auth');
Route::post('/submit/update-logo/',[Homecontroller::class,'submitUpdateLogo'])->middleware('auth');
Route::post('/remove/logo/{id}',[Homecontroller::class,'destroy'])->middleware('auth')->name('Logo.remove');

// category

// Route::get('/list-category', [CategoryController::class, 'index'])
//         ->middleware('auth');
Route::get('list-category', [CategoryController::class, 'index'])->middleware('auth')->name('list-category');
Route::get('/create-category', [CategoryController::class, 'create'])
        ->middleware('auth');

Route::post('/submit-category', [CategoryController::class, 'store'])
        ->middleware('auth');
Route::post('/remove-category/{id}', [CategoryController::class ,'destroy'])
        ->middleware('auth')->name('category.remove');
Route::get('edit-cate/{id}', [CategoryController::class, 'edit']);
 Route::put('update-category/{id}', [CategoryController::class, 'update']);
// product

Route::get('/product-lists', [ProductController::class,'index'])
        ->middleware('auth');

Route::get('/add-product', [ProductController::class, 'create'])
        ->middleware('auth');
        
Route::post('/submit-add-product', [ProductController::class, 'submitAddProduct'])
        ->middleware('auth');

Route::post('/remove-product/{id}', [ProductController::class, 'pro'])
        ->middleware('auth')
        ->name('product.remove');

Route::get('edit-prod/{id}', [ProductController::class, 'editpro']);
Route::put('update-product/{id}', [ProductController::class, 'updatepro']);


// NeewsBlog

Route::get('/add/news/',[BlogController::class,'news'])->middleware('auth');
Route::post('/submit/add-news/',[BlogController::class,'submitAddNews'])->middleware('auth');
Route::get('/list/news/',[BlogController::class,'listNews'])->middleware('auth')->name('list-news');
Route::get('/update/news/{id}',[BlogController::class,'updateNews'])->middleware('auth');
Route::post('/submit/updateNews/',[BlogController::class,'submitUpdateNews'])->middleware('auth')->name('news.update');
Route::post('/remove/news/{id}',[BlogController::class,'destroyNews'])->middleware('auth')->name('news.remove');


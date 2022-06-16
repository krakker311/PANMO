<?php

use App\Http\Controllers\BookingOrderController;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Province;

use App\Http\Controllers\PaymentCallbackController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view ('home', [
        "title" => "Home",
        'active' => 'home',
        'categories' => Category::all()
    ]);
});

Route::get('/about', function () {
    return view ('About', [
        "title" => "About",
        "name" => "Verdy",
        'active' => 'about',
        "email" => "verdyvjvl@gmail.com",
        "image" => "diluc.jpg"
    ]);
});

Route::get('/posts',[PostController::class, 'index']);

//halaman single posts

Route::get('profile/{model:id}', [PostController::class, 'show']);
Route::post('favorite/{model}', [PostController::class, 'favorite']);
Route::post('unfavorite/{model}', [PostController::class, 'unfavorite']);



Route::get('/categories', function(){
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/favorites', [PostController::class, 'favorites']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [ProfileController::class, 'index'])->middleware('auth')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard/edit', [DashboardPostController::class , 'editProfile'])
        ->name('dashboard.edit');

    Route::patch('dashboard/edit', [DashboardPostController::class, 'updateProfile'])
        ->name('dashboard.update');

    Route::get('dashboard/regismodel', [ModelController::class , 'index'])
        ->name('dashboard.regis.model');

    Route::post('dashboard/regismodel', [ModelController::class , 'store'])
        ->name('dashboard.create.model');
});



Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/jobs', [JobController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/jobs', JobController::class)->middleware('auth');

Route::get('/dashboard/portfolio', [PortfolioController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/portfolio', PortfolioController::class)->middleware('auth');


Route:: get('/dashboard/orders', [OrderController::class, 'index'])->middleware('auth')->name('viewAllOrders');

Route:: get('/dashboard/ordersUser', [OrderController::class, 'indexUser'])->middleware('auth')->name('viewAllOrdersUser');

Route::post('/booking', [BookingOrderController::class, 'store'])->middleware('auth');

Route::get('/booking/{model:id}',  [BookingOrderController::class, 'index'])->middleware('auth');

Route::post('/get_cities', [BookingOrderController::class, 'getCities'])->middleware('auth');

Route::get('/viewOrder/id={order:id}',[OrderController::class,'detail'])->middleware('auth');

Route::get('/acceptOrder/id={order:id}',[OrderController::class,'acceptOrder'])->middleware('auth');

Route::get('/declineOrder/id={order:id}',[OrderController::class,'declineOrder'])->middleware('auth');

Route::get('/orderDone/id={order:id}',[OrderController::class,'orderDone'])->middleware('auth');

Route::post('/notification/handling', [PaymentCallbackController::class, 'receive']);

Route::get('/dashboard/reviews',[ReviewController::class,'index'])->name('viewAllReviews');

Route::get('/review/id={model:id}',[ReviewController::class,'create']);

Route::post('/review',[ReviewController::class, 'addReview']);
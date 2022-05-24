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

Route::get('profile/{user:id}', [PostController::class, 'show']);
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

Route::get('/dashboard', function(){
    return view('dashboard.profile.index');
})->middleware('auth');

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


Route::get('/booking', [BookingOrderController::class, 'create'])->middleware('auth');

Route::resource('/booking', BookingOrderController::class)->middleware('auth');

Route::post('get_cities', [BookingOrderController::class, 'getCities'])->middleware('auth');

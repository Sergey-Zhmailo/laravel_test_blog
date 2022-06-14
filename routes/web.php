<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Blog\Admin\CategoryController;
use \App\Http\Controllers\Blog\Admin\PostController;
use App\Http\Controllers\DiggingDeeperController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';

//Route::group(
//    ['prefix' => 'blog'],
//    function () {
//        Route::resource('posts',
//            PostController::class)->names('blog.posts');
//    }
//);

// Blog admin
$groupData = [
    'prefix' => 'admin/blog',
];

Route::group($groupData, function () {
    // Blog Category
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');
    // Blog Post
    Route::resource('posts', PostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});

$groupCollectionData = [
    'prefix' => 'digging_deeper',
];
Route::group($groupCollectionData, function () {
    Route::get('collections', DiggingDeeperController::collections()) // 'DiggingDeeperContoller@collections' controller@method
        ->name('digging_deeper.collections');
});
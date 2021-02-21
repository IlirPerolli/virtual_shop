<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('about', function(){
    return view('about');
})->name('about');

Auth::routes();


Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/posts', 'App\Http\Controllers\AdminController@posts')->name('admin.posts');
    Route::get('/admin/users', 'App\Http\Controllers\AdminController@users')->name('admin.users');
    Route::delete('admin/post/{post}/destroy','App\Http\Controllers\AdminController@destroyPosts')->name('admin.post.destroy');
    Route::delete('admin/user/{user}/destroy','App\Http\Controllers\AdminController@destroyUsers')->name('admin.user.destroy');
    Route::get('/city/create','App\Http\Controllers\CitiesController@create')->name('city.create');
    Route::post('/city','App\Http\Controllers\CitiesController@store')->name('city.store');
    Route::delete('/city/{city}/destroy','App\Http\Controllers\CitiesController@destroy')->name('city.destroy');
    Route::get('/category/create','App\Http\Controllers\CategoriesController@create')->name('category.create');
    Route::post('/category','App\Http\Controllers\CategoriesController@store')->name('category.store');
    Route::delete('/category/{category}/destroy','App\Http\Controllers\CategoriesController@destroy')->name('category.destroy');
});
Route::middleware('auth')->group(function(){
    Route::get('/post/create','App\Http\Controllers\PostsController@create')->name('post.create');
    Route::post('post','App\Http\Controllers\PostsController@store')->name('post.store');
    Route::delete('/post/{post}','App\Http\Controllers\PostsController@destroy')->name('post.destroy');
    Route::put('/post/{post}','App\Http\Controllers\PostsController@update')->name('post.update');
    Route::get('/post/{post}/edit','App\Http\Controllers\PostsController@edit')->name('post.edit');

    Route::get('/user/edit','App\Http\Controllers\UserProfileController@edit')->name('user.edit');
    Route::patch('/user/update','App\Http\Controllers\UserProfileController@update')->name('user.update');
    Route::get('/user/changePassword', 'App\Http\Controllers\UserChangePasswordController@index')->name('user.password.edit');
    Route::patch('/user/changePassword/update', 'App\Http\Controllers\UserChangePasswordController@update')->name('user.password.update');
    Route::get('/user/changeUsername', 'App\Http\Controllers\UserChangeUsernameController@index')->name('user.username.edit');
    Route::patch('/user/changeUsername/update', 'App\Http\Controllers\UserChangeUsernameController@update')->name('user.username.update');
    Route::get('/user/changePhoto', 'App\Http\Controllers\UserChangePhotoController@index')->name('user.photo.edit');
    Route::patch('/user/changePhoto/update', 'App\Http\Controllers\UserChangePhotoController@update')->name('user.photo.update');
    Route::patch('/user/changePhoto/destroy', 'App\Http\Controllers\UserChangePhotoController@destroy')->name('user.photo.destroy');

    Route::post('profile/{user}/follow', 'App\Http\Controllers\ProfileController@followUser')->name('user.follow');
    Route::post('profile/{user}/unfollow', 'App\Http\Controllers\ProfileController@unFollowUser')->name('user.unfollow');
    Route::resource('comment', 'App\Http\Controllers\PostCommentsController');
    Route::resource('comment/reply', 'App\Http\Controllers\CommentRepliesController');
    Route::post('/post/{post}/like', 'App\Http\Controllers\LikesController@like')->name('post.like');
    Route::post('/post/{post}/unlike', 'App\Http\Controllers\LikesController@unlike')->name('post.unlike');
    Route::get('/user/deleteAccount', 'App\Http\Controllers\UserDeleteAccountController@index')->name('user.delete.page');
    Route::delete('/user/destroy', 'App\Http\Controllers\UserDeleteAccountController@destroy')->name('user.destroy');
    Route::post('/post/{post}/wishlist/add','App\Http\Controllers\WishListController@store')->name('post.wishlist.add');
    Route::delete('/post/{post}/wishlist/destroy','App\Http\Controllers\WishListController@destroy')->name('post.wishlist.destroy');
    Route::get('/wishlist','App\Http\Controllers\WishListController@index')->name('wishlist.show');

});
//Route::resource('/post', 'PostsController');
//Route::resource('/user', 'UserProfileController');


Route::get('/','App\Http\Controllers\ProfileController@posts')->name('home');
Route::get('/post/{post}','App\Http\Controllers\PostsController@show')->name('post.show');

//Route::get('/user/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');

Route::get('/discover/posts', 'App\Http\Controllers\DiscoverController@posts')->name('discover.posts');
Route::get('/discover/users', 'App\Http\Controllers\DiscoverController@users')->name('discover.users');
Route::get('/discover/companies', 'App\Http\Controllers\DiscoverController@companies')->name('discover.companies');

Route::get('/user/{user}/followings', 'App\Http\Controllers\ProfileController@followings')->name('followings');
Route::get('/user/{user}/followers', 'App\Http\Controllers\ProfileController@followers')->name('followers');
Route::get('/post/{post}/likes', 'App\Http\Controllers\LikesController@show')->name('post.likes');


Route::get('/city/{city}','App\Http\Controllers\CitiesController@show')->name('city.show');
Route::get('/category/{category}','App\Http\Controllers\CategoriesController@show')->name('category.show');
Route::get('/categories','App\Http\Controllers\CategoriesController@index')->name('categories');
Route::get('/cities','App\Http\Controllers\CitiesController@index')->name('cities');

Route::get('/search/users', 'App\Http\Controllers\SearchController@users')->name('search.users');
Route::get('/search/posts', 'App\Http\Controllers\SearchController@posts')->name('search.posts');
//Route::get('/check', 'App\Http\Controllers\PostsController@check');
Route::get('/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');


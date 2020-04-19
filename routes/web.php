<?php

use App\Http\Controllers\Blog\PostsController;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}', [PostsController::class, 'show'])->name('blog.show'); //passing an array & this will be PostsController and this will come from the blog namespace (show / single-post method) (it's another way for providing controller & method that suppose to handle the routes)
Route::get('blog/categories/{category}', [PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}', [PostsController::class, 'tag'])->name('blog.tag');

Auth::routes();// it install a bunch of route that needed for the system

Route::middleware(['auth'])->group(function () //all route in the group will be protected by the auth
{
    Route::get('indexes', 'FrontEndController@index')->name('indexes');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::resource('posts', 'PostsController');

    Route::resource('tags', 'TagsController');

    Route::resource('products' , 'ProductsController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index'); //post resources doesn't have trashed-posts

    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts'); //using put as for security and not get as don't want others to easily restore from the url

});


Route::middleware(['auth', 'admin'])->group(function (){

    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

<?php

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

Route::get('/', 'PostsController@show');

Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::get('/posts/details/{id}', 'PostsController@details')->name('posts.details');
Route::get('/posts/add', 'PostsController@add')->name('posts.add');
Route::post('/posts/insert', 'PostsController@insert')->name('posts.insert');
Route::get('/posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
Route::post('/posts/update/{id}', 'PostsController@update')->name('posts.update');
Route::get('/posts/delete/{id}', 'PostsController@delete')->name('posts.delete');

Route::post('upload', 'UploadController@upload');
Route::get('/photo/delete/{filename}', 'UploadController@deletePhoto')->name('photo.delete');

Route::any('images', function() {

    $images = '';

    foreach (File::allFiles(public_path() . 'uploads') as $file)
    {
        $filename = $file->getRelativePathName();

        $images .= HTML::image('public/uploads/'.$filename, $filename);
    }

    return "<htm><body>$images</body></htm>";

});

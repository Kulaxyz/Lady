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

Route::get('options/{post_id}', 'PostController@getOptions');

Route::get('/search', 'HomeController@search');
Route::redirect('/', '/posts/all/live');


Route::get(
    '/socialite/{provider}',
    [
        'as' => 'socialite.auth',
        function ( $provider ) {
            return \Socialite::driver( $provider )->redirect();
        }
    ]
);

Route::get('/oauth/{provider}', function ($provider) {
    $user = \Socialite::driver($provider)->user();
    dd($user);
});


Route::get('chat/{id}', 'MessageController@chat')->name('chat');
Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');
Route::get('/dialogs', 'MessageController@index')->name('dialogs');



Route::get('my/tags', 'HomeController@index')->name('my-tags')->middleware('auth');
Route::get('my/users', 'HomeController@byUser')->name('my-users')->middleware('auth');

Route::post('my/tags', 'HomeController@index');
Route::post('my/users', 'HomeController@byUser');

Auth::routes();

Route::get('favorites/{filter?}', 'PostController@favorites')->name('favorites')->middleware('auth');
Route::post('favorites', 'PostController@favorites')->name('favorites')->middleware('auth');

Route::group(['prefix' => 'posts'], function() {

    Route::get('add', 'PostController@addPost')->name('add-post')->middleware('auth');
    Route::get('single/{id}', 'PostController@show')->name('show');
    Route::get('all/{filter}/{time?}', 'PostController@all')->name('list');
    Route::post('all/{filter}/{time?}', 'PostController@all')->name('load-more');
    Route::post('create', 'PostController@store')->name('store-post')->middleware('auth');
    Route::post('vote', 'PostController@vote')->name('vote')->middleware('auth');
    Route::post('like', 'PostController@like')->name('like')->middleware('auth');
    Route::post('dislike', 'PostController@dislike')->name('dislike')->middleware('auth');
    Route::post('favorite', 'PostController@favorite')->name('favorite')->middleware('auth');
    Route::post('unfavorite', 'PostController@unfavorite')->name('unfavorite')->middleware('auth');
    Route::delete('destroy/{post_id}', 'PostController@destroy')->name('destroy')->middleware('auth');

});

//Route::get('/', 'PostController@index')->name('home');
Route::get('/user/{id}', 'UserController@posts')->name('profile')->middleware('auth');
Route::post('/user/{id}', 'UserController@posts')->name('profile')->middleware('auth');
Route::get('/user/{id}/follows', 'UserController@follows')->name('profile-follows')->middleware('auth');
Route::post('/user/{id}/follows', 'UserController@follows')->name('profile-follows')->middleware('auth');
Route::get('/user/{id}/follows/users', 'UserController@followsUsers')->name('profile-follows-users')->middleware('auth');
Route::get('/user/{id}/followers', 'UserController@followers')->name('profile-followers')->middleware('auth');
Route::post('/user/{id}/followers', 'UserController@followers')->name('profile-followers')->middleware('auth');
Route::post('/avatar', 'UserController@addAvatar')->middleware('auth');
Route::post('/tags/add', 'TagController@store')->middleware('can:add-tag')->name('tag-add');
Route::get('/tags/{filter?}', 'TagController@index')->name('tags');
Route::get('/tags/single/{id}', 'TagController@show')->name('tag');
Route::post('/tags/single/{id}', 'TagController@show')->name('tag');
Route::post('/tags/{filter?}', 'TagController@index')->name('tags');
Route::post('/tag/follow', 'TagController@follow');
Route::post('/tag/unfollow', 'TagController@unfollow');
Route::post('/users/follow', 'UserController@follow');
Route::post('/users/unfollow', 'UserController@unfollow');
Route::view('/notifications', 'notifications')->name('notifications');
Route::get('/mark-read', function () {
   auth()->user()->notifications()->where('type', '=', \App\Notifications\NewComment::class)->get()->markAsRead();
});

Route::get('/countNotifications', function () {
    return auth()->user()->unreadNotifications()->where('type', '=', \App\Notifications\NewComment::class)->count();
})->middleware('auth');
Route::get('/countPostNotifications', function () {
    return auth()->user()->unreadNotifications()->where('type', '=', \App\Notifications\NewPost::class)->count();
})->middleware('auth');



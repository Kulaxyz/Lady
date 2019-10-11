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
//
//Route::get(
//    '/socialite/{provider}',
//    [
//        'as' => 'socialite.auth',
//        function ( $provider ) {
//            return \Socialite::driver( $provider )->redirect();
//        }
//    ]
//);
//
//Route::get('/oauth/{provider}', function ($provider) {
//    $user = \Socialite::driver($provider)->user();
//    dd($user);
//});
Auth::routes(['verify' => true]);
Route::get('last', function () {
   dd(auth()->user()->last_online_at);
});

//chat routes

Route::get('chat/{id}', 'MessageController@chat')->name('chat');
Route::get('mark-messages/{id}', 'MessageController@markMessages');
Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');
Route::get('/dialogs', 'MessageController@index')->name('dialogs');
Route::post('/dialogs', 'MessageController@index')->name('dialogs');
//end chat


Route::get('ta', 'HomeController@ms');
Route::get('sitemap.xml', 'HomeController@sitemap');

Route::get('options/{post_id}', 'PostController@getOptions');

Route::get('/search', 'HomeController@search');
Route::redirect('/home', '/my/tags');

Route::get('/mark-read', function () {
    auth()->user()->notifications()->where('type', '=', \App\Notifications\NewComment::class)->get()->markAsRead();
});
Route::get('messages-count', function () {
    return (int)auth()->user()->unreadMessages();
});


Route::get('/countNotifications', function () {
    return auth()->user()->unreadNotifications()->where('type', '=', \App\Notifications\NewComment::class)->count();
})->middleware('auth');
Route::get('/countPostNotifications', function () {
    return auth()->user()->unreadNotifications()->where('type', '=', \App\Notifications\NewPost::class)->count();
})->middleware('auth');

Route::post('comment/like', 'CommentController@like')->middleware('auth');
Route::post('comment/dislike', 'CommentController@dislike')->middleware('auth');
Route::post('comment/upvote', 'CommentController@upvote')->middleware('auth');
Route::post('comment/downvote', 'CommentController@downvote')->middleware('auth');


Route::group(['prefix' => 'posts'], function () {

    Route::get('add', 'PostController@addPost')->name('add-post')->middleware('auth');
//    Route::get('all/{filter}/{time?}', 'PostController@all')->name('list');
//    Route::post('all/{filter}/{time?}', 'PostController@all')->name('load-more');

    Route::post('create', 'PostController@store')->name('store-post')->middleware('auth');
    Route::post('vote', 'PostController@vote')->name('vote')->middleware('auth');
    Route::post('like', 'PostController@like')->name('like')->middleware('auth');
    Route::post('dislike', 'PostController@dislike')->name('dislike')->middleware('auth');
    Route::post('upvote', 'PostController@upvote')->name('upvote')->middleware('auth');
    Route::post('downvote', 'PostController@downvote')->name('downvote')->middleware('auth');
    Route::post('favorite', 'PostController@favorite')->name('favorite')->middleware('auth');
    Route::post('unfavorite', 'PostController@unfavorite')->name('unfavorite')->middleware('auth');
    Route::delete('destroy/{post_id}', 'PostController@destroy')->name('destroy')->middleware('auth');
});



//Route::middleware('cache.headers:public;max_age=300;etag')->group(function() {

    Route::get('/', 'PostController@live')->name('live');
    Route::post('/', 'PostController@live')->name('live');

    Route::get('my/tags', 'HomeController@index')->name('my-tags')->middleware('auth');
    Route::get('my/users', 'HomeController@byUser')->name('my-users')->middleware('auth');

    Route::post('my/tags', 'HomeController@index');
    Route::post('my/users', 'HomeController@byUser');

    Route::get('favorites/{filter?}', 'PostController@favorites')->name('favorites')->middleware('auth');
    Route::post('favorites', 'PostController@favorites')->name('favorites')->middleware('auth');


    Route::get('posts/{id}', 'PostController@show')->name('show');

    Route::get('popular/{time?}', 'PostController@popular')->name('popular');
    Route::post('popular/{time?}', 'PostController@popular')->name('popular');
    Route::get('discussed/{time?}', 'PostController@discussed')->name('discussed');
    Route::post('discussed/{time?}', 'PostController@discussed')->name('discussed');
//Route::get('/', 'PostController@index')->name('home');
Route::get('/tag/edit', 'TagController@edit')->name('tag-edit');
Route::post('/tag/add', 'TagController@store')->middleware('can:add-tag')->name('tag-add');
Route::post('/tag/delete/{tag}', 'TagController@destroy')->middleware('can:add-tag')->name('tag-delete');
Route::post('/tag/edit/{tag}', 'TagController@update')->middleware('can:add-tag')->name('edit-tag');
Route::post('/tags/{filter?}', 'TagController@index')->name('tags');
Route::get('/tags/{filter?}', 'TagController@index')->name('tags');
Route::post('/tag/follow', 'TagController@follow');
Route::post('/tag/unfollow', 'TagController@unfollow');
Route::get('/tag/{slug}', 'TagController@show')->name('tag');
Route::post('/tag/{slug}', 'TagController@show')->name('tag');
Route::view('/notifications', 'notifications')->name('notifications');

//});

Route::group(['prefix' => 'user'], function () {

Route::get('{id}', 'UserController@posts')->name('profile')->middleware('auth');
Route::post('{id}', 'UserController@posts')->name('profile')->middleware('auth');
Route::get('{id}/follows', 'UserController@follows')->name('profile-follows')->middleware('auth');
Route::post('{id}/follows', 'UserController@follows')->name('profile-follows')->middleware('auth');
Route::get('{id}/follows/users', 'UserController@followsUsers')->name('profile-follows-users')->middleware('auth');
Route::get('{id}/followers', 'UserController@followers')->name('profile-followers')->middleware('auth');
Route::post('{id}/followers', 'UserController@followers')->name('profile-followers')->middleware('auth');
});

Route::post('/avatar', 'UserController@addAvatar')->middleware('auth');
Route::post('/avatar-delete', 'UserController@deleteAvatar')->middleware('auth');

Route::post('/users/follow', 'UserController@follow');
Route::post('/users/unfollow', 'UserController@unfollow');

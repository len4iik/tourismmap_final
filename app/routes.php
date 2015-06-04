<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found', 404);
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'auth', 'uses' => function()
{
    if(Auth::check()) {
        return Redirect::route('userMainPage');
    }
    return View::make('auth.authpage');
}]);

//filter: routes are accessible only by guest users
Route::get('/signup', function()
{
    if(Auth::check()) {
        return Redirect::route('userMainPage');
    }
    return View::make('register.signup');
});

Route::get('/about', function()
{
    if(Auth::check()) {
        return Redirect::route('userMainPage');
    }
    return View::make('about');
});

Route::get('/contacts', function()
{
    if(Auth::check()) {
        return Redirect::route('userMainPage');
    }
    return View::make('contacts');
});

//Сross Site Request Forgery
Route::group(array('before' => 'csrf'), function()
{
    Route::post('/signup', ['as' => 'createUser', 'uses' => 'UserController@createUser']);
    Route::post('/', ['as' => 'loginUser', 'uses' => 'UserController@loginUser']);
});

Route::group(array('prefix' => '/password'), function () {
    Route::get('/reset', ['as' => 'passwordRemind', 'uses' => 'PasswordController@remind']);
    Route::post('/reset', ['as' => 'remindSend', 'uses' => 'PasswordController@remindSend']);
    Route::get('/link/{token}/{id}', ['as' => 'remindForm', 'uses' => 'PasswordController@remindForm']);
    Route::post('/link/{token}/{id}', ['as' => 'remindForm', 'uses' => 'PasswordController@remindForm']);
//    Route::post('/recreate', ['as' => 'recreate', 'uses' => 'PasswordController@recreate']);
});

Route::group(array('before' => 'auth'), function()
{
    Route::group(array('before' => 'blocked'), function() {
        Route::get('/main', ['as' => 'userMainPage', 'uses' => 'UserController@mainPage']);
        Route::get('/profile', ['as' => 'profile', 'uses' => 'ProfileController@getProfile']);
        Route::get('/editProfile', ['as' => 'editProfile', 'uses' => 'ProfileController@editProfile']);
        Route::get('/changePassword', ['as' => 'changePassword', 'uses' => 'ProfileController@changePassword']);
        Route::post('/changePassword', ['as' => 'changePassword', 'uses' => 'ProfileController@changePassword']);
        Route::post('/updateProfile', ['as' => 'updateProfile', 'uses' => 'ProfileController@updateProfile']);


        Route::group(array('prefix' => '/countries'), function () {
            Route::group(array('before' => 'admin'), function () {
                Route::get('/create',['as' => 'createCountry', 'uses' => 'CountryController@create']);
                Route::get('/delete/{id}', ['as' => 'deleteCountry', 'uses' => 'CountryController@delete']);
                Route::get('/edit/{country}', ['as' => 'editCountry', 'uses' => 'CountryController@edit']);
                Route::get('/codes', function()
                {
                    return View::make('inner.countries.codes');
                });

                Route::group(array('before' => 'csrf'), function () {
                    Route::post('/create', ['as' => 'countryCreate', 'uses' => 'CountryController@create']);
                    Route::post('/edit/{country}', ['as' => 'editCountry', 'uses' => 'CountryController@edit']);
                });
            });

            Route::get('/', ['as' => 'countries', 'uses' => 'CountryController@mainPage']);
            Route::get('/{country}', ['as' => 'countryPage', 'uses' => 'CountryController@countryPage']);
        });

        Route::group(array('prefix' => '/news'), function(){
            Route::group(array('before' => 'admin'), function () {
                Route::get('/create',['as' => 'createNews', 'uses' => 'NewsController@create']);
                Route::get('/delete/{id}', ['as' => 'deleteNews', 'uses' => 'NewsController@delete']);
                Route::get('/news/delete/comment/{id}', ['as' => 'newsCommentDelete', 'uses' => 'NewsController@deleteComment']);

                Route::group(array('before' => 'csrf'), function () {
                    Route::post('/create', ['as' => 'newsCreate', 'uses' => 'NewsController@create']);
                });
            });

            Route::group(array('before' => 'csrf'), function () {
                Route::post('/{id}/comment/create', ['as' => 'newsCreateComment', 'uses' => 'NewsController@createComment']);
            });

            Route::get('/{id}', ['as' => 'newsPost', 'uses' => 'NewsController@news']);
            Route::get('/', ['as' => 'news', 'uses' => 'NewsController@mainPage']);
        });

        Route::group(array('prefix' => '/forum'), function () {
            Route::get('/', ['as' => 'forum', 'uses' => 'ForumController@mainPage']);
            Route::get('/category/{id}', ['as' => 'forumCategory', 'uses' => 'ForumController@category']);
            Route::get('/post/{id}', ['as' => 'forumPost', 'uses' => 'ForumController@post']);
            Route::get('/post/{id}/create', ['as' => 'forumGetNewPost', 'uses' => 'ForumController@newPost']);
            Route::get('/post/{id}/edit', ['as' => 'forumGetEditPost', 'uses' => 'ForumController@editPostGet']);

            Route::group(array('before' => 'csrf'), function () {
                Route::post('/post/{id}/create', ['as' => 'forumCreatePost', 'uses' => 'ForumController@createPost']);
                Route::patch('/post/{id}/edit', ['as' => 'forumEditPost', 'uses' => 'ForumController@editPost']);
                Route::post('/comment/{id}/create', ['as' => 'forumCreateComment', 'uses' => 'ForumController@createComment']);
            });

            Route::group(array('before' => 'admin'), function () {
                Route::get('/group/{id}/hide', ['as' => 'forumGroupHide', 'uses' => 'ForumController@hideGroup']);
                Route::get('/group/{id}/delete', ['as' => 'forumDeleteGroup', 'uses' => 'ForumController@deleteGroup']);
                Route::get('/category/{id}/delete', ['as' => 'forumDeleteCategory', 'uses' => 'ForumController@deleteCategory']);
                Route::get('/post/{id}/delete', ['as' => 'forumDeletePost', 'uses' => 'ForumController@deletePost']);
                Route::get('/comment/{id}/delete', ['as' => 'forumDeleteComment', 'uses' => 'ForumController@deleteComment']);

                Route::group(array('before' => 'csrf'), function () {
                    Route::post('/group', ['as' => 'forumCreateGroup', 'uses' => 'ForumController@createGroup']);
                    Route::post('/category/{id}/new', ['as' => 'forumCreateCategory', 'uses' => 'ForumController@createCategory']);
                    Route::post('/category/{id}/edit', ['as' => 'forumEditCategory', 'uses' => 'ForumController@editCategory']);
                });
            });
        });

        Route::group(array('before' => 'admin'), function () {
            Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@main']);
            Route::get('/user/{id}/admin', ['as' => 'setAdmin', 'uses' => 'AdminController@setAdmin']);
            Route::get('/user/{id}/block', ['as' => 'blockUser', 'uses' => 'AdminController@blockUser']);
        });
    });
});

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/');
});


////////ERROR HANDLER
App::error(function(ModelNotFoundException $e)
{
//    return Response::make('Not Found', 404);
    return Redirect::to('/');
});

App::missing(function($e)
{
//    return Response::make('Not Found', 404);
    return Redirect::to('/');
});
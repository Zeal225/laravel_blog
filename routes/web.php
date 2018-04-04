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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'ArticleController@redirectToHome');

Route::get('/home','ArticleController@redirectToHome');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/articles', 'ArticleController');
Route::get('/articles/tag/{tag}', 'ArticleController@indexTag')->name('tag');
//Route::get('/tiorna/{tag}', 'ArticleController@indexTag');
Route::get('/articles/user/{id}', 'ArticleController@indexUser')->name('user');
Route::get('/user/{username}', 'ArticleController@showUser')->name('profile')->middleware('auth');
Route::resource('commentaire', 'CommentaireController');
Route::resource('reponse', 'ReponseController');
Route::resource('auteur', 'UserController');
Route::post('/photo', 'UserController@updatePhoto')->name('auteur.photo');
Route::post('/like', 'ArticleController@LikeController')->name('like');

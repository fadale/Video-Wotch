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



Route::namespace('BackEnd')->prefix('admin')->middleware('admin')->group(function(){
    Route::get('/','Home@index')->name('admin.home');
    Route::get('/home','Home@frontHome')->name('front.home');
    Route::resource('users', 'Users')->except(['show']);
    Route::resource('categories', 'Categories')->except(['show']);
    Route::resource('skills', 'Skills')->except(['show']);
    Route::resource('tags', 'Tags')->except(['show']);
    Route::resource('pages', 'Pages')->except(['show']);
    Route::resource('videos', 'Videos')->except(['show']);
    Route::resource('messages', 'Messages')->only(['index','destroy','edit']);
    Route::post('comments', 'Videos@commentStore')->name('comment.store');
    Route::get('comments/{id}', 'Videos@commentDelete')->name('comment.delete');
    Route::post('comments/{id}', 'Videos@commentUpdate')->name('comment.update');


});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::get('category/{id}', 'HomeController@category')->name('front.category');
Route::get('skill/{id}', 'HomeController@skill')->name('front.skill');
Route::get('tag/{id}', 'HomeController@tags')->name('front.tags');
Route::get('video/{id}', 'HomeController@video')->name('frontend.video');
Route::get('contact-us', 'HomeController@messageStore')->name('contact.store');
Route::get('/','HomeController@welcome')->name('frontend.landing');
Route::get('page/{id}/{slug?}','HomeController@page')->name('front.page');
Route::get('profile/{id}/{slug?}','HomeController@profile')->name('front.profile');
Route::middleware('auth')->group(function() {
    Route::prefix('admin')->get('/','BackEnd\Home@index')->name('admin.home');
    Route::post('comments/{id}', 'HomeController@commentUpdate')->name('front.commentUpdate');
    Route::post('comments/{id}/create', 'HomeController@commentStore')->name('front.commentStore');
    Route::post('profile/{id}','HomeController@profileUpdate')->name('profile.update');
    Route::get('/upload/{id}','HomeController@createUpload')->name('front.uploadVideo');
    Route::post('/upload','HomeController@uploadStore')->name('frontVideo.store');
    Route::get('/upload/{id}/edit','HomeController@videoUploadEdit')->name('video-upload.edit');
    Route::post('/upload/{id}/update','HomeController@videoUploadUpdate')->name('frontVideo.Update');
    Route::post('/upload/{id}/delete','HomeController@videoUploadDelete')->name('video-upload.destroy');
});

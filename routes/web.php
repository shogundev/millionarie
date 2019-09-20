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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::group(array('middleware' => 'admin'), function() {
    Route::get('admin/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');
    Route::resource('questions', 'Admin\QuestionController');
    Route::get('questions/delete/{id}', 'Admin\QuestionController@delete')->name('questions.delete');
});

Route::get('play', 'QuizController@play')->name('quiz.start');
Route::get('leaderboard', 'QuizController@leaderboard')->name('quiz.leaderboard');
Route::get('check/{question}/{choice}', 'QuizController@check');
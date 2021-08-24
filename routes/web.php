<?php

use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('questions', QuestionsController::class)->except('show');
Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');
//Route::post('questions/{questions}/answers','AnswersController@store')->name('answers.store');
Route::resource('questions.answers', AnswersController::class)->except(['index','create','show']);
Route::post('/answers/{answer}/accept',AcceptAnswerControler::class)->name('answers.accept');
Route::post('questions/{question}/favorites',[FavoritesController::class,'store'])->name('questions.favorites');
Route::delete('questions/{question}/favorites',[FavoritesController::class,'destroy'])->name('questions.unfavorites');
Route::post('/questions/{question}/vote',VoteQuestionController::class);
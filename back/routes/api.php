<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/authors', 'App\Http\Controllers\API\Authors\AuthorsController@index');
Route::post('/authors/create', 'App\Http\Controllers\API\Authors\AuthorsController@create');
Route::post('/authors/edit/{id}', 'App\Http\Controllers\API\Authors\AuthorsController@update');
Route::delete('/authors/delete/{id}', 'App\Http\Controllers\API\Authors\AuthorsController@delete');

Route::get('/books', 'App\Http\Controllers\API\Books\BooksController@index');
Route::post('/books/create', 'App\Http\Controllers\API\Books\BooksController@create');
Route::post('/books/edit/{id}', 'App\Http\Controllers\API\Books\BooksController@update');
Route::delete('/books/delete/{id}', 'App\Http\Controllers\API\Books\BooksController@delete');

Route::get('/genres', 'App\Http\Controllers\API\Genres\GenresController@index');
Route::get('/genres/create', 'App\Http\Controllers\API\Genres\GenresController@create');

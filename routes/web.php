<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function() { //especifico o caminho 
    return view('index');   //retorna para o cliente o arquivo especificado pelo parametro de 'view()'
});

Route::get('/teste', function () { //especifico o caminho 
    return view('teste');   //retorna para o cliente o arquivo especificado pelo parametro de 'view()'
});

Route::get('/todolist', TodolistController::class.'@index');
Route::post('/todolist', TodolistController::class.'@store');
Route::put('/todolist/{id}', TodolistController::class.'@update');
Route::delete('/todolist/{id}', TodolistController::class.'@destroy');

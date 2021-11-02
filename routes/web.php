<?php

use App\Http\Controllers\PostsController;

Route::get('/posts', [PostsController::class, 'index']);


Route::get('/posts/{id}', [PostsController::class, 'show']);
/*
Route::get('/', function () {
    return view('welcome');
});

//hacer una ruta con variable $nombre 
Route::get('/hola/{nombre}', [HolaController::class, 'hola']); 

//demostracion de variabres con if
Route::get('/', function()
{


    return view('Welcome', ['nombre' => 'ABI']);
});
/*
Route::get('/hola/{nombre}', 'HolaController@hola'); 
*/

/*Route::get('/hola/{nombre}', function ($nombre) {
    return "hola! {$nombre}";
});*/

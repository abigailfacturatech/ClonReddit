<?php

use App\Http\Controllers\PostsController;
     
    /*
    
    se agrupan estas rutas para que se puedan realizar middleware
    
    
   */

    Auth::routes();

    Route::group(['middleware'=> 'auth'], function(){
            
            


        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::name('create_post_path')->get('/posts/{create}', [PostsController::class, 'create']);

        Route::name('store_post_path')->post('/posts', [PostsController::class, 'store']);

        Route::name('edit_post_path')->get('/posts/{post}/edit', [PostsController::class,'edit']);

        Route::name('update_post_path')->put('/posts/update/{post}', [PostsController::class,'update']);

        Route::name('delete_post_path')->delete('/posts/delete/{post}', [PostsController::class,'delete']);

        });

    Route::get('/', [PostsController::class, 'index']);

    Route::name('posts_path')->get('/posts', [PostsController::class, 'index']);
    
    Route::name('post_path')->get('/posts/{post}', [PostsController::class, 'show']);
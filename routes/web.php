<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsCommentsController;

Auth::routes();

    Route::group(['middleware'=> 'auth'], function(){
            
            
        Route::get('/home', [HomeController::class, 'index'])->name('home');
                
       
        Route::name('store_post_path')->post('/posts', [PostsController::class, 'store']);

        Route::name('edit_post_path')->get('/post/edit/{post}', [PostsController::class,'edit']);

        Route::name('update_post_path')->put('/posts/update/{post}', [PostsController::class,'update']);

        Route::name('delete_post_path')->delete('/posts/delete/{post}', [PostsController::class,'delete']);

        Route::name('create_comment_path')->post('/posts/{post}/comments',[PostsCommentsController::class,'create']);
    });

   

    Route::get('/', [PostsController::class, 'index']);

    Route::name('posts_index_path')->get('/post', [PostsController::class, 'index']);
    
    Route::name('post_show_path')->get('/posts/{id}', [PostsController::class, 'show']);

    Route::name('create_post_path')->get('/posts', [PostsController::class, 'create'])->middleware('auth');
         
    

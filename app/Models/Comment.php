<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    
    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['text'];

    


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    

    // public function wasCreatedBy($user)
    // {
    //     if(is_null($user) ) {
    //         return false;

    //     }

    //     return $this->user_id === $user->id;
    // }
}
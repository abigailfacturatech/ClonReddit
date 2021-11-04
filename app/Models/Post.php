<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $table = 'posts';
    
    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['title','description' ,'url'];

    


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wasCreatedBy($user)
    {
        if(is_null($user) ) {
            return false;

        }

        return $this->user_id === $user->id;
    }


    
}

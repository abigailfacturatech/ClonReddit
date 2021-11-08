<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    use HasFactory;

    protected $table = 'post_votes';

    // protected $primaryKey = 'post_id, user_id';

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = ['post_id','user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

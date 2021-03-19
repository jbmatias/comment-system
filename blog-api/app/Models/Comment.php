<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'username_id',
        'comment'
    ];

    public function username() {
        return $this->belongsTo('App\Models\Username');
    }

    public function responses() {
        return $this->hasMany('App\Models\CommentResponse');
    }
}

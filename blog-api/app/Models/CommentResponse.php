<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentResponse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comment_id',
        'username_id',
        'response'
    ];

    public function username() {
        return $this->belongsTo('App\Models\Username');
    }
}

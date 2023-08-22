<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    // post -user relationship
    // to collect owner of the post
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    //post - categoryPost relationship
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    // post - comment relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // post - loke relationship
    public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }

    // check if user like the post
    public function isLiked()
    {
        return $this->likes()->where('user_id',Auth::user()->id)->exists();
        // this will return true if the user already liked the post

    }
}


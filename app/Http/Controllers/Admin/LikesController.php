<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    private $like;
    private $post;

    public function __construct(Like $like, Post $post)
    {
       $this->like = $like;
       $this->post = $post;
    }

    public function index()
    {
        $all_likes = $this->like->latest()->paginate(10);

        $all_posts = $this->post->withTrashed()->latest()->paginate(10);

        return view('admin.likes.index')->with('all_posts',$all_posts)->with('all_likes',$all_likes);


    }

    
}

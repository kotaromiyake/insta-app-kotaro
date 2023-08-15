<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        // validate request
        $request->validate([
            'comment_body'.$post_id => 'required|max:150'
        ],
        [
            'comment_body'.$post_id.'.required' =>'You cannot submit empty comment',
            'comment_body'.$post_id.'.max' =>'The comment must not have more than 150 characterd'

        ]
        );
        // custom validation message

        // store the comment
        $this->comment->body = $request->input('comment_body'.$post_id);
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $post_id;
        $this->comment->save();

        return redirect()->back();

    }

    public function destroy($id)
    {

        // 1.Delete the comment in db
        $this->comment->destroy($id);

        // 2.redirect back
        return redirect()->back();
    }



}

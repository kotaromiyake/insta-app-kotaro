<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like)
    {
       $this->like = $like;
    }

    public function store(Request $request, $post_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $post_id;
        $this->like->save();

        return redirect()->back();
    }

    public function destroy($id)
    {

        $this->like->where('user_id',Auth::user()->id)->where('post_id',$id)->delete();


        // where id = $id

        // ->where('id',$id)

        // where id != $id

        // ->where('id','!=',$id)

        // 2.redirect back
        return redirect()->back();
    }
}

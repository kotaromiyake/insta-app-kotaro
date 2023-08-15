<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // create route
    // construct method
    // store method
    // follower_id - logged in user
    // following_id - the user that you followes
    // redirect back

    private $follow;
    private $user;

    public function __construct(Follow $follow, User $user)
    {
        $this->follow = $follow;
        $this->user = $user;
    }

    public function store(Request $request, $user_id)
    {
        $this->follow->follower_id = Auth::user()->id;
        $this->follow->following_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($id)
    {

        $this->follow->where('follower_id',Auth::user()->id)->where('following_id',$id)->delete();

          // where id = $id

        // ->where('id',$id)

        // where id != $id

        // ->where('id','!=',$id)



        return redirect()->back();
    }
}

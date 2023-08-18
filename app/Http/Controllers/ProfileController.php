<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user',$user);
    }

    public function suggest($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.suggest')->with('user',$user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user',$user);
    }

    public function update(Request $request,)
    {
        //varidation
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'password' => 'required|min:8|max:50',
            'introduction' => 'required|min:1|max:1000',
            'avatar' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        //update the name,email,introduction
        $user = $this->user->findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email  =  $request->email;
        $user->password  =  Hash::make($request->password);
        $user->introduction  =  $request->introduction;

        //avatar check forst if user is updating avatar
        if($request->avatar)
        {
         //if yes, update the avatar
        $user->avatar = 'data:image/' . $request->avatar->extension().
                                ';base64,' . base64_encode(file_get_contents($request->avatar));
        // base64_encode - this will make the avatar into long text
        // base64 - create a series of text from the avatar.
        }
         //save - go back to show profile
        $user->save();

        return redirect()->route('profile.show',$user->id);
    }

    public function followers($id)
    {
        // get the post using $id
        $user = $this->user->findOrFail($id);

        return view('users.profile.follower')->with('user',$user);
    }

    public function followings($id)
    {
        // get the post using $id
        $user = $this->user->findOrFail($id);

        return view('users.profile.following')->with('user',$user);
    }
}

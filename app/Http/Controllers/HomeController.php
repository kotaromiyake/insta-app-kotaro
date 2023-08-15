<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        // $this->middleware('auth');
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts_db = $this->post->latest()->get();
        $all_posts = [];

        // filter posts of logged in user folows
        foreach($all_posts_db as $post)
        {
            // check if we follow the user of the post and our own post
            if($post->user->isfollowed() || $post->user->id === Auth::user()->id)
            {
                // if true add the post in the array that we7re going to show in the home page
                $all_posts[]= $post;
            }
        }

        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
        ->with('suggested_users',$suggested_users)
        ->with('all_posts',$all_posts);
    }

    // get the users that the logged in user not following
    public function getSuggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user)
        {
            // check if user is not followed
            if(!$user->isFollowed())
            {
               $suggested_users[] = $user;
            }
            // condition             output
            //  -  if following
            // $user->isFollowed()   true
            // !user->isFollowed()   false

             // condition             output
            //  -  if not following
            // $user->isFollowed()   false
            // !user->isFollowed()   true
        }

        return array_slice($suggested_users,0,3);
        // array_slice(x,y,z)
        // x - array
        // y - starting index
        // z - length/how many index
    }

    public function search(Request $request)
    {
        $users = $this->user->where('name','like','%' .$request->search. '%')->get();

        return view('users.search')->with('users',$users)->with('search',$request->search);
    }
}

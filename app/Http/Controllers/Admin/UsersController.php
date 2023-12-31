<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
       $this->user = $user;
    }

    public function index()
    {
        $all_users = $this->user->withTrashed()->latest()->paginate(10);

        return view('admin.users.index')->with('all_users',$all_users);
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);

        return redirect()->back();

    }

    public function activate($id)
    {

        $this->user->withTrashed()->findOrFail($id)->restore();

        return redirect()->back();

    }

    public function search(Request $request)
    {
        $all_users = $this->user->where('name','like','%' .$request->search. '%')->paginate(10);



        return view('admin.users.search')->with('all_users',$all_users)->with('search',$request->search);
    }

    
}

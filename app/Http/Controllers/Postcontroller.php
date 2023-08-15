<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class Postcontroller extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    // create method for create post page
    public function create()
    {
        $all_categories = $this->category->all();

        return view('users.posts.create')
        ->with('all_categories',$all_categories);
    }

    public function store(Request $request)
    {
    // validate the request
    $request->validate([
        'category' => 'required|array|between:1,3',
        'description' => 'required|min:1|max:1000',
        'image' => 'required|mimes:png,jpg,jpeg,gif',
    ]);

    // save to data
    $this->post->user_id = Auth::user()->id;
    $this->post->description = $request->description;
    // saving image using base64
    $this->post->image = 'data:image/' . $request->image->extension().
                            ';base64,' . base64_encode(file_get_contents($request->image));
    // base64_encode - this will make the image into long text
    // base64 - create a series of text from the image.

    $this->post->save();

    // save all categories to categoryPost

    foreach($request->category as $category_id)
    {
        $category_post[] = ['category_id'=>$category_id];
    }
    $this->post->categoryPost()->createMany($category_post);

    // return to homepage
    return redirect()->route('index');

    }

    public function show($id)
    {
        // get the post using $id
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post',$post);
    }

    public function edit($id)
    {
        $all_categories = $this->category->all();
        // get the post using $id
        $post = $this->post->findOrFail($id);

        // get the selected categories of the post to be edited

        $selected_categories = [];
        foreach($post->categoryPost as $category_post)
        {
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
        ->with('post',$post)->with('selected_categories',$selected_categories)->with('all_categories',$all_categories);
    }

    public function update(Request $request,$id)
    {
      // validate the request
    $request->validate([
        'category' => 'required|array|between:1,3',
        'description' => 'required|min:1|max:1000',
        'image' => 'mimes:png,jpg,jpeg,gif',
    ]);

    // save to data
    $post = $this->post->findOrFail($id);
    $post->description = $request->description;
    // saving image using base64
    // if user is updating image
    if($request->image)
    {
    $post->image = 'data:image/' . $request->image->extension().
                            ';base64,' . base64_encode(file_get_contents($request->image));
    // base64_encode - this will make the image into long text
    // base64 - create a series of text from the image.
    }
    $post->save();

    // delete all categoryPost that belongs to the post
    $post->categoryPost()->delete();

    // save new categoryPost
    foreach($request->category as $category_id)
    {
        $category_post[] = ['category_id'=>$category_id];
    }
    $post->categoryPost()->createMany($category_post);

    // return to homepage
    return redirect()->route('post.show',$id);
    }



    public function destroy($id)
    {
        $this->post->destroy($id);

        return redirect()->route('index');

    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();
        $post= $request->all();
       if ($image = $request->file('image')) {
        $post['image'] = $image->store('post','public');
       }
       $post['user_id'] = Auth::id();
       Post::create($post);
       return to_route('index')->with('success','Post created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validated();
        $inputs= $request->all();
       if ($image = $request->file('image')) {
        $inputs['image'] = $image->store('post','public');
       }else{
        unset($inputs['image']);
       }
       $inputs['user_id'] = Auth::id();
       $post->fill($inputs)->save();
       return to_route('index')->with('success','Post updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //  $post= Post::find($post->id);
        //  $image_path = public_path('/storage/post/' . $post->image);
        //  if (file_exists($image_path)) {
        //      unlink($image_path);
        //  }
       
        $post->delete();
        return to_route('index')->with('success','Post deleted successfuly');
    }
}

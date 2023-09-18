<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('post.show', compact('comments'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
       if(Auth::check()){
        $request->validated();
     
        $post_id= Post::where('id',$request->post_id)->first();
        if ($post_id) {
           Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'comment_body' => $request->comment_body,
           ]) ;
           return back()->with('success','Comment created successfully');
        }
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update',$comment);
        return view('comment.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if(Auth::check()){
            $request->validated();
         
            $post_id= Post::where('id',$comment->post->id)->first();
            if ($post_id) {
               Comment::where('id',$comment->id)->update([
                'post_id' => $comment->post->id,
                'user_id' => Auth::id(),
                'comment_body' => $request->comment_body,
               ]) ;
               return to_route('index')->with('success','Comment updated successfully');
            }
           
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success','Comment deleted successfully');
    }
}

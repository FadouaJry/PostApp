@extends('layout.layout')
@include('partials.navBar')
@section('title')
    Edit Post
@endsection
@section('content')
@include('partials.flashbag')
    
    
        
        <div class="container">
            <form action={{ route('comments.update',$comment->id) }} method="post"> 
            @csrf
           @method('PUT')
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <label>Comment</label>
            <textarea  placeholder="Comment" name="comment_body" cols="100" rows="3">{{ $comment->comment_body }}</textarea>
           
           <button class="btn btn-warning">Comment</button>
            </form>
           
        </div>
    @endsection
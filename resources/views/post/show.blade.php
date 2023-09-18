@extends('layout.layout')
@include('partials.navBar')
@section('title')
    Show Post
@endsection
@section('content')
@include('partials.flashbag')
    <div class="container">
        <div class="card" style="width:400px">
           
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <p class="card-text">{{ $post->body }}</p>
                <img class="card-img-top" src={{ asset('storage/' . $post->image) }}>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <h3>Comments</h3>
    <div class="container">
        @foreach ($post->comments as $comment)
        <div class="card" style="width:1000px">
           
            <div class="card-body">
                <h4 class="card-title">{{ $comment->user->name }}</h4>
                <p class="card-text">{{$comment->created_at }}</p>
                <textarea  placeholder="Comment" name="comment_body" cols="100" rows="3">{{ $comment->comment_body }}</textarea>
              @can('update', $comment)
              <a class="btn btn-warning"  href="{{ route('comments.edit',$comment->id) }}">Edit comment</a>
              @endcan
                @can('delete', $comment)        
                <form action="{{ route('comments.destroy',$comment->id) }}"  method="post">
                    @csrf
                    @method('delete')
                <button class="btn btn-danger"  type="submit">Delete comment</button>
                </form>
            </div>
                    
                @endcan
            
        </div>
        <br>
        @endforeach
    </div>
      
        
        <div class="container">
            <form action={{ route('comments.store',$post->id) }} method="post"> 
            @csrf
           
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <label>Comment</label>
            <textarea  placeholder="Comment" name="comment_body" cols="100" rows="3"></textarea>
           
           <button class="btn btn-primary">Comment</button>
            </form>
           
        </div>
    @endsection

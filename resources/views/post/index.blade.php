@extends('layout.layout')
@include('partials.navBar')
@section('title')
    Post 
@endsection
@section('content')

@include('partials.flashbag')
   
    <div class="container"> 
      @foreach ($posts as $post)
        <div class="card" style="width:400px">
            <img class="card-img-top" src={{ asset('storage/'.$post->image) }}>
            <div class="card-body">
              <h4 class="card-title">{{ $post->title }}</h4>
              <p class="card-text">{{ $post->body }}</p>
              @php
              $like_posts = \App\Models\Like::where('post_id', $post->id )->where('user_id',auth()->user()->id)->exists();
             $count_like = \App\Models\Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->count();
             $like = \App\Models\Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
          @endphp
          @if ($like_posts == true)
          <h6 class="mb-2 text-white"> 
            <span class="bg-success px-2 py-1 rounded">
              {{  $count_like  }} 
            </span>
          </h6>
           <form action={{ route('likes.destroy',$like) }} method="post">
            @csrf
            @method("DELETE")

            <button class="btn btn-danger" type="submit">Dislike </button>
          </form> 
          @else
          <form action="{{ route('likes.store') }}" method="post">
            @csrf
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <button class="btn btn-success" type="submit" >Like <b> {{  $count_like  }} </b></button>
          </form> 
          @endif

              @can('update', $post)
              <a href={{ route('posts.edit', $post->id) }} class="btn btn-warning">Edit</a>
              @endcan
              <a href={{ route('posts.show', $post->id) }} class="btn btn-info">Show</a>
            
             @can('delete', $post)
             <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Delete</button>
               </form>
             @endcan
            </div>
          
          </div>
    </div>
    @endforeach
@endsection
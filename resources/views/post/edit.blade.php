@extends('layout.layout')
@include('partials.navbar')
@section('title')
     Create a Post
@endsection
@section('content')
<div class="container">
    <form action="{{ route('posts.update',$post->id) }}"   method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label  class="form-label">title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}"   >
          </div>
          @error('title')
              {{ $message }}
          @enderror
          <div class="mb-3">
            <label   class="form-label">Body</label>
            <input type="text" class="form-control"  value="{{ $post->body }}"  name="body" >
          </div>  @error('body')
          {{ $message }}
      @enderror
          <div class="mb-3">
            <label   class="form-label">Image</label>
            <input type="file" class="form-control" name="image" >
          </div>
          @error('image')
          {{ $message }}
      @enderror
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Create</button>
          </div>

    </form>
</div>
@endsection
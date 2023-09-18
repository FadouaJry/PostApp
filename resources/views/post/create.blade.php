@extends('layout.layout')
@include('partials.navbar')
@section('title')
     Create a Post
@endsection
@section('content')
<div class="container">
    <form action="{{ route('posts.store') }}"   method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label  class="form-label">title</label>
            <input type="text" class="form-control" name="title"    placeholder="Title">
          </div>
          @error('title')
              {{ $message }}
          @enderror
          <div class="mb-3">
            <label   class="form-label">Body</label>
            <input type="text" class="form-control" name="body" placeholder="Body">
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
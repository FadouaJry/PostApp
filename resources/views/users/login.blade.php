@extends('layout.layout')
@section('title')
   Login 
@endsection
@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Login</button>
          </div>
          <br>
          <br>
        <p>I don't have an account to login <a href="{{ route('register.create') }}">Register</a></p>  
    </form>
@endsection

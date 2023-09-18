@extends('layout.layout')
@section('title')
    Register
@endsection
@section('content')
<div class="container">
    <form action="{{ route('register') }} " method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name"  placeholder="Name">
          </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control"name="password"   placeholder="Password">
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Register</button>
          </div>
          <br>
          <br>
        <p>I have an account <a href="{{ route('login') }}">Login</a></p> 
    </form>
   
</div>
@endsection
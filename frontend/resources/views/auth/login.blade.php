@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Display Errors -->
        @include('includes.messages')
    </div>
</div>
<div class="row">
    <div class="col-lg-4 offset-lg-4">
              <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
               
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
    </div>  
</div>  
 @endsection
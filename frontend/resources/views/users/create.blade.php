@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    
                    <label for="inputFirstName" class="sr-only">First Name</label>
                    <input type="text" id="inputFirstName" class="form-control mb-2" placeholder="First Name" name="firstname" required autofocus>

                    <label for="inputLastName" class="sr-only">Last Name</label>
                    <input type="text" id="inputLastName" class="form-control mb-2" placeholder="Last Name" name="lastname" required autofocus>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" name="email" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" name="password" required>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection

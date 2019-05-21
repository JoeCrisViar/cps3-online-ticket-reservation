@extends('layouts.layout')

@section('content')
<div class="row">
      <div class="col-lg-4 offset-lg-4">
            	<form action="{{ route('users.update', $user->_id) }}" method="POST" class="form-signin">
            		@csrf
                        @method('PUT')
            		<h1 class="h3 mb-3 font-weight-normal">Edit User</h1>

                        <label for="inputFirstName" class="sr-only">First Name</label>
                        <input type="text" id="inputFirstName" class="form-control mb-2" placeholder="First Name" name="firstname" value="{{ $user->firstname }}" required autofocus>

                        <label for="inputLastName" class="sr-only">Last Name</label>
                        <input type="text" id="inputLastName" class="form-control mb-2" placeholder="Last Name" name="lastname" value="{{ $user->lastname }}" required autofocus>

            		<label for="inputEmail" class="sr-only">Email address</label>
            		<input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" value="{{ $user->email }}" name="email" required autofocus>

            		<a href="{{ route('change_password', $user->_id) }}" class="btn btn-primary mb-4">Change Password</a>
            		
            		<button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
            		<p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            	</form>
      </div>
</div>
@endsection

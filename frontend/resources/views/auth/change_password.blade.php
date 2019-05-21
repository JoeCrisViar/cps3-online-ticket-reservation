@extends('layouts.layout')

@section('content')
<div class="row">
      <div class="col-lg-4 offset-lg-4">
      	<form action="{{ route('users.update', session('user')->isAdmin == true ? $user->_id : session('user')->_id) }}" method="POST" class="form-signin">
      		@csrf
                  @method('PUT')
      		<h1 class="h3 mb-3 font-weight-normal">Change Password</h1>

      		<label for="inputOldPassword" class="sr-only">Old Password</label>
      		<input type="password" id="inputPassword" class="form-control mb-2" placeholder="Enter Old Password" name="old_password" required autofocus>
      		
                  <label for="inputNewPassword" class="sr-only">New Password</label>
                  <input type="password" id="inputNewPassword" class="form-control mb-2" placeholder="Enter New Password" name="new_password" required autofocus>
      		
      		<button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
      		<p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
      	</form>
      </div>
</div>
@endsection

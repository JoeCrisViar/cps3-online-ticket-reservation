@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Display Errors -->
        @include('includes.messages')
    </div>
</div>
<div class="row mb-5">
	<div class="col-lg-10 offset-lg-1">
        <h2>My Account</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
    	<div class="row mb-3">
    		<div class="col-lg-12">
    				<button id="btn-profile" class="btn btn-dark btn-block btn-lg">Profile</button>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-lg-12">
    				<button id="btn-transaction" class="btn btn-dark btn-block btn-lg">Transaction History</button>
    		</div>
    	</div>
    </div>
    <div class="col-lg-8">
    	<div id="profile-div" class="row">
    		<div class="col-lg-12">
    			<span class="h4 font-weight-bold">My Profile</span>
    		</div>	
    		<div class="col-lg-12">
    			
    			<hr>
    			<div class="row mt-2 mb-2">

    				<div class="col-lg-3">
    					<span class="h5 font-weight-light">NAME: </span>
    				</div>
    				<div class="col-lg-6">
    					<span class="h5 font-weight-light">
    						{{ session('user')->firstname . " " . session('user')->lastname }}
    					</span>
    				</div>
    			</div>
    			<div class="row mb-2">
    				<div class="col-lg-3">
    					<span class="h5 font-weight-light">EMAIL: </span>
    				</div>
    				<div class="col-lg-6">
    					<span class="h5 font-weight-light">
    						{{ session('user')->email }}
    					</span>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-lg-12 mb-2">
    					<a class="btn btn-primary" href="{{ route('change_password', session('user')->_id) }}">Change Password</a>
    				</div>
    				
    			</div>
    		</div>
    		
    		
    	</div>
        <div id="transaction-div" class="row" style="display: none;">
            <div class="col-lg-12 mb-4">
            	<span class="h4 font-weight-bold">My Transaction History</span>
            </div>
            <div class="col-lg-12 mb-2">
	            <table class="table">
	                <thead class="thead-light">
	                    <tr>
	                      <th scope="col">#</th>
	                      <th scope="col">Date</th>
	                      <th scope="col">Movie</th>
	                      <th scope="col">Branch</th>
	                      <th scope="col">Cinema</th>
	                      <th scope="col"># of Seats</th>
	                      
	                    </tr>
	                </thead>
	                <tbody>
	                   @forelse($transactions as $index => $transaction)
	                    <tr>
	                        <th scope="row">{{ ++$index }}</th>
	                        <td>@php 
	                        		$time = strtotime($transaction->created_at);

									$date = date('m-d-Y',$time);

									echo $date;
	                        	@endphp</td>
	                        <td>{{ $transaction->movie_title }}</td>
	                        <td>{{ $transaction->branch }}</td>
	                        <td>{{ $transaction->screen_type }}</td>
	                       	<td>{{ $transaction->no_of_seats }}</td>
	                       
	                    </tr>
	                   @empty
	                   <tr>
	                   		<td class="text-center" colspan="6">No transaction found!</td>
	                   </tr>

	                   @endforelse
	                </tbody>
	            </table>
	         </div>
        </div>
    </div>
    
</div>
@endsection
@section('custom_script')

<script src="{{ asset('js/myaccount.js') }}"></script>

@endsection
@extends('layouts.layout')

@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <!-- Display Errors -->
	        @include('includes.messages')
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 offset-lg-3">
			<div class="row mb-3">
			    <div class="col-lg-9  text-left">
			            <span class="h3 font-weight-normal">Seats</span>
			    </div>
			    
			</div><hr>
			<div class="row mb-3">
				<span class="h6 font-weight-normal">Legend : </span>
			</div>
			<div class="row">	
				<div class="col-lg-12 mb-5">
			            <div class="row">
					        @forelse($seats as $seat)
				                <div class="col-lg-1 mb-2">
				                    <a href="#" class="btn {{ $seat->status == true ? 'btn-dark' : 'btn-danger' }} btn-sm">{{ $seat->position }}</a>    
				                </div>
					        @empty
					            <div class="col-lg-12 text-center">
					                <h1 class="text-center">No seats to show!</h1>
					            </div>
					        @endforelse
			     		</div>
			    </div>         
			    
			</div>
		</div>
	</div>
@endsection
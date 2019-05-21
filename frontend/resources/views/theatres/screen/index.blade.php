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
			            <span class="h3 font-weight-normal">Screens</span>
			    </div>
			    <div class="col-lg-3 text-right">
		                <a href="{{ route('screen.create', $theatre->_id) }}" class="btn btn-primary btn-sm">Add Screen</a>
		        </div>
			</div><hr>
			<div class="row">
			        @forelse($screens as $screen)
			        <div class="col-lg-12 mb-5">
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="inputBranch">Screen Type : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="inputBranch">{{ $screen->screen_type }}</label>    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="inputBranch">Seat Price : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="inputBranch">{{ $screen->price }}</label>    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-6 text-right">
			                	
			                    <a href="{{ route('screen.edit', [$theatre->_id, $screen->_id]) }}" class="btn btn-default btn-sm" >Edit</a>    
			                </div>
			                <div class="col-lg-6 text-left">

			                    <form action="{{ route('screen.delete', [$theatre->_id, $screen->_id]) }}" method="POST">
			                        @csrf
			                        @method('DELETE')
			                        <button type="submit" style="color:red;" class="btn btn-default btn-sm" >Delete</button>
			                    </form>    
			                </div>
			            </div>
			        </div><hr>

			        @empty
			            <div class="col-lg-12 text-center">
			                <h1 class="text-center">No screens to show!</h1>
			            </div>
			        @endforelse
			              
			    
			</div>
		</div>
	</div>
@endsection
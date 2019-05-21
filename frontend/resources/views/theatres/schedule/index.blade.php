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
			            <span class="h3 font-weight-normal">Schedules</span>
			    </div>
			    <div class="col-lg-3 text-right">
		                <a href="{{ route('schedule.create', [$theatre->_id, 1]) }}" class="btn btn-primary btn-sm">Add Schedule</a>
		        </div>
			</div><hr>
			<div class="row">
			        @forelse($schedules as $schedule)
			        <div class="col-lg-12 mb-5">
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="labelMovie">Movie : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="showMovie">
			                    	@foreach($movies as $movie)
			                    		@if($movie->_id == $schedule->movie_id)
			                    			{{ $movie->title }}
			                    		@endif
			                    	@endforeach
			                    </label>    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="endDate">Start Date : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="startDate">{{ $schedule->startdate }}</label>    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="endDate">End Date : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="endDate">{{ $schedule->enddate }}</label>    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="endDate">Available Time : </label>    
			                </div>
			                <div class="col-lg-8">
			                	@foreach($schedule->times as $available_time)
			                    <label for="endDate">{{ $available_time }}</label>
			                    @endforeach    
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-lg-4">
			                    <label for="labelStatus">Status : </label>    
			                </div>
			                <div class="col-lg-8">
			                    <label for="showStatus">{{ $schedule->status }}</label>    
			                </div>
			            </div>
			            <div class="row">
			               
			                <div class="col-lg-12 text-right">

			                    <form action="{{ route('schedule.delete', [$theatre->_id, $schedule->_id]) }}" method="POST">
			                        @csrf
			                        @method('DELETE')
			                        <button type="submit" style="color:red;" class="btn btn-default btn-sm" >Delete</button>
			                    </form>    
			                </div>
			            </div>
			        </div><hr>

			        @empty
			            <div class="col-lg-12 text-center">
			                <h1 class="text-center">No schedules to show!</h1>
			            </div>
			        @endforelse
			              
			    
			</div>
		</div>
	</div>
@endsection
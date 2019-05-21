@extends('layouts.layout')
@section('title') 
	Checkout 
@endsection
@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="row mb-5">
			<div class="col-lg-12">
				<h2>{{ $movie->title }}</h2>
			</div>
			<div class="col-lg-12">
				<h5>{{ $movie->release_date }}</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h4>CHECKOUT</h4>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<form action="#" method="#">
							<div class="row">
					        	<span class="h5 font-weight-light mt-1 ml-3">Branch :</span>
					        </div>
							<div class="row">
								<div class="col-lg-12">
									
										@csrf
										<input type="hidden" id="inputMovieId" value="{{ $movie->_id}}">
										<label for="inputBranch" class="sr-only">Branch</label>
								        <div class="input-group mb-2">
								            <select class="custom-select" id="inputGroupSelectBranch" name="branch">
								                
								                @if($theatre->_id == 1)
									       			<option disabled selected>Select a branch...</option>

									            	@forelse($movie->theatres as $movie_s)
									                	@foreach($theatres as $theatre_list)
									                		@if($movie_s->theatre_id == $theatre_list->_id)
									                			<option value="{{ $theatre_list->_id }}">{{ $theatre_list->branch }}</option>
									                		@endif
									                	@endforeach
									                @empty
									                	<option disabled selected>Not yet in theatres...</option>
									                @endforelse
									            @else

									            	@forelse($movie->theatres as $movie_s)
									                	@foreach($theatres as $theatre_list)
									                		@if($movie_s->theatre_id == $theatre_list->_id)
									                			<option value="{{ $theatre_list->_id }}" {{ $theatre->_id == $theatre_list->_id ? "selected" : ""}} >{{ $theatre_list->branch }}</option>
									                		@endif
									                	@endforeach
									                @empty
									                	<option disabled selected>Not yet in theatres...</option>
									                @endforelse
								                @endif
								            </select>
								            <div class="input-group-append">
								                <label class="input-group-text" for="inputGroupSelectBranch">Branch</label>
								            </div>
								        </div>
								        
							        
						    	</div>
					        </div>
					        @if($theatre->_id != 1)
					        <div class="row">
								<div class="col-lg-12">
					        		<div class="row">
					        			<span class="h5 font-weight-light mt-3 ml-3">Screen :</span>
					        		</div>
					        		<div class="row">
							        	<div class="col-lg-4">
							        		
							        		<label for="inputScreenType" class="sr-only">Screen Type</label>
							        		<div class="input-group mb-2">
							        			<select class="custom-select" id="inputGroupSelectScreen" name="screen_type">
							        				<option disabled selected>Select Screen</option>
							        				
								        				@foreach($theatre->screens as $screen_list)
								        						<option value="{{ $screen_list->_id }}" {{ $screen_list->_id == $screen->_id ? "selected" : "" 	}}>{{ $screen_list->screen_type }}</option>
								        				@endforeach
							        				
							        			</select>
							        			<div class="input-group-append">
							        				<label class="input-group-text" for="inputGroupSelectScreen">Type</label>
							        			</div>
							        		</div>
							        	</div>
							        	<div class="col-lg-3">
							        		<label for="inputTimeDate" class="sr-only">Price</label>
							        		<div class="input-group mb-2">
							        			<input type="text" value="{{ $screen->_id != 1 ? $screen->price : '' }}" placeholder="Price" class="form-control" disabled />
							        			<input type="hidden" value="{{ $screen->_id != 1 ? $screen->price : '' }}"  placeholder="Price" class="form-control" name="price" />
							        			<div class="input-group-append">
							        				<label class="input-group-text" for="inputGroupSelectTime">PHP</label>
							        			</div>
							        		</div>
							        	</div>
							        </div>	
					        	</div>
					        </div>
					        @endif
					        @if($screen->_id != 1)
					        <div class="row">
								<div class="col-lg-12">
					        		<div class="row">
					        			<span class="h5 font-weight-light mt-3 ml-3">Schedule :</span>
					        		</div>
					        		<div class="row">
							        	<div class="col-lg-4">
							        		
							        		<label for="inputDate" class="sr-only">Date</label>
							        		<div class="input-group mb-2">
							        			<select class="custom-select" id="inputGroupSelectDate" name="date">
							        				<option disabled selected>Select Date</option>
							        				@if($theatre->_id != 1)
								        				@foreach($daterange as $date)
								        				<option value="{{ $date->format('m-d-Y') }}">{{ $date->format("m-d-Y") }}</option>
								        				@endforeach
							        				@endif
							        			</select>
							        			<div class="input-group-append">
							        				<label class="input-group-text" for="inputGroupSelectDate">Date</label>
							        			</div>
							        		</div>
							        	</div>
							        	<div class="col-lg-4" style="display: none" id="timeDiv">
							        		<label for="inputTimeDate" class="sr-only">Time</label>
							        		<div class="input-group mb-2">
							        			<select class="custom-select" id="inputGroupSelectTime" name="time">
							        				<option disabled selected>Select Time</option>
								        			@if($theatre->_id != 1)
								        				@foreach($times as $time)
								        					<option value="{{ $time }}">{{ $time }}</option>
								        				@endforeach
								 					@endif
							        			</select>
							        			<div class="input-group-append">
							        				<label class="input-group-text" for="inputGroupSelectTime">Time</label>
							        			</div>
							        		</div>
							        	</div>
							        </div>	
					        	</div>
					        </div>
					        @endif
					        @if($screen->_id != 1)
					        <!-- style="display: none" -->
					        <div class="row mt-3"  id="seatDiv" style="display: none">
					        	<div class="col-lg-12">
					        		<div class="row">
					        			<span class="h5 font-weight-light mb-5 ml-3">Seat/s :</span>
					        		</div>
					        		<div class="row">
					        			<div class="col-lg-8 offset-lg-2 mt-5 text-center">
					        				<span class="h6 font-weight-light">LEGEND</span>
					        			</div>
					        		</div>
					        		<div class="row">
							        	<div class="sr-only" id="seatCount">{{count($theatre->seats)}}</div>
							        	<div class="col-lg-8 offset-lg-2 text-center">
								        	@foreach($theatre->seats as $seat_list)

								        	<div class="form-check form-check-inline">
								        		<input class="form-check-input" title="Seat No: {{ $seat_list->position }}" type="checkbox" name="seat" id="{{  'seatPosition' . $seat_list->position }}" value="{{ $seat_list->_id }} ">
								        		<!-- {{ $seat_list->status != true ? 'check disabled' : '' }} -->
								        		<!-- <label class="form-check-label" for="inlineRadio1">1</label> -->
								        	</div>
								        	@endforeach
							        	</div>
						        	</div>
						        	<div class="row">
						        		<div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 text-center mt-5 pt-1" style="background: black; height:40px;">
						        			<h4 style="color: white;">SCREEN</h4>
						        		</div>	
						        	</div>
					        	</div>
					        </div>
					        <!-- <button class="btn btn-primary">Submit</button> -->
					        @endif

					    </form>
				    </div>
				    
		        </div> 
	        </div>
		</div>
	</div>

	<!-- Sidevbar -->
	<div class="col-lg-4">
		<div class="row">
			<div class="card" style="width: 90%;">
	            <div class="card-wrapper">
	                       <a href="#">
	                            <img class="card-img-top" src="{{ asset('images/ironman.jpg') }}" alt="Card image cap">
	                        </a>
	                    
	                <div class="push"></div>
	            </div>
	            <footer class="card-footer">
	                
	                    <a href="#" class="btn btn-primary btn-block">View Trailer</a>
	               
	            </footer>
	        </div>
        </div>
        @if($theatre->_id != 1)
        <div class="row" id="summaryDiv" style="display: none">
        	<div class="col-lg-12">
		        <div class="row">
		        	
		        	<span class="h4 font-weight-bold mt-3">TICKET SUMMARY</span>

		        </div>
		        <div class="row">
		        	<div class="col-lg-4">
		        		<span class="h6 font-weight-bold mt-2">Branch :</span>
		        	</div>
		        	<div class="col-lg-8">
		        		<span class="h6 font-weight-bold mt-2">{{ $theatre->branch }}</span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-4">
		        		<span class="h6 font-weight-bold mt-2">Cinema :</span>
		        	</div>
		        	<div class="col-lg-8">
		        		@foreach($theatre->screens as $screen_list)
		        			@if($screen_list->_id == $screen->_id)
				        		<span class="h6 font-weight-bold mt-2">{{ $screen_list->screen_type }}</span>			
	    					@endif
	    				@endforeach
		        	</div>
		        </div>
		        <div class="row">
		        	
		        	<span class="h6 font-weight-bold mt-2">SCREENING DETAILS</span>
		        
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Movie Title :</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2">{{ $movie->title }}</span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Cinema/Type :</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2">{{ $screen->_id != 1 ? $screen->screen_type : ""}}</span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Screening Date:</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2" id="screeningDate2"></span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Screening Time:</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2" id="screeningTime2"></span>
		        	</div>
		        </div>

		        <div class="row">
		        	
		        	<span class="h6 font-weight-bold mt-2">PURCHASE DETAILS</span>
		        
		        </div>

		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Seat/s :</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2 text-justify" id="selectedSeats"></span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">No of Seats :</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2" id="noOfSeats">0</span>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6">
		       	 		<span class="h6 font-weight-light mt-2">Ticket Price :</span>
		        	</div>
		        	<div class="col-lg-6">
		        		<span class="h6 font-weight-normal mt-2" id="ticketPrice">{{ $screen->_id != 1 ? $screen->price : "" }}</span>
		        	</div>
		        </div>
		        <div class="row">
			        <div class="col-lg-6">
			   	 		<span class="h6 font-weight-light mt-2">Online Fee :</span>
			    	</div>
			    	<div class="col-lg-6">
			    		<span class="h6 font-weight-normal mt-2" id="onlineFee">10</span>
			    	</div>
		    	</div>
		    	<div class="row">
			        <div class="col-lg-6">
			   	 		<span class="h6 font-weight-bold mt-2">Total :</span>
			    	</div>
			    	<div class="col-lg-6">
			    		<span class="h6 font-weight-bold mt-2" id="totalPrice">0</span>
			    	</div>
		    	</div>
		    	 <div class="row">
		        	
		        	<span class="h6 font-weight-bold mt-2">PAYMENT</span>
		        
		        </div>

		        <div class="row">
		        	<div class="col-lg-12 text-center">
			        	<div class="input-group mb-2">
		        			<select class="custom-select" id="inputGroupSelectPayment" name="payment">
		        				<option disabled selected>Select payment</option>
		        				
			        				<option value="Paypal">PAYPAL</option>
			        				<option value="G-CASH">G-CASH</option>
			        				<option value="BayadCenter">BayadCenter</option>
			        				
		        			</select>
		        			<div class="input-group-append mb-1">
		        				<label class="input-group-text" for="inputGroupSelectPayment">Payment</label>
		        			</div>
		        		</div>
		        	</div>
	        	 	
		        </div>
		        <div class="row mt-3">
		        	<div class="col-lg-12">
		        		
			        	<button style="display: none;" type="button" class="btn btn-danger btn-block" data-toggle="modal" id="confirmTicket">Buy</button>
		        	</div>
	        	 	
		        </div>
		    </div>
	    </div>
	    @endif
	</div>
</div>


	@if($screen->_id != 1)
	<!-- Submit Modal -->
	<div class="modal fade" id="confirmTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		@if(session()->has('user'))
	    <form action="{{ route('save') }}" method="POST">
	    @else
		<form>
	    @endif
	    	@csrf
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Ticket Summary</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      	<div class="modal-body">
					  <div class="container-fluid">
					    <div class="col-lg-12">
					    	<div class="row">
					        	<div class="col-lg-4">
					        		<span class="h5 font-weight-normal mt-2">Branch :</span>
					        	</div>
					        	<div class="col-lg-8">
					        		<input type="hidden" name="theatre_id" value="{{ $theatre->_id }}" id="theatreIdHidden" readonly>
					        		<input type="hidden" name="branch" value="{{ $theatre->branch }}" readonly>
					        		<span class="h5 font-weight-normal mt-2">{{ $theatre->branch }}</span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-4">
					        		<span class="h5 font-weight-normal mt-2">Cinema :</span>
					        	</div>
					        	<div class="col-lg-8">
					        		@foreach($theatre->screens as $screen_list)
					        			@if($screen_list->_id == $screen->_id)
					        				<input type="hidden" name="screen_id" value="{{ $screen_list->_id }}" id="screenIdHidden" readonly>
							        		<span class="h5 font-weight-normal mt-2">{{ $screen_list->screen_type }}</span>			
				    					@endif
				    				@endforeach
					        	</div>
					        </div>
					        <div class="row">
					        	<span class="h6 font-weight-bold mt-2">SCREENING DETAILS</span>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Movie Title :</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="movie_id" value="{{ $movie->_id }}" id="movieIdHidden" readonly>
					        		<input type="hidden" name="movie_title" value="{{ $movie->title }}" readonly>
					        		<span class="h6 font-weight-normal mt-2" id="movieTitle">{{ $movie->title }}</span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Cinema/Type :</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="screen_id" value="{{ $screen->_id != 1 ? $screen->_id : '' }}" id="screenIdHidden" readonly>
					        		<input type="hidden" name="screen_type" value="{{ $screen->_id != 1 ? $screen->screen_type : '' }}"  readonly>
					        		<span class="h6 font-weight-normal mt-2" id="cinemaType">{{ $screen->_id != 1 ? $screen->screen_type : ""}}</span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Screening Date:</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="screen_date" value="" id="screeningDateHidden" readonly>
					        		<span class="h6 font-weight-normal mt-2" id="screeningDate3"></span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Screening Time:</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="screen_time" value="" id="screeningTimeHidden" readonly>
					        		<span class="h6 font-weight-normal mt-2" id="screeningTime3"></span>
					        	</div>
					        </div>

					        <div class="row">
					        	
					        	<span class="h6 font-weight-bold mt-2">PURCHASE DETAILS</span>
					        
					        </div>

					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Seat/s :</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<div id="selectedSeatsHidden">
						        		
						        	</div>

					        		<span class="h6 font-weight-normal mt-2 text-justify" id="selectedSeats3"></span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">No of Seats :</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="no_of_seats" value="" id="noOfSeatsHidden" readonly>
					        		<span class="h6 font-weight-normal mt-2" id="noOfSeats3">0</span>
					        	</div>
					        </div>
					        <div class="row">
					        	<div class="col-lg-6">
					       	 		<span class="h6 font-weight-light mt-2">Ticket Price :</span>
					        	</div>
					        	<div class="col-lg-6">
					        		<input type="hidden" name="ticket_price" value="" id="ticketPriceHidden" readonly>
					        		<span class="h6 font-weight-normal mt-2" id="ticketPrice3">{{ $screen->_id != 1 ? $screen->price : "" }}</span>
					        	</div>
					        </div>
					        <div class="row">
						        <div class="col-lg-6">
						   	 		<span class="h6 font-weight-light mt-2">Online Fee :</span>
						    	</div>
						    	<div class="col-lg-6">
						    		<input type="hidden" name="online_fee" value="" id="onlineFeeHidden" readonly>
						    		<span class="h6 font-weight-normal mt-2" id="onlineFee3"></span>
						    	</div>
					    	</div>
					    	<div class="row">
						        <div class="col-lg-6">
						   	 		<span class="h6 font-weight-bold mt-2">Total :</span>
						    	</div>
						    	<div class="col-lg-6">
						    		<input type="hidden" name="total_price" value="" id="totalPriceHidden" readonly>
						    		<span class="h6 font-weight-bold mt-2" id="totalPrice3">0</span>
						    	</div>
					    	</div>
					    	 <div class="row">
					        	
					        	<span class="h6 font-weight-bold mt-2">PAYMENT</span>
					        
					        </div>
					        <div class="row">
					        	<div class="col-lg-12">
					        		<input type="hidden" name="payment_type" value="" id="paymentHidden" readonly>
						        	<span class="h6 font-weight-bold mt-2" id="payment3">Select Payment</span>
					        	</div>
				        	 	
					        </div>
					        
					    </div>

					  </div>
					</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        
			       @if(session()->has('user'))
			        <button type="submit" class="btn btn-primary">Confirm</button>
			       @else
			       	<button type="button" class="btn btn-primary" id="submitForm">Confirm</button>
			       @endif
			      </div>
			    </div>
	    </form>
	  </div>
	</div>
	@endif
@endsection
@section('custom_script')

<script src="{{ asset('js/checkout.js') }}"></script>


@endsection
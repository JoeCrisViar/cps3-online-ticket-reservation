@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="h3 mb-3 font-weight-normal">{{ $theatre->branch }}</h1>
        </div>
        <div class="col-lg-12 text-center">
            <h1 class="h6 mb-3 font-weight-normal">{{ $theatre->location }}</h1>
        <hr>
        </div>
        <div class="col-lg-4 offset-lg-4">
            
                <form class="form-signin" action="{{ route('schedule.store', $theatre->_id) }}" method="POST">
                    @csrf
                    
                    <h1 class="h5 mb-3 font-weight-normal">Add Schedule</h1>
                    <input type="hidden" value="{{ $theatre->_id }}" id="inputTheatreId">
                    <label for="inputMovie" class="sr-only">Movie</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" id="inputGroupMovie" name="movie_id">
                            <option disabled selected>Choose...</option>
                            @foreach($movies as $movie_list)
                              @if(isset($movie))
                                @if($movie_list->_id == $movie->_id)
                                  <option value="{{ $movie_list->_id }}" selected>{{ $movie_list->title }}</option>
                                @endif
                              @endif
                                <option value="{{ $movie_list->_id }}">{{ $movie_list->title }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupMovie">Movies</label>
                        </div>
                    </div>
                     <label for="inputStartDate" class="sr-only">Start Date</label>
                    <!-- http://www.daterangepicker.com/#example4 -->
                    <div class="input-group mb-2">
                        <input type="text" value="{{ isset($movie) ? date_format(date_create($movie->release_date),'m/d/Y') : '' }}"  placeholder="Select start date..." class="form-control" disabled />
                        <input type="hidden" value="{{ isset($movie) ? date_format(date_create($movie->release_date),'m/d/Y') : '' }}" name="startDate" placeholder="Select start date..." class="form-control"/>
                    
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupStartDate">Start Date</label>
                        </div>
                    </div>
                    <label for="inputEndDate" class="sr-only">End Date</label>
                    <!-- http://www.daterangepicker.com/#example4 -->
                    <div class="input-group mb-2">
                        <input type="text" name="endDate" placeholder="Select end date..." class="form-control"/>
                    
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupEndDate">End Date</label>
                        </div>
                    </div>
                    <label for="inputStatus" class="sr-only">Status</label>
                   <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect03" name="status">
                            <option selected>Choose...</option>
                            <option value="Coming Soon">Coming Soon</option>
                            <option value=Showing>Showing</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect03">Status</label>
                        </div>
                    </div>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection
@section('custom_script')
<script src="{{ asset('js/create_schedule.js') }}"></script>

<script>
// $(function() {
//   $('input[name="endDate"]').daterangepicker({
//     singleDatePicker: true,
//     showDropdowns: true,
//     minYear: 1901,
//     maxYear: parseInt(moment().format('YYYY'),10)
//   }, function(start, end, label) {
//     // var years = moment().diff(start, 'years');
//     // alert("You are " + years + " years old!");
//   });
// });

$('input[name="endDate').daterangepicker({
    "singleDatePicker": true,
    "timePicker": true,
    locale: {
      format: 'MM/DD/YY hh:mm A'
    },
    showDropdowns: true,
    minYear: 1901,
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD ') + ' (predefined range: ' + label + ')');
});
</script>


@endsection
@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('movies.store') }}" method="POST">
                    @csrf
                    
                    <h1 class="h3 mb-3 font-weight-normal">Add Movie</h1>
                    
                    <label for="inputTitle" class="sr-only">Title</label>
                    <input type="text" id="inputTitle" class="form-control mb-2" placeholder="Enter Title" name="title" required autofocus>
                    <label for="inputReleaseDate" class="sr-only">Release Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="release_date" placeholder="Enter release date" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection
@section('custom_script')
<script>
$(function() {
  $('input[name="release_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    // var years = moment().diff(start, 'years');
    // alert("You are " + years + " years old!");
  });
});
</script>
@endsection
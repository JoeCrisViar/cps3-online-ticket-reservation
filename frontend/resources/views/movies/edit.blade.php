@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('movies.update', $movie->_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h1 class="h3 mb-3 font-weight-normal">Edit Movie</h1>
                    
                    <label for="inputTitle" class="sr-only">Title</label>
                    <input type="text" id="inputTitle" class="form-control mb-2" placeholder="Enter Title" name="title" value="{{ $movie->title }}" required autofocus>
                    <label for="inputReleaseDate" class="sr-only">Release Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="release_date" placeholder="Enter release date" value="{{ $movie->release_date }}" />
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
<script type="text/javascript">
            $(function () { 
                $('#datetimepicker1').datetimepicker();
            });
</script>
@endsection
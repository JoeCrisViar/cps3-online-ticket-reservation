@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('theatres.update', $theatre->_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h1 class="h3 mb-3 font-weight-normal">Edit Branch</h1>
                    
                    <label for="inputBranch" class="sr-only">Branch</label>
                    <input type="text" id="inputBranch" class="form-control mb-2" placeholder="Enter Branch" name="branch" value="{{ $theatre->branch }}" required autofocus>
                    <label for="inputLocation" class="sr-only">Location</label>
                    <input type="text" id="inputLocation" class="form-control mb-2" placeholder="Enter Location" name="location" value="{{ $theatre->location }}" required>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection

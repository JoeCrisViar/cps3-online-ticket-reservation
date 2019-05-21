@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('theatres.store') }}" method="POST">
                    @csrf
                    
                    <h1 class="h3 mb-3 font-weight-normal">Add New Branch</h1>
                    
                    <label for="inputBranch" class="sr-only">Branch</label>
                    <input type="text" id="inputBranch" class="form-control mb-2" placeholder="Enter Branch" name="branch" required autofocus>
                    <label for="inputLocation" class="sr-only">Location</label>
                    <input type="text" id="inputLocation" class="form-control mb-2" placeholder="Enter Location" name="location" required>
                    
                    <label for="inputSeat" class="sr-only">Seat Count</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" id="inputGroupSelect02" name="seat_count">
                            <option selected>Choose...</option>
                            <option value=20>20</option>
                            <option value=50>50</option>
                            <option value=100>100</option>
                            <option value=150>150</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Seat Count</label>
                        </div>
                    </div>


                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection

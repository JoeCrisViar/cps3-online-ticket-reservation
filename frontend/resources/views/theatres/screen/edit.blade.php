@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('screen.update', [$theatre->_id, $screen->_id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h1 class="h3 mb-3 font-weight-normal">Edit Screen</h1>
                    
                    <label for="inputScreenType" class="sr-only">Screen</label>
                    <input type="text" id="inputScreenType" class="form-control mb-2" placeholder="Enter Screen type" name="screen_type" value="{{ $screen->screen_type }}" required autofocus>
                    <label for="inputPrice" class="sr-only">Price</label>
                    <input type="text" id="inputPrice" class="form-control mb-2" placeholder="Enter Price" name="price" value="{{ $screen->price }}" required>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection

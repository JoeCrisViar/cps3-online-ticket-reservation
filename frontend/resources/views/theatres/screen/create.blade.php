@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-4 offset-lg-4">
                <form class="form-signin" action="{{ route('screen.store', $theatre->_id) }}" method="POST">
                    @csrf
                    
                    <h1 class="h3 mb-3 font-weight-normal">Add Screen</h1>
                    
                    <label for="inputScreenType" class="sr-only">Screen Type</label>

                    <div class="input-group mb-2">
                        <select class="custom-select" id="inputGroupSelect01" name="screen_type">
                            <option selected>Choose screen...</option>
                            <option value="IMAX">IMAX</option>
                            <option value="3D">3D</option>
                            <option value="Dolby Digital">Dolby Digital</option>
                            <option value="DTS">DTS</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect01">Screen</label>
                        </div>
                    </div>
                    <label for="inputPrice" class="sr-only">Price</label>
                    <input type="number" id="inputLocation" class="form-control mb-2" placeholder="Enter price" name="price" required>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </form>
        </div>
</div>

@endsection

@extends('layouts.layout')

@section('content')
<div class="row justify-content-center">
	@forelse($movies as $index => $movie)
		<div class="col-lg-3 col-md-6 mb-2">
			<!-- style="width: 100%; height: 95%;" -->
            <div class="card" style="width: 95%;">
                <div class="card-wrapper">
                           <a href="#">
                                <img class="card-img-top" src="https://picsum.photos/id/{{ $index+=20}}/200/300" alt="Card image cap">
                            </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                    <a href="#">{{ $movie->title }}</a>
                            </h5>
                            
                            <p class="card-price h6"><a href="#"><h5> {{ $movie->release_date }}</h5></a></p>
                            
                        </div>
                    <div class="push"></div>
                </div>
                <footer class="card-footer">
                    
                        <a href="{{ route('checkout', [ 1, $movie->_id, 1]) }}" class="btn btn-primary btn-block">Buy</a>
                   
                   
                </footer>
            </div>
        </div>
	
	@empty
		<h1>No Movie to show</h1>
	@endforelse
</div>
@endsection
      








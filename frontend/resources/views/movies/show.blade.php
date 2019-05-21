@extends('layouts.layout')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h1 class="h3 mb-3 font-weight-normal">{{ $movie->title }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h1 class="h6 mb-3 font-weight-normal">{{ $movie->release_date }}</h1>
                </div>
                
            </div>
            
            <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <hr>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Branches Available</th>
                          <th class="text-center" style="width: 25%" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movie->theatres as $index => $theatre)
                        <tr>
                            <th scope="row">{{ ++$index }}</th>
                            <td>
                                @foreach($theatres as $theatre_list)
                                    @if($theatre_list->_id == $theatre->theatre_id)
                                    <a href="{{ route('movies.show', $movie->_id)}}">{{ $theatre_list->branch }}</a>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form action="#" method="GET">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <form action="#" method="#">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="4"><h3>Not yet available in any theatre.</h3></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
            
</div>


@endsection

@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Display Errors -->
        @include('includes.messages')
    </div>
</div>
<div class="row">
    
    <div class="col-lg-8 offset-lg-2">
        <div class="row">
            <div class="col-lg-2">
                <h2>Theatres</h2>
            </div>
            <div class="col-lg-2 offset-lg-8">
                <a href="{{ route('theatres.create') }}" class="btn btn-primary mb-2">Add Branch</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Branch</th>
                          <th scope="col">Location</th>
                          <th class="text-center" style="width: 25%" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($theatres as $index => $theatre)
                        <tr>
                            <th scope="row">{{ ++$index }}</th>
                            <td><a href="{{ route('theatres.show', $theatre->_id)}}">{{ $theatre->branch }}</a></td>
                            <td><a href="{{ route('theatres.show', $theatre->_id)}}">{{ $theatre->location }}</a></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form action="{{ route('theatres.edit', $theatre->_id) }}" method="GET">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <form action="{{ route('theatres.destroy', $theatre->_id) }}" method="POST">
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
                            <td scope="row" colspan="4" class="text-center">No records found!</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
      








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
                <h2>Movies</h2>
            </div>
            <div class="col-lg-2 offset-lg-8">
                <a href="{{ route('movies.create') }}" class="btn btn-primary mb-2">Add Movie</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Release Date</th>
                          <th class="text-center" style="width: 25%" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $index => $movie)
                        <tr>
                            <th scope="row">{{ ++$index }}</th>
                            <td><a href="{{ route('movies.show', $movie->_id)}}">{{ $movie->title }}</a></td>
                            <td><a href="{{ route('movies.show', $movie->_id)}}">{{ $movie->release_date }}</a></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form action="{{ route('movies.edit', $movie->_id) }}" method="GET">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <form action="{{ route('movies.destroy', $movie->_id) }}" method="POST">
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
                            <td class="text-center" colspan="4"><h3>No movies to show</h3></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
      








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
                <h2>Users</h2>
            </div>
            <div class="col-lg-2 offset-lg-8 text-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Register</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Type</th>
                      <th class="text-center" style="width: 20%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <th scope="row">{{ ++$index }}</th>
                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->isAdmin ? 'Admin' : 'Customer' }}</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form action="{{ route('users.edit', $user->_id) }}" method="GET">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <form action="{{ route('users.destroy', $user->_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
      








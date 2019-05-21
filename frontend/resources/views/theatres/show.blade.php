@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="h3 mb-3 font-weight-normal">{{ $theatre->branch }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="h6 mb-3 font-weight-normal">{{ $theatre->location }}</h1>
            </div>
            
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-4  text-center">        
                    <span class="h1 font-weight-normal"><a href="{{ route('screen.index', $theatre->_id) }}">SCREENS</a></span>
            </div>
            <div class="col-lg-4  text-center">        
                    <span class="h1 font-weight-normal"><a href="{{ route('schedule.index', $theatre->_id) }}">SCHEDULES</a></span>
            </div>
            <div class="col-lg-4  text-center">        
                    <span class="h1 font-weight-normal"><a href="{{ route('seat.index', $theatre->_id) }}">SEATS</a></span>
            </div>
        </div>
        
    </div>
</div>


@endsection

@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h3>Search Results</h3>
    
    <h4>Teachers</h4>
    @if($teachers->isEmpty())
        <p>No teachers found.</p>
    @else
        <ul>
            @foreach($teachers as $teacher)
                <li>{{ $teacher->name }}</li>
            @endforeach
        </ul>
    @endif
    
    <h4>Rooms</h4>
    @if($rooms->isEmpty())
        <p>No rooms found.</p>
    @else
        <ul>
            @foreach($rooms as $room)
                <li>{{ $room->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

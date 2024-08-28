@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="card text-end" style="width: 40rem; ">
        <div class="card-body">
            <h1 class="text-center">{{$teacher->name}}</h1>
            <p class="card-text">
                @if($teacher->rooms->isEmpty())
                    <span class="text-danger">No Room Assigned</span>
                @else
                    Rooms:
                    <ul>
                        @foreach($teacher->rooms as $room)
                            <li>{{ $room->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </p>
            <a href="{{URL('teacher')}}" class="btn btn-primary justify-content-end">Go Back</a>
        </div>
    </div>
</div>


@endsection
@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="card text-end" style="width: 40rem;">
        <div class="card-body">
            <h5 class="card-title text-center">{{$room->name}}</h5>
            <body>
                <div class="container">
                    <div class="row text-align-center mx-auto" style="max-width: 600px;">
                        <div class="mb-3 col-6">
                            <p>Students in class:</p>
                            <ul>
                                @forelse($room->students as $student)
                                    <li>{{ $student->name }}</li>
                                @empty
                                    <li class="text-danger">No students in this room.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-3 col-6">
                            <p>Teacher in class:</p>
                            <ul>
                                @forelse($room->teachers as $teacher)
                                    <li>{{ $teacher->name }}</li>
                                @empty
                                    <li class="text-danger">No teacher in this room.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </body>

            <a href="{{URL('room')}}" class="btn btn-primary justify-content-end">Go Back</a>
        </div>
    </div>
</div>
@endsection
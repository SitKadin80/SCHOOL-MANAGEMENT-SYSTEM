<!-- @extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="card text-end" style="width: 40rem;">
        <div class="card-body">
            <h5 class="card-title text-center">{{$student->name}}</h5>
            <body>
                <p>
                  @if($student->room)
                      {{ $student->room->name }}
                  @else
                      <span style="color: red;">No Room Assigned</span>
                  @endif
              </p>
            </body>
            <a href="{{URL('room')}}" class="btn btn-primary justify-content-end">Go Back</a>
        </div>
    </div>
</div>
@endsection -->

 
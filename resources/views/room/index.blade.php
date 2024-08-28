@extends("layout.master")

@section('content')
<div class="container">
    <a href="{{URL('room/create')}}" class="btn btn-primary text-white p-2 mt-3 rounded">New Room</a>
    <table class="table table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Room Name</th>
                <!-- <th scope="col">Number of Students</th> -->
                <th scope="col">Student Name</th>
                <th scope="col">teacher Name</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $index => $room)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $room->name }}</td>
                <td class="text-center">
                    @if($room->students->isEmpty())
                        <p class="text-danger">No student</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($room->students as $student)
                                <li>{{ $student->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    @if($room->teachers->isEmpty())
                        <p class="text-danger">No teacher</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($room->teachers as $teacher)
                                <li>{{ $teacher->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td class="d-flex justify-content-center">
                    <a href="{{URL('room/' .$room->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    <a href="{{URL('room/' .$room->id)}}" class="btn btn-info ml-3">show</a>
                    <form action="{{ URL('room/'. $room->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger ml-3">Delete</button>
                    </form>
                </td>
             </tr>
        @endforeach
    </tbody>
    </table>
    
</div>
@endsection

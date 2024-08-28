@extends("layout.master")

@section('content')
<div class="container mt-3">
    <a href="{{URL('student/create')}}" class="btn btn-primary mb-3" data-toggle="modal" data-target="#studentModal">Add New</a>
    <table class="table table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Room</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="studentTable">
            @forelse ($students as $index => $student)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $student->name }}</td>
                    <td>
                        @if($student->room)
                            {{ $student->room->name }}
                        @else
                            <span style="color: red;">No Room Assigned</span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#updateStudentModal-{{ $student->id }}" data-id="{{ $student->id }}">Edit</a>
                        <a href="#" class="btn btn-info ml-3" data-toggle="modal" data-target="#showStudentModal-{{ $student->id }}" data-id="{{ $student->id }}">Show</a>
                        <form action="{{ URL('student/' . $student->id) }}" method="POST" class="ml-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No students found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal for Adding a Student -->
    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModal">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL('student') }}" method="POST" class="bg-light p-3">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter student name">
                        </div>
                        @if($errors->has('name'))
                            <div style="color: red;">{{ $errors->first('name') }}</div>
                        @endif
                        <div class="mb-3">
                            <label for="roomName" class="form-label">Room Name</label>
                            <select class="form-control" name="room_id">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Updating a Student -->
    @foreach ($students as $student)
    <div class="modal fade" id="updateStudentModal-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStudentModalLabel-{{ $student->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStudentModalLabel-{{ $student->id }}">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL('student/' . $student->id) }}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="studentName-{{ $student->id }}" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName-{{ $student->id }}" name="name" value="{{ $student->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="roomName-{{ $student->id }}" class="form-label">Room Name</label>
                            <select class="form-control" name="room_id" id="room_id_update-{{ $student->id }}">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $student->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal for Showing a Student -->
    @foreach ($students as $student)
    <div class="modal fade" id="showStudentModal-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="showStudentModalLabel-{{ $student->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $student->name }}</h5>
                    <p>{{ $student->room ? $student->room->name : 'No Room Assigned' }}</p>
                    <a href="{{URL('room')}}" class="btn btn-primary justify-content-end">Go Back</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection

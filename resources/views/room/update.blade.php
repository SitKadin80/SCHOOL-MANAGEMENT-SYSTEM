
@extends('layout.master')

@section('content')
<div class="container">
    <form action="{{ URL('room/' . $room->id) }}" method="POST" class="bg-light mt-5 p-3">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h5 class="modal-title mb-3" id="addStudentModalLabel">Update Room</h5>
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="name" value="{{ old('name', $room->name) }}" placeholder="Enter room name">
            </div>
            <div class="mb-3">
            <label for="teacherName" class="form-label">Teacher Name</label>
                <select class="w-full mb-3" name="teacher[]" multiple>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ in_array($teacher->id, old('teacher', [])) ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ URL('room') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
@endsection

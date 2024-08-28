
@extends('layout.master')
@section('content')
<div class="container">
    <form action="{{URL('teacher/' .$teacher->id)}}" method="POST" class="bg-light mt-5">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PUT') }}
        <div class="modal-body">
            <h5 class="modal-title mb-3" id="addStudentModalLabel">Update Student</h5>
            <div class="mb-3">
                <label for="teacherName" class="form-label">Teacher Name</label>
                <input type="text" class="form-control" id="teacherName" name="name" value="{{$teacher->name}}" placeholder="Enter teacher name" >
            </div>
            <select class="w-full mb-3" name="room[]" multiple>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ in_array($room->id, old('room', [])) ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <a href="{{ URL('teacher') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
@endsection



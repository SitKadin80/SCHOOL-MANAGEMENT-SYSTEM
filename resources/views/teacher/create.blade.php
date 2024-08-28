@extends('layout.master')
@section('content')
<div class="container">
    <form action="{{ URL('teacher')}}" method="POST" class="bg-light mt-5">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
            <h5 class="modal-title" id="addStudentModalLabel">Add New Teacher</h5>
            <div class="mb-3">
                <label for="studentName" class="form-label">Teacher Name</label>
                <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter student name">
            </div>
            @if($errors->has('name'))
            <div style="color: red;">{{ $errors->first('name') }}</div>
            @endif
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <select class="w-full mb-3" name="room[]" multiple>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ in_array($room->id, old('room', [])) ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{URL('teacher')}}"  class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
@endsection

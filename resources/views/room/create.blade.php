@extends('layout.master')
@section('content')
<div class="container">
    <form action="{{URl('room')}}" method="POST" class="bg-light mt-5 p-3">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
            <h5 class="modal-title mb-3" id="addStudentModalLabel">Add New Room</h5>
            <div class="mb-3">
                <label for="studentName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter student name">
            </div>
            @if($errors->has('name'))
            <div style="color: red;">{{ $errors->first('name') }}</div>
            @endif
            
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
            <a href="{{URL('room')}}"  class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
@endsection

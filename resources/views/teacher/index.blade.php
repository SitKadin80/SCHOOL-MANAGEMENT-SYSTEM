@extends("layout.master")

@section('content')
<div class="container">
<a href="{{URL('teacher/create')}}" class="btn btn-primary">Add New Teacher</a>
  <table class="table table-striped">
    <thead class="bg-dark text-white">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Teacher Name</th>
        <th scope="col">Room Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($teachers))
      @foreach ($teachers as $index=>$teacher )
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$teacher->name}}</td>
        <td>
          @if($teacher->rooms->isEmpty())
              <p class="text-danger">No Room</p>
          @else
              <ul class="list-unstyled">
                  @foreach ($teacher->rooms as $room)
                      <li>{{ $room->name }}</li>
                  @endforeach
              </ul>
          @endif
      </td>

        
        <td class="d-flex">
          <a href="{{URL('teacher/' .$teacher->id.'/edit')}}" class="btn btn-primary">Edit</a>
          <a href="{{URL('teacher/' .$teacher->id)}}" class="btn btn-info ml-3">show</a>
          <form action="{{ URL('teacher/'. $teacher->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger ml-3">Delete</button>
          </form>
        </td>
      </tr>

      @endforeach
      @endif

    </tbody>
  </table>
</div>

@endsection

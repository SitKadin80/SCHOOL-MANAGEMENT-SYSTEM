@extends("layout.master")

@section('content')
<div class="container mt-3">
    <a href="javascript:void(0)" class="btn btn-primary mb-3" data-toggle="modal" data-target="#studentModal">Add New</a>
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
            <tr id="studentRow{{ $student->id }}">
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
                    <a href="javascript:void(0)" class="btn btn-warning btn-edit ml-3" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-room-id="{{ $student->room_id }}">Edit</a>
                    <a href="javascript:void(0)" data-url="{{ URL('student/'. $student->id) }}" class="btn btn-info btn-show ml-3 " data-toggle="modal" data-target="#showStudentModal">Show</a>
                    <a href="javascript:void(0)" data-url="{{ URL('student/'. $student->id) }}" class="btn btn-danger deletStudent ml-3">Delete</a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" id="noStudentsMessage">No students found</td>
                </tr>
            @endforelse     
        </tbody>
    </table>

    <!-- Modal for adding a student -->
    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModal">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addStudentForm" class="bg-light p-3">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter student name">
                            <div id="nameError" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="roomName" class="form-label">Room Name</label>
                            <select class="form-control" name="room_id" id="room_id">
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="addStudentButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal for updating a student -->
<div class="modal fade" id="updateStudentModal" tabindex="-1" role="dialog" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateStudentForm" class="bg-light p-3">
                @csrf
                <input type="hidden" name="id" id="updateStudentId">
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updateStudentName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="updateStudentName" name="name" value="">
                        <div id="updateNameError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="roomName" class="form-label">Room Name</label>
                        <select class="w-full mb-3" name="room_id" id="studentRoom">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateStudent">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal for showing a student -->
    <div class="modal fade" id="showStudentModal" tabindex="-1" role="dialog" aria-labelledby="showStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showStudentModalLabel">Show Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="showStudentName"></h5>
                    <p id="showStudentRoom"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // add student
    $('#addStudentForm').on('submit', function(e) {
        e.preventDefault(); // it prevent our form reload 
        $.ajax({
            url: "{{ URL('student') }}", 
            type: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#studentModal').modal('hide'); 
                location.reload();  
            },
            error: function(xhr, status, error) {
                alert('student created fail');
            }
        });
     });

    //  update student 
    
    $(document).on('click', '#btnUpdateStudent', function(e) {
    e.preventDefault();

    var studentId = $('#updateStudentId').val();  // Get student ID
    var formData = new FormData($('#updateStudentForm')[0]);

    $.ajax({
        type: "POST", 
        url: "{{ url('student') }}/" + studentId,  
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-HTTP-Method-Override': 'PUT' // Simulate PUT request
        },
        success: function(response) {
            $('#updateStudentModal').modal('hide');  // Hide the modal

            // Update the specific row in the table without refreshing
            var updatedRow = $('#studentRow' + studentId);
            updatedRow.find('td:nth-child(2)').text(response.name);
            updatedRow.find('td:nth-child(3)').html(response.room_name ? response.room_name : '<span style="color: red;">No Room Assigned</span>');

        },
        error: function(error) {
            console.log(error);
            alert('Failed to update student.');
        }
    });
});

    $(document).on('click', '.btn-edit', function() {
        var studentId = $(this).data('id');
        var studentName = $(this).data('name');
        var studentRoomId = $(this).data('room-id');

        $('#updateStudentId').val(studentId);
        $('#updateStudentName').val(studentName);
        $('#studentRoom').val(studentRoomId);
        $('#updateStudentModal').modal('show');
    });


    // show student
    $(document).on('click', '.btn-show', function() {
    var studentURL = $(this).data('url'); // Get the URL from data-url attribute

        $.ajax({
            url: studentURL,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate the modal fields with the data
                $('#showStudentName').text(data.name);
                $('#showStudentRoom').text(data.room ? data.room.name : "No Room Assigned");

                // Show the modal
                $('#showStudentModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert("Failed to fetch student details.");
                console.log(xhr.responseText); 
            }
        });
    });

    // delete student

    $(document).on('click', '.deletStudent', function() {
        var userURL = $(this).data('url');
        var trObj = $(this).closest("tr"); 

        if (confirm("Are you sure you want to delete this student?")) {
            $.ajax({
                url: userURL,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        trObj.remove(); 
                        if ($('#studentTable tr').length === 0) {
                            $('#studentTable').append('<tr><td colspan="4" class="text-center" id="noStudentsMessage">No students found</td></tr>');
                        }
                    } else {
                        alert("Failed to delete student: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while deleting the student.");
                    console.log(xhr.responseText); 
                }
            });
        }
    });


</script>
@endpush

@endsection
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students=Student::orderBy('id','DESC')->get();
        $rooms = Room::all(); 

        return view('student.index', ['students' => $students, 'rooms' => $rooms]);

        // using bootstrap
        // return view('student.test', ['students' => $students, 'rooms' => $rooms]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::get();
        return view('student',['rooms' => $rooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        
        Student::create([
            'name' => $request->input('name'),
            'room_id' => $request->input('room_id'),
        ]);
        return redirect()->back();
    }


    public function show($id)
    {
        $student = Student::with('room')->findOrFail($id);
        return response()->json($student);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student=Student::find($id);
        $rooms = Room::all();
        return view('student',['student' => $student, 'rooms'=>$rooms]);
    }

    public function update(StudentRequest $request, string $id)
    {
        $student = Student::find($id);
    
        if ($student) {
            $student->update([
                'name' => $request->input('name'),
                'room_id' => $request->input('room_id'),
            ]);
    
            // Return the updated student data as JSON
            return response()->json([
                'success' => true,
                'name' => $student->name,
                'room_name' => $student->room ? $student->room->name : null,  
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }
    

    public function destroy(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id','DESC')->get();
        $rooms = Room::get();
        return view('teacher.index',['teachers' => $teachers, 'rooms' =>$rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms=Room::get();
        return view('teacher.create',['rooms' => $rooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {	
        $teacher = Teacher::create([
            'name' => $request->name,
        ]);

        $teacher->rooms()->attach($request->room);
        return redirect('teacher');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        $rooms = Room::get();
        return view('teacher.show',['teacher' => $teacher, 'rooms' => $rooms]);
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(string $id)
        {
            $rooms = Room::get();
            $teacher = Teacher::where('id', $id)->first();
            return view('teacher.update', ['teacher' => $teacher, 'rooms' => $rooms]);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        $teacher = Teacher::find($id);

        $teacher->update([
            'name' => $request->name
        ]);

        $teacher->rooms()->sync($request->room);
        return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $teacher->rooms()->detach();
        $teacher->delete();
        return redirect('teacher');

    }
}

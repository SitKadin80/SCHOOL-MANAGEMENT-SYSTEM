<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        $teachers = Teacher::get();
        return view('room.index',['rooms' => $rooms, 'teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::get();
        return view('room.create',['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $room = Room::create([
            'name' => $request->name
        ]);
        $room->teachers()->attach($request->room);
        return redirect('room');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        $teacher = Teacher::get();
        return view('room.show',['room' => $room,'teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::find($id);
        $teachers = Teacher::get();
        return view('room.update',['room' => $room,'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, string $id)
    {
        $room= Room::find($id);
        $room->update([
            'name' => $request->name,
        ]);
         $room->teachers()->sync($request->teacher);
        return redirect('room');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        $room->teachers()->detach();
        $room->delete();
        return redirect('room');
    }
}

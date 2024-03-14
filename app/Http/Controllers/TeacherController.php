<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('pages.Teachers.Teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $specializations = Specialization::all();
        return view('pages.Teachers.create', compact('genders', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $data['Address'] = strtotime($request->Address);
        Teacher::create($data);
        return redirect()->route('Teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('pages.Teachers.Edit', compact('teacher', 'specializations', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $data = $request->validated();
        if($data['password'] != $teacher->password){
            $data['password'] = bcrypt($request->password);
        }
        $data['Address'] = strtotime($request->Address);
        $teacher->update($data);

        return redirect()->route('Teachers.index');
    }

    public function delete(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('Teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        $Classes = Classroom::all();
        $teachers = Teacher::all();
        return view('pages.Sections.Sections', compact('Grades', 'Classes', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        Section::create($request->validated());
        return redirect()->route('Sections.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        $section = Section::findOrFail($id);
        $section->update($request->validated());
        return redirect()->route('Sections.index');
    }

    public function delete(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('Sections.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

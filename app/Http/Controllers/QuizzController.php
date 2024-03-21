<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizzRequest;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        $sections = Section::all();
        return view('pages.Quizzes.create', compact('subjects', 'teachers', 'grades', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizzRequest $request)
    {
        Quiz::create($request->validated());
        return redirect()->route('Quizzes.index');
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
        $quizz = Quiz::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        $sections = Section::all();
        return view('pages.Quizzes.edit', compact('quizz', 'subjects', 'teachers', 'grades', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizzRequest $request, string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->validated());
        return redirect()->route('Quizzes.index');
    }

    public function delete(String $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('Quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

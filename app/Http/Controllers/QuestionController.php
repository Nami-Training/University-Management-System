<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Quiz;
use App\Services\QuestionService;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    private $questionService;
    private $quizService;

    function __construct(QuestionService $questionService, QuizService $quizService)
    {
        $this->questionService = $questionService;
        $this->quizService = $quizService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->all();
        return view('pages.Questions.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quizzes = $this->quizService->all();
        return view('pages.Questions.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        try {
            $this->questionService->create($request->validated());
            toastr()->success(trans('messages.success'));
            return redirect()->route('Questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
        $question = $this->questionService->findById($id);
        $quizzes = $this->quizService->all();
        return view('pages.Questions.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {

        try {
            $this->questionService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function delete(String $id)
    {
        try {
            $this->questionService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->questionService->forceDelete($id);
        return redirect()->route('Questions.index');
    }
}

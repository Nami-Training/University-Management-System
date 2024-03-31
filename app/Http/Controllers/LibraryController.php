<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use App\Services\ClassroomService;
use App\Services\GradeService;
use App\Services\LibraryService;
use App\Services\SectionService;
use App\Services\TeacherService;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class LibraryController extends Controller
{
    private $libraryService;
    private $gradeService;
    private $classroomService;
    private $sectionService;
    private $teacherService;

    function __construct(LibraryService $libraryService, GradeService $gradeService, ClassroomService $classroomService, SectionService $sectionService, TeacherService $teacherService)
    {
        $this->libraryService = $libraryService;
        $this->gradeService = $gradeService;
        $this->classroomService = $classroomService;
        $this->sectionService = $sectionService;
        $this->teacherService = $teacherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->libraryService->all();
        return view('pages.library.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->gradeService->all();
        return view('pages.library.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibraryRequest $request)
    {
        $this->libraryService->uplaodBook($request->Book_file, $request->all());
        return redirect()->route('library.index');
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
        $grades = $this->gradeService->all();
        $book = $this->libraryService->findById($id);
        return view('pages.library.edit',compact('book','grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->libraryService->updateBook($id, $request);
        return redirect()->route('library.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->libraryService->findById($id);
        $this->libraryService->delteBook($book->path);
        $this->libraryService->delete($id);
        return redirect()->route('library.index');
    }

    public function downloadAttachment(string $fileName)
    {
        return $this->libraryService->download($fileName);
    }
}

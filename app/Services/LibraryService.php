<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Trait\FileHandling;
use App\Models\Library;

class LibraryService extends MainService
{
    use FileHandling;

    public function __construct()
    {
        parent::__construct(new Library);
    }

    public function download($fileName)
    {
        return response()->download(public_path('attachments/library/' . $fileName));
    }

    public function uplaodBook($file, $data)
    {
        $path = $this->uplaodFile($file, 'attachments/library/');
        $fileName = explode('/',$path)[2];
        // $fileName = $file->getClientOriginalName();
        $this->create([
            'title' => $data['title'],
            'grade_id' => $data['grade_id'],
            'classroom_id' => $data['classroom_id'],
            'section_id' => $data['section_id'],
            'teacher_id' => 1,
            'file_name' => $fileName,
            'path' => $path
        ]);
    }

    public function updateBook(string $id, Request $request)
    {
        if ($request->file('Book_file')) {
            $book = $this->findById($id);
            $this->delteBook($book->path);
            $path = $this->uplaodFile($request->Book_file, 'attachments/library/');
            $fileName = $request->Book_file->getClientOriginalName();
            $book->update([
                'title' => $request->title,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'file_name' => $fileName,
                'path' => $path
            ]);
        } else {
            $this->update($id, [
                'title' => $request->title,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
            ]);
        }
    }

    public function delteBook($path)
    {
        $this->deleteFile($path);
    }
}

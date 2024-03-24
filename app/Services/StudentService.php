<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Student;
use App\Http\Trait\UploadImage;
use Illuminate\Support\Facades\File;

class StudentService extends MainService
{
    use UploadImage;

    public function __construct()
    {
        parent::__construct(new Student);
    }

    public function createStudent($data,$password, $file)
    {
        $data['password'] = bcrypt($password);
        $student = parent::create($data);

        $this->Upload_attachment($student->id, $file);
    }

    public function Delete_attachment($filename, $image_id)
    {
        $image = Image::find($image_id);
        if(File::exists(public_path($image->path))){
            File::delete(public_path($image->path));
        }

        if ($image->filename == $filename){
            $image->delete();
        }
    }

    public function Upload_attachment($id, $file)
    {
        $student = $this->findById($id);
        $path = $this->uplaod($file, 'attachments/students/' . $student->Name . '/');
        $name = $file->getClientOriginalName();

        Image::create([
            'filename' => $name,
            'path' => $path,
            'imageable_id' => $student->id,
            'imageable_type' => Student::class,
        ]);
    }
}

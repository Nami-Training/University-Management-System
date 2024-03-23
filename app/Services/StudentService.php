<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Student;
use App\Http\Trait\UploadImage;

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

        $this->uplaod($file);
        $name = $file->getClientOriginalName();

        // insert photo in image_table
        Image::create([
            'filename' => $name,
            'imageable_id' => $student->id,
            'imageable_type' => Student::class,
        ]);
    }

    public function deleteStudent()
    {
        // if($request->file('image')){
        //     File::delete(public_path($post->image));
        //     $post->update(['image' => $this->uplaod($request->file('image'))]);
        // }
    }

    public function Upload_attachment($id, $file)
    {
        $student = $this->findById($id);
        $this->uplaod($file);
        $name = $file->getClientOriginalName();

        Image::create([
            'filename' => $name,
            'imageable_id' => $student->id,
            'imageable_type' => Student::class,
        ]);
    }
}

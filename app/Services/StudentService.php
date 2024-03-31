<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Student;
use App\Http\Trait\FileHandling;
use Illuminate\Support\Facades\File;

class StudentService extends MainService
{
    use FileHandling;

    private $Student;

    public function __construct()
    {
        parent::__construct(new Student);
        $this->Student = new Student;
    }

    public function createStudent($data,$password, $file)
    {
        $data['password'] = bcrypt($password);
        $student = parent::create($data);

        $this->Upload_attachment($student->id, $file);
    }

    public function updateStudent($id, $data, $password)
    {
        $student = $this->findById($id);
        if ($student->password == $password){
            $student->update($data);
        }else{
            $data['password'] = bcrypt($password);
            $student->update($data);
        }
    }

    public function Delete_attachment($filename, $image_id)
    {
        $image = Image::find($image_id);
       $this->deleteFile($image->path);

        if ($image->filename == $filename){
            $image->delete();
        }
    }

    public function Upload_attachment($id, $file)
    {
        $student = $this->findById($id);
        $path = $this->uplaodFile($file, 'attachments/students/' . $student->Name . '/');
        $name = $file->getClientOriginalName();

        Image::create([
            'filename' => $name,
            'path' => $path,
            'imageable_id' => $student->id,
            'imageable_type' => Student::class,
        ]);
    }

    public function where($column, $value)
    {
        return $this->findByColumn($column, $value);

        return $this;
    }

    public function updateWhereIn($id, $ids, $data)
    {
        return $this->Student->whereIn($id, $ids)->update($data);
        return $this;
    }

    public function deleteWhereIn($id, $ids)
    {
        return $this->Student->whereIn($id, $ids)->delete();
        return $this;
    }

    public function onlyTrashed()
    {
        return $this->Student->onlyTrashed()->get();
    }
}

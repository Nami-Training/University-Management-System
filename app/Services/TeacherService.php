<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Teacher);
    }

    public function createTeacher($data, $password, $address)
    {
        $data['password'] = bcrypt($password);
        $data['Address'] = strtotime($address);
        return parent::create($data);
    }

    public function updateTeacher($id, $data, $password, $address)
    {
        $teacher = $this->findById($id);
        if($data['password'] != $teacher->password){
            $data['password'] = bcrypt($password);
        }
        $data['Address'] = strtotime($address);
        return $teacher->update($data);
    }
}

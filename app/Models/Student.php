<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['Name'];
    protected $fillable = ['email', 'password', 'gender_id', 'nationalitie_id', 'blood_id', 'date_birth', 'grade_id', 'classroom_id', 'section_id', 'academic_year'];
    public $timestamps = true;

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalitie_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'imageable_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class);
    }

    // public function attendance()
    // {
    //     return $this->hasMany(Attendance::class);
    // }
}

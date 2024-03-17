<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['Name'];
    protected $fillable = ['subject_id', 'grade_id', 'classroom_id', 'section_id', 'teacher_id'];
    public $timestamps = true;

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }



    public function subject()
    {
        return $this->belongsTo(Subject::class);
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['Name'];
    protected $fillable = ['email', 'password', 'Joining_Date', 'specialization_id', 'gender_id'];
    public $timestamps = true;


    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class,'teacher_section');
    }
}

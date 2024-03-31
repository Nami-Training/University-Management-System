<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeInvoice extends Model
{
    use SoftDeletes, HasEagerLimit;
    protected $fillable = ['amount', 'grade_id', 'classroom_id', 'description', 'student_id', 'fee_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }


    // public function section()
    // {
    //     return $this->belongsTo(Section::class);
    // }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}

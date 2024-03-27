<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentStudent extends Model
{
    use SoftDeletes, HasEagerLimit;

    protected $fillable = ['amount', 'student_id', 'description'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

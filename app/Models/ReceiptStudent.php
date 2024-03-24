<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiptStudent extends Model
{
    use SoftDeletes, HasEagerLimit;

    protected $fillable = ['Debit', 'description', 'date', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

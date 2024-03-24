<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class FeeTranslation extends Model
{
    use SoftDeletes, HasEagerLimit;

    protected $fillable = ['student_id', 'grade_id', 'classroom_id', 'fee_id', 'amount', 'description'];
    public $timestamps = true;
}

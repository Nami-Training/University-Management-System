<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['title', 'answers', 'right_answer'];
    protected $fillable=['score', 'quiz_id'];
    public $timestamps = true;

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

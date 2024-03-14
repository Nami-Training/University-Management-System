<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['Name'];
    protected $fillable=['Notes'];
    public $timestamps = true;


    public function Sections()
    {
        return $this->hasMany(Section::class);
    }
}

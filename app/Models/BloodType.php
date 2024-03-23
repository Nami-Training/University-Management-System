<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodType extends Model
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['Name'];
    public $timestamps = true;
}

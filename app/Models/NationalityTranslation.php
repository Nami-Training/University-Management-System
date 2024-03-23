<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalityTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['Name'];
}

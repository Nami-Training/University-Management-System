<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['Name', 'class_id'];
}

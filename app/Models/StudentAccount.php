<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['Debit', 'description', 'credit', 'date', 'receipt_id', 'type', 'student_id'];
}

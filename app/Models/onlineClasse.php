<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class onlineClasse extends Model
{
    use HasFactory;

    public $fillable = ['integration', 'grade_id', 'classroom_id', 'section_id', 'user_id', 'meeting_id', 'topic', 'start_at', 'duration', 'password', 'start_url', 'join_url'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

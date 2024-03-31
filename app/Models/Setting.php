<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HasEagerLimit;

    protected $fillable=['school_name', 'school_title', 'address','current_session', 'phone', 'school_email', 'end_first_term', 'end_second_term'];
    public $timestamps = true;

    public function image()
    {
        return $this->hasOne(Image::class, 'imageable_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irregular extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'istructor_id',
        'student_id',
        'section_id',
    ];
}

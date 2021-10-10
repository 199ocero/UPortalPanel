<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorSectionSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'instructor_id',
        'section_id',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function instructor(){
        return $this->belongsTo(User::class,'instructor_id','id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
}

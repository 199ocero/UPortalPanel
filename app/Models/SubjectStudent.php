<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_user_id',
        'instructor_subject_id',
    ];
    public function instructorSubjectId(){
        return $this->belongsTo(InstructorSubject::class,'instructor_subject_id','id');
    }


}

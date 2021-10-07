<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_user_id',
        'subject_id',
    ];
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}

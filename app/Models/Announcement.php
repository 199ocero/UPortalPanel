<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'deadline',
        'act_title',
        'instruction',
        'resources',
        'section_id',
        'subject_id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
     ];

     public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
}

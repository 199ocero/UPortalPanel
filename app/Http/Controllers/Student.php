<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\InstructorSectionSubject;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Student extends Controller
{
    public function viewAnnouncement(){
        $student = StudentSection::find(Auth::id());
        $announcement = Announcement::where('section_id',$student->section_id)->get();

        dd($announcement->toArray());
        // $subjectSection = InstructorSectionSubject::all();
        // return view('pages.student.view-announcement',compact('announcement'));
    }
}

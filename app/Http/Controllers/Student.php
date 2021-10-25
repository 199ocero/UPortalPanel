<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\InstructorSectionSubject;
use App\Models\Irregular;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Student extends Controller
{
    public function viewAnnouncement(){
        $student = StudentSection::where('student_id',Auth::id())->get()->toArray();
        $irregular = Irregular::where('student_id',Auth::id())->get()->toArray();
        $announcement= collect();
        $status = array();
        for($i=0;$i<count($student);$i++){
            $announce = Announcement::where('section_id',$student[$i]['section_id'])->get();

            for($x=0;$x<count($announce);$x++){
                $announcement->push($announce[$x]);
                $announces = Announcement::where('section_id',$student[$i]['section_id'])->get()->toArray();
                for($y=0;$y<count($irregular);$y++){
                    if($irregular[$y]['section_id']==$announces[0]['section_id'] && $irregular[$y]['subject_id']==$announces[0]['subject_id']){
                        array_push($status,'Irregular');
                        break;
                    }else{
                        array_push($status,'Regular');
                        break;
                    }
                }
            }
        }
        return view('pages.student.view-announcement',compact('announcement','status'));
    }
    public function viewAnnouncementDetails($id){
        $announcement = Announcement::find($id);
        return view('pages.student.details-announcement',compact('announcement'));
    }
}

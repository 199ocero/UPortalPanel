<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Drop;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Irregular;
use Illuminate\Http\Request;
use App\Models\StudentSection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\InstructorSectionSubject;

class Instructor extends Controller
{
    public function viewInstructorSectionSubject(){

        $subject = Subject::all();
        $section = Section::all();
        $assign = InstructorSectionSubject::where('instructor_id',Auth::id())->get();
        
        // dd($assign->toArray());
        return view('pages.instructor.view-assign-management',compact('assign','section','subject'));
    }
    public function viewAddInstructorSectionSubject(Request $request){
        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'section_id' => ['required','max:255'],
        ]);

        $assign = new InstructorSectionSubject();
        $assign->subject_id = $request->subject_id;
        $assign->instructor_id = Auth::id();
        $assign->section_id = $request->section_id;
        $assign->save();

        return redirect()->route('view.instructor.section.subject')->with('success','Assign Added Successfully!');
    }
    public function viewDetailsPageInstructorSectionSubject($section_id,$subject_id){
        $assign = StudentSection::where('section_id',$section_id)->get();
        
        $irregular = Irregular::all();
        // $irregular = Irregular::where('subject_id',$subject_id)->where('instructor_id',Auth::id())->where('section_id',$section_id)->get();
        $section = Section::find($section_id);
        $subject = Subject::find($subject_id);
        $drop = Drop::all();
        
        
        $student = $assign->toArray();
        $irregs = $irregular->toArray();
        $studs = array();

        for($i=0;$i<count($student);$i++){
            for($y=0;$y<count($irregs);$y++){
                if($student[$i]['student_id']==$irregs[$y]['student_id'] && $irregs[$y]['subject_id']!=$subject_id && $irregs[$y]['instructor_id']!=Auth::id() && $irregs[$y]['section_id']==$section_id){
                    array_push($studs, $i);
                    break;     
                }
            }
        }
        
        for($i=0;$i<count($studs);$i++){
            $assign->forget($studs[$i]);
        }
        $assign = $assign->values();
        $status = array();
        $student = $assign->toArray();
        $irregs = $irregular->toArray();
        $drops = $drop->toArray();


        
        for($i=0;$i<count($student);$i++){
            array_push($status, 'Regular');
        }

        
        
        for($i=0;$i<count($student);$i++){
            
            for($y=0;$y<count($irregs);$y++){
                if($student[$i]['student_id']==$irregs[$y]['student_id']){
                    if($student[$i]['section_id']==$irregs[$y]['section_id']){
                        $status[$i]='Irregular';
                        break;
                    }
                }
            }
        }
        for($i=0;$i<count($student);$i++){
            
            for($y=0;$y<count($drops);$y++){
                if($student[$i]['student_id']==$drops[$y]['student_id']){
                    if($student[$i]['section_id']==$drops[$y]['section_id']){
                        $status[$i]='Drop';
                        break;
                    }
                }
            }
        }
        
        // // // dd($status);
        return view('pages.instructor.details-management',compact('assign','section','subject','status'));
    }

    public function viewAddPageStudentSection($section_id,$subject_id){
        $subjectID = $subject_id;
        $sectionID = $section_id;
        $assign = User::whereRoleIs('student')->get();
        $studentSection = StudentSection::where('section_id',$section_id)->get();

        $assigns = $assign->toArray();
        $studentSections = $studentSection->toArray();
        $studentRemove = array();


        for($i=0;$i<count($studentSections);$i++){
            // array_push($studentRemove,$studentSections[$i]['student_id']);
            $remove = $studentSections[$i]['student_id'];
            $key = $assign->search(function($item,) use($remove){
                return $item->id == $remove;
            });
            $assign->pull($key);
            
        }
        
        
        
        $assign = $assign->values();

        
        return view('pages.instructor.create-student',compact('subjectID','sectionID','assign'));
    }
    public function viewAddStudentSection(Request $request, $section_id,$subject_id){
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required','unique:users','max:255'],
            'email' => ['required','unique:users','max:255']
        ]);

        $password = Carbon::now()->format('m-d-Y');
        $student = new User();
        $student->username = $request->username;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->password= Hash::make($password.'-'.$request->username);
        $student->save();
        $student->attachRole($request->role_id);

        $studentSection = new StudentSection();
        $studentSection->section_id=$section_id;
        $studentSection->student_id=$student->id;
        $studentSection->save();

        $irregular = new Irregular();
        $irregular->section_id=$section_id;
        $irregular->student_id=$student->id;
        $irregular->subject_id=$subject_id;
        $irregular->instructor_id=Auth::id();
        $irregular->save();


        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added Successfully!');
    }
    
    public function viewAddIrregularStudentSection($section_id,$subject_id,$id){

        $studentSection = new StudentSection();
        $studentSection->section_id=$section_id;
        $studentSection->student_id=$id;
        $studentSection->save();

        $irregular = new Irregular();
        $irregular->section_id=$section_id;
        $irregular->student_id=$id;
        $irregular->subject_id=$subject_id;
        $irregular->instructor_id=Auth::id();
        $irregular->save();
        
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added Successfully!');
    }

    public function viewEditStudentSection($student_id,$section_id){
        $student = User::find($student_id);
        $sectionID = $section_id;
        $studentSubject = InstructorSectionSubject::where('section_id', $section_id)->first();
        return view('pages.instructor.edit-student',compact('student','sectionID','studentSubject'));
    }
    public function viewUpdateStudentSection(Request $request, $student_id,$section_id){
        $student = User::find($student_id);
        $studentSubject = InstructorSectionSubject::where('section_id', $section_id)->first()->toArray();
        
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($student->id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($student->id),
            ],
        ]);
        $student->username = $request->username;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->update();

        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$studentSubject['subject_id'])->with('success','Student Updated Successfully!');
    }
    public function viewDeleteStudentSection($student_id,$section_id,$subject_id){
        StudentSection::where('student_id',$student_id)->delete();
        Irregular::where('student_id',$student_id)->delete();
        Drop::where('student_id',$student_id)->delete();
        User::find($student_id)->delete();


        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Deleted Successfully!');
    }
    public function viewDropStudentSection($student_id,$section_id,$subject_id){
        $drop = new Drop();
        $drop->student_id = $student_id;
        $drop->section_id = $section_id;
        $drop->save();

        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Drop Successfully!');
    }
    public function viewUndropStudentSection($student_id,$section_id,$subject_id){
        Drop::where('student_id',$student_id)->delete();
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added Successfully!');
    }
    public function viewDeleteInstructorSectionSubject($id,$section_id,$subject_id){
        InstructorSectionSubject::find($id)->delete();
        Announcement::where('section_id',$section_id)->where('subject_id',$subject_id)->delete();
        
        $student = Irregular::where('section_id',$section_id)->get()->toArray();

        for($i=0;$i<count($student);$i++){
            
            User::find($student[$i]['student_id'])->delete();
            Irregular::where('student_id',$student[$i]['student_id'])->delete();
            StudentSection::where('student_id',$student[$i]['student_id'])->delete();
        }
        return redirect()->route('view.instructor.section.subject')->with('success','Assign Deleted Successfully!');
    }

    public function viewRemoveIrregStudent($student_id,$section_id,$subject_id){
        Irregular::where('student_id',$student_id)->where('subject_id',$subject_id)->where('instructor_id',Auth::id())->where('section_id',$section_id)->delete();
        StudentSection::where('student_id',$student_id)->where('section_id',$section_id)->delete();
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Irregular Remove Successfully!');
    }

    //Announcement
    public function viewAnnouncement($section_id,$subject_id){
        $section_id = $section_id;
        $subject_id = $subject_id;
        $section = Section::find($section_id);
        $subject = Subject::find($subject_id);
        $announcement = Announcement::where('section_id',$section_id)->where('subject_id',$subject_id)->get();
        
        // dd($section->toArray());
        return view('pages.instructor.announcement.view-announcement',compact('section_id','subject_id','announcement','section','subject'));
    }
    public function viewAddPageAnnouncement($section_id,$subject_id){
        $section_id = $section_id;
        $subject_id = $subject_id;
        
        return view('pages.instructor.announcement.create-announcement',compact('section_id','subject_id'));
    }
    public function viewAddAnnouncement(Request $request,$section_id,$subject_id){
        $validateData = $request->validate([
            'deadline' => ['required'],
            'act_title' => ['required'],
            'instruction' => ['required'],
            'resources' => ['required'],
        ]);

        $announcement = new Announcement();
        $announcement->section_id = $section_id;
        $announcement->subject_id = $subject_id;
        $announcement->deadline = $request->deadline;
        $announcement->act_title = $request->act_title;
        $announcement->instruction = $request->instruction;
        $announcement->resources = $request->resources;
        $announcement->save();

        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Added Successfully!');
    }
    public function viewEditAnnouncement($id){
        $announcement = Announcement::find($id);
        return view('pages.instructor.announcement.edit-announcement',compact('announcement'));
    }
    public function viewUpdateAnnouncement(Request $request,$section_id,$subject_id,$id){
        $validateData = $request->validate([
            'deadline' => ['required'],
            'act_title' => ['required'],
            'instruction' => ['required'],
            'resources' => ['required'],
        ]);

        $announcement = Announcement::find($id);
        $announcement->deadline = $request->deadline;
        $announcement->act_title = $request->act_title;
        $announcement->instruction = $request->instruction;
        $announcement->resources = $request->resources;
        $announcement->update();

        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Updated Successfully!');
    }
    public function viewDeleteAnnouncement($section_id,$subject_id,$id){
        Announcement::find($id)->delete();
        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Deleted Successfully!');
    }


}

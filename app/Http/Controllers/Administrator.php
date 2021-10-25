<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Drop;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Irregular;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Imports\SubjectImport;
use App\Models\StudentSection;
use App\Models\SubjectStudent;
use Illuminate\Validation\Rule;
use App\Imports\InstructorImport;
use App\Models\InstructorSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\InstructorSectionSubject;

class Administrator extends Controller
{
    //Instructor
    public function viewInstructor(){
        $instructor = User::whereRoleIs('instructor')->get();
        return view('pages.admin.instructor.view-instructor',compact('instructor'));
    }
    public function viewAddPageInstuctor(){
        return view('pages.admin.instructor.create-instructor');
    }

    public function viewAddInstructor(Request $request){
        $id = Auth::user()->id;
        $instructor = User::find($id);

        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required','unique:users','max:255'],
            'email' => ['required','unique:users','max:255']
        ]);
        $password = Carbon::now()->format('m-d-Y');
        $instructor = new User();
        $instructor->username = $request->username;
        $instructor->first_name = $request->first_name;
        $instructor->middle_name = $request->middle_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->password= Hash::make($password.'-'.$request->username);
        $instructor->save();
        $instructor->attachRole($request->role_id);
        return redirect()->route('view.administrator.instructor')->with('success','Instructor Added Successfully!');
    }
    public function viewEditInstructor($id){
        $instructor = User::find($id);
        return view('pages.admin.instructor.edit-instructor',compact('instructor'));
    }

    public function viewUpdateInstructor(Request $request, $id){
        $instructor = User::find($id);
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($instructor->id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($instructor->id),
            ],
        ]);
        $instructor->username = $request->username;
        $instructor->first_name = $request->first_name;
        $instructor->middle_name = $request->middle_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->update();

        return redirect()->route('view.administrator.instructor')->with('success','Instructor Updated Successfully!');
    }
    public function viewDeleteInstructor($id){
        $instructor = User::find($id)->delete();
        return redirect()->route('view.administrator.instructor')->with('success','Instructor Deleted Successfully!');
    }

    //Instructor Excel File
    public function uploadExcelInstructor(Request $request){
        $file = $request->file('file');

        Excel::import(new InstructorImport,$file);

        return redirect()->route('view.administrator.instructor')->with('success','Instructor Added Successfully!');
    }

    //Student
    public function viewStudent(){
        $student = User::whereRoleIs('student')->get();
        return view('pages.admin.student.view-student',compact('student'));
    }
    public function viewAddPageStudent(){
        return view('pages.admin.student.create-student');
    }

    public function viewAddStudent(Request $request){
        $id = Auth::user()->id;
        $student = User::find($id);

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
        return redirect()->route('view.administrator.student')->with('success','Student Added Successfully!');
    }
    public function viewEditStudent($id){
        $student = User::find($id);
        return view('pages.admin.student.edit-student',compact('student'));
    }

    public function viewUpdateStudent(Request $request, $id){
        $student = User::find($id);
        
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

        return redirect()->route('view.administrator.student')->with('success','Student Updated Successfully!');
    }
    public function viewDeleteStudent($id){
        $student = User::find($id)->delete();
        return redirect()->route('view.administrator.student')->with('success','Student Deleted Successfully!');
    }

    //Student Excel File
    public function uploadExcelStudent(Request $request){
        $file = $request->file('file');

        Excel::import(new StudentImport,$file);

        return redirect()->route('view.administrator.student')->with('success','Student Added Successfully!');
    }

    //Subject
    public function viewSubject(){
        $subject = Subject::all();
        return view('pages.admin.subject.view-subject',compact('subject'));
    }

    public function viewAddSubject(Request $request){

        $validateData = $request->validate([
            'subject' => ['required','unique:subjects', 'max:255'],
        ]);
        $subject = new Subject();
        $subject->subject = $request->subject;
        $subject->save();

        return redirect()->route('view.administrator.subject')->with('success','Subject Added Successfully!');
    }
    public function viewEditSubject($id){
        $subject = Subject::find($id);
        return view('pages.admin.subject.edit-subject',compact('subject'));
    }

    public function viewUpdateSubject(Request $request, $id){
        $subject = Subject::find($id);
        
        $validateData = $request->validate([
            'subject' => [
                'required',
                Rule::unique('subjects')->ignore($subject->id),
            ],
        ]);
        $subject->subject = $request->subject;
        $subject->update();

        return redirect()->route('view.administrator.subject')->with('success','Subject Updated Successfully!');
    }
    public function viewDeleteSubject($id){
        $subject = Subject::find($id)->delete();
        return redirect()->route('view.administrator.subject')->with('success','Subject Deleted Successfully!');
    }

    public function uploadExcelSubject(Request $request){
        $file = $request->file('file');

        Excel::import(new SubjectImport,$file);

        return redirect()->route('view.administrator.subject')->with('success','Subject Added Successfully!');
    }

    //Section
    public function viewSection(){
        $studentSection = StudentSection::select('section_id')->groupBy('section_id')->get();
        return view('pages.admin.section.view-section',compact('studentSection'));
    }

    public function viewAddSection(Request $request){
        $validateData = $request->validate([
            'section' => ['required','unique:sections', 'max:255'],
            'file' => ['required'],
        ]);
        $student = User::whereRoleIs('student')->get();
        $file = $request->file('file');
        $studentList = (new StudentImport)->toArray($file);
        Excel::import(new StudentImport,$file);
        
        $studentSectionList = StudentSection::all();

        if($studentSectionList->isEmpty()){
            $section = new Section();
            $section->section = $request->section;
            $section->save();

            $student = User::whereRoleIs('student')->get();
            for($y=0;$y<count($studentList[0]);$y++){
                $studentSection = new StudentSection();
                $studentSection->section_id=$section->id;
                for($i=0;$i<count($student);$i++){
                    if($student[$i]['username']==$studentList[0][$y]['username']){
                        $studentSection->student_id=$student[$i]['id'];
                    }
                }
                
                $studentSection->save();
            }
            return redirect()->route('view.administrator.section')->with('success','Section and Student Added Successfully!');

        }
        else{
            $studentUsername = array();
            $studentUsernameF = array();
            for($y=0;$y<count($studentList[0]);$y++){

                array_push($studentUsernameF, $studentList[0][$y]['username']);
                for($i=0;$i<count($student);$i++){
                    if($student[$i]['username']==$studentList[0][$y]['username']){
                        array_push($studentUsername, $studentList[0][$y]['username']);
                    }
                }
            }
            $unique = array_diff($studentUsernameF,$studentUsername);
            $uniqueUsername = array_values($unique);
            // dd($studentUsernameF);

            if($unique==NULL){
                return redirect()->route('view.administrator.section')->with('failed','All of student records are already registerd!');
            }elseif(count($uniqueUsername)<count($studentUsernameF)){

                // dd($uniqueUsername[0]);
                $section = new Section();
                $section->section = $request->section;
                $section->save();

                $student = User::whereRoleIs('student')->get();

                for($y=0;$y<count($uniqueUsername);$y++){
                    
                    $studentSection = new StudentSection();
                    $studentSection->section_id=$section->id;
                    
                    for($i=0;$i<count($student);$i++){
                        if($student[$i]['username']==$uniqueUsername[$y]){
                            $studentSection->student_id=$student[$i]['id'];
                        }
                    }
                    $studentSection->save();
                }
                return redirect()->route('view.administrator.section')->with('success','Some of student records are already registerd!');
            }
            else{
                $section = new Section();
                $section->section = $request->section;
                $section->save();

                $student = User::whereRoleIs('student')->get();

                for($y=0;$y<count($studentList[0]);$y++){
                    $studentSection = new StudentSection();
                    $studentSection->section_id=$section->id;

                    for($i=0;$i<count($student);$i++){
                        if($student[$i]['username']==$studentList[0][$y]['username']){
                            $studentSection->student_id=$student[$i]['id'];
                        }
                    }
                    
                    $studentSection->save();
                }
                return redirect()->route('view.administrator.section')->with('success','Section and student registered successfully!');
            }
            
        }
    }
    public function viewEditSection($id){
        $section = Section::find($id);
        return view('pages.admin.section.edit-section',compact('section'));
    }

    public function viewUpdateSection(Request $request, $id){
        $section = Section::find($id);
        
        $validateData = $request->validate([
            'section' => [
                'required',
                Rule::unique('sections')->ignore($section->id),
            ],
        ]);
        $section->section = $request->section;
        $section->update();

        return redirect()->route('view.administrator.section')->with('success','Section Updated Successfully!');
    }
    public function viewDeleteSection($id){
        // $student = User::whereRoleIs('student')->get();
        $studentSection = StudentSection::orderBy('id','asc')->where('section_id', $id)->get();;

        foreach($studentSection as $studentSection){
            User::find($studentSection->student_id)->delete();
        }
        Section::find($id)->delete();
        StudentSection::where('section_id',$id)->delete();
        return redirect()->route('view.administrator.section')->with('success','Section Deleted Successfully!');
    }

    public function viewDetailSection($id){
        $assign = StudentSection::where('section_id',$id)->get();
        $section = Section::find($id);
        $drop = Drop::all();
        $irregular = Irregular::all();


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

        return view('pages.admin.section.details-section',compact('section','assign','status'));
    }

    public function viewAddPageStudentSection($id){
        $subjectID = $id;
        return view('pages.admin.section.create-student',compact('subjectID'));
    }
    public function viewAddStudentSection(Request $request, $id){
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
        $studentSection->section_id=$id;
        $studentSection->student_id=$student->id;
        $studentSection->save();

        return redirect()->route('view.details.section',$id)->with('success','Student Added Successfully!');
    }

    public function viewEditStudentSection($id){
        $student = User::find($id);
        // $studentSection = StudentSection::where('student_id',$id);
        $studentSection = StudentSection::where('student_id', $id)->first();
        
        // dd($studentSection->toArray());
        return view('pages.admin.section.edit-student',compact('student','studentSection'));
    }
    public function viewUpdateStudentSection(Request $request, $id){
        $student = User::find($id);
        
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

        return redirect()->route('view.details.section',$request->section_id)->with('success','Student Updated Successfully!');
    }   

    public function viewDeleteStudentSection($id){
        $studentSection = StudentSection::where('student_id',$id)->first();
        StudentSection::where('student_id',$id)->delete();
        User::find($id)->delete();
        Irregular::find($id)->delete();
        return redirect()->route('view.details.section',$studentSection->section_id)->with('success','Student Updated Successfully!');
    }

    //Assign Subject->Instructor
    public function viewAssignSubjectInstructor(){
        $assign = InstructorSubject::select('subject_id')->groupBy('subject_id')->get();
        return view('pages.admin.assign.subject-instructor.view-subject-instructor',compact('assign'));
    }

    public function viewAddPageSubjectInstuctor(){
        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        return view('pages.admin.assign.subject-instructor.create-subject-instructor',compact('subject','instructor'));
    }

    public function viewAddSubjectInstructor(Request $request){

        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'instructor_id' => ['required','max:255'],
        ]);

        $countInstructor = count($request->instructor_id);
        if($countInstructor != NULL){
            for($i=0;$i<$countInstructor;$i++){
                $instructorSubject = new InstructorSubject();
                $instructorSubject->subject_id=$request->subject_id;
                $instructorSubject->role_user_id=$request->instructor_id[$i];
                $instructorSubject->save();
            }
        }
        return redirect()->route('view.administrator.assign.subject.instructor')->with('success','Assign Added Successfully!');
    }

    public function viewEditSubjectInstructor($id){
        $assign = InstructorSubject::where('subject_id',$id)->get();

        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        return view('pages.admin.assign.subject-instructor.edit-subject-instructor',compact('subject','instructor','assign'));

    }

    public function viewUpdateSubjectInstructor(Request $request, $id){
        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'instructor_id' => ['required','max:255'],
        ]);

        

        $countInstructor = count($request->instructor_id);
        InstructorSubject::where('subject_id',$id)->delete();
        if($countInstructor != NULL){
            for($i=0;$i<$countInstructor;$i++){
                $instructorSubject = new InstructorSubject();
                $instructorSubject->subject_id=$request->subject_id;
                $instructorSubject->role_user_id=$request->instructor_id[$i];
                $instructorSubject->save();
            }
        }
        return redirect()->route('view.administrator.assign.subject.instructor')->with('success','Assign Updated Successfully!');
    }

    public function viewDeleteSubjectInstructor($id){
        InstructorSubject::where('subject_id',$id)->delete();
        return redirect()->route('view.administrator.assign.subject.instructor')->with('success','Assign Deleted Successfully!');
    }

    public function viewDetailsPageSubjectInstuctor($id){
        $assign = InstructorSubject::where('subject_id',$id)->get();
        $subject = Subject::find($id);

        return view('pages.admin.assign.subject-instructor.details-subject-instructor',compact('assign','subject'));
    }

    //Assign Subject->Student
    public function viewAssignStudentSubject(){
        $assign = SubjectStudent::select('instructor_subject_id')->groupBy('instructor_subject_id')->get();
        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        
        $subjectName = array();
        $instructorName= array();
        $instructorSubject = InstructorSubject::all();
        for($i=0;$i<count($assign);$i++){
            for($j=0;$j<count($instructorSubject);$j++){
                if($assign[$i]['instructor_subject_id']==$instructorSubject[$j]['id']){
                    for($x=0;$x<count($subject);$x++){
                        if($instructorSubject[$j]['subject_id']==$subject[$x]['id']){
                            array_push($subjectName, $subject[$x]['subject']);
                        }
                    }
                    for($x=0;$x<count($instructor);$x++){
                        if($instructorSubject[$j]['role_user_id']==$instructor[$x]['id']){
                            array_push($instructorName, $instructor[$x]['first_name'].' '.$instructor[$x]['last_name']);
                        }
                    }
                }
            }
        }

        // dd($instructorName);
        return view('pages.admin.assign.student-subject.view-student-subject',compact('assign','subjectName','instructorName'));
    }

    public function viewAddPageStudentSubject(){
        $student = User::whereRoleIs('student')->get();
        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        
        $subjectName = array();
        $instructorName= array();
        $instructorSubject = InstructorSubject::all();
        for($i=0;$i<count($instructorSubject);$i++){
            for($x=0;$x<count($subject);$x++){
                if($instructorSubject[$i]['subject_id']==$subject[$x]['id']){
                    
                    for($j=0;$j<count($instructor);$j++){
                        if($instructorSubject[$i]['role_user_id']==$instructor[$j]['id']){
                            array_push($subjectName, $subject[$x]['subject']);
                            array_push($instructorName, $instructor[$j]['first_name'].' '.$instructor[$x]['last_name']);
                        }
                    }
                }
            }
            
        }

        // dd($instructorName);
        return view('pages.admin.assign.student-subject.create-student-subject',compact('subjectName','instructorName','instructorSubject','student'));
    }

    public function viewAddStudentSubject(Request $request){

        $validateData = $request->validate([
            'instructor_subject_id' => ['required','max:255'],
            'student_id' => ['required','max:255'],
        ]);

        $countStudent = count($request->student_id);
        if($countStudent != NULL){
            for($i=0;$i<$countStudent;$i++){
                $instructorSubject = new SubjectStudent();
                $instructorSubject->instructor_subject_id=$request->instructor_subject_id;
                $instructorSubject->role_user_id=$request->student_id[$i];
                $instructorSubject->save();
            }
        }
        return redirect()->route('view.administrator.assign.subject.student')->with('success','Assign Added Successfully!');
    }

    public function viewEditStudentSubject($id){
        $student = User::whereRoleIs('student')->get();
        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        $studentSubject = SubjectStudent::all();


        $subjectName = array();
        $instructorName= array();
        $instructorSubject = InstructorSubject::all();
        for($i=0;$i<count($instructorSubject);$i++){
            for($x=0;$x<count($subject);$x++){
                if($instructorSubject[$i]['subject_id']==$subject[$x]['id']){
                    
                    for($j=0;$j<count($instructor);$j++){
                        if($instructorSubject[$i]['role_user_id']==$instructor[$j]['id']){
                            array_push($subjectName, $subject[$x]['subject']);
                            array_push($instructorName, $instructor[$j]['first_name'].' '.$instructor[$x]['last_name']);
                        }
                    }
                }
            }
            
        }

        $instructorSubjectFind = InstructorSubject::find($id);
        // dd($instructorSubject->toArray());
        return view('pages.admin.assign.student-subject.edit-student-subject',compact('subjectName','instructorName','instructorSubject','student','instructorSubjectFind','studentSubject'));

    }

    public function viewUpdateStudentSubject(Request $request, $id){
        $validateData = $request->validate([
            'instructor_subject_id' => ['required','max:255'],
            'student_id' => ['required','max:255'],
        ]);
        SubjectStudent::where('instructor_subject_id',$id)->delete();
        $countStudent = count($request->student_id);
        if($countStudent != NULL){
            for($i=0;$i<$countStudent;$i++){
                $instructorSubject = new SubjectStudent();
                $instructorSubject->instructor_subject_id=$request->instructor_subject_id;
                $instructorSubject->role_user_id=$request->student_id[$i];
                $instructorSubject->save();
            }
        }
        return redirect()->route('view.administrator.assign.subject.student')->with('success','Assign Updated Successfully!');
    }

    public function viewDeleteStudentSubject($id){
        SubjectStudent::where('instructor_subject_id',$id)->delete();
        return redirect()->route('view.administrator.assign.subject.student')->with('success','Assign Deleted Successfully!');
    }

    public function viewDetailsPageStudentSubject($id){
        $student = User::whereRoleIs('student')->get();
        $instructor = User::whereRoleIs('instructor')->get();
        $subject = Subject::all();
        $studentSubject = SubjectStudent::all();


        $subjectName = array();
        $instructorName= array();
        $instructorSubject = InstructorSubject::all();
        for($i=0;$i<count($instructorSubject);$i++){
            for($x=0;$x<count($subject);$x++){
                if($instructorSubject[$i]['subject_id']==$subject[$x]['id']){
                    
                    for($j=0;$j<count($instructor);$j++){
                        if($instructorSubject[$i]['role_user_id']==$instructor[$j]['id']){
                            array_push($subjectName, $subject[$x]['subject']);
                            array_push($instructorName, $instructor[$j]['first_name'].' '.$instructor[$x]['last_name']);
                        }
                    }
                }
            }
            
        }

        return view('pages.admin.assign.subject-instructor.details-subject-instructor',compact('assign','subject'));
    }

    //Assign Management
    public function viewAssignInstructorSectionSection(){
        $assign = InstructorSectionSubject::all();
        return view('pages.admin.assign.instructor-section-subject.view-instructor-section-subject',compact('assign'));
    }
    public function viewAddPageInstructorSectionSection(){
        $instructor = User::whereRoleIs('instructor')->get();
        $section = Section::all();
        $subject = Subject::all();
        return view('pages.admin.assign.instructor-section-subject.create-instructor-section-subject',compact('instructor','section','subject'));
    }
    public function viewAddInstructorSectionSection(Request $request){
        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'instructor_id' => ['required','max:255'],
            'section_id' => ['required','max:255'],
        ]);
        $assign = new InstructorSectionSubject();
        $assign->subject_id = $request->subject_id;
        $assign->instructor_id = $request->instructor_id;
        $assign->section_id = $request->section_id;
        $assign->save();

        return redirect()->route('view.administrator.assign.instructor.section.subject')->with('success','Assign Added Successfully!');
    }

    public function viewEditInstructorSectionSection($id){
        $assign = InstructorSectionSubject::find($id);
        $instructor = User::whereRoleIs('instructor')->get();
        $section = Section::all();
        $subject = Subject::all();

        return view('pages.admin.assign.instructor-section-subject.edit-instructor-section-subject',compact('instructor','section','subject','assign'));
    }

    public function viewUpdateInstructorSectionSection(Request $request, $id){
        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'instructor_id' => ['required','max:255'],
            'section_id' => ['required','max:255'],
        ]);
        $assign = InstructorSectionSubject::find($id);
        $assign->subject_id = $request->subject_id;
        $assign->instructor_id = $request->instructor_id;
        $assign->section_id = $request->section_id;
        $assign->update();

        return redirect()->route('view.administrator.assign.instructor.section.subject')->with('success','Assign Updated Successfully!');
    }
    
    public function viewDeleteInstructorSectionSection($id){
        InstructorSectionSubject::find($id)->delete();
        return redirect()->route('view.administrator.assign.instructor.section.subject')->with('success','Assign Deleted Successfully!');
    }

}

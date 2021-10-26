<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\Instructor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator;
use App\Http\Controllers\SuperAdministrator;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get', 'post'], '/botman', 'BotManController@handle');

//Chatbot
Route::post('/botman', function () {
    app('botman')->listen();
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth', 'role:superadministrator']], function() { 
    Route::prefix('super')->group(function(){
        //View
        Route::get('/administrator/view',[SuperAdministrator::class,'viewAdministrator'])->name('view.super.administrator');
        Route::get('/administrator/add/view',[SuperAdministrator::class,'viewAddPageAdmin'])->name('view.super.administrator.add');

        //CRUD
        Route::post('/administrator/add',[SuperAdministrator::class,'viewAddAdmin'])->name('view.super.add.admin');
        Route::get('/administrator/edit/{id}',[SuperAdministrator::class,'viewEditAdmin'])->name('view.super.edit.admin');
        Route::post('/administrator/update/{id}',[SuperAdministrator::class,'viewUpdateAdmin'])->name('view.super.update.admin');
        Route::get('/administrator/delete/{id}',[SuperAdministrator::class,'viewDeleteAdmin'])->name('view.super.delete.admin');
    });
});

Route::group(['middleware' => ['auth', 'role:administrator']], function() { 
    Route::prefix('administrator')->group(function(){

        //View-Instructor
        Route::get('/instructor/view',[Administrator::class,'viewInstructor'])->name('view.administrator.instructor');
        Route::get('/instructor/add/view',[Administrator::class,'viewAddPageInstuctor'])->name('view.instructor.add');

        //CRUD-Instructor
        Route::post('/instructor/add',[Administrator::class,'viewAddInstructor'])->name('view.add.instructor');
        Route::get('/instructor/edit/{id}',[Administrator::class,'viewEditInstructor'])->name('view.edit.instructor');
        Route::post('/instructor/update/{id}',[Administrator::class,'viewUpdateInstructor'])->name('view.update.instructor');
        Route::get('/instructor/delete/{id}',[Administrator::class,'viewDeleteInstructor'])->name('view.delete.instructor');

        //Instructor Excel
        Route::post('/instructor/excel',[Administrator::class,'uploadExcelInstructor']);

        //View-Student
        Route::get('/student/view',[Administrator::class,'viewStudent'])->name('view.administrator.student');
        Route::get('/student/add/view',[Administrator::class,'viewAddPageStudent'])->name('view.student.add');

        //CRUD-Student
        Route::post('/student/add',[Administrator::class,'viewAddStudent'])->name('view.add.student');
        Route::get('/student/edit/{id}',[Administrator::class,'viewEditStudent'])->name('view.edit.student');
        Route::post('/student/update/{id}',[Administrator::class,'viewUpdateStudent'])->name('view.update.student');
        Route::get('/student/delete/{id}',[Administrator::class,'viewDeleteStudent'])->name('view.delete.student');

        //Student Excel
        Route::post('/student/excel',[Administrator::class,'uploadExcelStudent']);

        //View-Subject
        Route::get('/subject/view',[Administrator::class,'viewSubject'])->name('view.administrator.subject');

        //CRUD-Subject
        Route::post('/subject/add',[Administrator::class,'viewAddSubject'])->name('view.add.subject');
        Route::get('/subject/edit/{id}',[Administrator::class,'viewEditSubject'])->name('view.edit.subject');
        Route::post('/subject/update/{id}',[Administrator::class,'viewUpdateSubject'])->name('view.update.subject');
        Route::get('/subject/delete/{id}',[Administrator::class,'viewDeleteSubject'])->name('view.delete.subject');

        //Instructor Excel
        Route::post('/subject/excel',[Administrator::class,'uploadExcelSubject']);
        
        //View-Section
        Route::get('/section/view',[Administrator::class,'viewSection'])->name('view.administrator.section');

        //CRUD-Section
        Route::post('/section/add',[Administrator::class,'viewAddSection'])->name('view.add.section');
        Route::get('/section/edit/{id}',[Administrator::class,'viewEditSection'])->name('view.edit.section');
        Route::post('/section/update/{id}',[Administrator::class,'viewUpdateSection'])->name('view.update.section');
        Route::get('/section/delete/{id}',[Administrator::class,'viewDeleteSection'])->name('view.delete.section');
        Route::get('/section/details/{id}',[Administrator::class,'viewDetailSection'])->name('view.details.section');
        Route::get('/section/add/student/{id}',[Administrator::class,'viewAddPageStudentSection'])->name('view.student.section');
        Route::post('/section/add-student/{id}',[Administrator::class,'viewAddStudentSection'])->name('view.student.add.section');
        Route::get('/section/edit-student/{id}',[Administrator::class,'viewEditStudentSection'])->name('view.student.edit.section');
        Route::post('/section/update-student/{id}',[Administrator::class,'viewUpdateStudentSection'])->name('view.student.update.section');
        Route::get('/section/delete-student/{id}',[Administrator::class,'viewDeleteStudentSection'])->name('view.student.delete.section');
        

        //View-Assign Subject->Instructor
        Route::get('/assign/subject-instructor/view',[Administrator::class,'viewAssignSubjectInstructor'])->name('view.administrator.assign.subject.instructor');
        Route::get('/assign/add/subject-instructor/view',[Administrator::class,'viewAddPageSubjectInstuctor'])->name('view.assign.subject.instructor.add');
        

        //CRUD-Section
        Route::post('/assign/subject-instructor/add',[Administrator::class,'viewAddSubjectInstructor'])->name('view.add.subject.instructor');
        Route::get('/assign/subject-instructor/edit/{id}',[Administrator::class,'viewEditSubjectInstructor'])->name('view.edit.subject.instructor');
        Route::post('/assign/subject-instructor/update/{id}',[Administrator::class,'viewUpdateSubjectInstructor'])->name('view.update.subject.instructor');
        Route::get('/assign/subject-instructor/delete/{id}',[Administrator::class,'viewDeleteSubjectInstructor'])->name('view.delete.subject.instructor');
        Route::get('/assign/subject-instructor/details/{id}',[Administrator::class,'viewDetailsPageSubjectInstuctor'])->name('view.details.subject.instructor');

        //View-Assign Subject->Instructor
        Route::get('/assign/student-subject/view',[Administrator::class,'viewAssignStudentSubject'])->name('view.administrator.assign.subject.student');
        Route::get('/assign/add/student-subject/view',[Administrator::class,'viewAddPageStudentSubject'])->name('view.assign.subject.student.add');
        

        //CRUD-Section
        Route::post('/assign/student-subject/add',[Administrator::class,'viewAddStudentSubject'])->name('view.add.subject.student');
        Route::get('/assign/student-subject/edit/{id}',[Administrator::class,'viewEditStudentSubject'])->name('view.edit.subject.student');
        Route::post('/assign/student-subject/update/{id}',[Administrator::class,'viewUpdateStudentSubject'])->name('view.update.subject.student');
        Route::get('/assign/student-subject/delete/{id}',[Administrator::class,'viewDeleteStudentSubject'])->name('view.delete.subject.student');
        Route::get('/assign/student-subject/details/{id}',[Administrator::class,'viewDetailsPageStudentSubject'])->name('view.details.subject.student');

        //Assign Management
        
        //View-Assign Subject->Instructor->Section
        Route::get('/assign/instructor-section-subject/view',[Administrator::class,'viewAssignInstructorSectionSection'])->name('view.administrator.assign.instructor.section.subject');
        Route::get('/assign/add/instructor-section-subject/view',[Administrator::class,'viewAddPageInstructorSectionSection'])->name('view.assign.subject.student.add');
        

        //CRUD-Subject->Instructor->Section
        Route::post('/assign/instructor-section-subject/add',[Administrator::class,'viewAddInstructorSectionSection'])->name('view.add.instructor.section.subject');
        Route::get('/assign/instructor-section-subject/edit/{id}',[Administrator::class,'viewEditInstructorSectionSection'])->name('view.edit.instructor.section.subject');
        Route::post('/assign/instructor-section-subject/update/{id}',[Administrator::class,'viewUpdateInstructorSectionSection'])->name('view.update.instructor.section.subject');
        Route::get('/assign/instructor-section-subject/delete/{id}',[Administrator::class,'viewDeleteInstructorSectionSection'])->name('view.delete.instructor.section.subject');
        Route::get('/assign/instructor-section-subject/details/{id}',[Administrator::class,'viewDetailsPageInstructorSectionSection'])->name('view.details.instructor.section.subject');
    });
});

Route::group(['middleware' => ['auth', 'role:instructor']], function() { 
    Route::prefix('instructor')->group(function(){
        //View
        Route::get('assign/section-subject/view',[Instructor::class,'viewInstructorSectionSubject'])->name('view.instructor.section.subject');

        //View-Subject->Instructor->Section
        Route::get('/assign/section-subject/delete/{id}/{section_id}/{subject_id}',[Instructor::class,'viewDeleteInstructorSectionSubject'])->name('view.delete.instructor.section.subject');
        Route::get('/assign/section-subject/details/{section_id}/{subject_id}',[Instructor::class,'viewDetailsPageInstructorSectionSubject'])->name('view.details.instructor.section.subject');


        //CRUD-Student
        Route::get('/section/add/student/{section_id}/{subject_id}',[Instructor::class,'viewAddPageStudentSection'])->name('view.instructor.student.section');
        Route::post('/section/add-student/{section_id}/{subject_id}',[Instructor::class,'viewAddStudentSection'])->name('view.instructor.student.add.section');
        Route::get('/section/edit-student/{student_id}/{section_id}',[Instructor::class,'viewEditStudentSection'])->name('view.instructor.student.edit.section');
        Route::post('/section/update-student/{student_id}/{section_id}',[Instructor::class,'viewUpdateStudentSection'])->name('view.instructor.student.update.section');
        Route::get('/section/delete-student/{student_id}/{section_id}/{subject_id}',[Instructor::class,'viewDeleteStudentSection'])->name('view.instructor.student.delete.section');
        Route::get('/section/drop-student/{student_id}/{section_id}/{subject_id}',[Instructor::class,'viewDropStudentSection'])->name('view.instructor.student.drop.section');
        Route::get('/section/undrop-student/{student_id}/{section_id}/{subject_id}',[Instructor::class,'viewUndropStudentSection'])->name('view.instructor.student.undrop.section');
        Route::get('/section/add-irregular/{section_id}/{subject_id}/{id}',[Instructor::class,'viewAddIrregularStudentSection'])->name('view.instructor.student.add.irregular.section');
        Route::post('/section/add-student/',[Instructor::class,'viewAddInstructorSectionSubject'])->name('view.add.instructor.section.subject');
        Route::get('/section/remove-student/{student_id}/{section_id}/{subject_id}',[Instructor::class,'viewRemoveIrregStudent']);
        //View Announcement
        Route::get('/announcement/view/{section_id}/{subject_id}',[Instructor::class,'viewAnnouncement'])->name('view.announcement');

        //CRUD Announcement
        Route::get('/announcement/add/view/{section_id}/{subject_id}',[Instructor::class,'viewAddPageAnnouncement'])->name('view.add.page.announcement');
        Route::post('/announcement/add/{section_id}/{subject_id}',[Instructor::class,'viewAddAnnouncement'])->name('view.add.announcement');
        Route::get('/announcement/edit/{id}',[Instructor::class,'viewEditAnnouncement'])->name('view.edit.announcement');
        Route::post('/announcement/update/{section_id}/{subject_id}/{id}',[Instructor::class,'viewUpdateAnnouncement'])->name('view.update.announcement');
        Route::get('/announcement/delete/{section_id}/{subject_id}/{id}',[Instructor::class,'viewDeleteAnnouncement'])->name('view.delete.announcement');
    });
});

Route::group(['middleware' => ['auth', 'role:student']], function() { 
    Route::prefix('student')->group(function(){
        

        //CRUD Announcement
        Route::get('/announcement/view/',[Student::class,'viewAnnouncement'])->name('view.announcement');
        Route::get('/announcement/details/{id}',[Student::class,'viewAnnouncementDetails'])->name('view.announcement.details');
    });
});

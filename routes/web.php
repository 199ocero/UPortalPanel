<?php

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


        //View-Section
        Route::get('/section/view',[Administrator::class,'viewSection'])->name('view.administrator.section');

        //CRUD-Section
        Route::post('/section/add',[Administrator::class,'viewAddSection'])->name('view.add.section');
        Route::get('/section/edit/{id}',[Administrator::class,'viewEditSection'])->name('view.edit.section');
        Route::post('/section/update/{id}',[Administrator::class,'viewUpdateSection'])->name('view.update.section');
        Route::get('/section/delete/{id}',[Administrator::class,'viewDeleteSection'])->name('view.delete.section');


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
    });
});

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdministrator extends Controller
{
    public function viewAdministrator(){
        $admin = User::whereRoleIs('administrator')->get();
        return view('pages.superadmin.view-admin',compact('admin'));
    }
    public function viewAddPageAdmin(){
        return view('pages.superadmin.create-admin');
    }
    public function viewAddAdmin(Request $request){

        $id = Auth::user()->id;
        $admin = User::find($id);
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required','unique:users','max:255'],
            'email' => ['required','unique:users','max:255']
        ]);
        $password = Carbon::now()->format('m-d-Y');
        $admin = new User();
        $admin->username = $request->username;
        $admin->first_name = $request->first_name;
        $admin->middle_name = $request->middle_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->password= Hash::make($password.'-'.$request->username);
        $admin->save();
        $admin->attachRole($request->role_id);
        return redirect()->route('view.super.administrator')->with('success','Admin Added Successfully!');
    }

    public function viewEditAdmin($id){
        $admin = User::find($id);
        return view('pages.superadmin.edit-admin',compact('admin'));
    }

    public function viewUpdateAdmin(Request $request, $id){
        $admin = User::find($id);
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($admin->id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($admin->id),
            ],
        ]);
        $admin->username = $request->username;
        $admin->first_name = $request->first_name;
        $admin->middle_name = $request->middle_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->update();

        return redirect()->route('view.super.administrator')->with('success','Admin Updated Successfully!');
    }
    public function viewDeleteAdmin($id){
        $admin = User::find($id)->delete();
        return redirect()->route('view.super.administrator')->with('success','Admin Deleted Successfully!');
    }

   
}

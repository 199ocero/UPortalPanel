<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class StudentImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;
    public function model(array $row)
    {
        $password = Carbon::now()->format('m-d-Y');
        $user= User::create([
            'username'=>$row['username'],
            'first_name'=>$row['first_name'],
            'middle_name'=>$row['middle_name'],
            'last_name'=>$row['last_name'],
            'email'=>$row['email'],
            'password'=>Hash::make($password.'-'.$row['username']),
        ]);
        $user->attachRole('student');
        return $user;
    }
    public function rules():array{
        return [
            '*.first_name' => ['required', 'max:255'],
            '*.middle_name' => ['required', 'max:255'],
            '*.last_name' => ['required', 'max:255'],
            '*.username' => ['required','unique:users','max:255'],
            '*.email' => ['required','unique:users','max:255']
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        
    }

}

<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class SubjectImport implements ToModel,WithValidation,SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;
    

    public function model(array $row)
    {
        return new Subject([
        'subject'  => $row[0],
        ]);
        
    }
    public function rules():array{
        return [
            '0' => ['required','unique:subjects,subject','max:255'],
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        
    }
}

<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    public function view() : View
     {
        return view('exports.students',[
            'students' => Student::with(['user', 'province', 'city','companyProvince'])->get()
        ]);
    }
}

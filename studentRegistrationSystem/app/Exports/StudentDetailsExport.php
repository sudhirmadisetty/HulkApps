<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\StudentVerify;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class StudentDetailsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::Select('id','name','email','date_of_birth','address','created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Date of Birth', 'Address', 'Created at','Created at format'
        ];
    }

}

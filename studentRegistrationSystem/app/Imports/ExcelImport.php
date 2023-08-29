<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Student;
use App\Models\StudentVerify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ExcelImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $finalData = [];

        foreach ($rows as $row)
        {
            $dobParsed = date('Y-m-d', strtotime($row['dob']));

            $validator = Validator::make($row->toArray(), [
                'name' => 'required',
                'email' => 'required|email|unique:students_details,email',
                'dob' => 'required|date_format:Y-m-d',
                'address' => 'required',
            ],
            [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email address is already taken.',
                'dob.required' => 'Date of Birth is required.',
                'dob.date_format' => 'Date of Birth must be in the format YYYY-MM-DD.',
                'address.required' => 'Address is required.',
            ]);

            if ($validator->fails()) 
            {
                $validationErrors[] = $validator->errors()->all();
                continue;
            }

            if (!empty($validationErrors)) 
            {
                return redirect()->back()->withErrors($validationErrors)->withInput();
            }

            $student = Student::create([
                'name' => $row["name"],
                'email' => $row["email"],
               
                'date_of_birth' => Carbon::createFromFormat('Y-m-d', $dobParsed),

                'address' => $row['address'],
            ]);

            $admin_id = User::where('role', 'admin')->pluck('id')->first();

            $student_verify = StudentVerify::create([
                'student_id' => $student->id,
                'status' => false,
                'admin_id' => $admin_id,
            ]);

            array_push($finalData, $student);
        }

        session()->flash('validationErrors', $validationErrors);
    }
}

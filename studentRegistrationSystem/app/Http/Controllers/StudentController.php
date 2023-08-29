<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentVerify;
use Exception;
use App\Http\Requests\StudentFormRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Exports\StudentDetailsExport;

class StudentController extends Controller
{
    //view the students page
    public function viewStudentPage()
    { 
        $admin = User::where('role','admin')->get();
        $student = User::where('role','student')->get();
        
        $student_reg = Student::with('verification')->get();
      
        return view('student', compact('student','admin','student_reg'));
    }

    //add data to students table as well as studnet verification table 
    public function createStudentRegistration(Request $request)
    {
        $admin_id = User::where('role','admin')->pluck('id')->first();
        if(empty($admin_id)) {
            return redirect()->back()->withError('No admin is added in the platform yet');
        }

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->dob,
            'photo' => $request->photo,
            'address' => $request->address,
        ]);

        $student_verify = StudentVerify::create([
            'student_id'=>$student->id,
            'status'=>false,
            'admin_id'=>$admin_id,
        ]);

        return redirect()->back()->withSuccess('Great! Student Registered Successfully');
    }

    public function bulkUploadStudentRegistration(Request $request)
    {
        $import = new ExcelImport();
        Excel::import($import, $request->file('excel_file'));

        $validationErrors = session('validationErrors');
        
        if (!empty($validationErrors)) {
            $errorMessages = implode('<br>', $validationErrors[0]);
            return redirect()->back()->withError($errorMessages);
        } else {
            return redirect()->back()->withSuccess('Excel file data has been imported');
        }
    
        return redirect()->back();
    }

    //edit the student registration form
    public function editStudentRegistration(Request $request)
    {

        $update_form = [
            'id'=>$request->id,
            'name'=>$request->name,
            'email' => $request->email,
            'date_of_birth' => $request->dob,
            'photo' => $request->photo,
            'address' => $request->address,
        ];

        Student::where('id',$request->id)->update($update_form);

        return back()->withSuccess('Great! Data Updated Successfully');
    }

    //export the student data
    public function exportStudents()
    {
        return Excel::download(new StudentDetailsExport(), 'student_details.xlsx');
    }
}

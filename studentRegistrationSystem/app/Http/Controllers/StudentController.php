<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Student;

class StudentController extends Controller
{
    //view the students page
    public function viewStudentPage()
    { 
        $admin = User::where('role','admin')->get();
        $student = User::where('role','student')->get();
        
        $student_reg = Student::get();

        return view('student', compact('student','admin','student_reg'));
    }

    //add data to students table
    public function createStudentRegistration(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->dob,
            'photo' => $request->photo,
            'address' => $request->address,
        ]);

        return redirect()->back()->withSuccess('Great! You have Successfully Registered');
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
}

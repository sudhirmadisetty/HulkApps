<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Student;

class DashboardController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function viewDashboard()
    {
        $admin = User::where('role','admin')->get();
        $student = User::where('role','student')->get();
        
        $student_reg = Student::get();

        return view('dashboard-page', compact('student','admin','student_reg'));
    }
}

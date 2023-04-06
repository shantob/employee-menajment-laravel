<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $data['attendance'] = Attendance::todaysAttendanceByUser(Auth::id())->first();
        
        return view('dashboard', compact('data'));
    }
}

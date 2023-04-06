<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendenceRequest;
use App\Models\Attendance;
use App\Models\AttendanceReport;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceController extends Controller
{
    public function index(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $month = $request->month;
        $type = $request->type;

        $attendences = Attendance::query();

        if ($date_from && $date_to) {
            $attendences->whereBetween('created_at', [$date_from, $date_to])->get();
        }
        else{
            $attendences->whereDate('date', date('Y-m-d'));
        }

        if ($month) {
            $attendences->where('created_at', 'LIKE', $month . '%')->get();
        }

        if (Auth::user()->role == User::EMPLOYEE) {
            $attendences->where('user_id', Auth::user()->id);
        }

        $attendences = $attendences->with('user')->paginate(15);
       
        return view('attendences.index', compact('attendences'));
    }


    public function create()
    {
        $employees = Employee::with('user.todays_attendance', 'job_level', 'job_title')->get();
        
        return view('attendences.create', compact('employees'));
    }

    public function store(AttendenceRequest $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'date' =>  now()->format('Y-m-d'),
            'enter_time' => $request->enter_time,
            'exit_time' => $request->exit_time,
        ];

        $attendance = Attendance::where('date', date('Y-m-d'))->where('user_id', $request->user_id)->first();

        if($attendance) {

            $attendance->update(['exit_time' => $request->exit_time]);
            
            AttendanceReport::addHours($request->user_id, $attendance);
        }
        
        else {

            if (!$request->enter_time) return redirect()->back()->with('error', 'Enter time required!');

            Attendance::create($data);

            AttendanceReport::addDays($request->user_id);
        }

        return redirect()->back()->with('success', 'Attendence added successfully');
    }

    public function start(User $user){
        
        $check = Attendance::whereDate('date', date('Y-m-d'))->where('user_id', $user->id)->first();

        if($check){
            return redirect()->back()->with('error', 'Already Started!');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => date('Y-m-d'),
            'enter_time' => date('H:i:s')
        ]);

        AttendanceReport::addDays($user->id);

        return redirect()->back()->with('success', 'Timer Started');
    }

    public function end(User $user){
        
        $attendance = Attendance::whereDate('date', date('Y-m-d'))->where('user_id', $user->id)->first();

        if(!$attendance){
            return redirect()->back()->with('error', 'Timer has not been started yet!');
        }

        if($attendance->exit_time != null){
            return redirect()->back()->with('error', 'Timer has already been stopped!');
        }

        if(Auth::user()->role != User::ADMIN || $attendance->user_id != Auth::id()){

            $attendance->update(['exit_time' => date('H:i:s')]);

            AttendanceReport::addHours($user->id, $attendance);

            return redirect()->back()->with('success', 'Timer ended');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function monthlyReports(){
        
        $reports = AttendanceReport::where('month', 'LIKE', date('m-Y'))->orderBy('hours', 'DESC')->with('user')->get();

        return view('attendences.monthly', compact('reports'));
    }
}

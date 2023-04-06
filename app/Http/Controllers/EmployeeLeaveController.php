<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendenceRequest;
use App\Http\Requests\LeaveRequest;
use App\Models\AttendanceReport;
use App\Models\EmployeeLeave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeLeaves = EmployeeLeave::query();
        if (Auth::user()->role == User::EMPLOYEE) {
            $employeeLeaves->where('user_id', Auth::user()->id);
        }
        $employeeLeaves = $employeeLeaves->with('user', 'approvedBy')->paginate(15);

        // dd($employeeLeaves);
        return view('employee_leave.index', compact('employeeLeaves'));
    }

    public function store(LeaveRequest $request)
    {
        $from = date($request->from_date);
        $to = date($request->to_date);

        $date1 = date_create($from);
        $date2 = date_create($to);
        $diff = date_diff($date1, $date2);
        $days = $diff->format("%d");

        $employeeLeave = $request->validated();

        $employeeLeave['user_id'] = Auth::user()->id;
        $employeeLeave['days'] = $days;

        EmployeeLeave::create($employeeLeave);

        return redirect()->route('leave.index')->with('success', 'Leave Added Successfully');
    }

    public function update(LeaveRequest $request)
    {
        $employeeLeave = $request->validated();
        $employeeUpdate = EmployeeLeave::find($request->leave_id);

        $from = date($request->from_date);
        $to = date($request->to_date);

        $date1 = date_create($from);
        $date2 = date_create($to);
        $diff = date_diff($date1, $date2);
        $days = $diff->format("%d");

        $employeeLeave = $request->validated();

        $employeeLeave['days'] = $days;

        $employeeUpdate->update($employeeLeave);

        return redirect()->route('leave.index')->with('success', 'Leave Updateed Successfully');
    }

    public function statusUpdate(Request $request)
    {
        $employeeLeave = $request->all();
        $employeeLeaveStatus = EmployeeLeave::find($request->leave_id);
        if (Auth::user()->role == User::ADMIN) {
            $employeeLeave['approved_by'] = Auth::user()->id;
        }

        if ($request->status == '1') {

            $date = $request->from_date;

            $month = date('m-y', strtotime($date));
            
             $check = AttendanceReport::where('month', $month)->where('user_id', $request->user_id)->first();

            if ($check) {


                $userLeave = AttendanceReport::where('user_id', $request->user_id);

                $from = date($request->from_date);
                $to = date($request->to_date);

                $date1 = date_create($from);
                $date2 = date_create($to);
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%d");

                $userLeave->increment('leave', $days);
            } else {

                $userLeave = AttendanceReport::where('user_id', $request->user_id);

                $from = date($request->from_date);
                $to = date($request->to_date);

                $date1 = date_create($from);
                $date2 = date_create($to);
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%d");

                $userLeaveData = [
                    'leave' => $days,
                ];
                $userLeave->update($userLeaveData);
            }
        }





        if ($request->status == '0') {
            $massage = 'Leave Rejected Successfully';
        } else {
            $massage = 'Leave Approved Successfully';
        }
        //dd($employeeUpdate);
        $employeeLeaveStatus->update($employeeLeave);
        return redirect()->route('leave.index')->with('success', $massage);
    }
}

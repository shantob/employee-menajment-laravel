<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\JobLevel;
use App\Models\JobTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::active()->with('user', 'job_level','job_title')->paginate($this::ITEM_PER_PAGE);

        return view('employee.index', compact('employees'));
    }

    
    public function create()
    {
        $job_titles = JobTitle::get();
        $job_lavels = JobLevel::get();

        return view('employee.create', compact('job_titles', 'job_lavels'));
    }

    
    public function store(EmployeeRequest $request)
    {

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['phone'] = $request->phone;
        $userData['password'] = Hash::make($request->password);

        try {

            $user = User::create($userData);

            $employee_data = $request->validated();
            $employee_data['user_id'] = $user->id;

            if ($request->hasFile('image')) {
                $employee_data['image'] = file_upload($request->file('image'), Employee::IMAGE_PATH);
            }

            Employee::create($employee_data);

            return redirect()->route('employee.index')->with('success', 'Employee added successfully');
        }
        
        catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $job_titles = JobTitle::get();
        $job_lavels = JobLevel::get();
        $employee = Employee::find($id);

        return view('employee.edit', compact('employee','job_titles','job_lavels'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['phone'] = $request->phone;
        $userData['password'] = Hash::make($request->password);

        try {

            User::find($employee->user_id)->update($userData);

            $employee_data = $request->validated();
            
            if ($request->hasFile('image')) {

                if($employee->image != null){
                    file_delete($employee->image);
                }

                $employee_data['image'] = file_upload($request->file('image'), Employee::IMAGE_PATH);
            }
            
            $employee->update($employee_data);

            return redirect()->back()->with('success', 'Employee Updated successfully');

        } catch (\Exception $e) {
            return $e;

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        $employee = Employee::find($id);

        $data= [
            'status'=> 0
        ];
        $employee->update($data);
        
        return redirect()->back()->with('success','Employee Delete Successfully');
    }

    public function destroy($id)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobLevel;
use App\Models\JobTitle;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit($id)
    {

        $user = User::with('employee')->find($id);

        $job_titles = JobTitle::get();
        $job_levels = JobLevel::get();

        return view('profile', compact('user', 'job_titles', 'job_levels'));
    }

    public function update(Request $request, User $user)
    {
        $employee_data = $request->validate([
            'name' => 'required|string|max:100',
            'job_title_id' => 'nullable|exists:job_titles,id',
            'job_level_id' => 'nullable|exists:job_levels,id',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'death_of_birth' => 'nullable|date',
            'religion' => 'nullable',
            'nid' => 'nullable|numeric',
            'resign_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'gender' => 'nullable',
            'phone' => 'required|string',
            'join_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
        ]);

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['phone'] = $request->phone;
        $userData['password'] = Hash::make($request->password);

        try {

            $user->update($userData);
            if ($request->hasFile('image')) {
                if ($user->employee->image != null) {
                    file_delete($user->employee->image);
                }

                $employee_data['image'] = file_upload($request->file('image'), Employee::IMAGE_PATH);
            }

            $user->employee()->update($employee_data);

            return redirect()->back()->with('success', 'Profile Updated successfully');
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

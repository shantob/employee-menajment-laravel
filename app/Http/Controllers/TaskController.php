<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $month = $request->month;
        $type = $request->type;

        $tasks = Task::query();

        if ($date_from && $date_to) {
            $tasks->whereBetween('created_at', [$date_from, $date_to]);
        } else {
            $tasks->whereDate('created_at', date('Y-m-d'));
        }

        if ($month) {
            $tasks->where('created_at', 'LIKE', $month . '%');
        }

        if (Auth::user()->role == User::EMPLOYEE) {
            $tasks->where('user_id', Auth::user()->id);
        }

        $tasks =  $tasks->with('user', 'project', 'assigned_by')->paginate(15);
        //return $tasks;
        $projects = Project::get();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $users = User::get();
        $projects = Project::get();

        return view('tasks.create', compact('users', 'projects'));
    }

    public function store(TaskRequest $request)
    {
        $task = $request->validated();

        $task['user_id'] = $request->user_id ??  Auth::user()->id;

        if (Auth::user()->role == User::ADMIN) {
            $task['assigned_by'] = Auth::user()->id;
        }

        Task::create($task);

        return redirect()->route('task.index')->with('success', 'Task Added Successfully');
    }


    public function edit($id)
    {
        $users = User::get();
        $task = Task::find($id);
        $projects = Project::get();

        return view('tasks.edit', compact('task', 'users', 'projects'));
    }

    public function update_task(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'status' => 'nullable',
            'notes' => 'nullable',
        ]);
        $data = [
            'status' => $request->status,
            'notes' => $request->notes,
        ];
        $task = Task::find($request->task_id);
        //dd($task);
        $task->update($data);

        return redirect()->route('task.index')->with('success', 'Task Updated Successfully');
    }

    public function updateStatus(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        //dd($task);
        $auth_user_id = Auth::user()->id;
        $task_data = $request->validated();
        $task_data['status'] = $request->status;

        if ($request->user_id != $auth_user_id) {
            $task_data['reviewed_by'] = $auth_user_id;
        }
        //dd($task_data);
        $task->update($task_data);

        return redirect()->route('task.index')->with('success', 'Task Updated Successfully');
    }
}

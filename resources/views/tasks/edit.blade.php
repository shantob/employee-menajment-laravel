@extends('layouts.app')
@section('title','Edit Project')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Project
    </div>

    <div class="card-body">
        <form action="{{route('task.update',$task->id)}}" method="post">
            @method('patch')
            @csrf
            <div class="form-group mb-3">
                <label for="user_id" class="form-lable mb-3">Select User</label>
                <select class="form-select form-control" name="user_id">
                    <option selected disabled>Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" {{ $user->id == $task->user_id ? 'selected' : '' }}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="project_id" class="form-lable mb-3">Project Name</label>
                <select class="form-select form-control" name="project_id">
                    <option selected disabled>Select User</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}" {{ $project->id == $task->project_id ? 'selected' : '' }}>{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Task Description</label>
                <textarea class="form-control" name="description" placeholder="write sonething about Task">{!!$task->description!!}</textarea>
            </div>
            <input type="hidden" name="status" value="{{$task->status}}">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Update Task</button>
            </div>
        </form>

    </div>
</div>

@endsection
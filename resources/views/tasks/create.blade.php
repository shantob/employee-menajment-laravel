@extends('layouts.app')
@section('title','Add New Task')
@section('content')

<div class="card">
    <div class="card-header">
        Add Task
    </div>

    <div class="card-body">
        <form action="{{route('task.store')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="user_id" class="form-lable mb-3">Select User</label>
                <select class="form-select form-control" name="user_id">
                    <option selected disabled>Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="project_id" class="form-lable mb-3">Project Name</label>
                <select class="form-select form-control" name="project_id">
                    <option selected disabled>Select User</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Task Description</label>
                <textarea class="form-control" name="description" placeholder="write sonething about Task">{!!old('description')!!}</textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Add Task</button>
            </div>
        </form>

    </div>
</div>

@endsection
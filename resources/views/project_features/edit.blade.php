@extends('layouts.app')
@section('title','Edit Project Feature')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Project Feature
    </div>

    <div class="card-body">
        <form action="{{route('project_feature.update',$project_feature->id)}}" method="post">
            @method('patch')
            @csrf
            <div class="form-group mb-3">
                <label for="project_id" class="form-lable mb-3">Select Project Name</label>
                <select class="form-select form-control" name="project_id">
                    @foreach($projects as $project)
                    <option value="{{$project->id}}" {{ $project->id == $project_feature->project_id ? 'selected' : '' }}>{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Project Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name Type Here" value="{{$project_feature->name}}">
            </div>
            <div class="form-group mb-3">
                <label>Project Description</label>
                <textarea class="form-control" name="description" placeholder="write sonething about project"> {!!$project_feature->description!!} </textarea>
            </div>
           
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Update Project</button>
            </div>
        </form>

    </div>
</div>

@endsection
@extends('layouts.app')
@section('title','Add New Project Feature')
@section('content')

<div class="card">
    <div class="card-header">
        Add Project Feature
    </div>

    <div class="card-body">
        <form action="{{route('project_feature.store')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="project_id" class="form-lable mb-3">Select Project Name</label>
                <select class="form-select form-control" name="project_id">
                    <option selected disabled>Select Project Name</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Project Feature Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="feature Name Here" >
            </div>
            <div class="form-group mb-3">
                <label>Project Feature Description</label>
                <textarea class="form-control" name="description" placeholder="write sonething about project">{{old('description')}} </textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Add Project Feature</button>
            </div>
        </form>

    </div>
</div>

@endsection
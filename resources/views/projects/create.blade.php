@extends('layouts.app')
@section('title','Add New Project')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between ">
        <!-- <div class="card-title">
            Add Project
        </div> -->
    </div>

    <div class="card-body">
        <form action="{{route('project.store')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="full_name">Project Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Full Name" value="{{old('name')}}">
            </div>
            <div class="form-group mb-3">
                <label>Project Description</label>
                <textarea class="form-control" name="description" placeholder="write sonething about project">{!!old('description')!!}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label mb-3">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{old('start_date')}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="deadline" class="form-label mb-3">Deadline</label>
                    <input type="date" class="form-control" name="deadline" id="deadline" value="{{old('deatline')}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label mb-3">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{old('end_date')}}">
                </div>
            </div>
           
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Add Project</button>
            </div>
        </form>

    </div>
</div>

@endsection
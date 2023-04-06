@extends('layouts.app')
@section('title','Edit Employee')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Employee
    </div>

    <div class="card-body">
        <form action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data" method="post" class="p-4 bg-white rounded border">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="Full_name">Full Name</label>
                        <input type="text" class="form-control" id="Full_name" aria-describedby="full_name" name="name" value="{{$employee->name}}" placeholder="Enter Full Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{$employee->user->email}}" placeholder="Enter email">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="father_name" class="form-label">Father Name</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" value="{{$employee->father_name}}" placeholder="Enter Father Name">
                    @error('father_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother_name" class="form-label">Mother Name</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{$employee->mother_name}}" placeholder="Enter Mother Name" aria-describedby="mother_name">

                    @error('mother_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="job_title_id" class="form-lable mb-3">Job Name</label>
                    <select class="form-select form-control" name="job_title_id">
                        @foreach($job_titles as $job_title)
                        <option value="{{$job_title->id}}" {{ $job_title->id == $employee->job_title_id ? 'selected' : '' }}>{{$job_title->name}}</option>
                        @endforeach
                    </select>

                    @error('job_title_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="job_title_id" class="form-lable mb-3">Job Position</label>
                    <select class="form-select form-control" name="job_level_id">
                        <option selected value="{{$employee->job_level_id}}">{{$employee->job_level->name}}</option>
                        @foreach($job_lavels as $job_position)
                        <option value="{{$job_position->id}}">{{$job_position->name}}</option>
                        @endforeach
                    </select>
                    @error('job_level_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nid" class="form-label mb-3">Nid Number</label>
                    <input type="number" class="form-control" name="nid" id="nid" value="{{$employee->nid}}">
                    @error('nid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="death_of_birth" class="form-label mb-3">Date Of Birth</label>
                    <input type="date" class="form-control" name="death_of_birth" id="death_of_birth" value="{{$employee->death_of_birth}}">
                    @error('death_of_birth')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Gender" class="form-lable mb-3">Select Gender</label>
                    <select class="form-select form-control" name="gender">
                        <option value="{{$employee->gender}}">{{$employee->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="religion" class="form-lable mb-3">Select Religion</label>
                    <select class="form-select form-control" name="religion" id="religion">
                        <option selected value="{{$employee->religion}}">{{$employee->religion}}</option>
                        <option value="Islam">Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                        <option value="Boddo">Boddo</option>
                        <option value="Other's">Other's</option>
                    </select>
                    @error('religion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Phone_number">Phone Number</label>
                    <input type="phone" class="form-control" id="Phone_number" value="{{$employee->user->phone}}" aria-describedby="phone_number" name="phone" placeholder="Enter Phone">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="salary" class="form-label mb-3">Input Salary Range</label>
                    <input type="number" class="form-control" name="salary" id="salary" value="{{$employee->salary}}">
                    @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="join_date" class="form-label mb-3">Input Joining Date</label>
                    <input type="date" class="form-control" name="join_date" id="join_date" value="{{$employee->join_date}}">
                    @error('join_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="resign_date" class="form-label mb-3">Input Regine Date</label>
                    <input type="date" class="form-control" name="resign_date" id="resign_date" value="{{$employee->resign_date }}">
                    @error('resign_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" autocomplete="new-password">

                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                </div>
            </div>

            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="image" class="form-label mb-3">Input Profile Picture</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ file_path($employee->image) }}" class="img-thumbnail" height="250"/>
                    </div>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Update Employee</button>
            </div>
        </form>

    </div>
</div>

@endsection
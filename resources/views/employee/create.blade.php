@extends('layouts.app')@section('title','Add New Employee')
@section('content')

<div class="card my-3">
    <div class="card-header">
        Add Employee
    </div>

    <div class="card-body">
        <form action="{{route('employee.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Full Name" value="{{old('name')}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email"  value="{{old('email')}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="father_name" class="form-label">Father Name</label>
                    <input type="text" class="form-control" name="father_name" value="{{old('father_name')}}" placeholder="Enter Father Name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother_name" class="form-label">Mother Name</label>
                    <input type="text" class="form-control" name="mother_name" value="{{old('mother_name')}}" placeholder="Enter Mother Name" aria-describedby="mother_name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="job_title_id" class="form-lable mb-3">Job Name</label>
                    <select class="form-select form-control" name="job_title_id">
                        <option selected disabled>Select Job Name</option>
                        @foreach($job_titles as $job_title)
                        <option value="{{$job_title->id}}">{{$job_title->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="job_title_id" class="form-lable mb-3">Job Position</label>
                    <select class="form-select form-control" name="job_level_id">
                        <option selected disabled>Select Job Position</option>
                        @foreach($job_lavels as $job_position)
                        <option value="{{$job_position->id}}">{{$job_position->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nid" class="form-label mb-3">Nid Number</label>
                    <input type="number" class="form-control" name="nid" id="nid" value="{{old('number')}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="death_of_birth" class="form-label mb-3">Date Of Birth</label>
                    <input type="date" class="form-control" name="death_of_birth" id="death_of_birth" value="{{old('death_of_birth')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Gender" class="form-lable mb-3">Select Gender</label>
                    <select class="form-select form-control" name="gender">
                        <option selected value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="religion" class="form-lable mb-3">Select Religion</label>
                    <select class="form-select form-control" name="religion" id="religion">
                        <option value="Islam">Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                        <option value="Boddo">Boddo</option>
                        <option value="Other's">Other's</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Phone_number">Phone Number</label>
                    <input type="phone" class="form-control" id="Phone_number" aria-describedby="phone_number" value="{{old('phone')}}" name="phone" placeholder="Enter Phone">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="salary" class="form-label mb-3">Input Salary Range</label>
                    <input type="number" class="form-control" name="salary" id="salary" value="{{old('salary')}}">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="join_date" class="form-label mb-3">Input Joining Date</label>
                    <input type="date" class="form-control" name="join_date" id="join_date" value="{{old('join_date')}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="resign_date" class="form-label mb-3">Input Regine Date</label>
                    <input type="date" class="form-control" name="resign_date" id="resign_date" value="{{old('resign_date')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required autocomplete="new-password">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="image" class="form-label mb-3">Input Profile Picture</label>
                <input type="file" class="form-control" name="image" id="image">

            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
            </div>
        </form>

    </div>
</div>

@endsection
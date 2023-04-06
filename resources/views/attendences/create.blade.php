@extends('layouts.app')
@section('title','Attendance Add')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Add Attendance</h5>
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('attendence.index') }}">Attendance Sheet</a>
            </div>
        </div>

        <div class="container">
            <div class="my-4">
                <div class="">
                    <form action="{{route('attendence.store')}}" method="post" class="p-3">
                        @csrf
                        <label for="employee" class="p-2 h5 ">Select Employee Name</label>
                        <select class="form-select form-control" id="employee" name="user_id">
                            <option selected disabled>Select Employee Name</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->user_id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="enter_time" class="form-label h5 p-2">Start Time</label>
                                <input type="time" class="form-control" id="enter_time" name="enter_time" value="{{old('enter_time')}}">
                                @error('enter_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exit_time" class="form-label h5 p-2">Exit Time</label>
                                <input type="time" class="form-control" id="exit_time" name="exit_time" value="{{old('exit_time')}}">
                                @error('exit_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Update Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($employees as $employee)
        <div class="col-md-4 col-lg-3 my-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center">
                        <img class="rounded-circle" src="{{ file_path($employee->image) }}" alt="user image" height="180" width="180">
                    </div>
                    <h5 class="card-title mt-3">{{ $employee->name }}</h5>
                    <p class="card-text">{{ $employee->job_level->name }} | {{ $employee->job_title->name }}</p>

                    @if($employee->user->todays_attendance != null)
                        @php
                            $todays_attendance = $employee->user->todays_attendance;
                        @endphp
                        @if($todays_attendance->exit_time == null)
                            @php
                                $running_time = hour_difference($todays_attendance->enter_time, date('H:i'));
                            @endphp
                            <a href="{{ route('attendence.end', $employee->user_id) }}" class="btn btn-danger btn-sm px-3"><i class="fa fa-clock mr-1"></i>
                                {{ $running_time['hour'].':'.$running_time['min']}} End
                            </a>
                        @else
                            @php
                                $completed_time = hour_difference($todays_attendance->enter_time, $todays_attendance->exit_time); 
                            @endphp
                            <button class="btn btn-light btn-sm px-3">{{ $completed_time['hour'].' hours '.$completed_time['min'] . ' minutes' }}</button>
                        @endif                        
                        
                    @else
                        <a href="{{ route('attendence.start', $employee->user_id) }}" class="btn btn-success btn-sm px-3"><i class="fa fa-plus mr-1"></i>Start</a>
                    @endif
                </div>
            </div>
        </div>            
        @endforeach
    </div>
</div>
@endsection
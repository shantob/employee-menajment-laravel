@extends('layouts.app')
@section('title','Employee Index')
@section('content')

<h3 class="mb-3">Dashboard</h3>
<h5>Welcome, {{ auth()->user()->name }}!</h5>

<div class="row">
    @if($data['attendance'])
    @php
        $attendance = $data['attendance'];
    @endphp
    <div class="col-md-4 col-lg-3 my-2">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title mt-3">Your Attendance Today</h5>
                <p class="card-text">Click end to stop timer</p>

                @if($attendance != null)
                    @if($attendance->exit_time == null)
                        @php
                            $running_time = hour_difference($attendance->enter_time, date('H:i'));
                        @endphp
                        <a href="{{ route('attendence.end', $attendance->user_id) }}" class="btn btn-danger btn-sm px-3"><i class="fa fa-clock mr-1"></i>
                            {{ $running_time['hour'].':'.$running_time['min']}} End
                        </a>
                    @else
                        @php
                            $completed_time = hour_difference($attendance->enter_time, $attendance->exit_time); 
                        @endphp
                        <button class="btn btn-light btn-sm px-3">{{ $completed_time['hour'].' hours '.$completed_time['min'] . ' minutes' }}</button>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
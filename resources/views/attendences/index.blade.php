@extends('layouts.app')
@section('title','Attendance Index')
@section('content')
<div>
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Attendance</h5>
            </div>
            <form>
                <div class="row">
                    <div class="col">
                        <input type="month" class="form-control" name="month" value="{{request()->month}}">
                        <label class="">Month</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_from" value="{{request()->date_from}}">
                        <label class="">From</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_to" value="{{request()->date_to}}">
                        <label>To</label>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary btn-sm mt-1">Search</button>
                    </div>
                </div>
            </form>
            <div>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <a class="btn btn-primary btn-sm mt-1" href="{{ route('attendence.create') }}">Add</a>
                @endif
                <a href="{{ route('attendence.monthly') }}" class="btn btn-success btn-sm mt-1">Monthly</a>
                <!-- <a href="{{route('attendence.index')}}?month={{date('Y-m')}}" class="btn btn-success btn-sm mt-1">Monthly</a> -->
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Total Worked</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach($attendences as $attendence)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{ date('d-m-Y', strtotime($attendence->created_at)) }}</td>
                        <td>{{$attendence->user->name}}</td>
                        <td>{{ date('h:i a', strtotime($attendence->enter_time)) }}</td>
                        <td>{{ $attendence->exit_time? (date('h:i a', strtotime($attendence->exit_time))) : 'Running' }}</td>
                        @if($attendence->enter_time && $attendence->exit_time)
                        <td>
                            @php
                            $time = hour_difference($attendence->enter_time, $attendence->exit_time);
                            echo $time['hour'] . ':' . $time['min'] . ' hours';
                            @endphp
                        </td>
                        @else
                        <td>Running</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-end">
        {{ $attendences->links() }}
    </div>
</div>
@endsection
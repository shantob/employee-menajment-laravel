@extends('layouts.app')
@section('title', 'Monthly Attendance Report')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Monthly Attendance Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Emp. Name</th>
                    <th scope="col">Working Days</th>
                    <th scope="col">Working Hours</th>
                </tr>
            </thead>
            <tbody>
                @if($reports)
                    @foreach ($reports as $report)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->days }}</td>
                            <td>{{ $report->hours }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</div>

@endsection
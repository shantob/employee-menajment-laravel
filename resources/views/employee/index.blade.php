@extends('layouts.app')
@section('title','Employee Index')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Employees</h5>
            </div>
            <div>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <a class="btn btn-primary btn-sm" href="{{ route('employee.create') }}">Add Employee</a>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Job Name</th>
                        <th scope="col">Job Level</th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($employees as $employee)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->user?->email}}</td>
                        <td>{{$employee->job_title->name}}</td>
                        <td>{{$employee->job_level?->name}}</td>
                        <td>{{$employee->join_date}}</td>
                        <td>{{$employee->salary}}</td>
                        <td>{{$employee->status ==1 ? 'Active' : 'Not-active'}}</td>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <td>
                            <form action="{{route('employee.delete',$employee->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
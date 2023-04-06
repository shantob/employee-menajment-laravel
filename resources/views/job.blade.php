@extends('layouts.app')
@section('title','Job List')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    <h5 class="card-title">Job Titles</h5>
                </div>

                <div>
                    @if(auth()->user()->role == \App\Models\User::ADMIN)
                    <form action="{{route('jobTitle.store')}}" class="d-flex" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Add job title">
                            <button class="btn btn-primary btn-sm" type="submit">Add</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>

                    <tbody class="table-hover">
                        @foreach($job_titles as $job_title)
                        <tr class="text-center">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$job_title->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    <h5 class="card-title">Job Levels</h5>
                </div>
                <div>
                    @if(auth()->user()->role == \App\Models\User::ADMIN)
                    <form action="{{route('jobLevel.store')}}" class="d-flex" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Add job title">
                            <button class="btn btn-primary btn-sm" type="submit">Add</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>

                    <tbody class="table-hover">
                        @foreach($job_lelvels as $job_level)
                        <tr class="text-center">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$job_level->name}}</td>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
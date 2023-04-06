@extends('layouts.app')
@section('title','Employee Index')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h5>Projects</h5>
            </div>
            @if(auth()->user()->role == \App\Models\User::ADMIN)
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('project.create') }}">Add Project</a>
            </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($projects as $project)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{$project->name}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{$project->start_date}}</td>
                        <td>{{$project->deadline}}</td>
                        <td>{{$project->end_date}}</td>
                        <td>{{$project->status ==0 ? 'Active' : 'Not-active'}}</td>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <td class="row">
                            <form action="{{route('project.delete',$project->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <a href="{{route('project.edit',$project->id)}}" class="btn btn-primary btn-sm">
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
    </div>
</div>

@endsection
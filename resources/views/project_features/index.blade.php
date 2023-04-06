@extends('layouts.app')
@section('title','Employee Index')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Project Feature</h5>
            </div>
            <div>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <a class="btn btn-primary btn-sm" href="{{ route('project_feature.create') }}">Add Project Feature</a>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($project_features as $project_feature)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{$project_feature->project->name}}</td>
                        <td>{{$project_feature->name}}</td>
                        <td>{{$project_feature->description}}</td>
                        <td>{{$project_feature->status ==0 ? 'Active' : 'Not-active'}}</td>
                        @if(auth()->user()->role == \App\Models\User::ADMIN)
                        <td class="row">
                            <form action="{{route('project_feature.delete',$project_feature->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <a href="{{route('project_feature.edit',$project_feature->id)}}" class="btn btn-primary btn-sm">
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
@extends('layouts.app')
@section('title','Employee Index')
@section('content')
<?php

use App\Models\User;

?>
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Task List</h5>
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
                @if(auth()->user()->role == User::ADMIN)
                <a class="btn btn-primary btn-sm mt-1" href="{{ route('task.create') }}">Add Task</a>
                @endif
                @if(auth()->user()->role == User::EMPLOYEE)
                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#taskAddModal">
                    Add Task
                </button>
                <div class="modal fade" id="taskAddModal" tabindex="-1" aria-labelledby="taskAddModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="taskAddModalLabel">Add Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('task.store')}}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="full_name">Project Name</label>
                                        <select class="form-select form-control" name="project_id">
                                            <option selected disabled>Select Project</option>
                                            @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Task Description</label>
                                        <textarea class="form-control" name="description" placeholder="write sonething about Task">{{old('description')}}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary mx-1 btn-sm px-3" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm px-3">Add</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                <a href="{{route('task.index')}}?month={{date('Y-m')}}" class="btn btn-success btn-sm mt-1">Monthly Task</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Assigned By</th>
                        <th scope="col">Project</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role == User::ADMIN)
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($tasks as $task)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{$task->user?->name}}</td>
                        <td>{{$task->project->name}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{ date('Y-m-d', strtotime($task->created_at))}}</td>
                        <td>{{$task->status ==0 ? 'Active' : 'Not-active'}}</td>
                        @if(auth()->user()->role == User::ADMIN)
                        <td>
                            <a href="{{route('task.edit',$task->id)}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-warning btn-sm update_button" data-id="{{$task->id}}" data-status='{{$task->status}}' data-notes='{{$task->notes}}'><i class="fas fa-check"></i></button>

                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-end">
        {{ $tasks->links() }}
    </div>
    @if(auth()->user()->role == User::ADMIN)
    <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="taskEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskEditLabel">Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('task.update_task')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="task_id" name="task_id">
                        <div class="errMsgContainer"></div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select form-control" name="status" id="status">
                                <option value="1">Approved</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Note</label>
                            <textarea class="form-control" name="notes" id="notes" placeholder="write sonething about Task"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mx-1 btn-sm px-3" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm px-3">Update</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.update_button', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');
            let note = $(this).data('notes');

            $('#task_id').val(id);
            $('#status').val(status);
            $('#notes').val(note);
            // console.log(status);
            $('#updateTaskModal').modal('show');
        });
    });
</script>
@endpush
@endsection
@extends('layouts.app')
@section('title','Expenses Edit')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <h5 class="card-title">Edit Expenses</h5>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#taskAddModal"><i class="fa fa-plus mr-1"></i> Add Expenses Type</button>
                <a class="btn btn-primary btn-sm" href="{{ route('expenses.index') }}">Expenses Sheet</a>
            </div>
        </div>

        <div class="container">
            <div class="my-4">
                <div class="">
                    <form action="{{route('expenses.update',$expense->id)}}" method="post" class="p-3">
                        @csrf
                        @method('patch')
                        <label for="employee" class="p-2 h5 ">Select Expense Type Name</label>
                        <select class="form-select form-control" id="employee" name="expense_type_id">
                            @foreach($expenses_types as $expenses_type)
                            <option value="{{$expenses_type->id}}" {{ $expenses_type->id == $expense->expense_type_id ? 'selected' : '' }}>{{$expenses_type->name}}</option>
                            @endforeach
                        </select>
                        @error('expense_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label h5 p-2">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="{{$expense->amount}}">
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label h5 p-2">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{$expense->date}}">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="description" class="form-label h5 p-2">Description</label>
                            <textarea class="form-control" id="description" name="description">{!!$expense->description!!} </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Update Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

<div class="modal fade" id="taskAddModal" tabindex="-1" aria-labelledby="taskAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskAddModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('expenses_type.store')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Expenses Type Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Expenses Type Name">
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
@endsection
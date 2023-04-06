@extends('layouts.app')
@section('title','Expenses Index')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h5>Expenses</h5>
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('expenses.create') }}">Add Expenses</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Expenses Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($expenses as $expense)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{$expense->expense_type->name}}</td>
                        <td>{{$expense->description}}</td>
                        <td>{{$expense->amount}}</td>
                        <td>{{$expense->date}}</td>
                        <td >
                            <a href="{{route('expenses.edit',$expense->id)}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
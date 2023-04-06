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
                <h5 class="card-title">leave List</h5>
            </div>
            <div>
                @if(auth()->user()->role == User::EMPLOYEE)
                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#leaveAddModal">
                    Add Leave Request
                </button>
                <div class="modal fade" id="leaveAddModal" tabindex="-1" aria-labelledby="leaveAddModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="leaveAddModalLabel">Add Leave</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('leave.store')}}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="leave_type">Leave Type</label>
                                        <select class="form-select form-control" name="leave_type">
                                            <option selected disabled>Select Leave Type</option>
                                            <option value="personal">Personal</option>
                                            <option value="Official">Official</option>
                                            <option value="Official Paid">Official Paid</option>
                                            <option value="Official Non Paid">Official Non Paid</option>
                                            <option value="Other's">Other's</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="from_date">Fron Date</label>
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="to_date">To Date</label>
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Leave Reason</label>
                                        <textarea class="form-control" name="leave_reason" placeholder="write sonething about leave">{{old('leave_reason')}}</textarea>
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
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Days</th>
                        <th scope="col">Leave Reason</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role == User::EMPLOYEE)
                        <th scope="col">Edit</th>
                        @endif
                        @if(auth()->user()->role == User::ADMIN)
                        <th scope="col">Action</th>
                        @endif
                        <th scope="col">Approved By</th>
                    </tr>
                </thead>

                <tbody class="table-hover">
                    @foreach($employeeLeaves as $leave)
                    <tr class="text-center">
                        <th>{{$loop->iteration}}</th>
                        <td>{{$leave->user?->name}}</td>
                        <td>{{$leave->leave_type}}</td>
                        <td>{{$leave->from_date}}</td>
                        <td>{{$leave->to_date}}</td>
                        <td>{{$leave->days}} Days</td>
                        <td>{{$leave->leave_reason}}</td>
                        <td class="{{$leave->status == 0 ? 'text-danger':'text-success'}}">{{$leave->status ==0 ? 'Pending' : 'Accept'}}</td>

                        @if(auth()->user()->role == User::EMPLOYEE)
                        <td>
                            <button class="btn btn-primary btn-sm update_button" data-id="{{$leave->id}}" data-leave_type='{{$leave->leave_type}}' data-from_date='{{$leave->from_date}}' data-to_date='{{$leave->to_date}}' data-leave_reason='{{$leave->leave_reason}}'><i class="fas fa-edit"></i></button>
                        </td>
                        @endif
                        @if(auth()->user()->role == User::ADMIN)
                        <td>
                            <button class="btn {{ $leave->status == 0 ?' btn-danger' : ' btn-success'}} btn-sm update_status" data-id="{{$leave->id}}" data-user_id="{{$leave->user_id}}" data-leave_type='{{$leave->leave_type}}' data-from_date='{{$leave->from_date}}' data-to_date='{{$leave->to_date}}' data-status='{{$leave->status}}'>
                                @if($leave->status == 0 )
                                <span>
                                    Reject
                                </span>
                                @else
                                <span>
                                    Accept
                                </span>
                                @endif
                            </button>
                        </td>
                        @endif
                        @if($leave->approved_by)
                        <td>{{$leave->approvedBy->name}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-end">
        {{ $employeeLeaves->links() }}
    </div>
    @if(auth()->user()->role == User::EMPLOYEE)
    <div class="modal fade" id="updateleaveModal" tabindex="-1" aria-labelledby="leaveEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leaveEditLabel">Edit Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('leave.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="leave_id" name="leave_id">
                        <div class="form-group mb-3">
                            <label for="leave_type">Leave Type</label>
                            <select class="form-select form-control" name="leave_type" id="leave_type">
                                <option selected disabled>Select Leave Type</option>
                                <option value="personal">Personal</option>
                                <option value="Official">Official</option>
                                <option value="Official Paid">Official Paid</option>
                                <option value="Official Non Paid">Official Non Paid</option>
                                <option value="Other's">Other's</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="from_date">Fron Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="to_date">To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Leave Reason</label>
                            <textarea class="form-control" name="leave_reason" id="leave_reason" placeholder="write sonething about leave">{{old('leave_reason')}}</textarea>
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
    @if(auth()->user()->role == User::ADMIN)
    <div class="modal fade" id="updateleaveModalStatus" tabindex="-1" aria-labelledby="statusLeavModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusLeavModal">Approve Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('leave.update.status')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="status_id" name="leave_id">
                        <input type="hidden" id="user_id" name="user_id">
                        <input type="hidden" id="leave_type" name="leave_type">
                        <input type="hidden" id="from_date" name="from_date">
                        <input type="hidden" id="to_date" name="to_date">
                        <div class="form-group mb-3">
                            <label for="leave_type">Leave Approve</label>
                            <select class="form-select form-control" name="status" id="status">
                                <option value="1">Approved</option>
                                <option value="0">Rejected</option>
                            </select>
                            </select>
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
            let leave_type = $(this).data('leave_type');
            let from_date = $(this).data('from_date');
            let to_date = $(this).data('to_date');
            let leave_reason = $(this).data('leave_reason');

            $('#leave_id').val(id);
            $('#leave_type').val(leave_type);
            $('#from_date').val(from_date);
            $('#from_date').val(from_date);
            $('#to_date').val(to_date);
            $('#to_date').val(to_date);
            $('#leave_reason').val(leave_reason);
            // console.log(status);
            $('#updateleaveModal').modal('show');
        });
        $(document).on('click', '.update_status', function() {
            let id = $(this).data('id');
            let user_id = $(this).data('user_id');
            let leave_type = $(this).data('leave_type');
            let from_date = $(this).data('from_date');
            let to_date = $(this).data('to_date');
            let status = $(this).data('status');
            $('#status_id').val(id);
            $('#user_id').val(user_id);
            $('#leave_type').val(leave_type);
            $('#from_date').val(from_date);
            $('#to_date').val(to_date);
            $('#status').val(status);
            // console.log(status);
            $('#updateleaveModalStatus').modal('show');
        });
    });
</script>
@endpush
@endsection
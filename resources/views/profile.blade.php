@extends('layouts.app')
@section('title','Employee Profile')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <div>
                    {{$user->name}}
                </div>
                <div>
                    @if($user->role == \App\Models\User::EMPLOYEE)
                    <span>{{ $user->employee->job_title->name }} | {{ $user->employee->job_level->name }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('users.update',$user->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="{{ $user->employee != null ? 'col-md-8' : 'col-md-12' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="Full_name">Full Name</label>
                                <input type="text" class="form-control" id="Full_name" aria-describedby="full_name" name="name" value="{{$user->name}}" placeholder="Enter Full Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{$user->email}}" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                    @if($user->employee != null)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="father_name" class="form-label">Father Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="{{$user->employee->father_name}}" placeholder="Enter Father Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="mother_name" class="form-label">Mother Name</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{$user->employee->mother_name}}" placeholder="Enter Mother Name" aria-describedby="mother_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nid" class="form-label">Nid Number</label>
                                <input type="number" class="form-control" name="nid" id="nid" placeholder="Nid Number" value="{{$user->employee->nid}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="Phone_number">Phone Number</label>
                                <input type="phone" class="form-control" id="Phone_number" value="{{$user->phone}}" aria-describedby="phone_number" name="phone" placeholder="Enter Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="Gender" class="form-lable mb-3">Select Gender</label>
                                <select class="form-select form-control" name="gender">
                                    <option value="{{$user->employee->gender}}">{{$user->employee->gender}}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="religion" class="form-lable mb-3">Select Religion</label>
                                <select class="form-select form-control" name="religion" id="religion">
                                    <option selected value="{{$user->employee->religion}}">{{$user->employee->religion}}</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Boddo">Boddo</option>
                                    <option value="Other's">Other's</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if($user->employee != null)
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <div class="card" style="height: 300px; width: 300px;">
                            <div class="card-body">
                                @if(($user->employee->image) != null)
                                <img src="{{ file_path($user->employee->image) }}" class="img-thumbnail w-100" />
                                @else
                                <img src="https://media.istockphoto.com/id/936182806/vector/no-image-available-sign.jpg?s=612x612&w=0&k=20&c=9HTEtmbZ6R59xewqyIQsI_pQl3W3QDJgnxFPIHb4wQE=" class="img-thumbnail w-100" />
                                @endif
                                <input type="file" class="form-control mt-4" name="image" id="image">
                                <label for="image" class="form-label mx-4">Change Profile Image</label>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if($user->employee != null)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="death_of_birth" class="form-label mb-3">Date Of Birth</label>
                        <input type="date" class="form-control" name="death_of_birth" id="death_of_birth" value="{{$user->employee->death_of_birth}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="join_date" class="form-label mb-3">Join Date</label>
                        <input type="date" class="form-control" name="join_date" id="join_date" value="{{$user->employee->join_date}}">
                    </div>
                </div>
            </div>
            @endif
            @if($user->employee == null)
            <div class="form-group mb-3">
                <label for="Phone_number">Phone Number</label>
                <input type="phone" class="form-control" id="Phone_number" value="{{$user->phone}}" aria-describedby="phone_number" name="phone" placeholder="Enter Phone">
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" autocomplete="new-password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
            </div>
        </form>

    </div>
</div>

@endsection
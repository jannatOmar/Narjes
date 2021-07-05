@extends('layouts.admin')
@section('title','Add New User')
@section('style')
<style>
.tooltiptext {
    visibility: hidden;
    width: 150px;
    background-color: white;
    color: #000;
    text-align: center;
    border-radius: 1px;
    border: 1px solid black;
    padding: 5px 0;

    position: absolute;
    z-index: 1;
}

.tool:hover .tooltiptext {
    visibility: visible;
}
</style>

@endsection
@section('content')

<div class="row">
    <div class="col-md-8 col-sm-4" style="margin: auto;">
        <div class="card" style="width:120%; margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">person_add</i>
                </div>
                <h4 class="card-title">Add New User </h4>
            </div>
            
            @include('alert.success')
                @include('alert.errors')
            <div class="card-body">
                <form class="form" method="post" action="{{route('admin.userManagment.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">First Name</label>
                                <input type="text" class="form-control" name="f_name" value="{{old('f_name')}}">
                                @error('f_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Middle Name</label>
                                <input type="text" class="form-control" name="m_name" value="{{old('m_name')}}">
                                @error('m_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Last Name</label>
                                <input type="text" class="form-control" name="l_name" value="{{old('l_name')}}">
                                @error('l_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">User Name</label>
                                <input type="text" class="form-control" name="username" value="{{old('username')}}">
                                @error('username')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="password" value="{{old('password')}}" name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <select name="role_name" class="selectpicker" data-background-color="rose"
                                    data-style="select-with-transition" data-size="7">
                                    <option disabled selected value="role">role</option>
                                    @if (old('role_name') == 'manager')
                                    <option value="manager" selected>Manager</option>
                                    @else
                                    <option value="manager">Manager</option>
                                    @endif
                                    @if (old('role_name') == 'employee')
                                    <option value="employee" selected>Employee</option>
                                    @else
                                    <option value="employee">Employee</option>
                                    @endif
                                    @if (old('role_name') == 'accountant')
                                    <option value="accountant" selected>Accountant</option>
                                    @else
                                    <option value="accountant">Accountant</option>
                                    @endif
                                </select>
                                <br>
                                @error('role_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                                <br>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                @error('address')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Age</label>
                                <input type="text" class="form-control" name="age" value="{{old('age')}}">
                                @error('age')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <div class="tool">

                                    <input type="date" class="form-control" name="start_date" data-toggle="tooltip" data-placement="top" title="Start Date"
                                        value="{{old('start_date')}}">
                                    @error('start_date')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                   
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <button type="submit" class="btn btn-rose " style="width:20% ">Add</button>
                        <div class="clearfix">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
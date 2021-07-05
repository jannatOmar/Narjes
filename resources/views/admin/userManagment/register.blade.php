@extends('layouts.admin')
@section('title','Add New User')
@section('content')
<div class="row">
    <div class="col-md-10 ml-auto mr-auto">
        <div class="card card-signup" style="margin-top: 3%;">
            <!-- <h2 class="card-title text-center">Register</h2> -->
            <br>
            
            @include('alert.success')
                @include('alert.errors')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 mr-auto" style="margin-right: 0%;">

                        <form class="form" method="post" action="{{route('admin.userManagment.store')}}">
                            @csrf
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="f_name" value="{{old('f_name')}}"
                                        placeholder="First Name...">
                                    @error('f_name')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="l_name" value="{{old('l_name')}}"
                                        placeholder="Last Name...">
                                    @error('l_name')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email" value="{{old('email')}}"
                                        placeholder="Email...">
                                    @error('email')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">location_city</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="address" value="{{old('address')}}"
                                        placeholder="Address...">
                                    @error('address')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    </div>
                                    <label>Start date:
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{old('start_date')}}"></label>
                                    @error('start_date')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-default">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">age</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="age" value="{{old('age')}}"
                                        placeholder="age...">
                                    @error('age')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                    </div>

                    <div class="col-md-5 mr-auto" style="margin-right: 0%;">
                        <div class="form-group has-default">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="m_name" value="{{old('m_name')}}"
                                    placeholder="Middle Name...">
                                @error('m_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group has-default">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">perm_identity
                                        </i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="username" value="{{old('username')}}"
                                    placeholder="User Name...">
                                @error('username')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group has-default">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" placeholder="Password..." value="{{old('password')}}"
                                    name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group has-default">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">phone_forwarded</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}"
                                    placeholder="phone...">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>


                        </div>

                        <div class="form-group has-default">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                </div>
                                <!-- class="selectpicker"  -->
                                <select name="role_name" data-background-color="rose"
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
                                @error('role_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center ">
                            <button type="submit" class="btn btn-primary btn-round mt-4 ">Create account</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
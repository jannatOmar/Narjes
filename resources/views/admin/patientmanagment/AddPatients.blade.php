@extends('layouts.admin')
@section('title','Add Patient')


@section('content')
<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="width:120%; margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">person_add</i>
                </div>
                <h4 class="card-title">Add Patient </h4>
            </div>
            <br>
            @include('alert.success')
            @include('alert.errors')
            <br>
            <div class="card-body">
                <form class="form" method="post" action=" {{route('admin.patientManagment.store')}}">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Middle Name</label>
                                <input type="text" class="form-control" name="m_name" value="{{old('m_name')}}">

                                @error('m_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Last Name</label>
                                <input type="text" class="form-control" name="l_name" value="{{old('l_name')}}">
                                @error('l_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="gender" class="selectpicker" data-background-color="rose"
                                    data-style="select-with-transition" data-size="7">
                                    <option disabled selected value="gender">gender</option>
                                    @if (old('gender') == 'male')
                                    <option value="male" selected>Male</option>
                                    @else
                                    <option value="male">Male</option>
                                    @endif
                                    @if (old('gender') == 'female')
                                    <option value="female" selected>Female</option>
                                    @else
                                    <option value="female">Female</option>
                                    @endif
                                </select>
                                <br>
                                @error('gender')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{old('birthday')}}" name="birthday" data-toggle="tooltip" data-placement="top" title="Birthday Date">
                                @error('birthday')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating"> Address</label>
                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                @error('address')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-rose " style="width:30% ">Add</button>
                        <div class="clearfix">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
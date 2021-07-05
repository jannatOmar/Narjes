@extends('layouts.accountant')
@section('title','Update Patient Information')
@section('content')
<div class="row">
    <div class="col-md-8 " style="margin:auto;">
        <div class="card" style="width:120%;margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Edit Patient Information </h4>
            </div>
            <br>
            
            
            @include('alert.success')
            @include('alert.errors')
            <div class="card-body">
            
                <form class="form" method="post"
                    action="{{route('accountant.patientManagment.update',$patient->patient_id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">First Name</label>
                                <input type="text" class="form-control" name="f_name" value="{{$patient->f_name}}">
                                @error('f_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Middle Name</label>
                                <input type="text" class="form-control" name="m_name" value="{{$patient->m_name}}">

                                @error('m_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Last Name</label>
                                <input type="text" class="form-control" name="l_name" value="{{$patient->l_name}}">
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
                                    <option disabled value="gender">gender</option>
                                    <option value="male" @if($patient->gender=='male')selected @endif>Male</option>
                                    <option value="female" @if($patient->gender=='female')selected @endif>Female</option>

                                </select>
                                
                                @error('gender')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Birthday</label>
                                <input  type="text" class="form-control" name="birthday"
                                    value="{{$patient->birthday}}">
                                @error('birthday')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating"> Address</label>
                                <input type="text" class="form-control" name="address" value="{{$patient->address}}">
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
                                <input type="text" class="form-control" name="phone" value="{{$patient->phone}}">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$patient->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-rose " style="width:30% ">Update</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
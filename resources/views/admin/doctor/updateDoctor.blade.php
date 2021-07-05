@extends('layouts.admin')
@section('title','Update Doctor')
@section('content')

<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="width:120%; margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Edit doctor </h4>
            </div>
            @include('alert.success')
            @include('alert.errors')
            <div class="card-body">
                @isset($doctor)
                <form method="post" action="{{route('admin.doctor.update', $doctor->doctor_id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">First Name</label>
                                <input type="text" value="{{$doctor->f_name}}" name="first_name" class="form-control">
                                @error('first_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Middle Name</label>
                                <input type="text" value="{{$doctor->m_name}}" name="middle_name" class="form-control">
                                @error('middle_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Last Name</label>
                                <input type="text" value="{{$doctor->l_name}}" name="last_name" class="form-control">
                                @error('last_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <br><br>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating"> Address</label>
                                <input type="text" value="{{$doctor->address}}" name="address" class="form-control">
                                @error('address')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input type="text" value="{{$doctor->phone}}" name="phone" class="form-control">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" value="{{$doctor->email}}" name="email" class="form-control">
                                @error('email')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-rose " style="width: 20%;">Update</button>
                    <div class="clearfix"></div>
                </form>
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection
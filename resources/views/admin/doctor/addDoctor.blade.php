@extends('layouts.admin')
@section('title','Add Doctor')
@section('content')

<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="    width: 120%;
    margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">person_add</i>
                </div>
                <h4 class="card-title">Add Dcotor </h4>
            </div>
            <br>
            @include('alert.success')
            @include('alert.errors')

            <div class="card-body" >
                <form method="post" action="{{route('admin.doctor.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">First Name</label>
                                <input value="{{old('first_name')}}" type="text" name="first_name" class="form-control">
                                @error('first_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Middle Name</label>
                                <input type="text" value="{{old('middle_name')}}" name="middle_name"
                                    class="form-control">
                                @error('middle_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Last Name</label>
                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control">
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
                                <input type="text" value="{{old('address')}}" name="address" class="form-control">
                                @error('address')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input type="text" value="{{old('phone')}}" name="phone" class="form-control">
                                @error('phone')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" value="{{old('email')}}" name="email" class="form-control">
                                @error('email')
                                <span class="text-danger">{{$message}} </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-rose " style="width: 20%;">Add </button>

                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection